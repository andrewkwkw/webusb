<x-front-layout>
    <x-front.page-header 
        title="Tentang Kami" 
        pageName="Tentang"
        subtitle="Mengenal lebih dekat perjalanan, filosofi, dan visi misi UKM Seni & Budaya Universitas Pakuan."
    />

    <section class="py-24 bg-surface-container-low">
        <div class="max-w-max-width mx-auto px-margin-desktop space-y-20">
            @if($profile)
                
                <!-- Section 1: Sejarah & Filosofi Logo -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-stretch">
                    <!-- Sejarah (7 Kolom) -->
                    <div class="lg:col-span-7 bg-white p-8 md:p-12 rounded-3xl border border-surface-variant/30 shadow-sm flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-2 h-full bg-primary"></div>
                        <div>
                            <div class="flex items-center space-x-3 mb-4">
                                <span class="material-symbols-outlined text-gold text-2xl">history_edu</span>
                                <span class="text-xs font-bold uppercase tracking-widest text-gold">Jejak Langkah</span>
                            </div>
                            <h2 class="font-headline-md text-3xl text-primary font-bold mb-6">Sejarah Organisasi</h2>
                            <div class="rich-text font-body-md text-base leading-relaxed text-on-surface-variant">
                                {!! clean($profile->history) !!}
                            </div>
                        </div>
                    </div>

                    <!-- Filosofi Logo (5 Kolom) -->
                    <div class="lg:col-span-5 bg-gradient-to-br from-primary via-primary to-[#00174a] text-white p-8 md:p-12 rounded-3xl shadow-xl flex flex-col justify-between relative overflow-hidden">
                        <div class="absolute -right-12 -bottom-12 w-48 h-48 bg-gold/10 rounded-full blur-3xl"></div>
                        <div class="relative z-10">
                            <div class="flex items-center space-x-3 mb-4">
                                <span class="material-symbols-outlined text-gold text-2xl">auto_awesome</span>
                                <span class="text-xs font-bold uppercase tracking-widest text-gold">Makna Lambang</span>
                            </div>
                            <h2 class="font-headline-md text-3xl text-white font-bold mb-6">Filosofi Logo</h2>
                            <div class="rich-text text-white/90 font-body-md text-base leading-relaxed">
                                {!! clean($profile->logo_philosophy) !!}
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: Visi & Misi serta Departemen -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-stretch">
                    <!-- Visi & Misi Box -->
                    <div class="bg-white p-8 md:p-12 rounded-3xl border border-surface-variant/30 shadow-sm flex flex-col relative overflow-hidden">
                        <div class="flex items-center space-x-3 mb-4">
                            <span class="material-symbols-outlined text-gold text-2xl">flag</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-gold">Arah & Tujuan</span>
                        </div>
                        <h2 class="font-headline-md text-3xl text-primary font-bold mb-6">Visi & Misi</h2>
                        <div class="rich-text font-body-md text-base leading-relaxed text-on-surface-variant flex-1">
                            {!! clean($profile->vision_mission) !!}
                        </div>
                    </div>

                    <!-- Departemen / Divisi Box -->
                    <div class="bg-white p-8 md:p-12 rounded-3xl border border-surface-variant/30 shadow-sm flex flex-col relative overflow-hidden">
                        <div class="flex items-center space-x-3 mb-4">
                            <span class="material-symbols-outlined text-gold text-2xl">category</span>
                            <span class="text-xs font-bold uppercase tracking-widest text-gold">Fokus Kesenian</span>
                        </div>
                        <h2 class="font-headline-md text-3xl text-primary font-bold mb-6">Departemen / Divisi</h2>
                        <div class="rich-text font-body-md text-base leading-relaxed text-on-surface-variant flex-1">
                            {!! clean($profile->departments) !!}
                        </div>
                    </div>
                </div>

                <!-- Section 3: Struktur Kepengurusan -->
                <div class="pt-8">
                    <div class="text-center max-w-3xl mx-auto mb-14">
                        <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-gold/10 text-gold font-bold text-xs uppercase tracking-widest mb-4">
                            <span class="material-symbols-outlined text-base">groups</span>
                            Pilar Organisasi
                        </div>
                        <h2 class="font-headline-md text-3xl md:text-4xl text-primary font-bold mb-4">Struktur Kepengurusan</h2>
                        <p class="font-body-md text-on-surface-variant text-base">
                            Susunan kepengurusan UKM Seni & Budaya Universitas Pakuan yang berdedikasi menggerakkan ekosistem kreatif kampus.
                        </p>
                    </div>
                    
                    @if($profile->organization_structure_image)
                        <div class="mb-16 text-center max-w-4xl mx-auto">
                            <div class="bg-white p-4 md:p-6 rounded-3xl border border-surface-variant/30 shadow-lg overflow-hidden">
                                <img src="{{ Storage::url($profile->organization_structure_image) }}" 
                                     alt="Bagan Struktur Organisasi" 
                                     class="w-full h-auto rounded-2xl object-cover"
                                >
                            </div>
                        </div>
                    @endif

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-6 md:gap-8">
                        @forelse($members as $member)
                            <div class="bg-white p-6 rounded-2xl border border-surface-variant/20 shadow-sm hover:shadow-xl transition-all duration-300 text-center group flex flex-col items-center">
                                <div class="w-28 h-28 md:w-32 md:h-32 rounded-full overflow-hidden bg-surface-variant mb-4 border-2 border-transparent group-hover:border-gold transition-all duration-500 shadow-inner">
                                    @if($member->image_path)
                                        <img src="{{ Storage::url($member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-primary/5 text-primary/40">
                                            <span class="material-symbols-outlined text-4xl">person</span>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-label-lg font-bold text-primary text-base leading-snug group-hover:text-gold transition-colors">{{ $member->name }}</h4>
                                <span class="inline-block mt-2 px-3 py-0.5 rounded-full bg-gold/10 text-secondary text-xs font-bold uppercase tracking-wider">{{ $member->position }}</span>
                                @if($member->department)
                                    <p class="text-xs text-on-surface-variant/80 mt-1.5">{{ $member->department }}</p>
                                @endif
                            </div>
                        @empty
                            <div class="col-span-full text-center py-12 bg-white rounded-2xl text-on-surface-variant italic">
                                Struktur kepengurusan belum ditambahkan.
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- Section 4: Banner Ajakan Bergabung -->
                <div class="bg-gradient-to-r from-primary to-[#00174a] p-10 md:p-16 rounded-3xl text-center shadow-xl text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-80 h-80 bg-gold/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2 pointer-events-none"></div>
                    <div class="absolute bottom-0 left-0 w-80 h-80 bg-white/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2 pointer-events-none"></div>
                    
                    <div class="relative z-10 max-w-2xl mx-auto space-y-6">
                        <div class="inline-flex items-center gap-2 px-4 py-1 rounded-full bg-gold/20 text-gold font-bold text-xs uppercase tracking-widest">
                            <span class="material-symbols-outlined text-base">campaign</span>
                            Open Recruitment
                        </div>
                        <h3 class="font-headline-md text-white text-3xl md:text-4xl font-bold leading-tight">Tertarik menjadi bagian dari kami?</h3>
                        <p class="text-white/80 font-body-md text-base leading-relaxed">
                            Pendaftaran anggota baru sedang dibuka! Bergabunglah bersama keluarga besar UKM Seni & Budaya untuk mengembangkan bakat dan berkontribusi nyata melestarikan budaya nusantara.
                        </p>
                        <div class="pt-2">
                            <a href="{{ route('oprec.index') }}" class="inline-flex items-center px-10 py-4 bg-gold text-primary font-bold text-xs uppercase tracking-widest rounded-xl hover:bg-white transition-all shadow-lg hover:shadow-gold/30">
                                Daftar UKM Seni dan Budaya
                                <span class="material-symbols-outlined ml-2 text-base">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>

            @else
                <div class="text-center py-24 bg-white rounded-3xl border border-surface-variant/20 text-on-surface-variant italic">
                    Profil organisasi belum diisi oleh Administrator.
                </div>
            @endif
        </div>
    </section>
</x-front-layout>
