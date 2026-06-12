<x-app-layout :title="'Product'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-[20px]">
                @include('layouts.success-error-msg')
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Daftar Produk</h3>
                        <a href="{{ route('products.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Tambah Produk
                        </a>
                    </div>
                    <div class="mb-4">
                        <form action="{{ route('products.index') }}" method="GET" class="flex">
                            <input type="text" name="search" placeholder="Cari produk..." value="{{ request('search') }}" class="w-full px-3 py-2 border rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-r-md">
                                Cari
                            </button>
                        </form>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th class="px-6 py-3 font-semibold">ID</th>
                                    <th class="px-6 py-3 font-semibold">Nama</th>
                                    <th class="px-6 py-3 font-semibold">Slug</th>
                                    <th class="px-6 py-3 font-semibold">Deskripsi</th>
                                    <th class="px-6 py-3 font-semibold">Harga</th>
                                    <th class="px-6 py-3 font-semibold">Stok</th>
                                    <th class="px-6 py-3 font-semibold">Clicks</th>
                                    <th class="px-6 py-3 font-semibold">Gambar</th>
                                    <th class="px-6 py-3 font-semibold">Kategori</th>
                                    <th class="px-6 py-3 font-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                @foreach ($products as $product)
                                    <tr class="bg-white hover:bg-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 transition">
                                        <td class="px-6 py-4">{{ $product->id }}</td>
                                        <td class="px-6 py-4 font-medium">{{ $product->name }}</td>
                                        <td class="px-6 py-4">{{ $product->slug }}</td>
                                        <td class="px-6 py-4">{{ Str::limit($product->description, 50) }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $product->stock }}</td>
                                        <td class="px-6 py-4">{{ $product->clicks }}</td>
                                        <td class="px-6 py-4">
                                            @if ($product->image)
                                                <img src="{{ asset('images/' . $product->image) }}" alt="{{ $product->name }}" class="w-12 h-12 object-cover rounded">
                                            @else
                                                <span class="text-gray-400">N/A</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">{{ $product->product_category ? $product->product_category->name : 'Tidak ada kategori' }}</td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2 whitespace-nowrap">
                                                <a href="{{ route('product.detail', $product->slug) }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white text-xs py-1.5 px-3 rounded transition">Lihat</a>
                                                <a href="{{ route('products.edit', $product->id) }}" class="inline-block bg-yellow-600 hover:bg-yellow-700 text-white text-xs py-1.5 px-3 rounded transition">Edit</a>
                                                <form action="{{ route('products.destroy', $product->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk dengan ID {{ $product->id }}?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs py-1.5 px-3 rounded transition">Hapus</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="my-4 mx-7">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>