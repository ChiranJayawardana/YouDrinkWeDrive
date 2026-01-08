<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
    <h1 class="gradient-text-animated" style="font-size: 2.5rem; font-weight: 800; margin: 0;">
        <i class="fas fa-taxi icon-bounce"></i> Dashboard
    </h1>
    <div style="text-align: right;">
        <div style="color: #64748b; font-size: 0.9rem;">Welcome back,</div>
        <div style="color: #0f172a; font-weight: 700; font-size: 1.1rem;"><?= $_settings->userdata('firstname') ?> <?= $_settings->userdata('lastname') ?></div>
    </div>
</div>
<style>
  #cover_img_dash{
    width:100%;
    max-height:50vh;
    object-fit:cover;
    object-position:bottom center;
  }
</style>
<div class="row">
            <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box modern-info-box teal glass-card hover-lift-md" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1 morphing" style="background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%); border-radius: 12px;"><i class="fas fa-copyright icon-pulse"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">Categories</span>
                <span class="info-box-number count-up" style="font-weight: 800; color: #0891b2;">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM category_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
                <div style="font-size: 0.75rem; color: #10b981; margin-top: 5px;">
                    <i class="fas fa-arrow-up"></i> Active
                </div>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-gradient-warning elevation-1"><i class="fas fa-taxi"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Available Drivers</span>
                <span class="info-box-number">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM driver_list where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3 modern-info-box" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%); border-radius: 12px;"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">Registered Clients</span>
                <span class="info-box-number" style="font-weight: 800; color: #0d9488;">
                  <?php 
                    $mechanics = $conn->query("SELECT count(id) as total FROM `client_list` where delete_flag = 0 ")->fetch_assoc()['total'];
                    echo number_format($mechanics);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box modern-info-box" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); border-radius: 12px;"><i class="fas fa-bookmark"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">Bookings Made</span>
                <span class="info-box-number" style="font-weight: 800; color: #2563eb;">
                  <?php 
                    $inv = $conn->query("SELECT count(id) as total FROM booking_list ")->fetch_assoc()['total'];
                    echo number_format($inv);
                  ?>
                  <?php ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
       


        <div class="row">

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3">
              <span class="info-box-icon bg-gradient-gray elevation-1"><i class="fas fa-spinner"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Pending Bookings</span>
                <span class="info-box-number">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 0 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3 modern-info-box" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border-radius: 12px;"><i class="fas fa-times-circle"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">Cancelled Bookings</span>
                <span class="info-box-number" style="font-weight: 800; color: #dc2626;">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 4 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>

          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3 modern-info-box" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); border-radius: 12px;"><i class="fas fa-road"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">Ongoing Trips</span>
                <span class="info-box-number" style="font-weight: 800; color: #d97706;">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 2 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3 modern-info-box" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); border-radius: 12px;"><i class="fas fa-tasks"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">Trips Completed</span>
                <span class="info-box-number" style="font-weight: 800; color: #059669;">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `booking_list` where status = 3 ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>


          
        </div>

        <div class="row">
          <div class="col-12 col-sm-6 col-md-3">
            <div class="shadow info-box mb-3 modern-info-box" style="border-radius: 15px;">
              <span class="info-box-icon elevation-1" style="background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%); border-radius: 12px;"><i class="fas fa-users-cog"></i></span>

              <div class="info-box-content">
                <span class="info-box-text" style="font-weight: 600; color: #64748b;">System Users</span>
                <span class="info-box-number" style="font-weight: 800; color: #7c3aed;">
                <?php 
                    $services = $conn->query("SELECT count(id) as total FROM `users` ")->fetch_assoc()['total'];
                    echo number_format($services);
                  ?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
        </div>

        <hr>
    <!-- <div class="text-center">
      <img src="<?= validate_image($_settings->info('cover')) ?>" alt="System Cover" class="w-100 img-fluid img-thumnail border" id="cover_img_dash">
    </div> -->
