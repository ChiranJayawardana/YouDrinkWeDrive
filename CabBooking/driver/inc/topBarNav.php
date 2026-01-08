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
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    #topNavBar.scrolled {
        background: linear-gradient(135deg, #0d9488 0%, #0f766e 100%) !important;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
    }
    #topNavBar .navbar-brand {
        font-weight: 700;
        font-size: 1.25rem;
        transition: all 0.3s ease;
    }
    #topNavBar .navbar-brand:hover {
        transform: scale(1.05);
    }
    #topNavBar .nav-link {
        font-weight: 500;
        transition: all 0.3s ease;
        position: relative;
    }
    #topNavBar .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%) scaleX(0);
        width: 80%;
        height: 3px;
        background: white;
        border-radius: 2px;
        transition: transform 0.3s ease;
    }
    #topNavBar .nav-link:hover::after,
    #topNavBar .nav-link.active::after {
        transform: translateX(-50%) scaleX(1);
    }
    #topNavBar .dropdown-menu {
        border-radius: 12px;
        border: none;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        padding: 10px;
    }
    #topNavBar .dropdown-item {
        border-radius: 8px;
        padding: 10px 15px;
        transition: all 0.2s ease;
        font-weight: 500;
    }
    #topNavBar .dropdown-item:hover {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
        color: white;
        transform: translateX(5px);
    }
    #user_avatar {
        border: 3px solid white !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
    }
    #user_avatar:hover {
        transform: scale(1.1);
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
                    </ul>
                    <div class="d-flex align-items-center">
                    </div>
                </div>
                <div>
                    <div class="d-flex align-items-end">
                      <div class="navbar-nav nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <span><img src="<?= validate_image($_settings->userdata('image_path')) ?>" alt="user_avatar" id="user_avatar" class="img-fluid img-thumbnail rounded-circle border-dark"></span> Hello, <?= $_settings->userdata('cab_driver') ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                          <a class="dropdown-item" href="./?p=manage_account">Manage Account</a>
                          <a class="dropdown-item" href="<?= base_url ?>classes/Login.php?f=logout_driver">Logout</a>
                        </div>
                      </div>
                    </div>
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
  })

</script>