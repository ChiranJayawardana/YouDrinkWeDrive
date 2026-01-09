/**
 * Modern Interactions - Cab Booking System
 * Handles animations, smooth scrolling, and interactive elements
 * Version 1.0.0
 */

(function($) {
    'use strict';

    // ============================================
    // NAVBAR SCROLL BEHAVIOR
    // ============================================
    
    function initNavbarScroll() {
        const navbar = $('.navbar-modern, #topNavBar');
        
        if (navbar.length) {
            $(window).on('scroll', function() {
                if ($(window).scrollTop() > 50) {
                    navbar.addClass('scrolled');
                } else {
                    navbar.removeClass('scrolled');
                }
            });
            
            // Trigger on page load
            $(window).trigger('scroll');
        }
    }

    // ============================================
    // SMOOTH SCROLLING
    // ============================================
    
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 80
                }, 800, 'swing');
            }
        });
    }

    // ============================================
    // FADE IN ON SCROLL
    // ============================================
    
    function initFadeInOnScroll() {
        const elements = $('.fade-in-scroll');
        
        if (elements.length && 'IntersectionObserver' in window) {
            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('fade-in');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });
            
            elements.each(function() {
                observer.observe(this);
            });
        } else {
            // Fallback for browsers without IntersectionObserver
            elements.addClass('fade-in');
        }
    }

    // ============================================
    // FORM ENHANCEMENTS
    // ============================================
    
    function initFormEnhancements() {
        // Add focus class to input wrappers
        $('.form-modern-input, .form-modern-textarea, .form-modern-select').on('focus', function() {
            $(this).closest('.form-modern-group').addClass('focused');
        }).on('blur', function() {
            $(this).closest('.form-modern-group').removeClass('focused');
        });
        
        // Real-time validation feedback
        $('.form-modern-input[required], .form-modern-textarea[required]').on('blur', function() {
            if (this.checkValidity()) {
                $(this).removeClass('is-invalid').addClass('is-valid');
            } else {
                $(this).removeClass('is-valid').addClass('is-invalid');
            }
        });
        
        // Password toggle functionality
        $('.password-toggle').on('click', function() {
            const input = $(this).siblings('input');
            const type = input.attr('type') === 'password' ? 'text' : 'password';
            input.attr('type', type);
            $(this).find('i').toggleClass('fa-eye fa-eye-slash');
        });
    }

    // ============================================
    // CARD HOVER EFFECTS
    // ============================================
    
    function initCardEffects() {
        $('.card-modern-hover').hover(
            function() {
                $(this).addClass('hovered');
            },
            function() {
                $(this).removeClass('hovered');
            }
        );
    }

    // ============================================
    // LOADING STATE HELPERS
    // ============================================
    
    window.showLoadingButton = function(buttonElement) {
        const $button = $(buttonElement);
        const originalText = $button.html();
        $button.data('original-text', originalText);
        $button.prop('disabled', true);
        $button.html('<span class="spinner-modern" style="width: 20px; height: 20px; border-width: 2px;"></span>');
    };
    
    window.hideLoadingButton = function(buttonElement) {
        const $button = $(buttonElement);
        const originalText = $button.data('original-text');
        $button.prop('disabled', false);
        $button.html(originalText);
    };

    // ============================================
    // TOAST NOTIFICATION ENHANCEMENT
    // ============================================
    
    window.showModernToast = function(message, type = 'info') {
        const iconMap = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            warning: 'fa-exclamation-triangle',
            info: 'fa-info-circle'
        };
        
        const colorMap = {
            success: 'var(--color-success)',
            error: 'var(--color-danger)',
            warning: 'var(--color-warning)',
            info: 'var(--color-info)'
        };
        
        const toast = $(`
            <div class="modern-toast slide-up" style="
                position: fixed;
                top: 20px;
                right: 20px;
                background: white;
                padding: 16px 24px;
                border-radius: 12px;
                box-shadow: 0 10px 25px rgba(0,0,0,0.1);
                display: flex;
                align-items: center;
                gap: 12px;
                z-index: 9999;
                min-width: 300px;
                max-width: 500px;
                border-left: 4px solid ${colorMap[type]};
            ">
                <i class="fas ${iconMap[type]}" style="color: ${colorMap[type]}; font-size: 24px;"></i>
                <span style="flex: 1;">${message}</span>
                <button onclick="$(this).parent().fadeOut()" style="
                    background: none;
                    border: none;
                    cursor: pointer;
                    font-size: 20px;
                    color: var(--color-gray);
                    padding: 0;
                    width: 24px;
                    height: 24px;
                ">×</button>
            </div>
        `);
        
        $('body').append(toast);
        
        setTimeout(function() {
            toast.fadeOut(function() {
                $(this).remove();
            });
        }, 5000);
    };

    // ============================================
    // MODAL ENHANCEMENTS
    // ============================================
    
    function initModalEnhancements() {
        // Add modern class to existing modals
        $('.modal').addClass('modal-modern');
        
        // Close modal on backdrop click
        $('.modal').on('click', function(e) {
            if ($(e.target).hasClass('modal')) {
                $(this).modal('hide');
            }
        });
    }

    // ============================================
    // COUNTER ANIMATION
    // ============================================
    
    function initCounterAnimation() {
        $('.counter-animate').each(function() {
            const $this = $(this);
            const countTo = parseInt($this.attr('data-count'));
            
            if ('IntersectionObserver' in window) {
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            animateCounter($this, countTo);
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.5 });
                
                observer.observe($this[0]);
            }
        });
    }
    
    function animateCounter($element, countTo) {
        $({ countNum: 0 }).animate(
            { countNum: countTo },
            {
                duration: 2000,
                easing: 'swing',
                step: function() {
                    $element.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $element.text(countTo);
                }
            }
        );
    }

    // ============================================
    // INITIALIZE ALL
    // ============================================
    
    $(document).ready(function() {
        initNavbarScroll();
        initSmoothScroll();
        initFadeInOnScroll();
        initFormEnhancements();
        initCardEffects();
        initModalEnhancements();
        initCounterAnimation();
        
        // Add fade-in to page content
        $('body').addClass('fade-in');
    });

    // ============================================
    // LAZY LOADING IMAGES
    // ============================================
    
    if ('loading' in HTMLImageElement.prototype) {
        // Native lazy loading supported
        $('img[data-src]').each(function() {
            $(this).attr('src', $(this).attr('data-src')).attr('loading', 'lazy');
        });
    } else {
        // Fallback for browsers without native lazy loading
        const images = document.querySelectorAll('img[data-src]');
        
        if ('IntersectionObserver' in window) {
            const imageObserver = new IntersectionObserver(function(entries, observer) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.src = img.dataset.src;
                        img.removeAttribute('data-src');
                        imageObserver.unobserve(img);
                    }
                });
            });
            
            images.forEach(function(img) {
                imageObserver.observe(img);
            });
        }
    }

})(jQuery);
