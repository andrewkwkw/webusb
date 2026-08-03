<x-front-layout>
    <x-front.page-header 
        title="Tentang Kami" 
        pageName="Tentang"
        subtitle="Mengenal lebih dekat perjalanan, filosofi, dan visi misi UKM Seni & Budaya Universitas Pakuan."
    />

    <section class="py-24 bg-white">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            @if($profile)
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-16">
                    <div class="space-y-16">
                        <div>
                            <x-front.section-title title="Sejarah" />
                            <div class="prose prose-lg max-w-none text-on-surface-variant font-body-md mt-8">
                                {!! $profile->history !!}
                            </div>
                        </div>

                        <div>
                            <x-front.section-title title="Visi & Misi" />
                            <div class="prose prose-lg max-w-none text-on-surface-variant font-body-md mt-8">
                                {!! $profile->vision_mission !!}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-16">
                        <div>
                            <x-front.section-title title="Filosofi Logo" />
                            <div class="prose prose-lg max-w-none text-on-surface-variant font-body-md mt-8">
                                {!! $profile->logo_philosophy !!}
                            </div>
                        </div>

                        <div>
                            <x-front.section-title title="Departemen / Divisi" />
                            <div class="prose prose-lg max-w-none text-on-surface-variant font-body-md mt-8">
                                {!! $profile->departments !!}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-24">
                    <x-front.section-title title="Struktur Kepengurusan" />
                    
                    @if($profile->organization_structure_image)
                        <div class="mt-8 mb-12 text-center">
                            <img src="{{ Storage::url($profile->organization_structure_image) }}" alt="Bagan Struktur Organisasi" class="max-w-full h-auto mx-auto rounded-xl shadow-[0_10px_30px_rgba(0,56,168,0.1)] border border-primary/5">
                        </div>
                    @endif
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-8 mt-12">
                            @forelse($members as $member)
                                <div class="text-center group">
                                    <div class="w-32 h-32 mx-auto rounded-full overflow-hidden bg-surface-variant mb-4 border-2 border-transparent group-hover:border-gold transition-colors">
                                        @if($member->image_path)
                                            <img src="{{ Storage::url($member->image_path) }}" alt="{{ $member->name }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center">
                                                <span class="material-symbols-outlined text-4xl text-on-surface-variant/50">person</span>
                                            </div>
                                        @endif
                                    </div>
                                    <h4 class="font-label-lg font-bold text-primary">{{ $member->name }}</h4>
                                    <p class="text-sm text-gold font-semibold uppercase tracking-wider mt-1">{{ $member->position }}</p>
                                    @if($member->department)
                                        <p class="text-xs text-on-surface-variant mt-1">{{ $member->department }}</p>
                                    @endif
                                </div>
                            @empty
                                <p class="col-span-full text-center text-on-surface-variant italic">Struktur kepengurusan belum ditambahkan.</p>
                            @endforelse
                        </div>
                    </div>

                    <!-- CTA Oprec -->
                    <div class="mt-32 bg-surface p-10 md:p-16 rounded-3xl text-center shadow-[0_20px_40px_rgba(0,56,168,0.05)] border border-primary/5 relative overflow-hidden">
                        <!-- Decorative background -->
                        <div class="absolute top-0 right-0 w-64 h-64 bg-gold/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 w-64 h-64 bg-primary/5 rounded-full blur-3xl translate-y-1/2 -translate-x-1/2"></div>
                        
                        <div class="relative z-10">
                            <h3 class="font-headline-md text-primary text-3xl md:text-4xl mb-4">Tertarik menjadi bagian dari kami?</h3>
                            <p class="text-on-surface-variant font-body-md text-lg mb-8 max-w-2xl mx-auto">
                                Pendaftaran sedang dibuka! Bergabunglah bersama kami untuk mengembangkan bakat, menjalin relasi, dan berkontribusi nyata melestarikan seni dan budaya.
                            </p>
                            <a href="{{ route('oprec.index') }}" class="inline-block bg-primary text-white font-label-lg uppercase tracking-wider px-10 py-4 hover:bg-gold transition-colors btn-hover-effect rounded-sm shadow-md">
                                Daftar UKM Seni dan Budaya
                            </a>
                        </div>
                    </div>

            @else
                <div class="text-center py-20 text-on-surface-variant italic">
                    Profil organisasi belum diisi oleh Administrator.
                </div>
            @endif
        </div>
    </section>
</x-front-layout>
