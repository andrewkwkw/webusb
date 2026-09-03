<x-front-layout>
    <x-slot name="title">Kesalahan Sistem - 500</x-slot>
    
    <div class="flex flex-col justify-center items-center" style="padding-top: 10rem; padding-bottom: 8rem; min-height: 70vh;">
        <div class="max-w-max-width mx-auto px-margin-mobile md:px-margin-desktop text-center animate-fade-in-up">
            <h1 class="font-display-lg text-primary mb-6 font-bold tracking-widest drop-shadow-sm" style="font-size: 8rem; line-height: 1;">500</h1>
            <div class="w-24 h-1 bg-gold mx-auto mb-10 rounded-full"></div>
            <h2 class="font-headline-md text-3xl md:text-4xl text-on-surface mb-6">Terjadi Kesalahan Sistem</h2>
            <p class="font-body-md text-on-surface-variant max-w-xl mx-auto mb-12 text-lg leading-relaxed">
                Maaf, server kami sedang mengalami gangguan. Silakan coba kembali beberapa saat lagi.
            </p>
            <a href="{{ route('home') }}" class="inline-flex items-center justify-center bg-primary text-on-primary px-8 py-4 rounded-lg font-label-lg uppercase tracking-widest hover:bg-gold hover:text-primary transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-1">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-front-layout>
