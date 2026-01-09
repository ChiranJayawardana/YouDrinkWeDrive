<style>
  .user-img{
        height: 35px;
        width: 35px;
        object-fit: cover;
        border-radius: 50%;
        border: 2px solid rgba(255,255,255,0.3);
  }
  .btn-rounded{
        border-radius: 50px;
  }
  /* Modern Glassmorphism Navbar */
  .main-header.navbar {
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.95) 0%, rgba(168, 85, 247, 0.95) 100%) !important;
    backdrop-filter: blur(10px);
    -webkit-backdrop-filter: blur(10px);
    box-shadow: 0 4px 20px rgba(147, 51, 234, 0.3) !important;
    border: none !important;
    padding: 0.75rem 1.5rem !important;
  }
  .main-header .navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.9) !important;
    font-weight: 500 !important;
    padding: 0.5rem 1rem !important;
    border-radius: 8px !important;
    transition: all 0.3s ease !important;
    margin: 0 0.25rem !important;
  }
  .main-header .navbar-nav .nav-link:hover {
    background: rgba(255, 255, 255, 0.15) !important;
    color: white !important;
    transform: translateY(-2px) !important;
  }
  .main-header .navbar-nav .nav-link i {
    margin-right: 0.5rem;
  }
  .main-header .btn-group .btn {
    background: rgba(255, 255, 255, 0.15) !important;
    border: 1px solid rgba(255, 255, 255, 0.2) !important;
    color: white !important;
    padding: 0.5rem 1rem !important;
    border-radius: 50px !important;
    backdrop-filter: blur(10px);
    transition: all 0.3s ease !important;
  }
  .main-header .btn-group .btn:hover {
    background: rgba(255, 255, 255, 0.25) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 4px 15px rgba(0,0,0,0.2) !important;
  }
  .main-header .dropdown-menu {
    border-radius: 12px !important;
    border: none !important;
    box-shadow: 0 8px 30px rgba(0,0,0,0.15) !important;
    margin-top: 0.5rem !important;
    padding: 0.5rem 0 !important;
    background: white !important;
  }
  .main-header .dropdown-item {
    padding: 0.75rem 1.5rem !important;
    transition: all 0.2s ease !important;
    color: #4a5568 !important;
  }
  .main-header .dropdown-item:hover {
    background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%) !important;
    color: white !important;
  }
  .main-header .dropdown-item i {
    margin-right: 0.75rem;
    width: 20px;
  }
</style>
<!-- Navbar -->
      <nav class="main-header navbar navbar-expand navbar-light text-sm">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
          </li>
          <li class="nav-item d-none d-sm-inline-block">
            <a href="<?php echo base_url ?>" class="nav-link"><i class="fas fa-home"></i> <?php echo (!isMobileDevice()) ? $_settings->info('name'):$_settings->info('short_name'); ?> - Admin</a>
          </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
          <!-- Messages Dropdown Menu -->
          <li class="nav-item">
            <div class="btn-group">
                  <button type="button" class="btn btn-rounded dropdown-toggle" data-toggle="dropdown">
                    <img src="<?php echo validate_image($_settings->userdata('avatar')) ?>" class="user-img" alt="User Image" onerror="this.src='<?php echo base_url ?>dist/img/no-image-available.png'">
                    <span class="ml-2"><?php echo ucwords($_settings->userdata('firstname').' '.$_settings->userdata('lastname')) ?></span>
                    <span class="sr-only">Toggle Dropdown</span>
                  </button>
                  <div class="dropdown-menu dropdown-menu-right" role="menu">
                    <a class="dropdown-item" href="<?php echo base_url.'admin/?page=user' ?>"><i class="fa fa-user-circle"></i> My Account</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="<?php echo base_url.'/classes/Login.php?f=logout' ?>"><i class="fas fa-power-off"></i> Logout</a>
                  </div>
              </div>
          </li>
        </ul>
      </nav>
      <!-- /.navbar -->