/**
 * Navigation - Mobile menu toggle
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const menuToggle = document.querySelector('.menu-toggle');
        const menuWrapper = document.querySelector('.menu-wrapper');

        if (!menuToggle || !menuWrapper) {
            return;
        }

        // Toggle menu on button click
        menuToggle.addEventListener('click', function() {
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            
            menuToggle.setAttribute('aria-expanded', !isExpanded);
            menuWrapper.classList.toggle('active');
            
            // Animate hamburger icon
            const hamburger = menuToggle.querySelector('.hamburger-icon');
            if (hamburger) {
                hamburger.classList.toggle('active');
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!menuToggle.contains(e.target) && !menuWrapper.contains(e.target)) {
                menuToggle.setAttribute('aria-expanded', 'false');
                menuWrapper.classList.remove('active');
                
                const hamburger = menuToggle.querySelector('.hamburger-icon');
                if (hamburger) {
                    hamburger.classList.remove('active');
                }
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
                if (isExpanded) {
                    menuToggle.setAttribute('aria-expanded', 'false');
                    menuWrapper.classList.remove('active');
                    menuToggle.focus();
                }
            }
        });
    });

})();
