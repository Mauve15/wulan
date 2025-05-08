<x-filament::page>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <x-filament::card>
            <p class="text-lg font-bold">Total Pembelian</p>
            <p>{{ \App\Models\Pembelian::count() }}</p>
        </x-filament::card>

        <x-filament::card>
            <p class="text-lg font-bold">Total Barang</p>
            <p>{{ \App\Models\Barang::count() }}</p>
        </x-filament::card>

        <x-filament::card>
            <p class="text-lg font-bold">Total Kategori</p>
            <p>{{ \App\Models\Category::count() }}</p>
        </x-filament::card>
    </div>
</x-filament::page>
