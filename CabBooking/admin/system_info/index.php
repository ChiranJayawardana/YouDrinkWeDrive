<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>

<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
	img#cimg2{
		height: 50vh;
		width: 100%;
		object-fit: contain;
		/* border-radius: 100% 100%; */
	}
</style>
<style>
	.system-info-card {
		border-radius: 20px;
		border: none;
		box-shadow: 0 6px 20px rgba(0,0,0,0.1);
	}
	.system-info-header {
		background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
		padding: 30px;
		border-radius: 20px 20px 0 0;
		border-bottom: none;
	}
	.system-info-header h5 {
		color: white;
		font-weight: 800;
		font-size: 1.75rem;
		margin: 0;
		display: flex;
		align-items: center;
		gap: 15px;
	}
	.system-section {
		background: white;
		border-radius: 15px;
		padding: 30px;
		margin-bottom: 25px;
		box-shadow: 0 3px 10px rgba(0,0,0,0.08);
	}
	.system-section-title {
		font-size: 1.25rem;
		font-weight: 700;
		color: #0f172a;
		margin-bottom: 25px;
		display: flex;
		align-items: center;
		gap: 12px;
		padding-bottom: 15px;
		border-bottom: 2px solid #e2e8f0;
	}
	.system-section-title i {
		color: #06b6d4;
		font-size: 1.5rem;
	}
	.image-preview-container {
		text-align: center;
		padding: 20px;
		background: #f8fafc;
		border-radius: 12px;
		border: 2px dashed #e2e8f0;
		transition: all 0.3s ease;
	}
	.image-preview-container:hover {
		border-color: #06b6d4;
		background: white;
	}
	img.admin-image-preview {
		border-radius: 15px;
		box-shadow: 0 4px 12px rgba(0,0,0,0.1);
	}
</style>

<div class="col-lg-12">
	<div class="card system-info-card">
		<div class="card-header system-info-header">
			<h5 class="card-title">
				<i class="fas fa-cogs"></i>
				<span>System Information</span>
			</h5>
		</div>
		<div class="card-body" style="padding: 35px; background: #f8fafc;">
			<form action="" id="system-frm" class="admin-modern-form">
			<div id="msg" class="form-group"></div>
			
			<div class="system-section">
				<div class="system-section-title">
					<i class="fas fa-info-circle"></i>
					<span>Basic Information</span>
				</div>
				<div class="form-group">
					<label for="name" class="control-label">
						<i class="fas fa-tag"></i>
						<span>System Name</span>
					</label>
					<input type="text" class="form-control" name="name" id="name" value="<?php echo $_settings->info('name') ?>" style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 12px 18px; font-size: 1rem;">
				</div>
				<div class="form-group">
					<label for="short_name" class="control-label">
						<i class="fas fa-bookmark"></i>
						<span>System Short Name</span>
					</label>
					<input type="text" class="form-control" name="short_name" id="short_name" value="<?php echo  $_settings->info('short_name') ?>" style="border: 2px solid #e2e8f0; border-radius: 12px; padding: 12px 18px; font-size: 1rem;">
				</div>
			</div>
			<div class="system-section">
				<div class="system-section-title">
					<i class="fas fa-file-alt"></i>
					<span>Page Content</span>
				</div>
				<div class="form-group">
					<label for="" class="control-label">
						<i class="fas fa-home"></i>
						<span>Welcome Content</span>
					</label>
					<small class="form-text text-muted mb-2">
						<i class="fas fa-info-circle"></i> This content will appear on the <strong>Home Page</strong> between the statistics and features sections. Use the rich text editor to format your content with images, lists, and more.
					</small>
					<textarea name="content[welcome]" id="" cols="30" rows="2" class="form-control summernote"><?php echo  is_file(base_app.'welcome.html') ? file_get_contents(base_app.'welcome.html') : "" ?></textarea>
				</div>
				<div class="form-group">
					<label for="" class="control-label">
						<i class="fas fa-info-circle"></i>
						<span>About Us</span>
					</label>
					<small class="form-text text-muted mb-2">
						<i class="fas fa-info-circle"></i> This content will appear on the <strong>About Us Page</strong>. Share your company's story, mission, and values using the rich text editor.
					</small>
					<textarea name="content[about]" id="" cols="30" rows="2" class="form-control summernote"><?php echo  is_file(base_app.'about.html') ? file_get_contents(base_app.'about.html') : "" ?></textarea>
				</div>
			</div>
			<div class="system-section">
				<div class="system-section-title">
					<i class="fas fa-images"></i>
					<span>Branding Assets</span>
				</div>
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">
								<i class="fas fa-circle-notch"></i>
								<span>System Logo</span>
							</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
								<label class="custom-file-label" for="customFile">Choose file</label>
							</div>
						</div>
						<div class="form-group image-preview-container">
							<img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="" id="cimg" class="img-fluid admin-image-preview" style="max-height: 200px;">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="" class="control-label">
								<i class="fas fa-image"></i>
								<span>Website Cover</span>
							</label>
							<div class="custom-file">
								<input type="file" class="custom-file-input" id="customFile2" name="cover" onchange="displayImg2(this,$(this))">
								<label class="custom-file-label" for="customFile2">Choose file</label>
							</div>
						</div>
						<div class="form-group image-preview-container">
							<img src="<?php echo validate_image($_settings->info('cover')) ?>" alt="" id="cimg2" class="img-fluid admin-image-preview" style="max-height: 200px; max-width: 100%; object-fit: contain;">
						</div>
					</div>
				</div>
			</div>
			</form>
		</div>
		<div class="card-footer" style="background: white; border-top: 2px solid #e2e8f0; border-radius: 0 0 20px 20px; padding: 25px;">
			<div class="col-md-12">
				<div class="row">
					<button class="btn btn-sm" form="system-frm" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; padding: 14px 40px; border-radius: 12px; font-size: 1.1rem; font-weight: 700; box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3); border: none; transition: all 0.3s ease;" onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 25px rgba(6, 182, 212, 0.4)'" onmouseout="this.style.transform=''; this.style.boxShadow='0 6px 20px rgba(6, 182, 212, 0.3)'">
						<i class="fas fa-save"></i> Update Settings
					</button>
				</div>
			</div>
		</div>

	</div>
</div>
<script>
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg2(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg2').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	function displayImg3(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	_this.siblings('.custom-file-label').html(input.files[0].name)
	        	$('#cimg3').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	$(document).ready(function(){
		 $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
	})
</script>