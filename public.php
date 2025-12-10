<?php 
// Public resume view - no login required
session_start();
$logged = !empty($_SESSION['user_id']);
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Resume — Shane Ignacio</title>
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
    </style>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
      <div class="container">
        <a class="navbar-brand d-flex align-items-center gap-2" href="public.php">
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
            <?php if($logged): ?>
              <a class="btn btn-outline-light btn-sm" href="index.php">Edit Resume</a>
            <?php else: ?>
              <a class="btn btn-outline-light btn-sm" href="login.php">Admin</a>
            <?php endif; ?>
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
          <p class="text-muted mb-0">Location: [General Trias City, Cavite] • Email: <a href="shaneignacio000@gmail.com">shaneignacio000@gmail.com</a></p>
        </div>
      </div>
    </header>

    <main class="container my-5">
      <section id="about" class="mb-5">
        <h2 class="mb-3">About</h2>
        <div class="card shadow-sm">
          <div class="card-body">
              <p><strong>Interests: Strategic Games, Personal Coding Projects, Team Sports</p>
            <p><strong>Life motto:</strong> "If the shoe doesn't fit, don't force it."</p>
            <p><strong>Bucket list:</strong> Build a profitable business, Travel, Buy own car</p>
            <p><strong>Strengths:</strong> Problem-solving, Teamwork, Perseverance</p>
            <p><strong>Weaknesses:</strong> Working on prioritization, Struggling with Public Speaking</p>
              <p><strong>Soft Skills:</strong> Adaptability, Project Management, Technical Skills </p>
              <p><strong>Greatest fear:</strong> Fear of failure</p>
              <div class="mt-3">
                <span class="tag tag--pink">Open to internships</span>
                <span class="tag tag--blue">Software Engineer</span>
                <span class="tag tag--green">Team player</span>
              </div>
          </div>
        </div>
      </section>

      <section id="skills" class="mb-5">
        <h2 class="mb-3"><i class="bi bi-tools me-2"></i>Technical Skills</h2>
        <div class="card shadow-sm">
          <div class="card-body">
              <h6 class="mb-2">Languages</h6>
              <div class="mb-3">
                <div class="d-flex justify-content-between"><small>JavaScript</small><small>75%</small></div>
                <div class="progress" style="height:10px"><div class="progress-bar bg-info" role="progressbar" style="width:75%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div></div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between"><small>PHP</small><small>80%</small></div>
                <div class="progress" style="height:10px"><div class="progress-bar bg-primary" role="progressbar" style="width:80%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div></div>
              </div>
              <div class="mb-3">
                <div class="d-flex justify-content-between"><small>Python</small><small>60%</small></div>
                <div class="progress" style="height:10px"><div class="progress-bar bg-success" role="progressbar" style="width:60%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div></div>
              </div>

              <h6 class="mt-4 mb-2">Frameworks & Tools</h6>
              <div class="row g-3">
                <div class="col-6 col-md-3 text-center">
                  <div class="small text-muted">CodeIgniter4</div>
                  <div class="progress" style="height:8px"><div class="progress-bar bg-warning" style="width:70%"></div></div>
                </div>
                <div class="col-6 col-md-3 text-center">
                  <div class="small text-muted">PhpMyAdmin</div>
                  <div class="progress" style="height:8px"><div class="progress-bar bg-pink" style="width:80%;background:#ff8fa1"></div></div>
                </div>
                <div class="col-6 col-md-3 text-center">
                  <div class="small text-muted">MySQL</div>
                  <div class="progress" style="height:8px"><div class="progress-bar bg-dark" style="width:70%"></div></div>
                </div>
                <div class="col-6 col-md-3 text-center">
                  <div class="small text-muted">Git</div>
                  <div class="progress" style="height:8px"><div class="progress-bar" style="width:75%"></div></div>
                </div>
              </div>
            </div>
        </div>
      </section>

      <section id="projects" class="mb-5">
        <h2 class="mb-3">Projects</h2>
        <div class="row gy-4">
          <div class="col-md-6">
            <div class="card h-100 shadow-sm">
              <img src="images/POS-ss.png" class="card-img-top" alt="Project 1">
              <div class="card-body d-flex flex-column card-accent">
                <h5 class="card-title">Project 1 — Point of Sales System</h5>
                <p class="card-text">Created a landing page of a restaurant and its POS.</p>
                <p class="mb-1"><strong>Tech:</strong> PHP, HTML, Javascript</p>
                <div class="mt-auto">
                  <a href="https://github.com/shnpai/Barcade-JS-pos" class="btn btn-sm" style="background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;border:0">Repo</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card h-100 shadow-sm">
              <img src="images/Kiosk-ss.png" class="card-img-top" alt="Project 2">
              <div class="card-body d-flex flex-column card-accent">
                <h5 class="card-title">Project 2 — Order Kiosk With Jquery</h5>
                <p class="card-text">The kiosk-like web app with an "add-to-cart" feature before proceeding to finalize the
