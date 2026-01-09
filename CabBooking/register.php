<?php require_once('./config.php') ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body class="modern-auth-body">
  <script>
    start_loader()
  </script>
  
  <style>
  /* Modern Register Page Styles */
  .modern-auth-body {
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
      padding: 2rem 1rem;
  }
  
  .register-container {
      width: 100%;
      max-width: 1000px;
      background: white;
      border-radius: 24px;
      box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
      overflow: hidden;
      padding: 3rem;
  }
  
  .register-header {
      text-align: center;
      margin-bottom: 2.5rem;
  }
  
  .register-logo {
      width: 80px;
      height: 80px;
      border-radius: 50%;
      margin-bottom: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
  }
  
  .register-header h1 {
      font-size: 2rem;
      font-weight: 700;
      color: #1f2937;
      margin-bottom: 0.5rem;
  }
  
  .register-header p {
      color: #6b7280;
      font-size: 1rem;
  }
  
  .form-section-divider {
      display: flex;
      align-items: center;
      margin: 2rem 0 1.5rem;
  }
  
  .form-section-divider::before,
  .form-section-divider::after {
      content: '';
      flex: 1;
      height: 2px;
      background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
  }
  
  .form-section-divider span {
      padding: 0 1.5rem;
      font-weight: 600;
      color: #9333ea;
      font-size: 0.875rem;
      text-transform: uppercase;
      letter-spacing: 0.5px;
  }
  
  .form-row-modern {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 1.5rem;
      margin-bottom: 1.5rem;
  }
  
  .form-modern-group-auth {
      position: relative;
  }
  
  .form-modern-group-auth label {
      display: block;
      font-size: 0.875rem;
      font-weight: 600;
      color: #374151;
      margin-bottom: 0.5rem;
  }
  
  .form-modern-group-auth label .required-star {
      color: #ef4444;
      margin-left: 0.25rem;
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
      font-size: 1rem;
  }
  
  .form-modern-input-auth,
  .form-modern-select-auth,
  .form-modern-textarea-auth {
      width: 100%;
      padding: 0.875rem 1rem 0.875rem 3rem;
      font-size: 0.9375rem;
      border: 2px solid #e5e7eb;
      border-radius: 12px;
      transition: all 0.3s ease;
      background-color: #f9fafb;
      font-family: inherit;
  }
  
  .form-modern-textarea-auth {
      resize: vertical;
      min-height: 100px;
  }
  
  .form-modern-select-auth {
      cursor: pointer;
      appearance: none;
      background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%239ca3af' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
      background-position: right 0.75rem center;
      background-repeat: no-repeat;
      background-size: 1.5em 1.5em;
      padding-right: 3rem;
  }
  
  .form-modern-input-auth:focus,
  .form-modern-select-auth:focus,
  .form-modern-textarea-auth:focus {
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
      color: #9333ea;
  }
  
  .custom-file-upload {
      display: inline-block;
      width: 100%;
      padding: 0.875rem 1rem;
      cursor: pointer;
      background: #f9fafb;
      border: 2px dashed #e5e7eb;
      border-radius: 12px;
      text-align: center;
      transition: all 0.3s ease;
  }
  
  .custom-file-upload:hover {
      border-color: #a855f7;
      background: rgba(168, 85, 247, 0.05);
  }
  
  .custom-file-upload input[type="file"] {
      display: none;
  }
  
  .avatar-preview {
      margin-top: 1rem;
      text-align: center;
  }
  
  #cimg {
      width: 150px;
      height: 150px;
      object-fit: cover;
      object-position: center;
      border-radius: 50%;
      border: 4px solid #e5e7eb;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
      margin-top: 1.5rem;
  }
  
  .auth-submit-btn:hover {
      background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%);
      transform: translateY(-2px);
      box-shadow: 0 8px 20px rgba(147, 51, 234, 0.4);
  }
  
  .auth-submit-btn:active {
      transform: translateY(0);
  }
  
  .auth-alt-action {
      text-align: center;
      margin-top: 1.5rem;
      padding-top: 1.5rem;
      border-top: 1px solid #e5e7eb;
  }
  
  .auth-alt-action p {
      color: #6b7280;
      margin: 0.5rem 0;
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
  
  @media (max-width: 768px) {
      .register-container {
          padding: 2rem 1.5rem;
      }
      
      .register-header h1 {
          font-size: 1.5rem;
      }
      
      .form-row-modern {
          grid-template-columns: 1fr;
      }
      
      #cimg {
          width: 120px;
          height: 120px;
      }
  }
  </style>

