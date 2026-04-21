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
        <div class="hero-orb hero-orb-one"></div>
        <div class="hero-orb hero-orb-two"></div>

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

        <div class="section-container hero-shell">
            <div class="hero-copy">
                <span class="hero-badge">Digital consultation experience for SNSU</span>
                <h1 class="heading-text">A calmer, cleaner way to book faculty consultations.</h1>
                <p class="sub-text2">
                    ConsultEase helps students, faculty, and administrators stay in sync with simple online booking,
                    structured schedules, and clear updates from the first request to the final meeting.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('login') }}" class="btn btn-primary hero-btn non-style-link">Make Appointment</a>
                    <a href="#features" class="hero-btn-outline non-style-link">See Features</a>
                </div>

                <div class="hero-proof">
                    <div class="proof-item">
                        <span class="proof-title">Smooth booking</span>
                        <span class="proof-text">Reserve consultation slots with less back-and-forth.</span>
                    </div>
                    <div class="proof-item">
                        <span class="proof-title">Aligned schedules</span>
                        <span class="proof-text">Keep students and faculty updated with a shared view.</span>
                    </div>
                    <div class="proof-item">
                        <span class="proof-title">Campus-ready flow</span>
                        <span class="proof-text">Designed for the daily rhythm of academic consultations.</span>
                    </div>
                </div>
            </div>

            <div class="hero-panel">
                <div class="panel-window">
                    <div class="panel-window-top">
                        <div class="panel-dots">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                        <span class="panel-label">Consultation Overview</span>
                    </div>

                    <div class="panel-window-body">
                        <div class="panel-chip-row">
                            <span class="panel-chip">Live schedules</span>
                            <span class="panel-chip">Appointment history</span>
                            <span class="panel-chip">Instant updates</span>
                        </div>

                        <div class="panel-highlight">
                            <span class="panel-highlight-label">Today at a glance</span>
                            <h2 class="panel-highlight-title">Everything needed for a confident consultation day.</h2>
                            <p class="panel-highlight-text">
                                View faculty availability, confirm appointments, and keep records tidy in one polished workflow.
                            </p>
                        </div>

                        <div class="panel-list">
                            <div class="panel-list-item">
                                <div class="panel-list-icon">01</div>
                                <div class="panel-list-copy">
                                    <span class="panel-list-title">Browse faculty availability</span>
                                    <span class="panel-list-text">Find consultation windows by instructor or subject.</span>
                                </div>
                            </div>
                            <div class="panel-list-item">
                                <div class="panel-list-icon">02</div>
                                <div class="panel-list-copy">
                                    <span class="panel-list-title">Book in a few steps</span>
                                    <span class="panel-list-text">Choose a suitable time and secure your appointment quickly.</span>
                                </div>
                            </div>
                            <div class="panel-list-item">
                                <div class="panel-list-icon">03</div>
                                <div class="panel-list-copy">
                                    <span class="panel-list-title">Receive timely reminders</span>
                                    <span class="panel-list-text">Stay aware of schedule changes and confirmations.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="hero-metrics">
                    <div class="metric-card">
                        <span class="metric-value">3 roles</span>
                        <span class="metric-label">Students, faculty, and admin in one flow</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-value">Clear records</span>
                        <span class="metric-label">Consultation details that stay easy to track</span>
                    </div>
                    <div class="metric-card">
                        <span class="metric-value">Less friction</span>
                        <span class="metric-label">A faster path from request to meeting</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="hero-scroll-hint">
            <span>Scroll to explore</span>
            <div class="scroll-arrow"></div>
        </div>
    </section>

    <section class="trust-section">
        <div class="section-container trust-grid">
            <div class="trust-card">
                <span class="trust-label">Centralized scheduling</span>
                <p>Faculty availability, student bookings, and updates stay organized in one place.</p>
            </div>
            <div class="trust-card">
                <span class="trust-label">Fewer missed details</span>
                <p>Consultation records and reminders help everyone arrive prepared and on time.</p>
            </div>
            <div class="trust-card">
                <span class="trust-label">Built for campus workflows</span>
                <p>Structured around the real scheduling needs of Surigao Del Norte State University.</p>
            </div>
        </div>
    </section>

    <section class="features-section" id="features">
        <div class="section-container">
            <div class="section-heading">
                <span class="section-kicker">Why teams choose ConsultEase</span>
                <h2 class="section-title">Sharper coordination, better appointment experiences.</h2>
                <p class="section-subtitle">
                    Every section of the system is designed to reduce noise and give each role a clearer view of what happens next.
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card feature-card-featured">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                            <line x1="16" y1="2" x2="16" y2="6"></line>
                            <line x1="8" y1="2" x2="8" y2="6"></line>
                            <line x1="3" y1="10" x2="21" y2="10"></line>
                        </svg>
                    </div>
                    <h3 class="feature-title">Easy Scheduling</h3>
                    <p class="feature-desc">Browse open consultation windows and secure a slot with a clean, straightforward booking flow.</p>
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
                    <p class="feature-desc">Find the right faculty member faster using organized listings and subject-aware availability.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                        </svg>
                    </div>
                    <h3 class="feature-title">Real-Time Updates</h3>
                    <p class="feature-desc">Keep everyone informed with confirmations, reminders, and important consultation changes.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9"></path>
                            <path d="M12 4h9"></path>
                            <path d="M4 9h16"></path>
                            <path d="M4 15h16"></path>
                        </svg>
                    </div>
                    <h3 class="feature-title">Organized Records</h3>
                    <p class="feature-desc">Keep appointment details readable and accessible for follow-ups, reviews, and daily management.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="steps-section">
        <div class="section-container steps-shell">
            <div class="steps-copy">
                <span class="section-kicker">How it works</span>
                <h2 class="section-title section-title-left">Three simple steps from signup to consultation.</h2>
                <p class="section-subtitle section-subtitle-left">
                    The flow stays intuitive for students while giving faculty and administrators the structure they need behind the scenes.
                </p>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h3 class="step-title">Create your account</h3>
                    <p class="step-desc">Register with your university information and access the role-based experience that fits you.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h3 class="step-title">Choose a consultation slot</h3>
                    <p class="step-desc">Review faculty schedules, select an available time, and confirm your appointment.</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h3 class="step-title">Stay ready and informed</h3>
                    <p class="step-desc">Track your bookings, receive updates, and arrive with all the details you need.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="cta-section">
        <div class="section-container cta-inner">
            <span class="section-kicker section-kicker-light">Start with a cleaner workflow</span>
            <h2 class="cta-heading">Make consultation scheduling feel effortless.</h2>
            <p class="cta-text">Join ConsultEase and give your campus a more polished, more dependable booking experience.</p>
            <div class="cta-actions">
                <a href="{{ route('signup') }}" class="btn btn-primary hero-btn non-style-link">Register Now</a>
                <a href="{{ route('login') }}" class="hero-btn-outline hero-btn-outline-light non-style-link">Login</a>
            </div>
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
