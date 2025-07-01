<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Interactive English Learning Media | EnglishGo</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> <!-- For social media icons -->
    <style>
        /* Adding a more modern and readable font */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;800&display=swap');

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #F7FAFC; /* A more neutral background */
        }

        /* Styling for Glassmorphism effect on Navbar */
        .navbar-glass {
            background-color: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .navbar-scrolled {
            background-color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        }

        /* Glow effect on feature cards on hover */
        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 25px -5px rgba(59, 130, 246, 0.2), 0 8px 10px -6px rgba(59, 130, 246, 0.2);
        }

        /* Class for animation on scroll */
        .animate-on-scroll {
            opacity: 0;
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }
        
        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: none;
        }

        .animate-slide-up { transform: translateY(50px); }
        .animate-slide-in-left { transform: translateX(-50px); }
        .animate-slide-in-right { transform: translateX(50px); }
        .animate-zoom-in { transform: scale(0.9); }

        /* Patterned background for CTA */
        .cta-bg {
            background-image: radial-gradient(#E0E7FF 1px, transparent 1px);
            background-size: 15px 15px;
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',   // Blue
                        secondary: '#F7FAFC', // Very light gray
                        accent: '#14B8A6',    // Teal (bluish-green) as an accent
                        darkblue: '#1E3A8A', // Dark blue for hover/text
                        darktext: '#1F2937',  // Dark text
                        lighttext: '#6B7280', // Lighter text
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-secondary text-darktext">

    <!-- Navbar -->
    <header id="navbar" class="navbar-glass sticky top-0 z-50 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-3xl font-extrabold text-primary">EnglishGo.</a>
            <nav class="hidden md:flex space-x-8 font-semibold items-center">
                <a href="#" class="hover:text-primary transition duration-300">Home</a>
                <a href="#features" class="hover:text-primary transition duration-300">Features</a>
                <a href="#about" class="hover:text-primary transition duration-300">About</a>
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="text-primary hover:text-darkblue transition duration-300">Log In</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-6 py-2 rounded-full font-bold hover:bg-darkblue transform hover:scale-105 transition-all duration-300 shadow-lg shadow-blue-500/30">Sign Up Free</a>
                @endif
            </nav>
            <button id="menuToggle" class="md:hidden text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white px-6 pb-4 space-y-2">
            <a href="#" class="block hover:text-primary py-2 font-semibold">Home</a>
            <a href="#features" class="block hover:text-primary py-2 font-semibold">Features</a>
            <a href="#about" class="block hover:text-primary py-2 font-semibold">About</a>
            @if (Route::has('login'))
            <div class="border-t pt-4 space-y-3">
                <a href="{{ route('login') }}" class="block text-center w-full bg-gray-100 text-primary px-5 py-2 rounded-full font-medium hover:bg-gray-200 transition">Log In</a>
                <a href="{{ route('register') }}" class="block text-center w-full bg-primary text-white px-5 py-2 rounded-full font-medium hover:bg-darkblue transition">Sign Up Free</a>
            </div>
            @endif
        </div>
    </header>

    <!-- Hero -->
    <section class="relative bg-white pt-24 pb-28 overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-10 items-center">
            <div class="text-center md:text-left">
                <h2 class="text-4xl md:text-6xl font-extrabold text-darktext mb-5 leading-tight animate-on-scroll" data-animation="animate-slide-in-left">
                    Master English <span class="text-primary">With Confidence.</span>
                </h2>
                <p class="text-lg text-lighttext mb-10 animate-on-scroll" data-animation="animate-slide-in-left" data-delay="150">
                   A learning platform designed to make you fluent in English through interactive materials and effective exercises.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center md:justify-start animate-on-scroll" data-animation="animate-slide-up" data-delay="300">
                    <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-4 rounded-full font-bold hover:bg-darkblue transform hover:scale-105 transition duration-300 shadow-xl shadow-blue-500/30">Start Learning for Free</a>
                    <a href="#features" class="bg-gray-200 text-darktext px-8 py-4 rounded-full font-bold hover:bg-gray-300 transition duration-300">View Features</a>
                </div>
            </div>
            <div class="relative animate-on-scroll" data-animation="animate-zoom-in">
                <!-- Illustration -->
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="absolute -top-10 -left-10 w-full h-full opacity-20 text-accent -z-10">
                  <path fill="currentColor" d="M47.3,-64.5C60.3,-53,69.2,-37.2,74.3,-20C79.4,-2.8,80.7,15.8,72.8,29.1C64.9,42.4,47.8,50.3,31.8,57.8C15.8,65.3,0.9,72.4,-14.7,71.1C-30.3,69.8,-46.5,59.9,-58.5,46.5C-70.4,33.1,-78.1,16.5,-77.8,0.2C-77.5,-16.2,-69.2,-32.3,-57.2,-44.7C-45.2,-57,-29.5,-65.6,-13.7,-68.8C2.1,-72,18.2,-69.6,29.9,-67.7C41.6,-65.9,47.3,-64.5,47.3,-64.5Z" transform="translate(100 100)" />
                </svg>
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/online-english-learning-5502251-4609395.png" alt="Learning English Online" class="w-full max-w-md mx-auto relative z-10">
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="features" class="py-24 bg-secondary">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-16">
                <h3 class="text-4xl font-bold text-darktext animate-on-scroll" data-animation="animate-slide-up">Our Featured Materials</h3>
                <p class="text-lighttext mt-3 text-lg animate-on-scroll" data-animation="animate-slide-up" data-delay="150">Everything you need in one platform.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg text-center transition-all duration-300 animate-on-scroll" data-animation="animate-zoom-in">
                    <div class="bg-gradient-to-br from-blue-400 to-primary text-white p-5 inline-block rounded-2xl mb-6 shadow-lg shadow-blue-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-darktext">Interactive Materials</h4>
                    <p class="text-lighttext">Videos, audio, and texts to practice *listening, reading, & speaking*.</p>
                </div>
                <!-- Card 2 -->
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg text-center transition-all duration-300 animate-on-scroll" data-animation="animate-zoom-in" data-delay="150">
                    <div class="bg-gradient-to-br from-teal-400 to-accent text-white p-5 inline-block rounded-2xl mb-6 shadow-lg shadow-teal-500/40">
                         <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-darktext">Exercises & Quizzes</h4>
                    <p class="text-lighttext">Test your understanding with challenging multiple-choice and essay questions.</p>
                </div>
                <!-- Card 3 -->
                <div class="feature-card bg-white p-8 rounded-xl shadow-lg text-center transition-all duration-300 animate-on-scroll" data-animation="animate-zoom-in" data-delay="300">
                    <div class="bg-gradient-to-br from-blue-400 to-primary text-white p-5 inline-block rounded-2xl mb-6 shadow-lg shadow-blue-500/40">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-darktext">Track Progress</h4>
                    <p class="text-lighttext">Monitor your learning progress and earn achievement certificates.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section id="about" class="py-24 bg-white">
        <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">
             <div class="animate-on-scroll" data-animation="animate-slide-in-left">
                <img src="https://cdni.iconscout.com/illustration/premium/thumb/business-team-working-on-project-5502253-4609397.png" alt="The EnglishGo Team" class="rounded-2xl shadow-xl w-full">
            </div>
            <div class="animate-on-scroll" data-animation="animate-slide-in-right">
                <h3 class="text-3xl md:text-4xl font-bold text-darktext mb-4">Our Mission Is Your Success</h3>
                <p class="text-lighttext text-lg leading-relaxed">
                    EnglishGo is designed to make it easy for anyone who wants to improve their English skills. With structured materials, smart technology, and flexible access, learning becomes more effective and enjoyable, anytime and anywhere. We believe everyone deserves to be fluent in English.
                </p>
            </div>
        </div>
    </section>

    <!-- Call to Action (CTA) -->
    <section class="py-24 cta-bg">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h3 class="text-4xl font-bold text-darktext mb-4 animate-on-scroll" data-animation="animate-zoom-in">Ready to Become Fluent in English?</h3>
            <p class="text-lighttext text-lg mb-8 animate-on-scroll" data-animation="animate-zoom-in" data-delay="150">Create a free account and access dozens of learning materials right now.</p>
            @if (Route::has('register'))
            <div class="animate-on-scroll" data-animation="animate-zoom-in" data-delay="300">
                <a href="{{ route('register') }}" class="inline-block bg-primary text-white px-10 py-4 rounded-full font-bold text-lg hover:bg-darkblue transform hover:scale-105 transition-all duration-300 shadow-xl shadow-blue-500/40">Sign Up Now, It's Free!</a>
            </div>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-darktext text-white">
        <div class="max-w-7xl mx-auto px-6 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                 <div class="col-span-1 md:col-span-2">
                    <h4 class="text-2xl font-bold mb-2">EnglishGo.</h4>
                    <p class="text-gray-400 max-w-sm">An interactive platform to help you achieve English fluency in a fun way.</p>
                 </div>
                 <div>
                    <h5 class="font-bold text-lg mb-4">Navigation</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white transition">Home</a></li>
                        <li><a href="#features" class="hover:text-white transition">Features</a></li>
                        <li><a href="#about" class="hover:text-white transition">About</a></li>
                    </ul>
                 </div>
                 <div>
                    <h5 class="font-bold text-lg mb-4">Follow Us</h5>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-facebook-f fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-instagram fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-twitter fa-lg"></i></a>
                        <a href="#" class="text-gray-400 hover:text-white transition"><i class="fab fa-youtube fa-lg"></i></a>
                    </div>
                 </div>
            </div>
            <div class="border-t border-gray-700 mt-10 pt-6 text-center text-gray-500">
                <p>© {{ date('Y') }} EnglishGo. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Mobile Menu Toggle
            const menuToggle = document.getElementById('menuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            menuToggle.addEventListener('click', () => {
                mobileMenu.classList.toggle('hidden');
            });

            // Navbar style on scroll
            const navbar = document.getElementById('navbar');
            window.addEventListener('scroll', () => {
                if (window.scrollY > 20) {
                    navbar.classList.add('navbar-scrolled');
                    navbar.classList.remove('navbar-glass');
                } else {
                    navbar.classList.remove('navbar-scrolled');
                    navbar.classList.add('navbar-glass');
                }
            });

            // Intersection Observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const delay = entry.target.getAttribute('data-delay');
                        setTimeout(() => {
                           entry.target.classList.add('is-visible');
                        }, delay ? parseInt(delay) : 0);
                        
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1
            });

            // Observe all elements with the .animate-on-scroll class
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                // Add initial animation class based on data-attribute
                const animationType = el.getAttribute('data-animation') || 'animate-slide-up';
                el.classList.add(animationType);
                observer.observe(el);
            });
        });
    </script>
</body>
</html>