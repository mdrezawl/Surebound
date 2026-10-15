/**
 * Surebound Enterprise Modal & Dialog System
 * Replaces native browser alert() and confirm() with high-end branded dialogs.
 */
(function(window, document) {
    'use strict';

    // SVG Icons Map
    const ICONS = {
        'shield-check': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75m-3-7.036A11.959 11.959 0 013.598 6 11.99 11.99 0 003 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285z"/></svg>`,
        'shield': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m0-18c-2.4 2.4-5.4 3.6-9 3.6 0 6 3.6 11.4 9 14.4 5.4-3 9-8.4 9-14.4-3.6 0-6.6-1.2-9-3.6z"/></svg>`,
        'check': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5"/></svg>`,
        'alert': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 18.75h.007v.008H12v-.008z"/></svg>`,
        'trash': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0"/></svg>`,
        'info': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z"/></svg>`,
        'close': `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>`
    };

    let activeResolve = null;
    let overlayEl = null;
    let cardEl = null;
    let iconWrapEl = null;
    let refPillEl = null;
    let titleEl = null;
    let messageEl = null;
    let actionsEl = null;
    let cancelBtnEl = null;
    let confirmBtnEl = null;
    let toastContainer = null;

    function buildDOM() {
        if (overlayEl) return;

        overlayEl = document.createElement('div');
        overlayEl.className = 'sb-modal-overlay';
        overlayEl.id = 'sureboundModalOverlay';
        overlayEl.setAttribute('role', 'dialog');
        overlayEl.setAttribute('aria-modal', 'true');

        overlayEl.innerHTML = `
            <div class="sb-modal-card" id="sureboundModalCard">
                <button type="button" class="sb-modal-close-corner" id="sbModalCloseX" aria-label="Close dialog">
                    ${ICONS.close}
                </button>
                <div class="sb-modal-icon-badge" id="sbModalIcon"></div>
                <div class="sb-modal-ref-pill" id="sbModalRef" style="display: none;"></div>
                <h3 class="sb-modal-title" id="sbModalTitle">Confirmation</h3>
                <p class="sb-modal-message" id="sbModalMessage"></p>
                <div class="sb-modal-actions" id="sbModalActions">
                    <button type="button" class="sb-modal-btn sb-modal-btn-cancel" id="sbModalCancel">Cancel</button>
                    <button type="button" class="sb-modal-btn sb-modal-btn-confirm" id="sbModalConfirm">Confirm</button>
                </div>
            </div>
        `;

        document.body.appendChild(overlayEl);

        cardEl = overlayEl.querySelector('#sureboundModalCard');
        iconWrapEl = overlayEl.querySelector('#sbModalIcon');
        refPillEl = overlayEl.querySelector('#sbModalRef');
        titleEl = overlayEl.querySelector('#sbModalTitle');
        messageEl = overlayEl.querySelector('#sbModalMessage');
        actionsEl = overlayEl.querySelector('#sbModalActions');
        cancelBtnEl = overlayEl.querySelector('#sbModalCancel');
        confirmBtnEl = overlayEl.querySelector('#sbModalConfirm');

        // Events
        overlayEl.querySelector('#sbModalCloseX').addEventListener('click', () => close(false));
        cancelBtnEl.addEventListener('click', () => close(false));
        confirmBtnEl.addEventListener('click', () => close(true));

        // Click on backdrop to dismiss
        overlayEl.addEventListener('click', (e) => {
            if (e.target === overlayEl) {
                close(false);
            }
        });

        // Keydown listener
        document.addEventListener('keydown', (e) => {
            if (!overlayEl || !overlayEl.classList.contains('is-active')) return;

            if (e.key === 'Escape') {
                e.preventDefault();
                close(false);
            } else if (e.key === 'Enter') {
                // If focus isn't on cancel button, trigger confirm
                if (document.activeElement !== cancelBtnEl) {
                    e.preventDefault();
                    close(true);
                }
            }
        });
    }

    function close(result) {
        if (!overlayEl || !overlayEl.classList.contains('is-active')) return;

        overlayEl.classList.remove('is-active');
        document.body.style.overflow = '';

        const resolver = activeResolve;
        activeResolve = null;
        if (resolver) {
            resolver(result);
        }
    }

    /**
     * Show a confirmation dialog (Confirm / Cancel)
     * Returns Promise<boolean>
     */
    function confirm(options) {
        buildDOM();

        // Handle string argument fallback
        if (typeof options === 'string') {
            options = { message: options };
        }

        const opts = Object.assign({
            title: 'Please Confirm',
            message: '',
            badge: null,
            confirmText: 'Confirm',
            cancelText: 'Cancel',
            type: 'primary', // 'primary' | 'success' | 'warning' | 'danger'
            icon: null,
        }, options);

        return new Promise((resolve) => {
            activeResolve = resolve;

            // Set type class
            cardEl.className = 'sb-modal-card type-' + (opts.type || 'primary');

            // Icon
            let iconName = opts.icon;
            if (!iconName) {
                if (opts.type === 'success') iconName = 'shield-check';
                else if (opts.type === 'danger') iconName = 'trash';
                else if (opts.type === 'warning') iconName = 'alert';
                else iconName = 'shield';
            }
            iconWrapEl.innerHTML = ICONS[iconName] || ICONS.shield;

            // Ref badge (e.g. #SB-Q-74892)
            if (opts.badge) {
                refPillEl.innerText = opts.badge;
                refPillEl.style.display = 'inline-flex';
            } else {
                refPillEl.style.display = 'none';
            }

            // Title & message
            titleEl.innerText = opts.title;
            messageEl.innerHTML = opts.message.replace(/\n/g, '<br>');

            // Buttons
            actionsEl.className = 'sb-modal-actions';
            cancelBtnEl.style.display = 'inline-flex';
            cancelBtnEl.innerText = opts.cancelText || 'Cancel';
            confirmBtnEl.innerText = opts.confirmText || 'Confirm';

            // Show
            overlayEl.classList.add('is-active');
            document.body.style.overflow = 'hidden';

            // Focus confirm
            setTimeout(() => {
                confirmBtnEl.focus();
            }, 60);
        });
    }

    /**
     * Show an alert dialog (single OK button)
     * Returns Promise<void>
     */
    function alert(options) {
        buildDOM();

        if (typeof options === 'string') {
            options = { message: options };
        }

        const opts = Object.assign({
            title: 'Notice',
            message: '',
            badge: null,
            buttonText: 'Got it',
            type: 'info',
            icon: null,
        }, options);

        return new Promise((resolve) => {
            activeResolve = () => resolve();

            cardEl.className = 'sb-modal-card type-' + (opts.type || 'info');

            let iconName = opts.icon;
            if (!iconName) {
                if (opts.type === 'success') iconName = 'shield-check';
                else if (opts.type === 'danger') iconName = 'alert';
                else if (opts.type === 'warning') iconName = 'alert';
                else iconName = 'info';
            }
            iconWrapEl.innerHTML = ICONS[iconName] || ICONS.info;

            if (opts.badge) {
                refPillEl.innerText = opts.badge;
                refPillEl.style.display = 'inline-flex';
            } else {
                refPillEl.style.display = 'none';
            }

            titleEl.innerText = opts.title;
            messageEl.innerHTML = opts.message.replace(/\n/g, '<br>');

            actionsEl.className = 'sb-modal-actions single-btn';
            cancelBtnEl.style.display = 'none';
            confirmBtnEl.innerText = opts.buttonText || 'Got it';

            overlayEl.classList.add('is-active');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                confirmBtnEl.focus();
            }, 60);
        });
    }

    /**
     * Toast notification
     */
    function toast(options) {
        if (typeof options === 'string') {
            options = { message: options };
        }

        const opts = Object.assign({
            message: '',
            type: 'info', // 'success' | 'info' | 'warning' | 'danger'
            duration: 3500
        }, options);

        if (!toastContainer) {
            toastContainer = document.createElement('div');
            toastContainer.className = 'sb-toast-container';
            document.body.appendChild(toastContainer);
        }

        const item = document.createElement('div');
        item.className = 'sb-toast-item type-' + opts.type;

        let iconName = 'info';
        if (opts.type === 'success') iconName = 'check';
        else if (opts.type === 'danger' || opts.type === 'warning') iconName = 'alert';

        item.innerHTML = `
            <div class="sb-toast-icon">${ICONS[iconName]}</div>
            <div style="flex: 1; min-width: 0;">${opts.message}</div>
        `;

        toastContainer.appendChild(item);

        setTimeout(() => {
            item.classList.add('sb-toast-leave');
            setTimeout(() => {
                if (item.parentNode) item.parentNode.removeChild(item);
            }, 250);
        }, opts.duration);
    }

    // Auto-intercept forms with data-confirm attribute
    function initFormInterceptors() {
        document.addEventListener('submit', function(e) {
            const form = e.target;
            const confirmMsg = form.getAttribute('data-confirm');
            if (confirmMsg && !form.__sb_confirmed) {
                e.preventDefault();
                confirm({
                    title: form.getAttribute('data-confirm-title') || 'Please Confirm Action',
                    message: confirmMsg,
                    type: form.getAttribute('data-confirm-type') || 'warning',
                    confirmText: form.getAttribute('data-confirm-btn') || 'Proceed',
                    badge: form.getAttribute('data-confirm-badge') || null
                }).then(res => {
                    if (res) {
                        form.__sb_confirmed = true;
                        form.submit();
                    }
                });
            }
        }, true);
    }

    // Modern Enterprise Modal Object
    const SureboundModal = {
        confirm,
        alert,
        toast,
        close
    };

    window.SureboundModal = SureboundModal;
    window.sureboundConfirm = confirm;
    window.sureboundAlert = alert;
    window.sureboundToast = toast;

    // Seamless monkey patch for window.alert so no legacy alert can show native dialog
    window.alert = function(msg) {
        return alert({
            title: 'Surebound Notice',
            message: String(msg || ''),
            type: 'info',
            buttonText: 'Got it'
        });
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFormInterceptors);
    } else {
        initFormInterceptors();
    }

})(window, document);
