/**
 * CF7 Extended Validation - Main Entry Point
 * This file imports both JavaScript and CSS for the plugin
 */

// Import styles
import './cf7-extended-validation.css';

/**
 * CF7 Extended Validation
 * Enhances Contact Form 7 with improved submit button handling and loading states
 */

(function() {
    'use strict';

    /**
     * Disable submit button on form submission
     * This prevents double submissions and provides immediate feedback
     */
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.wpcf7-form').forEach(form => {
            form.addEventListener('submit', function () {
                let submitButton = this.querySelector('.wpcf7-submit');
                if (submitButton) {
                    submitButton.setAttribute('disabled', 'true');
                    submitButton.classList.add('disabled');
                }
            });

            // Re-enable button after successful form submission
            form.addEventListener('wpcf7mailsent', function () {
                let submitButton = this.querySelector('.wpcf7-submit');
                if (submitButton) {
                    submitButton.removeAttribute('disabled');
                    submitButton.classList.remove('disabled');
                }
            });

            // Re-enable button if there's an error
            ['wpcf7invalid', 'wpcf7spam', 'wpcf7mailfailed'].forEach(eventType => {
                form.addEventListener(eventType, function () {
                    let submitButton = this.querySelector('.wpcf7-submit');
                    if (submitButton) {
                        submitButton.removeAttribute('disabled');
                        submitButton.classList.remove('disabled');
                    }
                });
            });
        });
    });

    /**
     * Change submit button text and add loading spinner during form submission
     */
    document.addEventListener('wpcf7beforesubmit', function(event) {
        const formId = event.detail.contactFormId;
        const form = document.querySelector(`[data-wpcf7-id="${formId}"]`);

        if (form) {
            const submitButton = form.querySelector('.wpcf7-submit');

            if (submitButton) {
                // Store original text if not already stored
                if (!submitButton.dataset.originalText) {
                    submitButton.dataset.originalText = submitButton.value;
                }
                submitButton.disabled = true;
                submitButton.classList.add('disabled');
                submitButton.value = 'Processing...';

                // Wrap button in container if not already wrapped
                if (!submitButton.parentElement.classList.contains('submit-button-wrapper')) {
                    const wrapper = document.createElement('div');
                    wrapper.className = 'submit-button-wrapper';
                    submitButton.parentNode.insertBefore(wrapper, submitButton);
                    wrapper.appendChild(submitButton);
                }

                // Create spinner element and insert after button
                const wrapper = submitButton.parentElement;
                if (!wrapper.querySelector('.submit-loader')) {
                    const loader = document.createElement('span');
                    loader.className = 'submit-loader';
                    wrapper.appendChild(loader);
                }
            }
        }
    });

    /**
     * Restore button state after form submission completes
     */
    document.addEventListener('wpcf7submit', function(event) {
        const formId = event.detail.contactFormId;
        const form = document.querySelector(`[data-wpcf7-id="${formId}"]`);

        if (form) {
            const submitButton = form.querySelector('.wpcf7-submit');
            if (submitButton) {
                submitButton.disabled = false;
                submitButton.classList.remove('disabled');
                submitButton.value = submitButton.dataset.originalText || 'Submit';

                // Remove spinner
                const loader = form.querySelector('.submit-loader');
                if (loader) {
                    loader.remove();
                }
            }
        }
    });

})();
