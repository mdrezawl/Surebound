@extends('layouts.app')

@section('title', 'Get a Quote | Business & Commercial Insurance | Surebound')
@section('meta_description', 'Request a quote for Business Owner Policy, General Liability, Workers\' Comp, Commercial Auto, Commercial Property, and Life Insurance from Surebound Insurance in Tampa, FL.')

@section('content')
<div style="background: var(--sb-flow-bg, #F8FBFF); min-height: 85vh; padding: 48px 16px 80px;">
    <div class="container" style="max-width: 680px; margin: 0 auto;">
        
        <!-- Trust badge / Breadcrumb -->
        <div style="text-align: center; margin-bottom: 24px;">
            <div style="display: inline-flex; align-items: center; gap: 8px; background: #e8effc; color: #145CDB; padding: 6px 14px; border-radius: 9999px; font-size: 13px; font-weight: 700; letter-spacing: 0.04em;">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 15px; height: 15px;"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                <span>LICENSED TAMPA, FL ADVISORS</span>
            </div>
        </div>

        <!-- Standalone Quote Card Container -->
        <div class="quote-flow-standalone-box" style="background: #ffffff; border-radius: 20px; padding: 36px 32px 32px; box-shadow: 0 16px 40px rgba(0, 46, 115, 0.08); border: 1px solid #d3dded;">
            <div class="quote-flow-modal-header" style="display: flex; align-items: center; justify-content: space-between; padding-bottom: 16px; margin-bottom: 16px; border-bottom: 1px solid #d3dded;">
                <a href="{{ url('/') }}" aria-label="Surebound Home" style="display: inline-flex; align-items: center;">
                    <img src="{{ asset('images/logo.png') }}" alt="Surebound Insurance" style="height: 36px; width: auto; max-width: 180px; object-fit: contain;">
                </a>
                <span style="font-size: 13px; font-weight: 600; color: #64748b; font-family: 'Inter', sans-serif;">
                    (813) 214-1731
                </span>
            </div>

            <main class="quote-flow-card" id="standaloneQuoteCard" aria-live="polite">
                <!-- Mounted by quote-flow.js -->
            </main>
        </div>

        <div style="text-align: center; margin-top: 24px; font-size: 13.5px; color: #64748b; line-height: 1.5;">
            <strong style="color: #002E73;">Because your tomorrow matters.</strong><br>
            Surebound Insurance Agency LLC &bull; 100 N Tampa St, Suite 2500, Tampa, FL 33602
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof initQuoteFlow === 'function') {
            window._sbQuoteStandalone = initQuoteFlow('standaloneQuoteCard');
            if (window._sbQuoteStandalone) {
                window._sbQuoteStandalone.render();
            }
        }
    });
</script>
@endsection
