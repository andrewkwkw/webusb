<x-front-layout>
    <x-front.page-header 
        title="Galeri Karya" 
        pageName="Karya"
        subtitle="Eksplorasi mahakarya mahasiswa dalam bentuk Fotografi, Videografi, dan Dokumenter Visual."
    />

    <section class="py-24 bg-surface-container-low">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($artworks as $artwork)
                    <x-front.card-artwork :artwork="$artwork" />
                @empty
                    <div class="col-span-full text-center text-on-surface-variant italic py-20">
                        Belum ada karya yang diunggah.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $artworks->links() }}
            </div>
        </div>
    </section>
</x-front-layout>
