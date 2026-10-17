/**
 * Surebound Insurance - Enterprise Admin Portal
 * Dynamic State Management, Client Persistence & Interactivity
 */

(function () {
    'use strict';

    // --------------------------------------------------------------------------
    // DEFAULT SEED DATA (Used if localStorage is empty)
    // --------------------------------------------------------------------------
    const DEFAULT_QUOTES = [];
    const DEFAULT_POLICIES = [];
    const DEFAULT_CLAIMS = [];

    // --------------------------------------------------------------------------
    // STORAGE & DATABASE SYNC HELPERS (Strict MySQL Database Grounding)
    // --------------------------------------------------------------------------
    try {
        localStorage.removeItem('sb_admin_quotes');
        localStorage.removeItem('sb_admin_policies');
        localStorage.removeItem('sb_admin_claims');
    } catch (e) {}

    function getQuotes() {
        if (window.__SUREBOUND_DB_QUOTES__ && Array.isArray(window.__SUREBOUND_DB_QUOTES__)) {
            return window.__SUREBOUND_DB_QUOTES__.map(q => ({
                id: q.quote_ref || ('Q-' + q.id),
                dbId: q.id,
                name: q.name,
                email: q.email,
                phone: q.phone || '(206) 555-0100',
                type: q.type || 'home',
                typeLabel: q.type_label || 'Homeowners',
                coverage: q.coverage || '$500,000 Standard',
                premium: q.premium || '$1,500 / yr',
                location: q.location || (q.zip_code ? 'ZIP: ' + q.zip_code : 'Washington'),
                status: q.status || 'new',
                date: q.created_at ? new Date(q.created_at).toLocaleDateString('en-US', { month: 'short', day: 'numeric', year: 'numeric' }) : 'Recent',
                notes: q.notes || ''
            }));
        }
        return [];
    }

    function saveQuotes(quotes) {
        if (window.__SUREBOUND_DB_QUOTES__) {
            window.__SUREBOUND_DB_QUOTES__ = quotes;
        }
        updateDashboardKPIs();
    }

    function getPolicies() {
        if (window.__SUREBOUND_DB_POLICIES__ && Array.isArray(window.__SUREBOUND_DB_POLICIES__)) {
            return window.__SUREBOUND_DB_POLICIES__.map(p => ({
                id: p.policy_number,
                holder: p.holder_name,
                type: p.type || 'home',
                typeLabel: p.type_label || 'Homeowners Deluxe',
                coverage: p.coverage_limit || '$500,000',
                premium: p.annual_premium || '$1,500 / yr',
                effective: p.effective_date || '2026-01-01',
                renewal: p.renewal_date || '2027-01-01',
                status: p.status || 'active'
            }));
        }
        return [];
    }

    function getClaims() {
        if (window.__SUREBOUND_DB_CLAIMS__ && Array.isArray(window.__SUREBOUND_DB_CLAIMS__)) {
            return window.__SUREBOUND_DB_CLAIMS__.map(c => ({
                id: c.claim_number,
                holder: c.claimant_name,
                policyId: c.policy_number,
                incident: c.incident_description,
                estimate: c.estimated_loss || '$1,000',
                adjuster: c.assigned_adjuster || 'Unassigned',
                priority: c.priority || 'Normal',
                status: c.status || 'reviewing',
                date: c.created_at ? new Date(c.created_at).toLocaleDateString() : 'Recent'
            }));
        }
        return [];
    }


    // --------------------------------------------------------------------------
    // DOM REFERENCES
    // --------------------------------------------------------------------------
    const quotesTableBody = document.getElementById('quotesTableBody');
    const policiesTableBody = document.getElementById('policiesTableBody');
    const claimsTableBody = document.getElementById('claimsTableBody');
    const quotesCountBadge = document.getElementById('quotesCountBadge');
    
    // Filters & Search
    let currentQuoteFilter = 'all';
    let currentQuoteSearch = '';

    // --------------------------------------------------------------------------
    // RENDER FUNCTIONS
    // --------------------------------------------------------------------------
    function renderQuotes() {
        if (!quotesTableBody) return;
        const quotes = getQuotes();
        
        let filtered = quotes.filter(q => {
            const matchesFilter = (currentQuoteFilter === 'all') || (q.status.toLowerCase() === currentQuoteFilter.toLowerCase());
            const term = currentQuoteSearch.toLowerCase().trim();
            const matchesSearch = !term || 
                q.name.toLowerCase().includes(term) ||
                q.email.toLowerCase().includes(term) ||
                q.id.toLowerCase().includes(term) ||
                q.typeLabel.toLowerCase().includes(term) ||
                q.location.toLowerCase().includes(term);
            return matchesFilter && matchesSearch;
        });

        if (quotesCountBadge) {
            const newCount = quotes.filter(q => q.status === 'new').length;
            quotesCountBadge.textContent = newCount > 0 ? newCount : quotes.length;
        }

        if (filtered.length === 0) {
            quotesTableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; padding: 48px; color: var(--text-muted);">
                        <svg style="width: 40px; height: 40px; margin: 0 auto 12px; display: block; opacity: 0.5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z"/>
                        </svg>
                        <strong>No matching quote requests found</strong>
                        <p style="font-size: 0.75rem; margin-top: 4px;">Try adjusting your filter or search query.</p>
                    </td>
                </tr>
            `;
            return;
        }

        quotesTableBody.innerHTML = filtered.map(q => {
            const initials = q.name.split(' ').map(n => n[0]).join('').substring(0, 2).toUpperCase();
            return `
                <tr data-id="${q.id}">
                    <td>
                        <div class="user-cell">
                            <div class="user-cell-avatar">${initials}</div>
                            <div>
                                <div class="user-cell-name">${q.name}</div>
                                <div class="user-cell-email">${q.email} • ${q.phone}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="category-badge ${q.type}">
                            ${q.typeLabel}
                        </span>
                    </td>
                    <td>
                        <div style="font-weight: 600; color: var(--text-primary);">${q.coverage}</div>
                        <div style="font-size: 0.75rem; color: var(--text-muted);">${q.premium}</div>
                    </td>
                    <td>
                        <span>${q.location}</span>
                    </td>
                    <td>
                        <span style="font-size: 0.75rem; color: var(--text-muted);">${q.date}</span>
                    </td>
                    <td>
                        <select class="status-select" data-id="${q.id}" style="
                            padding: 3px 8px; 
                            border-radius: var(--radius-full); 
                            font-size: 0.75rem; 
                            font-weight: 700; 
                            cursor: pointer;
                            border: 1px solid var(--border-subtle);
                            background: var(--bg-surface-secondary);
                        ">
                            <option value="new" ${q.status === 'new' ? 'selected' : ''}>New</option>
                            <option value="reviewing" ${q.status === 'reviewing' ? 'selected' : ''}>Reviewing</option>
                            <option value="quoted" ${q.status === 'quoted' ? 'selected' : ''}>Quoted</option>
                            <option value="converted" ${q.status === 'converted' ? 'selected' : ''}>Converted</option>
                            <option value="declined" ${q.status === 'declined' ? 'selected' : ''}>Declined</option>
                        </select>
                    </td>
                    <td>
                        <div class="table-actions">
                            <button class="btn-icon-sm view-quote" data-id="${q.id}" title="View Details">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/></svg>
                            </button>
                            <button class="btn-icon-sm delete delete-quote" data-id="${q.id}" title="Delete">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');

        // Attach event listeners for status change & delete
        quotesTableBody.querySelectorAll('.status-select').forEach(sel => {
            sel.addEventListener('change', function () {
                const id = this.getAttribute('data-id');
                const newStatus = this.value;
                const quotes = getQuotes();
                const target = quotes.find(q => q.id === id);
                if (target) {
                    target.status = newStatus;
                    saveQuotes(quotes);
                    renderQuotes();
                    showNotification(`Quote ${id} status updated to "${newStatus}"`);

                    if (window.__CSRF_TOKEN__ && target.dbId) {
                        fetch(`/admin/quotes/${target.dbId}/status`, {
                            method: 'PATCH',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': window.__CSRF_TOKEN__,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({ status: newStatus })
                        }).catch(err => console.error('Database sync error:', err));
                    }
                }
            });
        });

        quotesTableBody.querySelectorAll('.delete-quote').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                SureboundModal.confirm({
                    title: 'Remove Quote Inquiry',
                    badge: '#' + id,
                    message: `Are you sure you want to permanently remove quote request ${id}? This action cannot be reversed.`,
                    confirmText: 'Remove Quote',
                    cancelText: 'Cancel',
                    type: 'danger',
                    icon: 'trash'
                }).then(confirmed => {
                    if (confirmed) {
                        let quotes = getQuotes();
                        const target = quotes.find(q => q.id === id);
                        quotes = quotes.filter(q => q.id !== id);
                        saveQuotes(quotes);
                        renderQuotes();
                        showNotification(`Quote ${id} has been removed.`);

                        if (window.__CSRF_TOKEN__ && target && target.dbId) {
                            fetch(`/admin/quotes/${target.dbId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': window.__CSRF_TOKEN__,
                                    'Accept': 'application/json'
                                }
                            }).catch(err => console.error('Database sync error:', err));
                        }
                    }
                });
            });
        });

        quotesTableBody.querySelectorAll('.view-quote').forEach(btn => {
            btn.addEventListener('click', function () {
                const id = this.getAttribute('data-id');
                const quotes = getQuotes();
                const q = quotes.find(item => item.id === id);
                if (q) openQuoteDetailModal(q);
            });
        });
    }

    function renderPolicies() {
        if (!policiesTableBody) return;
        const policies = getPolicies();
        if (policies.length === 0) {
            policiesTableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 32px;">
                        No active bound policies registered in database.
                    </td>
                </tr>
            `;
            return;
        }
        policiesTableBody.innerHTML = policies.map(p => `
            <tr>
                <td><code style="font-family: var(--font-mono); font-weight: 700; color: var(--sb-blue-600);">${p.id}</code></td>
                <td><strong style="color: var(--text-primary);">${p.holder}</strong></td>
                <td><span class="category-badge ${p.type}">${p.typeLabel}</span></td>
                <td><strong>${p.coverage}</strong></td>
                <td>${p.premium}</td>
                <td><span style="font-size: 0.75rem; color: var(--text-muted);">${p.renewal}</span></td>
                <td><span class="status-pill ${p.status}">${p.status}</span></td>
            </tr>
        `).join('');
    }

    function renderClaims() {
        if (!claimsTableBody || document.getElementById('serverClaimsTable')) return;
        const claims = getClaims();
        if (claims.length === 0) {
            claimsTableBody.innerHTML = `
                <tr>
                    <td colspan="7" style="text-align: center; color: var(--text-muted); padding: 32px;">
                        No insurance claims registered in database.
                    </td>
                </tr>
            `;
            return;
        }
        claimsTableBody.innerHTML = claims.map(c => `
            <tr>
                <td><code style="font-family: var(--font-mono); font-weight: 700; color: var(--sb-rose-600);">${c.id}</code></td>
                <td>
                    <div style="font-weight: 700; color: var(--text-primary);">${c.holder}</div>
                    <div style="font-size: 0.75rem; color: var(--text-muted); font-family: var(--font-mono);">${c.policyId}</div>
                </td>
                <td style="max-width: 280px;">${c.incident}</td>
                <td><strong style="color: var(--text-primary); font-size: 0.9375rem;">${c.estimate}</strong></td>
                <td><span style="font-weight: 600;">${c.adjuster}</span></td>
                <td><span class="status-pill ${c.status}">${c.status}</span></td>
                <td>
                    <button class="btn-secondary" style="height: 30px; padding: 0 10px; font-size: 0.75rem;" onclick="alert('Claim ${c.id} details opened for adjuster review.')">
                        Review
                    </button>
                </td>
            </tr>
        `).join('');
    }


    function updateDashboardKPIs() {
        const quotes = getQuotes();
        const pendingCount = quotes.filter(q => q.status === 'new' || q.status === 'reviewing').length;
        const kpiQuotes = document.getElementById('kpiPendingQuotes');
        if (kpiQuotes) kpiQuotes.textContent = pendingCount;
    }

    // --------------------------------------------------------------------------
    // MODAL HANDLERS
    // --------------------------------------------------------------------------
    const quoteModal = document.getElementById('quoteModal');
    const quoteDetailModal = document.getElementById('quoteDetailModal');
    const quoteForm = document.getElementById('newQuoteForm');

    window.openNewQuoteModal = function () {
        if (quoteModal) {
            quoteModal.classList.add('active');
            if (quoteForm) quoteForm.reset();
        }
    };

    window.closeModal = function (modalId) {
        const modal = document.getElementById(modalId);
        if (modal) modal.classList.remove('active');
    };

    function openQuoteDetailModal(q) {
        const detailBody = document.getElementById('quoteDetailBody');
        if (!detailBody) return;
        detailBody.innerHTML = `
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 20px; padding-bottom: 16px; border-bottom: 1px solid var(--border-subtle);">
                <div>
                    <h3 style="font-size: 1.25rem; font-weight: 800; color: var(--text-primary);">${q.name}</h3>
                    <p style="font-size: 0.8125rem; color: var(--text-muted);">${q.email} • ${q.phone}</p>
                </div>
                <span class="status-pill ${q.status}" style="font-size: 0.8125rem; padding: 4px 12px;">${q.status}</span>
            </div>
            <div class="form-grid" style="row-gap: 16px; margin-bottom: 20px;">
                <div>
                    <div style="font-size: 0.6875rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Insurance Type</div>
                    <div style="font-weight: 700; color: var(--text-primary); margin-top: 2px;">${q.typeLabel}</div>
                </div>
                <div>
                    <div style="font-size: 0.6875rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Coverage Desired</div>
                    <div style="font-weight: 700; color: var(--text-primary); margin-top: 2px;">${q.coverage}</div>
                </div>
                <div>
                    <div style="font-size: 0.6875rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Location</div>
                    <div style="font-weight: 700; color: var(--text-primary); margin-top: 2px;">${q.location}</div>
                </div>
                <div>
                    <div style="font-size: 0.6875rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Submitted Time</div>
                    <div style="font-weight: 700; color: var(--text-primary); margin-top: 2px;">${q.date}</div>
                </div>
                <div style="grid-column: span 2;">
                    <div style="font-size: 0.6875rem; text-transform: uppercase; color: var(--text-muted); font-weight: 700;">Underwriter Notes & Details</div>
                    <div style="margin-top: 6px; padding: 12px; background: var(--bg-surface-secondary); border-radius: var(--radius-md); font-size: 0.875rem; line-height: 1.5;">
                        ${q.notes || 'No extra notes provided by applicant.'}
                    </div>
                </div>
            </div>
        `;
        if (quoteDetailModal) quoteDetailModal.classList.add('active');
    }

    if (quoteForm) {
        quoteForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const formData = new FormData(this);
            const type = formData.get('type') || 'home';
            const typeLabels = {
                home: 'Homeowners',
                auto: 'Auto Insurance',
                life: 'Life Insurance',
                health: 'Health Insurance',
                umbrella: 'Umbrella Liability',
                bop: 'Business Owner Policy (BOP)',
                business: 'Business Owner Policy (BOP)',
                workers_comp: "Workers' Compensation",
                general_liability: 'General Liability',
                commercial_property: 'Commercial Property Coverage',
                commercial_auto: 'Commercial Auto Insurance',
                surety_bond: 'Surety Bond',
                cyber: 'Cyber Security'
            };

            const newQuote = {
                id: 'Q-' + Math.floor(10000 + Math.random() * 90000),
                name: formData.get('name'),
                email: formData.get('email'),
                phone: formData.get('phone') || '(206) 555-0100',
                type: type,
                typeLabel: typeLabels[type] || 'Personal Line',
                coverage: formData.get('coverage') || '$500,000 Standard',
                premium: '$' + Math.floor(800 + Math.random() * 2200) + ' / yr',
                location: formData.get('zip') ? `ZIP: ${formData.get('zip')}` : 'Washington',
                status: 'new',
                date: 'Just now',
                notes: formData.get('notes') || 'Created manually via Agent Portal.'
            };

            const quotes = getQuotes();
            quotes.unshift(newQuote);
            saveQuotes(quotes);
            renderQuotes();
            closeModal('quoteModal');
            showNotification(`New quote request ${newQuote.id} created for ${newQuote.name}!`);

            if (window.__CSRF_TOKEN__) {
                fetch('/admin/quotes', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': window.__CSRF_TOKEN__,
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        name: newQuote.name,
                        email: newQuote.email,
                        phone: newQuote.phone,
                        type: newQuote.type,
                        coverage: newQuote.coverage,
                        zip: formData.get('zip'),
                        notes: newQuote.notes
                    })
                })
                .then(r => r.json())
                .then(res => {
                    if (res.quote) {
                        newQuote.dbId = res.quote.id;
                        newQuote.id = res.quote.quote_ref;
                        saveQuotes(quotes);
                        renderQuotes();
                    }
                })
                .catch(err => console.error('Database quote creation error:', err));
            }
        });
    }

    // --------------------------------------------------------------------------
    // CSV EXPORT (Real browser download)
    // --------------------------------------------------------------------------
    window.exportQuotesCSV = function () {
        const quotes = getQuotes();
        const headers = ['ID', 'Name', 'Email', 'Phone', 'Type', 'Coverage', 'Premium', 'Location', 'Status', 'Date', 'Notes'];
        const csvRows = [headers.join(',')];

        quotes.forEach(q => {
            const row = [
                `"${q.id}"`,
                `"${q.name.replace(/"/g, '""')}"`,
                `"${q.email}"`,
                `"${q.phone}"`,
                `"${q.typeLabel}"`,
                `"${q.coverage.replace(/"/g, '""')}"`,
                `"${q.premium}"`,
                `"${q.location}"`,
                `"${q.status}"`,
                `"${q.date}"`,
                `"${(q.notes || '').replace(/"/g, '""')}"`
            ];
            csvRows.push(row.join(','));
        });

        const blob = new Blob([csvRows.join('\n')], { type: 'text/csv;charset=utf-8;' });
        const url = URL.createObjectURL(blob);
        const link = document.createElement('a');
        link.setAttribute('href', url);
        link.setAttribute('download', `surebound-quotes-export-${new Date().toISOString().slice(0, 10)}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
        showNotification('Quotes exported successfully to CSV.');
    };

    // --------------------------------------------------------------------------
    // TOAST NOTIFICATION
    // --------------------------------------------------------------------------
    function showNotification(msg) {
        let toast = document.getElementById('sbAdminToast');
        if (!toast) {
            toast = document.createElement('div');
            toast.id = 'sbAdminToast';
            toast.style.cssText = `
                position: fixed;
                bottom: 24px;
                right: 24px;
                background: #0b1524;
                color: #ffffff;
                padding: 12px 20px;
                border-radius: 10px;
                font-size: 0.8125rem;
                font-weight: 600;
                box-shadow: 0 10px 25px rgba(0,0,0,0.25);
                border: 1px solid rgba(16, 185, 129, 0.4);
                display: flex;
                align-items: center;
                gap: 10px;
                z-index: 999;
                transform: translateY(100px);
                opacity: 0;
                transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
            `;
            document.body.appendChild(toast);
        }
        toast.innerHTML = `
            <svg style="width: 18px; height: 18px; color: #10b981; flex-shrink: 0;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
            </svg>
            <span>${msg}</span>
        `;
        toast.style.transform = 'translateY(0)';
        toast.style.opacity = '1';

        clearTimeout(toast.hideTimeout);
        toast.hideTimeout = setTimeout(() => {
            toast.style.transform = 'translateY(100px)';
            toast.style.opacity = '0';
        }, 3200);
    }

    // --------------------------------------------------------------------------
    // NAVIGATION TABS & SIDEBAR (Persistent State Across Page Reloads)
    // --------------------------------------------------------------------------
    function initTabs() {
        const navLinks = document.querySelectorAll('.sidebar-link[data-tab]');
        const subLinks = document.querySelectorAll('.sidebar-sublink[data-tab]');
        const panes = document.querySelectorAll('.tab-pane');
        const breadcrumbCurrent = document.getElementById('breadcrumbCurrent');

        function updateTabUrlAndStorage(targetTab, subtab) {
            let hashName = targetTab;
            if (targetTab === 'marketing') {
                hashName = subtab && subtab !== 'overview' ? ('marketing-' + subtab) : 'marketing';
            }
            try {
                localStorage.setItem('sb_admin_active_tab', targetTab);
                if (targetTab === 'marketing' && subtab) {
                    localStorage.setItem('sb_admin_marketing_subtab', subtab);
                }
            } catch (e) {}

            if (window.location.hash !== ('#' + hashName)) {
                if (window.history && window.history.replaceState) {
                    window.history.replaceState(null, null, '#' + hashName);
                } else {
                    window.location.hash = hashName;
                }
            }
        }

        function activateTab(targetTab, shouldPersist = true, subtab = null) {
            if (!targetTab) return;

            // Map aliases (e.g. billing -> invoices)
            if (targetTab === 'billing' || targetTab === 'invoice') {
                targetTab = 'invoices';
            }

            // Verify tab pane exists or fallback
            let targetPane = document.getElementById('tab-' + targetTab);
            if (!targetPane) {
                targetTab = 'overview';
                targetPane = document.getElementById('tab-overview');
            }

            // Update sidebar links
            navLinks.forEach(l => {
                if (l.getAttribute('data-tab') === targetTab) {
                    l.classList.add('active');
                    if (breadcrumbCurrent) {
                        const label = l.querySelector('span:not(.nav-badge)')?.textContent?.trim() || 'Overview';
                        breadcrumbCurrent.textContent = label;
                    }
                } else {
                    l.classList.remove('active');
                }
            });

            // Update tab panes
            panes.forEach(pane => {
                if (pane.id === 'tab-' + targetTab) {
                    pane.classList.add('active');
                } else {
                    pane.classList.remove('active');
                }
            });

            // Clean up early initial tab style once full script is active
            const earlyStyle = document.getElementById('earlyTabStyle');
            if (earlyStyle) {
                earlyStyle.remove();
            }

            // Expand marketing group if marketing active
            const mktGroup = document.getElementById('sidebarGroupMarketing');
            if (mktGroup) {
                if (targetTab === 'marketing') {
                    mktGroup.classList.add('open');
                }
            }

            if (shouldPersist) {
                updateTabUrlAndStorage(targetTab, subtab);
            }
        }

        navLinks.forEach(link => {
            link.addEventListener('click', function () {
                const targetTab = this.getAttribute('data-tab');
                const subtab = this.getAttribute('data-subtab') || 'overview';
                activateTab(targetTab, true, subtab);

                if (targetTab === 'marketing' && typeof window.switchMarketingSubTab === 'function') {
                    window.switchMarketingSubTab(subtab, false);
                }

                // Close mobile sidebar if open
                const sidebar = document.getElementById('adminSidebar');
                if (sidebar) sidebar.classList.remove('open');
            });
        });

        subLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const targetTab = this.getAttribute('data-tab');
                const subtab = this.getAttribute('data-subtab') || 'overview';

                activateTab(targetTab, true, subtab);

                if (targetTab === 'marketing' && typeof window.switchMarketingSubTab === 'function') {
                    window.switchMarketingSubTab(subtab, false);
                }

                const sidebar = document.getElementById('adminSidebar');
                if (sidebar) sidebar.classList.remove('open');
            });
        });

        // Resolve active tab from URL Hash OR localStorage on load/reload
        function resolveActiveTab() {
            let rawHash = (window.location.hash || '').trim();
            if (rawHash.startsWith('#')) rawHash = rawHash.substring(1);

            if (rawHash) {
                if (rawHash === 'marketing' || rawHash.startsWith('marketing-')) {
                    const sub = rawHash.startsWith('marketing-') ? rawHash.replace('marketing-', '') : 'overview';
                    return { tab: 'marketing', subtab: sub };
                }

                let clean = rawHash.startsWith('tab-') ? rawHash.replace('tab-', '') : rawHash;
                if (clean === 'billing' || clean === 'invoice') clean = 'invoices';

                if (document.getElementById('tab-' + clean) || document.querySelector(`.sidebar-link[data-tab="${clean}"]`)) {
                    return { tab: clean, subtab: null };
                }
            }

            // Fallback to localStorage so browser reload (F5) always stays on the user's active page
            try {
                const storedTab = localStorage.getItem('sb_admin_active_tab');
                if (storedTab) {
                    if (storedTab === 'marketing') {
                        const storedSub = localStorage.getItem('sb_admin_marketing_subtab') || 'overview';
                        return { tab: 'marketing', subtab: storedSub };
                    }
                    let cleanStored = storedTab === 'billing' ? 'invoices' : storedTab;
                    if (document.getElementById('tab-' + cleanStored) || document.querySelector(`.sidebar-link[data-tab="${cleanStored}"]`)) {
                        return { tab: cleanStored, subtab: null };
                    }
                }
            } catch (e) {}

            return { tab: 'overview', subtab: null };
        }

        function restoreActiveTab(syncUrl = true) {
            const { tab, subtab } = resolveActiveTab();
            activateTab(tab, syncUrl, subtab);
            if (tab === 'marketing' && typeof window.switchMarketingSubTab === 'function') {
                window.switchMarketingSubTab(subtab || 'overview', false);
            }
        }

        window.addEventListener('hashchange', function () {
            restoreActiveTab(false);
        });

        // Run immediately on page load / reload
        restoreActiveTab(true);
        setTimeout(function () {
            restoreActiveTab(true);
        }, 60);
    }

    function initFilterButtons() {
        const filterBtns = document.querySelectorAll('.filter-tab-btn');
        filterBtns.forEach(btn => {
            btn.addEventListener('click', function () {
                filterBtns.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                currentQuoteFilter = this.getAttribute('data-filter') || 'all';
                renderQuotes();
            });
        });

        const searchInput = document.getElementById('quotesTableSearch');
        if (searchInput) {
            searchInput.addEventListener('input', function () {
                currentQuoteSearch = this.value;
                renderQuotes();
            });
        }

        const globalSearch = document.getElementById('globalSearchInput');
        if (globalSearch) {
            globalSearch.addEventListener('input', function () {
                const qTab = document.querySelector('.sidebar-link[data-tab="quotes"]');
                if (qTab && !qTab.classList.contains('active')) {
                    qTab.click();
                }
                currentQuoteSearch = this.value;
                if (searchInput) searchInput.value = this.value;
                renderQuotes();
            });
        }
    }

    function initMobileSidebar() {
        const menuBtn = document.getElementById('mobileMenuToggle');
        const sidebar = document.getElementById('adminSidebar');
        if (menuBtn && sidebar) {
            menuBtn.addEventListener('click', () => {
                sidebar.classList.toggle('open');
            });
        }
    }

    // --------------------------------------------------------------------------
    // INITIALIZATION
    // --------------------------------------------------------------------------
    document.addEventListener('DOMContentLoaded', function () {
        initTabs();
        initFilterButtons();
        initMobileSidebar();
        renderQuotes();
        renderPolicies();
        renderClaims();
        updateDashboardKPIs();
    });

})();
