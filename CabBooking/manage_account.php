<?php 
if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2){
    $qry = $conn->query("SELECT * FROM `client_list` where id = '{$_settings->userdata('id')}'");
    if($qry->num_rows >0){
        $res = $qry->fetch_array();
        foreach($res as $k => $v){
            if(!is_numeric($k)){
                $$k = $v;
            }
        }
    }else{
        echo "<script> alert('You are not allowed to access this page. Unknown User ID.'); location.replace('./') </script>";
    }
}else{
    echo "<script> alert('You are not allowed to access this page.'); location.replace('./') </script>";
}
?>
<style>
/* Modern Account Settings Page Styles */
.account-header {
    background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
    color: white;
    padding: 3.5rem 0;
    margin-top: 70px;
    position: relative;
    overflow: hidden;
}

.account-header::before {
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

.account-header .container {
    position: relative;
    z-index: 2;
}

.account-container {
    max-width: 1000px;
    margin: -60px auto 3rem;
    position: relative;
    padding: 0 1rem;
}

.account-card {
    background: white;
    border-radius: 24px;
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    overflow: hidden;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.account-card:hover {
    box-shadow: 0 25px 60px rgba(147, 51, 234, 0.2);
}

.account-card-header {
    padding: 2.5rem 2.5rem 2rem;
    border-bottom: 2px solid #f3f4f6;
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.05) 0%, rgba(168, 85, 247, 0.05) 100%);
}

.account-card-header h2 {
    font-size: 1.875rem;
    font-weight: 700;
    color: #1f2937;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.account-card-header h2 i {
    color: #9333ea;
    font-size: 2rem;
}

.account-card-body {
    padding: 2.5rem;
}

/* Form Section Dividers */
.section-divider {
    display: flex;
    align-items: center;
    margin: 2.5rem 0 1.75rem;
}

.section-divider:first-of-type {
    margin-top: 0;
}

.section-divider::before,
.section-divider::after {
    content: '';
    flex: 1;
    height: 2px;
    background: linear-gradient(90deg, transparent, #e5e7eb, transparent);
}

.section-divider span {
    padding: 0 1.5rem;
    font-weight: 600;
    color: #9333ea;
    font-size: 0.875rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

/* Form Row Layout */
.form-row-modern {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 1.5rem;
    margin-bottom: 1.5rem;
}

/* Form Group Styles */
.form-modern-group-auth {
    position: relative;
    margin-bottom: 1.5rem;
}

.form-modern-group-auth:last-child {
    margin-bottom: 0;
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

/* Input Wrapper */
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
    z-index: 1;
    pointer-events: none;
}

.form-modern-textarea-auth + .form-input-icon {
    top: 1.5rem;
    transform: none;
}

/* Form Inputs */
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
    color: #1f2937;
}

.form-modern-textarea-auth {
    resize: vertical;
    min-height: 100px;
    padding-top: 0.875rem;
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

.form-modern-input-auth::placeholder,
.form-modern-textarea-auth::placeholder {
    color: #9ca3af;
}

/* Password Toggle Button */
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
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 6px;
}

.password-toggle-btn:hover {
    color: #9333ea;
    background-color: rgba(147, 51, 234, 0.1);
}

.password-toggle-btn i {
    font-size: 0.875rem;
}

/* Modern Alert/Warning */
.modern-alert {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #fef3c7 0%, #fde68a 100%);
    border-left: 4px solid #f59e0b;
    box-shadow: 0 2px 8px rgba(245, 158, 11, 0.15);
}

.modern-alert i {
    color: #f59e0b;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.modern-alert span {
    color: #92400e;
    font-size: 0.9375rem;
    font-weight: 500;
    line-height: 1.5;
}

/* Custom File Upload */
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
    font-size: 0.9375rem;
    font-weight: 500;
    color: #374151;
}

.custom-file-upload:hover {
    border-color: #a855f7;
    background: rgba(168, 85, 247, 0.05);
    color: #9333ea;
}

.custom-file-upload input[type="file"] {
    display: none;
}

.custom-file-upload i {
    margin-right: 0.5rem;
    color: #9333ea;
}

/* Avatar Preview */
.avatar-preview {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-top: 1rem;
}

