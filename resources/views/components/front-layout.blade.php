<!DOCTYPE html>
<html class="light" lang="{{ str_replace('_', '-', app()->getLocale()) }}" style="scroll-behavior: smooth;">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'UKM Seni & Budaya Universitas Pakuan' }}</title>
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <!-- Atau jika favicon berupa PNG: <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}"> -->
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Libre+Caslon+Text:ital,wght@0,400;0,700;1,400&family=Manrope:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-background text-on-background font-body-md selection:bg-secondary-container selection:text-on-secondary-container">
    
    <!-- Top Navbar -->
    @include('components.front.navbar')

    <main>
        {{ $slot }}
    </main>

    <!-- Footer -->
    @include('components.front.footer')

    <!-- Scroll Animation Script -->
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const observerOptions = {
                threshold: 0.1
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('opacity-100', 'translate-y-0');
                        entry.target.classList.remove('opacity-0', 'translate-y-10');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('section').forEach(section => {
                section.classList.add('transition-all', 'duration-1000', 'opacity-0', 'translate-y-10');
                observer.observe(section);
            });

            // Instant opacity for the hero if exists
            const firstSection = document.querySelector('section');
            if(firstSection) {
                firstSection.classList.remove('opacity-0', 'translate-y-10');
                firstSection.classList.add('opacity-100', 'translate-y-0');
            }
        });
    </script>
</body>
</html>
