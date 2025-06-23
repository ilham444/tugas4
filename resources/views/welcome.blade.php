<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Media Pembelajaran Bahasa Inggris Interaktif</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Menambahkan font yang lebih modern dan enak dibaca */
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

        html {
            scroll-behavior: smooth;
            /* Efek scroll halus bawaan browser */
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        /* Kelas untuk animasi saat scroll */
        .animate-on-scroll {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.6s ease-out, transform 0.6s ease-out;
        }

        .animate-on-scroll.is-visible {
            opacity: 1;
            transform: translateY(0);
        }
    </style>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6', // Biru yang cerah
                        secondary: '#F0F9FF', // Biru yang sangat terang sebagai background
                        accent: '#1D4ED8', // Biru yang lebih gelap untuk hover/aksen
                        darktext: '#111827', // Teks gelap
                        lighttext: '#6B7280', // Teks lebih terang
                    },
                },
            },
        };
    </script>
</head>

<body class="bg-secondary text-darktext">

    <!-- Navbar -->
    <header class="bg-white text-darktext shadow-md sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="#" class="text-2xl font-bold text-primary">EnglishGo</a>
            <nav class="hidden md:flex space-x-8 font-semibold items-center">
                <a href="#" class="hover:text-primary transition duration-300">Beranda</a>
                <a href="#fitur" class="hover:text-primary transition duration-300">Fitur</a>
                <a href="#tentang" class="hover:text-primary transition duration-300">Tentang</a>
                @if (Route::has('login'))
                <a href="{{ route('login') }}" class="bg-primary text-white px-5 py-2 rounded-full font-medium hover:bg-accent transition duration-300">Masuk</a>
                <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-accent transform hover:scale-105 transition-all duration-300">Daftar Gratis</a>

                @endif
            </nav>
            <button id="menuToggle" class="md:hidden text-primary">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>
        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden px-6 pb-4 md:hidden space-y-2">
            <a href="#" class="block hover:text-primary py-2">Beranda</a>
            <a href="#fitur" class="block hover:text-primary py-2">Fitur</a>
            <a href="#tentang" class="block hover:text-primary py-2">Tentang</a>
            @if (Route::has('login'))
            <a href="{{ route('login') }}" class="block bg-primary text-white text-center mt-2 px-5 py-2 rounded-full font-medium hover:bg-accent transition">Masuk</a>

            @endif
        </div>
    </header>

    <!-- Hero -->
    <section class="bg-gradient-to-br from-primary to-accent text-white pt-20 pb-24 text-center">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-4xl md:text-5xl font-bold mb-4 animate-on-scroll">Kuasai Bahasa Inggris dengan Percaya Diri</h2>
            <p class="text-lg text-blue-100 mb-8 animate-on-scroll">Platform belajar yang dirancang untuk membuat Anda fasih berbahasa Inggris melalui materi interaktif dan latihan yang efektif.</p>
            <a href="#fitur" class="bg-white text-primary px-8 py-3 rounded-full font-bold hover:bg-blue-50 transform hover:scale-105 transition duration-300 animate-on-scroll">Mulai Belajar</a>
        </div>
    </section>

    <!-- Fitur -->
    <section id="fitur" class="py-20">
        <div class="max-w-6xl mx-auto px-6">
            <div class="text-center mb-12 animate-on-scroll">
                <h3 class="text-3xl font-bold text-darktext">Materi Unggulan Kami</h3>
                <p class="text-lighttext mt-2">Semua yang Anda butuhkan dalam satu platform.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-white p-8 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-on-scroll">
                    <div class="bg-blue-100 p-4 inline-block rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-darktext">Materi Interaktif</h4>
                    <p class="text-lighttext">Video, audio, dan teks untuk melatih *listening, reading, & speaking*.</p>
                </div>
                <!-- Card 2 -->
                <div class="bg-white p-8 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-on-scroll" style="transition-delay: 150ms;">
                    <div class="bg-blue-100 p-4 inline-block rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-darktext">Latihan & Kuis</h4>
                    <p class="text-lighttext">Uji pemahaman dengan soal pilihan ganda dan esai yang menantang.</p>
                </div>
                <!-- Card 3 -->
                <div class="bg-white p-8 rounded-xl shadow-lg text-center transform hover:scale-105 hover:shadow-2xl transition-all duration-300 animate-on-scroll" style="transition-delay: 300ms;">
                    <div class="bg-blue-100 p-4 inline-block rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-darktext">Lacak Kemajuan</h4>
                    <p class="text-lighttext">Pantau progres belajar Anda dan dapatkan sertifikat pencapaian.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Tentang -->
    <section id="tentang" class="py-20 bg-white">
        <div class="max-w-4xl mx-auto px-6 text-center animate-on-scroll">
            <h3 class="text-3xl font-bold text-darktext mb-4">Tentang Kami</h3>
            <p class="text-lighttext leading-relaxed">
                EnglishGo dirancang untuk memudahkan siapa saja yang ingin meningkatkan kemampuan berbahasa Inggris. Dengan materi terstruktur dan akses fleksibel, belajar menjadi lebih efektif dan menyenangkan, kapan pun dan di mana pun.
            </p>
        </div>
    </section>

    <!-- Call to Action (CTA) -->
    <section class="bg-secondary py-20">
        <div class="max-w-4xl mx-auto px-6 text-center animate-on-scroll">
            <h3 class="text-3xl font-bold text-darktext mb-4">Siap untuk Fasih Berbahasa Inggris?</h3>
            <p class="text-lighttext mb-8">Buat akun gratis dan akses puluhan materi pembelajaran sekarang juga.</p>
            @if (Route::has('register'))
            <a href="{{ route('register') }}" class="bg-primary text-white px-8 py-3 rounded-full font-bold hover:bg-accent transform hover:scale-105 transition-all duration-300">Daftar Gratis</a>
            @endif
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gradient-to-tr from-primary to-accent text-white text-center py-8">
        <p>© {{ date('Y') }} EnglishGo. All rights reserved.</p>
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

            // Intersection Observer for animations
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.1 // Elemen dianggap terlihat jika 10% areanya masuk viewport
            });

            // Observe all elements with the .animate-on-scroll class
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>

</html>