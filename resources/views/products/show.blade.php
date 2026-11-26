@extends('layouts.app')

@section('title', $product->name . ' - @difMarket')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
        {{-- Breadcrumb --}}
        <nav class="mb-6 flex items-center gap-2 text-xs sm:text-sm text-[#5D647D]" aria-label="Breadcrumb">
            <a href="{{ route('home') }}" class="hover:text-[#6C4AB6]">Beranda</a>
            <span>/</span>
            <a href="{{ route('products.index') }}" class="hover:text-[#6C4AB6]">Produk</a>
            @if ($product->category)
                <span>/</span>
                <a href="{{ route('categories.show', $product->category->slug) }}" class="hover:text-[#6C4AB6]">{{ $product->category->name }}</a>
            @endif
            <span>/</span>
            <span class="font-semibold text-[#20243A] truncate">{{ $product->name }}</span>
        </nav>

        {{-- Detail Card --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 p-6 sm:p-10 shadow-sm">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
                <div class="lg:col-span-6">
                    <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-[#F3EEFF] border border-slate-100">
                        <img
                            src="{{ $product->image_url }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover"
                        >
                    </div>
                </div>

                <div class="lg:col-span-6 flex flex-col">
                    <div class="flex flex-wrap items-center gap-2.5">
                        @if ($product->category)
                            <a href="{{ route('categories.show', $product->category->slug) }}" class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold bg-[#F3EEFF] text-[#6C4AB6] hover:bg-[#6C4AB6] hover:text-white transition-colors">
                                {{ $product->category->name }}
                            </a>
                        @endif
                        <span class="inline-flex items-center px-3.5 py-1 rounded-full text-xs font-bold {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            {{ $product->stock > 0 ? 'Stok Tersedia: '.$product->stock.' unit' : 'Stok Habis' }}
                        </span>
                    </div>

                    <h1 class="mt-4 text-2xl sm:text-4xl font-extrabold text-[#20243A] leading-tight">
                        {{ $product->name }}
                    </h1>

                    <div class="mt-5 p-4 rounded-2xl bg-[#F8F9FC] border border-slate-100 inline-flex items-baseline gap-3">
                        <span class="text-xs font-bold uppercase tracking-wider text-[#5D647D]">Harga Produk</span>
                        <span class="text-3xl font-extrabold text-[#6C4AB6]">{{ $product->formatted_price }}</span>
                    </div>

                    <div class="mt-6">
                        <h2 class="text-sm font-bold uppercase tracking-wider text-[#20243A]">Deskripsi Produk</h2>
                        <div class="mt-2.5 text-sm sm:text-base text-[#5D647D] leading-relaxed whitespace-pre-line">
                            {{ $product->description }}
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap gap-3">
                        <a
                            href="{{ $product->whatsapp_url }}"
                            target="_blank"
                            rel="noopener"
                            class="inline-flex items-center justify-center gap-2.5 px-7 py-3.5 rounded-2xl text-sm font-bold bg-emerald-600 hover:bg-emerald-700 text-white shadow-sm transition-colors"
                        >
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                            Hubungi Penjual via WhatsApp
                        </a>

                        <a
                            href="{{ route('products.index') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 py-3.5 rounded-2xl text-sm font-bold border border-slate-200 text-[#20243A] hover:border-[#6C4AB6] hover:text-[#6C4AB6] transition-colors"
                        >
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="m12 19-7-7 7-7"/><path d="M19 12H5"/></svg>
                            Kembali ke Daftar Produk
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Produk Terkait --}}
        @if ($relatedProducts->isNotEmpty())
            <div class="mt-16">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A]">Produk Serupa Lainnya</h2>
                    @if ($product->category)
                        <a href="{{ route('categories.show', $product->category->slug) }}" class="text-sm font-bold text-[#6C4AB6] hover:underline">
                            Lihat Kategori &rarr;
                        </a>
                    @endif
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $related)
                        <x-product-card :product="$related" />
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
