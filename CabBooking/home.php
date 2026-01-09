<!-- Modern Hero Banner - Uber/Bolt Style -->
<header class="hero-modern" id="main-header">
    <div class="container d-flex align-items-center justify-content-center" style="min-height: 100%;">
        <div class="hero-modern-content fade-in" style="max-width: 950px; margin: 0 auto; padding: 0 1.5rem; text-align: center;">
            <h1 class="hero-modern-title" style="margin-bottom: 1.75rem; line-height: 1.15; font-size: 3.75rem;"><?php echo $_settings->info('name') ?></h1>
            <p class="hero-modern-subtitle" style="font-size: 1.5rem; margin-bottom: 3rem; line-height: 1.7;">Your trusted partner for reliable and comfortable transportation services.<br>Available 24/7 for all your travel needs.</p>
            <div class="hero-cta-group" style="display: flex; justify-content: center; align-items: center; gap: 1.25rem; flex-wrap: wrap; margin-bottom: 3.5rem;">
                <a class="btn-modern btn-modern-primary btn-modern-lg hero-primary-btn" href="./?p=cab_available" style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); color: white; font-weight: 700; padding: 1.25rem 3rem; box-shadow: 0 8px 24px rgba(147, 51, 234, 0.4); border: none; font-size: 1.125rem; border-radius: 12px;">
                    <i class="fas fa-car" style="margin-right: 0.75rem;"></i>
                    <span>Book a Ride Now</span>
                </a>
                <a class="btn-modern btn-modern-outline btn-modern-lg hero-secondary-btn" href="./?p=about" style="background: white; color: #9333ea; font-weight: 600; padding: 1.25rem 3rem; border: 2px solid white; font-size: 1.125rem; border-radius: 12px; box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);">
                    <i class="fas fa-info-circle" style="margin-right: 0.75rem;"></i>
                    <span>Learn More</span>
                </a>
            </div>
            <!-- Trust Indicators -->
            <div class="hero-trust-indicators" style="display: flex; justify-content: center; gap: 2rem; flex-wrap: wrap;">
                <div style="text-align: center;">
                    <div style="font-size: 2.25rem; font-weight: 800;">24/7</div>
                    <div style="font-size: 0.9375rem; margin-top: 0.375rem; font-weight: 500;">Available</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2.25rem; font-weight: 800;">100+</div>
                    <div style="font-size: 0.9375rem; margin-top: 0.375rem; font-weight: 500;">Drivers</div>
                </div>
                <div style="text-align: center;">
                    <div style="font-size: 2.25rem; font-weight: 800;">5★</div>
                    <div style="font-size: 0.9375rem; margin-top: 0.375rem; font-weight: 500;">Rated Service</div>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
/* Purple Theme Hero Buttons */
.hero-primary-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.3s ease;
    text-shadow: none !important;
}

.hero-primary-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(147, 51, 234, 0.5);
    background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%) !important;
}

.hero-primary-btn:active {
    transform: translateY(-1px);
}

.hero-secondary-btn {
    position: relative;
    transition: all 0.3s ease;
    backdrop-filter: none;
    -webkit-backdrop-filter: none;
}

.hero-secondary-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
    background: #e9d5ff !important;
    color: #7e22ce !important;
}

.hero-secondary-btn:active {
    transform: translateY(-1px);
}

.hero-trust-indicators > div {
    animation: fadeInUp 0.8s ease-out backwards;
}

.hero-trust-indicators > div:nth-child(1) { animation-delay: 0.2s; }
.hero-trust-indicators > div:nth-child(2) { animation-delay: 0.4s; }
.hero-trust-indicators > div:nth-child(3) { animation-delay: 0.6s; }

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@media (max-width: 768px) {
    .hero-modern-subtitle br {
        display: none;
    }
    
    .hero-modern-content {
        padding: 0 1rem !important;
    }
    
    .hero-cta-group {
        flex-direction: column;
        width: 100%;
        gap: 1rem !important;
    }
    
    .hero-cta-group .btn-modern {
        width: 100%;
        max-width: 350px;
        padding: 1rem 2rem !important;
        font-size: 1rem !important;
    }
    
    .hero-trust-indicators {
        gap: 2.5rem !important;
        margin-top: 2.5rem !important;
    }
    
    .hero-trust-indicators > div div:first-child {
        font-size: 1.75rem !important;
    }
}

@media (max-width: 576px) {
    .hero-trust-indicators {
        gap: 2rem !important;
    }
}
</style>

<!-- Features Section -->
<section style="padding: 4rem 0; background: white;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Why Choose Us</h2>
            <p style="color: #6b7280; font-size: 1.125rem;">Experience the best in class cab booking services</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card-modern card-modern-hover text-center fade-in-scroll">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Safe & Secure</h3>
                    <p style="color: #6b7280; line-height: 1.6;">All our drivers are verified and trained professionals ensuring your safety throughout the journey.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card-modern card-modern-hover text-center fade-in-scroll">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-clock" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">24/7 Availability</h3>
                    <p style="color: #6b7280; line-height: 1.6;">Book a ride anytime, anywhere. Our services are available round the clock for your convenience.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card-modern card-modern-hover text-center fade-in-scroll">
                    <div style="width: 80px; height: 80px; margin: 0 auto 1.5rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-dollar-sign" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Affordable Rates</h3>
                    <p style="color: #6b7280; line-height: 1.6;">Get the best value for your money with our competitive pricing and transparent fare structure.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section style="padding: 4rem 0; background: #f3f4f6;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">How It Works</h2>
            <p style="color: #6b7280; font-size: 1.125rem;">Book your ride in three simple steps</p>
        </div>
        
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700;">1</div>
                    <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Choose Your Ride</h4>
                    <p style="color: #6b7280;">Browse through available drivers and select the one that suits your needs.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700;">2</div>
                    <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Book & Confirm</h4>
                    <p style="color: #6b7280;">Enter your pickup and drop-off locations to confirm your booking instantly.</p>
                </div>
            </div>
            
            <div class="col-md-4 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <div style="width: 60px; height: 60px; margin: 0 auto 1rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; font-weight: 700;">3</div>
                    <h4 style="font-weight: 600; color: #1f2937; margin-bottom: 0.75rem;">Enjoy Your Ride</h4>
                    <p style="color: #6b7280;">Sit back, relax, and enjoy a comfortable journey to your destination.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Welcome Content Section -->
<section style="padding: 4rem 0; background: white;">
    <div class="container">
        <div class="card-modern">
            <?php include './welcome.html' ?>
        </div>
    </div>
</section>

<!-- CTA Section - Purple Theme -->
<section style="padding: 4rem 0; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); color: white;">
    <div class="container text-center">
        <h2 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 1rem; color: white;">Ready to Get Started?</h2>
        <p style="font-size: 1.125rem; margin-bottom: 2rem; opacity: 0.95;">Book your ride today and experience hassle-free transportation</p>
        <a class="btn-modern btn-modern-secondary btn-modern-lg" href="./?p=cab_available" style="background: white; color: #9333ea; font-weight: 700;">
            <i class="fas fa-car"></i>
            <span>View Available Drivers</span>
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