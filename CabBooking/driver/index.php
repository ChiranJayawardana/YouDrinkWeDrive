<?php require_once('../config.php'); ?>
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

  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content modern-modal-content">
        <div class="modern-modal-header">
          <h5 class="modern-modal-title"></h5>
          <button type="button" class="modern-modal-close" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="modal-body modern-modal-body">
        </div>
        <div class="modal-footer modern-modal-footer">
          <button type="button" class="btn-modal-cancel" data-dismiss="modal">
            <i class="fas fa-times"></i> Cancel
          </button>
          <button type="button" class="btn-modal-save" id='submit' onclick="$('#uni_modal form').submit()">
            <i class="fas fa-save"></i> Save
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <style>
    /* Modern Modal Styles */
    .modern-modal-content {
      border-radius: 20px;
      border: none;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      overflow: hidden;
    }
    .modern-modal-header {
      background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
      padding: 25px 30px;
      color: white;
      position: relative;
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-bottom: none;
    }
    .modern-modal-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
      color: white;
    }
    .modern-modal-close {
      width: 35px;
      height: 35px;
      background: rgba(255,255,255,0.2);
      border: none;
      border-radius: 50%;
      color: white;
      font-size: 1rem;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      transition: all 0.3s ease;
    }
    .modern-modal-close:hover {
      background: rgba(255,255,255,0.3);
      transform: rotate(90deg);
    }
    .modern-modal-body {
      padding: 30px;
      background: #f8fafc;
    }
    .modern-modal-footer {
      padding: 20px 30px;
      background: white;
      border-top: 2px solid #e2e8f0;
      display: flex;
      justify-content: flex-end;
      gap: 15px;
    }
    .btn-modal-cancel,
    .btn-modal-save {
      padding: 12px 30px;
      border-radius: 10px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
    }
    .btn-modal-cancel {
      background: #e2e8f0;
      color: #475569;
    }
    .btn-modal-cancel:hover {
      background: #cbd5e0;
      transform: translateY(-2px);
    }
    .btn-modal-save {
      background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(20, 184, 166, 0.3);
    }
    .btn-modal-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(20, 184, 166, 0.4);
    }
  </style>
  <div class="modal fade" id="uni_modal_right" role='dialog'>
    <div class="modal-dialog  rounded-0 modal-full-height  modal-md" role="document">
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
      <div class="modal-content viewer-modal-content">
        <button type="button" class="viewer-close-btn" data-dismiss="modal">
          <i class="fas fa-times"></i>
        </button>
        <img src="" alt="">
      </div>
    </div>
  </div>
  
  <style>
    /* Viewer Modal */
    .viewer-modal-content {
      background: #0f172a;
      border-radius: 20px;
      border: none;
      padding: 20px;
      position: relative;
    }
    .viewer-close-btn {
      position: absolute;
      top: 20px;
      right: 20px;
      width: 45px;
      height: 45px;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(10px);
      border: none;
      border-radius: 50%;
      color: white;
      font-size: 1.2rem;
      cursor: pointer;
      z-index: 10;
      transition: all 0.3s ease;
    }
    .viewer-close-btn:hover {
      background: #ef4444;
      transform: rotate(90deg) scale(1.1);
    }
    .viewer-modal-content img {
      max-width: 100%;
      max-height: 80vh;
      border-radius: 12px;
    }
  </style>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>

</body>
</html>