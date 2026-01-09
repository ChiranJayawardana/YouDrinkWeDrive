<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body class="modern-auth-body">
  <script>
    start_loader()
  </script>
  
  <style>
  /* Modern Auth Page Styles */
  .modern-auth-body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      padding: 2rem 1rem;
  }
  
  .auth-container {
      width: 100%;
      max-width: 1100px;
      background: white;
      border-radius: 24px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      display: flex;
      min-height: 600px;
  }
  
  .auth-left {
      flex: 1;
      background: linear-gradient(135deg, #1e3a8a 0%, #4f46e5 100%);
      padding: 3rem;
      color: white;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      position: relative;
      overflow: hidden;
  }
  
  .auth-left::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
      opacity: 0.3;
      pointer-events: none;
  }
  
  .auth-left-content {
      position: relative;
      z-index: 2;
      text-align: center;
  }
  
  .auth-logo {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      margin-bottom: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
      background: white;
      padding: 10px;
  }
  
  .auth-left h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
      color: white;
  }
  
  .auth-left p {
      font-size: 1.125rem;
      opacity: 0.9;
      line-height: 1.6;
  }
  
  .auth-right {
      flex: 1;
      padding: 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
  }
  
  .auth-header {
      margin-bottom: 2rem;
  }
  
  .auth-header h2 {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.5rem;
  }
  
  .auth-header p {
      color: #6b7280;
      font-size: 1rem;
  }
  
  .form-modern-group-auth {
      margin-bottom: 1.5rem;
  }
  
  .form-modern-group-auth label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
  }
  
  .form-input-wrapper {
      position: relative;
  }
  
  .form-input-icon {
      position: absolute;
      left: 1rem;
      top: 50%;
      transform: translateY(-50%);
      color: #9ca3af;
      font-size: 1.125rem;
  }
  
  .form-modern-input-auth {
      width: 100%;
      padding: 0.875rem 1rem 0.875rem 3rem;
      font-size: 1rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      transition: all 0.3s ease;
      background-color: #f9fafb;
  }
  
  .form-modern-input-auth:focus {
      outline: none;
      border-color: #a855f7;
      background-color: white;
      box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
  }
  
  .password-toggle-btn {
      position: absolute;
      right: 1rem;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      color: #9ca3af;
      cursor: pointer;
      padding: 0.25rem;
      transition: color 0.3s ease;
  }
  
  .password-toggle-btn:hover {
      color: #4f46e5;
  }
  
  .auth-submit-btn {
      width: 100%;
      padding: 1rem;
      font-size: 1rem;
      font-weight: 600;
      background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
      color: white;
      border: none;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 12px rgba(147, 51, 234, 0.3);
  }
  
  .auth-submit-btn:hover {
      background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(147, 51, 234, 0.4);
  }
  
  .auth-submit-btn:active {
      transform: translateY(0);
  }
  
  .auth-links {
      margin-top: 1.5rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      flex-wrap: wrap;
      gap: 1rem;
  }
  
  .auth-link {
      color: #9333ea;
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
  }
  
  .auth-link:hover {
      color: #7e22ce;
  }
  
  .auth-divider {
      margin: 1.5rem 0;
      text-align: center;
      position: relative;
  }
  
  .auth-divider span {
      background: white;
      padding: 0 1rem;
      color: #6b7280;
      font-size: 0.875rem;
      position: relative;
      z-index: 1;
  }
  
  .auth-divider::before {
      content: '';
      position: absolute;
      left: 0;
      right: 0;
      top: 50%;
      height: 1px;
      background: #e5e7eb;
  }
  
  .auth-alt-action {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid #e5e7eb;
  }
  
  .auth-alt-action p {
      color: #6b7280;
      margin: 0;
  }
  
  @media (max-width: 768px) {
      .auth-container {
          flex-direction: column;
      }
      
      .auth-left {
          padding: 2rem;
      }
      
      .auth-left h1 {
          font-size: 1.75rem;
      }
      
      .auth-logo {
          width: 80px;
          height: 80px;
      }
      
      .auth-right {
          padding: 2rem;
      }
      
      .auth-header h2 {
          font-size: 1.5rem;
      }
  }
  </style>

  <div class="auth-container fade-in">
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
    <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>
    
    <!-- Left Side - Branding -->
    <div class="auth-left">
      <div class="auth-left-content">
        <img src="<?= validate_image($_settings->info('logo')) ?>" alt="<?= $_settings->info('short_name') ?>" class="auth-logo">
        <h1><?= $_settings->info('short_name') ?></h1>
        <p>Your trusted partner for reliable and comfortable transportation services.</p>
      </div>
    </div>
    
    <!-- Right Side - Login Form -->
    <div class="auth-right">
      <div class="auth-header">
        <h2>Welcome Back</h2>
        <p>Sign in to your account to continue</p>
      </div>
      
      <form id="clogin-frm" action="" method="post">
        <div class="form-modern-group-auth">
          <label for="email">Email Address</label>
          <div class="form-input-wrapper">
            <i class="fas fa-envelope form-input-icon"></i>
            <input type="email" id="email" name="email" class="form-modern-input-auth" placeholder="you@example.com" required>
          </div>
        </div>
        
        <div class="form-modern-group-auth">
          <label for="password">Password</label>
          <div class="form-input-wrapper">
            <i class="fas fa-lock form-input-icon"></i>
            <input type="password" id="password" name="password" class="form-modern-input-auth" placeholder="Enter your password" required>
            <button type="button" class="password-toggle-btn" onclick="togglePassword('password')">
              <i class="fas fa-eye"></i>
            </button>
          </div>
        </div>
        
        <button type="submit" class="auth-submit-btn">
          <i class="fas fa-sign-in-alt mr-2"></i> Sign In
        </button>
        
        <div class="auth-links">
          <a href="<?php echo base_url ?>" class="auth-link">
            <i class="fas fa-arrow-left mr-1"></i> Back to Home
          </a>
        </div>
        
        <div class="auth-alt-action">
          <p>Don't have an account? <a href="<?php echo base_url.'register.php' ?>" class="auth-link">Create Account</a></p>
          <p class="mt-2">
            <a href="./driver/login.php" class="auth-link">
              <i class="fas fa-car-side mr-1"></i> Driver Login
            </a>
          </p>
        </div>
      </form>
    </div>
  </div>
  
  <script>
  function togglePassword(inputId) {
      const input = document.getElementById(inputId);
      const icon = event.currentTarget.querySelector('i');
      
      if (input.type === 'password') {
          input.type = 'text';
          icon.classList.remove('fa-eye');
          icon.classList.add('fa-eye-slash');
      } else {
          input.type = 'password';
          icon.classList.remove('fa-eye-slash');
          icon.classList.add('fa-eye');
      }
  }
  </script>

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<script>
  $(document).ready(function(){
    end_loader();
    
    $('#clogin-frm').submit(function(e){
      e.preventDefault();
      var _this = $(this)
      $('.err-msg').remove();
      
      var el = $('<div>')
      el.addClass("alert alert-danger err-msg")
      el.hide()
      el.css({
        'border-radius': '12px',
        'margin-bottom': '1.5rem'
      })
      
      start_loader();
      $.ajax({
        url:_base_url_+"classes/Login.php?f=login_client",
        method:'POST',
        data:$(this).serialize(),
        dataType:'json',
        error:err=>{
          console.log(err)
          el.text('An error occurred while logging in.')
          _this.prepend(el)
          el.show('slow')
          end_loader();
        },
        success:function(resp){
          if(typeof resp =='object' && resp.status == 'success'){
            location.href = './';
          }else if(resp.status == 'incorrect'){
            el.text('Incorrect email or password.')
            _this.prepend(el)
            el.show('slow')
            end_loader();
          }else{
            el.text('An error occurred.')
            _this.prepend(el)
            el.show('slow')
            end_loader();
            console.log(resp)
          }
        }
      })
    })
  })
</script>
</body>
</html>