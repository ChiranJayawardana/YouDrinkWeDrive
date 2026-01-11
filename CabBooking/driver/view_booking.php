<?php
require_once('./../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    // Fetch the booking, client, and client contact information
    $qry = $conn->query("SELECT 
                            b.*, 
                            CONCAT(c.lastname, ', ', c.firstname, ' ', c.middlename) AS client, 
                            c.contact,
                            c.email,
                            c.firstname
                         FROM 
                            `booking_list` b 
                         INNER JOIN 
                            `client_list` c 
                         ON 
                            b.client_id = c.id 
                         WHERE 
                            b.id = '{$_GET['id']}'");
                         
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k = $v;
        }
        
        // Fetch the driver information
        $qry2 = $conn->query("SELECT 
                                c.*, 
                                cc.name AS category 
                              FROM 
                                `driver_list` c 
                              INNER JOIN 
                                `category_list` cc 
                              ON 
                                c.category_id = cc.id 
                              WHERE 
                                c.id = '{$driver_id}'");
                              
        if($qry2->num_rows > 0){
            foreach($qry2->fetch_assoc() as $k => $v){
                if(!isset($$k)) $$k = $v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none
    }
    #uni_modal .modal-dialog {
        max-width: 900px !important;
        width: 90% !important;
    }
    @media (min-width: 992px) {
        #uni_modal .modal-dialog {
            max-width: 1000px !important;
            width: 85% !important;
        }
    }
    .booking-details-container {
        padding: 20px 0;
        position: relative;
    }
    .close-btn-top {
        position: absolute;
        top: 10px;
        right: 10px;
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        border: none;
        border-radius: 50%;
        color: white;
        font-size: 1.2rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(74, 85, 104, 0.3);
        z-index: 10;
    }
    .close-btn-top:hover {
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        transform: rotate(90deg) scale(1.1);
        box-shadow: 0 6px 20px rgba(245, 101, 101, 0.4);
    }
    .detail-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
        border-left: 4px solid #9333ea;
    }
    .section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    .section-header i {
        color: #9333ea;
        font-size: 1.3rem;
    }
    .section-header h5 {
        margin: 0;
        font-weight: 700;
        color: #2d3748;
        font-size: 1.1rem;
    }
    .detail-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .detail-item:last-child {
        border-bottom: none;
    }
    .detail-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        border-radius: 12px;
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
        margin-bottom: 5px;
        font-weight: 600;
    }
    .detail-value {
        font-size: 1rem;
        color: #2d3748;
        font-weight: 600;
        word-break: break-word;
    }
    .status-badge {
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
    .highlight-card {
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        border-radius: 15px;
        padding: 25px;
        padding-top: 50px;
        color: white;
        margin-bottom: 20px;
        text-align: center;
        position: relative;
    }
    .highlight-label {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .highlight-value {
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #e2e8f0;
        flex-wrap: wrap;
    }
    .btn-action {
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        font-size: 0.95rem;
    }
    .btn-primary-action {
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
    }
    .btn-primary-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(147, 51, 234, 0.4);
        color: white;
    }
    .btn-warning-action {
        background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%);
        color: white;
    }
    .btn-warning-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(237, 137, 54, 0.4);
        color: white;
    }
    .btn-success-action {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
    }
    .btn-success-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(72, 187, 120, 0.4);
        color: white;
    }
    .btn-dark-action {
        background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        color: white;
    }
    .btn-dark-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(74, 85, 104, 0.4);
        color: white;
    }
    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
        .btn-action {
            width: 100%;
            justify-content: center;
        }
        .detail-item {
            flex-direction: column;
            gap: 10px;
        }
        .detail-icon {
            align-self: flex-start;
        }
    }
