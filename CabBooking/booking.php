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
        color: #667eea;
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
        border-color: #667eea;
        background: white;
        box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
    }
    .modern-input:read-only {
        background: #edf2f7;
        cursor: not-allowed;
        color: #4a5568;
        font-weight: 600;
    }
    .autocomplete-suggestions {
        position: absolute;
        top: 100%;
        left: 0;
        right: 0;
        background: white;
        border: 2px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 12px 12px;
        max-height: 200px;
        overflow-y: auto;
        z-index: 1000;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        margin-top: -2px;
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border: none;
        padding: 16px 50px;
        border-radius: 12px;
        font-size: 1.1rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }
    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
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
    function fetchPlaces(query, suggestionsBox) {
        $.ajax({
            url: `https://nominatim.openstreetmap.org/search?format=json&q=${query}`,
            method: 'GET',
            success: function(data) {
                let suggestions = '';
                if (data.length > 0) {
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
            }
        });
    }

    // Fetch places when typing in the pickup location field
    $(document).on('input', '#pickup_zone', function() {
        const query = $(this).val();
        const suggestionsBox = $('#pickup_suggestions');
        if (query.length > 2) {
            fetchPlaces(query, suggestionsBox);
            suggestionsBox.show();
        } else {
            suggestionsBox.empty().hide();
        }
    });

    // Fetch places when typing in the drop-off location field
    $(document).on('input', '#drop_zone', function() {
        const query = $(this).val();
        const suggestionsBox = $('#drop_suggestions');
        if (query.length > 2) {
            fetchPlaces(query, suggestionsBox);
            suggestionsBox.show();
        } else {
            suggestionsBox.empty().hide();
        }
    });
    
    // Hide suggestions when clicking outside
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.input-wrapper').length) {
            $('.autocomplete-suggestions').hide();
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
