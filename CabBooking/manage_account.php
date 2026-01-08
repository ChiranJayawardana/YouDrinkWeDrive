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
    #cimg{
        width:15vw;
        height:20vh;
        object-fit:scale-down;
        object-position:center center;
    }
</style>
<style>
    .account-hero {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        padding: 60px 0 40px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .account-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }
    .account-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }
    .account-hero h1 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }
    .account-section {
        padding: 40px 0;
        background: #f8fafc;
    }
    .account-card {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        margin-bottom: 25px;
    }
    .account-card-header {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 2px solid #e2e8f0;
    }
    .account-card-header i {
        color: #06b6d4;
        font-size: 1.5rem;
    }
    .account-card-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0;
    }
    .modern-form-field {
        margin-bottom: 20px;
    }
    .modern-form-field small {
        display: block;
        font-weight: 600;
        color: #475569;
        margin-bottom: 8px;
        font-size: 0.95rem;
    }
    .modern-form-field input,
    .modern-form-field select,
    .modern-form-field textarea {
        border: 2px solid #e2e8f0 !important;
        border-radius: 12px !important;
        padding: 14px 18px !important;
        transition: all 0.3s ease !important;
        background: #f8fafc !important;
    }
    .modern-form-field input:focus,
    .modern-form-field select:focus,
    .modern-form-field textarea:focus {
        border-color: #06b6d4 !important;
        background: white !important;
        box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.1) !important;
    }
</style>

<section class="account-hero">
    <div class="container account-hero-content">
        <h1><i class="fas fa-user-cog"></i> Manage Account</h1>
        <p>Update your personal information and credentials</p>
    </div>
</section>

<section class="account-section">
    <div class="container">
        <div class="account-card">
            <div class="account-card-header">
                <i class="fas fa-user-edit"></i>
                <h3 class="account-card-title">Account Details</h3>
            </div>
            <div class="card-body">
                <div class="container-fluid">
                    <form id="register-frm" action="" method="post">
                        <input type="hidden" name="id" value="<?= isset($id) ? $id : "" ?>">
                        <div class="row">
                            <div class="col-md-6 modern-form-field">
                                <small>First Name</small>
                                <input type="text" name="firstname" id="firstname" placeholder="Enter First Name" autofocus class="form-control form-control-sm form-control-border" value="<?= isset($firstname) ? $firstname : "" ?>" required>
                            </div>
                            <div class="col-md-6 modern-form-field">
                                <small>Middle Name (Optional)</small>
                                <input type="text" name="middlename" id="middlename" placeholder="Enter Middle Name" class="form-control form-control-sm form-control-border" value="<?= isset($middlename) ? $middlename : "" ?>">
                            </div>
                            <div class="col-md-6 modern-form-field">
                                <small>Last Name</small>
                                <input type="text" name="lastname" id="lastname" placeholder="Enter Last Name" class="form-control form-control-sm form-control-border" required value="<?= isset($lastname) ? $lastname : "" ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <select name="gender" id="gender" class="custom-select custom-select-sm form-control-border" required>
                                    <option <?= isset($gender) && $gender == 'Male' ? "selected" : "" ?>>Male</option>
                                    <option <?= isset($gender) && $gender == 'Female' ? "selected" : "" ?>>Female</option>
                                </select>
                                <small class="ml-3">Gender</small>
                            </div>
                            <div class="form-group col-md-6">
                                <input type="text" name="contact" id="contact" placeholder="Enter Contact #" class="form-control form-control-sm form-control-border" required value="<?= isset($contact) ? $contact : "" ?>">
                                <small class="ml-3">Contact #</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                            <small class="ml-3">Address</small>
                            <textarea name="address" id="address" rows="3" class="form-control form-control-sm rounded-0" placeholder="Block 6 Lot 23, Here Subd., There City, Anywhere, 2306"><?= isset($address) ? $address : "" ?></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <input type="email" name="email" id="email" placeholder="jsmith@sample.com" class="form-control form-control-sm form-control-border" required value="<?= isset($email) ? $email : "" ?>">
                                <small class="ml-3">Email</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                <input type="password" name="password" id="password" placeholder="" class="form-control form-control-sm form-control-border">
                                <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                                </div>
                                </div>
                                <small class="ml-3">New Password</small>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                <input type="password" id="cpassword" placeholder="" class="form-control form-control-sm form-control-border">
                                <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                                </div>
                                </div>
                                <small class="ml-3">Confirm New Password</small>
                            </div>
                            <div class="col-12"><small class="text-muted"><em>Fill the password fields above only if you want to update your password.</em></small></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                <input type="password" name="oldpassword" id="oldpassword" placeholder="" class="form-control form-control-sm form-control-border" required>
                                <div class="input-group-append border-bottom border-top-0 border-left-0 border-right-0">
                                    <span class="input-append-text text-sm"><i class="fa fa-eye-slash text-muted pass_type" data-type="password"></i></span>
                                </div>
                                </div>
                                <small class="ml-3">Current Password</small>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                            <label for="" class="control-label">Avatar</label>
                            <div class="custom-file">
                                    <input type="file" class="custom-file-input rounded-0 form-control form-control-sm form-control-border" id="customFile" name="img" onchange="displayImg(this,$(this))">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                            </div>
                        <div class="row">
                        </div>
                            <div class="form-group col-md-6 d-flex justify-content-center">
                            <img src="<?php echo validate_image(isset($image_path) ? $image_path : "") ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
                            </div>
                        </div>
                        <div class="row align-items-center">
                            <div class="col-8">
                            </div>
                            <!-- /.col -->
                            <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-sm btn-flat btn-block">Update Details</button>
                            </div>
                            <!-- /.col -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
     window.displayImg = function(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
            $('#cimg').attr('src', "<?php echo validate_image(isset($image_path) ? $image_path : "") ?>");
            _this.siblings('.custom-file-label').html("Choose file")
        }
	}
    $(function(){
        $('.pass_type').click(function(){
            var type = $(this).attr('data-type')
            if(type == 'password'){
                $(this).attr('data-type','text')
                $(this).closest('.input-group').find('input').attr('type',"text")
                $(this).removeClass("fa-eye-slash")
                $(this).addClass("fa-eye")
            }else{
                $(this).attr('data-type','password')
                $(this).closest('.input-group').find('input').attr('type',"password")
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
                url:_base_url_+"classes/Users.php?f=save_client",
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