</style>
<div class="booking-details-container">
    <!-- Top Right Close Button -->
    <button class="close-btn-top" type="button" data-dismiss="modal" title="Close">
        <i class="fas fa-times"></i>
    </button>
    
    <!-- Reference Code & Status Highlight -->
    <div class="highlight-card">
        <div class="highlight-label">Booking Reference</div>
        <div class="highlight-value"><?= isset($ref_code) ? htmlspecialchars($ref_code) : "N/A" ?></div>
        <div style="margin-top: 15px;">
            <?php 
                $status_class = '';
                $status_icon = '';
                $status_text = '';
                switch(isset($status) ? $status : 0){
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
            <span class="status-badge <?= $status_class ?>">
                <i class="fas <?= $status_icon ?>"></i>
                <?= $status_text ?>
            </span>
        </div>
    </div>
    
    <!-- Booking Information Section -->
    <div class="detail-section">
        <div class="section-header">
            <i class="fas fa-info-circle"></i>
            <h5>Booking Information</h5>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-route"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Distance</div>
                <div class="detail-value"><?= isset($distance) ? number_format($distance, 2) . " km" : "N/A" ?></div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-car"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Estimate Fee</div>
                <div class="detail-value">
                    <?php 
                    if(isset($estimate_fee)) {
                        echo "LKR " . number_format($estimate_fee, 2);
                    } elseif(isset($distance)) {
                        $calc_estimate = $distance * 125;
                        echo "LKR " . number_format($calc_estimate, 2);
                    } else {
                        echo "N/A";
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-hands-helping"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Supporter Fee</div>
                <div class="detail-value">
                    <?php 
                    if(isset($supporter_fee)) {
                        echo "LKR " . number_format($supporter_fee, 2);
                    } elseif(isset($distance)) {
                        $calc_supporter = $distance * 75;
                        echo "LKR " . number_format($calc_supporter, 2);
                    } else {
                        echo "N/A";
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="detail-item" style="background: linear-gradient(135deg, #059669 0%, #10b981 100%); border-radius: 12px; padding: 15px; margin-top: 10px;">
            <div class="detail-icon" style="color: white;">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label" style="color: rgba(255,255,255,0.9); font-weight: 600;">Total Estimate Fee</div>
                <div class="detail-value" style="color: white; font-size: 1.3rem; font-weight: 700;">
                    <?= isset($fee) ? "LKR " . number_format($fee, 2) : "N/A" ?>
                </div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-car-side"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Vehicle Category</div>
                <div class="detail-value"><?= isset($category) ? htmlspecialchars($category) : "N/A" ?></div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-map-marker-alt"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Pickup Zone</div>
                <div class="detail-value"><?= isset($pickup_zone) ? htmlspecialchars($pickup_zone) : "N/A" ?></div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-flag-checkered"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Drop off Zone</div>
                <div class="detail-value"><?= isset($drop_zone) ? htmlspecialchars($drop_zone) : "N/A" ?></div>
            </div>
        </div>
    </div>
    
    <!-- Client Information Section -->
    <div class="detail-section">
        <div class="section-header">
            <i class="fas fa-user"></i>
            <h5>Client Information</h5>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-user-circle"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Client Name</div>
                <div class="detail-value"><?= isset($client) ? htmlspecialchars($client) : "N/A" ?></div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-phone"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Client Contact No</div>
                <div class="detail-value"><?= isset($contact) ? htmlspecialchars($contact) : "N/A" ?></div>
            </div>
        </div>
        
        <div class="detail-item">
            <div class="detail-icon">
                <i class="fas fa-envelope"></i>
            </div>
            <div class="detail-content">
                <div class="detail-label">Client Email</div>
                <div class="detail-value"><?= isset($email) ? htmlspecialchars($email) : "N/A" ?></div>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <div class="action-buttons">
        <?php if(isset($status) && $status == 0): ?>
        <button class="btn-action btn-primary-action" type="button" id="confirm_booking">
            <i class="fas fa-check"></i> Confirm Booking
        </button>
        <?php elseif(isset($status) && $status == 1): ?>
        <button class="btn-action btn-warning-action" type="button" id="pickup_booking">
            <i class="fas fa-car"></i> Picked Up
        </button>
        <?php elseif(isset($status) && $status == 2): ?>
        <button class="btn-action btn-success-action" type="button" id="dropoff_booking">
            <i class="fas fa-flag-checkered"></i> Dropped Off
        </button>
        <?php endif; ?>
        <button class="btn-action btn-dark-action" type="button" data-dismiss="modal">
            <i class="fa fa-times"></i> Close
        </button>
    </div>
</div>
<script>
    $(function(){
        $('#confirm_booking').click(function(){
            _conf("Are you sure to confirm this booking [Ref. Code: <b><?= isset($ref_code) ? htmlspecialchars($ref_code) : "" ?></b>]?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",1])
        })
        $('#pickup_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? htmlspecialchars($ref_code) : "" ?></b>] booking as Picked Up?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",2])
        }) 
        $('#dropoff_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? htmlspecialchars($ref_code) : "" ?></b>] booking as Dropped Off?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",3])
        })
    })
    function update_booking_status($id, $status) {
    start_loader();

    // Send email before updating booking status
    $.ajax({
        url: _base_url_ + "driver/send_email.php",
        method: "POST",
        data: {
            email: '<?= isset($email) ? addslashes($email) : "" ?>',
            status: $status,
            ref_code: '<?= isset($ref_code) ? addslashes($ref_code) : "" ?>',
            pickup_zone: '<?= isset($pickup_zone) ? addslashes($pickup_zone) : "" ?>',
            drop_zone: '<?= isset($drop_zone) ? addslashes($drop_zone) : "" ?>',
            driver_name: '<?= isset($driver_name) ? addslashes($driver_name) : "" ?>',
            driver_contact: '<?= isset($driver_contact) ? addslashes($driver_contact) : "" ?>',
            firstname: '<?= isset($firstname) ? addslashes($firstname) : "" ?>'
        },
        dataType: "json",
        success: function(emailResp) {
            if (typeof emailResp == 'object' && emailResp.status == 'success') {
                // Email sent successfully, now update the booking status
                $.ajax({
                    url: _base_url_ + "classes/Master.php?f=update_booking_status",
                    method: "POST",
                    data: {id: $id, status: $status},
                    dataType: "json",
                    success: function(resp) {
                        if (typeof resp == 'object' && resp.status == 'success') {
                            // Close modal first, then reload
                            $('#uni_modal').modal('hide');
                            setTimeout(function() {
                                location.reload();
                            }, 300);
                        } else {
                            alert_toast("An error occurred while updating the booking status.", 'error');
                            end_loader();
                        }
                    },
                    error: function(err) {
                        console.log(err);
                        alert_toast("An error occurred while updating the booking status.", 'error');
                        end_loader();
                    }
                });
                
            } else {
                alert_toast("An error occurred while sending the email.", 'error');
                end_loader();
            }
        },
        error: function(err) {
            console.log(err);
            alert_toast("An error occurred while sending the email.", 'error');
            end_loader();
        }
    });
}
</script>
