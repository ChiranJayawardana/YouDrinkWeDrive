<style>
    .drivers-hero {
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        padding: 80px 0 60px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .drivers-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }
    .drivers-hero .container {
        position: relative;
        z-index: 1;
    }
    .drivers-hero h1 {
        font-size: 3.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    .drivers-hero p {
        font-size: 1.25rem;
        opacity: 0.95;
        margin-bottom: 0;
    }
    .search-container {
        background: white;
        border-radius: 50px;
        padding: 8px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        margin-top: 30px;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }
    .search-container .form-control {
        border: none;
        border-radius: 50px;
        padding: 12px 20px;
        font-size: 1rem;
    }
    .search-container .form-control:focus {
        box-shadow: none;
        outline: none;
    }
    .search-container .input-group-text {
        background: transparent;
        border: none;
        color: #667eea;
        padding: 12px 20px;
    }
    .drivers-section {
        padding: 60px 0;
        background:rgb(248, 249, 250);
    }
    .driver-card {
        background: white;
        border-radius: 20px;
        padding: 30px;
        margin-bottom: 30px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }
    .driver-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #667eea 0%, #764ba2 100%);
        transform: scaleX(0);
        transition: transform 0.3s ease;
    }
    .driver-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(66, 82, 151, 0.2);
        border-color: #a855f7;
    }
    .driver-card:hover::before {
        transform: scaleX(1);
    }
    .driver-card .driver-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: white;
        font-size: 2rem;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
    }
    .driver-card .driver-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 15px;
        text-align: center;
    }
    .driver-card .driver-info {
        text-align: center;
        flex-grow: 1;
    }
    .driver-card .driver-category {
        display: inline-block;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 8px 20px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .driver-card .driver-identity {
        color: #718096;
        font-size: 0.9rem;
        margin-top: 10px;
    }
    .driver-card .book-btn {
        margin-top: 20px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 25px;
        font-weight: 600;
        width: 100%;
        transition: all 0.3s ease;
        opacity: 0;
        transform: translateY(10px);
    }
    .driver-card:hover .book-btn {
        opacity: 1;
        transform: translateY(0);
    }
    .driver-card .book-btn:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
    }
    .no-results {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
    }
    .no-results i {
        font-size: 4rem;
        color: #cbd5e0;
        margin-bottom: 20px;
    }
    .no-results h3 {
        color: #718096;
        font-weight: 600;
    }
    .stats-badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 15px 25px;
        display: inline-block;
        margin-top: 20px;
    }
    @media (max-width: 768px) {
        .drivers-hero h1 {
            font-size: 2.5rem;
        }
        .drivers-hero p {
            font-size: 1rem;
        }
    }
</style>

<!-- Hero Section -->
<section class="drivers-hero">
    <div class="container">
        <div class="text-center">
            <h1><i class="fas fa-users"></i> Available Drivers</h1>
            <p>Choose from our professional and experienced drivers</p>
            <div class="stats-badge">
                <i class="fas fa-taxi"></i> <span id="driver-count">0</span> Drivers Available
            </div>
        </div>
    </div>
</section>

<!-- Search Section -->
<section class="py-4" style="background:rgb(248, 249, 250); margin-top: -30px; position: relative; z-index: 2;">
    <div class="container">
        <div class="search-container">
            <div class="input-group">
                <input type="search" id="search" class="form-control" placeholder="Search drivers by name, category, or identity..." aria-label="Search">
                <div class="input-group-append">
                    <span class="input-group-text"><i class="fa fa-search"></i></span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Drivers Section -->
<section class="drivers-section">
    <div class="container">
        <div class="row g-4" id="driver_list">
            <?php 
            // Get available drivers: active (status = 1), not deleted, with valid category, and not currently booked
            // Order by date_created DESC to show newly added drivers at the top
            $cabs = $conn->query("SELECT c.*, cc.name as category 
                FROM `driver_list` c 
                INNER JOIN `category_list` cc ON c.category_id = cc.id AND cc.delete_flag = 0 
                WHERE c.delete_flag = 0 
                AND (c.status = 1 OR c.status IS NULL)
                AND NOT EXISTS (
                    SELECT 1 
                    FROM `booking_list` b
                    WHERE b.driver_id = c.id 
                    AND b.driver_id IS NOT NULL
                    AND b.driver_id > 0
                    AND b.status IN (0,1,2)
                )
                ORDER BY c.`date_created` DESC, c.`id` DESC");
            
            // Debug: Check if query failed
            if(!$cabs){
                error_log("Driver query error: " . $conn->error);
            }
            
            $driver_count = 0;
            while($row= $cabs->fetch_assoc()):
                $driver_count++;
            ?>
            <div class="col-lg-4 col-md-6 col-sm-12 item">
                <div class="driver-card book_cab" data-id="<?php echo $row['id'] ?>" data-bodyno="<?php echo $row['driver_name'] ?>">
                    <div class="driver-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h3 class="driver-name"><?php echo htmlspecialchars($row['driver_name']) ?></h3>
                    <div class="driver-info">
                        <span class="driver-category">
                            <i class="fas fa-tag"></i> <?php echo htmlspecialchars($row['category']) ?>
                        </span>
                        <div class="driver-identity">
                            <i class="fas fa-id-card"></i> <?php echo htmlspecialchars($row['driver_identity']) ?>
                        </div>
                    </div>
                    <button class="book-btn" type="button">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </button>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
        <div id="noResult" style="display:none" class="no-results">
            <i class="fas fa-search"></i>
            <h3>No Drivers Found</h3>
            <p class="text-muted">Try adjusting your search criteria</p>
        </div>
    </div>
</section>
<script>
    $(function(){
        // Update driver count
        var driverCount = $('#driver_list .item').length;
        $('#driver-count').text(driverCount);
        
        // Search functionality
        $('#search').on('input',function(){
            var _search = $(this).val().toLowerCase().trim()
            var visibleCount = 0;
            
            $('#driver_list .item').each(function(){
                var _text = $(this).text().toLowerCase().trim()
                _text = _text.replace(/\s+/g,' ')
                
                if((_text).includes(_search) == true){
                    $(this).fadeIn(300);
                    visibleCount++;
                }else{
                    $(this).fadeOut(300);
                }
            })
            
            // Update count
            $('#driver-count').text(visibleCount);
            
            // Show/hide no results message
            if(visibleCount > 0){
                $('#noResult').fadeOut(300);
            }else{
                $('#noResult').fadeIn(300);
            }
        })
        
        // Click handler for driver cards
        $(document).on('click', '.book_cab', function(e){
            e.preventDefault();
            if("<?= $_settings->userdata('id') && $_settings->userdata('login_type') == 2 ?>" == 1)
                uni_modal("Book Driver - "+$(this).attr('data-bodyno'),"booking.php?cid="+$(this).attr('data-id'),'mid-large');
            else
                location.href = './login.php';
        })
        
        // Prevent default link behavior
        $('.book_cab').on('click', function(e){
            e.preventDefault();
        })
        
        $('#send_request').click(function(){
            if("<?= $_settings->userdata('id') > 0 && $_settings->userdata('login_type') == 2 ?>" == 1)
            uni_modal("Fill the cab Request Form","send_request.php",'mid-large');
            else
            alert_toast(" Please Login First.","warning");
        })

        // Animate cards on load
        $('#driver_list .item').each(function(index){
            $(this).css({
                'opacity': '0',
                'transform': 'translateY(20px)'
            }).delay(index * 100).animate({
                'opacity': '1'
            }, 500, function(){
                $(this).css('transform', 'translateY(0)');
            });
        });
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