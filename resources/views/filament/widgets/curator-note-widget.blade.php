<x-filament-widgets::widget>
    <x-filament::section>
        <div class="flex items-start gap-x-4" x-data="{ show: false }" x-init="setTimeout(() => show = true, 200)">
            <div class="flex-shrink-0 w-12 h-12 bg-gradient-to-br from-primary-500 to-primary-700 rounded-xl flex items-center justify-center shadow-lg"
                 x-show="show"
                 x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 scale-50 rotate-12"
                 x-transition:enter-end="opacity-100 scale-100 rotate-0">
                <x-heroicon-o-sparkles class="w-6 h-6 text-white" />
            </div>

            <div class="flex-1" x-show="show"
                 x-transition:enter="transition ease-out duration-500 delay-150"
                 x-transition:enter-start="opacity-0 translate-x-4"
                 x-transition:enter-end="opacity-100 translate-x-0">
                <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                    👋 Selamat Datang, {{ auth()->user()?->name ?? 'Admin' }}!
                </h2>

                <p class="text-sm text-gray-500 dark:text-gray-400 mt-2 leading-relaxed">
                    Dashboard ini menampilkan ringkasan data UKM Seni & Budaya secara <strong>real-time</strong>. 
                    Pastikan seluruh karya, arsip, dan artikel yang diunggah telah melalui proses kurasi. 
                    Data di bawah akan diperbarui otomatis setiap beberapa detik.
                </p>

                <div class="flex items-center gap-2 mt-3">
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                        <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5 animate-pulse"></span>
                        Live Dashboard
                    </span>
                    <span class="text-xs text-gray-400 dark:text-gray-500">
                        Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
