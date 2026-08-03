<x-front-layout>
    <x-front.page-header 
        title="{{ $setting->title ?? 'Open Recruitment' }}" 
        pageName="Oprec"
        subtitle="{!! strip_tags($setting->description ?? 'Bergabunglah bersama kami dan wujudkan potensimu dalam melestarikan budaya dan berkreasi tanpa batas.') !!}"
    />

    <section class="py-24 bg-surface">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            @if(isset($setting) && $setting->is_active)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
                    <!-- Brosur/Poster -->
                    <div class="bg-white p-4 shadow-[0_20px_40px_rgba(0,56,168,0.05)] rounded-2xl">
                        @if($setting->brochure_image)
                            <img src="{{ Storage::url($setting->brochure_image) }}" alt="Poster Oprec" class="w-full h-auto rounded-xl border border-gray-200">
                        @else
                            <div class="w-full h-auto rounded-xl bg-surface-variant flex items-center justify-center aspect-[3/4] border-2 border-dashed border-gray-300">
                                <span class="text-on-surface-variant/50 text-lg font-label-lg">Tempat Poster / Brosur Digital</span>
                            </div>
                            <p class="text-center text-sm text-on-surface-variant mt-4 italic">
                                *Gambar ilustrasi poster pendaftaran
                            </p>
                        @endif
                    </div>

                    <!-- Form -->
                    <div class="bg-white p-8 md:p-12 shadow-[0_20px_40px_rgba(0,56,168,0.05)] rounded-2xl border border-primary/5">
                        <h3 class="font-headline-lg text-primary text-3xl mb-2">Formulir Pendaftaran</h3>
                        <p class="text-on-surface-variant mb-8 font-body-md">Isi data diri Anda di bawah ini dengan benar dan lengkap.</p>

                        @if(session('success'))
                            <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded mb-6">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form action="{{ route('oprec.store') }}" method="POST" class="space-y-6">
                            @csrf
                            <div>
                                <label for="name" class="block font-label-lg text-primary mb-2">Nama Lengkap *</label>
                                <input type="text" name="name" id="name" required class="w-full border-b border-primary/20 bg-transparent py-2 focus:outline-none focus:border-primary transition-colors font-body-md text-on-background" placeholder="Masukkan nama lengkap Anda">
                            </div>
                            <div>
                                <label for="email" class="block font-label-lg text-primary mb-2">Email *</label>
                                <input type="email" name="email" id="email" required class="w-full border-b border-primary/20 bg-transparent py-2 focus:outline-none focus:border-primary transition-colors font-body-md text-on-background" placeholder="email@contoh.com">
                            </div>
                            <div>
                                <label for="phone" class="block font-label-lg text-primary mb-2">No. WhatsApp *</label>
                                <input type="text" name="phone" id="phone" required class="w-full border-b border-primary/20 bg-transparent py-2 focus:outline-none focus:border-primary transition-colors font-body-md text-on-background" placeholder="081234567890">
                            </div>
                            <div>
                                <label for="division" class="block font-label-lg text-primary mb-2">Pilihan Divisi/Departemen *</label>
                                <select name="division" id="division" required class="w-full border-b border-primary/20 bg-transparent py-2 focus:outline-none focus:border-primary transition-colors font-body-md text-on-background">
                                    <option value="">Pilih Divisi...</option>
                                    <option value="Seni Musik">Seni Musik</option>
                                    <option value="Seni Rupa">Seni Rupa</option>
                                    <option value="Seni Teater">Seni Teater</option>
                                    <option value="Fotografi">Fotografi</option>
                                    <option value="Videografi">Videografi</option>
                                </select>
                            </div>
                            <div>
                                <label for="portfolio_link" class="block font-label-lg text-primary mb-2">Link Portofolio (Opsional)</label>
                                <input type="url" name="portfolio_link" id="portfolio_link" class="w-full border-b border-primary/20 bg-transparent py-2 focus:outline-none focus:border-primary transition-colors font-body-md text-on-background" placeholder="https://link-portofolio-anda.com">
                            </div>
                            <div>
                                <label for="motivation" class="block font-label-lg text-primary mb-2">Motivasi Bergabung</label>
                                <textarea name="motivation" id="motivation" rows="3" class="w-full border-b border-primary/20 bg-transparent py-2 focus:outline-none focus:border-primary transition-colors font-body-md text-on-background resize-none" placeholder="Ceritakan motivasi Anda..."></textarea>
                            </div>

                            <button type="submit" class="w-full bg-primary text-white font-label-lg uppercase tracking-wider py-4 hover:bg-gold transition-colors btn-hover-effect">
                                Kirim Pendaftaran
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <div class="bg-white p-12 text-center shadow-[0_20px_40px_rgba(0,56,168,0.05)] rounded-2xl border border-primary/5 max-w-2xl mx-auto">
                    <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-6 text-primary">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="font-headline-lg text-primary text-3xl mb-4">Pendaftaran Ditutup</h3>
                    <p class="text-on-surface-variant mb-6 font-body-md text-lg">
                        Mohon maaf, kami belum membuka Open Recruitment Member USB saat ini.
                    </p>
                    
                    @if(isset($setting) && ($setting->start_date || $setting->end_date))
                        <div class="bg-surface-variant p-4 rounded-xl inline-block">
                            <p class="font-label-lg text-primary mb-1">Periode Pendaftaran:</p>
                            <p class="text-on-surface-variant font-body-md">
                                {{ $setting->start_date ? \Carbon\Carbon::parse($setting->start_date)->translatedFormat('d F Y') : '?' }} 
                                s/d 
                                {{ $setting->end_date ? \Carbon\Carbon::parse($setting->end_date)->translatedFormat('d F Y') : '?' }}
                            </p>
                        </div>
                    @endif
                </div>
            @endif
        </div>
    </section>
</x-front-layout>
