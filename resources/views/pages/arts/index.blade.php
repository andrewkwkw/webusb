<x-front-layout>
    <x-front.page-header 
        title="Denyut Seni" 
        pageName="Seni"
        subtitle="Berita kampus, agenda seni, festival, dan pergerakan budaya terkini."
    />

    <section class="py-24 bg-white">
        <div class="max-w-max-width mx-auto px-margin-desktop">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-gutter">
                @forelse($news as $article)
                    <x-front.card-article :article="$article" type="news" />
                @empty
                    <div class="col-span-full text-center text-on-surface-variant italic py-20">
                        Belum ada berita seni.
                    </div>
                @endforelse
            </div>
            
            <div class="mt-16 flex justify-center">
                {{ $news->links() }}
            </div>
        </div>
    </section>
</x-front-layout>
