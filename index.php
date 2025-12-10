<?php 
session_start(); 
$logged = !empty($_SESSION['user_id']); 
// Require login to view this page
if (!$logged) {
    header('Location: login.php');
    exit;
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume — </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">   
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=Merriweather:wght@300;400;700&family=Patrick+Hand&family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
    <style>
     
      html,body{
        font-family: 'Merriweather', 'Cormorant Garamond', 'Garamond', serif;
        font-size:17px;
        line-height:1.65;
        color:#111;
        scroll-behavior:smooth;
        -webkit-font-smoothing:antialiased;
        -moz-osx-font-smoothing:grayscale;
      }
      h1,h2,h3,h4{font-family:'Cormorant Garamond','Garamond',serif;font-weight:600;color:#0b0b0b;letter-spacing:0.1px}
      .nav-brand-initials{width:40px;height:40px;border-radius:50%;background:rgba(255,255,255,0.12);display:inline-flex;align-items:center;justify-content:center;font-weight:700}
      .skill-row .skill-actions{display:none}
      .skill-row:hover .skill-actions{display:inline-flex}
      .skill-row{transition:background .12s}
      .skill-row:hover{background:rgba(0,0,0,0.02)}
      .edu-row .edu-actions{display:none}
      .edu-row:hover .edu-actions{display:inline-flex}
      .edu-row{transition:background .12s}
      .edu-row:hover{background:rgba(0,0,0,0.02)}
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="#">
          <span class="nav-brand-initials">SI</span>
          <span class="d-none d-md-inline" style="font-family:Poppins,system-ui;letter-spacing:0.2px">Welcome! I'm Shane.</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav" aria-controls="nav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#skills">Skills</a></li>
            <li class="nav-item"><a class="nav-link" href="#projects">Projects</a></li>
            <li class="nav-item"><a class="nav-link" href="#education">Education</a></li>
            <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
          </ul>
          <div class="d-flex ms-3">
            <a class="btn btn-outline-light btn-sm" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </nav>

    <header class="py-5 bg-light">
      <div class="container d-md-flex align-items-center gap-4">
        <img src="images/2x2.png" alt="Profile placeholder" class="rounded-circle profile-img mb-3 mb-md-0">
        <div>
          <h1 class="mb-1 handwritten">Shane Marie M. Ignacio</h1>
          <p class="lead mb-1">Aspiring Software Engineer — Open to internships and junior roles</p>
          <div class="mt-2" style="height:8px;width:140px;border-radius:8px;background:linear-gradient(90deg,var(--accent),var(--accent-2));opacity:0.95"></div>
          <p class="text-muted mb-0">Location: [General Trias City, Cavite] • Email: <a href="shaneignacio000@gmail.com">shaneignacio000@gmail.com.com</a></p>
        </div>
      </div>
    </header>

    <main class="container my-5">
      <section id="about" class="mb-5">
        <h2 class="mb-3">About</h2>
        <div class="card shadow-sm">
          <div class="card-body">
            <!-- Dynamic content loaded from API -->
          </div>
        </div>
        <?php if($logged): ?>
          <div class="mt-2"><button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#aboutModal">Edit About</button></div>
        <?php endif; ?>
      </section>

      <section id="skills" class="mb-5">
    <h2 class="mb-3"><i class="bi bi-tools me-2"></i>Technical Skills</h2>
    
    <div class="card shadow-sm">
        <div class="card-body" id="skillsContainer">
            <!-- Dynamic skills loaded from API -->
        </div>
    </div>

    <?php if($logged): ?>
        <div class="mt-2">
            <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#skillModal">
                Add Skill
            </button>
        </div>
    <?php endif; ?>
    </section>


    <section id="projects" class="mb-5">
        <h2 class="mb-3">Projects</h2>

        <div class="row gy-4" id="projectsContainer">
            <!-- Dynamic projects will be loaded here -->
        </div>

        <?php if($logged): ?>
            <div class="mt-2">
                <button class="btn btn-sm btn-secondary" data-bs-toggle="modal" data-bs-target="#projectModal">
                    Add Project
                </button>
            </div>
        <?php endif; ?>
    </section>


    <section id="education" class="mb-5">
      <h2 class="mb-3">Education & Certifications</h2>

      <div class="card shadow-sm">
        <div class="card-body">

          <!-- EDUCATION LIST -->
          <h5>Formal Education</h5>
          <ul>
            <?php if (!empty($education_list)): ?>
              <?php foreach($education_list as $edu): ?>
                <li>
                  <strong><?= htmlspecialchars($edu['degree']) ?></strong>
                  — <?= htmlspecialchars($edu['school']) ?>,
                  <?= htmlspecialchars($edu['year']) ?>
                </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>No education records available.</li>
            <?php endif; ?>
          </ul>

          <!-- CERTIFICATIONS LIST -->
          <h5 class="mt-3">Certifications</h5>
          <ul>
            <?php if (!empty($cert_list)): ?>
              <?php foreach($cert_list as $cert): ?>
                <li><?= htmlspecialchars($cert['cert_name']) ?></li>
              <?php endforeach; ?>
            <?php else: ?>
              <li>No certifications uploaded yet.</li>
            <?php endif; ?>
          </ul>

        </div>
      </div>

      <?php if($logged): ?>
        <div class="mt-2">
          <button class="btn btn-sm btn-secondary"
                  data-bs-toggle="modal"
                  data-bs-target="#eduModal">
            Add Education/Cert
          </button>
        </div>
      <?php endif; ?>
    </section>


      <section id="contact" class="mb-5">
        <h2 class="mb-3">Contact</h2>
        <div class="card shadow-sm">
          <div class="card-body">
            <p>Contact me through the following:</p>
            <p><strong>Email:</strong> <a href="https://mail.google.com/mail/u/1/?ogbl#inbox">shaneignacio000@gmail.com</a></p>
            <p><strong>LinkedIn:</strong> <a href="https://www.linkedin.com/in/shane-ignacio-072696399/">linkedin.com/in/shaneignacio</a></p>
            <p><strong>GitHub:</strong> <a href="https://github.com/shnpai">github.com/shnpai</a></p>
            
          </div>
        </div>
      </section>
    </main>

    <footer class="py-4 bg-dark text-light">
      <div class="container text-center small">
        © [2025] [Ignacio]. Resume.
      </div>
    </footer>

    <div class="back-to-top" id="backToTop" title="Back to top" style="display:none">
      <i class="bi bi-arrow-up" style="font-size:1.1rem"></i>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
      const backBtn = document.getElementById('backToTop');
      window.addEventListener('scroll', ()=>{
        if(window.scrollY > 300) backBtn.style.display = 'flex'; else backBtn.style.display = 'none';
      });
      backBtn.addEventListener('click', ()=>window.scrollTo({top:0,behavior:'smooth'}));

      // Load dynamic content from API and replace static sections (falls back to static if API unavailable)
      $(function(){
        // Are we an admin (logged-in)? Used to show edit/delete controls
        var isAdmin = <?php echo $logged ? 'true' : 'false'; ?>;
        // Default fallback data (used when DB has no entries yet)
        var defaultSkills = [
          {name:'JavaScript', level:75, meta:'language'},
          {name:'PHP', level:80, meta:'language'},
          {name:'Python', level:60, meta:'language'},
          {name:'CodeIgniter4', level:70, meta:'framework'},
          {name:'PhpMyAdmin', level:80, meta:'tool'},
          {name:'MySQL', level:70, meta:'tool'},
          {name:'Git', level:75, meta:'tool'}
        ];
        var defaultProjects = [
          {title:'Project 1 — Point of Sales System', description:'Created a landing page of a restaurant and its POS.', tech:'PHP, HTML, Javascript', image:'images/POS-ss.png', link:'https://github.com/shnpai/Barcade-JS-pos'},
          {title:'Project 2 — Order Kiosk With Jquery', description:'The kiosk-like web app with an “add-to-cart” feature before proceeding to finalize the orders and paying for them.', tech:'PHP, Jquery, Tailwind CSS', image:'images/Kiosk-ss.png', link:'https://github.com/shnpai/Kiosk-JQuery'},
          {title:'Project 3 — FindHire Application', description:'A web application for Job Listing with user and admin\'s end.', tech:'PHP, HTML, CSS', image:'images/Job-ss.png', link:'https://github.com/shnpai/findhire-finalproject'},
          {title:'System User Management', description:'A system user management for softwares used by the company.', tech:'Javascript, CodeIgniter4, PHP', image:'images/System-ss.png', link:'#'}
        ];
        var defaultEducation = [
          {title:'Bachelor of Science in Computer Science', institution:'Emilio Aguinaldo College-Cavite', year:'2026', description:'Thesis Project: Brain Fog Monitoring System', category:'education'},
          {title:'Senior High School', institution:'Emilio Aguinaldo College-Cavite', year:'2021', description:'', category:'education'},
          {title:'Certificate of Completion Intership - Software Development', institution:'', year:'', description:'', category:'certification'},
          {title:'freeCodeCamp Front End Development Libraries Certification', institution:'', year:'', description:'', category:'certification'}
        ];

        $.get('api.php?action=about_get').done(function(d){
          if(d){
            var html = '';
            if(d.interests) html += '<p><strong>Interests:</strong> ' + $('<div/>').text(d.interests).html() + '</p>';
            if(d.life_motto) html += '<p><strong>Life motto:</strong> ' + $('<div/>').text(d.life_motto).html() + '</p>';
            if(d.bucket_list) html += '<p><strong>Bucket list:</strong> ' + $('<div/>').text(d.bucket_list).html() + '</p>';
            if(d.strengths) html += '<p><strong>Strengths:</strong> ' + $('<div/>').text(d.strengths).html() + '</p>';
            if(d.weaknesses) html += '<p><strong>Weaknesses:</strong> ' + $('<div/>').text(d.weaknesses).html() + '</p>';
            if(d.soft_skills) html += '<p><strong>Soft Skills:</strong> ' + $('<div/>').text(d.soft_skills).html() + '</p>';
            if(d.greatest_fear) html += '<p><strong>Greatest fear:</strong> ' + $('<div/>').text(d.greatest_fear).html() + '</p>';
            if(html) {
              html += '<div class="mt-3"><span class="tag tag--pink">Open to internships</span><span class="tag tag--blue">Software Engineer</span><span class="tag tag--green">Team player</span></div>';
              $('#about .card-body').html(html);
            }
          }
        });

        function loadSkills(){
          $.get('api.php?action=skills_list').done(function(list){
            if(!Array.isArray(list) || !list.length) list = defaultSkills;
            if(!Array.isArray(list)) list = [];
            var langs = [], tools = [];
            list.forEach(function(s){
              var meta = (s.meta||'').toString().toLowerCase();
              if(meta.indexOf('tool') !== -1 || meta.indexOf('framework') !== -1 || meta.indexOf('lib') !== -1) {
                tools.push(s);
              } else {
                langs.push(s);
              }
            });

            var html = '';
            if(langs.length){
              html += '<h6 class="mb-2">Languages</h6>';
              langs.forEach(function(s){
                var id = s.id || '';
                var nameHtml = '<small>'+escapeHtml(s.name)+'</small>';
                var actions = '';
                // show delete only for DB rows
                if(isAdmin && id){
                  actions = '<span class="skill-actions ms-2">'
                          + '<button type="button" class="btn btn-sm btn-outline-danger skill-delete" data-id="'+id+'" title="Delete"><i class="bi bi-trash"></i></button>'
                          + '</span>';
                }
                html += '<div class="mb-3 skill-row" data-id="'+(id)+'" data-name="'+escapeHtml(s.name)+'" data-level="'+(s.level||'')+'" data-meta="'+escapeHtml(s.meta||'')+'">'
                      + '<div class="d-flex justify-content-between align-items-center">'
                      + '<div class="d-flex align-items-center">'+nameHtml+actions+'</div>'
                      + '<small>'+(s.level||'')+'%</small>'
                      + '</div>'
                      + '<div class="progress" style="height:10px"><div class="progress-bar bg-info" role="progressbar" style="width:'+ (s.level||0) +'%"></div></div>'
                      + '</div>';
              });
            }

            if(tools.length){
              html += '<h6 class="mt-4 mb-2">Frameworks & Tools</h6><div class="row g-3">';
              tools.forEach(function(t){
                var pct = t.level || 70;
                var toolHtml = '<div class="small text-muted">'+escapeHtml(t.name)+'</div>';
                html += '<div class="col-6 col-md-3 text-center">'+toolHtml+'<div class="progress mt-2" style="height:8px"><div class="progress-bar" role="progressbar" style="width:'+pct+'%"></div></div></div>';
              });
              html += '</div>';
            }

            $('#skills .card-body').html(html);
          }).fail(function(){
            // on error, render defaults
            $('#skills .card-body').html('<h6 class="mb-2">Languages</h6>' + (function(){ var out=''; defaultSkills.forEach(function(s){ out += '<div class="mb-3"><div class="d-flex justify-content-between align-items-center"><div>'+escapeHtml(s.name)+'</div><small>'+(s.level||'')+'%</small></div><div class="progress" style="height:10px"><div class="progress-bar bg-info" role="progressbar" style="width:'+ (s.level||0) +'%"></div></div></div>'; }); return out; })());
          });
        }
        // initial load
        loadSkills();

        $.get('api.php?action=projects_list').done(function(list){
          if(!Array.isArray(list) || !list.length) list = defaultProjects;
          if(Array.isArray(list) && list.length){
            var html = '<div class="row gy-4">';
            list.forEach(function(p){
              html += '<div class="col-md-6"><div class="card h-100 shadow-sm">';
              if(p.image) html += '<img src="'+p.image+'" class="card-img-top" alt="'+escapeHtml(p.title)+'">';
              html += '<div class="card-body d-flex flex-column card-accent"><h5 class="card-title">'+escapeHtml(p.title)+'</h5><p class="card-text">'+(p.description||'')+'</p><p class="mb-1"><strong>Tech:</strong> '+(p.tech||'')+'</p><div class="mt-auto">';
              if(p.link) html += '<a href="'+p.link+'" class="btn btn-sm" style="background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;border:0">Repo</a>';
              if(isAdmin && p.id) html += ' <button type="button" class="btn btn-sm btn-outline-secondary project-edit ms-2" data-id="'+p.id+'" data-title="'+escapeHtml(p.title)+'" data-tech="'+escapeHtml(p.tech||'')+'" data-link="'+escapeHtml(p.link||'')+'" data-description="'+escapeHtml(p.description||'')+'" data-image="'+escapeHtml(p.image||'')+'">Edit</button> <button type="button" class="btn btn-sm btn-outline-danger project-delete ms-2" data-id="'+p.id+'">Delete</button>';
              html += '</div></div></div></div>';
            });
            html += '</div>';
            // Replace existing projects row (or append if missing)
            if($('#projects .row').first().length) {
              $('#projects .row').first().replaceWith(html);
            } else {
              $('#projects .card').first().closest('.row').replaceWith(html);
            }
          }
        });

        $.get('api.php?action=education_list').done(function(list){
          if(!Array.isArray(list) || !list.length) list = defaultEducation;
          if(Array.isArray(list) && list.length){
            var html = '<div class="card shadow-sm"><div class="card-body">';
            var ed = list.filter(e=> e.category === 'education');
            var cert = list.filter(e=> e.category === 'certification');
            if(ed.length){ 
              html += '<h5>Formal Education</h5>'; 
              ed.forEach(function(e){ 
                var actions = '';
                if(isAdmin && e.id){
                  actions = ' <span class="edu-actions ms-2">'
                          + '<button type="button" class="btn btn-sm btn-outline-secondary edu-edit ms-1" data-id="'+e.id+'" data-category="'+e.category+'" data-title="'+escapeHtml(e.title)+'" data-institution="'+escapeHtml(e.institution||'')+'" data-year="'+escapeHtml(e.year||'')+'" data-description="'+escapeHtml(e.description||'')+'" data-link="'+escapeHtml(e.link||'')+'" title="Edit"><i class="bi bi-pencil"></i></button>'
                          + '<button type="button" class="btn btn-sm btn-outline-danger edu-delete ms-1" data-id="'+e.id+'" title="Delete"><i class="bi bi-trash"></i></button>'
                          + '</span>';
                }
                html += '<p class="edu-row" data-id="'+(e.id||'')+'">'
                      + '<strong>'+escapeHtml(e.title)+'</strong> — '+(e.institution||'')+' '+(e.year?(' — '+e.year):'')+actions
                      + '<br>'+(e.description||'')
                      + '</p>'; 
              }); 
            }
            if(cert.length){ 
              html += '<h5 class="mt-3">Certifications</h5><ul>'; 
              cert.forEach(function(c){ 
                var actions = '';
                if(isAdmin && c.id){
                  actions = ' <span class="edu-actions ms-2">'
                          + '<button type="button" class="btn btn-sm btn-outline-secondary edu-edit ms-1" data-id="'+c.id+'" data-category="'+c.category+'" data-title="'+escapeHtml(c.title)+'" data-institution="'+escapeHtml(c.institution||'')+'" data-year="'+escapeHtml(c.year||'')+'" data-description="'+escapeHtml(c.description||'')+'" data-link="'+escapeHtml(c.link||'')+'" title="Edit"><i class="bi bi-pencil"></i></button>'
                          + '<button type="button" class="btn btn-sm btn-outline-danger edu-delete ms-1" data-id="'+c.id+'" title="Delete"><i class="bi bi-trash"></i></button>'
                          + '</span>';
                }
                html += '<li class="edu-row" data-id="'+(c.id||'')+'">'+escapeHtml(c.title)+actions+'</li>'; 
              }); 
              html += '</ul>'; 
            }
            html += '</div></div>';
            $('#education .card').replaceWith(html);
          }
        });

        function escapeHtml(s){ return String(s||'').replace(/[&<>"]'/g,function(m){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];}); }

        // Delete handlers (delegated)
        $(document).on('click', '.skill-delete', function(){
          if(!confirm('Delete this skill?')) return;
          var id = $(this).data('id');
          $.post('api.php?action=skills_delete', {id: id}).done(function(){
            location.reload();
          }).fail(function(){ alert('Delete failed'); });
        });

        $(document).on('click', '.project-delete', function(){
          if(!confirm('Delete this project?')) return;
          var id = $(this).data('id');
          $.post('api.php?action=projects_delete', {id: id}).done(function(){
            location.reload();
          }).fail(function(){ alert('Delete failed'); });
        });

        $(document).on('click', '.edu-edit', function(e){
          e.preventDefault();
          e.stopPropagation();
          if(!isAdmin) return;
          var btn = $(this);
          var id = btn.attr('data-id') || '';
          var category = btn.attr('data-category') || 'education';
          var title = btn.attr('data-title') || '';
          var institution = btn.attr('data-institution') || '';
          var year = btn.attr('data-year') || '';
          var description = btn.attr('data-description') || '';
          var link = btn.attr('data-link') || '';
          
          $('#eduModal input[name="title"]').val(title);
          $('#eduModal select[name="category"]').val(category);
          $('#eduModal input[name="institution"]').val(institution);
          $('#eduModal input[name="year"]').val(year);
          $('#eduModal input[name="description"]').val(description);
          $('#eduModal input[name="link"]').val(link);
          $('#eduModal input[name="id"]').val(id);
          
          $('#eduModal .modal-title').text(id ? 'Edit Education / Certification' : 'Add Education / Certification');
          $('#eduModal form').attr('action', id ? 'api.php?action=education_update' : 'api.php?action=education_create');
          $('#eduModal [type="submit"]').text(id ? 'Update' : 'Add');
          
          var modalEl = document.getElementById('eduModal');
          var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
          modal.show();
        });

        $(document).on('click', '.edu-delete', function(){
          if(!confirm('Delete this education entry?')) return;
          var id = $(this).data('id');
          $.post('api.php?action=education_delete', {id: id}).done(function(){
            location.reload();
          }).fail(function(){ alert('Delete failed'); });
        });
      });
    </script>

    <!-- Modals -->
    

    <!-- About Modal -->
    <div class="modal fade" id="aboutModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="post" action="api.php?action=about_update">
            <div class="modal-header"><h5 class="modal-title">Edit About</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
              <div class="mb-3">
                <label class="form-label">Interests:</label>
                <input type="text" name="interests" id="interests" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Life motto:</label>
                <input type="text" name="life_motto" id="life_motto" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Bucket list:</label>
                <input type="text" name="bucket_list" id="bucket_list" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Strengths:</label>
                <input type="text" name="strengths" id="strengths" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Weaknesses:</label>
                <input type="text" name="weaknesses" id="weaknesses" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Soft Skills:</label>
                <input type="text" name="soft_skills" id="soft_skills" class="form-control">
              </div>
              <div class="mb-3">
                <label class="form-label">Greatest fear:</label>
                <input type="text" name="greatest_fear" id="greatest_fear" class="form-control">
              </div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary">Save</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
          </form>
        </div>
      </div>
    </div>

    <!-- Skill Modal -->
    <div class="modal fade" id="skillModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="post" action="api.php?action=skills_create" id="skillFormModal">
            <input type="hidden" name="id" value="" />
            <div class="modal-header"><h5 class="modal-title">Add Skill</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
              <div class="mb-2"><input name="name" class="form-control" placeholder="Skill name" required></div>
              <div class="mb-2"><input name="level" class="form-control" placeholder="Level (0-100)"></div>
              <div class="mb-2">
                <select name="meta" class="form-select">
                  <option value="">Category (optional)</option>
                  <option value="language">Language</option>
                  <option value="tool">Tool</option>
                  <option value="framework">Framework</option>
                  <option value="other">Other</option>
                </select>
              </div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary" id="skillModalSubmit">Add</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
          </form>
        </div>
      </div>
    </div>

    <!-- Project Modal -->
    <div class="modal fade" id="projectModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="post" action="api.php?action=projects_create" enctype="multipart/form-data" id="projectFormModal">
            <input type="hidden" name="id" value="" />
            <div class="modal-header"><h5 class="modal-title">Add Project</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
              <div class="mb-2"><input name="title" class="form-control" placeholder="Title" required></div>
              <div class="mb-2"><input name="tech" class="form-control" placeholder="Tech"></div>
              <div class="mb-2"><input name="link" class="form-control" placeholder="Link (optional)"></div>
              <div class="mb-2"><textarea name="description" class="form-control" placeholder="Description"></textarea></div>
              <div class="mb-2"><input type="file" name="image" accept="image/*" class="form-control"></div>
              <div class="mb-2"><img id="projectImagePreview" src="" style="max-width:120px;display:none" alt="Current image"></div>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" id="projectModalSubmit">Add</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
          </form>
        </div>
      </div>
    </div>

    <!-- Education Modal -->
    <div class="modal fade" id="eduModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <form method="post" action="api.php?action=education_create">
            <input type="hidden" name="id" value="" />
            <div class="modal-header"><h5 class="modal-title">Add Education / Certification</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
              <div class="mb-2"><select name="category" class="form-control"><option value="education">Education</option><option value="certification">Certification</option></select></div>
              <div class="mb-2"><input name="title" class="form-control" placeholder="Title" required></div>
              <div class="mb-2"><input name="institution" class="form-control" placeholder="Institution"></div>
              <div class="mb-2"><input name="year" class="form-control" placeholder="Year"></div>
              <div class="mb-2"><input name="link" class="form-control" placeholder="Link (optional)"></div>
              <div class="mb-2"><input name="description" class="form-control" placeholder="Description"></div>
            </div>
            <div class="modal-footer"><button type="submit" class="btn btn-primary">Add</button><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // Prefill About modal with current about data
      var aboutModal = document.getElementById('aboutModal');
      if (aboutModal) {
        aboutModal.addEventListener('show.bs.modal', function () {
          $.get('api.php?action=about_get').done(function(d){
            if(d){
              document.getElementById('interests').value = d.interests || '';
              document.getElementById('life_motto').value = d.life_motto || '';
              document.getElementById('bucket_list').value = d.bucket_list || '';
              document.getElementById('strengths').value = d.strengths || '';
              document.getElementById('weaknesses').value = d.weaknesses || '';
              document.getElementById('soft_skills').value = d.soft_skills || '';
              document.getElementById('greatest_fear').value = d.greatest_fear || '';
            }
          });
        });
      }

      // Skill edit handler (single-click pencil icon)
      $(document).on('click', '.skill-edit', function(e){
        e.preventDefault();
        e.stopPropagation();
        if(!isAdmin) return;
        var btn = $(this);
        var id = btn.attr('data-id') || '';
        var name = btn.attr('data-name') || '';
        var level = btn.attr('data-level') || '';
        var meta = btn.attr('data-meta') || '';
        
        // Pre-fill form
        if(id){
          $('#skillFormModal').attr('action','api.php?action=skills_update');
          $('#skillFormModal input[name="id"]').val(id);
        } else {
          $('#skillFormModal').attr('action','api.php?action=skills_create');
          $('#skillFormModal input[name="id"]').val('');
        }
        $('#skillFormModal input[name="name"]').val(name);
        $('#skillFormModal input[name="level"]').val(level);
        $('#skillFormModal select[name="meta"]').val(meta);
        $('#skillModal .modal-title').text(id? 'Edit Skill' : 'Add Skill');
        $('#skillModalSubmit').text(id? 'Save' : 'Add');
        
        // Show modal safely using getInstance pattern
        var modalEl = document.getElementById('skillModal');
        var modal = bootstrap.Modal.getInstance(modalEl) || new bootstrap.Modal(modalEl);
        modal.show();
      });

      // Reset skill modal to create mode when hidden
      $('#skillModal').on('hidden.bs.modal', function(){
        $('#skillFormModal').attr('action','api.php?action=skills_create');
        $('#skillFormModal input[name="id"]').val('');
        $('#skillFormModal')[0].reset();
        $('#skillModal .modal-title').text('Add Skill');
        $('#skillModalSubmit').text('Add');
      });

      // Project edit handler
      $(document).on('click', '.project-edit', function(){
        var btn = $(this);
        var id = btn.attr('data-id');
        var title = btn.attr('data-title');
        var tech = btn.attr('data-tech');
        var link = btn.attr('data-link');
        var description = btn.attr('data-description');
        var image = btn.attr('data-image');
        var modal = new bootstrap.Modal(document.getElementById('projectModal'));
        $('#projectFormModal').attr('action','api.php?action=projects_update');
        $('#projectFormModal input[name="id"]').val(id);
        $('#projectFormModal input[name="title"]').val(title);
        $('#projectFormModal input[name="tech"]').val(tech);
        $('#projectFormModal input[name="link"]').val(link);
        $('#projectFormModal textarea[name="description"]').val(description);
        if(image){ $('#projectImagePreview').attr('src', image).show(); } else { $('#projectImagePreview').hide(); }
        $('#projectModal .modal-title').text('Edit Project');
        $('#projectModalSubmit').text('Save');
        modal.show();
      });

      // Reset project modal to create mode when hidden
      $('#projectModal').on('hidden.bs.modal', function(){
        $('#projectFormModal').attr('action','api.php?action=projects_create');
        $('#projectFormModal input[name="id"]').val('');
        $('#projectFormModal')[0].reset();
        $('#projectImagePreview').hide().attr('src','');
        $('#projectModal .modal-title').text('Add Project');
        $('#projectModalSubmit').text('Add');
      });

      // Reset education modal to create mode when hidden
      $('#eduModal').on('hidden.bs.modal', function(){
        var form = $('#eduModal form')[0];
        form.action = 'api.php?action=education_create';
        form.reset();
        $('#eduModal input[name="id"]').val('');
        $('#eduModal .modal-title').text('Add Education / Certification');
        $('#eduModal [type="submit"]').text('Add');
      });
    </script>
  </body>
</html>
