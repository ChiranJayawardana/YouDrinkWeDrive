<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
 <?php require_once('inc/header.php') ?>
<body class="hold-transition login-page">
  <script>
    start_loader()
  </script>
  <style>
      body {
          margin: 0;
          padding: 0;
          min-height: 100vh;
          display: flex;
          align-items: center;
          justify-content: center;
          background: #f0fdfa;
      }
      .login-container {
          display: flex;
          width: 90%;
          max-width: 1200px;
          min-height: 600px;
          background: white;
          border-radius: 30px;
          overflow: hidden;
          box-shadow: 0 20px 60px rgba(0,0,0,0.15);
      }
      .login-left {
          flex: 1;
          background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
          padding: 60px;
          display: flex;
          flex-direction: column;
          justify-content: center;
          align-items: center;
          color: white;
          position: relative;
          overflow: hidden;
      }
      .login-left::before {
          content: '';
          position: absolute;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
          opacity: 0.3;
      }
      .login-left-content {
          position: relative;
          z-index: 1;
          text-align: center;
      }
      .login-left h2 {
          font-size: 2.5rem;
          font-weight: 800;
          margin-bottom: 20px;
          text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
      }
      .login-left p {
          font-size: 1.1rem;
          opacity: 0.95;
          line-height: 1.6;
      }
      .login-right {
          flex: 1;
          padding: 60px;
          display: flex;
          flex-direction: column;
          justify-content: center;
      }
      #logo-img {
          width: 120px;
          height: 120px;
          object-fit: contain;
          margin-bottom: 30px;
          filter: drop-shadow(0 4px 12px rgba(0,0,0,0.1));
      }
      .login-title {
          font-size: 2rem;
          font-weight: 800;
          color: #0f172a;
          margin-bottom: 10px;
          text-align: center;
      }
      .login-subtitle {
          text-align: center;
          color: #64748b;
          margin-bottom: 40px;
          font-size: 1rem;
      }
      .modern-input-group {
          margin-bottom: 25px;
          position: relative;
      }
      .modern-input-group input {
          width: 100%;
          padding: 15px 20px 15px 50px;
          border: 2px solid #e2e8f0;
          border-radius: 12px;
          font-size: 1rem;
          transition: all 0.3s ease;
          background: #f8fafc;
      }
      .modern-input-group input:focus {
          outline: none;
          border-color: #06b6d4;
          background: white;
          box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.1);
      }
      .modern-input-icon {
          position: absolute;
          left: 18px;
          top: 50%;
          transform: translateY(-50%);
          color: #64748b;
          font-size: 1.1rem;
      }
      .password-toggle {
          position: absolute;
          right: 18px;
          top: 50%;
          transform: translateY(-50%);
          cursor: pointer;
          color: #64748b;
      }
      .login-btn {
          width: 100%;
          padding: 15px;
          background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
          color: white;
          border: none;
          border-radius: 12px;
          font-size: 1.1rem;
          font-weight: 700;
          cursor: pointer;
          transition: all 0.3s ease;
          box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3);
      }
      .login-btn:hover {
          transform: translateY(-2px);
          box-shadow: 0 8px 25px rgba(6, 182, 212, 0.4);
      }
      .login-links {
          text-align: center;
          margin-top: 25px;
          padding-top: 25px;
          border-top: 2px solid #e2e8f0;
      }
      .login-links a {
          color: #06b6d4;
          text-decoration: none;
          font-weight: 600;
          transition: all 0.3s ease;
      }
      .login-links a:hover {
          color: #0891b2;
          text-decoration: underline;
      }
      @media (max-width: 992px) {
          .login-container {
              flex-direction: column;
          }
          .login-left, .login-right {
              padding: 40px;
          }
          .login-left h2 {
              font-size: 2rem;
          }
      }
  </style>

<div class="login-container">
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>
    
    <!-- Left Side - Brand Section -->
    <div class="login-left">
        <div class="login-left-content">
            <img src="<?= validate_image($_settings->info('logo')) ?>" alt="System Logo" id="logo-img">
            <h2>Welcome Back!</h2>
            <p>Log in to access your account and manage your bookings with ease. Experience seamless transportation services at your fingertips.</p>
            <div style="margin-top: 40px;">
                <i class="fas fa-shield-alt" style="font-size: 3rem; opacity: 0.8;"></i>
            </div>
        </div>
    </div>
    
    <!-- Right Side - Login Form -->
    <div class="login-right">
        <div>
            <h1 class="login-title">Client Login</h1>
            <p class="login-subtitle">Enter your credentials to continue</p>
            
            <form id="clogin-frm" action="" method="post">
                <div class="modern-input-group">
                    <i class="fas fa-envelope modern-input-icon"></i>
                    <input type="email" name="email" placeholder="Email Address" required>
                </div>
                
                <div class="modern-input-group">
                    <i class="fas fa-lock modern-input-icon"></i>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <span class="password-toggle">
                        <i class="fas fa-eye-slash"></i>
                    </span>
                </div>
                
                <button type="submit" class="login-btn">
                    <i class="fas fa-sign-in-alt"></i> Log In
                </button>
                
                <div class="login-links">
                    <p style="margin-bottom: 10px; color: #64748b;">Don't have an account?</p>
                    <a href="<?php echo base_url.'register.php' ?>">
                        <i class="fas fa-user-plus"></i> Create an Account
                    </a>
                    <span style="margin: 0 15px; color: #cbd5e0;">|</span>
                    <a href="<?php echo base_url ?>">
                        <i class="fas fa-home"></i> Back to Home
                    </a>
                </div>
            </form>
        </div>
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
</script>
</body>
</html>