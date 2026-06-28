@php
    $contact = \App\Models\ContactSetting::first();
    $profile = \App\Models\CompanyProfile::first();
@endphp
<footer class="bg-primary w-full py-20 text-on-primary">
    <div class="grid grid-cols-1 md:grid-cols-4 gap-gutter max-w-max-width mx-auto px-margin-desktop text-left">
        <div class="col-span-1 md:col-span-2 space-y-8">
            <div class="h-20 w-auto mb-8 flex items-center">
                <img src="{{ asset('assets/logo.webp') }}" alt="UKM Seni Budaya Logo" class="h-full w-auto object-contain">
                <div class="ml-4 flex flex-col justify-center font-headline-md text-gold uppercase tracking-wider leading-tight">
                    <span class="text-sm">UKM SENI</span>
                    <span class="text-sm">& BUDAYA</span>
                </div>
            </div>
            <p class="font-body-md text-on-primary-container max-w-md">
                Universitas Pakuan. Merawat Jejak, Menciptakan Karya. Wadah bagi mahasiswa untuk mengeksplorasi, melestarikan, dan menciptakan identitas budaya yang dinamis.
            </p>
            <div class="flex space-x-6">
                @if($contact && $contact->instagram_url)
                    <a href="{{ $contact->instagram_url }}" target="_blank" class="hover:text-gold transition-colors"><span class="material-symbols-outlined">camera</span></a>
                @endif
                @if($contact && $contact->youtube_url)
                    <a href="{{ $contact->youtube_url }}" target="_blank" class="hover:text-gold transition-colors"><span class="material-symbols-outlined">play_circle</span></a>
                @endif
                @if($contact && $contact->tiktok_url)
                    <a href="{{ $contact->tiktok_url }}" target="_blank" class="hover:text-gold transition-colors"><span class="material-symbols-outlined">language</span></a>
                @endif
            </div>
        </div>
        <div>
            <h5 class="font-label-lg text-gold uppercase mb-8">Navigasi</h5>
            <ul class="space-y-4 font-body-md text-on-primary-container">
                <li><a class="hover:text-white transition-colors" href="{{ route('home') }}">Beranda</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('about') }}">Tentang Kami</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('artworks.index') }}">Galeri Karya</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('archives.index') }}">Arsip Digital</a></li>
                <li><a class="hover:text-white transition-colors" href="{{ route('cultures.index') }}">Jurnal Budaya</a></li>
            </ul>
        </div>
        <div>
            <h5 class="font-label-lg text-gold uppercase mb-8">Kontak</h5>
            <ul class="space-y-4 font-body-md text-on-primary-container">
                <li class="flex items-start">
                    <span class="material-symbols-outlined mr-3 text-gold">location_on</span>
                    <span>{{ $contact->address ?? 'Sekretariat UKM, Gedung Ormawa Lt. 2, Universitas Pakuan, Bogor.' }}</span>
                </li>
                <li class="flex items-center">
                    <span class="material-symbols-outlined mr-3 text-gold">mail</span>
                    <span>{{ $contact->email ?? 'senibudaya@unpak.ac.id' }}</span>
                </li>
            </ul>
        </div>
    </div>
    <div class="max-w-max-width mx-auto px-margin-desktop mt-20 pt-8 border-t border-white/10">
        <div class="flex flex-col md:flex-row justify-between items-center text-sm text-on-primary-container/60">
            <p>© {{ date('Y') }} UKM Seni dan Budaya Universitas Pakuan. Seluruh Hak Cipta Dilindungi.</p>
            <div class="flex space-x-8 mt-4 md:mt-0">
                <a class="hover:text-white" href="#">Kebijakan Privasi</a>
                <a class="hover:text-white" href="#">Ketentuan Layanan</a>
            </div>
        </div>
    </div>
</footer>
