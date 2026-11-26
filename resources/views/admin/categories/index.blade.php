@extends('layouts.admin')

@section('title', 'Kelola Kategori')
@section('page_title', 'Manajemen Kategori UMKM')
@section('page_subtitle', 'Kelola kategori produk yang tersedia di @difMarket')

@section('content')
    <div class="mb-6 flex items-center justify-between gap-4">
        <p class="text-sm text-[#5D647D]">Total <span class="font-bold text-[#20243A]">{{ $categories->total() }}</span> kategori terdaftar.</p>
        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold dif-btn-accent">
            + Tambah Kategori
        </a>
    </div>

    <div class="bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm">
                <thead class="bg-[#F8F9FC] text-xs uppercase tracking-wider text-[#5D647D]">
                    <tr>
                        <th class="px-6 py-4 font-bold">Nama Kategori</th>
                        <th class="px-6 py-4 font-bold">Slug</th>
                        <th class="px-6 py-4 font-bold">Deskripsi</th>
                        <th class="px-6 py-4 font-bold">Jumlah Produk</th>
                        <th class="px-6 py-4 font-bold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse ($categories as $category)
                        <tr class="hover:bg-slate-50/70">
                            <td class="px-6 py-4 font-bold text-[#20243A]">{{ $category->name }}</td>
                            <td class="px-6 py-4 text-xs text-[#5D647D] font-mono">{{ $category->slug }}</td>
                            <td class="px-6 py-4 text-xs text-[#5D647D] max-w-md">{{ \Illuminate\Support\Str::limit($category->description ?? '-', 80) }}</td>
                            <td class="px-6 py-4">
                                <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold bg-[#F3EEFF] text-[#6C4AB6]">
                                    {{ $category->products_count }} produk
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-1.5 rounded-lg text-xs font-bold bg-[#F3EEFF] text-[#6C4AB6] hover:bg-[#6C4AB6] hover:text-white transition-colors">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori &quot;{{ $category->name }}&quot;? Semua produk di kategori ini juga akan terhapus.');">
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
                            <td colspan="5" class="px-6 py-12 text-center text-[#5D647D]">Belum ada kategori.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($categories->hasPages())
            <div class="px-6 py-4 border-t border-slate-100">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
@endsection
