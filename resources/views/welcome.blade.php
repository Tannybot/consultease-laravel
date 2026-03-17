<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ConsultEase - Faculty Consultation & Appointment Booking System. Schedule appointments with faculty members easily.">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>ConsultEase - Faculty Consultation System</title>
</head>
<body>

    {{-- ═══════════ HERO SECTION ═══════════ --}}
    <section class="hero-section">
        <nav class="top-nav">
            <div class="nav-brand">
                <span class="edoc-logo">ConsultEase</span>
                <span class="edoc-logo-sub">| Surigao Del Norte State University</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('login') }}" class="non-style-link"><span class="nav-item">LOGIN</span></a>
                <a href="{{ route('signup') }}" class="non-style-link"><span class="nav-item nav-item-register">REGISTER</span></a>
            </div>
        </nav>

        <div class="hero-content">
            <h1 class="heading-text">Book Faculty Consultations<br>Without the Hassle.</h1>
            <p class="sub-text2">
                Schedule your faculty consultation sessions online — no more long lines,
                missed meetings, or scheduling conflicts. ConsultEase streamlines the entire process.
            </p>
            <div class="hero-actions">
                <a href="{{ route('login') }}">
                    <button class="btn btn-primary hero-btn" id="hero-cta">Make Appointment</button>
                </a>
                <a href="#features" class="non-style-link">
                    <button class="btn hero-btn-outline" id="hero-learn-more">Learn More</button>
                </a>
            </div>
        </div>

        <div class="hero-scroll-hint">
            <span>Scroll to explore</span>
            <div class="scroll-arrow"></div>
        </div>
    </section>

    {{-- ═══════════ FEATURES SECTION ═══════════ --}}
    <section class="features-section" id="features">
        <div class="section-container">
            <h2 class="section-title">Why Use ConsultEase?</h2>
            <p class="section-subtitle">A smarter way to manage faculty consultations at SNSU.</p>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="feature-title">Easy Scheduling</h3>
                    <p class="feature-desc">Browse available faculty consultation slots and book your session in just a few clicks.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                            <circle cx="9" cy="7" r="4"></circle>
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                        </svg>
                    </div>
                    <h3 class="feature-title">Faculty Directory</h3>
                    <p class="feature-desc">Find and connect with faculty members across departments. View their available schedules anytime.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <h3 class="feature-title">Real-Time Updates</h3>
                    <p class="feature-desc">Get instant notifications on your appointment status — confirmations, changes, and reminders.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ HOW IT WORKS SECTION ═══════════ --}}
    <section class="steps-section">
        <div class="section-container">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Three simple steps to your next consultation.</p>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Create an Account</h3>
                    <p class="step-desc">Sign up as a student or faculty member using your university credentials.</p>
                </div>
                <div class="step-connector"></div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Book a Session</h3>
                    <p class="step-desc">Browse available faculty schedules and reserve a consultation slot that works for you.</p>
                </div>
                <div class="step-connector"></div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Consult & Succeed</h3>
                    <p class="step-desc">Show up to your appointment on time. Your faculty member will be expecting you.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════ CTA SECTION ═══════════ --}}
    <section class="cta-section">
        <div class="section-container cta-inner">
            <h2 class="cta-heading">Ready to Get Started?</h2>
            <p class="cta-text">Join ConsultEase today and never miss a faculty consultation again.</p>
            <a href="{{ route('signup') }}">
                <button class="btn btn-primary hero-btn" id="cta-register">Register Now — It's Free</button>
            </a>
        </div>
    </section>

    {{-- ═══════════ FOOTER ═══════════ --}}
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo">ConsultEase</span>
                <span class="footer-tagline">Surigao Del Norte State University</span>
            </div>
            <div class="footer-copy">
                <p>&copy; 2026 ConsultEase &mdash; A Web Solution by Tannybot.</p>
            </div>
        </div>
    </footer>

</body>
</html>
