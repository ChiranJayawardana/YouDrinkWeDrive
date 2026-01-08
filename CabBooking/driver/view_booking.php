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
        max-width: 1000px !important;
        width: 90% !important;
    }
    .driver-booking-details-container {
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
        color: #14b8a6;
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
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
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
    .highlight-card {
        background: linear-gradient(135deg, #14b8a6 0%, #0d9488 100%);
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
</style>

<div class="driver-booking-details-container">
    <button class="close-btn-top" type="button" data-dismiss="modal" title="Close">
        <i class="fas fa-times"></i>
    </button>
    
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
        <div class="col-md-6">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fas fa-route"></i>
                    <h5>Trip Information</h5>
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
        <div class="col-md-6">
            <div class="detail-section">
                <div class="section-header">
                    <i class="fas fa-user"></i>
                    <h5>Client Information</h5>
                </div>
                <div class="detail-item">
                    <div class="detail-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="detail-content">
                        <div class="detail-label">Client Contact</div>
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
        </div>
    </div>

    <div class="row d-none">
        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"> </legend>
                <dl>
                    <dt class="">Fee</dt>
                    <dd class="pl-4"><?= isset($fee) ? "LKR " . $fee : "" ?></dd>
                    <dt class="">Vehicle Category</dt>
                    <dd class="pl-4"><?= isset($category) ? $category : "" ?></dd>
                    <dt class="">Client Contact No</dt>
                    <dd class="pl-4"><?= isset($contact) ? $contact : "" ?></dd>
                    <dt class="">Driver Name</dt>
                    <dd class="pl-4"><?= isset($driver_name) ? $driver_name : "" ?></dd>
                    <dt class="">Client Email</dt>
                    <dd class="pl-4"><?= isset($email) ? $email : "" ?></dd>
                    <dt class="">Driver Contact</dt>
                    <dd class="pl-4"><?= isset($driver_contact) ? $driver_contact : "" ?></dd>
                    <dt class="">Driver Address</dt>
                    <dd class="pl-4"><?= isset($driver_address) ? $driver_address : "" ?></dd>
                </dl>
            </fieldset>
            <!-- <div class="clear-fix my-2"></div> -->
            
        </div>

        <div class="col-md-6">
            <fieldset class="bor">
                <legend class="h5 text-muted"> </legend>
                <dl>
                    <dt class="">Ref. Code</dt>
                    <dd class="pl-4"><?= isset($ref_code) ? $ref_code : "" ?></dd>
                    <dt class="">Pickup Zone</dt>
                    <dd class="pl-4"><?= isset($pickup_zone) ? $pickup_zone : "" ?></dd>
                    <dt class="">Drop off Zone</dt>
                    <dd class="pl-4"><?= isset($drop_zone) ? $drop_zone : "" ?></dd>
                    <dt class="">Status</dt>
                    <dd class="pl-4">
                        <?php 
                            switch($status){
                                case 0:
                                    echo "<span class='badge badge-secondary bg-gradient-secondary px-3 rounded-pill'>Pending</span>";
                                    break;
                                case 1:
                                    echo "<span class='badge badge-primary bg-gradient-primary px-3 rounded-pill'>Driver Confirmed</span>";
                                    break;
                                case 2:
                                    echo "<span class='badge badge-warning bg-gradient-warning px-3 rounded-pill'>Picked-up</span>";
                                    break;
                                case 3:
                                    echo "<span class='badge badge-success bg-gradient-success px-3 rounded-pill'>Dropped off</span>";
                                    break;
                                case 4:
                                    echo "<span class='badge badge-danger bg-gradient-danger px-3 rounded-pill'>Cancelled</span>";
                                    break;
                            }
                        ?>
                    </dd>
                </dl>
            </fieldset>
        </div>
    </div>
    
    <!-- <div class="clear-fix my-3"></div> -->
    <div class="text-right">
        <?php if(isset($status) && $status == 0): ?>
        <button class="btn btn-primary btn-flat bg-gradient-primary" type="button" id="confirm_booking">Confirm Booking</button>
        <?php elseif(isset($status) && $status == 1): ?>
        <button class="btn btn-warning btn-flat bg-gradient-warning" type="button" id="pickup_booking">Picked Up</button>
        <?php elseif(isset($status) && $status == 2): ?>
        <button class="btn btn-success btn-flat bg-gradient-success" type="button" id="dropoff_booking">Dropped Off</button>
        <?php endif; ?>
        <button class="btn btn-dark btn-flat bg-gradient-dark" type="button" data-dismiss="modal"><i class="fa fa-times"></i> Close</button>
    </div>
</div>
<script>
    $(function(){
        $('#confirm_booking').click(function(){
            _conf("Are you sure to confirm this booking [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>]?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",1])
        })
        $('#pickup_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] booking as Picked Up?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",2])
        }) 
        $('#dropoff_booking').click(function(){
            _conf("Mark [Ref. Code: <b><?= isset($ref_code) ? $ref_code : "" ?></b>] booking as Dropped Off?", "update_booking_status",["<?= isset($id) ? $id : "" ?>",3])
        })
    })
    // function update_booking_status($id,$status){
    //     start_loader();
	// 	$.ajax({
	// 		url:_base_url_+"classes/Master.php?f=update_booking_status",
	// 		method:"POST",
	// 		data:{id: $id,status:$status},
	// 		dataType:"json",
	// 		error:err=>{
	// 			console.log(err)
	// 			alert_toast("An error occured.",'error');
	// 			end_loader();
	// 		},
	// 		success:function(resp){
	// 			if(typeof resp== 'object' && resp.status == 'success'){
	// 				location.reload();
	// 			}else{
	// 				alert_toast("An error occured.",'error');
	// 				end_loader();
	// 			}
	// 		}
	// 	})
    // }
    function update_booking_status($id, $status) {
    start_loader();

    // Send email before updating booking status
    $.ajax({
        url: _base_url_ + "driver/send_email.php",
        method: "POST",
        data: {
            email: '<?= isset($email) ? $email : "" ?>', // Retrieve the client's email
            status: $status,
            ref_code: '<?= isset($ref_code) ? $ref_code : "" ?>',
            pickup_zone: '<?= isset($pickup_zone) ? $pickup_zone : "" ?>',
            drop_zone: '<?= isset($drop_zone) ? $drop_zone : "" ?>',
            driver_name: '<?= isset($driver_name) ? $driver_name : "" ?>',
            driver_contact: '<?= isset($driver_contact) ? $driver_contact : "" ?>',
            firstname: '<?= isset($firstname) ? $firstname : "" ?>'
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
                            location.reload();
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