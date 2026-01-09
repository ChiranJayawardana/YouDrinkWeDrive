<?php require_once('config.php'); ?>
<!DOCTYPE html>
<html lang="en">
<?php require_once('inc/header.php') ?>
<body>
<?php $page = isset($_GET['p']) ? $_GET['p'] : 'home';  ?>
<?php require_once('inc/topBarNav.php') ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
<?php endif;?>
<?php 
    if(!file_exists($page.".php") && !is_dir($page)){
        include '404.html';
    }else{
      if(is_dir($page))
        include $page.'/index.php';
      else
        include $page.'.php';
    }
?>
<?php require_once('inc/footer.php') ?>

  <!-- Modern Modal Designs -->
  <div class="modal fade modal-modern" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i>Cancel
          </button>
          <button type="button" class="btn-modern btn-modern-primary" id='submit' onclick="$('#uni_modal form').submit()">
            <i class="fas fa-save mr-2"></i>Save
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade modal-modern" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        </div>
      </div>
    </div>
  </div>
  
  <div class="modal fade modal-modern" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content" style="background: #1f2937; border-radius: 16px;">
        <button type="button" class="btn-close" data-dismiss="modal" style="position: absolute; top: 1rem; right: 1rem; z-index: 1000; background: white; border-radius: 50%; width: 40px; height: 40px; display: flex; align-items: center; justify-content: center;">
          <span class="fa fa-times"></span>
        </button>
        <img src="" alt="" style="border-radius: 16px;">
      </div>
    </div>
  </div>
  
  <div class="modal fade modal-modern" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white;">
          <h5 class="modal-title"><i class="fas fa-exclamation-triangle mr-2"></i>Confirmation Required</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 2rem;">
          <div id="delete_content" style="font-size: 1.125rem; color: #374151;"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn-modern btn-modern-secondary" data-dismiss="modal">
            <i class="fas fa-times mr-2"></i>Cancel
          </button>
          <button type="button" class="btn-modern btn-modern-danger" id='confirm' onclick="">
            <i class="fas fa-check mr-2"></i>Confirm
          </button>
        </div>
      </div>
    </div>
  </div>

</body>
</html>