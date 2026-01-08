<style>
    .about-hero {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        padding: 80px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .about-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }
    .about-hero-content {
        position: relative;
        z-index: 1;
        text-align: center;
    }
    .about-hero h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    .about-hero p {
        font-size: 1.25rem;
        opacity: 0.95;
    }
    .about-content {
        padding: 80px 0;
        background: white;
    }
    .about-section {
        margin-bottom: 60px;
    }
    .about-section-title {
        font-size: 2rem;
        font-weight: 800;
        color: #0f172a;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 15px;
    }
    .about-section-title i {
        color: #06b6d4;
        font-size: 2.5rem;
    }
    .about-text {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #475569;
    }
    @media (max-width: 768px) {
        .about-hero h1 { font-size: 2.5rem; }
    }
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container about-hero-content">
        <h1><i class="fas fa-info-circle"></i> About Us</h1>
        <p>Learn more about our mission, vision, and commitment to excellence</p>
    </div>
</section>

<!-- Content Section -->
<section class="about-content">
    <div class="container">
        <div class="row">
            <div class="col-lg-10 mx-auto">
                <?php if(file_exists('./about.html') && filesize('./about.html') > 100): ?>
                <div class="cms-about-wrapper animate-fadeIn">
                    <?php include "about.html" ?>
                </div>
                <?php else: ?>
                <div class="about-section">
                    <h2 class="about-section-title">
                        <i class="fas fa-bullseye"></i>
                        <span>About Us</span>
                    </h2>
                    <div class="about-text">
                        <p>Welcome to <?php echo $_settings->info('name') ?>. We provide professional and reliable transportation services.</p>
                        <p><em>Content can be customized from the Admin Panel → Settings → System Information</em></p>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<script>
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