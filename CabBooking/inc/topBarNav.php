<style>
  img#user_avatar {
    width: 2em;
    height: 2em;
    object-fit: cover;
    object-position: center center;
}
</style>
<style>
    #topNavBar {
        background: rgba(255, 255, 255, 0.85) !important;
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border-bottom: 1px solid rgba(6, 182, 212, 0.1);
    }
    #topNavBar.scrolled {
        background: rgba(255, 255, 255, 0.95) !important;
        box-shadow: 0 6px 30px rgba(0, 0, 0, 0.12);
        padding-top: 8px;
        padding-bottom: 8px;
    }
    #topNavBar .navbar-brand {
        font-weight: 700;
        font-size: 1.25rem;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    #topNavBar .navbar-brand:hover {
        transform: scale(1.05);
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }
    #topNavBar .nav-link {
        font-weight: 600;
        transition: all 0.3s ease;
        position: relative;
        color: #475569 !important;
        padding: 8px 16px;
        border-radius: 10px;
    }
    #topNavBar .nav-link::after {
        content: '';
        position: absolute;
        bottom: 5px;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 60%;
        height: 2px;
        background: linear-gradient(90deg, #06b6d4, #14b8a6);
        border-radius: 2px;
        transition: transform 0.3s ease;
    }
    #topNavBar .nav-link:hover {
        color: #06b6d4 !important;
        background: rgba(6, 182, 212, 0.05);
    }
    #topNavBar .nav-link:hover::after,
    #topNavBar .nav-link.active::after {
        transform: translateX(-50%) scaleX(1);
    }
    #topNavBar .nav-link.active {
        color: #06b6d4 !important;
        background: rgba(6, 182, 212, 0.1);
    }
    #topNavBar .dropdown-menu {
        border-radius: 16px;
        border: 1px solid rgba(6, 182, 212, 0.1);
        box-shadow: 0 12px 40px rgba(0, 0, 0, 0.12);
        padding: 12px;
        background: rgba(255, 255, 255, 0.98);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
    }
    #topNavBar .dropdown-item {
        border-radius: 10px;
        padding: 12px 18px;
        transition: all 0.2s ease;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    #topNavBar .dropdown-item i {
        color: #06b6d4;
        transition: all 0.2s ease;
    }
    #topNavBar .dropdown-item:hover {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        transform: translateX(5px);
    }
    #topNavBar .dropdown-item:hover i {
        color: white;
    }
    #user_avatar {
        border: 3px solid #06b6d4 !important;
        box-shadow: 0 4px 12px rgba(6, 182, 212, 0.3);
        transition: all 0.3s ease;
        position: relative;
    }
    #user_avatar:hover {
        transform: scale(1.1);
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
    }
    .online-indicator {
        position: absolute;
        bottom: 2px;
        right: 2px;
        width: 12px;
        height: 12px;
        background: #10b981;
        border-radius: 50%;
        border: 2px solid white;
        box-shadow: 0 0 8px rgba(16, 185, 129, 0.6);
        animation: pulse 2s ease-in-out infinite;
    }
</style>
<nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="topNavBar">
            <div class="container px-4 px-lg-5 ">
                <button class="navbar-toggler btn btn-sm" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <a class="navbar-brand" href="./">
                <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="30" height="30" class="d-inline-block align-top" alt="" loading="lazy">
                <?php echo $_settings->info('short_name') ?>
                </a>

                <!-- <form class="form-inline" id="search-form">
                  <div class="input-group">
                    <input class="form-control form-control-sm form " type="search" placeholder="Search" aria-label="Search" name="search"  value="<?php echo isset($_GET['search']) ? $_GET['search'] : "" ?>"  aria-describedby="button-addon2">
                    <div class="input-group-append">
                      <button class="btn btn-outline-success btn-sm m-0" type="submit" id="button-addon2"><i class="fa fa-search"></i></button>
                    </div>
                  </div>
                </form> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4">
                        <li class="nav-item"><a class="nav-link <?= isset($page) && $page == 'home'? "active" : '' ?>" aria-current="page" href="./">Home</a></li>
                        <li class="nav-item"><a class="nav-link <?= isset($page) && $page == 'about'? "active" : '' ?>" href="./?p=about">About Us</a></li>
                        <li class="nav-item"><a class="nav-link <?= isset($page) && $page == 'contact'? "active" : '' ?>" href="./?p=contact">Contact</a></li>
                        <li class="nav-item"><a class="nav-link <?= isset($page) && $page == 'cab_available'? "active" : '' ?>" href="./?p=cab_available">Available Drivers</a></li>
                    </ul>
                    <div class="d-flex align-items-center">
                    </div>
                </div>
                <div>
                  <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>
                    <div class="d-flex align-items-end">
                      <div class="navbar-nav nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span style="position: relative; display: inline-block;">
                            <img src="<?= validate_image($_settings->userdata('image_path')) ?>" alt="user_avatar" id="user_avatar" class="img-fluid img-thumbnail rounded-circle">
                            <span class="online-indicator"></span>
                          </span> 
                          <span style="margin-left: 8px; font-weight: 600;">Hello, <?= $_settings->userdata('firstname') ?></span>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="./?p=booking_list"><i class="fas fa-list"></i> My Bookings</a>
                          <a class="dropdown-item" href="./?p=manage_account"><i class="fas fa-user-cog"></i> Manage Account</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="./classes/Login.php?f=logout_client"><i class="fas fa-sign-out-alt"></i> Logout</a>
                        </div>
                      </div>
                    </div>
                  <?php else: ?>
                    <a href="./login.php" class="text-reset text-decoration-none mx-2"><b>Login</b></a> 
                    <a href="./register.php" class="text-reset text-decoration-none mx-2"><b>Register</b></a>
                    <a href="./driver/login.php" class="text-reset text-decoration-none mx-2"><b>Driver Panel</b></a>
                    <!-- <a href="./admin/login.php" class="text-reset text-decoration-none mx-2"><b>Admin</b></a> -->
                  <?php endif; ?>
                </div>
            </div>
        </nav>
<script>
  $(function(){
    $('#login-btn').click(function(){
      uni_modal("","login.php")
    })
    $('#navbarResponsive').on('show.bs.collapse', function () {
        $('#mainNav').addClass('navbar-shrink')
    })
    $('#navbarResponsive').on('hidden.bs.collapse', function () {
        if($('body').offset.top == 0)
          $('#mainNav').removeClass('navbar-shrink')
    })
    
    // Add scrolled class on scroll
    $(window).scroll(function() {
        if ($(this).scrollTop() > 50) {
            $('#topNavBar').addClass('scrolled');
        } else {
            $('#topNavBar').removeClass('scrolled');
        }
    });
  })

  $('#search-form').submit(function(e){
    e.preventDefault()
     var sTxt = $('[name="search"]').val()
     if(sTxt != '')
      location.href = './?p=products&search='+sTxt;
  })
</script>