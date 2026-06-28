<x-front-layout>
    <x-front.page-header 
        title="Hubungi Kami" 
        pageName="Kontak"
        subtitle="Mari berkolaborasi, berdiskusi, dan merawat jejak bersama kami."
    />

    <section class="py-24 bg-surface-container-low">
        <div class="max-w-6xl mx-auto px-margin-desktop grid grid-cols-1 lg:grid-cols-2 gap-16">
            
            <!-- Contact Info -->
            <div class="space-y-12">
                <div>
                    <h2 class="font-headline-lg text-4xl text-primary mb-4">Mari Berbincang</h2>
                    <div class="h-1 w-20 bg-gold mb-6"></div>
                    <p class="font-body-lg text-on-surface-variant">
                        Punya pertanyaan, tawaran kolaborasi, atau sekadar ingin berbincang tentang seni dan budaya? Jangan ragu untuk menghubungi kami melalui form di samping atau melalui detail kontak di bawah ini.
                    </p>
                </div>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="bg-primary/10 p-4 rounded-full mr-6 text-primary">
                            <span class="material-symbols-outlined text-3xl">location_on</span>
                        </div>
                        <div>
                            <h4 class="font-label-lg uppercase tracking-wider text-primary mb-1">Sekretariat</h4>
                            <p class="font-body-md text-on-surface-variant">{{ $contact->address ?? 'Sekretariat UKM, Gedung Ormawa Lt. 2, Universitas Pakuan, Bogor.' }}</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="bg-primary/10 p-4 rounded-full mr-6 text-primary">
                            <span class="material-symbols-outlined text-3xl">mail</span>
                        </div>
                        <div>
                            <h4 class="font-label-lg uppercase tracking-wider text-primary mb-1">Email</h4>
                            <p class="font-body-md text-on-surface-variant">{{ $contact->email ?? 'senibudaya@unpak.ac.id' }}</p>
                        </div>
                    </div>
                </div>

                <div class="pt-8 border-t border-surface-variant/30">
                    <h4 class="font-label-lg uppercase tracking-wider text-primary mb-6">Ikuti Kami</h4>
                    <div class="flex space-x-4">
                        @if($contact && $contact->instagram_url)
                            <a href="{{ $contact->instagram_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary hover:bg-gold hover:text-white transition-colors shadow-sm">
                                <span class="material-symbols-outlined">camera</span>
                            </a>
                        @endif
                        @if($contact && $contact->youtube_url)
                            <a href="{{ $contact->youtube_url }}" target="_blank" class="w-12 h-12 bg-white rounded-full flex items-center justify-center text-primary hover:bg-gold hover:text-white transition-colors shadow-sm">
                                <span class="material-symbols-outlined">play_circle</span>
                            </a>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Contact Form (Not Functional for Slicing, But HTML Ready) -->
            <div class="bg-white p-10 rounded-2xl border border-surface-variant/30 shadow-lg">
                <h3 class="font-headline-md text-2xl text-primary mb-8">Kirim Pesan</h3>
                
                @if(session('success'))
                    <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                        <span class="block sm:inline">{{ session('success') }}</span>
                    </div>
                @endif

                <form action="{{ route('contact.send') }}" method="POST" class="space-y-6">
                    @csrf
                    <div>
                        <label class="block font-label-sm text-on-surface-variant uppercase mb-2" for="name">Nama Lengkap</label>
                        <input type="text" id="name" name="name" required class="w-full px-4 py-3 rounded-lg border border-surface-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="Masukkan nama Anda">
                    </div>
                    <div>
                        <label class="block font-label-sm text-on-surface-variant uppercase mb-2" for="email">Alamat Email</label>
                        <input type="email" id="email" name="email" required class="w-full px-4 py-3 rounded-lg border border-surface-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="email@contoh.com">
                    </div>
                    <div>
                        <label class="block font-label-sm text-on-surface-variant uppercase mb-2" for="subject">Subjek</label>
                        <input type="text" id="subject" name="subject" required class="w-full px-4 py-3 rounded-lg border border-surface-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="Perihal pesan">
                    </div>
                    <div>
                        <label class="block font-label-sm text-on-surface-variant uppercase mb-2" for="message">Pesan</label>
                        <textarea id="message" name="message" required rows="5" class="w-full px-4 py-3 rounded-lg border border-surface-variant/50 focus:border-primary focus:ring-1 focus:ring-primary outline-none transition-colors" placeholder="Tulis pesan Anda di sini..."></textarea>
                    </div>
                    <button type="submit" class="w-full bg-primary text-on-primary py-4 rounded-lg font-label-lg uppercase tracking-widest hover:bg-gold hover:text-primary transition-colors duration-300">
                        Kirim Sekarang
                    </button>
                </form>
            </div>
            
        </div>
    </section>
</x-front-layout>
