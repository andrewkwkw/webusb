<x-front-layout>
    <x-front.page-header 
        title="Arsip Digital" 
        pageName="Arsip"
        subtitle="Dokumentasi latihan rutin, workshop, dan event internal UKM Seni & Budaya."
    />

    <section class="py-24 bg-surface-container-low">
        <div class="max-w-4xl mx-auto px-margin-desktop">
            <div class="space-y-6">
                @forelse($archives as $archive)
                    <div class="bg-white p-6 rounded-lg border border-surface-variant/30 shadow-sm flex flex-col sm:flex-row sm:items-center justify-between">
                        <div>
                            <span class="inline-block px-3 py-1 bg-primary/10 text-primary rounded font-label-sm uppercase mb-2">{{ $archive->activity_type }}</span>
                            <h3 class="font-headline-md text-xl text-primary font-semibold">{{ $archive->title }}</h3>
                            <p class="font-body-md text-on-surface-variant mt-1">Tahun: {{ $archive->year }}</p>
                        </div>
                        <div class="mt-4 sm:mt-0">
                            @if($archive->document_path)
                                <a href="{{ Storage::url($archive->document_path) }}" target="_blank" class="px-6 py-2 bg-surface-variant text-primary rounded-lg font-label-sm hover:bg-gold transition-colors">
                                    Unduh Dokumen
                                </a>
                            @else
                                <span class="px-6 py-2 bg-surface-variant/50 text-on-surface-variant/50 rounded-lg font-label-sm">
                                    Tidak ada file
                                </span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center text-on-surface-variant italic py-20">
                        Belum ada data arsip digital.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $archives->links() }}
            </div>
        </div>
    </section>
</x-front-layout>
