/**
 * Form Enhancements
 * Floating labels, validation, password strength, and more
 */

(function($) {
    'use strict';

    // ==================== FLOATING LABELS ====================
    $.fn.floatingLabel = function() {
        return this.each(function() {
            const $input = $(this);
            const $wrapper = $input.parent();
            
            if (!$wrapper.hasClass('floating-label-wrapper')) {
                $input.wrap('<div class="floating-label-wrapper"></div>');
                const placeholder = $input.attr('placeholder');
                if (placeholder) {
                    $input.before(`<label class="floating-label">${placeholder}</label>`);
                    $input.attr('placeholder', '');
                }
            }
            
            $input.on('focus blur change', function() {
                const hasValue = $(this).val().length > 0;
                $(this).parent().toggleClass('has-value', hasValue || document.activeElement === this);
            }).trigger('change');
        });
    };

    // ==================== PASSWORD STRENGTH METER ====================
    function calculatePasswordStrength(password) {
        let strength = 0;
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        if (/[a-z]/.test(password) && /[A-Z]/.test(password)) strength++;
        if (/\d/.test(password)) strength++;
        if (/[^A-Za-z0-9]/.test(password)) strength++;
        return strength;
    }

    function initPasswordStrength() {
        $('input[type="password"]').each(function() {
            const $input = $(this);
            if ($input.attr('id') === 'password' || $input.attr('name') === 'password') {
                const $meter = $(`
                    <div class="password-strength-meter">
                        <div class="password-strength-bar">
                            <div class="password-strength-fill"></div>
                        </div>
                        <div class="password-strength-text"></div>
                    </div>
                `);
                $input.after($meter);
                
                $input.on('input', function() {
                    const password = $(this).val();
                    const strength = calculatePasswordStrength(password);
                    const percent = (strength / 5) * 100;
                    
                    const labels = ['', 'Weak', 'Fair', 'Good', 'Strong', 'Very Strong'];
                    const colors = ['#ef4444', '#ef4444', '#f59e0b', '#14b8a6', '#10b981', '#059669'];
                    
                    $meter.find('.password-strength-fill').css({
                        width: percent + '%',
                        background: colors[strength]
                    });
                    $meter.find('.password-strength-text').text(labels[strength]).css('color', colors[strength]);
                });
            }
        });
    }

    // ==================== REAL-TIME VALIDATION ====================
    function validateField($input) {
        const value = $input.val();
        const type = $input.attr('type');
        const required = $input.prop('required');
        
        let isValid = true;
        let message = '';
        
        if (required && !value) {
            isValid = false;
            message = 'This field is required';
        } else if (type === 'email' && value && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
            isValid = false;
            message = 'Please enter a valid email';
        } else if ($input.attr('minlength') && value.length < $input.attr('minlength')) {
            isValid = false;
            message = `Minimum ${$input.attr('minlength')} characters required`;
        }
        
        return { isValid, message };
    }

    function showValidationFeedback($input, isValid, message) {
        const $wrapper = $input.closest('.form-group, .modern-form-group');
        $wrapper.find('.validation-feedback').remove();
        
        if (!isValid && message) {
            $input.addClass('is-invalid').removeClass('is-valid');
            $wrapper.append(`
                <div class="validation-feedback invalid animate-slideInDown">
                    <i class="fas fa-exclamation-circle"></i> ${message}
                </div>
            `);
        } else if (isValid && $input.val().length > 0) {
            $input.addClass('is-valid').removeClass('is-invalid');
            $wrapper.append(`
                <div class="validation-feedback valid animate-slideInDown">
                    <i class="fas fa-check-circle"></i> Looks good!
                </div>
            `);
        } else {
            $input.removeClass('is-valid is-invalid');
        }
    }

    function initRealtimeValidation() {
        $('form input, form textarea, form select').on('blur', function() {
            const validation = validateField($(this));
            showValidationFeedback($(this), validation.isValid, validation.message);
        });
    }

    // ==================== FILE UPLOAD PREVIEW ====================
    function initFileUploadPreview() {
        $('input[type="file"]').on('change', function() {
            const file = this.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const $preview = $(`
                        <div class="file-preview animate-zoomIn">
                            <img src="${e.target.result}" alt="Preview">
                            <button class="file-preview-remove" type="button">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    `);
                    
                    $(this).closest('.form-group').find('.file-preview').remove();
                    $(this).closest('.form-group').append($preview);
                    
                    $preview.find('.file-preview-remove').on('click', function() {
                        $preview.fadeOut(200, function() {
                            $(this).remove();
                        });
                        $(this).val('');
                    }.bind(this));
                }.bind(this);
                reader.readAsDataURL(file);
            }
        });
    }

    // ==================== AUTO-SAVE INDICATOR ====================
    let autoSaveTimeout;
    function showAutoSaveIndicator() {
        clearTimeout(autoSaveTimeout);
        
        let $indicator = $('.auto-save-indicator');
        if (!$indicator.length) {
            $indicator = $('<div class="auto-save-indicator">Saving...</div>');
            $('body').append($indicator);
        }
        
        $indicator.fadeIn(200);
        
        autoSaveTimeout = setTimeout(() => {
            $indicator.text('All changes saved').css('color', '#10b981');
            setTimeout(() => {
                $indicator.fadeOut(300);
            }, 1500);
        }, 1000);
    }

    // ==================== COPY TO CLIPBOARD ====================
    function copyToClipboard(text, $button) {
        navigator.clipboard.writeText(text).then(() => {
            const originalText = $button.html();
            $button.html('<i class="fas fa-check"></i> Copied!').css('background', '#10b981');
            setTimeout(() => {
                $button.html(originalText).css('background', '');
            }, 2000);
        });
    }

    // ==================== TOGGLE PASSWORD VISIBILITY ====================
    function initPasswordToggle() {
        $('.pass_type, .password-toggle').off('click').on('click', function() {
            const $input = $(this).closest('.input-group, .modern-input-group').find('input');
            const type = $input.attr('type');
            const $icon = $(this).find('i');
            
            if (type === 'password') {
                $input.attr('type', 'text');
                $icon.removeClass('fa-eye-slash').addClass('fa-eye');
            } else {
                $input.attr('type', 'password');
                $icon.removeClass('fa-eye').addClass('fa-eye-slash');
            }
        });
    }

    // ==================== FORM PROGRESS TRACKER ====================
    function updateFormProgress($form) {
        const totalFields = $form.find('input[required], select[required], textarea[required]').length;
        const filledFields = $form.find('input[required], select[required], textarea[required]').filter(function() {
            return $(this).val().length > 0;
        }).length;
        
        const percent = (filledFields / totalFields) * 100;
        const $progress = $form.find('.form-progress-bar');
        if ($progress.length) {
            $progress.css('width', percent + '%');
        }
    }

    // ==================== INITIALIZE ON DOCUMENT READY ====================
    $(document).ready(function() {
        // Initialize password strength meter
        initPasswordStrength();
        
        // Initialize real-time validation
        initRealtimeValidation();
        
        // Initialize file upload preview
        initFileUploadPreview();
        
        // Initialize password toggle
        initPasswordToggle();
        
        // Track form progress
        $('form input, form select, form textarea').on('change', function() {
            updateFormProgress($(this).closest('form'));
        });
        
        // Add copy to clipboard for reference codes
        $(document).on('click', '[data-copy]', function() {
            const text = $(this).data('copy');
            copyToClipboard(text, $(this));
        });
    });

    // ==================== EXPORT TO WINDOW ====================
    window.CabBookingForms = {
        showAutoSaveIndicator: showAutoSaveIndicator,
        copyToClipboard: copyToClipboard,
        showValidationFeedback: showValidationFeedback,
        updateFormProgress: updateFormProgress,
        calculatePasswordStrength: calculatePasswordStrength
    };

})(jQuery);

