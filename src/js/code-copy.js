/**
 * Code copy functionality
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', function() {
        const copyButtons = document.querySelectorAll('.copy-code-button');

        copyButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                // Find the code block
                const codeBlock = button.previousElementSibling;
                if (!codeBlock || !codeBlock.querySelector('code')) {
                    return;
                }

                const code = codeBlock.querySelector('code');
                const text = code.textContent;

                // Copy to clipboard
                if (navigator.clipboard && navigator.clipboard.writeText) {
                    navigator.clipboard.writeText(text).then(function() {
                        showCopiedState(button);
                    }).catch(function(err) {
                        console.error('Failed to copy:', err);
                        fallbackCopy(text, button);
                    });
                } else {
                    fallbackCopy(text, button);
                }
            });
        });

        // Show copied state
        function showCopiedState(button) {
            const originalText = button.querySelector('.copy-text').textContent;
            button.classList.add('copied');
            button.querySelector('.copy-text').textContent = 'Copied!';

            setTimeout(function() {
                button.classList.remove('copied');
                button.querySelector('.copy-text').textContent = originalText;
            }, 2000);
        }

        // Fallback copy method for older browsers
        function fallbackCopy(text, button) {
            const textArea = document.createElement('textarea');
            textArea.value = text;
            textArea.style.position = 'fixed';
            textArea.style.left = '-999999px';
            textArea.style.top = '-999999px';
            document.body.appendChild(textArea);
            textArea.focus();
            textArea.select();

            try {
                document.execCommand('copy');
                showCopiedState(button);
            } catch (err) {
                console.error('Fallback copy failed:', err);
            }

            document.body.removeChild(textArea);
        }
    });

})();
