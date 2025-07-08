<?php include 'includes/header.php'; ?>

    <div class="hero animate">
        <h1>Welcome to <span class="brand">MetaTrack</span></h1>
        <p>Your personal companion in staying healthy and tracking your calories.</p>
    </div>

    <section class="features-section">

        <div class="features-header animate">
            <h2>Why Use MetaTrack?</h2>
            <p>Take control of your health with our all-in-one calorie and nutrition tracker designed to simplify your journey.</p>
        </div>

        <section class="how-it-works scroll-animate">
        <h2 class="section-title">How MetaTrack Works</h2>

        <div class="how-steps">
            <div class="step-card">
                <img src="assets/images/icons/signup.png" alt="Sign Up">
                <h3>1. Sign Up</h3>
                <p>Create your account and personalize your goals to begin tracking.</p>
            </div>

            <div class="step-card">
                <img src="assets/images/icons/logmeal.png" alt="Log Meals">
                <h3>2. Log Meals</h3>
                <p>Track your food intake anytime and get insights instantly.</p>
            </div>

            <div class="step-card">
                <img src="assets/images/icons/trackprogress.png" alt="Track Progress">
                <h3>3. Track Progress</h3>
                <p>Visualize your progress and stay motivated every step of the way.</p>
            </div>

        </div>
        </section>

        <div class="features-grid">
            <div class="feature-card scroll-animate">
                <img src="assets/images/slides/meal_logging.png" alt="Log Meals">
                <h3>Smart Meal Logging</h3>
                <p>Log meals quickly and get nutritional insights in seconds.</p>
            </div>

            <div class="feature-card scroll-animate">
                <img src="assets/images/slides/calorie_monitoring.png" alt="Track Calories">
                <h3>Calorie Monitoring</h3>
                <p>Keep tabs on your intake and stay within your daily targets.</p>
            </div>

            <div class="feature-card scroll-animate">
                <img src="assets/images/slides/progress_tracking.jpg" alt="Progress Tracking">
                <h3>Visual Progress</h3>
                <p>See your weight and health improvements over time.</p>
            </div>

            <div class="feature-card scroll-animate">
                <img src="assets/images/slides/goal_setting.png" alt="Set Goals">
                <h3>Goal Setting</h3>
                <p>Create achievable health targets and stay motivated.</p>
            </div>
        </div>

        <section class="testimonials-slider scroll-animate">
            <h2 class="testimonial-heading">
                See how MetaTrack is transforming lives
            </h2>

            <div class="testimonial-container">
                <button class="arrow left-arrow" onclick="changeTestimonial(-1)">&#10094;</button>

                <div class="testimonial-content fade" id="testimonialBox">
                <blockquote>
                    “MetaTrack made it easy for me to stay on track. I lost 8kg in 2 months!”
                    <br><span>- Igon D.</span>
                </blockquote>
                </div>

                <button class="arrow right-arrow" onclick="changeTestimonial(1)">&#10095;</button>
            </div>

        </section>


        <section class="cta-section scroll-animate">

            <div class="cta-card">
                <h2>Start your health journey today with <span class="brand">MetaTrack</span></h2>
                <p>Join thousands who are actively reaching their fitness goals.</p>
                <a href="register.php" class="cta-button-alt">Create Your Account</a>
            </div>

        </section>


    </section>

    <section class="faq-section animate">
        <h2>Frequently Asked Questions</h2>

        <div class="faq-container">

            <div class="faq-item">
                <button class="faq-question">
                    What is MetaTrack and how does it work?
                    <span class="arrow">&#9656;</span>
                </button>

                <div class="faq-answer">
                    <p>MetaTrack is a calorie and nutrition tracking platform that helps you log meals, monitor intake, set goals, and track progress, all from one simple dashboard.</p>
                </div>

            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Is MetaTrack free to use?
                    <span class="arrow">&#9656;</span>
                </button>

                <div class="faq-answer">
                    <p>Yes! MetaTrack is completely free to use for basic meal tracking and goal setting features.</p>
                </div>

            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Can I track my weight progress?
                    <span class="arrow">&#9656;</span>
                </button>

                <div class="faq-answer">
                    <p>Yes, you can track your weight changes over time and visualize your progress through charts and reports.</p>
                </div>

            </div>

            <div class="faq-item">
                <button class="faq-question">
                    Is my information safe?
                    <span class="arrow">&#9656;</span>
                </button>

                <div class="faq-answer">
                    <p>We take privacy seriously. Your information is securely stored and never shared without your consent.</p>
                </div>

            </div>
        </div>
    </section>

<?php include 'includes/footer.php'; ?>
