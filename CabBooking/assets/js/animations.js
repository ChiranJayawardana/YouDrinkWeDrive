/**
 * Advanced Animations JavaScript
 * Scroll animations, entrance effects, and interactive animations
 */

(function($) {
    'use strict';

    // ==================== SCROLL REVEAL ANIMATION ====================
    function initScrollReveal() {
        const reveals = document.querySelectorAll('.scroll-reveal');
        
        const revealOnScroll = () => {
            reveals.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                const windowHeight = window.innerHeight;
                
                if (elementTop < windowHeight - 100) {
                    element.classList.add('revealed');
                }
            });
        };
        
        window.addEventListener('scroll', revealOnScroll);
        revealOnScroll(); // Initial check
    }

    // ==================== NUMBER COUNTER ANIMATION ====================
    function animateCounter(element, target, duration = 2000) {
        const start = 0;
        const increment = target / (duration / 16);
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 16);
    }

    function initCounters() {
        $('.count-up').each(function() {
            const $this = $(this);
            const target = parseInt($this.text().replace(/,/g, ''));
            
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !$this.hasClass('counted')) {
                        $this.addClass('counted');
                        animateCounter(this, target);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(this);
        });
    }

    // ==================== PARALLAX EFFECT ====================
    function initParallax() {
        $(window).on('scroll', function() {
            const scrolled = $(window).scrollTop();
            $('.parallax-layer').each(function() {
                const speed = $(this).data('speed') || 0.5;
                $(this).css('transform', `translateY(${scrolled * speed}px)`);
            });
        });
    }

    // ==================== FLOATING ELEMENTS ====================
    function initFloatingElements() {
        $('.floating-element').each(function(index) {
            const delay = index * 0.5;
            $(this).css('animation-delay', `${delay}s`);
        });
    }

    // ==================== STAGGERED ANIMATION ====================
    function staggerAnimation(selector, animationClass, delay = 100) {
        $(selector).each(function(index) {
            const $this = $(this);
            setTimeout(() => {
                $this.addClass(animationClass);
            }, index * delay);
        });
    }

    // ==================== CONFETTI EFFECT ====================
    function createConfetti() {
        const colors = ['#06b6d4', '#14b8a6', '#f59e0b', '#10b981', '#3b82f6'];
        const confettiCount = 50;
        
        for (let i = 0; i < confettiCount; i++) {
            const confetti = $('<div class="confetti"></div>');
            confetti.css({
                left: Math.random() * 100 + '%',
                background: colors[Math.floor(Math.random() * colors.length)],
                animationDelay: Math.random() * 0.5 + 's',
                animationDuration: (Math.random() * 2 + 2) + 's'
            });
            $('body').append(confetti);
            
            setTimeout(() => confetti.remove(), 3000);
        }
    }

    // ==================== SMOOTH SCROLL TO SECTION ====================
    function initSmoothScroll() {
        $('a[href^="#"]').on('click', function(e) {
            const target = $(this.getAttribute('href'));
            if (target.length) {
                e.preventDefault();
                $('html, body').stop().animate({
                    scrollTop: target.offset().top - 100
                }, 800, 'swing');
            }
        });
    }

    // ==================== TYPING ANIMATION ====================
    function typeWriter(element, text, speed = 50) {
        let i = 0;
        element.textContent = '';
        
        function type() {
            if (i < text.length) {
                element.textContent += text.charAt(i);
                i++;
                setTimeout(type, speed);
            }
        }
        
        type();
    }

    function initTypingAnimation() {
        $('.typing-text').each(function() {
            const text = $(this).data('text') || $(this).text();
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !$(this).hasClass('typed')) {
                        $(this).addClass('typed');
                        typeWriter(this, text);
                    }
                });
            }, { threshold: 0.5 });
            
            observer.observe(this);
        });
    }

    // ==================== PARTICLE BACKGROUND ====================
    function createParticles(container, count = 30) {
        for (let i = 0; i < count; i++) {
            const particle = $('<div class="particle"></div>');
            particle.css({
                position: 'absolute',
                width: Math.random() * 4 + 2 + 'px',
                height: Math.random() * 4 + 2 + 'px',
                background: 'rgba(255, 255, 255, 0.5)',
                borderRadius: '50%',
                left: Math.random() * 100 + '%',
                top: Math.random() * 100 + '%',
                animationDelay: Math.random() * 4 + 's',
                animationDuration: (Math.random() * 3 + 3) + 's'
            });
            $(container).append(particle);
        }
    }

    // ==================== INITIALIZE ON DOCUMENT READY ====================
    $(document).ready(function() {
        initScrollReveal();
        initCounters();
        initParallax();
        initFloatingElements();
        initSmoothScroll();
        initTypingAnimation();
        
        // Add particles to hero sections
        if ($('.home-hero').length) {
            createParticles('.home-hero', 30);
        }
        
        // Staggered animations for cards
        if ($('.stat-card').length) {
            staggerAnimation('.stat-card', 'animate-slideInUp', 150);
        }
        
        // Success confetti (trigger on successful actions)
        $(document).on('booking-success', function() {
            createConfetti();
        });
    });

    // ==================== EXPORT FUNCTIONS ====================
    window.CabBookingAnimations = {
        confetti: createConfetti,
        typeWriter: typeWriter,
        staggerAnimation: staggerAnimation,
        animateCounter: animateCounter
    };

})(jQuery);
