<style>
/* Light Purple Glassmorphism Navigation */
#topNavBar {
    background: linear-gradient(135deg, rgba(147, 51, 234, 0.85) 0%, rgba(168, 85, 247, 0.85) 100%);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    box-shadow: 0 2px 20px rgba(147, 51, 234, 0.2);
    border-bottom: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    padding: 0.875rem 0;
    position: relative;
}

/* Subtle animated background pattern */
#topNavBar::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: 
        radial-gradient(circle at 20% 50%, rgba(255, 255, 255, 0.08) 0%, transparent 50%),
        radial-gradient(circle at 80% 80%, rgba(255, 255, 255, 0.08) 0%, transparent 50%);
    pointer-events: none;
}

#topNavBar.scrolled {
    background: rgba(147, 51, 234, 0.98);
    backdrop-filter: blur(25px) saturate(180%);
    -webkit-backdrop-filter: blur(25px) saturate(180%);
    box-shadow: 0 4px 30px rgba(147, 51, 234, 0.3);
    border-bottom: 1px solid rgba(255, 255, 255, 0.25);
    padding: 0.75rem 0;
}

/* Enhanced Logo/Brand */
.navbar-brand {
    font-size: 1.625rem;
    font-weight: 800;
    color: white !important;
    display: flex;
    align-items: center;
    gap: 0.875rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    letter-spacing: -0.02em;
    position: relative;
    z-index: 2;
}

.navbar-brand:hover {
    transform: scale(1.05);
    filter: drop-shadow(0 4px 8px rgba(255, 255, 255, 0.2));
}

.navbar-brand img {
    border-radius: 50%;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.navbar-brand:hover img {
    border-color: rgba(255, 255, 255, 0.6);
    transform: rotate(5deg);
}

/* Enhanced Navigation Links */
.navbar-nav .nav-link {
    color: rgba(255, 255, 255, 0.95) !important;
    font-weight: 600;
    font-size: 0.9375rem;
    padding: 0.625rem 1.25rem !important;
    margin: 0 0.25rem;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

/* Animated background on hover */
.navbar-nav .nav-link::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    z-index: -1;
}

.navbar-nav .nav-link:hover::before {
    transform: translateY(0);
}

.navbar-nav .nav-link:hover {
    color: white !important;
    transform: translateY(-2px);
}

.navbar-nav .nav-link.active {
    background-color: rgba(255, 255, 255, 0.25);
    color: white !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}

.navbar-nav .nav-link.active::after {
    content: '';
    position: absolute;
    bottom: 0.375rem;
    left: 1.25rem;
    right: 1.25rem;
    height: 2px;
    background-color: white;
    border-radius: 2px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.navbar-nav .nav-link i {
    font-size: 0.875rem;
    transition: transform 0.3s ease;
}

.navbar-nav .nav-link:hover i {
    transform: scale(1.1);
}

/* Enhanced User Avatar */
img#user_avatar {
    width: 2.75rem;
    height: 2.75rem;
    object-fit: cover;
    object-position: center center;
    border: 3px solid white !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    transition: all 0.3s ease;
}

.dropdown-toggle {
    display: flex;
    align-items: center;
    gap: 0.625rem;
    color: white !important;
    padding: 0.5rem 1rem !important;
    border-radius: 12px;
    transition: all 0.3s ease;
}

.dropdown-toggle:hover {
    background-color: rgba(255, 255, 255, 0.15);
}

.dropdown-toggle:hover img#user_avatar {
    transform: scale(1.05);
    border-color: rgba(255, 255, 255, 1);
}

/* Enhanced Dropdown Menu */
.dropdown-menu {
    border-radius: 14px;
    border: none;
    box-shadow: 0 12px 40px rgba(0, 0, 0, 0.2);
    padding: 0.75rem;
    margin-top: 0.75rem;
    min-width: 220px;
    animation: dropdownSlide 0.3s ease;
}

@keyframes dropdownSlide {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.dropdown-divider {
    margin: 0.5rem 0;
    border-color: rgba(0, 0, 0, 0.08);
}

.dropdown-item {
    border-radius: 10px;
    padding: 0.625rem 1rem;
    transition: all 0.2s ease;
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-weight: 500;
}

.dropdown-item i {
    font-size: 1rem;
    width: 20px;
    text-align: center;
    color: #4f46e5;
}

.dropdown-item:hover {
    background: linear-gradient(135deg, rgba(79, 70, 229, 0.1) 0%, rgba(79, 70, 229, 0.15) 100%);
    color: #4f46e5;
    transform: translateX(5px);
}

/* Enhanced Auth Links */
#topNavBar .text-reset {
    color: white !important;
    padding: 0.625rem 1.25rem;
    border-radius: 10px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    font-weight: 600;
    font-size: 0.9375rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    position: relative;
    overflow: hidden;
}

