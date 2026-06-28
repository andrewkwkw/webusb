<x-front-layout>
    <x-front.page-header 
        title="Telusur Budaya" 
        pageName="Budaya"
        subtitle="Merekam jejak tradisi, komunitas, dan liputan budaya Nusantara."
    />

    <section class="py-24 bg-white">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @forelse($cultures as $culture)
                    <x-front.card-article :article="$culture" type="culture" />
                @empty
                    <div class="col-span-full text-center text-on-surface-variant italic py-20">
                        Belum ada artikel budaya.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $cultures->links() }}
            </div>
        </div>
    </section>
</x-front-layout>