#cimg {
    width: 150px;
    height: 150px;
    object-fit: cover;
    object-position: center;
    border-radius: 50%;
    border: 4px solid #e5e7eb;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

#cimg:hover {
    border-color: #a855f7;
    box-shadow: 0 8px 20px rgba(147, 51, 234, 0.2);
    transform: scale(1.05);
}

/* Form Actions */
.form-actions {
    margin-top: 2.5rem;
    padding-top: 2rem;
    border-top: 2px solid #f3f4f6;
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Error Message Styling */
.err-msg {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 1rem 1.25rem;
    border-radius: 12px;
    background: linear-gradient(135deg, #fee2e2 0%, #fecaca 100%);
    border-left: 4px solid #ef4444;
    color: #991b1b;
    font-weight: 500;
    margin-bottom: 1.5rem;
}

.err-msg i {
    color: #ef4444;
    font-size: 1.25rem;
}

/* Responsive Design */
@media (max-width: 768px) {
    .account-header {
        padding: 2.5rem 0;
    }
    
    .account-header h1 {
        font-size: 2rem !important;
    }
    
    .account-container {
        margin: -40px auto 2rem;
    }
    
    .account-card-header {
        padding: 2rem 1.5rem 1.5rem;
    }
    
    .account-card-header h2 {
        font-size: 1.5rem;
    }
    
    .account-card-body {
        padding: 1.5rem;
    }
    
    .form-row-modern {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .form-actions {
        flex-direction: column;
    }
    
    .form-actions .btn-modern {
        width: 100%;
    }
    
    #cimg {
        width: 120px;
        height: 120px;
    }
}

@media (max-width: 576px) {
    .account-card-header h2 {
        font-size: 1.25rem;
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .section-divider span {
        font-size: 0.75rem;
        padding: 0 1rem;
    }
}
</style>

<div class="account-header">
    <div class="container text-center">
        <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 0.5rem;">Account Settings</h1>
        <p style="opacity: 0.95;">Manage your profile and account preferences</p>
    </div>
</div>

<div class="account-container">
    <div class="account-card">
        <div class="account-card-header">
                <h2>
                    <i class="fas fa-user-circle" style="color: #9333ea;"></i>
                    Profile Information
                </h2>
        </div>
        <div class="account-card-body">
            <form id="register-frm" action="" method="post">
                <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
                
                <!-- Personal Information Section -->
                <div class="section-divider">
                    <span><i class="fas fa-user"></i>Personal Information</span>
                </div>
                
                <div class="form-row-modern">
                    <div class="form-modern-group-auth">
                        <label for="firstname">First Name <span class="required-star">*</span></label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-user form-input-icon"></i>
                            <input type="text" name="firstname" id="firstname" class="form-modern-input-auth" placeholder="Enter first name" value="<?= isset($firstname) ? $firstname : "" ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-modern-group-auth">
                        <label for="middlename">Middle Name</label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-user form-input-icon"></i>
                            <input type="text" name="middlename" id="middlename" class="form-modern-input-auth" placeholder="Optional" value="<?= isset($middlename) ? $middlename : "" ?>">
                        </div>
                    </div>
                </div>
                
                <div class="form-row-modern">
                    <div class="form-modern-group-auth">
                        <label for="lastname">Last Name <span class="required-star">*</span></label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-user form-input-icon"></i>
                            <input type="text" name="lastname" id="lastname" class="form-modern-input-auth" placeholder="Enter last name" value="<?= isset($lastname) ? $lastname : "" ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-modern-group-auth">
                        <label for="gender">Gender <span class="required-star">*</span></label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-venus-mars form-input-icon"></i>
                            <select name="gender" id="gender" class="form-modern-select-auth" required>
                                <option value="Male" <?= isset($gender) && $gender == 'Male' ? "selected" : "" ?>>Male</option>
                                <option value="Female" <?= isset($gender) && $gender == 'Female' ? "selected" : "" ?>>Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <!-- Contact Information Section -->
                <div class="section-divider">
                    <span><i class="fas fa-address-book"></i>Contact Information</span>
                </div>
                
                <div class="form-row-modern">
                    <div class="form-modern-group-auth">
                        <label for="contact">Contact Number <span class="required-star">*</span></label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-phone form-input-icon"></i>
                            <input type="text" name="contact" id="contact" class="form-modern-input-auth" placeholder="Enter contact number" value="<?= isset($contact) ? $contact : "" ?>" required>
                        </div>
                    </div>
                    
                    <div class="form-modern-group-auth">
                        <label for="email">Email Address <span class="required-star">*</span></label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-envelope form-input-icon"></i>
                            <input type="email" name="email" id="email" class="form-modern-input-auth" placeholder="you@example.com" value="<?= isset($email) ? $email : "" ?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-modern-group-auth">
                    <label for="address">Full Address</label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-map-marker-alt form-input-icon"></i>
                        <textarea name="address" id="address" class="form-modern-textarea-auth" placeholder="Enter your complete address"><?= isset($address) ? $address : "" ?></textarea>
                    </div>
                </div>
                
                <!-- Security Section -->
                <div class="section-divider">
                    <span><i class="fas fa-lock"></i>Security & Password</span>
                </div>
                
                <div class="modern-alert">
                    <i class="fas fa-info-circle"></i>
                    <span>Leave password fields empty if you don't want to change your password.</span>
                </div>
                
                <div class="form-row-modern">
                    <div class="form-modern-group-auth">
                        <label for="password">New Password</label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-lock form-input-icon"></i>
                            <input type="password" name="password" id="password" class="form-modern-input-auth" placeholder="Enter new password">
                            <button type="button" class="password-toggle-btn pass_type" data-target="password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-modern-group-auth">
                        <label for="cpassword">Confirm New Password</label>
                        <div class="form-input-wrapper">
                            <i class="fas fa-lock form-input-icon"></i>
                            <input type="password" id="cpassword" class="form-modern-input-auth" placeholder="Confirm new password">
                            <button type="button" class="password-toggle-btn pass_type" data-target="cpassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="form-modern-group-auth">
                    <label for="oldpassword">Current Password <span class="required-star">*</span></label>
                    <div class="form-input-wrapper">
                        <i class="fas fa-key form-input-icon"></i>
                        <input type="password" name="oldpassword" id="oldpassword" class="form-modern-input-auth" placeholder="Enter current password to confirm changes" required>
                        <button type="button" class="password-toggle-btn pass_type" data-target="oldpassword">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Profile Picture Section -->
                <div class="section-divider">
                    <span><i class="fas fa-image"></i>Profile Picture</span>
                </div>
                
                <div class="form-modern-group-auth">
                    <label>Upload Profile Picture</label>
                    <label class="custom-file-upload">
                        <input type="file" name="img" id="customFile" accept="image/*" onchange="displayImg(this,$(this))">
                        <i class="fas fa-cloud-upload-alt"></i>
                        <span>Choose Profile Picture</span>
                    </label>
                </div>
                
                <div class="avatar-preview">
                    <img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" alt="Avatar Preview" id="cimg">
                </div>
                
                <!-- Submit Button -->
                <div class="form-actions">
                    <a href="./" class="btn-modern btn-modern-secondary">
                        <i class="fas fa-times"></i>
                        <span>Cancel</span>
                    </a>
                    <button type="submit" class="btn-modern btn-modern-primary">
                        <i class="fas fa-save"></i>
                        <span>Update Account</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
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
    
    $(function(){
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
            el.addClass('err-msg')
            el.html('<i class="fas fa-exclamation-circle"></i><span></span>')
            el.hide()
            
            // Password confirmation check (only if password is being changed)
            if($('#password').val() != '' && $('#password').val() != $('#cpassword').val()){
                el.find('span').text('New passwords do not match. Please try again.');
                _this.prepend(el)
                el.show('slow')
                $('html, body').animate({ scrollTop: 0 }, 'slow')
                return false;
            }
            
            start_loader();
            $.ajax({
                url: _base_url_+"classes/Users.php?f=update_client",
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
                        if (typeof showModernToast === 'function') {
                            showModernToast('Account updated successfully!', 'success');
                        } else {
                            alert_toast('Account updated successfully!', 'success');
                        }
                        setTimeout(function(){
                            location.reload();
                        }, 1500);
                    } else if(resp.status == 'failed' && !!resp.msg){   
                        el.find('span').text(resp.msg)
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