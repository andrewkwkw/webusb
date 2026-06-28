<x-front-layout>
    <x-front.page-header 
        title="Tentang Kami" 
        pageName="Tentang"
        subtitle="Mengenal lebih dekat perjalanan, filosofi, dan visi misi UKM Seni & Budaya Universitas Pakuan."
    />

    <section class="py-24 bg-white">
        <div class="max-w-4xl mx-auto px-margin-desktop">
            @if($profile)
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
            @else
                <div class="text-center py-20 text-on-surface-variant italic">
                    Profil organisasi belum diisi oleh Administrator.
                </div>
            @endif
        </div>
    </section>
</x-front-layout>
