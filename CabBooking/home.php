<style>
    .home-hero {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 50%, #14b8a6 100%);
        background-size: 200% 200%;
        animation: gradient-animation 15s ease infinite;
        padding: 120px 0 80px;
        color: white;
        position: relative;
        overflow: hidden;
        min-height: 70vh;
        display: flex;
        align-items: center;
    }
    .home-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }
    .home-hero .particle {
        position: absolute;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        pointer-events: none;
    }
    .home-hero-content {
        position: relative;
        z-index: 1;
    }
    .home-hero h1 {
        font-size: 4rem;
        font-weight: 800;
        margin-bottom: 1.5rem;
        text-shadow: 2px 2px 8px rgba(0,0,0,0.2);
        line-height: 1.2;
    }
    .home-hero p {
        font-size: 1.5rem;
        margin-bottom: 2rem;
        opacity: 0.95;
    }
    .home-cta-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }
    .home-cta-btn {
        padding: 16px 40px;
        border-radius: 50px;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.3s ease;
        border: 3px solid transparent;
    }
    .home-cta-primary {
        background: white;
        color: #0891b2;
        box-shadow: 0 8px 25px rgba(0,0,0,0.2);
    }
    .home-cta-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 35px rgba(0,0,0,0.3);
        color: #0891b2;
    }
    .home-cta-secondary {
        background: transparent;
        color: white;
        border-color: white;
    }
    .home-cta-secondary:hover {
        background: white;
        color: #0891b2;
        transform: translateY(-3px);
    }
    
    /* Statistics Section */
    .stats-section {
        padding: 60px 0;
        background: #f0fdfa;
    }
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        border-top: 4px solid transparent;
    }
    .stat-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 12px 30px rgba(6, 182, 212, 0.2);
        border-top-color: #06b6d4;
    }
    .stat-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2rem;
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.3);
    }
    .stat-number {
        font-size: 3rem;
        font-weight: 800;
        color: #0891b2;
        line-height: 1;
        margin-bottom: 10px;
    }
    .stat-label {
        font-size: 1.1rem;
        color: #475569;
        font-weight: 600;
    }
    
    /* Features Section */
    .features-section {
        padding: 80px 0;
        background: white;
    }
    .section-title {
        text-align: center;
        margin-bottom: 60px;
    }
    .section-title h2 {
        font-size: 2.5rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 15px;
    }
    .section-title p {
        font-size: 1.25rem;
        color: #64748b;
    }
    .feature-card {
        background: white;
        border-radius: 20px;
        padding: 40px 30px;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        transition: all 0.3s ease;
        height: 100%;
        border: 2px solid transparent;
    }
    .feature-card:hover {
        border-color: #06b6d4;
        box-shadow: 0 12px 30px rgba(6, 182, 212, 0.15);
        transform: translateY(-5px);
    }
    .feature-icon {
        width: 100px;
        height: 100px;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 25px;
        color: white;
        font-size: 2.5rem;
    }
    .feature-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 15px;
    }
    .feature-description {
        font-size: 1rem;
        color: #64748b;
        line-height: 1.6;
    }
    
    /* CTA Section */
    .cta-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        text-align: center;
    }
    .cta-section h2 {
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 20px;
    }
    .cta-section p {
        font-size: 1.25rem;
        margin-bottom: 30px;
        opacity: 0.95;
    }
    
    @media (max-width: 768px) {
        .home-hero h1 { font-size: 2.5rem; }
        .home-hero p { font-size: 1.1rem; }
        .home-cta-buttons { flex-direction: column; }
        .stat-number { font-size: 2rem; }
        .flip-card { height: auto; }
        .flip-card:hover .flip-card-inner { transform: none; }
        .flip-card-back { position: relative; transform: none; margin-top: 20px; }
    }
    
    /* Loading Bar */
    .loading-bar {
        position: fixed;
        top: 0;
        left: 0;
        width: 0%;
        height: 3px;
        background: linear-gradient(90deg, #06b6d4, #14b8a6);
        z-index: 99999;
        transition: width 0.3s ease;
        box-shadow: 0 0 10px rgba(6, 182, 212, 0.5);
    }
</style>

<!-- Loading Bar -->
<div class="loading-bar"></div>

<!-- Hero Section -->
<section class="home-hero parallax-wrapper">
    <div class="parallax-layer" data-speed="0.5" style="opacity: 0.3;"></div>
    <div class="container home-hero-content">
        <div class="text-center">
            <div class="floating-element" style="animation-delay: 0s;">
                <h1 class="animate-slideInDown gradient-text-animated"><?php echo $_settings->info('name') ?></h1>
            </div>
            <div class="floating-element" style="animation-delay: 0.2s;">
                <p class="animate-slideInUp typing-text" data-text="Your trusted partner for safe and reliable transportation"></p>
            </div>
            <div class="home-cta-buttons animate-slideInUp" style="animation-delay: 0.4s;">
                <a href="./?p=cab_available" class="home-cta-btn home-cta-primary ripple shine hover-lift-md">
                    <i class="fas fa-car icon-bounce"></i>
                    <span>Book a Driver Now</span>
                </a>
                <a href="./?p=about" class="home-cta-btn home-cta-secondary ripple hover-lift-sm">
                    <i class="fas fa-info-circle"></i>
                    <span>Learn More</span>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="row g-4">
            <?php 
            $stats = [
                ['icon' => 'fa-users', 'query' => "SELECT count(id) as total FROM client_list where delete_flag = 0", 'label' => 'Happy Clients'],
                ['icon' => 'fa-taxi', 'query' => "SELECT count(id) as total FROM driver_list where delete_flag = 0", 'label' => 'Available Drivers'],
                ['icon' => 'fa-check-circle', 'query' => "SELECT count(id) as total FROM booking_list where status = 3", 'label' => 'Completed Trips'],
                ['icon' => 'fa-star', 'query' => "SELECT count(id) as total FROM category_list where delete_flag = 0", 'label' => 'Vehicle Categories']
            ];
            foreach($stats as $stat):
                $count = $conn->query($stat['query'])->fetch_assoc()['total'];
            ?>
            <div class="col-lg-3 col-md-6">
                <div class="stat-card animate-fadeInUp">
                    <div class="stat-icon">
                        <i class="fas <?php echo $stat['icon'] ?>"></i>
                    </div>
                    <div class="stat-number"><?php echo number_format($count); ?></div>
                    <div class="stat-label"><?php echo $stat['label'] ?></div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- CMS Content Section (Admin Editable Welcome Content) -->
<?php if(file_exists('./welcome.html') && filesize('./welcome.html') > 100): ?>
<section class="cms-content-section">
    <div class="container">
        <div class="cms-content-wrapper animate-fadeIn">
            <?php include './welcome.html' ?>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Features Section -->
<section class="features-section">
    <div class="container">
        <div class="section-title">
            <h2>Why Choose Us</h2>
            <p>Experience the best cab booking service with these amazing features</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="feature-card scroll-reveal glass-card hover-lift-md">
                    <div class="feature-icon morphing">
                        <i class="fas fa-shield-alt icon-bounce"></i>
                    </div>
                    <h3 class="feature-title">Safe & Secure</h3>
                    <p class="feature-description">All our drivers are verified and trained professionals ensuring your safety throughout the journey</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3 class="feature-title">24/7 Availability</h3>
                    <p class="feature-description">Book a driver anytime, anywhere. We're always available to serve you round the clock</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h3 class="feature-title">Affordable Rates</h3>
                    <p class="feature-description">Transparent pricing with no hidden charges. Get the best value for your money</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h3 class="feature-title">Easy Booking</h3>
                    <p class="feature-description">Simple and quick booking process. Book your driver in just a few clicks</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3 class="feature-title">Professional Drivers</h3>
                    <p class="feature-description">Experienced and courteous drivers who know the routes and prioritize your comfort</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="feature-title">24/7 Support</h3>
                    <p class="feature-description">Round-the-clock customer support to assist you with any queries or concerns</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="cta-section">
    <div class="container">
        <h2>Ready to Book Your Driver?</h2>
        <p>Join thousands of satisfied customers who trust us for their transportation needs</p>
        <a href="./?p=cab_available" class="home-cta-btn home-cta-primary">
            <i class="fas fa-calendar-check"></i>
            <span>Book Now</span>
        </a>
    </div>
</section>
<script>
    $(function(){
        $('#search').on('input',function(){
            var _search = $(this).val().toLowerCase().trim()
            $('#service_list .item').each(function(){
                var _text = $(this).text().toLowerCase().trim()
                    _text = _text.replace(/\s+/g,' ')
                    console.log(_text)
                if((_text).includes(_search) == true){
                    $(this).toggle(true)
                }else{
                    $(this).toggle(false)
                }
            })
            if( $('#service_list .item:visible').length > 0){
                $('#noResult').hide('slow')
            }else{
                $('#noResult').show('slow')
            }
        })
        $('#service_list .item').hover(function(){
            $(this).find('.callout').addClass('shadow')
        })
        $('#service_list .view_service').click(function(){
            uni_modal("Service Details","view_service.php?id="+$(this).attr('data-id'),'mid-large')
        })
        $('#send_request').click(function(){
            uni_modal("Fill the Service Request Form","send_request.php",'large')
        })

    })
    $(document).scroll(function() { 
        $('#topNavBar').removeClass('bg-purple navbar-light navbar-dark bg-gradient-purple text-light')
        if($(window).scrollTop() === 0) {
           $('#topNavBar').addClass('navbar-dark bg-purple text-light')
        }else{
           $('#topNavBar').addClass('navbar-dark bg-gradient-purple ')
        }
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script>