#topNavBar .text-reset::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(255, 255, 255, 0.2);
    transform: translateY(100%);
    transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

#topNavBar .text-reset:hover::before {
    transform: translateY(0);
}

#topNavBar .text-reset:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Enhanced Mobile Toggler */
.navbar-toggler {
    border: 2px solid rgba(255, 255, 255, 0.6);
    border-radius: 10px;
    padding: 0.625rem;
    transition: all 0.3s ease;
}

.navbar-toggler:hover {
    border-color: white;
    background-color: rgba(255, 255, 255, 0.1);
}

.navbar-toggler:focus {
    box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
    outline: none;
}

.navbar-toggler-icon {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 1%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2.5' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
}

/* Mobile Styles */
@media (max-width: 992px) {
    #topNavBar {
        padding: 0.75rem 0;
    }
    
    .navbar-collapse {
        background: linear-gradient(135deg, rgba(30, 58, 138, 0.98) 0%, rgba(79, 70, 229, 0.98) 100%);
        margin-top: 1rem;
        padding: 1.25rem;
        border-radius: 14px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
        animation: mobileMenuSlide 0.3s ease;
    }
    
    @keyframes mobileMenuSlide {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .navbar-nav .nav-link {
        margin: 0.375rem 0;
        padding: 0.75rem 1rem !important;
    }
    
    #topNavBar .text-reset {
        margin: 0.375rem 0;
        display: flex;
        justify-content: center;
    }
}

@media (max-width: 576px) {
    .navbar-brand {
        font-size: 1.375rem;
    }
    
    .navbar-brand img {
        width: 35px;
        height: 35px;
    }
}
</style>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top navbar-modern" id="topNavBar">
    <div class="container-fluid px-4 px-lg-5">
        <a class="navbar-brand" href="./">
            <img src="<?php echo validate_image($_settings->info('logo')) ?>" width="40" height="40" class="d-inline-block align-top" alt="<?php echo $_settings->info('short_name') ?>" loading="lazy">
            <?php echo $_settings->info('short_name') ?>
        </a>
        
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 me-3">
                <li class="nav-item">
                    <a class="nav-link <?= isset($page) && $page == 'home'? "active" : '' ?>" aria-current="page" href="./">
                        <i class="fas fa-home mr-1"></i> Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($page) && $page == 'about'? "active" : '' ?>" href="./?p=about">
                        <i class="fas fa-info-circle mr-1"></i> About Us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($page) && $page == 'contact'? "active" : '' ?>" href="./?p=contact">
                        <i class="fas fa-envelope mr-1"></i> Contact
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= isset($page) && $page == 'cab_available'? "active" : '' ?>" href="./?p=cab_available">
                        <i class="fas fa-car mr-1"></i> Available Drivers
                    </a>
                </li>
            </ul>
            
            <div class="d-flex align-items-center ms-lg-3">
                <?php if($_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2): ?>
                    <div class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="<?= validate_image($_settings->userdata('image_path')) ?>" alt="user_avatar" id="user_avatar" class="rounded-circle">
                            <span class="ml-2">Hello, <?= $_settings->userdata('firstname') ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item" href="./?p=booking_list">
                                <i class="fas fa-list mr-2"></i> My Bookings
                            </a>
                            <a class="dropdown-item" href="./?p=manage_account">
                                <i class="fas fa-user-cog mr-2"></i> Manage Account
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="./classes/Login.php?f=logout_client">
                                <i class="fas fa-sign-out-alt mr-2"></i> Logout
                            </a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="./login.php" class="text-reset text-decoration-none mx-2">
                        <i class="fas fa-sign-in-alt mr-1"></i> Login
                    </a>
                    <a href="./register.php" class="text-reset text-decoration-none mx-2">
                        <i class="fas fa-user-plus mr-1"></i> Register
                    </a>
                    <a href="./driver/login.php" class="text-reset text-decoration-none mx-2">
                        <i class="fas fa-car-side mr-1"></i> Driver Panel
                    </a>
                <?php endif; ?>
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

  $('#search-form').submit(function(e){
    e.preventDefault()
     var sTxt = $('[name="search"]').val()
     if(sTxt != '')
      location.href = './?p=products&search='+sTxt;
  })
</script>