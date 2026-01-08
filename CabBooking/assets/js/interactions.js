/**
 * Microinteractions JavaScript
 * Ripple effects, hover interactions, and button states
 */

(function($) {
    'use strict';

    // ==================== RIPPLE EFFECT ====================
    function createRipple(event) {
        const button = event.currentTarget;
        const ripple = document.createElement('span');
        const diameter = Math.max(button.clientWidth, button.clientHeight);
        const radius = diameter / 2;

        ripple.style.width = ripple.style.height = `${diameter}px`;
        ripple.style.left = `${event.clientX - button.offsetLeft - radius}px`;
        ripple.style.top = `${event.clientY - button.offsetTop - radius}px`;
        ripple.classList.add('ripple-effect');

        const existingRipple = button.querySelector('.ripple-effect');
        if (existingRipple) {
            existingRipple.remove();
        }

        button.appendChild(ripple);
        
        setTimeout(() => ripple.remove(), 600);
    }

    // ==================== FLOATING LABELS ====================
    function initFloatingLabels() {
        $('.floating-label-group input, .floating-label-group textarea').on('focus blur', function(e) {
            $(this).parent().toggleClass('focused', e.type === 'focus' || this.value.length > 0);
        }).trigger('blur');
    }

    // ==================== TOOLTIP POSITIONING ====================
    function initTooltips() {
        $('[data-tooltip]').each(function() {
            const $this = $(this);
            const tooltipText = $this.data('tooltip');
            
            const $tooltip = $('<div class="tooltip-modern"></div>').text(tooltipText);
            $this.append($tooltip);
            
            $this.on('mouseenter', function() {
                const rect = this.getBoundingClientRect();
                const tooltipRect = $tooltip[0].getBoundingClientRect();
                
                // Position above element
                $tooltip.css({
                    bottom: '100%',
                    left: '50%',
                    transform: 'translateX(-50%)',
                    marginBottom: '10px'
                });
            });
        });
    }

    // ==================== BUTTON LOADING STATE ====================
    function setButtonLoading($button, isLoading) {
        if (isLoading) {
            $button.data('original-text', $button.html());
            $button.prop('disabled', true);
            $button.addClass('btn-loading');
            $button.html('<i class="fas fa-spinner fa-spin"></i> Loading...');
        } else {
            $button.prop('disabled', false);
            $button.removeClass('btn-loading');
            $button.html($button.data('original-text'));
        }
    }

    // ==================== SUCCESS ANIMATION ====================
    function showSuccessAnimation($element) {
        $element.addClass('animate-bounceIn');
        const checkmark = $('<i class="fas fa-check-circle" style="color: #10b981; font-size: 3rem;"></i>');
        checkmark.hide().appendTo($element).fadeIn(300);
        
        setTimeout(() => {
            checkmark.fadeOut(300, function() {
                $(this).remove();
                $element.removeClass('animate-bounceIn');
            });
        }, 2000);
    }

    // ==================== ERROR SHAKE ====================
    function shakeElement($element) {
        $element.addClass('shake-on-error');
        setTimeout(() => {
            $element.removeClass('shake-on-error');
        }, 500);
    }

    // ==================== CARD REVEAL ON HOVER ====================
    function initCardReveal() {
        $('.reveal-card').hover(
            function() {
                $(this).find('.reveal-content').addClass('active');
            },
            function() {
                $(this).find('.reveal-content').removeClass('active');
            }
        );
    }

    // ==================== SMOOTH STATE TRANSITIONS ====================
    function transitionState($element, newClass, duration = 300) {
        $element.fadeOut(duration / 2, function() {
            $element.removeClass().addClass(newClass).fadeIn(duration / 2);
        });
    }

    // ==================== PROGRESS BAR ANIMATION ====================
    function animateProgress($progressBar, targetPercent, duration = 1000) {
        $progressBar.css('width', '0%');
        setTimeout(() => {
            $progressBar.css({
                'width': targetPercent + '%',
                'transition': `width ${duration}ms cubic-bezier(0.4, 0, 0.2, 1)`
            });
        }, 50);
    }

    // ==================== DRAG AND DROP VISUAL FEEDBACK ====================
    function initDragDrop() {
        $('.drag-drop-zone').on('dragover', function(e) {
            e.preventDefault();
            $(this).addClass('drag-over');
        }).on('dragleave drop', function() {
            $(this).removeClass('drag-over');
        });
    }

    // ==================== BADGE NOTIFICATION ANIMATION ====================
    function pulseBadge($badge) {
        $badge.addClass('badge-pulse');
        setTimeout(() => {
            $badge.removeClass('badge-pulse');
        }, 2000);
    }

    // ==================== AUTO-HIDE NOTIFICATIONS ====================
    function showNotification(message, type = 'info', duration = 3000) {
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };
        
        const $notification = $(`
            <div class="modern-toast ${type} notification-enter">
                <div class="toast-content">
                    <div class="toast-icon">
                        <i class="fas ${icons[type]}"></i>
                    </div>
                    <div class="toast-message">
                        <div class="toast-text">${message}</div>
                    </div>
                    <button class="toast-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
        `);
        
        $('body').append($notification);
        
        $notification.find('.toast-close').on('click', function() {
            $notification.fadeOut(300, function() {
                $(this).remove();
            });
        });
        
        if (duration > 0) {
            setTimeout(() => {
                $notification.fadeOut(300, function() {
                    $(this).remove();
                });
            }, duration);
        }
    }

    // ==================== INITIALIZE ON DOCUMENT READY ====================
    $(document).ready(function() {
        // Add ripple effect to buttons
        $(document).on('click', '.ripple, .btn-admin-primary, .btn-admin-secondary, .modern-btn', createRipple);
        
        // Initialize floating labels
        initFloatingLabels();
        
        // Initialize tooltips
        initTooltips();
        
        // Initialize card reveals
        initCardReveal();
        
        // Initialize drag and drop
        initDragDrop();
        
        // Add hover class for enhanced effects
        $('.hover-lift-sm, .hover-lift-md, .hover-lift-lg').hover(
            function() { $(this).addClass('hovered'); },
            function() { $(this).removeClass('hovered'); }
        );
    });

    // ==================== EXPORT TO WINDOW ====================
    window.CabBookingInteractions = {
        setButtonLoading: setButtonLoading,
        showSuccessAnimation: showSuccessAnimation,
        shakeElement: shakeElement,
        animateProgress: animateProgress,
        pulseBadge: pulseBadge,
        showNotification: showNotification,
        transitionState: transitionState
    };

})(jQuery);

// ==================== RIPPLE EFFECT STYLES ====================
const style = document.createElement('style');
style.textContent = `
    .ripple-effect {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.6);
        transform: scale(0);
        animation: ripple-animation 0.6s ease-out;
        pointer-events: none;
    }
    
    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    .drag-over {
        border-color: #06b6d4 !important;
        background: rgba(6, 182, 212, 0.05) !important;
    }
`;
document.head.appendChild(style);
