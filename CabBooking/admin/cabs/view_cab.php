<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT c.*, cc.name as category from `driver_list` c inner join category_list cc on c.category_id = cc.id where c.id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=stripslashes($v);
        }
    }
}
?>
<style>
    .driver-details-card {
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(147, 51, 234, 0.15);
        border: none;
        overflow: hidden;
    }
    
    .driver-details-header {
        background: linear-gradient(135deg, #9333ea 0%, #7c3aed 100%);
        padding: 25px 30px;
        color: white;
        border: none;
    }
    
    .driver-details-header h4 {
        margin: 0;
        font-size: 24px;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    
    .driver-details-body {
        padding: 40px;
        background: #ffffff;
    }
    
    .detail-section {
        background: #f8f9fa;
        border-radius: 12px;
        padding: 25px;
        margin-bottom: 20px;
        border-left: 4px solid #9333ea;
    }
    
    .detail-row {
        display: flex;
        margin-bottom: 20px;
        gap: 40px;
    }
    
    .detail-item {
        flex: 1;
    }
    
    .detail-label {
        font-size: 12px;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
        display: block;
    }
    
    .detail-value {
        font-size: 16px;
        color: #1f2937;
        font-weight: 500;
        padding: 10px 0;
    }
    
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 20px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 14px;
    }
    
    .status-badge.active {
        background: #d1fae5;
        color: #065f46;
    }
    
    .status-badge.inactive {
        background: #fee2e2;
        color: #991b1b;
    }
    
    .btn-action {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
        border: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .btn-edit {
        background: #9333ea;
        color: white;
    }
    
    .btn-edit:hover {
        background: #7c3aed;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-delete {
        background: #ef4444;
        color: white;
    }
    
    .btn-delete:hover {
        background: #dc2626;
        color: white;
        transform: translateY(-2px);
    }
    
    .btn-back {
        background: #f3f4f6;
        color: #374151;
        border: 1px solid #d1d5db;
    }
    
    .btn-back:hover {
        background: #e5e7eb;
        color: #1f2937;
        transform: translateY(-2px);
    }
</style>
<div class="content py-3">
    <div class="card driver-details-card">
        <div class="card-header driver-details-header">
            <h4 class="card-title">
                <i class="fas fa-id-card"></i>
                Driver Details
            </h4>
            <div class="card-tools">
                <a class="btn btn-action btn-edit btn-sm" href="./?page=cabs/manage_cab&id=<?= isset($id) ? $id : "" ?>">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a class="btn btn-action btn-delete btn-sm" href="javascript:void(0)" id="delete_data">
                    <i class="fa fa-trash"></i> Delete
                </a>
                <a class="btn btn-action btn-back btn-sm" href="./?page=cabs">
                    <i class="fa fa-angle-left"></i> Back
                </a>
            </div>
        </div>
        <div class="card-body driver-details-body">
            <!-- Image Section Hidden -->
            <?php /* 
            <div class="row">
                <div class="col-md-12 text-center mb-4">
                    <img src="<?= validate_image(isset($image_path) ? $image_path : "") ?>" alt="Driver Image" class="img-thumbnail" style="width:200px;height:200px;object-fit:cover;border-radius:12px;">
                </div>
            </div>
            */ ?>
            
            <div class="detail-section">
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Registration Code</span>
                        <div class="detail-value"><?= isset($reg_code) ? $reg_code : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Category</span>
                        <div class="detail-value"><?= isset($category) ? $category : 'N/A' ?></div>
                    </div>
                </div>
                
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Driver ID Number</span>
                        <div class="detail-value"><?= isset($driver_identity) ? $driver_identity : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <!-- Empty space for alignment -->
                    </div>
                </div>
            </div>
            
            <div class="detail-section">
                <div class="detail-row">
                    <div class="detail-item">
                        <span class="detail-label">Name</span>
                        <div class="detail-value"><?= isset($driver_name) ? $driver_name : 'N/A' ?></div>
                    </div>
                    <div class="detail-item">
                        <span class="detail-label">Contact #</span>
                        <div class="detail-value"><?= isset($driver_contact) ? $driver_contact : 'N/A' ?></div>
                    </div>
                </div>
                
                <div class="detail-row" style="margin-bottom: 0;">
                    <div class="detail-item">
                        <span class="detail-label">Address</span>
                        <div class="detail-value"><?= isset($driver_address) ? $driver_address : 'N/A' ?></div>
                    </div>
                </div>
            </div>
            
            <div class="detail-section" style="margin-bottom: 0;">
                <div class="detail-row" style="margin-bottom: 0;">
                    <div class="detail-item">
                        <span class="detail-label">Status</span>
                        <div class="detail-value">
                            <?php if(isset($status)): ?>
                                <?php if($status == 1): ?>
                                    <span class="status-badge active">
                                        <i class="fas fa-check-circle"></i> Active
                                    </span>
                                <?php else: ?>
                                    <span class="status-badge inactive">
                                        <i class="fas fa-times-circle"></i> Inactive
                                    </span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
		$('#delete_data').click(function(){
			_conf("Are you sure to delete this cab permanently?","delete_cab",[])
		})
    })
    function delete_cab($id = '<?= isset($id) ? $id : "" ?>'){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_cab",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.href= './?page=cabs';
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>