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
        modal.setAttribute('role', 'dialog');
        modal.setAttribute('aria-modal', 'true');
        modal.setAttribute('aria-labelledby', 'search-modal-title');
        modal.innerHTML = `
            <div class="search-modal-overlay"></div>
            <div class="search-modal-content">
                <h2 id="search-modal-title" class="sr-only">Search</h2>
                <button class="search-modal-close" aria-label="Close search">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
                <form role="search" method="get" class="search-modal-form" action="${window.location.origin}">
                    <label for="search-modal-input" class="sr-only">Search for:</label>
                    <input type="search" 
                           id="search-modal-input"
                           class="search-modal-input" 
                           placeholder="Search..." 
                           name="s" 
                           value=""
                           autocomplete="off"
                           aria-required="true">
                    <button type="submit" class="search-modal-submit">Search</button>
                </form>
            </div>
        `;
        body.appendChild(modal);
        return modal;
    };
    
    // Initialize modal
    let modal = null;
    let previousActiveElement = null;
    
    // Trap focus within modal
    const trapFocus = (element) => {
        const focusableElements = element.querySelectorAll(
            'a[href], button:not([disabled]), textarea, input, select'
        );
        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];
        
        element.addEventListener('keydown', (e) => {
            if (e.key !== 'Tab') return;
            
            if (e.shiftKey) {
                if (document.activeElement === firstElement) {
                    e.preventDefault();
                    lastElement.focus();
                }
            } else {
                if (document.activeElement === lastElement) {
                    e.preventDefault();
                    firstElement.focus();
                }
            }
        });
    };
    
    const openModal = () => {
        if (!modal) {
            modal = createSearchModal();
            
            // Add event listeners
            const closeBtn = modal.querySelector('.search-modal-close');
            const overlay = modal.querySelector('.search-modal-overlay');
            const input = modal.querySelector('.search-modal-input');
            
            const closeModal = () => {
                modal.classList.remove('active');
                body.classList.remove('search-modal-open');
                if (previousActiveElement) {
                    previousActiveElement.focus();
                }
            };
            
            closeBtn.addEventListener('click', closeModal);
            overlay.addEventListener('click', closeModal);
            
            // Close on escape key
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && modal.classList.contains('active')) {
                    closeModal();
                }
            });
            
            // Trap focus within modal
            trapFocus(modal.querySelector('.search-modal-content'));
        }
        
        // Store currently focused element
        previousActiveElement = document.activeElement;
        
        // Toggle modal
        modal.classList.add('active');
        body.classList.add('search-modal-open');
        
        // Focus input
        setTimeout(() => {
            modal.querySelector('.search-modal-input').focus();
        }, 100);
    };
    
    if (searchToggle) {
        searchToggle.addEventListener('click', (e) => {
            e.preventDefault();
            openModal();
        });
    }
})();
