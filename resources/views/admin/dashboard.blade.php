@extends('layouts.admin')

@section('title', 'Dashboard Admin')
@section('page_title', 'Dashboard Statistik')
@section('page_subtitle', 'Ringkasan data produk, kategori, stok, dan pesan masuk @difMarket')

@section('content')
    {{-- Kartu Statistik --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5">
        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-[#5D647D]">Total Produk</span>
                <div class="w-10 h-10 rounded-xl bg-[#F3EEFF] text-[#6C4AB6] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/></svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $stats['total_products'] }}</p>
            <a href="{{ route('admin.products.index') }}" class="mt-2 inline-block text-xs font-bold text-[#6C4AB6] hover:underline">Kelola Produk &rarr;</a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-[#5D647D]">Total Kategori</span>
                <div class="w-10 h-10 rounded-xl bg-[#FFF4E8] text-[#FF9F43] flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/></svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $stats['total_categories'] }}</p>
            <a href="{{ route('admin.categories.index') }}" class="mt-2 inline-block text-xs font-bold text-[#FF9F43] hover:underline">Kelola Kategori &rarr;</a>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-[#5D647D]">Total Stok Unit</span>
                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $stats['total_stock'] }}</p>
            <p class="mt-2 text-xs text-[#5D647D]">{{ $stats['low_stock_products'] }} produk stok &le; 10</p>
        </div>

        <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
            <div class="flex items-center justify-between">
                <span class="text-xs font-bold uppercase tracking-wider text-[#5D647D]">Pesan Kontak</span>
                <div class="w-10 h-10 rounded-xl bg-sky-50 text-sky-600 flex items-center justify-center">
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                </div>
            </div>
            <p class="mt-3 text-3xl font-extrabold text-[#20243A]">{{ $stats['total_messages'] }}</p>
            <p class="mt-2 text-xs text-[#5D647D]">Dari formulir kontak publik</p>
        </div>
    </div>

    {{-- Produk Terbaru & Ringkasan Kategori --}}
    <div class="mt-8 grid grid-cols-1 xl:grid-cols-12 gap-6">
        <div class="xl:col-span-8 bg-white rounded-2xl border border-slate-200/80 overflow-hidden shadow-xs">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h2 class="text-base font-extrabold text-[#20243A]">Daftar Produk Terbaru</h2>
                <a href="{{ route('admin.products.index') }}" class="text-xs font-bold text-[#6C4AB6] hover:underline">Lihat Semua</a>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead class="bg-[#F8F9FC] text-xs uppercase tracking-wider text-[#5D647D]">
                        <tr>
                            <th class="px-6 py-3.5 font-bold">Produk</th>
                            <th class="px-6 py-3.5 font-bold">Kategori</th>
                            <th class="px-6 py-3.5 font-bold">Harga</th>
                            <th class="px-6 py-3.5 font-bold">Stok</th>
                            <th class="px-6 py-3.5 font-bold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse ($recentProducts as $product)
                            <tr class="hover:bg-slate-50/70">
                                <td class="px-6 py-3.5">
                                    <div class="flex items-center gap-3">
                                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-11 h-11 rounded-xl object-cover bg-[#F3EEFF] shrink-0">
                                        <span class="font-bold text-[#20243A] line-clamp-1">{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-semibold bg-[#F3EEFF] text-[#6C4AB6]">
                                        {{ $product->category?->name ?? '-' }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 font-bold text-[#20243A]">{{ $product->formatted_price }}</td>
                                <td class="px-6 py-3.5">
                                    <span class="inline-flex px-2.5 py-1 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                        {{ $product->stock }}
                                    </span>
                                </td>
                                <td class="px-6 py-3.5 text-right">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-xs font-bold text-[#6C4AB6] hover:underline">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-[#5D647D]">Belum ada produk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="xl:col-span-4 space-y-6">
            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-base font-extrabold text-[#20243A]">Distribusi Kategori</h2>
                    <a href="{{ route('admin.categories.create') }}" class="text-xs font-bold text-[#6C4AB6] hover:underline">+ Kategori</a>
                </div>
                <div class="space-y-3">
                    @foreach ($categories as $category)
                        <div class="flex items-center justify-between p-3 rounded-xl bg-[#F8F9FC]">
                            <span class="text-sm font-semibold text-[#20243A]">{{ $category->name }}</span>
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold bg-[#F3EEFF] text-[#6C4AB6]">
                                {{ $category->products_count }} produk
                            </span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="bg-white rounded-2xl border border-slate-200/80 p-6 shadow-xs">
                <h2 class="text-base font-extrabold text-[#20243A] mb-4">Pesan Masuk Terbaru</h2>
                <div class="space-y-3">
                    @forelse ($recentMessages as $msg)
                        <div class="p-3.5 rounded-xl bg-[#F8F9FC] border border-slate-100">
                            <div class="flex items-center justify-between gap-2">
                                <p class="text-xs font-bold text-[#20243A]">{{ $msg->name }}</p>
                                <span class="text-[11px] text-slate-400">{{ $msg->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="mt-0.5 text-xs font-semibold text-[#6C4AB6]">{{ $msg->subject }}</p>
                            <p class="mt-1 text-xs text-[#5D647D] line-clamp-2">{{ $msg->message }}</p>
                        </div>
                    @empty
                        <p class="text-xs text-[#5D647D]">Belum ada pesan masuk dari pengunjung.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
@endsection
