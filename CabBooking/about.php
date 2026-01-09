<!-- Modern About Page Header -->
<header class="hero-modern" id="main-header" style="min-height: 50vh;">
    <div class="container h-100 d-flex align-items-center justify-content-center">
        <div class="hero-modern-content text-center fade-in">
            <h1 class="hero-modern-title">About Us</h1>
            <p class="hero-modern-subtitle">Learn more about our journey and commitment to excellence</p>
        </div>
    </div>
</header>

<!-- Mission & Vision Section -->
<section style="padding: 4rem 0; background: white;">
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-6 mb-4">
                <div class="card-modern card-modern-hover fade-in-scroll">
                    <div style="width: 70px; height: 70px; margin-bottom: 1.5rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-bullseye" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Our Mission</h3>
                    <p style="color: #6b7280; line-height: 1.8; font-size: 1rem;">To provide safe, reliable, and affordable transportation services that connect people to their destinations with comfort and convenience.</p>
                </div>
            </div>
            
            <div class="col-md-6 mb-4">
                <div class="card-modern card-modern-hover fade-in-scroll">
                    <div style="width: 70px; height: 70px; margin-bottom: 1.5rem; background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border-radius: 16px; display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-eye" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h3 style="font-size: 1.75rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Our Vision</h3>
                    <p style="color: #6b7280; line-height: 1.8; font-size: 1rem;">To become the leading cab booking platform known for exceptional service quality, customer satisfaction, and innovative transportation solutions.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Our Values Section -->
<section style="padding: 4rem 0; background: #f3f4f6;">
    <div class="container">
        <div class="text-center mb-5">
            <h2 style="font-size: 2.5rem; font-weight: 700; color: #1f2937; margin-bottom: 1rem;">Our Core Values</h2>
            <p style="color: #6b7280; font-size: 1.125rem;">The principles that guide everything we do</p>
        </div>
        
        <div class="row">
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <i class="fas fa-shield-alt" style="font-size: 2.5rem; color: #9333ea; margin-bottom: 1rem;"></i>
                    <h4 style="font-weight: 600; color: #1f2937;">Safety First</h4>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <i class="fas fa-heart" style="font-size: 2.5rem; color: #9333ea; margin-bottom: 1rem;"></i>
                    <h4 style="font-weight: 600; color: #1f2937;">Customer Care</h4>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <i class="fas fa-star" style="font-size: 2.5rem; color: #9333ea; margin-bottom: 1rem;"></i>
                    <h4 style="font-weight: 600; color: #1f2937;">Excellence</h4>
                </div>
            </div>
            
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card-modern text-center fade-in-scroll">
                    <i class="fas fa-handshake" style="font-size: 2.5rem; color: #9333ea; margin-bottom: 1rem;"></i>
                    <h4 style="font-weight: 600; color: #1f2937;">Integrity</h4>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- About Content Section -->
<section style="padding: 4rem 0; background: white;">
    <div class="container">
        <div class="card-modern">
            <?php include "about.html" ?>
        </div>
    </div>
</section>

<script>
    $(document).scroll(function() { 
        // Navigation scroll behavior is now handled by modern-interactions.js
    });
    $(function(){
        $(document).trigger('scroll')
    })
</script>