// ==================== ADD STYLES ====================
const style = document.createElement('style');
style.textContent = `
    .password-strength-meter {
        margin-top: 8px;
    }
    .password-strength-bar {
        height: 6px;
        background: #e2e8f0;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 5px;
    }
    .password-strength-fill {
        height: 100%;
        width: 0%;
        transition: all 0.3s ease;
        border-radius: 10px;
    }
    .password-strength-text {
        font-size: 0.875rem;
        font-weight: 600;
    }
    .validation-feedback {
        margin-top: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 6px;
    }
    .validation-feedback.invalid {
        color: #ef4444;
    }
    .validation-feedback.valid {
        color: #10b981;
    }
    .is-invalid {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important;
    }
    .is-valid {
        border-color: #10b981 !important;
        box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.1) !important;
    }
    .file-preview {
        margin-top: 15px;
        position: relative;
        display: inline-block;
    }
    .file-preview img {
        max-width: 200px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .file-preview-remove {
        position: absolute;
        top: -10px;
        right: -10px;
        width: 30px;
        height: 30px;
        background: #ef4444;
        color: white;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
    }
    .auto-save-indicator {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: #06b6d4;
        color: white;
        padding: 12px 20px;
        border-radius: 12px;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(6, 182, 212, 0.3);
        z-index: 9999;
        display: none;
    }
    .floating-label-wrapper {
        position: relative;
        margin-bottom: 20px;
    }
    .floating-label {
        position: absolute;
        left: 18px;
        top: 50%;
        transform: translateY(-50%);
        transition: all 0.3s ease;
        color: #94a3b8;
        pointer-events: none;
        background: white;
        padding: 0 8px;
    }
    .floating-label-wrapper.has-value .floating-label,
    .floating-label-wrapper.focused .floating-label {
        top: 0;
        font-size: 0.875rem;
        color: #06b6d4;
        font-weight: 600;
    }
    .form-progress-bar {
        height: 4px;
        background: #06b6d4;
        transition: width 0.3s ease;
    }
`;
document.head.appendChild(style);
