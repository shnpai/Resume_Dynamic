<?php
header('Content-Type: application/json; charset=utf-8');
session_start();

// Setup PDO connection (adjust parameters if needed)
$dsn = 'mysql:host=127.0.0.1;dbname=resume_dynamic;charset=utf8mb4';
$dbUser = 'root';
$dbPass = '';
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];
try {
    $pdo = new PDO($dsn, $dbUser, $dbPass, $options);
} catch (PDOException $e) {
    // For non-AJAX, redirect back with error
    if (!empty($_SERVER['HTTP_REFERER'])) {
        header('Location: ' . $_SERVER['HTTP_REFERER'] . '?status=' . urlencode('DB connection failed'));
        exit;
    }
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit;
}

// Read JSON input when present
$raw = file_get_contents('php://input');
$input = json_decode($raw, true) ?: [];
$action = $input['action'] ?? $_REQUEST['action'] ?? '';

function is_json_request() {
    $ct = $_SERVER['CONTENT_TYPE'] ?? '';
    return stripos($ct, 'application/json') !== false;
}

function is_ajax_request() {
    return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest'
        || is_json_request()
        || (strpos($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json') !== false);
}

function respond($data, $status = 200) {
    if (is_ajax_request()) {
        http_response_code($status);
        echo json_encode($data);
        exit;
    }
    // For simple form POSTs, redirect back to referrer with a status message
    if (is_string($data)) {
        $msg = $data;
    } elseif (is_array($data) && isset($data['error'])) {
        $msg = $data['error'];
    } elseif (is_array($data) && isset($data['ok'])) {
        $msg = $data['ok'] === true ? 'ok' : 'done';
    } else {
        $msg = 'done';
    }
    $ref = $_SERVER['HTTP_REFERER'] ?? 'index.php';
    $u = parse_url($ref);
    $base = $u['path'] ?? 'index.php';
    header('Location: ' . $base . '?status=' . urlencode($msg));
    exit;
}

// Helper to get parameter from JSON input or POST/GET
function in($key, $default = null) {
    global $input;
    if (isset($input[$key])) return $input[$key];
    if (isset($_POST[$key])) return $_POST[$key];
    if (isset($_GET[$key])) return $_GET[$key];
    return $default;
}

// Simple auth check for modifying actions
function require_auth() {
    if (empty($_SESSION['user_id'])) {
        http_response_code(401);
        respond(['error' => 'Authentication required']);
    }
}

// LOGIN
if ($action === 'login' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = in('username', '');
    $password = in('password', '');
    $stmt = $pdo->prepare('SELECT id, password_hash FROM users WHERE username = :u');
    $stmt->execute([':u' => $username]);
    $user = $stmt->fetch();
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['id'];
        respond(['ok' => true]);
    }
    http_response_code(401);
    respond(['error' => 'Invalid credentials'], 401);
}

// REGISTER
if ($action === 'register' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim(in('username', ''));
    $password = in('password', '');
    $password2 = in('password2', '');
    if ($username === '' || $password === '') {
        respond(['error' => 'Username and password are required'], 400);
    }
    if ($password !== $password2) {
        respond(['error' => 'Passwords do not match'], 400);
    }
    if (strlen($password) < 4) {
        respond(['error' => 'Password too short (min 4 chars)'], 400);
    }
    // ensure username unique
    $check = $pdo->prepare('SELECT id FROM users WHERE username = :u');
    $check->execute([':u' => $username]);
    if ($check->fetch()) {
        respond(['error' => 'Username already exists'], 400);
    }
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $ins = $pdo->prepare('INSERT INTO users (username, password_hash) VALUES (:u, :p)');
    $ins->execute([':u' => $username, ':p' => $hash]);
    $newId = $pdo->lastInsertId();
    // auto-login
    $_SESSION['user_id'] = $newId;
    respond(['ok' => true, 'id' => $newId]);
}

// LOGOUT
if ($action === 'logout') {
    session_destroy();
    respond(['ok' => true]);
}

// CHECK SESSION
if ($action === 'session') {
    respond(['logged' => !empty($_SESSION['user_id'])]);
}

// ABOUT: get and update (single row)
if ($action === 'about_get') {
    $row = $pdo->query('SELECT * FROM about ORDER BY id LIMIT 1')->fetch();
    if ($row) {
        respond($row);
    } else {
        respond([
            'interests' => '',
            'life_motto' => '',
            'bucket_list' => '',
            'strengths' => '',
            'weaknesses' => '',
            'soft_skills' => '',
            'greatest_fear' => ''
        ]);
    }
}

if ($action === 'about_update') {
    require_auth();
    $interests = in('interests', '');
    $life_motto = in('life_motto', '');
    $bucket_list = in('bucket_list', '');
    $strengths = in('strengths', '');
    $weaknesses = in('weaknesses', '');
    $soft_skills = in('soft_skills', '');
    $greatest_fear = in('greatest_fear', '');
    
    // update first row if exists
    $row = $pdo->query('SELECT id FROM about ORDER BY id LIMIT 1')->fetch();
    if ($row) {
        $stmt = $pdo->prepare('UPDATE about SET interests = :i, life_motto = :lm, bucket_list = :bl, strengths = :st, weaknesses = :w, soft_skills = :ss, greatest_fear = :gf WHERE id = :id');
        $stmt->execute([':i' => $interests, ':lm' => $life_motto, ':bl' => $bucket_list, ':st' => $strengths, ':w' => $weaknesses, ':ss' => $soft_skills, ':gf' => $greatest_fear, ':id' => $row['id']]);
    } else {
        $stmt = $pdo->prepare('INSERT INTO about (interests, life_motto, bucket_list, strengths, weaknesses, soft_skills, greatest_fear) VALUES (:i, :lm, :bl, :st, :w, :ss, :gf)');
        $stmt->execute([':i' => $interests, ':lm' => $life_motto, ':bl' => $bucket_list, ':st' => $strengths, ':w' => $weaknesses, ':ss' => $soft_skills, ':gf' => $greatest_fear]);
    }
    respond(['ok' => true]);
}

// SKILLS
if ($action === 'skills_list') {
    $rows = $pdo->query('SELECT * FROM skills ORDER BY id')->fetchAll();
    respond($rows);
}

if ($action === 'skills_create') {
    require_auth();
    $name = in('name', '');
    $level = intval(in('level', 0));
    $meta = in('meta', null);
    $stmt = $pdo->prepare('INSERT INTO skills (name, level, meta) VALUES (:n, :l, :m)');
    $stmt->execute([':n'=>$name,':l'=>$level,':m'=>$meta]);
    respond(['ok' => true, 'id' => $pdo->lastInsertId()]);
}

if ($action === 'skills_update') {
    require_auth();
    $id = intval(in('id', 0));
    $name = in('name', '');
    $level = intval(in('level', 0));
    $meta = in('meta', null);
    $stmt = $pdo->prepare('UPDATE skills SET name=:n,level=:l,meta=:m WHERE id=:id');
    $stmt->execute([':n'=>$name,':l'=>$level,':m'=>$meta,':id'=>$id]);
    respond(['ok'=>true]);
}

if ($action === 'skills_delete') {
    require_auth();
    $id = intval(in('id', 0));
    $stmt = $pdo->prepare('DELETE FROM skills WHERE id = :id');
    $stmt->execute([':id'=>$id]);
    respond(['ok'=>true]);
}

// PROJECTS
if ($action === 'projects_list') {
    $rows = $pdo->query('SELECT * FROM projects ORDER BY id DESC')->fetchAll();
    respond($rows);
}

if ($action === 'projects_create') {
    require_auth();
    $title = in('title', '');
    $description = in('description', '');
    $tech = in('tech', '');
    $link = in('link', '');
    $imagePath = null;
    if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploaddir = __DIR__ . '/uploads';
        if (!is_dir($uploaddir)) mkdir($uploaddir, 0755, true);
        $tmp = $_FILES['image']['tmp_name'];
        $orig = basename($_FILES['image']['name']);
        $ext = pathinfo($orig, PATHINFO_EXTENSION);
        $targetName = uniqid('img_', true) . '.' . $ext;
        $target = $uploaddir . '/' . $targetName;
        if (move_uploaded_file($tmp, $target)) {
            $imagePath = 'uploads/' . $targetName;
        }
    }
    $stmt = $pdo->prepare('INSERT INTO projects (title,description,tech,image,link) VALUES (:t,:d,:tech,:img,:l)');
    $stmt->execute([':t'=>$title,':d'=>$description,':tech'=>$tech,':img'=>$imagePath,':l'=>$link]);
    respond(['ok'=>true,'id'=>$pdo->lastInsertId()]);
}

