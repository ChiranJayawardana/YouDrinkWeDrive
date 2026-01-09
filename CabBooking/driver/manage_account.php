<?php 
if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 3){
    $qry = $conn->query("SELECT * FROM `driver_list` where id = '{$_settings->userdata('id')}'");
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
    .account-section {
        background: white;
        border-radius: 15px;
        padding: 35px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 25px;
        border-left: 4px solid #9333ea;
    }
    .section-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #9333ea;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    .section-title i {
        font-size: 1.5rem;
    }
    .modern-form-group {
        margin-bottom: 25px;
    }
    .modern-form-group label {
        font-size: 0.875rem;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 8px;
        display: block;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .modern-input {
        width: 100%;
        padding: 12px 16px;
        border: 2px solid #e2e8f0;
        border-radius: 8px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    .modern-input:focus {
        outline: none;
        border-color: #9333ea;
        background: white;
        box-shadow: 0 0 0 3px rgba(147, 51, 234, 0.1);
    }
    .input-group-modern {
        display: flex;
        align-items: center;
        gap: 0;
    }
    .input-group-modern .modern-input {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
        border-right: none;
    }
    .input-group-modern .input-append {
        padding: 12px 16px;
        background: #f8f9fa;
        border: 2px solid #e2e8f0;
        border-left: none;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .input-group-modern .input-append:hover {
        background: #e2e8f0;
        color: #9333ea;
    }
    .avatar-section {
        display: flex;
        align-items: center;
        gap: 30px;
        margin-bottom: 25px;
    }
    .avatar-preview {
        width: 150px;
        height: 150px;
        border-radius: 15px;
        object-fit: cover;
        border: 4px solid #9333ea;
        box-shadow: 0 5px 15px rgba(147, 51, 234, 0.2);
    }
    .file-upload-wrapper {
        flex: 1;
    }
    .custom-file-input-modern {
        position: relative;
        display: inline-block;
        width: 100%;
    }
    .custom-file-input-modern input[type="file"] {
        position: absolute;
        opacity: 0;
        width: 100%;
        height: 100%;
        cursor: pointer;
    }
    .custom-file-label-modern {
        display: block;
        padding: 12px 20px;
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
    }
    .custom-file-label-modern:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(147, 51, 234, 0.4);
    }
    .btn-submit {
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
        border: none;
        padding: 14px 40px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.3s ease;
        cursor: pointer;
        width: 100%;
    }
    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(147, 51, 234, 0.4);
        color: white;
    }
    .info-text {
        font-size: 0.875rem;
        color: #718096;
        font-style: italic;
        margin-top: -15px;
        margin-bottom: 20px;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }
    @media (max-width: 768px) {
        .form-row {
            grid-template-columns: 1fr;
        }
        .avatar-section {
            flex-direction: column;
            align-items: center;
        }
    }
</style>
<div class="content py-5 mt-5">
    <div class="container">
        <div class="account-section">
            <h4 class="section-title">
                <i class="fas fa-user-cog"></i>
                Manage Account Details
            </h4>
            
            <form id="register-frm" action="" method="post">
                <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
                
                <div class="modern-form-group">
                    <label for="driver_name">Full Name</label>
                    <input type="text" 
                           name="driver_name" 
                           id="driver_name" 
                           class="modern-input" 
                           value="<?= isset($driver_name) ? htmlspecialchars($driver_name) : "" ?>" 
                           required 
                           placeholder="Enter your full name">
                </div>
                
                <div class="modern-form-group">
                    <label for="driver_contact">Contact Number</label>
                    <input type="text" 
                           name="driver_contact" 
                           id="driver_contact" 
                           class="modern-input" 
                           required 
                           value="<?= isset($driver_contact) ? htmlspecialchars($driver_contact) : "" ?>"
                           placeholder="Enter your contact number">
                </div>
                
                <div class="modern-form-group">
                    <label for="driver_address">Address</label>
                    <textarea name="driver_address" 
                              id="driver_address" 
                              rows="3" 
                              class="modern-input" 
                              placeholder="Enter your complete address"><?= isset($driver_address) ? htmlspecialchars($driver_address) : "" ?></textarea>
                </div>
                
                <hr style="border-color: #e2e8f0; margin: 30px 0;">
                
                <h5 class="section-title" style="font-size: 1.1rem; margin-top: 0;">
                    <i class="fas fa-lock"></i>
                    Change Password
                </h5>
                
                <div class="form-row">
                    <div class="modern-form-group">
                        <label for="password">New Password</label>
                        <div class="input-group-modern">
                            <input type="password" 
                                   name="password" 
                                   id="password" 
                                   class="modern-input" 
                                   placeholder="Enter new password">
                            <div class="input-append">
                                <i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modern-form-group">
                        <label for="cpassword">Confirm New Password</label>
                        <div class="input-group-modern">
                            <input type="password" 
                                   id="cpassword" 
                                   class="modern-input" 
                                   placeholder="Confirm new password">
                            <div class="input-append">
                                <i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i>
                            </div>
                        </div>
                    </div>
                </div>
                
                <p class="info-text">
                    <i class="fas fa-info-circle"></i> Fill the password fields above only if you want to update your password.
                </p>
                
                <div class="modern-form-group">
                    <label for="oldpassword">Current Password</label>
                    <div class="input-group-modern">
                        <input type="password" 
                               name="oldpassword" 
                               id="oldpassword" 
                               class="modern-input" 
                               required 
                               placeholder="Enter your current password">
                        <div class="input-append">
                            <i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i>
                        </div>
                    </div>
                </div>
                
                <div class="modern-form-group">
                    <label>Profile Avatar</label>
                    <div class="avatar-section">
                        <img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" 
                             alt="Avatar Preview" 
                             id="cimg" 
                             class="avatar-preview">
                        <div class="file-upload-wrapper">
                            <div class="custom-file-input-modern">
                                <input type="file" 
                                       class="custom-file-input" 
                                       id="customFile" 
                                       name="img" 
                                       onchange="displayImg(this,$(this))"
                                       accept="image/*">
                                <label class="custom-file-label-modern" for="customFile">
                                    <i class="fas fa-upload"></i> Choose Avatar Image
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="modern-form-group" style="margin-top: 30px;">
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-save"></i> Update Account Details
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
	        	_this.siblings('.custom-file-label-modern').html('<i class="fas fa-check"></i> ' + input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?php echo validate_image(isset($image_path) ? $image_path : "") ?>");
            _this.siblings('.custom-file-label-modern').html('<i class="fas fa-upload"></i> Choose Avatar Image')
        }
	}
    $(function(){
        $('.pass_type').click(function(){
            var type = $(this).attr('data-type')
            if(type == 'password'){
                $(this).attr('data-type','text')
                $(this).closest('.input-group-modern').find('input').attr('type',"text")
                $(this).removeClass("fa-eye-slash")
                $(this).addClass("fa-eye")
            }else{
                $(this).attr('data-type','password')
                $(this).closest('.input-group-modern').find('input').attr('type',"password")
                $(this).removeClass("fa-eye")
                $(this).addClass("fa-eye-slash")
            }
        })
        $('#register-frm').submit(function(e){
            e.preventDefault()
            var _this = $(this)
                    $('.err-msg').remove();
            var el = $('<div>')
                    el.hide()
            if($('#password').val() != $('#cpassword').val()){
                el.addClass('alert alert-danger err-msg').text('Password does not match.');
                _this.prepend(el)
                el.show('slow')
                return false;
            }
            start_loader();
            $.ajax({
                url:_base_url_+"classes/Master.php?f=save_cab",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    alert_toast("An error occured",'error');
                    end_loader();
                },
                success:function(resp){
                    if(typeof resp =='object' && resp.status == 'success'){
                        location.reload();
                    }else if(resp.status == 'failed' && !!resp.msg){   
                        el.addClass("alert alert-danger err-msg").text(resp.msg)
                        _this.prepend(el)
                        el.show('slow')
                    }else{
                        alert_toast("An error occured",'error');
                        end_loader();
                        console.log(resp)
                    }
                    end_loader();
                    $('html, body').scrollTop(0)
                }
            })
        })
    })
</script>
