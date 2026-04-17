<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="ConsultEase is a faculty consultation and appointment booking system for Surigao Del Norte State University.">
    <link rel="stylesheet" href="{{ asset('css/animations.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
    <title>ConsultEase - Faculty Consultation System</title>
</head>
<body>
    <section class="hero-section">
        <nav class="top-nav">
            <div class="nav-brand">
                <span class="edoc-logo">ConsultEase</span>
                <span class="edoc-logo-sub">Surigao Del Norte State University</span>
            </div>
            <div class="nav-links">
                <a href="{{ route('login') }}" class="non-style-link"><span class="nav-item">Login</span></a>
                <a href="{{ route('signup') }}" class="non-style-link"><span class="nav-item nav-item-register">Register</span></a>
            </div>
        </nav>

        <div class="hero-content">
            <span class="hero-badge">Smart faculty scheduling for SNSU</span>
            <h1 class="heading-text">Book faculty consultations without the hassle.</h1>
            <p class="sub-text2">
                Schedule consultation sessions online, avoid long lines, and keep everyone aligned with clear booking records,
                timely updates, and a smoother appointment experience.
            </p>
            <div class="hero-actions">
                <a href="{{ route('login') }}" class="btn btn-primary hero-btn non-style-link">Make Appointment</a>
                <a href="#features" class="hero-btn-outline non-style-link">Learn More</a>
            </div>
        </div>

        <div class="hero-scroll-hint">
            <span>Scroll to explore</span>
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <section class="features-section" id="features">
        <div class="section-container">
            <h2 class="section-title">Why Use ConsultEase?</h2>
            <p class="section-subtitle">A cleaner way to manage consultations between students and faculty.</p>

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
                    <p class="feature-desc">Browse available slots and reserve a consultation session in just a few steps.</p>
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
                    <p class="feature-desc">Find faculty members by name or subject and review available sessions quickly.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <h3 class="feature-title">Real-Time Updates</h3>
                    <p class="feature-desc">Stay informed with booking confirmations, schedule changes, and reminders.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="steps-section">
        <div class="section-container">
            <h2 class="section-title">How It Works</h2>
            <p class="section-subtitle">Three clear steps to your next consultation.</p>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Create an Account</h3>
                    <p class="step-desc">Sign up as a student or faculty member using your university details.</p>
                </div>
                <div class="step-connector"></div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Book a Session</h3>
                    <p class="step-desc">Pick an available schedule and reserve the time that works best for you.</p>
                </div>
                <div class="step-connector"></div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Consult With Confidence</h3>
                    <p class="step-desc">Arrive prepared, track your appointments, and stay aligned with faculty expectations.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="section-container cta-inner">
            <h2 class="cta-heading">Ready to get started?</h2>
            <p class="cta-text">Join ConsultEase today and make consultation scheduling easier for everyone.</p>
            <a href="{{ route('signup') }}" class="btn btn-primary hero-btn non-style-link">Register Now</a>
        </div>
    </section>

    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-brand">
                <span class="footer-logo">ConsultEase</span>
                <span class="footer-tagline">Surigao Del Norte State University</span>
            </div>
            <div class="footer-copy">
                <p>&copy; 2026 ConsultEase. A web solution by Tannybot.</p>
            </div>
        </div>
    </footer>
</body>
</html>
