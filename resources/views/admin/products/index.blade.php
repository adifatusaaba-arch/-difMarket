@extends('layouts.admin')

@section('title', 'Kelola Produk')
@section('page_title', 'Daftar Produk UMKM')
@section('page_subtitle', 'Tambah, ubah, dan hapus produk yang tampil di @difMarket')

@section('content')
    <div class="bg-white rounded-2xl border border-slate-200/80 p-5 mb-6 shadow-xs">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <form action="{{ route('admin.products.index') }}" method="GET" class="flex-1 grid grid-cols-1 sm:grid-cols-12 gap-3">
                <div class="sm:col-span-6">
                    <input
                        type="text"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Cari nama produk..."
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-[#F8F9FC] text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    >
                </div>
                <div class="sm:col-span-4">
                    <select
                        name="kategori"
                        class="w-full px-4 py-2.5 rounded-xl border border-slate-200 bg-[#F8F9FC] text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" @selected($categorySlug === $category->slug)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="sm:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 px-4 py-2.5 rounded-xl text-sm font-bold dif-btn-primary cursor-pointer">Filter</button>
                </div>
            </form>

            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold dif-btn-accent shrink-0">
                + Tambah Produk
            </a>
        </div>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F8F9FC] text-xs uppercase tracking-wider text-[#5D647D]">
                    <tr>
                        <th class="px-6 py-4 font-bold">Produk</th>
                        <th class="px-6 py-4 font-bold">Kategori</th>
                        <th class="px-6 py-4 font-bold">Harga</th>
                        <th class="px-6 py-4 font-bold">Stok</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3.5">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-14 h-12 rounded-xl object-cover bg-[#F3EEFF] shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-bold text-[#20243A] truncate">{{ $product->name }}</p>
                                        <p class="text-xs text-[#5D647D] truncate max-w-xs">{{ $product->slug }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-[#F3EEFF] text-[#6C4AB6]">
                                    {{ $product->category?->name ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-bold text-[#20243A]">{{ $product->formatted_price }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                    {{ $product->stock }} unit
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('products.show', $product->slug) }}" target="_blank" class="px-3 py-1.5 rounded-lg text-xs font-bold border border-slate-200 text-[#5D647D] hover:text-[#6C4AB6] hover:border-[#6C4AB6]">
                                        Lihat
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#F3EEFF] text-[#6C4AB6] hover:bg-[#6C4AB6] hover:text-white transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk &quot;{{ $product->name }}&quot;?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-rose-50 text-rose-600 hover:bg-rose-600 hover:text-white transition-colors cursor-pointer">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-[#5D647D]">
                                Belum ada produk yang sesuai filter.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $products->links() }}
            </div>
        @endif
    </div>
@endsection
