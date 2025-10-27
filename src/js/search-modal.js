/**
 * Search modal functionality
 */
(function() {
    'use strict';

    // Get elements
    const searchToggle = document.querySelector('.search-toggle');
    const body = document.body;
    
    // Create search modal
    const createSearchModal = () => {
        const modal = document.createElement('div');
        modal.className = 'search-modal';
        modal.innerHTML = `
            <div class="search-modal-overlay"></div>
            <div class="search-modal-content">
                <button class="search-modal-close" aria-label="Close search">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <form role="search" method="get" class="search-modal-form" action="${window.location.origin}">
                    <input type="search" 
                           class="search-modal-input" 
                           placeholder="Search..." 
                           name="s" 
                           value=""
                           autocomplete="off">
                    <button type="submit" class="search-modal-submit">Search</button>
                </form>
            </div>
        `;
        body.appendChild(modal);
        return modal;
    };
    
    // Initialize modal
    let modal = null;
    
    if (searchToggle) {
        searchToggle.addEventListener('click', (e) => {
            e.preventDefault();
            
            // Create modal if it doesn't exist
            if (!modal) {
                modal = createSearchModal();
                
                // Add event listeners
                const closeBtn = modal.querySelector('.search-modal-close');
                const overlay = modal.querySelector('.search-modal-overlay');
                const input = modal.querySelector('.search-modal-input');
                
                closeBtn.addEventListener('click', () => {
                    modal.classList.remove('active');
                    body.classList.remove('search-modal-open');
                });
                
                overlay.addEventListener('click', () => {
                    modal.classList.remove('active');
                    body.classList.remove('search-modal-open');
                });
                
                // Close on escape key
                document.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape' && modal.classList.contains('active')) {
                        modal.classList.remove('active');
                        body.classList.remove('search-modal-open');
                    }
                });
            }
            
            // Toggle modal
            modal.classList.add('active');
            body.classList.add('search-modal-open');
            
            // Focus input
            setTimeout(() => {
                modal.querySelector('.search-modal-input').focus();
            }, 100);
        });
    }
})();