if ($action === 'projects_update') {
    require_auth();
    $id = intval(in('id', 0));
    $title = in('title', '');
    $description = in('description', '');
    $tech = in('tech', '');
    $link = in('link', '');

    // handle optional new image upload
    $imagePath = null;
    if (!empty($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploaddir = __DIR__ . '/uploads';
        if (!is_dir($uploaddir)) mkdir($uploaddir, 0755, true);
        $tmp = $_FILES['image']['tmp_name'];
        $orig = basename($_FILES['image']['name']);
        $ext = pathinfo($orig, PATHINFO_EXTENSION);
        $targetName = uniqid('img_', true) . '.' . $ext;
        $target = $uploaddir . '/' . $targetName;
        if (move_uploaded_file($tmp, $target)) {
            $imagePath = 'uploads/' . $targetName;
            // remove old file
            $row = $pdo->prepare('SELECT image FROM projects WHERE id = :id');
            $row->execute([':id'=>$id]);
            $r = $row->fetch();
            if ($r && $r['image']) { $f = __DIR__ . '/' . $r['image']; if (file_exists($f)) @unlink($f); }
        }
    }

    if ($imagePath !== null) {
        $stmt = $pdo->prepare('UPDATE projects SET title=:t,description=:d,tech=:tech,image=:img,link=:l WHERE id = :id');
        $stmt->execute([':t'=>$title,':d'=>$description,':tech'=>$tech,':img'=>$imagePath,':l'=>$link,':id'=>$id]);
    } else {
        $stmt = $pdo->prepare('UPDATE projects SET title=:t,description=:d,tech=:tech,link=:l WHERE id = :id');
        $stmt->execute([':t'=>$title,':d'=>$description,':tech'=>$tech,':l'=>$link,':id'=>$id]);
    }
    respond(['ok'=>true]);
}

if ($action === 'projects_delete') {
    require_auth();
    $id = intval(in('id', 0));
    // remove file if exists
    $row = $pdo->prepare('SELECT image FROM projects WHERE id = :id');
    $row->execute([':id'=>$id]);
    $r = $row->fetch();
    if ($r && $r['image']) {
        $f = __DIR__ . '/' . $r['image'];
        if (file_exists($f)) @unlink($f);
    }
    $stmt = $pdo->prepare('DELETE FROM projects WHERE id = :id');
    $stmt->execute([':id'=>$id]);
    respond(['ok'=>true]);
}

// EDUCATION
if ($action === 'education_list') {
    $rows = $pdo->query('SELECT * FROM education ORDER BY id DESC')->fetchAll();
    respond($rows);
}

if ($action === 'education_create') {
    require_auth();
    $category = in('category', 'education');
    if (!in_array($category, ['education','certification'])) $category = 'education';
    $title = in('title', '');
    $institution = in('institution', '');
    $description = in('description', '');
    $year = in('year', '');
    $link = in('link', '');
    $stmt = $pdo->prepare('INSERT INTO education (category,title,institution,description,year,link) VALUES (:c,:t,:i,:d,:y,:l)');
    $stmt->execute([':c'=>$category,':t'=>$title,':i'=>$institution,':d'=>$description,':y'=>$year,':l'=>$link]);
    respond(['ok'=>true,'id'=>$pdo->lastInsertId()]);
}

if ($action === 'education_update') {
    require_auth();
    $id = intval(in('id', 0));
    $category = in('category', 'education');
    if (!in_array($category, ['education','certification'])) $category = 'education';
    $title = in('title', '');
    $institution = in('institution', '');
    $description = in('description', '');
    $year = in('year', '');
    $link = in('link', '');
    $stmt = $pdo->prepare('UPDATE education SET category=:c,title=:t,institution=:i,description=:d,year=:y,link=:l WHERE id=:id');
    $stmt->execute([':c'=>$category,':t'=>$title,':i'=>$institution,':d'=>$description,':y'=>$year,':l'=>$link,':id'=>$id]);
    respond(['ok'=>true]);
}

if ($action === 'education_delete') {
    require_auth();
    $id = intval(in('id', 0));
    $stmt = $pdo->prepare('DELETE FROM education WHERE id = :id');
    $stmt->execute([':id'=>$id]);
    respond(['ok'=>true]);
}

// Default
http_response_code(400);
respond(['error' => 'Invalid action'], 400);