orders and paying for them. </p>
                <p class="mb-1"><strong>Tech:</strong> PHP, Jquery, Tailwind CSS</p>
                <div class="mt-auto">
                  <a href="https://github.com/shnpai/Kiosk-JQuery" class="btn btn-sm" style="background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;border:0">Repo</a>
                  <a href="https://drive.google.com/file/d/1ynJS1zJ1K4ArRGJCjPlAlgPQX_8vjbY5/view?usp=sharing" class="btn btn-outline-primary btn-sm ms-2">Live Demo</a>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card h-100 shadow-sm">
              <img src="images/Job-ss.png" class="card-img-top" alt="Project 3">
              <div class="card-body d-flex flex-column card-accent">
                <h5 class="card-title">Project 3 — FindHire Application</h5>
                <p class="card-text">A web application for Job Listing with user and admin's end.</p>
                <p class="mb-1"><strong>Tech:</strong> PHP, HTML, CSS</p>
                <div class="mt-auto">
                  <a href="https://github.com/shnpai/findhire-finalproject" class="btn btn-sm" style="background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;border:0">Repo</a>
                  
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-6">
            <div class="card h-100 shadow-sm">
              <img src="images/System-ss.png" class="card-img-top" alt="Project 4">
              <div class="card-body d-flex flex-column card-accent">
                <h5 class="card-title">System User Management</h5>
                <p class="card-text">Short description: A system user management for softwares used by the company.</p>
                <p class="mb-1"><strong>Tech:</strong> Javascript, CodeIgniter4, PHP</p>
                <div class="mt-auto">
                  <a href="#" class="btn btn-sm" style="background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;border:0">Repo</a>
                  
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="education" class="mb-5">
        <h2 class="mb-3">Education & Certifications</h2>
        <div class="card shadow-sm">
          <div class="card-body">
            <h5>Formal Education</h5>
            <p><strong>Bachelor of Science in Computer Science</strong> — Emilio Aguinaldo College-Cavite, 2026 — Thesis Project: Brain Fog Monitoring System</p>
            <p><strong>Senior High School:</strong> Emilio Aguinaldo College-Cavite, 2021</p>

            <h5 class="mt-3">Certifications</h5>
            <ul>
              <li>Certificate of Completion Intership - Software Development</li>
              <li>freeCodeCamp Front End Development Libraries Certification</li>
              
            </ul>
          </div>
        </div>
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
        © 2025 Shane Ignacio. Resume.
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

        $.get('api.php?action=skills_list').done(function(list){
          if(!Array.isArray(list) || !list.length) list = defaultSkills;
          if(Array.isArray(list) && list.length){
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
                html += '<div class="mb-3"><div class="d-flex justify-content-between"><small>'+escapeHtml(s.name)+'</small><small>'+(s.level||'')+'%</small></div><div class="progress" style="height:10px"><div class="progress-bar bg-info" role="progressbar" style="width:'+ (s.level||0) +'%"></div></div></div>';
              });
            }

            if(tools.length){
              html += '<h6 class="mt-4 mb-2">Frameworks & Tools</h6><div class="row g-3">';
              tools.forEach(function(t){
                var pct = t.level || 70;
                html += '<div class="col-6 col-md-3 text-center"><div class="small text-muted">'+escapeHtml(t.name)+'</div><div class="progress" style="height:8px"><div class="progress-bar" role="progressbar" style="width:'+pct+'%"></div></div></div>';
              });
              html += '</div>';
            }

            html += '<div class="mt-3"><span class="tag tag--pink">Open to internships</span><span class="tag tag--blue">Software Engineer</span><span class="tag tag--green">Team player</span></div>';
            $('#skills .card-body').html(html);
          }
        });

        $.get('api.php?action=projects_list').done(function(list){
          if(!Array.isArray(list) || !list.length) list = defaultProjects;
          if(Array.isArray(list) && list.length){
            var html = '<div class="row gy-4">';
            list.forEach(function(p){
              html += '<div class="col-md-6"><div class="card h-100 shadow-sm">';
              if(p.image) html += '<img src="'+p.image+'" class="card-img-top" alt="'+escapeHtml(p.title)+'">';
              html += '<div class="card-body d-flex flex-column card-accent"><h5 class="card-title">'+escapeHtml(p.title)+'</h5><p class="card-text">'+(p.description||'')+'</p><p class="mb-1"><strong>Tech:</strong> '+(p.tech||'')+'</p><div class="mt-auto">';
              if(p.link) html += '<a href="'+p.link+'" class="btn btn-sm" style="background:linear-gradient(90deg,var(--accent),var(--accent-2));color:#fff;border:0">Repo</a>';
              html += '</div></div></div></div>';
            });
            html += '</div>';
            $('#projects .row').first().replaceWith(html);
          }
        });

        $.get('api.php?action=education_list').done(function(list){
          if(Array.isArray(list) && list.length){
            var html = '<div class="card shadow-sm"><div class="card-body">';
            var ed = list.filter(e=> e.category === 'education');
            var cert = list.filter(e=> e.category === 'certification');
            if(ed.length){ html += '<h5>Formal Education</h5>'; ed.forEach(function(e){ html += '<p><strong>'+escapeHtml(e.title)+'</strong> — '+(e.institution||'')+' '+(e.year?(' — '+e.year):'')+'<br>'+(e.description||'')+'</p>'; }); }
            if(cert.length){ html += '<h5 class="mt-3">Certifications</h5><ul>'; cert.forEach(function(c){ html += '<li>'+escapeHtml(c.title)+'</li>'; }); html += '</ul>'; }
            html += '</div></div>';
            $('#education').html(html);
          }
        });

        function escapeHtml(s){ return String(s||'').replace(/[&<>"']/g,function(m){return {'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#39;'}[m];}); }
      });
    </script>
  </body>
</html>
