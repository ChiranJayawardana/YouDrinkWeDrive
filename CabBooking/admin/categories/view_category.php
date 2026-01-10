<?php
require_once('./../../config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `category_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none;
    }
    .view-category-card {
        border-radius: 12px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    }
    .view-category-card .card-header {
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
        border-radius: 12px 12px 0 0;
        border: none;
        padding: 1.25rem 1.5rem;
    }
    .view-category-card .card-body {
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
</style>
<div class="container-fluid">
    <div class="card view-category-card">
        <div class="card-header">
            <h4 class="card-title mb-0"><i class="fa fa-info-circle"></i> Category Information</h4>
        </div>
        <div class="card-body">
            <div class="view-field">
                <div class="view-field-label">Category Name</div>
                <div class="view-field-value"><?= isset($name) && !empty($name) ? htmlspecialchars($name) : '<span class="empty">Not specified</span>' ?></div>
            </div>
            <div class="view-field">
                <div class="view-field-label">Description</div>
                <div class="view-field-value"><?= isset($description) && !empty($description) ? nl2br(htmlspecialchars($description)) : '<span class="empty">No description provided</span>' ?></div>
            </div>
            <div class="view-field">
                <div class="view-field-label">Status</div>
                <div class="view-field-value">
                    <?php if(isset($status)): ?>
                        <?php if($status == 1): ?>
                            <span class="badge badge-success px-3 rounded-pill">Active</span>
                        <?php else: ?>
                            <span class="badge badge-danger px-3 rounded-pill">Inactive</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span class="empty">Not set</span>
                    <?php endif; ?>
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