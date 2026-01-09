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
/* Light Purple Theme Footer */
.footer-modern {
    background: linear-gradient(180deg, #1f2937 0%, #111827 100%);
    color: #f3f4f6;
    padding: 4rem 0 1.5rem;
    margin-top: 5rem;
    border-top: 5px solid #9333ea;
    position: relative;
    overflow: hidden;
}

/* Decorative pattern overlay */
.footer-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: 
        linear-gradient(30deg, rgba(79, 70, 229, 0.05) 12%, transparent 12.5%, transparent 87%, rgba(79, 70, 229, 0.05) 87.5%, rgba(79, 70, 229, 0.05)),
        linear-gradient(150deg, rgba(79, 70, 229, 0.05) 12%, transparent 12.5%, transparent 87%, rgba(79, 70, 229, 0.05) 87.5%, rgba(79, 70, 229, 0.05));
    background-size: 80px 140px;
    opacity: 0.3;
    pointer-events: none;
}

.footer-modern .container {
    position: relative;
    z-index: 1;
}

.footer-modern .footer-content {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    flex-wrap: wrap;
    gap: 3rem;
    margin-bottom: 2.5rem;
    padding-bottom: 2.5rem;
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.footer-modern .footer-brand {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    max-width: 300px;
}

.footer-modern .footer-brand-logo {
    display: flex;
    align-items: center;
    gap: 1rem;
}

.footer-modern .footer-brand img {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    border: 3px solid rgba(79, 70, 229, 0.5);
    padding: 5px;
    background: rgba(255, 255, 255, 0.1);
}

.footer-modern .footer-brand-text {
    font-size: 1.75rem;
    font-weight: 800;
    color: white;
    line-height: 1.2;
}

.footer-modern .footer-brand-desc {
    color: #d1d5db;
    font-size: 0.95rem;
    line-height: 1.6;
    margin-top: 0.5rem;
}

.footer-modern .footer-section {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.footer-modern .footer-section-title {
    font-size: 1.125rem;
    font-weight: 700;
    color: white;
    margin-bottom: 1rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-modern .footer-links {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
}

.footer-modern .footer-link {
    color: #d1d5db;
    text-decoration: none;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.95rem;
}

.footer-modern .footer-link:hover {
    color: #a855f7;
    transform: translateX(5px);
}

.footer-modern .footer-link i {
    font-size: 0.875rem;
    width: 20px;
    color: #9333ea;
}

.footer-modern .footer-social {
    display: flex;
    gap: 0.75rem;
    margin-top: 1rem;
}

.footer-modern .social-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.1);
    border-radius: 50%;
    color: white;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 1.125rem;
}

.footer-modern .social-icon:hover {
    background: #4f46e5;
    transform: translateY(-5px);
    box-shadow: 0 6px 20px rgba(79, 70, 229, 0.5);
}

.footer-modern .footer-bottom {
    padding-top: 1.5rem;
    text-align: center;
}

.footer-modern .footer-bottom p {
    margin: 0;
    color: #9ca3af;
    font-size: 0.875rem;
    line-height: 1.8;
}

.footer-modern .developer-credit {
    color: #a855f7;
    font-weight: 600;
    text-decoration: none;
    transition: color 0.3s ease;
}

.footer-modern .developer-credit:hover {
    color: #c084fc;
    text-decoration: underline;
}

@media (max-width: 768px) {
    .footer-modern {
        padding: 3rem 0 1.5rem;
    }
    
    .footer-modern .footer-content {
        flex-direction: column;
        gap: 2rem;
    }
    
    .footer-modern .footer-brand {
        max-width: 100%;
        text-align: center;
        align-items: center;
    }
    
    .footer-modern .footer-brand-logo {
        justify-content: center;
    }
    
    .footer-modern .footer-section {
        text-align: center;
        align-items: center;
    }
    
    .footer-modern .footer-links {
        align-items: center;
    }
    
    .footer-modern .footer-link:hover {
        transform: translateX(0) translateY(-2px);
    }
}
</style>

<!-- Enhanced Modern Footer -->
<footer class="footer-modern">
    <div class="container">
        <div class="footer-content">
            <!-- Brand Section -->
            <div class="footer-brand">
                <div class="footer-brand-logo">
                    <img src="<?php echo validate_image($_settings->info('logo')) ?>" alt="<?php echo $_settings->info('short_name') ?>">
                    <span class="footer-brand-text"><?php echo $_settings->info('short_name') ?></span>
                </div>
                <p class="footer-brand-desc">Your trusted partner for reliable and comfortable transportation services. Available 24/7 for all your travel needs.</p>
                <div class="footer-social">
                    <a href="#" class="social-icon" title="Facebook" aria-label="Facebook">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="social-icon" title="Twitter" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="social-icon" title="Instagram" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="social-icon" title="LinkedIn" aria-label="LinkedIn">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
            
            <!-- Quick Links Section -->
            <div class="footer-section">
                <h3 class="footer-section-title">Quick Links</h3>
                <div class="footer-links">
                    <a href="./" class="footer-link">
                        <i class="fas fa-home"></i> Home
                    </a>
                    <a href="./?p=about" class="footer-link">
                        <i class="fas fa-info-circle"></i> About Us
                    </a>
                    <a href="./?p=contact" class="footer-link">
                        <i class="fas fa-envelope"></i> Contact
                    </a>
                    <a href="./?p=cab_available" class="footer-link">
                        <i class="fas fa-car"></i> Available Drivers
                    </a>
                </div>
            </div>
            
            <!-- Services Section -->
            <div class="footer-section">
                <h3 class="footer-section-title">Services</h3>
                <div class="footer-links">
                    <a href="./?p=cab_available" class="footer-link">
                        <i class="fas fa-taxi"></i> Book a Ride
                    </a>
                    <a href="./login.php" class="footer-link">
                        <i class="fas fa-user"></i> Client Portal
                    </a>
                    <a href="./driver/login.php" class="footer-link">
                        <i class="fas fa-car-side"></i> Driver Portal
                    </a>
                    <a href="./register.php" class="footer-link">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                </div>
            </div>
            
            <!-- Contact Info Section -->
            <div class="footer-section">
                <h3 class="footer-section-title">Contact Info</h3>
                <div class="footer-links">
                    <a href="tel:+15551234567" class="footer-link">
                        <i class="fas fa-phone"></i> +1 (555) 123-4567
                    </a>
                    <a href="mailto:support@cabbooking.com" class="footer-link">
                        <i class="fas fa-envelope"></i> support@cabbooking.com
                    </a>
                    <span class="footer-link" style="cursor: default;">
                        <i class="fas fa-map-marker-alt"></i> 123 Main St, NY 10001
                    </span>
                    <span class="footer-link" style="cursor: default;">
                        <i class="fas fa-clock"></i> 24/7 Service
                    </span>
                </div>
            </div>
        </div>
        
        <div class="footer-bottom">
            <p>
                &copy; <?php echo date('Y'); ?> <?php echo $_settings->info('short_name') ?>. All rights reserved.
                <br>
                Designed & Developed by <a href="#" class="developer-credit">Chiran Jayawardhana</a>
            </p>
        </div>
    </div>
</footer>

   
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button)
    </script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS - Commented out if file doesn't exist -->
    <?php if(file_exists(base_app.'plugins/chart.js/Chart.min.js')): ?>
    <script src="<?php echo base_url ?>plugins/chart.js/Chart.min.js"></script>
    <?php endif; ?>
    <!-- Sparkline -->
    <script src="<?php echo base_url ?>plugins/sparklines/sparkline.js"></script>
    <!-- Select2 -->
    <script src="<?php echo base_url ?>plugins/select2/js/select2.full.min.js"></script>
    <!-- JQVMap - Commented out if files don't exist -->
    <?php if(file_exists(base_app.'plugins/jqvmap/jquery.vmap.min.js')): ?>
    <script src="<?php echo base_url ?>plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="<?php echo base_url ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <?php endif; ?>
    <!-- jQuery Knob Chart - Commented out if file doesn't exist -->
    <?php if(file_exists(base_app.'plugins/jquery-knob/jquery.knob.min.js')): ?>
    <script src="<?php echo base_url ?>plugins/jquery-knob/jquery.knob.min.js"></script>
    <?php endif; ?>
    <!-- daterangepicker -->
    <?php if(file_exists(base_app.'plugins/moment/moment.min.js')): ?>
    <script src="<?php echo base_url ?>plugins/moment/moment.min.js"></script>
    <?php endif; ?>
    <script src="<?php echo base_url ?>plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 - Only load if moment.js exists -->
    <?php if(file_exists(base_app.'plugins/moment/moment.min.js') && file_exists(base_app.'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')): ?>
    <script src="<?php echo base_url ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <?php endif; ?>
    <!-- Summernote -->
    <script src="<?php echo base_url ?>plugins/summernote/summernote-bs4.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <?php if(file_exists(base_app.'plugins/datatables-responsive/js/dataTables.responsive.min.js')): ?>
    <script src="<?php echo base_url ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <?php endif; ?>
    <!-- overlayScrollbars -->
    <!-- <script src="<?php echo base_url ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
    <!-- AdminLTE App -->
    <script src="<?php echo base_url ?>dist/js/adminlte.js"></script>
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