/**
 * Reading progress indicator
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.querySelector('.reading-progress-bar');

        if (!progressBar) {
            return;
        }

        // Calculate and update progress
        function updateProgress() {
            const windowHeight = window.innerHeight;
            const documentHeight = document.documentElement.scrollHeight;
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            // Calculate progress percentage
            const scrollableHeight = documentHeight - windowHeight;
            const progress = (scrollTop / scrollableHeight) * 100;
            
            // Update progress bar
            progressBar.style.width = progress + '%';
            progressBar.setAttribute('aria-valuenow', Math.round(progress));
        }

        // Throttle function to limit updates
        let ticking = false;
        function requestTick() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    updateProgress();
                    ticking = false;
                });
                ticking = true;
            }
        }

        // Listen for scroll events
        window.addEventListener('scroll', requestTick, { passive: true });

        // Initial update
        updateProgress();

        // Update on resize
        window.addEventListener('resize', function() {
            requestTick();
        }, { passive: true });
    });

})();
