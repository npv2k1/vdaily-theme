/**
 * Main JavaScript file
 */

(function() {
    'use strict';

    // Add loaded class to body when DOM is ready
    document.addEventListener('DOMContentLoaded', function() {
        document.body.classList.add('dom-loaded');
    });

    // External links open in new tab
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('a[href^="http"]');
        const currentDomain = window.location.hostname;

        links.forEach(function(link) {
            const linkDomain = new URL(link.href).hostname;
            if (linkDomain !== currentDomain) {
                link.setAttribute('target', '_blank');
                link.setAttribute('rel', 'noopener noreferrer');
            }
        });
    });

    // Smooth scroll for anchor links
    document.addEventListener('DOMContentLoaded', function() {
        const anchorLinks = document.querySelectorAll('a[href^="#"]');
        
        anchorLinks.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                const target = document.querySelector(href);
                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });

})();