<div class="register-container fade-in">
  <div class="register-header">
    <img src="<?= validate_image($_settings->info('logo')) ?>" alt="<?= $_settings->info('short_name') ?>" class="register-logo">
    <h1>Create Your Account</h1>
    <p>Join us for reliable and comfortable transportation services</p>
  </div>
  
  <form id="register-frm" action="" method="post">
    <input type="hidden" name="id">
    
    <!-- Personal Information Section -->
    <div class="form-section-divider">
      <span><i class="fas fa-user mr-2"></i>Personal Information</span>
    </div>
    
    <div class="form-row-modern">
      <div class="form-modern-group-auth">
        <label for="firstname">First Name <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-user form-input-icon"></i>
          <input type="text" name="firstname" id="firstname" class="form-modern-input-auth" placeholder="John" required>
        </div>
      </div>
      
      <div class="form-modern-group-auth">
        <label for="middlename">Middle Name</label>
        <div class="form-input-wrapper">
          <i class="fas fa-user form-input-icon"></i>
          <input type="text" name="middlename" id="middlename" class="form-modern-input-auth" placeholder="Optional">
        </div>
      </div>
    </div>
    
    <div class="form-row-modern">
      <div class="form-modern-group-auth">
        <label for="lastname">Last Name <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-user form-input-icon"></i>
          <input type="text" name="lastname" id="lastname" class="form-modern-input-auth" placeholder="Doe" required>
        </div>
      </div>
      
      <div class="form-modern-group-auth">
        <label for="gender">Gender <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-venus-mars form-input-icon"></i>
          <select name="gender" id="gender" class="form-modern-select-auth" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
          </select>
        </div>
      </div>
    </div>
    
    <!-- Contact Information Section -->
    <div class="form-section-divider">
      <span><i class="fas fa-address-book mr-2"></i>Contact Information</span>
    </div>
    
    <div class="form-row-modern">
      <div class="form-modern-group-auth">
        <label for="contact">Contact Number <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-phone form-input-icon"></i>
          <input type="text" name="contact" id="contact" class="form-modern-input-auth" placeholder="+1 234 567 8900" required>
        </div>
      </div>
      
      <div class="form-modern-group-auth">
        <label for="email">Email Address <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-envelope form-input-icon"></i>
          <input type="email" name="email" id="email" class="form-modern-input-auth" placeholder="you@example.com" required>
        </div>
      </div>
    </div>
    
    <div class="form-modern-group-auth">
      <label for="address">Full Address</label>
      <div class="form-input-wrapper">
        <i class="fas fa-map-marker-alt form-input-icon" style="top: 1.5rem;"></i>
        <textarea name="address" id="address" class="form-modern-textarea-auth" placeholder="Enter your complete address"></textarea>
      </div>
    </div>
    
    <!-- Account Credentials Section -->
    <div class="form-section-divider">
      <span><i class="fas fa-key mr-2"></i>Account Credentials</span>
    </div>
    
    <div class="form-row-modern">
      <div class="form-modern-group-auth">
        <label for="password">Password <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-lock form-input-icon"></i>
          <input type="password" name="password" id="password" class="form-modern-input-auth" placeholder="Enter password" required>
          <button type="button" class="password-toggle-btn pass_type" data-target="password">
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>
      
      <div class="form-modern-group-auth">
        <label for="cpassword">Confirm Password <span class="required-star">*</span></label>
        <div class="form-input-wrapper">
          <i class="fas fa-lock form-input-icon"></i>
          <input type="password" id="cpassword" class="form-modern-input-auth" placeholder="Confirm password" required>
          <button type="button" class="password-toggle-btn pass_type" data-target="cpassword">
            <i class="fas fa-eye"></i>
          </button>
        </div>
      </div>
    </div>
    
    <!-- Avatar Upload Section -->
    <div class="form-section-divider">
      <span><i class="fas fa-image mr-2"></i>Profile Picture</span>
    </div>
    
    <div class="form-row-modern">
      <div class="form-modern-group-auth">
        <label class="custom-file-upload">
          <input type="file" name="img" id="customFile" accept="image/*" onchange="displayImg(this,$(this))">
          <i class="fas fa-cloud-upload-alt mr-2"></i>
          <span>Choose Profile Picture</span>
        </label>
      </div>
      
      <div class="avatar-preview">
        <img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" alt="Avatar Preview" id="cimg">
      </div>
    </div>
    
    <button type="submit" class="auth-submit-btn">
      <i class="fas fa-user-plus mr-2"></i> Create Account
    </button>
    
    <div class="auth-alt-action">
      <p><a href="<?php echo base_url ?>" class="auth-link"><i class="fas fa-arrow-left mr-1"></i> Back to Home</a></p>
      <p>Already have an account? <a href="<?php echo base_url.'login.php' ?>" class="auth-link">Sign In</a></p>
    </div>
  </form>
