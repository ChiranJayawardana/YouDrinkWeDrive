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
        display:none
    }
    #uni_modal .modal-dialog {
        max-width: 1000px !important;
        width: 90% !important;
    }
    .admin-booking-details {
        padding: 20px 0;
        position: relative;
    }
    .admin-close-btn-top {
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
    .admin-close-btn-top:hover {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        transform: rotate(90deg) scale(1.1);
    }
    .admin-highlight-card {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 15px;
        padding: 25px;
        padding-top: 50px;
        color: white;
        margin-bottom: 20px;
        text-align: center;
        position: relative;
    }
    .admin-detail-section {
        background: white;
        border-radius: 15px;
        padding: 25px;
        margin-bottom: 20px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.08);
    }
    .admin-section-header {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 20px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    .admin-section-header i {
        color: #06b6d4;
        font-size: 1.3rem;
    }
    .admin-section-header h5 {
        margin: 0;
        font-weight: 700;
        color: #2d3748;
        font-size: 1.1rem;
    }
    .admin-detail-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
        padding: 15px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .admin-detail-item:last-child {
        border-bottom: none;
    }
    .admin-detail-icon {
        width: 45px;
        height: 45px;
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
        flex-shrink: 0;
    }
    .admin-detail-content {
        flex: 1;
    }
    .admin-detail-label {
        font-size: 0.75rem;
        color: #a0aec0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 5px;
        font-weight: 600;
    }
    .admin-detail-value {
        font-size: 1rem;
        color: #2d3748;
        font-weight: 600;
    }
</style>

<div class="admin-booking-details">
    <button class="admin-close-btn-top" type="button" data-dismiss="modal" title="Close">
        <i class="fas fa-times"></i>
    </button>
    
    <div class="admin-highlight-card">
        <div style="font-size: 0.85rem; opacity: 0.9; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 0.5px;">Booking Reference</div>
        <div style="font-size: 2rem; font-weight: 700; margin-bottom: 5px;"><?= isset($ref_code) ? htmlspecialchars($ref_code) : "N/A" ?></div>
        <div style="margin-top: 15px;">
            <?php 
                $status_class = '';
                $status_icon = '';
                switch($status ?? 0){
                    case 0:
                        $status_class = 'style="background: linear-gradient(135deg, #a0aec0 0%, #718096 100%); color: white;"';
                        $status_icon = 'fa-clock';
                        $status_text = 'Pending';
                        break;
                    case 1:
                        $status_class = 'style="background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%); color: white;"';
                        $status_icon = 'fa-check-circle';
                        $status_text = 'Driver Confirmed';
                        break;
                    case 2:
                        $status_class = 'style="background: linear-gradient(135deg, #ed8936 0%, #dd6b20 100%); color: white;"';
                        $status_icon = 'fa-car';
                        $status_text = 'Picked-up';
                        break;
                    case 3:
                        $status_class = 'style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%); color: white;"';
                        $status_icon = 'fa-check-double';
                        $status_text = 'Dropped off';
                        break;
                    case 4:
                        $status_class = 'style="background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%); color: white;"';
                        $status_icon = 'fa-times-circle';
                        $status_text = 'Cancelled';
                        break;
                }
            ?>
            <span <?= $status_class ?> style="display: inline-flex; align-items: center; gap: 6px; padding: 8px 18px; border-radius: 20px; font-size: 0.85rem; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px;">
                <i class="fas <?= $status_icon ?>"></i>
                <?= $status_text ?>
            </span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="admin-detail-section">
                <div class="admin-section-header">
                    <i class="fas fa-route"></i>
                    <h5>Trip Information</h5>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Pickup Location</div>
                        <div class="admin-detail-value"><?= isset($pickup_zone) ? htmlspecialchars($pickup_zone) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-flag-checkered"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Drop-off Location</div>
                        <div class="admin-detail-value"><?= isset($drop_zone) ? htmlspecialchars($drop_zone) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Fee</div>
                        <div class="admin-detail-value"><?= isset($fee) ? "LKR " . number_format($fee, 2) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-tag"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Vehicle Category</div>
                        <div class="admin-detail-value"><?= isset($category) ? htmlspecialchars($category) : "N/A" ?></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="admin-detail-section">
                <div class="admin-section-header">
                    <i class="fas fa-users"></i>
                    <h5>Client & Driver Information</h5>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Client Name</div>
                        <div class="admin-detail-value"><?= isset($client) ? htmlspecialchars($client) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Client Contact</div>
                        <div class="admin-detail-value"><?= isset($contact) ? htmlspecialchars($contact) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Driver Name</div>
                        <div class="admin-detail-value"><?= isset($driver_name) ? htmlspecialchars($driver_name) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Driver Contact</div>
                        <div class="admin-detail-value"><?= isset($driver_contact) ? htmlspecialchars($driver_contact) : "N/A" ?></div>
                    </div>
                </div>
                <div class="admin-detail-item">
                    <div class="admin-detail-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="admin-detail-content">
                        <div class="admin-detail-label">Driver Address</div>
                        <div class="admin-detail-value"><?= isset($driver_address) ? htmlspecialchars($driver_address) : "N/A" ?></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
