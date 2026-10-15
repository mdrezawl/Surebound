@extends('layouts.app')

@section('title', 'Contact Us | Surebound')

@section('content')

    <!-- ==========================================
         HERO SECTION (DYNAMIC CMS REPLICA)
         ========================================== -->
    <section class="hero-section">
        <div class="hero-photo-bleed">
            <img 
                src="{{ asset($content['hero_image'] ?? 'images/hero-auto.jpg') }}" 
                alt="Contact Us" 
                class="hero-photo-img"
            >
            <div class="hero-photo-fade-right"></div>
            <div class="hero-photo-tint"></div>
        </div>

        <div class="container hero-container">
            <div class="hero-content">
                <p class="hero-eyebrow">{!! $content['hero_eyebrow'] ?? 'Contact Us' !!}</p>
                <h1 class="hero-title">{!! $content['hero_title'] ?? 'Get in Touch' !!}</h1>
                <p class="hero-subtitle">
                    {{ $content['hero_subtitle'] ?? 'Our support team is here to answer your questions and assist you.' }}
                </p>
                <div class="hero-buttons">
                    <a href="#contact-form" class="btn-primary-hero">
                        <span>Send a Message</span>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" width="17" height="17">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTENT SECTION -->
    <section id="contact-form" style="padding: 80px 0; background: var(--bg-primary);">
        <div class="container">
            <div style="max-width: 1000px; margin: 0 auto; display: grid; grid-template-columns: 1fr 1fr; gap: 48px;">
                
                <div>
                    <h2 style="font-size: 34px; margin-bottom: 24px; color: var(--text-dark);">We're here to help.</h2>
                    <p style="font-size: 18px; line-height: 1.6; color: var(--text-medium); margin-bottom: 32px;">
                        Whether you have a question about your policy, need help filing a claim, or want to explore new coverage options, our friendly representatives are ready to assist you.
                    </p>
                    
                    <div style="margin-bottom: 24px;">
                        <h4 style="font-size: 20px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Customer Service</h4>
                        <p style="color: var(--text-medium); font-size: 17px;">1-800-555-0199<br>Mon-Fri, 8am-8pm EST</p>
                    </div>
                    
                    <div style="margin-bottom: 24px;">
                        <h4 style="font-size: 20px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Claims Support</h4>
                        <p style="color: var(--text-medium); font-size: 17px;">1-800-555-0198<br>Available 24/7</p>
                    </div>
                    
                    <div>
                        <h4 style="font-size: 20px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Corporate Headquarters</h4>
                        <p style="color: var(--text-medium); font-size: 17px;">123 Surebound Way<br>Suite 400<br>Chicago, IL 60601</p>
                    </div>
                </div>

                <div style="background: var(--bg-secondary); padding: 40px; border-radius: var(--radius-lg); border: 1px solid var(--border-color); box-shadow: 0 10px 25px rgba(0,0,0,0.05);">
                    <h3 style="font-size: 26px; font-weight: 700; margin-bottom: 24px; color: var(--text-dark);">Send us a message</h3>
                    <form onsubmit="event.preventDefault(); SureboundModal.alert({ title: 'Message Sent Successfully', message: 'Thank you for contacting Surebound! A dedicated insurance advisor will respond to your message shortly.', type: 'success', icon: 'shield-check', buttonText: 'Close' }); this.reset();">
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Full Name</label>
                            <input type="text" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); background: var(--bg-primary); color: var(--text-dark);">
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Email Address</label>
                            <input type="email" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); background: var(--bg-primary); color: var(--text-dark);">
                        </div>
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Subject</label>
                            <select required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); background: var(--bg-primary); color: var(--text-dark);">
                                <option value="">Select a topic...</option>
                                <option value="Policy Question">Policy Question</option>
                                <option value="Billing/Payment">Billing / Payment</option>
                                <option value="Claims">Claims</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        <div style="margin-bottom: 24px;">
                            <label style="display: block; font-size: 16px; font-weight: 600; color: var(--text-dark); margin-bottom: 8px;">Message</label>
                            <textarea rows="4" required style="width: 100%; padding: 12px; border: 1px solid var(--border-color); border-radius: var(--radius-md); background: var(--bg-primary); color: var(--text-dark); resize: vertical;"></textarea>
                        </div>
                        <button type="submit" class="btn-primary" style="width: 100%; padding: 14px; border: none; border-radius: var(--radius-md); background: var(--accent-blue); color: white; font-weight: 600; cursor: pointer;">
                            Submit Message
                        </button>
                    </form>
                </div>
                
            </div>
        </div>
    </section>

@endsection
