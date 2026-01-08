<style>
    .bookings-hero {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 60px 0 40px;
        color: white;
        position: relative;
        overflow: hidden;
    }
    .bookings-hero::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: url('data:image/svg+xml,<svg width="100" height="100" xmlns="http://www.w3.org/2000/svg"><circle cx="50" cy="50" r="2" fill="rgba(255,255,255,0.1)"/></svg>');
        opacity: 0.3;
    }
    .bookings-hero .container {
        position: relative;
        z-index: 1;
    }
    .bookings-hero h1 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
    }
    .bookings-hero p {
        font-size: 1.1rem;
        opacity: 0.95;
        margin-bottom: 0;
    }
    .bookings-section {
        padding: 40px 0;
        background: #f8f9fa;
        min-height: 60vh;
    }
    .booking-card {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        position: relative;
        overflow: hidden;
    }
    .booking-card::before {
        content: '';
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, #667eea 0%, #764ba2 100%);
        transition: width 0.3s ease;
    }
    .booking-card:hover {
        transform: translateX(5px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.15);
        border-color: #667eea;
    }
    .booking-card:hover::before {
        width: 8px;
    }
    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }
    .booking-ref {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .booking-ref i {
        color: #667eea;
    }
    .booking-date {
        color: #718096;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .booking-status {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pending {
        background: linear-gradient(135deg, #a0aec0 0%, #718096 100%);
        color: white;
    }
    .status-confirmed {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        color: white;
    }
    .status-picked {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        color: white;
    }
    .status-completed {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
    }
    .status-cancelled {
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        color: white;
    }
    .booking-details {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-bottom: 20px;
    }
    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 12px;
    }
    .detail-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .detail-content {
        flex: 1;
    }
    .detail-label {
        font-size: 0.75rem;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
        font-weight: 600;
    }
    .detail-value {
        font-size: 0.95rem;
        color: #2d3748;
        font-weight: 600;
    }
    .booking-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid #e2e8f0;
    }
    .btn-view {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .btn-view:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        color: white;
    }
    .empty-state {
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 15px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }
    .empty-state i {
        font-size: 5rem;
        color: #cbd5e0;
        margin-bottom: 20px;
    }
    .empty-state h3 {
        color: #718096;
        font-weight: 600;
        margin-bottom: 10px;
    }
    .empty-state p {
        color: #a0aec0;
    }
    .stats-badge {
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        border-radius: 12px;
        padding: 10px 20px;
        display: inline-block;
        margin-top: 15px;
        font-size: 0.9rem;
    }
    @media (max-width: 768px) {
        .bookings-hero h1 {
            font-size: 2rem;
        }
        .booking-details {
            grid-template-columns: 1fr;
        }
        .booking-header {
            flex-direction: column;
        }
        .booking-actions {
            flex-direction: column;
        }
        .btn-view {
            width: 100%;
        }
    }
</style>

<!-- Hero Section -->
<section class="bookings-hero">
    <div class="container">
        <div class="text-center">
            <h1><i class="fas fa-calendar-check"></i> My Booking List</h1>
            <p>Track and manage all your cab bookings</p>
            <div class="stats-badge">
                <i class="fas fa-list"></i> <span id="booking-count">0</span> Total Bookings
            </div>
        </div>
    </div>
</section>

<!-- Bookings Section -->
<section class="bookings-section">
    <div class="container">
        <div id="bookings-container">
            <?php 
            $i = 1;
            $qry = $conn->query("SELECT * FROM `booking_list` where client_id = '{$_settings->userdata('id')}' order by unix_timestamp(date_created) desc");
            $booking_count = 0;
            if($qry->num_rows > 0):
                while($row = $qry->fetch_assoc()):
                    $booking_count++;
                    $status_class = '';
                    $status_icon = '';
                    switch($row['status']){
                        case 0:
                            $status_class = 'status-pending';
                            $status_icon = 'fa-clock';
                            $status_text = 'Pending';
                            break;
                        case 1:
                            $status_class = 'status-confirmed';
                            $status_icon = 'fa-check-circle';
                            $status_text = 'Driver Confirmed';
                            break;
                        case 2:
                            $status_class = 'status-picked';
                            $status_icon = 'fa-car';
                            $status_text = 'Picked-up';
                            break;
                        case 3:
                            $status_class = 'status-completed';
                            $status_icon = 'fa-check-double';
                            $status_text = 'Dropped off';
                            break;
                        case 4:
                            $status_class = 'status-cancelled';
                            $status_icon = 'fa-times-circle';
                            $status_text = 'Cancelled';
                            break;
                    }
            ?>
            <div class="booking-card" data-booking-id="<?= $row['id'] ?>">
                <div class="booking-header">
                    <div>
                        <div class="booking-ref">
                            <i class="fas fa-hashtag"></i>
                            <?= htmlspecialchars($row['ref_code']) ?>
                        </div>
                        <div class="booking-date">
                            <i class="far fa-calendar"></i>
                            <?= date("M d, Y", strtotime($row['date_created'])) ?>
                            <span style="margin: 0 8px;">•</span>
                            <i class="far fa-clock"></i>
                            <?= date("H:i", strtotime($row['date_created'])) ?>
                        </div>
                    </div>
                    <span class="booking-status <?= $status_class ?>">
                        <i class="fas <?= $status_icon ?>"></i>
                        <?= $status_text ?>
                    </span>
                </div>
                
                <div class="booking-details">
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Pickup Location</div>
                            <div class="detail-value"><?= htmlspecialchars($row['pickup_zone']) ?></div>
                        </div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-icon">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <div class="detail-content">
                            <div class="detail-label">Drop-off Location</div>
                            <div class="detail-value"><?= htmlspecialchars($row['drop_zone']) ?></div>
                        </div>
                    </div>
                </div>
                
                <div class="booking-actions">
                    <button type="button" class="btn-view view_data" data-id="<?= $row['id'] ?>">
                        <i class="fas fa-eye"></i> View Details
                    </button>
                </div>
            </div>
            <?php 
                endwhile;
            else:
            ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>No Bookings Yet</h3>
                <p>You haven't made any bookings. Start by booking a driver!</p>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
    $(function(){
        // Update booking count
        var bookingCount = $('.booking-card').length;
        $('#booking-count').text(bookingCount);
        
        // Animate cards on load
        $('.booking-card').each(function(index){
            $(this).css({
                'opacity': '0',
                'transform': 'translateX(-20px)'
            }).delay(index * 100).animate({
                'opacity': '1'
            }, 500, function(){
                $(this).css('transform', 'translateX(0)');
            });
        });

        // View details handler
        $('.view_data').click(function(){
            uni_modal("Booking Details","view_booking.php?id="+$(this).attr('data-id'),'large')
        })
    })
</script>