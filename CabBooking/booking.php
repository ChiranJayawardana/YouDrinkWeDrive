<?php
require_once('./config.php');
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `booking_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>

<style>
    .booking-form-container {
        padding: 30px 0;
    }
    .form-section {
        background: white;
        border-radius: 20px;
        padding: 35px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.08);
        margin-bottom: 0;
    }
    .form-section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #2d3748;
        margin-bottom: 25px;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 15px;
        border-bottom: 2px solid #e2e8f0;
    }
    .form-section-title i {
        color: #06b6d4;
        font-size: 1.3rem;
    }
    .modern-form-group {
        margin-bottom: 25px;
        position: relative;
    }
    .modern-form-group label {
        display: flex;
        align-items: center;
        gap: 8px;
        font-weight: 600;
        color: #4a5568;
        margin-bottom: 10px;
        font-size: 0.95rem;
    }
    .modern-form-group label i {
        color: #667eea;
        font-size: 1rem;
    }
    .input-wrapper {
        position: relative;
        z-index: 1;
    }
    .modern-form-group:focus-within {
        z-index: 10;
    }
    .input-icon {
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: #a0aec0;
        z-index: 2;
    }
    .modern-input {
        width: 100%;
        padding: 14px 15px 14px 45px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: #f8f9fa;
    }
    .modern-input:focus {
        outline: none;
        border-color: #06b6d4;
        background: white;
        box-shadow: 0 0 0 4px rgba(6, 182, 212, 0.1);
    }
    .modern-input:read-only {
        background: #edf2f7;
        cursor: not-allowed;
        color: #4a5568;
        font-weight: 600;
    }
    .autocomplete-suggestions {
        position: absolute;
        top: calc(100% + 2px);
        left: 0;
        right: 0;
        background: white;
        border: 2px solid #667eea;
        border-top: none;
        border-radius: 0 0 12px 12px;
        max-height: 250px;
        overflow-y: auto;
        z-index: 10000;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.2);
        margin-top: 0;
        display: none;
    }
    .autocomplete-suggestions:not(:empty) {
        display: block;
    }
    .modern-form-group:focus-within .autocomplete-suggestions:not(:empty) {
        display: block;
    }
    .autocomplete-item {
        padding: 12px 15px;
        cursor: pointer;
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .autocomplete-item:last-child {
        border-bottom: none;
    }
    .autocomplete-item:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
    }
    .autocomplete-item i {
        color: #667eea;
        font-size: 0.9rem;
    }
    .autocomplete-item:hover i {
        color: white;
    }
    .info-cards {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
        margin-top: 20px;
    }
    .info-card {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        border-radius: 15px;
        padding: 20px;
        color: white;
        text-align: center;
    }
    .info-card-label {
        font-size: 0.85rem;
        opacity: 0.9;
        margin-bottom: 8px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .info-card-value {
        font-size: 1.8rem;
        font-weight: 700;
    }
    .info-card-icon {
        font-size: 2rem;
        margin-bottom: 10px;
        opacity: 0.9;
    }
    .submit-btn-container {
        margin-top: 30px;
        text-align: center;
    }
    .submit-btn {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(6, 182, 212, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(6, 182, 212, 0.4);
    }
    .submit-btn:active {
        transform: translateY(0);
    }
    .submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    @media (max-width: 768px) {
        .form-section {
            padding: 25px 20px;
        }
        .info-cards {
            grid-template-columns: 1fr;
        }
        .submit-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>

<style>
    .wizard-progress {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
        gap: 30px;
        position: relative;
    }
    .wizard-step {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex: 1;
        max-width: 150px;
    }
    .wizard-step-number {
        width: 50px;
        height: 50px;
        background: #e2e8f0;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        font-size: 1.25rem;
        color: #94a3b8;
        transition: all 0.3s ease;
        position: relative;
        z-index: 2;
    }
    .wizard-step.active .wizard-step-number {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        box-shadow: 0 0 20px rgba(6, 182, 212, 0.5);
        animation: pulse 2s ease-in-out infinite;
    }
    .wizard-step.completed .wizard-step-number {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
    }
    .wizard-step-label {
        margin-top: 10px;
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
    }
    .wizard-step.active .wizard-step-label {
        color: #06b6d4;
    }
    .wizard-step-line {
        position: absolute;
        top: 25px;
        left: 50%;
        width: 100%;
        height: 2px;
        background: #e2e8f0;
        z-index: 1;
    }
    .wizard-step.completed .wizard-step-line {
        background: linear-gradient(90deg, #10b981, #06b6d4);
    }
    .wizard-content {
        display: none;
        opacity: 0;
        transform: translateX(50px);
    }
    .wizard-content.active {
        display: block;
        animation: slideInRight 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    .wizard-content.slide-out-left {
        animation: slideOutLeft 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    .wizard-content.slide-out-right {
        animation: slideOutRight 0.5s cubic-bezier(0.4, 0, 0.2, 1) forwards;
    }
    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(50px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
    @keyframes slideOutLeft {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(-50px);
        }
    }
    @keyframes slideOutRight {
        from {
            opacity: 1;
            transform: translateX(0);
        }
        to {
            opacity: 0;
            transform: translateX(50px);
        }
    }
    .wizard-buttons {
        display: flex;
        justify-content: space-between;
        margin-top: 30px;
        gap: 15px;
    }
    .wizard-btn {
        flex: 1;
        padding: 14px 30px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1.05rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }
    .wizard-btn-primary {
        background: linear-gradient(135deg, #06b6d4 0%, #0891b2 100%);
        color: white;
        box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
    }
    .wizard-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(6, 182, 212, 0.4);
    }
    .wizard-btn-secondary {
        background: #e2e8f0;
        color: #475569;
    }
    .wizard-btn-secondary:hover {
        background: #cbd5e0;
        transform: translateY(-2px);
    }
    .wizard-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
</style>

<div class="booking-form-container">
    <!-- Wizard Progress -->
    <div class="wizard-progress">
        <div class="wizard-step active" data-step="1">
            <div class="wizard-step-number">
                <i class="fas fa-map-marked-alt"></i>
            </div>
            <div class="wizard-step-label">Locations</div>
            <div class="wizard-step-line"></div>
        </div>
        <div class="wizard-step" data-step="2">
            <div class="wizard-step-number">
                <i class="fas fa-calculator"></i>
            </div>
            <div class="wizard-step-label">Review</div>
            <div class="wizard-step-line"></div>
        </div>
        <div class="wizard-step" data-step="3">
            <div class="wizard-step-number">
                <i class="fas fa-check"></i>
            </div>
            <div class="wizard-step-label">Confirm</div>
        </div>
    </div>

    <form action="" id="booking-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="driver_id" value="<?= isset($_GET['cid']) ? $_GET['cid'] : (isset($driver_id) ? $driver_id : "") ?>">
        
        <!-- Location Section -->
        <div class="form-section">
            <div class="form-section-title">
                <i class="fas fa-map-marked-alt"></i>
                <span>Trip Details</span>
            </div>
            
            <!-- Pickup Location -->
            <div class="modern-form-group">
                <label for="pickup_zone">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Pickup Location</span>
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-location-arrow input-icon"></i>
                    <input type="text" 
                           name="pickup_zone" 
                           id="pickup_zone" 
                           class="modern-input" 
                           placeholder="Enter pickup address..."
                           value="<?= isset($pickup_zone) ? htmlspecialchars($pickup_zone) : '' ?>" 
                           required>
                    <div id="pickup_suggestions" class="autocomplete-suggestions" style="display:none;"></div>
                </div>
            </div>

            <!-- Drop-off Location -->
            <div class="modern-form-group">
                <label for="drop_zone">
                    <i class="fas fa-flag-checkered"></i>
                    <span>Drop-off Location</span>
                </label>
                <div class="input-wrapper">
                    <i class="fas fa-map-marker-alt input-icon"></i>
                    <input type="text" 
                           name="drop_zone" 
                           id="drop_zone" 
                           class="modern-input" 
                           placeholder="Enter drop-off address..."
                           value="<?= isset($drop_zone) ? htmlspecialchars($drop_zone) : '' ?>" 
                           required>
                    <div id="drop_suggestions" class="autocomplete-suggestions" style="display:none;"></div>
                </div>
            </div>
        </div>

        <div class="wizard-buttons">
            <button type="button" class="modern-btn modern-btn-outline" style="visibility: hidden;">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <button type="button" class="modern-btn modern-btn-primary ripple next-step">
                Next <i class="fas fa-arrow-right"></i>
            </button>
        </div>
        </div>
        
        <!-- Step 2: Pricing Section -->
        <div class="wizard-content" data-step="2">
        <div class="form-section glass-card">
            <div class="form-section-title">
                <i class="fas fa-calculator"></i>
                <span>Pricing Information</span>
            </div>
            
            <div class="info-cards">
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="info-card-label">Distance</div>
                    <div class="info-card-value" id="distance-display">0.00</div>
                    <div style="font-size: 0.9rem; margin-top: 5px; opacity: 0.8;">kilometers</div>
                    <input type="hidden" name="distance" id="distance">
                </div>
                
                <div class="info-card">
                    <div class="info-card-icon">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="info-card-label">Estimated Fee</div>
                    <div class="info-card-value" id="fee-display">0.00</div>
                    <div style="font-size: 0.9rem; margin-top: 5px; opacity: 0.8;">LKR</div>
                    <input type="hidden" name="fee" id="fee">
                </div>
            </div>
        </div>
        
        <div class="wizard-buttons">
            <button type="button" class="wizard-btn wizard-btn-secondary prev-step">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <button type="button" class="wizard-btn wizard-btn-primary next-step">
                Next <i class="fas fa-arrow-right"></i>
            </button>
        </div>
        </div>
        
        <!-- Step 3: Confirmation -->
        <div class="wizard-content" data-step="3">
        <div class="form-section glass-card">
            <div class="form-section-title">
                <i class="fas fa-check-circle"></i>
                <span>Review & Confirm</span>
            </div>
            <div class="confirmation-summary" style="background: #f0fdfa; padding: 25px; border-radius: 15px; margin-bottom: 20px;">
                <h4 style="color: #0891b2; margin-bottom: 20px;"><i class="fas fa-info-circle"></i> Booking Summary</h4>
                <div class="summary-item" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="color: #64748b;"><i class="fas fa-map-marker-alt"></i> Pickup:</span>
                    <strong id="summary-pickup" style="color: #0f172a;">-</strong>
                </div>
                <div class="summary-item" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="color: #64748b;"><i class="fas fa-flag-checkered"></i> Drop-off:</span>
                    <strong id="summary-dropoff" style="color: #0f172a;">-</strong>
                </div>
                <div class="summary-item" style="display: flex; justify-content: space-between; padding: 12px 0; border-bottom: 1px solid #e2e8f0;">
                    <span style="color: #64748b;"><i class="fas fa-route"></i> Distance:</span>
                    <strong id="summary-distance" style="color: #0f172a;">-</strong>
                </div>
                <div class="summary-item" style="display: flex; justify-content: space-between; padding: 12px 0;">
                    <span style="color: #64748b; font-size: 1.1rem;"><i class="fas fa-money-bill-wave"></i> Total Fee:</span>
                    <strong id="summary-fee" style="color: #0891b2; font-size: 1.5rem;">-</strong>
                </div>
            </div>
        </div>
        <div class="wizard-buttons">
            <button type="button" class="wizard-btn wizard-btn-secondary prev-step">
                <i class="fas fa-arrow-left"></i> Previous
            </button>
            <button type="submit" class="wizard-btn wizard-btn-primary" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%); box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);">
                <i class="fas fa-calendar-check"></i>
                <span>Confirm Booking</span>
            </button>
        </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function(){
    let currentStep = 1;
    const totalSteps = 3;
    const $wizardContainer = $('.booking-form-container');
    
    function updateWizard(direction = 'next') {
        // Get current and target content
        const $currentContent = $(`.wizard-content[data-step="${currentStep}"]`);
        const targetStep = direction === 'next' ? currentStep + 1 : currentStep - 1;
        const $targetContent = $(`.wizard-content[data-step="${targetStep}"]`);
        
        // Slide out animation
        if (direction === 'next') {
            $currentContent.addClass('slide-out-left');
        } else {
            $currentContent.addClass('slide-out-right');
        }
        
        setTimeout(() => {
            // Update steps
            $('.wizard-step').removeClass('active completed');
            $('.wizard-step').each(function() {
                const stepNum = $(this).data('step');
                if (stepNum < targetStep) {
                    $(this).addClass('completed');
                } else if (stepNum === targetStep) {
                    $(this).addClass('active');
                }
            });
            
            // Hide current, show target
            $currentContent.removeClass('active slide-out-left slide-out-right').hide();
            $targetContent.addClass('active').show();
            
            // Update current step
            currentStep = targetStep;
            
            // Update summary if on step 3
            if (currentStep === 3) {
                $('#summary-pickup').text($('#pickup_zone').val() || '-');
                $('#summary-dropoff').text($('#drop_zone').val() || '-');
                $('#summary-distance').text($('#distance').val() ? $('#distance').val() + ' km' : '-');
                $('#summary-fee').text($('#fee').val() ? 'LKR ' + $('#fee').val() : '-');
            }
        }, 300);
    }
    
    $('.next-step').on('click', function() {
        if (currentStep < totalSteps) {
            // Validate current step
            const currentContent = $(`.wizard-content[data-step="${currentStep}"]`);
            const requiredFields = currentContent.find('input[required], select[required], textarea[required]');
            let isValid = true;
            
            requiredFields.each(function() {
                if (!$(this).val()) {
                    isValid = false;
                    $(this).addClass('shake-on-error').css('border-color', '#ef4444');
                    setTimeout(() => {
                        $(this).removeClass('shake-on-error').css('border-color', '');
                    }, 500);
                }
            });
            
            if (isValid) {
                updateWizard('next');
            } else {
                // Show validation message
                if (window.CabBookingInteractions) {
                    window.CabBookingInteractions.showNotification('Please fill in all required fields', 'error', 2000);
                }
            }
        }
    });
    
    $('.prev-step').on('click', function() {
        if (currentStep > 1) {
            updateWizard('prev');
        }
    });
    
    // Initialize
    $('.wizard-content').hide();
    $(`.wizard-content[data-step="1"]`).show().addClass('active');
});
</script>

<!-- <div class="container-fluid">
    <form action="" id="booking-form">
        <input type="hidden" name="id" value="<?= isset($id) ? $id : '' ?>">
        <input type="hidden" name="driver_id" value="<?= isset($_GET['cid']) ? $_GET['cid'] : (isset($driver_id) ? $driver_id : "") ?>">
        <div class="form-group">
            <label for="pickup_zone" class="control-label">Pickup Location</label>
            <textarea name="pickup_zone" id="pickup_zone" rows="2" class="form-control form-control-sm rounded-0" required></textarea>
        </div>
        <div class="form-group">
            <label for="drop_zone" class="control-label">Drop-off Location</label>
            <textarea name="drop_zone" id="drop_zone" rows="2" class="form-control form-control-sm rounded-0" required></textarea>
        </div>
    </form>
</div> -->

<!-- <script>
	$(document).ready(function(){
		$('#booking-form').submit(function(e){
			e.preventDefault();
            var _this = $(this)
			 $('.err-msg').remove();
			start_loader();
			$.ajax({
				url:_base_url_+"classes/Master.php?f=save_booking",
				data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
				error:err=>{
					console.log(err)
					alert_toast("An error occured",'error');
					end_loader();
				},
				success:function(resp){
					if(typeof resp =='object' && resp.status == 'success'){
						location.href = './?p=booking_list';
					}else if(resp.status == 'failed' && !!resp.msg){
                        var el = $('<div>')
                            el.addClass("alert alert-danger err-msg").text(resp.msg)
                            _this.prepend(el)
                            el.show('slow')
                            $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                            end_loader()
                    }else{
						alert_toast("An error occured",'error');
						end_loader();
                        console.log(resp)
					}
				}
			})
		})
	})
</script> -->

<script>
$(document).ready(function(){
    function fetchPlaces(query, suggestionsBox) {
        // Prevent multiple simultaneous requests
        if (suggestionsBox.hasClass('loading')) {
            return;
        }
        
        // Show loading state
        suggestionsBox.addClass('loading').html('<div class="autocomplete-item" style="cursor: default; color: #a0aec0;"><i class="fas fa-spinner fa-spin"></i> Searching...</div>').show();
        
        $.ajax({
            url: _base_url_ + 'geocode_proxy.php',
            method: 'GET',
            data: {
                q: query,
                limit: 5,
                country: 'lk'
            },
            dataType: 'json',
            timeout: 10000,
            success: function(data) {
                suggestionsBox.removeClass('loading');
                let suggestions = '';
                
                // Check if there's an error
                if (data.error) {
                    suggestions = '<div class="autocomplete-item" style="cursor: default; color: #f56565;"><i class="fas fa-exclamation-circle"></i> ' + data.error + '</div>';
                } else if (data && data.length > 0) {
                    data.slice(0, 5).forEach(function(place) {
                        suggestions += `<div class="autocomplete-item" data-lat="${place.lat}" data-lon="${place.lon}">
                            <i class="fas fa-map-pin"></i>
                            <span>${place.display_name}</span>
                        </div>`;
                    });
                } else {
                    suggestions = '<div class="autocomplete-item" style="cursor: default; color: #a0aec0;"><i class="fas fa-info-circle"></i> No results found</div>';
                }
                suggestionsBox.html(suggestions);
                if (suggestions) {
                    suggestionsBox.show();
                }
            },
            error: function(xhr, status, error) {
                suggestionsBox.removeClass('loading');
                console.error('Error fetching places:', error);
                let errorMsg = 'Error loading suggestions';
                if (status === 'timeout') {
                    errorMsg = 'Request timed out. Please try again.';
                } else if (xhr.status === 0) {
                    errorMsg = 'Network error. Please check your connection.';
                }
                suggestionsBox.html('<div class="autocomplete-item" style="cursor: default; color: #f56565;"><i class="fas fa-exclamation-circle"></i> ' + errorMsg + '</div>').show();
            }
        });
    }

    // Debounce function to limit API calls
    let searchTimeout;
    function debounceSearch(func, delay) {
        return function() {
            const context = this;
            const args = arguments;
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                func.apply(context, args);
            }, delay);
        };
    }

    // Fetch places when typing in the pickup location field
    $(document).on('input', '#pickup_zone', debounceSearch(function() {
        const query = $(this).val().trim();
        const suggestionsBox = $('#pickup_suggestions');
        if (query.length > 2) {
            fetchPlaces(query, suggestionsBox);
        } else {
            suggestionsBox.removeClass('loading').empty().hide();
        }
    }, 300));

    // Fetch places when typing in the drop-off location field
    $(document).on('input', '#drop_zone', debounceSearch(function() {
        const query = $(this).val().trim();
        const suggestionsBox = $('#drop_suggestions');
        if (query.length > 2) {
            fetchPlaces(query, suggestionsBox);
        } else {
            suggestionsBox.removeClass('loading').empty().hide();
        }
    }, 300));
    
    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.input-wrapper').length && !$(e.target).closest('.autocomplete-suggestions').length) {
            $('.autocomplete-suggestions').removeClass('loading').hide();
        }
    });

    function calculateDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius of the Earth in km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        const distance = R * c;
        return distance.toFixed(2); // Return distance in km
    }

    function calculateFee(distance) {
        const baseRate = 125; // Base rate per km
        return (distance * baseRate).toFixed(2);
    }

    // Handle the selection of a suggested place
    $(document).on('click', '.autocomplete-item', function() {
        if ($(this).find('span').length === 0) return; // Skip if it's the "no results" message
        
        const lat = $(this).data('lat');
        const lon = $(this).data('lon');
        const displayName = $(this).find('span').text();
        const inputWrapper = $(this).closest('.input-wrapper');
        const input = inputWrapper.find('input[type="text"]');
        
        input.val(displayName);
        input.data('lat', lat);
        input.data('lon', lon);
        inputWrapper.find('.autocomplete-suggestions').empty().hide();
        
        // Calculate distance and fee if both locations are set
        const pickupLat = $('#pickup_zone').data('lat');
        const pickupLon = $('#pickup_zone').data('lon');
        const dropLat = $('#drop_zone').data('lat');
        const dropLon = $('#drop_zone').data('lon');

        if (pickupLat && pickupLon && dropLat && dropLon) {
            const distance = calculateDistance(pickupLat, pickupLon, dropLat, dropLon);
            const fee = calculateFee(distance);
            
            // Update hidden inputs for form submission
            $('#distance').val(distance);
            $('#fee').val(fee);
            
            // Update display values
            $('#distance-display').text(distance);
            $('#fee-display').text(fee);
        }
    });

    // Handle form submission
    $('#booking-form').submit(function(e){
        e.preventDefault();
        var _this = $(this);
        $('.err-msg').remove();
        start_loader();
        $.ajax({
            url: _base_url_ + "classes/Master.php?f=save_booking",
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            dataType: 'json',
            error: err => {
                console.log(err);
                alert_toast("An error occurred", 'error');
                end_loader();
            },
            success: function(resp) {
                if (typeof resp == 'object' && resp.status == 'success') {
                    location.href = './?p=booking_list';
                } else if (resp.status == 'failed' && !!resp.msg) {
                    var el = $('<div>');
                    el.addClass("alert alert-danger err-msg").text(resp.msg);
                    _this.prepend(el);
                    el.show('slow');
                    $("html, body").animate({ scrollTop: _this.closest('.card').offset().top }, "fast");
                    end_loader();
                } else {
                    alert_toast("An error occurred", 'error');
                    end_loader();
                    console.log(resp);
                }
            }
        });
    });
});
</script>
