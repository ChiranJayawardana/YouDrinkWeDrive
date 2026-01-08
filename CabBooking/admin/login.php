<?php require_once('../config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
      body {
          width: 100vw;
          height: 100vh;
          margin: 0;
          padding: 0;
          background-image: linear-gradient(rgba(6, 182, 212, 0.85), rgba(8, 145, 178, 0.85)), url('<?= validate_image($_settings->info('cover')) ?>');
          background-repeat: no-repeat;
          background-size: cover;
          background-position: center;
          background-attachment: fixed;
          display: flex;
          align-items: center;
          justify-content: center;
      }
      body::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
          opacity: 0.3;
      }
      .admin-login-container {
          position: relative;
          z-index: 1;
          width: 450px;
          max-width: 90%;
      }
      .glass-card {
          background: rgba(255, 255, 255, 0.15);
          backdrop-filter: blur(20px);
          -webkit-backdrop-filter: blur(20px);
          border: 2px solid rgba(255, 255, 255, 0.3);
          border-radius: 30px;
          padding: 50px 40px;
          box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
      }
      #logo-img {
          width: 100px;
          height: 100px;
          object-fit: contain;
          border-radius: 50%;
          background: white;
          padding: 15px;
          box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
          margin-bottom: 30px;
      }
      .admin-title {
          font-size: 2rem;
          font-weight: 800;
          color: white;
          text-align: center;
          margin-bottom: 10px;
          text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      }
      .admin-subtitle {
          text-align: center;
          color: rgba(255, 255, 255, 0.95);
          margin-bottom: 40px;
          font-size: 1rem;
      }
      .modern-admin-input-group {
          margin-bottom: 25px;
          position: relative;
      }
      .modern-admin-input-group input {
          width: 100%;
          padding: 16px 20px 16px 55px;
          border: 2px solid rgba(255, 255, 255, 0.3);
          border-radius: 15px;
          font-size: 1rem;
          transition: all 0.3s ease;
          background: rgba(255, 255, 255, 0.2);
          color: white;
      }
      .modern-admin-input-group input::placeholder {
          color: rgba(255, 255, 255, 0.7);
      }
      .modern-admin-input-group input:focus {
          outline: none;
          border-color: rgba(255, 255, 255, 0.6);
          background: rgba(255, 255, 255, 0.25);
          box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.1);
      }
      .modern-admin-icon {
          position: absolute;
          left: 20px;
          top: 50%;
          transform: translateY(-50%);
          color: rgba(255, 255, 255, 0.9);
          font-size: 1.2rem;
      }
      .password-toggle {
          position: absolute;
          right: 20px;
          top: 50%;
          transform: translateY(-50%);
          cursor: pointer;
          color: rgba(255, 255, 255, 0.9);
          font-size: 1.1rem;
          transition: all 0.3s ease;
      }
      .password-toggle:hover {
          color: white;
          transform: translateY(-50%) scale(1.1);
      }
      .admin-login-btn {
          width: 100%;
          padding: 16px;
          background: white;
          color: #0891b2;
          border: none;
          border-radius: 15px;
          font-size: 1.15rem;
          font-weight: 800;
          cursor: pointer;
          transition: all 0.3s ease;
          box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
          text-transform: uppercase;
          letter-spacing: 1px;
      }
      .admin-login-btn:hover {
          transform: translateY(-3px);
          box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
          background: rgba(255, 255, 255, 0.95);
      }
      .admin-back-link {
          text-align: center;
          margin-top: 25px;
          padding-top: 25px;
          border-top: 2px solid rgba(255, 255, 255, 0.2);
      }
      .admin-back-link a {
          color: white;
          text-decoration: none;
          font-weight: 600;
          transition: all 0.3s ease;
          display: inline-flex;
          align-items: center;
          gap: 8px;
      }
      .admin-back-link a:hover {
          color: rgba(255, 255, 255, 0.8);
          transform: translateX(-5px);
      }
  </style>

<div class="admin-login-container">
    <div class="glass-card">
        <center><img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" id="logo-img"></center>
        <h1 class="admin-title"><i class="fas fa-shield-alt"></i> Admin Panel</h1>
        <p class="admin-subtitle">Secure Administrator Access</p>
        
        <form id="login-frm" action="" method="post">
            <div class="modern-admin-input-group">
                <i class="fas fa-user modern-admin-icon"></i>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="modern-admin-input-group">
                <i class="fas fa-lock modern-admin-icon"></i>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <span class="password-toggle" onclick="togglePassword()">
                    <i class="fas fa-eye" id="toggleIcon"></i>
                </span>
            </div>
            
            <button type="submit" class="admin-login-btn">
                <i class="fas fa-sign-in-alt"></i> Log In
            </button>
            
            <div class="admin-back-link">
                <a href="<?php echo base_url ?>">
                    <i class="fas fa-arrow-left"></i> Back to Website
                </a>
            </div>
        </form>
    </div>
</div>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
  })

  function togglePassword() {
    const passwordInput = document.getElementById('password');
    const toggleIcon = document.getElementById('toggleIcon');
    
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    } else {
      passwordInput.type = 'password';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    }
  }
</script>
</body>
</html>