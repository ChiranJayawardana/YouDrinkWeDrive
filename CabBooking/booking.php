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
        margin-bottom: 25px;
        position: relative;
        overflow: visible;
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
        color: #9333ea;
        font-size: 1.3rem;
    }
    .modern-form-group {
        margin-bottom: 25px;
        position: relative;
        z-index: 1;
    }
    
    /* When inside modal, ensure proper stacking */
    .modal .modern-form-group {
        z-index: auto;
    }
    
    .modal .modern-form-group .input-wrapper {
        z-index: 10050;
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
    
    /* Ensure autocomplete suggestions appear above modal */
    .modal .input-wrapper {
        z-index: auto;
    }
    
    .modal .autocomplete-suggestions {
        z-index: 10060 !important;
        position: absolute !important;
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
        border-color: #a855f7;
        background: white;
        box-shadow: 0 0 0 4px rgba(168, 85, 247, 0.1);
    }
    .modern-input:read-only {
        background: #edf2f7;
        cursor: not-allowed;
        color: #4a5568;
        font-weight: 600;
    }
    .autocomplete-suggestions {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        right: 0 !important;
        background: white !important;
        border: 2px solid #e2e8f0 !important;
        border-top: none !important;
        border-radius: 0 0 12px 12px !important;
        max-height: 200px !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        z-index: 10060 !important;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1) !important;
        margin-top: -2px !important;
        display: none !important;
        visibility: visible !important;
        opacity: 1 !important;
    }
    
    .autocomplete-suggestions.show {
        display: block !important;
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
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
    }
    .autocomplete-item i {
        color: #9333ea;
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
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
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
        background: linear-gradient(135deg, #9333ea 0%, #a855f7 100%);
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(147, 51, 234, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .submit-btn:hover {
        background: linear-gradient(135deg, #7e22ce 0%, #9333ea 100%);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(147, 51, 234, 0.4);
    }
    .submit-btn:active {
        transform: translateY(0);
    }
    .submit-btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
    /* Modal-specific fixes for autocomplete visibility */
    #uni_modal {
        z-index: 1050;
    }
    
    #uni_modal .modal-content {
        overflow: visible !important;
        position: relative !important;
    }
    
    #uni_modal .modal-body {
        overflow: visible !important;
        position: relative !important;
    }
    
    #uni_modal .modal-dialog {
        overflow: visible !important;
        position: relative !important;
    }
    
    #uni_modal .booking-form-container {
        overflow: visible !important;
        position: relative !important;
    }
    
    #uni_modal .form-section {
        overflow: visible !important;
        position: relative !important;
    }
    
    #uni_modal .modern-form-group {
        overflow: visible !important;
        position: relative !important;
    }
    
    #uni_modal .input-wrapper {
        overflow: visible !important;
        position: relative !important;
    }
    
    /* Ensure autocomplete is always on top of modal and backdrop */
    #uni_modal .autocomplete-suggestions {
        position: absolute !important;
        z-index: 10060 !important;
        display: none !important;
    }
    
    #uni_modal .autocomplete-suggestions.show {
        display: block !important;
    }
    
    /* Ensure modal backdrop doesn't cover suggestions */
    .modal-backdrop {
        z-index: 1040 !important;
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

<div class="booking-form-container">
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

        <!-- Pricing Section -->
        <div class="form-section">
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
        
        <!-- Submit Button -->
        <div class="submit-btn-container">
            <button type="submit" class="submit-btn">
                <i class="fas fa-calendar-check"></i>
                <span>Confirm Booking</span>
            </button>
        </div>
    </form>
</div>

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
    // Initialize autocomplete when modal is shown
    $(document).on('shown.bs.modal', '#uni_modal', function() {
        // Re-initialize autocomplete for fields in the modal
        setTimeout(function() {
            $('#pickup_zone, #drop_zone').trigger('input');
        }, 100);
    });
    
    function fetchPlaces(query, suggestionsBox) {
        if (!suggestionsBox || suggestionsBox.length === 0) {
            console.log('Suggestions box not found');
            return;
        }
        
        // Get the associated input field
        const inputField = suggestionsBox.closest('.input-wrapper').find('input[type="text"]');
        
        // Clear any previous timeout
        if (suggestionsBox.data('timeout')) {
            clearTimeout(suggestionsBox.data('timeout'));
        }
        
        // Debounce the API call
        const timeout = setTimeout(function() {
            // Check if query has changed (user continued typing)
            const currentValue = inputField.val().trim();
            if (currentValue !== query) {
                return; // Query changed, skip this request
            }
            
            // Use the base URL from the global variable, or construct from current location
            const baseUrl = (typeof _base_url_ !== 'undefined' ? _base_url_ : window.location.origin + window.location.pathname.replace(/\/[^\/]*$/, '/'));
            const apiUrl = baseUrl + 'api/geocode.php';
            
            $.ajax({
                url: `${apiUrl}?q=${encodeURIComponent(query)}`,
                method: 'GET',
                dataType: 'json',
                timeout: 25000,
                cache: false,
                beforeSend: function() {
                    suggestionsBox.html('<div class="autocomplete-item" style="cursor: default; color: #a0aec0;"><i class="fas fa-spinner fa-spin"></i> Searching...</div>');
                    suggestionsBox.addClass('show');
                    suggestionsBox.css({
                        'display': 'block',
                        'z-index': '10060',
                        'position': 'absolute',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                },
                success: function(data) {
                    let suggestions = '';
                    
                    // Check if response has error
                    if (data && data.error) {
                        suggestions = `<div class="autocomplete-item" style="cursor: default; color: #ef4444;"><i class="fas fa-exclamation-circle"></i> ${data.error}</div>`;
                    } else if (data && Array.isArray(data) && data.length > 0) {
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
                    // Force visibility with class and inline styles
                    suggestionsBox.addClass('show');
                    suggestionsBox.css({
                        'display': 'block',
                        'z-index': '10060',
                        'position': 'absolute',
                        'visibility': 'visible',
                        'opacity': '1'
                    });
                },
                error: function(xhr, status, error) {
                    console.error('Geocoding error:', status, error, xhr);
                    let errorMsg = 'Error loading suggestions';
                    
                    if (status === 'timeout') {
                        errorMsg = 'Request timed out. Please try again.';
                    } else if (xhr.status === 0) {
                        errorMsg = 'Network error. Please check your connection.';
                    } else if (xhr.status === 429) {
                        errorMsg = 'Too many requests. Please wait a moment.';
                    } else if (xhr.status >= 500) {
                        errorMsg = 'Server error. Please try again later.';
                    } else if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMsg = xhr.responseJSON.error;
                    }
                    
                    // Only show error if query is still the same (user hasn't changed it)
                    const currentQuery = inputField.val().trim();
                    if (currentQuery === query && currentQuery.length > 2) {
                        suggestionsBox.html(`<div class="autocomplete-item" style="cursor: default; color: #ef4444;"><i class="fas fa-exclamation-circle"></i> ${errorMsg}</div>`);
                        suggestionsBox.addClass('show');
                        suggestionsBox.css({
                            'display': 'block',
                            'z-index': '10060',
                            'position': 'absolute'
                        });
                    } else {
                        // Query changed or cleared, hide suggestions
                        suggestionsBox.empty().hide();
                    }
                }
            });
        }, 500); // 500ms debounce to reduce API calls and avoid rate limiting
        
        // Store timeout reference
        suggestionsBox.data('timeout', timeout);
    }

    // Fetch places when typing in the pickup location field
    $(document).on('input keyup', '#pickup_zone', function(e) {
        // Don't trigger on arrow keys, enter, etc.
        if ([37, 38, 39, 40, 13, 27].indexOf(e.keyCode) !== -1) {
            return;
        }
        
        const query = $(this).val().trim();
        const suggestionsBox = $('#pickup_suggestions');
        
        if (query.length > 2) {
            fetchPlaces(query, suggestionsBox);
        } else {
            suggestionsBox.empty().hide();
        }
    });

    // Fetch places when typing in the drop-off location field
    $(document).on('input keyup', '#drop_zone', function(e) {
        // Don't trigger on arrow keys, enter, etc.
        if ([37, 38, 39, 40, 13, 27].indexOf(e.keyCode) !== -1) {
            return;
        }
        
        const query = $(this).val().trim();
        const suggestionsBox = $('#drop_suggestions');
        
        if (query.length > 2) {
            fetchPlaces(query, suggestionsBox);
        } else {
            suggestionsBox.removeClass('show').empty().hide();
        }
    });
    
    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.input-wrapper').length && 
            !$(e.target).hasClass('autocomplete-item') && 
            !$(e.target).closest('.autocomplete-item').length &&
            !$(e.target).is('input')) {
            $('.autocomplete-suggestions').removeClass('show').hide();
        }
    });
    
    // Ensure suggestions are visible on focus
    $(document).on('focus', '#pickup_zone, #drop_zone', function() {
        const suggestionsBox = $(this).closest('.input-wrapper').find('.autocomplete-suggestions');
        if (suggestionsBox.children().length > 0) {
            suggestionsBox.addClass('show');
            suggestionsBox.css({
                'display': 'block',
                'z-index': '10060',
                'position': 'absolute'
            });
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
    
    // Remove Cancel and Save buttons from booking form modal
    function removeCancelSaveButtons() {
        // Check if this is the booking form modal
        var modalBody = $('#uni_modal .modal-body');
        if (modalBody.find('#booking-form').length > 0) {
            // Remove buttons with Cancel or Save text from modal footer
            $('#uni_modal .modal-footer button').each(function() {
                var buttonText = $(this).text().trim().toLowerCase();
                if (buttonText.includes('cancel') || buttonText.includes('save')) {
                    $(this).remove();
                }
            });
            
            // Also check for buttons in the modal body (outside the form)
            $('#uni_modal .modal-body button').each(function() {
                var buttonText = $(this).text().trim().toLowerCase();
                var isSubmit = $(this).attr('type') === 'submit' || $(this).hasClass('submit-btn') || $(this).closest('form').length > 0;
                if (!isSubmit && (buttonText.includes('cancel') || buttonText.includes('save'))) {
                    // Only remove if it's not the Confirm Booking button
                    if (!buttonText.includes('confirm') && !buttonText.includes('booking')) {
                        $(this).remove();
                    }
                }
            });
            
            // Remove any buttons after the submit button container
            $('.submit-btn-container').nextAll('button, .btn').each(function() {
                var buttonText = $(this).text().trim().toLowerCase();
                if (buttonText.includes('cancel') || buttonText.includes('save')) {
                    $(this).remove();
                }
            });
        }
    }
    
    // Remove buttons when modal is shown
    $(document).on('shown.bs.modal', '#uni_modal', function() {
        removeCancelSaveButtons();
        // Also check after a short delay in case buttons are added dynamically
        setTimeout(removeCancelSaveButtons, 100);
        setTimeout(removeCancelSaveButtons, 500);
    });
});
</script>
