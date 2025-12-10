<?php
session_start();
if (!empty($_SESSION['user_id'])) {
    header('Location: index.php'); exit;
}

$status = $_GET['status'] ?? '';
?>
<!doctype html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Login / Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
      body{background:#f5f7fb}
      .auth-card{max-width:820px;margin:48px auto;padding:0;border-radius:12px;overflow:hidden;box-shadow:0 8px 30px rgba(18,38,63,0.08)}
      .auth-left{background:linear-gradient(180deg,#0d6efd,#6610f2);color:#fff;padding:32px 28px}
      .brand-initial{width:56px;height:56px;border-radius:12px;background:rgba(255,255,255,0.12);display:flex;align-items:center;justify-content:center;font-weight:700;font-size:20px}
      .small-muted{opacity:0.85;color:rgba(255,255,255,0.9)}
      @media(max-width:767px){.auth-card{margin:20px 16px} .auth-left{padding:20px}}
    </style>
  </head>
  <body>
    <div class="auth-card d-flex">
      <div class="auth-left flex-shrink-0" style="width:360px">
        <div class="d-flex align-items-center gap-3 mb-3">
          <div class="brand-initial">SI</div>
          <div>
            <h4 class="mb-0">Shane Ignacio</h4>
            <div class="small-muted">Resume Admin Portal</div>
          </div>
        </div>
        <p class="mt-3">Manage your resume content (About, Skills, Projects, Education). Use a simple account to login and update content. Keep your credentials safe.</p>
        <div class="mt-4"><a href="public.php" class="btn btn-outline-light btn-sm">View Public Site</a></div>
      </div>

      <div class="flex-grow-1 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h5 class="mb-0">Access</h5>
        </div>

        <?php if($status): ?>
          <div class="alert alert-info"><?=htmlspecialchars($status)?></div>
        <?php endif; ?>

        <ul class="nav nav-pills mb-3" id="authTabs" role="tablist">
          <li class="nav-item" role="presentation"><button class="nav-link active" id="login-tab" data-bs-toggle="pill" data-bs-target="#login-pane" type="button">Sign in</button></li>
          <li class="nav-item" role="presentation"><button class="nav-link" id="reg-tab" data-bs-toggle="pill" data-bs-target="#reg-pane" type="button">Register</button></li>
        </ul>

        <div class="tab-content">
          <div class="tab-pane fade show active" id="login-pane">
            <form method="post" action="api.php?action=login">
              <div class="mb-3"><label class="form-label">Username</label><input name="username" class="form-control" required autofocus></div>
              <div class="mb-3 position-relative">
                <label class="form-label">Password</label>
                <input id="loginPass" name="password" type="password" class="form-control" required>
                <button type="button" class="btn btn-sm btn-light position-absolute" style="right:8px;top:36px" onclick="togglePass('loginPass', this)">Show</button>
              </div>
              <div class="d-flex gap-2"><button class="btn btn-primary">Login</button><a href="index.php"</a></div>
            </form>
          </div>

          <div class="tab-pane fade" id="reg-pane">
            <form method="post" action="api.php?action=register" id="regForm">
              <div class="mb-3"><label class="form-label">Username</label><input name="username" class="form-control" required></div>
              <div class="mb-3 position-relative"><label class="form-label">Password</label><input id="regPass" name="password" type="password" class="form-control" required></div>
              <div class="mb-3 position-relative"><label class="form-label">Confirm Password</label><input id="regPass2" name="password2" type="password" class="form-control" required></div>
              <div id="regError" class="text-danger small mb-2" style="display:none"></div>
              <div><button class="btn btn-success">Create account</button></div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      function togglePass(id, btn){
        var f = document.getElementById(id);
        if(f.type === 'password'){ f.type='text'; btn.textContent='Hide'; } else { f.type='password'; btn.textContent='Show'; }
      }
      document.getElementById('regForm').addEventListener('submit', function(e){
        var p1 = document.getElementById('regPass').value || '';
        var p2 = document.getElementById('regPass2').value || '';
        var err = document.getElementById('regError');
        if(p1 !== p2){ e.preventDefault(); err.style.display='block'; err.textContent='Passwords do not match'; return false; }
        if(p1.length < 4){ e.preventDefault(); err.style.display='block'; err.textContent='Password too short (min 4 chars)'; return false; }
      });
    </script>
  </body>
</html>
