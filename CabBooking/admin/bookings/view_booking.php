<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT  b.*,concat(c.lastname,', ', c.firstname,' ',c.middlename) as client,c.contact from `booking_list` b inner join client_list c on b.client_id = c.id where b.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
        $qry2 = $conn->query("SELECT c.*, cc.name as category from `driver_list` c inner join category_list cc on c.category_id = cc.id where c.id = '{$driver_id}' ");
        if($qry2->num_rows > 0){
            foreach($qry2->fetch_assoc() as $k => $v){
                if(!isset($$k))
                $$k=$v;
            }
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
    .view-booking-card {
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .view-booking-card .card-header {
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
        border-radius: 12px 12px 0 0;
        border: none;
        padding: 1.25rem 1.5rem;
    }
    .view-booking-card .card-body {
        padding: 2rem;
    }
    .view-field {
        margin-bottom: 1.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    .view-field:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .view-field-label {
        font-size: 0.75rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #6b7280;
        margin-bottom: 0.5rem;
    }
    .view-field-value {
        font-size: 1rem;
        color: #1f2937;
        font-weight: 500;
        padding-left: 0.5rem;
    }
    .view-field-value.empty {
        color: #9ca3af;
        font-style: italic;
    }
    .section-title {
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #9333ea;
        margin-bottom: 1.5rem;
        padding-bottom: 0.75rem;
        border-bottom: 2px solid #e2e8f0;
    }
</style>
<div class="container-fluid">
    <div class="card view-booking-card">
        <div class="card-header">
            <h4 class="card-title mb-0"><i class="fa fa-calendar-check"></i> Booking Information</h4>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="section-title"><i class="fa fa-info-circle"></i> Booking Details</div>
                    <div class="view-field">
                        <div class="view-field-label">Reference Code</div>
                        <div class="view-field-value"><?= isset($ref_code) && !empty($ref_code) ? htmlspecialchars($ref_code) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Client Name</div>
                        <div class="view-field-value"><?= isset($client) && !empty($client) ? htmlspecialchars($client) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Client Contact</div>
                        <div class="view-field-value"><?= isset($contact) && !empty($contact) ? htmlspecialchars($contact) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Pickup Zone</div>
                        <div class="view-field-value"><?= isset($pickup_zone) && !empty($pickup_zone) ? htmlspecialchars($pickup_zone) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Drop off Zone</div>
                        <div class="view-field-value"><?= isset($drop_zone) && !empty($drop_zone) ? htmlspecialchars($drop_zone) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Status</div>
                        <div class="view-field-value">
                            <?php 
                                if(isset($status)):
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
                                        default:
                                            echo "<span class='empty'>Not set</span>";
                                    }
                                else:
                                    echo "<span class='empty'>Not set</span>";
                                endif;
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="section-title"><i class="fa fa-car"></i> Driver & Vehicle Details</div>
                    <div class="view-field">
                        <div class="view-field-label">Vehicle Category</div>
                        <div class="view-field-value"><?= isset($category) && !empty($category) ? htmlspecialchars($category) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Driver Name</div>
                        <div class="view-field-value"><?= isset($driver_name) && !empty($driver_name) ? htmlspecialchars($driver_name) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Driver Contact</div>
                        <div class="view-field-value"><?= isset($driver_contact) && !empty($driver_contact) ? htmlspecialchars($driver_contact) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Driver Address</div>
                        <div class="view-field-value"><?= isset($driver_address) && !empty($driver_address) ? nl2br(htmlspecialchars($driver_address)) : '<span class="empty">Not specified</span>' ?></div>
                    </div>
                    <div class="view-field">
                        <div class="view-field-label">Booking Fee</div>
                        <div class="view-field-value">
                            <?php if(isset($fee) && !empty($fee)): ?>
                                <strong style="color: #10b981; font-size: 1.1rem;">LKR <?= number_format($fee, 2) ?></strong>
                            <?php else: ?>
                                <span class="empty">Not specified</span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-light" style="border-top: 1px solid #e2e8f0; border-radius: 0 0 12px 12px; padding: 1.25rem 1.5rem;">
            <div class="text-right">
                <button class="btn btn-primary btn-flat" type="button" data-dismiss="modal" style="background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%); border: none; box-shadow: 0 4px 15px rgba(147, 51, 234, 0.3);">
                    <i class="fa fa-times"></i> Close
                </button>
            </div>
        </div>
    </div>
</div>
