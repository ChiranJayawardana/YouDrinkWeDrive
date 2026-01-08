<script>
  $(document).ready(function(){
    $('#p_use').click(function(){
      uni_modal("Privacy Policy","policy.php","mid-large")
    })
     window.viewer_modal = function($src = ''){
      start_loader()
      var t = $src.split('.')
      t = t[1]
      if(t =='mp4'){
        var view = $("<video src='"+$src+"' controls autoplay></video>")
      }else{
        var view = $("<img src='"+$src+"' />")
      }
      $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
      $('#viewer_modal .modal-content').append(view)
      $('#viewer_modal').modal({
              show:true,
              backdrop:'static',
              keyboard:false,
              focus:true
            })
            end_loader()  

  }
    window.uni_modal = function($title = '' , $url='',$size=""){
        start_loader()
        $.ajax({
            url:$url,
            error:err=>{
                console.log()
                alert("An error occured")
            },
            success:function(resp){
                if(resp){
                    $('#uni_modal .modal-title').html($title)
                    $('#uni_modal .modal-body').html(resp)
                    if($size != ''){
                        $('#uni_modal .modal-dialog').addClass($size+'  modal-dialog-centered')
                    }else{
                        $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md modal-dialog-centered")
                    }
                    $('#uni_modal').modal({
                      show:true,
                      backdrop:'static',
                      keyboard:false,
                      focus:true
                    })
                    end_loader()
                }
            }
        })
    }
    window._conf = function($msg='',$func='',$params = []){
       $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
       $('#confirm_modal .modal-body').html($msg)
       $('#confirm_modal').modal('show')
    }
  })
</script>
<style>
    .modern-footer {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        padding: 60px 0 30px;
        color: white;
        margin-top: 80px;
    }
    .footer-content {
        display: grid;
        grid-template-columns: 2fr 1fr 1fr 1fr;
        gap: 40px;
        margin-bottom: 40px;
    }
    .footer-brand {
        display: flex;
        flex-direction: column;
    }
    .footer-logo {
        width: 60px;
        height: 60px;
        margin-bottom: 20px;
    }
    .footer-brand h3 {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #06b6d4;
    }
    .footer-brand p {
        color: #94a3b8;
        line-height: 1.6;
    }
    .footer-section h4 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 20px;
        color: white;
    }
    .footer-links {
        list-style: none;
        padding: 0;
    }
    .footer-links li {
        margin-bottom: 12px;
    }
    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .footer-links a:hover {
        color: #06b6d4;
        transform: translateX(5px);
    }
    .footer-social {
        display: flex;
        gap: 15px;
        margin-top: 20px;
    }
    .footer-social a {
        width: 45px;
        height: 45px;
        background: rgba(6, 182, 212, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #06b6d4;
        transition: all 0.3s ease;
    }
    .footer-social a:hover {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        transform: translateY(-3px);
    }
    .footer-bottom {
        border-top: 1px solid rgba(255,255,255,0.1);
        padding-top: 30px;
        text-align: center;
        color: #64748b;
    }
    .footer-bottom p {
        margin: 0;
    }
    .footer-bottom a {
        color: #06b6d4;
        text-decoration: none;
        font-weight: 600;
    }
    .footer-bottom a:hover {
        color: #14b8a6;
    }
    @media (max-width: 992px) {
        .footer-content {
            grid-template-columns: 1fr 1fr;
            gap: 30px;
        }
    }
    @media (max-width: 576px) {
        .footer-content {
            grid-template-columns: 1fr;
        }
    }
</style>

<!-- Footer-->
<footer class="modern-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-brand">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="Logo" class="footer-logo">
                <h3><?php echo $_settings->info('short_name') ?></h3>
                <p>Your trusted partner for safe and reliable transportation services. Available 24/7 to serve you.</p>
                <div class="footer-social">
                    <a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="./"><i class="fas fa-home"></i> Home</a></li>
                    <li><a href="./?p=about"><i class="fas fa-info-circle"></i> About Us</a></li>
                    <li><a href="./?p=cab_available"><i class="fas fa-taxi"></i> Book Driver</a></li>
                    <li><a href="./?p=contact"><i class="fas fa-envelope"></i> Contact</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Account</h4>
                <ul class="footer-links">
                    <li><a href="./login.php"><i class="fas fa-sign-in-alt"></i> Login</a></li>
                    <li><a href="./register.php"><i class="fas fa-user-plus"></i> Register</a></li>
                    <li><a href="./?p=booking_list"><i class="fas fa-list"></i> My Bookings</a></li>
                    <li><a href="./?p=manage_account"><i class="fas fa-user-cog"></i> Settings</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h4>Support</h4>
                <ul class="footer-links">
                    <li><a href="./?p=contact"><i class="fas fa-headset"></i> Help Center</a></li>
                    <li><a href="#"><i class="fas fa-shield-alt"></i> Privacy Policy</a></li>
                    <li><a href="#"><i class="fas fa-file-contract"></i> Terms of Service</a></li>
                    <li><a href="#"><i class="fas fa-question-circle"></i> FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y');?> <?php echo $_settings->info('short_name') ?>. All rights reserved. | Developed by <a href="#">Chiran Jayawardhana</a></p>
        </div>
    </div>
</footer>

   
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- JQVMap -->
    <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
    <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <!-- overlayScrollbars -->
    <!-- <script src="<?php echo base_url ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
    <!-- Advanced Interactions -->
    <script src="<?php echo base_url ?>assets/js/animations.js"></script>
    <script src="<?php echo base_url ?>assets/js/interactions.js"></script>
    <script src="<?php echo base_url ?>assets/js/form-enhancements.js"></script>
    <div class="daterangepicker ltr show-ranges opensright">
      <div class="ranges">
        <ul>
          <li data-range-key="Today">Today</li>
          <li data-range-key="Yesterday">Yesterday</li>
          <li data-range-key="Last 7 Days">Last 7 Days</li>
          <li data-range-key="Last 30 Days">Last 30 Days</li>
          <li data-range-key="This Month">This Month</li>
          <li data-range-key="Last Month">Last Month</li>
          <li data-range-key="Custom Range">Custom Range</li>
        </ul>
      </div>
      <div class="drp-calendar left">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
      </div>
      <div class="drp-calendar right">
        <div class="calendar-table"></div>
        <div class="calendar-time" style="display: none;"></div>
      </div>
      <div class="drp-buttons"><span class="drp-selected"></span><button class="cancelBtn btn btn-sm btn-default" type="button">Cancel</button><button class="applyBtn btn btn-sm btn-primary" disabled="disabled" type="button">Apply</button> </div>
    </div>
    <div class="jqvmap-label" style="display: none; left: 1093.83px; top: 394.361px;">Idaho</div>