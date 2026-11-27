/**
 * Surebound Interactive Quote Flow 2026
 * Multi-Step Underwriting Lead Generation Engine
 */
(function(window, document) {
  'use strict';

  var ICON = {
    bop: '<path d="M3 9l1.5-5h15L21 9M4 9v11h16V9M9 20v-6h6v6"/>',
    gl: '<path d="M12 3l8 3v6c0 4.5-3.2 8-8 9-4.8-1-8-4.5-8-9V6z"/>',
    wc: '<circle cx="12" cy="6" r="3"/><path d="M5 21v-2a5 5 0 015-5h4a5 5 0 015 5v2"/>',
    auto: '<path d="M2 17V6h11v11M13 9h4l4 4v4h-2M2 17h2M9 17h6"/><circle cx="6.5" cy="17.5" r="1.8"/><circle cx="17" cy="17.5" r="1.8"/>',
    prop: '<path d="M4 21V5l8-3 8 3v16M9 9h2M13 9h2M9 13h2M13 13h2M10 21v-4h4v4"/>',
    life: '<path d="M12 20s-7-4.5-7-10a4 4 0 017-2.5A4 4 0 0119 10c0 5.5-7 10-7 10z"/>'
  };

  var COV = [
    { id: 'bop', name: 'Business Owner Policy', desc: 'Property and liability in one policy' },
    { id: 'gl', name: 'General Liability', desc: 'Injury and property damage claims' },
    { id: 'wc', name: "Workers' Compensation", desc: 'Employee injuries on the job' },
    { id: 'auto', name: 'Commercial Auto', desc: 'Vans, pickups and work trucks' },
    { id: 'prop', name: 'Commercial Property', desc: 'Buildings and contents' },
    { id: 'life', name: 'Life Insurance', desc: 'Term and permanent coverage' }
  ];

  var RENEW = ['bop', 'gl', 'wc', 'auto', 'prop'];

  function ch(key, label, q, opts, sub) {
    return { type: 'choice', key: key, label: label, q: q, opts: opts, sub: sub || '' };
  }

  function tx(key, label, q, sub, fields) {
    return { type: 'text', key: key, label: label, q: q, sub: sub || '', fields: fields };
  }

  var Q = {
    zip: tx('zip', 'ZIP code', 'Where is your business based?', 'We use this to find carriers that write in your area.', [
      { id: 'zip', label: 'ZIP code', ph: '33602', mode: 'numeric', len: 5 }
    ]),
    btype: ch('btype', 'Business type', 'What kind of business do you run?', [
      'Contractor or trades',
      'Landscaping or grounds care',
      'Cleaning or janitorial',
      'Restaurant or food service',
      'Retail shop',
      'Office or professional services',
      'Auto repair or service',
      'Something else'
    ]),
    desc: tx('desc', 'What you do', 'What work does the business do?', 'A few words is fine, like "residential roofing" or "HVAC repair".', [
      { id: 'desc', label: 'Work you do', ph: 'Residential roofing' }
    ]),
    emp: ch('emp', 'Employees', 'How many employees do you have?', [
      'Just me', '2 to 4', '5 to 15', '16 to 50', 'More than 50'
    ], 'Count full-time and part-time.'),
    years: ch('years', 'Years in business', 'How long have you been in business?', [
      'Under 2 years', '2 to 5 years', 'More than 5 years'
    ]),
    rev: ch('rev', 'Annual revenue', 'About how much revenue does the business make in a year?', [
      'Under $250,000', '$250,000 to $1 million', '$1 million to $3 million', 'Over $3 million'
    ], 'A rough number is fine.'),
    addr: tx('addr', 'Business address', 'What is the business address?', 'We look up the building details from public records, so you do not need to type them.', [
      { id: 'addr', label: 'Street address', ph: '123 Main St, Tampa FL' }
    ]),
    own: ch('own', 'Location', 'Do you own or lease your location?', [
      'Own it and use it', 'Own it and rent it out', 'Lease the space', 'Work from home or on site'
    ]),
    renew: ch('renew', 'Coverage renews', 'When does your current coverage renew?', [
      'Within 30 days', 'In 1 to 3 months', 'In 3 to 6 months', 'More than 6 months away', 'I have no coverage right now'
    ], 'Pick the soonest date if you have more than one policy.'),
    carrier: tx('carrier', 'Current carrier', 'Who is your current insurance company?', 'Leave it blank if you are not sure.', [
      { id: 'carrier', label: 'Insurance company', ph: 'Optional', optional: true }
    ]),
    claims: ch('claims', 'Claims, last 3 years', 'Any insurance claims in the last 3 years?', [
      'None', '1 claim', '2 or more claims'
    ])
  };

  Q.btype.other = 'Something else';
  Q.desc.skip = function(a) { return a.btype === 'Something else'; };
  Q.carrier.skip = function(a) { return a.renew === 'I have no coverage right now'; };

  var RENEW_TAG = ['RENEW-30D', 'RENEW-1-3M', 'RENEW-3-6M', 'RENEW-6M-PLUS', 'UNINSURED'];

  function owns(a) { return /^Own/.test(a.own || ''); }

  var MOD = {
    bop: [
      ch('bop_eq', 'Contents value', 'What is the value of your equipment, tools and inventory?', [
        'Under $50,000', '$50,000 to $250,000', 'Over $250,000'
      ]),
      ch('bop_bld', 'Building value', 'About what would it cost to rebuild the building?', [
        'Under $250,000', '$250,000 to $500,000', '$500,000 to $1 million', 'Over $1 million', 'Not sure'
      ], 'Not sure is fine. We estimate it for you.')
    ],
    gl: [
      ch('gl_sub', 'Subcontractors', 'Do you use subcontractors?', ['Yes', 'No']),
      ch('gl_lim', 'Limits', 'What liability limits do you need?', [
        '$1 million per claim', '$2 million per claim', 'Higher than that', 'Not sure, advise me'
      ], 'Many clients and landlords ask for a certificate with specific limits.')
    ],
    wc: [
      ch('wc_pay', 'Annual payroll', 'What is your total annual payroll?', [
        'Under $100,000', '$100,000 to $300,000', '$300,000 to $1 million', 'Over $1 million'
      ], 'Include everyone you pay on payroll.'),
      ch('wc_sub', 'Uninsured subs', 'Do you hire subcontractors who do not carry their own workers\' comp?', [
        'Yes', 'No', 'Not sure'
      ])
    ],
    auto: [
      ch('au_n', 'Vehicles', 'How many vehicles does the business own?', ['1', '2 to 5', '6 to 10', 'More than 10']),
      ch('au_type', 'Vehicle types', 'What types of vehicles are they?', [
        'Cars or SUVs', 'Pickups or vans', 'Box trucks', 'Heavy trucks or trailers'
      ]),
      ch('au_use', 'Vehicle use', 'What are they mainly used for?', [
        'Service calls or trades', 'Deliveries', 'Sales or commuting', 'Hauling or towing'
      ]),
      ch('au_drv', 'Drivers', 'How many people drive them?', ['1 to 2', '3 to 5', '6 or more']),
      ch('au_rec', 'Driver records', 'In the last 3 years, did any driver have an at-fault accident or a ticket?', [
        'No', 'Yes, one driver', 'Yes, more than one'
      ])
    ],
    prop: [
      ch('pr_use', 'Building use', 'How is the building used?', [
        'Office or retail', 'Restaurant', 'Warehouse or light industrial', 'Apartments or rentals', 'Mixed use', 'Something else'
      ])
    ],
    life: [
      ch('lf_age', 'Age range', 'What is your age range?', ['18 to 29', '30 to 39', '40 to 49', '50 to 59', '60 or older']),
      ch('lf_amt', 'Coverage amount', 'How much coverage are you thinking about?', [
        '$100,000 to $250,000', '$250,000 to $500,000', '$500,000 to $1 million', 'Over $1 million', 'Not sure'
      ]),
      ch('lf_type', 'Policy type', 'What type of policy interests you?', [
        '10-year term', '20-year term', '30-year term', 'Permanent (whole life)', 'Not sure, advise me'
      ]),
      ch('lf_tob', 'Tobacco use', 'Have you used tobacco in the last 12 months?', ['Yes', 'No'], 'Your agent will cover health questions with you directly.')
    ]
  };

  MOD.bop[1].skip = function(a) { return !owns(a); };
  MOD.prop[0].skip = function(a) { return !owns(a); };
  MOD.prop[0].other = 'Something else';
  MOD.prop[0].otherLabel = 'How is the building used?';
  MOD.prop[0].otherPh = 'For example: gym, church, daycare';

  function esc(s) {
    return String(s || '').replace(/[&<>"']/g, function(c) {
      return { '&': '&amp;', '<': '&lt;', 'gt': '&gt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c] || c;
    });
  }

  function detectPageType() {
    var path = (window.location.pathname || '').toLowerCase();
    if (path.indexOf('auto') > -1) return 'auto';
    if (path.indexOf('workers') > -1) return 'wc';
    if (path.indexOf('liability') > -1) return 'gl';
    if (path.indexOf('property') > -1) return 'prop';
    if (path.indexOf('business') > -1 || path.indexOf('bop') > -1) return 'bop';
    if (path.indexOf('life') > -1) return 'life';
    return null;
  }

  function mapCoverageType(typeStr) {
    if (!typeStr) return detectPageType();
    var t = String(typeStr).toLowerCase().trim();
    if (t.indexOf('bop') > -1 || t.indexOf('business owner') > -1 || t === 'business') return 'bop';
    if (t.indexOf('general liability') > -1 || t.indexOf('liability') > -1 || t === 'gl') return 'gl';
    if (t.indexOf('workers') > -1 || t.indexOf('comp') > -1 || t === 'wc') return 'wc';
    if (t.indexOf('auto') > -1 || t.indexOf('vehicle') > -1 || t.indexOf('fleet') > -1) return 'auto';
    if (t.indexOf('property') > -1 || t.indexOf('building') > -1 || t.indexOf('home') > -1) return 'prop';
    if (t.indexOf('life') > -1) return 'life';
    return detectPageType();
  }

  /**
   * Quote Flow Component Controller
   */
  function createQuoteFlow(targetElement, config) {
    config = config || {};
    var card = typeof targetElement === 'string' ? document.getElementById(targetElement) : targetElement;
    if (!card) return null;

    var state = { sel: {}, ans: {}, idx: 0, done: false, quote_ref: null };
    var advTimer = null;
    var lastRender = 0;

    function selected() {
      return COV.filter(function(c) { return state.sel[c.id]; });
    }

    function hasBiz() {
      return selected().some(function(c) { return c.id !== 'life'; });
    }

    function screens() {
      var s = selected().map(function(c) { return c.id; });
      var list = [{ type: 'pick' }];
      if (!s.length) return list;
      var biz = hasBiz();
      list.push(Q.zip);
      if (biz) {
        list.push(Q.btype, Q.desc, Q.emp, Q.years, Q.rev);
      }
      if (s.indexOf('bop') > -1 || s.indexOf('prop') > -1) {
        list.push(Q.addr, Q.own);
      }
      s.forEach(function(id) {
        if (MOD[id]) {
          MOD[id].forEach(function(q) { list.push(q); });
        }
      });
      if (s.some(function(c) { return RENEW.indexOf(c) > -1; })) {
        list.push(Q.renew, Q.carrier);
      }
      if (biz) list.push(Q.claims);
      if (s.length > 1) list.push({ type: 'bundle' });
      list.push({ type: 'contact' });
      return list.filter(function(q) {
        return !(q.skip && q.skip(state.ans));
      });
    }

    function shell(inner, pct, canBack) {
      var stepNo = ('0' + (state.idx + 1)).slice(-2);
      return '<div class="top">' +
        '<button class="back" id="back" type="button"' + (canBack ? '' : ' hidden') + '>&larr; Back</button>' +
        '<span class="step" aria-hidden="true">' + stepNo + '</span>' +
        '<div class="bar" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="' + Math.round(pct) + '">' +
          '<i style="width:' + pct + '%"></i>' +
        '</div>' +
      '</div>' + inner;
    }

    function ready() {
      return Date.now() - lastRender > 250;
    }

    function cancelAdv() {
      if (advTimer) {
        clearTimeout(advTimer);
        advTimer = null;
      }
    }

    function goTo(i) {
      cancelAdv();
      state.idx = i;
      render();
    }

    function autoAdvance(from) {
      if (advTimer) return;
      advTimer = setTimeout(function() {
        advTimer = null;
        if (state.idx === from && !state.done) goTo(from + 1);
      }, 180);
    }

    function pickHtml() {
      var n = selected().length;
      var tiles = COV.map(function(c) {
        return '<button type="button" class="tile" data-id="' + c.id + '" aria-pressed="' + (state.sel[c.id] ? 'true' : 'false') + '">' +
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' + ICON[c.id] + '</svg>' +
          '<div><b>' + esc(c.name) + '</b><span>' + esc(c.desc) + '</span></div>' +
        '</button>';
      }).join('');

      return '<h1>What coverage do you need?</h1>' +
        '<p class="sub">Pick one or more. We only ask about what you choose.</p>' +
        '<div class="tiles">' + tiles + '</div>' +
        '<p class="hint">Picking more than one lets us quote them together for bundle discounts.</p>' +
        '<button class="primary" id="go" type="button"' + (n ? '' : ' disabled') + '>' +
          (n ? ('Continue with ' + n + ' selected &rarr;') : 'Choose a coverage to continue') +
        '</button>';
    }

    function choiceHtml(q) {
      var cur = state.ans[q.key];
      var two = q.opts.length === 2 ? ' two' : '';
      var opts = q.opts.map(function(o) {
        return '<button type="button" class="opt' + (cur === o ? ' on' : '') + '" data-v="' + esc(o) + '">' + esc(o) + '</button>';
      }).join('');
      var other = '';
      if (q.other && cur === q.other) {
        other = '<div class="field" style="margin-top:16px"><label for="other">' + esc(q.otherLabel || 'What type of business is it?') + '</label>' +
          '<input id="other" type="text" placeholder="' + esc(q.otherPh || 'For example: pool cleaning, food truck, daycare') + '" maxlength="80" autocomplete="off" value="' + esc(state.ans[q.key + '_other'] || '') + '"></div>' +
          '<div class="err" id="err" role="alert"></div>' +
          '<button class="primary" id="otherNext" type="button" style="margin-top:0">Next &rarr;</button>';
      }
      return '<h1>' + esc(q.q) + '</h1>' +
        (q.sub ? '<p class="sub">' + esc(q.sub) + '</p>' : '<p class="sub"></p>') +
        '<div class="opts' + two + '">' + opts + '</div>' + other;
    }

    function textHtml(q) {
      var inputs = q.fields.map(function(f) {
        var val = state.ans[f.id] || '';
        return '<div class="field">' +
          '<label for="' + f.id + '">' + esc(f.label) + (f.optional ? ' <span style="font-weight:400;color:var(--sb-flow-muted);">(Optional)</span>' : '') + '</label>' +
          '<input id="' + f.id + '" type="text"' +
            (f.mode ? ' inputmode="' + f.mode + '"' : '') +
            (f.len ? ' maxlength="' + f.len + '"' : '') +
            ' placeholder="' + esc(f.ph || '') + '"' +
            ' value="' + esc(val) + '"' +
            ' autocomplete="off">' +
        '</div>';
      }).join('');

      return '<h1>' + esc(q.q) + '</h1>' +
        (q.sub ? '<p class="sub">' + esc(q.sub) + '</p>' : '<p class="sub"></p>') +
        inputs +
        '<div class="err" id="err" role="alert"></div>' +
        '<button class="primary" id="next" type="button">Next &rarr;</button>';
    }

    function bundleHtml() {
      var chips = selected().map(function(c) {
        return '<li>' + esc(c.name) + '</li>';
      }).join('');
      var cur = state.ans.bundle;
      return '<h1>Bundle and save</h1>' +
        '<p class="sub">Combining your coverages with one carrier often unlocks discounts.</p>' +
        '<ul class="bundle-list">' + chips + '</ul>' +
        '<div class="opts two">' +
          '<button type="button" class="opt' + (cur === 'Yes, bundle them' ? ' on' : '') + '" data-v="Yes, bundle them">Yes, bundle them</button>' +
          '<button type="button" class="opt' + (cur === 'No, keep them separate' ? ' on' : '') + '" data-v="No, keep them separate">No, keep them separate</button>' +
        '</div>';
    }

    function contactHtml() {
      var biz = hasBiz()
        ? '<div class="field"><label for="biz">Business name</label><input id="biz" type="text" autocomplete="organization" placeholder="e.g. Acme Services LLC" value="' + esc(state.ans.biz || '') + '"></div>'
        : '';

      return '<h1>Where should we send your quotes?</h1>' +
        '<p class="sub">A licensed Tampa advisor will compare rates and contact you with options.</p>' +
        '<div class="row2">' +
          '<div class="field"><label for="fn">First name</label><input id="fn" type="text" autocomplete="given-name" placeholder="John" value="' + esc(state.ans.fn || '') + '"></div>' +
          '<div class="field"><label for="ln">Last name</label><input id="ln" type="text" autocomplete="family-name" placeholder="Doe" value="' + esc(state.ans.ln || '') + '"></div>' +
        '</div>' +
        biz +
        '<div class="field"><label for="em">Email address</label><input id="em" type="email" autocomplete="email" placeholder="john@example.com" value="' + esc(state.ans.em || '') + '"></div>' +
        '<div class="field"><label for="ph">Phone number</label><input id="ph" type="tel" autocomplete="tel" placeholder="(813) 555-0100" value="' + esc(state.ans.ph || '') + '"></div>' +
        '<p class="consent">By clicking submit, you agree to be contacted by Surebound Insurance regarding this quote request at the email and phone provided. Consent is not a condition of purchase. <a href="/privacy" target="_blank" style="color:var(--sb-flow-brand,#145CDB);text-decoration:underline;">Privacy Policy</a>.</p>' +
        '<div class="err" id="err" role="alert"></div>' +
        '<button class="primary" id="submit" type="button">Submit Quote Request &rarr;</button>';
    }

    function renderDone() {
      var firstName = (state.ans.fn || '').trim();
      var thankTitle = firstName
        ? ('Thanks, ' + esc(firstName) + '. A Surebound agent will reach out soon.')
        : 'Thanks. A Surebound agent will reach out soon.';

      var covNames = selected().map(function(c) { return c.name; }).join(', ');

      card.innerHTML = '<div class="top">' +
        '<div class="bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">' +
          '<i style="width:100%"></i>' +
        '</div>' +
      '</div>' +
      '<div style="text-align:center;padding:24px 12px 16px;">' +
        '<div style="display:inline-flex;align-items:center;justify-content:center;width:60px;height:60px;background:#e8effc;border-radius:50%;margin-bottom:18px;color:#145CDB;">' +
          '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width:30px;height:30px;"><polyline points="20 6 9 17 4 12"></polyline></svg>' +
        '</div>' +
        '<h1 style="margin-bottom:12px;font-size:26px;color:#002E73;">' + thankTitle + '</h1>' +
        '<p class="sub" style="max-width:480px;margin:0 auto 16px;color:#4d4d4d;line-height:1.6;">' +
          'We have received your request' + (covNames ? (' for <strong>' + esc(covNames) + '</strong>') : '') + '.' +
          (state.quote_ref ? (' Your reference number is <strong style="color:#145CDB;font-family:monospace;">#' + esc(state.quote_ref) + '</strong>.') : '') +
          '<br>Our licensed advisors will compare rates and contact you with options.' +
        '</p>' +
      '</div>' +
      '<div style="display:flex;gap:12px;margin-top:16px;justify-content:center;">' +
        '<button class="ghost" id="again" type="button" style="margin-top:0;">Start another quote</button>' +
        '<button class="primary" id="quoteModalDoneBtn" type="button" style="margin-top:0;width:auto;min-width:140px;">Done</button>' +
      '</div>';

      var againBtn = document.getElementById('again');
      if (againBtn) {
        againBtn.onclick = function() {
          cancelAdv();
          state = { sel: {}, ans: {}, idx: 0, done: false, quote_ref: null };
          render();
        };
      }
      var doneBtn = document.getElementById('quoteModalDoneBtn');
      if (doneBtn) {
        doneBtn.onclick = function() {
          if (typeof window.closeQuoteModal === 'function') {
            window.closeQuoteModal();
          }
        };
      }
    }

    function bind(sc) {
      var at = state.idx;
      var backBtn = card.querySelector('#back');
      if (backBtn) {
        backBtn.onclick = function() {
          if (!ready()) return;
          if (at > 0) goTo(at - 1);
        };
      }

      if (sc.type === 'pick') {
        card.querySelectorAll('.tile').forEach(function(b) {
          b.onclick = function() {
            var id = b.getAttribute('data-id');
            state.sel[id] = !state.sel[id];
            b.setAttribute('aria-pressed', state.sel[id] ? 'true' : 'false');
            var n = selected().length;
            var go = card.querySelector('#go');
            if (go) {
              go.disabled = !n;
              go.innerHTML = n ? ('Continue with ' + n + ' selected &rarr;') : 'Choose a coverage to continue';
            }
          };
        });
        var goBtn = card.querySelector('#go');
        if (goBtn) {
          goBtn.onclick = function() {
            if (!ready()) return;
            if (selected().length) goTo(at + 1);
          };
        }
      } else if (sc.type === 'choice') {
        card.querySelectorAll('.opt').forEach(function(b) {
          b.onclick = function() {
            if (!ready()) return;
            var val = b.getAttribute('data-v');
            state.ans[sc.key] = val;
            if (sc.other && val === sc.other) {
              render();
              var oth = card.querySelector('#other');
              if (oth) oth.focus();
              return;
            }
            card.querySelectorAll('.opt').forEach(function(x) { x.classList.remove('on'); });
            b.classList.add('on');
            autoAdvance(at);
          };
        });

        var on = card.querySelector('#otherNext');
        if (on) {
          var submitOther = function() {
            if (!ready()) return;
            var oth = card.querySelector('#other');
            var t = (oth ? oth.value : '').trim();
            if (t.length < 2) {
              var errEl = card.querySelector('#err');
              if (errEl) errEl.textContent = 'Tell us a little more so we can match you with the right carriers.';
              return;
            }
            state.ans[sc.key + '_other'] = t;
            goTo(at + 1);
          };
          on.onclick = submitOther;
          var othInput = card.querySelector('#other');
          if (othInput) {
            othInput.onkeydown = function(e) {
              if (e.key === 'Enter') submitOther();
            };
          }
        }
      } else if (sc.type === 'bundle') {
        card.querySelectorAll('.opt').forEach(function(b) {
          b.onclick = function() {
            if (!ready()) return;
            state.ans.bundle = b.getAttribute('data-v');
            card.querySelectorAll('.opt').forEach(function(x) { x.classList.remove('on'); });
            b.classList.add('on');
            autoAdvance(at);
          };
        });
      } else if (sc.type === 'text') {
        var first = card.querySelector('input');
        if (first) first.focus();
        var nextBtn = card.querySelector('#next');
        if (nextBtn) {
          nextBtn.onclick = function() {
            if (!ready()) return;
            var err = '';
            sc.fields.forEach(function(x) {
              var inputEl = card.querySelector('#' + x.id);
              var v = (inputEl ? inputEl.value : '').trim();
              if (x.len) {
                if (!/^\d{5}$/.test(v)) err = 'Enter a valid 5 digit ZIP code.';
              } else if (!v && !x.optional) {
                err = 'Please fill in the ' + x.label.toLowerCase() + '.';
              }
              state.ans[x.id] = v;
            });
            if (err) {
              var errEl = card.querySelector('#err');
              if (errEl) errEl.textContent = err;
              return;
            }
            goTo(at + 1);
          };
        }
        card.querySelectorAll('input').forEach(function(i) {
          i.onkeydown = function(e) {
            if (e.key === 'Enter') {
              var n = card.querySelector('#next');
              if (n) n.click();
            }
          };
        });
      } else if (sc.type === 'contact') {
        var submitBtn = card.querySelector('#submit');
        if (submitBtn) {
          submitBtn.onclick = function() {
            if (!ready()) return;
            var v = { fn: 'fn', ln: 'ln', em: 'em', ph: 'ph' }, err = '';
            if (hasBiz()) v.biz = 'biz';
            Object.keys(v).forEach(function(k) {
              var el = card.querySelector('#' + v[k]);
              state.ans[k] = el ? (el.value || '').trim() : '';
            });

            if (!state.ans.fn || !state.ans.ln) {
              err = 'Please enter your first and last name.';
            } else if (hasBiz() && !state.ans.biz) {
              err = 'Please enter your business name.';
            } else if (!/^[^@\s]+@[^@\s]+\.[^@\s]+$/.test(state.ans.em)) {
              err = 'Enter a valid email address, like name@company.com.';
            } else if (state.ans.ph.replace(/\D/g, '').length < 10) {
              err = 'Enter a phone number with area code.';
            }

            if (err) {
              var errEl = card.querySelector('#err');
              if (errEl) errEl.textContent = err;
              return;
            }

            cancelAdv();
            submitBtn.disabled = true;
            submitBtn.innerHTML = 'Submitting Quote Request...';

            // Gather tags
            var submitTags = [];
            selected().forEach(function(c) { submitTags.push('COV-' + c.id.toUpperCase()); });
            if (state.ans.bundle === 'Yes, bundle them') submitTags.push('BUNDLE');
            var ri = Q.renew.opts.indexOf(state.ans.renew);
            if (ri > -1) submitTags.push(RENEW_TAG[ri]);
            if (state.ans.claims && state.ans.claims !== 'None') submitTags.push('CLAIMS-HISTORY');
            if (owns(state.ans)) submitTags.push('OWNS-BUILDING');
            submitTags.push('SOURCE-QUOTE-FLOW');

            // Gather modular data
            var modularData = {};
            selected().forEach(function(c) {
              if (MOD[c.id]) {
                MOD[c.id].forEach(function(mq) {
                  if (state.ans[mq.key] !== undefined) modularData[mq.key] = state.ans[mq.key];
                  if (state.ans[mq.key + '_other'] !== undefined) modularData[mq.key + '_other'] = state.ans[mq.key + '_other'];
                });
              }
            });

            var payload = {
              fn: state.ans.fn,
              ln: state.ans.ln,
              name: state.ans.fn + ' ' + state.ans.ln,
              biz: state.ans.biz || '',
              business_name: state.ans.biz || '',
              em: state.ans.em,
              email: state.ans.em,
              ph: state.ans.ph,
              phone: state.ans.ph,
              zip: state.ans.zip,
              coverages: selected().map(function(c) { return c.id; }),
              btype: state.ans.btype || '',
              btype_other: state.ans.btype_other || '',
              desc: state.ans.desc || '',
              emp: state.ans.emp || '',
              years: state.ans.years || '',
              rev: state.ans.rev || '',
              addr: state.ans.addr || '',
              own: state.ans.own || '',
              renew: state.ans.renew || '',
              carrier: state.ans.carrier || '',
              claims: state.ans.claims || '',
              bundle: state.ans.bundle || '',
              tags: submitTags,
              modular_data: modularData,
              raw_answers: state.ans,
              source_page: window.location.pathname
            };

            var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

            fetch('/quotes', {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrfToken
              },
              body: JSON.stringify(payload)
            })
            .then(function(res) {
              return res.json().then(function(data) { return { ok: res.ok, data: data }; });
            })
            .then(function(result) {
              if (result.ok && result.data && result.data.success) {
                state.quote_ref = result.data.quote_ref || ('Q-' + Math.floor(10000 + Math.random() * 90000));
                state.done = true;
                render();
                if (typeof gtag === 'function') {
                  gtag('event', 'generate_lead', {
                    event_category: 'Quote',
                    event_label: selected().map(function(c) { return c.id; }).join(','),
                    value: state.quote_ref
                  });
                }
              } else {
                submitBtn.disabled = false;
                submitBtn.innerHTML = 'Submit Quote Request &rarr;';
                var errMsg = (result.data && (result.data.message || (result.data.errors ? Object.values(result.data.errors).flat().join(' ') : ''))) || 'Submission failed. Please check your answers and retry.';
                var errEl = card.querySelector('#err');
                if (errEl) errEl.textContent = errMsg;
              }
            })
            .catch(function() {
              submitBtn.disabled = false;
              submitBtn.innerHTML = 'Submit Quote Request &rarr;';
              var errEl = card.querySelector('#err');
              if (errEl) errEl.textContent = 'Connection error. Please retry or call us directly at (813) 214-1731.';
            });
          };
        }
      }
    }

    function render() {
      lastRender = Date.now();
      var list = screens();
      if (state.idx >= list.length) state.idx = list.length - 1;
      var sc = list[state.idx];
      var pct = state.done ? 100 : Math.max(5, (state.idx / list.length) * 100);
      var html = '';

      if (state.done) {
        renderDone();
        return;
      }

      if (sc.type === 'pick') html = pickHtml();
      else if (sc.type === 'choice') html = choiceHtml(sc);
      else if (sc.type === 'text') html = textHtml(sc);
      else if (sc.type === 'bundle') html = bundleHtml();
      else if (sc.type === 'contact') html = contactHtml();

      card.innerHTML = shell(html, pct, state.idx > 0);
      bind(sc);

      var h = card.querySelector('h1');
      if (h) h.setAttribute('tabindex', '-1');
    }

    return {
      render: render,
      reset: function(preselectType) {
        cancelAdv();
        state = { sel: {}, ans: {}, idx: 0, done: false, quote_ref: null };
        if (preselectType) {
          var mapped = mapCoverageType(preselectType);
          if (mapped) state.sel[mapped] = true;
        }
        render();
      },
      getState: function() { return state; }
    };
  }

  // Global Modal Controller
  var globalModalFlow = null;
  var lastFocusedElement = null;

  window.openQuoteModal = function(type) {
    lastFocusedElement = document.activeElement;
    var modal = document.getElementById('quoteModal');
    var cardContainer = document.getElementById('quoteFlowCard');
    if (!modal || !cardContainer) return;

    if (!globalModalFlow) {
      globalModalFlow = createQuoteFlow(cardContainer);
    }

    globalModalFlow.reset(type);

    modal.classList.add('active');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden';

    var firstInteractive = cardContainer.querySelector('button, input');
    if (firstInteractive) firstInteractive.focus();
  };

  window.closeQuoteModal = function() {
    var modal = document.getElementById('quoteModal');
    if (modal) {
      modal.classList.remove('active');
      modal.setAttribute('aria-hidden', 'true');
    }
    document.body.style.overflow = '';
    if (lastFocusedElement && typeof lastFocusedElement.focus === 'function') {
      lastFocusedElement.focus();
    }
  };

  // Keyboard navigation (Escape key to dismiss)
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' || e.keyCode === 27) {
      var modal = document.getElementById('quoteModal');
      if (modal && modal.classList.contains('active')) {
        window.closeQuoteModal();
      }
    }
  });

  // Click outside modal-box to dismiss
  window.addEventListener('click', function(e) {
    var modal = document.getElementById('quoteModal');
    if (e.target === modal) {
      window.closeQuoteModal();
    }
  });

  // Export factory for inline instances (e.g. /custom-quote)
  window.initQuoteFlow = createQuoteFlow;

  // Auto initialize on DOM load if container exists outside modal
  document.addEventListener('DOMContentLoaded', function() {
    var inlineCard = document.getElementById('customQuoteFlowCard');
    if (inlineCard) {
      var inlineFlow = createQuoteFlow(inlineCard);
      if (inlineFlow) inlineFlow.render();
    }
  });

})(window, document);
