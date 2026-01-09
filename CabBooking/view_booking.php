<?php
require_once('./config.php'); // Include the configuration file for DB connection and environment variables
require __DIR__ . '/vendor/autoload.php';
use Twilio\Rest\Client;

if(isset($_GET['id']) && $_GET['id'] > 0){
    // Fetch the booking and client information, including contact
    $qry = $conn->query("SELECT 
                            b.*, 
                            CONCAT(c.lastname, ', ', c.firstname, ' ', c.middlename) AS client, 
                            c.contact 
                         FROM 
                            `booking_list` b 
                         INNER JOIN 
                            client_list c 
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
                                category_list cc 
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

<!-- HTML and Modal Logic -->
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
        letter-spacing: 0.5px;
    }
    .highlight-value {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 5px;
    }
    .action-buttons {
        display: flex;
        justify-content: flex-end;
        gap: 15px;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 2px solid #e2e8f0;
    }
    .btn-modern {
        padding: 12px 30px;
        border-radius: 10px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    .btn-cancel {
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(245, 101, 101, 0.3);
    }
    .btn-cancel:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(245, 101, 101, 0.4);
        color: white;
    }
    .btn-close {
        background: linear-gradient(135deg, #4a5568 0%, #2d3748 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(74, 85, 104, 0.3);
    }
    .btn-close:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(74, 85, 104, 0.4);
        color: white;
    }
    @media (max-width: 768px) {
        .action-buttons {
            flex-direction: column;
        }
        .btn-modern {
            width: 100%;
            justify-content: center;
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
                switch($status ?? 0){
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

    <div class="row">
        <!-- Trip Information -->
        <div class="col-md-6">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fas fa-route"></i>
                    <h5>Trip Information</h5>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Pickup Location</div>
                        <div class="detail-value"><?= isset($pickup_zone) ? htmlspecialchars($pickup_zone) : "N/A" ?></div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Drop-off Location</div>
                        <div class="detail-value"><?= isset($drop_zone) ? htmlspecialchars($drop_zone) : "N/A" ?></div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Fee</div>
                        <div class="detail-value"><?= isset($fee) ? "LKR " . number_format($fee, 2) : "N/A" ?></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Driver & Contact Information -->
        <div class="col-md-6">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fas fa-user-tie"></i>
                    <h5>Driver Information</h5>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Driver Name</div>
                        <div class="detail-value"><?= isset($driver_name) ? htmlspecialchars($driver_name) : "N/A" ?></div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Driver Contact</div>
                        <div class="detail-value"><?= isset($driver_contact) ? htmlspecialchars($driver_contact) : "N/A" ?></div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Driver Address</div>
                        <div class="detail-value"><?= isset($driver_address) ? htmlspecialchars($driver_address) : "N/A" ?></div>
                    </div>
                </div>
                
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Vehicle Category</div>
                        <div class="detail-value"><?= isset($category) ? htmlspecialchars($category) : "N/A" ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Information -->
    <div class="row">
        <div class="col-md-12">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fas fa-user-circle"></i>
                    <h5>Client Information</h5>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Client Name</div>
                                <div class="detail-value"><?= isset($client) ? htmlspecialchars($client) : "N/A" ?></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="detail-content">
                                <div class="detail-label">Client Contact</div>
                                <div class="detail-value"><?= isset($contact) ? htmlspecialchars($contact) : "N/A" ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Action Buttons -->
    <?php if(isset($status) && $status == 0): ?>
    <div class="action-buttons">
        <button class="btn-modern btn-cancel" type="button" id="cancel_booking">
            <i class="fas fa-times-circle"></i>
            <span>Cancel Booking</span>
        </button>
    </div>
    <?php endif; ?>
</div>

<script>
    $(function(){
        $('#cancel_booking').click(function(){
            _conf("Are you sure to cancel your cab booking [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>]?", "cancel_booking",["<?= isset($id) ? $id : "" ?>"])
        })
    })

    // function cancel_booking($id){
    //     start_loader();
	// 	$.ajax({
	// 		url:_base_url_+"classes/Master.php?f=update_booking_status",
	// 		method:"POST",
	// 		data:{id: $id,status:4},
	// 		dataType:"json",
	// 		error:err=>{
	// 			console.log(err)
	// 			alert_toast("An error occured.",'error');
	// 			end_loader();
	// 		},
	// 		success:function(resp){
	// 			if(typeof resp== 'object' && resp.status == 'success'){
    //                 // Send the cancellation SMS
    //                 sendCancellationSMS(

    //                 );
	// 				location.reload();
	// 			}else{
	// 				alert_toast("An error occured.",'error');
	// 				end_loader();
	// 			}
	// 		}
	// 	})
    // }

    function cancel_booking($id) {
    start_loader();
    $.ajax({
        url: _base_url_ + "classes/Master.php?f=update_booking_status",
        method: "POST",
        data: {id: $id, status: 4},
        dataType: "json",
        error: err => {
            console.log(err);
            alert_toast("An error occurred.", 'error');
            end_loader();
        },
        success: function (resp) {
            if (typeof resp == 'object' && resp.status == 'success') {
                // Prepare SMS details
                let smsDetails = {
                    ref_code: "<?= $ref_code ?>",
                    pickup_zone: "<?= $pickup_zone ?>",
                    drop_zone: "<?= $drop_zone ?>",
                    driver_name: "<?= $driver_name ?>",
                    driver_contact: "<?= $driver_contact ?>",
                    client: "<?= $client ?>",
                    contact: "<?= $contact ?>",
                    fee: "<?= $fee ?>",
                    client_contact: "<?= $contact ?>" // Ensure this is correct
                };

                $.ajax({
                    url: _base_url_ + "send_sms.php",
                    method: "POST",
                    data: {details: JSON.stringify(smsDetails)},
                    dataType: "json",
                    success: function (smsResp) {
                        if (smsResp.status === 'success') {
                            alert_toast("Booking cancelled and SMS sent successfully.", 'success');
                        } else {
                            alert_toast("Failed to send SMS: " + smsResp.message, 'error');
                        }
                        location.reload();
                    },
                    error: function (err) {
                        console.log(err);
                        alert_toast("An error occurred while sending SMS.", 'error');
                    }
                });
            } else {
                alert_toast("An error occurred while updating booking status.", 'error');
            }
            end_loader();
        }
    });
}

</script>



