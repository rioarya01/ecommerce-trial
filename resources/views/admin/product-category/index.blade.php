<x-app-layout :title="'Product Category'">
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Category') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- Success and Error Messages --}}
        
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-[20px]">
                @include('layouts.success-error-msg')
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-medium">Daftar Kategori Produk</h3>
                        <x-primary-button
                            x-data=""
                            x-on:click.prevent="$dispatch('open-modal', 'create-new-category')"
                            >{{ __('Tambah Kategori') }}
                        </x-primary-button>
                    </div>
                    <table id="productCategoriesTable" class="display w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th class="px-6 py-3">ID</th>
                                <th class="px-6 py-3">Nama Kategori</th>
                                <th class="px-6 py-3">Slug</th>
                                <th class="px-6 py-3">Jumlah Produk</th>
                                <th class="px-6 py-3">Jumlah Stok</th>
                                <th class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($productCategories as $productCategory)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4">{{ $productCategory->id }}</td>
                                    <td class="px-6 py-4">{{ $productCategory->name }}</td>
                                    <td class="px-6 py-4">{{ $productCategory->slug }}</td>
                                    <td class="px-6 py-4">{{ $productCategory->products_count }}</td>
                                    <td class="px-6 py-4">{{ $productCategory->total_stock ?? 'produk belum tersedia' }}</td>
                                    <td class="px-6 py-4">
                                        <x-primary-button
                                            x-data=""
                                            x-on:click.prevent="$dispatch('open-modal', 'edit-category.{{ $productCategory->id }}')"
                                            >{{ __('Edit') }}
                                        </x-primary-button>
                                        <form action="{{ route('product-categories.destroy', $productCategory->id) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori dengan ID {{ $productCategory->id }}?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-red-600 transition hover:bg-red-900 text-white rounded-md px-3 py-1.5">Hapus</button>
                                        </form>
                                    </td>
                                </tr>

                                {{-- Modal Laravel Breeze (Edit Kategori) --}}
                                @push('scripts')
                                    <x-modal name="edit-category.{{ $productCategory->id }}" maxWidth="md" focusable>
                                        <form method="POST" action="{{ route('product-categories.update', $productCategory) }}" class="p-4 slug-group">
                                            @csrf
                                            @method('PUT')
                                            <h2 class="text-lg font-medium text-gray-900">
                                                Edit Kategori
                                            </h2>

                                            <div class="mt-4">
                                                <x-input-label for="name" value="{{ __('Nama Kategori') }}" />
                                                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full name-input" value="{{ old('name', $productCategory->name) }}" required />
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                            </div>
                                            <div class="mt-4">
                                                <x-input-label for="slug" value="{{ __('Slug Kategori (otomatis)') }}" />
                                                <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full border-slate-200 outline-none focus:outline-none focus:ring-0 focus:border-slate-200 slug-input" value="{{ old('slug', $productCategory->slug) }}" readonly />
                                                <x-input-error :messages="$errors->get('slug')" class="mt-2" />
                                            </div>
                                            <div class="mt-6 flex justify-end">
                                                <x-secondary-button x-on:click="$dispatch('close')">
                                                    {{ __('Batal') }}
                                                </x-secondary-button>
                                                <x-primary-button class="ms-3" type="submit">
                                                    {{ __('Simpan') }}
                                                </x-primary-button>
                                            </div>
                                        </form>
                                    </x-modal>
                                @endpush
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    @endpush

    @push('scripts')
        {{-- Modal Laravel Breeze (Tambah Kategori) --}}
        <x-modal name="create-new-category" maxWidth="md" focusable>
            <form method="POST" action="{{ route('product-categories.store') }}" class="p-6 slug-group">
                @csrf
                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Tambah Kategori Produk') }}
                </h2>
                <div class="mt-4">
                    <x-input-label for="name" value="{{ __('Nama Kategori') }}" />
                    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full name-input" value="{{ old('name') }}" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="mt-4">
                    <x-input-label for="slug" value="{{ __('Slug Kategori (otomatis)') }}" />
                    <x-text-input id="slug" name="slug" type="text" class="mt-1 block w-full border-slate-200 outline-none focus:outline-none focus:ring-0 focus:border-slate-200 slug-input" readonly/>
                </div>
                <div class="mt-4 flex justify-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Batal') }}
                    </x-secondary-button>
                    <x-primary-button class="ml-2">
                        {{ __('Simpan') }}
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#productCategoriesTable').DataTable();
            });
        </script>

        {{-- Slug Generator --}}
        <script>
            document.querySelectorAll('.slug-group').forEach(group => {
                const nameInput = group.querySelector('.name-input');
                const slugInput = group.querySelector('.slug-input');

                if (!nameInput || !slugInput) return;

                nameInput.addEventListener('input', function () {
                    let slug = this.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');

                    slugInput.value = slug;
                });
            });
        </script>
    @endpush
</x-app-layout>