</div>

<script src="<?= base_url ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<!-- <script src="<?= base_url ?>dist/js/adminlte.min.js"></script> -->

<script>
  window.displayImg = function(input,_this) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function (e) {
              $('#cimg').attr('src', e.target.result);
              _this.siblings('span').text(input.files[0].name)
          }
          reader.readAsDataURL(input.files[0]);
      } else {
          $('#cimg').attr('src', "<?php echo validate_image(isset($image_path) ? $image_path : "") ?>");
          _this.siblings('span').text("Choose Profile Picture")
      }
  }
  
  $(document).ready(function(){
    end_loader();
    
    // Password toggle functionality
    $('.pass_type').click(function(){
      var targetId = $(this).data('target');
      var input = $('#' + targetId);
      var icon = $(this).find('i');
      
      if(input.attr('type') == 'password'){
        input.attr('type','text')
        icon.removeClass("fa-eye").addClass("fa-eye-slash")
      } else {
        input.attr('type','password')
        icon.removeClass("fa-eye-slash").addClass("fa-eye")
      }
    })
    
    // Form submission
    $('#register-frm').submit(function(e){
      e.preventDefault()
      var _this = $(this)
      $('.err-msg').remove();
      
      var el = $('<div>')
      el.addClass('alert alert-danger err-msg')
      el.hide()
      el.css({
        'border-radius': '12px',
        'margin-bottom': '1.5rem'
      })
      
      // Password confirmation check
      if($('#password').val() != $('#cpassword').val()){
        el.text('Passwords do not match. Please try again.');
        _this.prepend(el)
        el.show('slow')
        $('html, body').animate({ scrollTop: 0 }, 'slow')
        return false;
      }
      
      start_loader();
      $.ajax({
        url: _base_url_+"classes/Users.php?f=save_client",
        data: new FormData($(this)[0]),
        cache: false,
        contentType: false,
        processData: false,
        method: 'POST',
        type: 'POST',
        dataType: 'json',
        error: err => {
          console.log(err)
          alert_toast("An error occurred",'error');
          end_loader();
        },
        success: function(resp){
          if(typeof resp =='object' && resp.status == 'success'){
            // Show success message
            showModernToast('Account created successfully! Redirecting to login...', 'success');
            setTimeout(function(){
              location.href = "./login.php";
            }, 1500);
          } else if(resp.status == 'failed' && !!resp.msg){   
            el.text(resp.msg)
            _this.prepend(el)
            el.show('slow')
            end_loader();
          } else {
            alert_toast("An error occurred",'error');
            end_loader();
            console.log(resp)
          }
          $('html, body').animate({ scrollTop: 0 }, 'slow')
        }
      })
    })
  })
</script>
</body>
</html>