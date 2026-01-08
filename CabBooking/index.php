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

  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog   rounded-0 modal-md modal-dialog-centered" role="document">
      <div class="modal-content  rounded-0">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
      </div>
    </div>
  </div>
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
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md modal-dialog-centered" role="document">
      <div class="modal-content confirm-modal-content">
        <div class="confirm-modal-header">
          <div class="confirm-icon-wrapper">
            <i class="fas fa-exclamation-triangle"></i>
          </div>
          <h5 class="confirm-modal-title">Confirm Action</h5>
          <button type="button" class="confirm-close-btn" data-dismiss="modal" aria-label="Close">
            <i class="fas fa-times"></i>
          </button>
        </div>
        <div class="confirm-modal-body">
        </div>
        <div class="confirm-modal-footer">
          <button type="button" class="btn-confirm-cancel" data-dismiss="modal">
            <i class="fas fa-times"></i>
            <span>Cancel</span>
          </button>
          <button type="button" class="btn-confirm-continue" id='confirm' onclick="">
            <i class="fas fa-check"></i>
            <span>Confirm</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  
  <style>
    .confirm-modal-content {
      border-radius: 20px;
      border: none;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      overflow: hidden;
    }
    .confirm-modal-header {
      background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
      padding: 30px 25px 20px;
      text-align: center;
      position: relative;
      color: white;
    }
    .confirm-icon-wrapper {
      width: 80px;
      height: 80px;
      background: rgba(255,255,255,0.2);
      backdrop-filter: blur(10px);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 15px;
      border: 3px solid rgba(255,255,255,0.3);
    }
    .confirm-icon-wrapper i {
      font-size: 2.5rem;
      color: white;
    }
    .confirm-modal-title {
      font-size: 1.5rem;
      font-weight: 700;
      margin: 0;
      color: white;
    }
    .confirm-close-btn {
      position: absolute;
      top: 15px;
      right: 15px;
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
    .confirm-close-btn:hover {
      background: rgba(255,255,255,0.3);
      transform: rotate(90deg);
    }
    .confirm-modal-body {
      padding: 30px 25px;
      text-align: center;
      background: #f8f9fa;
    }
    .confirm-modal-body #delete_content {
      font-size: 1rem;
      color: #4a5568;
      line-height: 1.6;
    }
    .confirm-modal-body #delete_content b {
      color: #06b6d4;
      font-weight: 700;
    }
    .confirm-modal-footer {
      padding: 20px 25px;
      display: flex;
      justify-content: flex-end;
      gap: 15px;
      background: white;
      border-top: 1px solid #e2e8f0;
    }
    .btn-confirm-cancel,
    .btn-confirm-continue {
      padding: 12px 30px;
      border-radius: 10px;
      font-weight: 600;
      border: none;
      cursor: pointer;
      transition: all 0.3s ease;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      font-size: 0.95rem;
    }
    .btn-confirm-cancel {
      background: #e2e8f0;
      color: #4a5568;
    }
    .btn-confirm-cancel:hover {
      background: #cbd5e0;
      transform: translateY(-2px);
      box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    .btn-confirm-continue {
      background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
    }
    .btn-confirm-continue:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(245, 101, 101, 0.4);
    }
    @media (max-width: 768px) {
      .confirm-modal-footer {
        flex-direction: column-reverse;
      }
      .btn-confirm-cancel,
      .btn-confirm-continue {
        width: 100%;
        justify-content: center;
      }
    }
    
    /* Modern Modal Styles */
    .modern-modal-content {
      border-radius: 20px;
      border: none;
      box-shadow: 0 10px 40px rgba(0,0,0,0.2);
      overflow: hidden;
    }
    .modern-modal-header {
      background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
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
      background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
      color: white;
      box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
    }
    .btn-modal-save:hover {
      transform: translateY(-2px);
      box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
    }
    
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

</body>
</html>