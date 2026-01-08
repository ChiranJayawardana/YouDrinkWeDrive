<?php require_once('../config.php'); ?>
 <!DOCTYPE html>
<html lang="en" class="" style="height: auto;">
<?php require_once('inc/header.php') ?>
  <body class="sidebar-mini layout-fixed control-sidebar-slide-open layout-navbar-fixed sidebar-mini-md sidebar-mini-xs" data-new-gr-c-s-check-loaded="14.991.0" data-gr-ext-installed="" style="height: auto;">
    <div class="wrapper">
     <?php require_once('inc/topBarNav.php') ?>
     <?php require_once('inc/navigation.php') ?>
              
     <?php $page = isset($_GET['page']) ? $_GET['page'] : 'home';  ?>
     <?php if($_settings->chk_flashdata('success')): ?>
      <script>
        alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
      </script>
    <?php endif;?>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper pt-3" style="min-height: 567.854px;">
      
        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
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
          </div>
        </section>
        <!-- /.content -->
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden;">
        <div class="modal-header" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; border-bottom: none; padding: 25px;">
          <h5 class="modal-title" style="color: white; font-weight: 700;">Confirmation</h5>
          <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 30px; background: #f8fafc;">
          <div id="delete_content"></div>
        </div>
        <div class="modal-footer" style="background: white; border-top: 2px solid #e2e8f0; padding: 20px;">
          <button type="button" class="btn btn-sm" style="background: #e2e8f0; color: #475569; border-radius: 8px; padding: 10px 25px; font-weight: 600;" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-sm" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; border-radius: 8px; padding: 10px 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);" id='confirm' onclick="">Continue</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 20px; border: none; box-shadow: 0 10px 40px rgba(0,0,0,0.2); overflow: hidden;">
        <div class="modal-header" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; border-bottom: none; padding: 25px;">
          <h5 class="modal-title" style="color: white; font-weight: 700;"></h5>
          <button type="button" class="close" data-dismiss="modal" style="color: white; opacity: 1;">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" style="padding: 30px; background: #f8fafc;">
        </div>
        <div class="modal-footer" style="background: white; border-top: 2px solid #e2e8f0; padding: 20px;">
          <button type="button" class="btn btn-sm" style="background: #e2e8f0; color: #475569; border-radius: 8px; padding: 10px 25px; font-weight: 600;" data-dismiss="modal">Cancel</button>
          <button type="button" class="btn btn-sm" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); color: white; border-radius: 8px; padding: 10px 25px; font-weight: 600; box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog modal-full-height  modal-md" role="document">
      <div class="modal-content rounded-0">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span class="fa fa-arrow-right"></span>
        </button>
      </div>
      <div class="modal-body">
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content" style="background: #0f172a; border-radius: 20px; border: none; padding: 20px; position: relative;">
              <button type="button" class="btn-close" data-dismiss="modal" style="position: absolute; top: 20px; right: 20px; width: 45px; height: 45px; background: rgba(255,255,255,0.2); backdrop-filter: blur(10px); border: none; border-radius: 50%; color: white; font-size: 1.2rem; cursor: pointer; z-index: 10; transition: all 0.3s ease;">
                <span class="fa fa-times"></span>
              </button>
              <img src="" alt="" style="max-width: 100%; max-height: 80vh; border-radius: 12px;">
      </div>
    </div>
  </div>
      </div>
      <!-- /.content-wrapper -->
      <?php require_once('inc/footer.php') ?>
  </body>
</html>
