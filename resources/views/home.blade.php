@extends('layouts.app')

@section('title', '@difMarket - Marketplace Produk UMKM Lokal Modern')

@section('content')
    {{-- Hero Section --}}
    <section class="relative overflow-hidden bg-gradient-to-br from-[#6C4AB6] via-[#5B3CA1] to-[#20243A] text-white">
        <div class="absolute inset-0 pointer-events-none opacity-25">
            <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-[#FF9F43] blur-3xl"></div>
            <div class="absolute -bottom-24 -left-24 w-96 h-96 rounded-full bg-purple-300 blur-3xl"></div>
        </div>

        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
                <div class="lg:col-span-7">
                    <span class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-white/15 backdrop-blur text-xs font-bold tracking-wide text-[#FF9F43] border border-white/15">
                        <span class="w-2 h-2 rounded-full bg-[#FF9F43]"></span>
                        Marketplace Resmi Produk UMKM Indonesia
                    </span>

                    <h1 class="mt-6 text-3xl sm:text-5xl font-extrabold tracking-tight leading-tight">
                        Temukan Produk Terbaik Karya <span class="text-[#FF9F43]">UMKM Lokal</span> dalam Satu Platform
                    </h1>

                    <p class="mt-5 text-base sm:text-lg text-purple-100/90 leading-relaxed max-w-2xl">
                        @difMarket hadir untuk menghubungkan pelaku UMKM kreatif dengan masyarakat luas. Jelajahi kuliner autentik, batik modern, kriya tangan, kopi Nusantara, hingga produk herbal berkualitas dengan transaksi langsung yang praktis.
                    </p>

                    <div class="mt-8 flex flex-wrap items-center gap-4">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2.5 px-7 py-4 rounded-2xl text-sm sm:text-base font-bold dif-btn-accent shadow-lg">
                            Jelajahi Produk
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                        <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-6 py-4 rounded-2xl text-sm sm:text-base font-bold bg-white/10 hover:bg-white/20 text-white border border-white/20 transition-colors">
                            Lihat Kategori
                        </a>
                    </div>

                    <div class="mt-10 grid grid-cols-3 gap-4 max-w-lg pt-8 border-t border-white/15">
                        <div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-white">{{ $stats['products'] }}+</p>
                            <p class="text-xs sm:text-sm text-purple-200">Produk Terkurasi</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-[#FF9F43]">{{ $stats['categories'] }}</p>
                            <p class="text-xs sm:text-sm text-purple-200">Kategori UMKM</p>
                        </div>
                        <div>
                            <p class="text-2xl sm:text-3xl font-extrabold text-white">{{ $stats['total_stock'] }}+</p>
                            <p class="text-xs sm:text-sm text-purple-200">Stok Siap Kirim</p>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-5">
                    <div class="grid grid-cols-2 gap-4">
                        @foreach($featuredProducts->take(2) as $idx => $heroProduct)
                            <a href="{{ route('products.show', $heroProduct->slug) }}" class="group bg-white rounded-3xl p-3 text-[#20243A] shadow-xl dif-card-hover {{ $idx === 1 ? 'mt-6' : '' }}">
                                <div class="aspect-[4/3] rounded-2xl overflow-hidden bg-[#F3EEFF]">
                                    <img src="{{ $heroProduct->image_url }}" alt="{{ $heroProduct->name }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                </div>
                                <div class="p-2.5">
                                    <span class="text-[11px] font-bold text-[#6C4AB6]">{{ $heroProduct->category?->name }}</span>
                                    <h3 class="mt-0.5 text-sm font-bold line-clamp-1">{{ $heroProduct->name }}</h3>
                                    <p class="mt-1 text-sm font-extrabold text-[#FF9F43]">{{ $heroProduct->formatted_price }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Kategori Produk --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 sm:pt-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#6C4AB6]">Eksplorasi Kategori</span>
                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-[#20243A]">Kategori Produk UMKM</h2>
            </div>
            <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#6C4AB6] hover:text-[#58399B]">
                Semua Kategori
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
            @foreach ($categories as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="group bg-white rounded-2xl p-5 border border-slate-200/80 dif-card-hover flex flex-col justify-between">
                    <div>
                        <div class="w-12 h-12 rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] group-hover:bg-[#6C4AB6] group-hover:text-white transition-colors flex items-center justify-center">
                            <x-category-icon :slug="$category->slug" />
                        </div>
                        <h3 class="mt-4 text-base font-bold text-[#20243A] group-hover:text-[#6C4AB6] transition-colors">
                            {{ $category->name }}
                        </h3>
                        <p class="mt-1.5 text-xs text-[#5D647D] line-clamp-2 leading-relaxed">
                            {{ $category->description }}
                        </p>
                    </div>
                    <div class="mt-4 pt-3 border-t border-slate-100 flex items-center justify-between text-xs font-bold text-[#6C4AB6]">
                        <span>{{ $category->products_count }} Produk</span>
                        <span class="text-[#FF9F43] group-hover:translate-x-1 transition-transform">&rarr;</span>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Produk Unggulan --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 sm:pt-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#FF9F43]">Pilihan Terbaik</span>
                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-[#20243A]">Produk Unggulan</h2>
            </div>
            <a href="{{ route('products.index') }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#6C4AB6] hover:text-[#58399B]">
                Lihat Semua Produk
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>

        @if ($featuredProducts->isEmpty())
            <div class="bg-white rounded-2xl border border-slate-200 p-10 text-center text-[#5D647D]">
                Belum ada produk unggulan yang tersedia.
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredProducts as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @endif
    </section>

    {{-- Produk Terbaru --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 sm:pt-20">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-8">
            <div>
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#6C4AB6]">Baru Ditambahkan</span>
                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-[#20243A]">Produk Terbaru</h2>
            </div>
            <a href="{{ route('products.index', ['urut' => 'terbaru']) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#6C4AB6] hover:text-[#58399B]">
                Jelajahi Katalog Lengkap
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($latestProducts as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>
    </section>

    {{-- Keunggulan Berbelanja di @difMarket --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-16 sm:pt-24">
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-12 shadow-sm">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="inline-block px-3.5 py-1 rounded-full bg-[#F3EEFF] text-[#6C4AB6] text-xs font-bold uppercase tracking-wider">
                    Mengapa @difMarket?
                </span>
                <h2 class="mt-3 text-2xl sm:text-3xl font-extrabold text-[#20243A]">
                    Keunggulan Berbelanja di @difMarket
                </h2>
                <p class="mt-3 text-sm sm:text-base text-[#5D647D]">
                    Setiap pembelian Anda ikut menggerakkan roda ekonomi kreatif dan memberdayakan pelaku usaha mikro, kecil, dan menengah di Indonesia.
                </p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @php
                    $benefits = [
                        [
                            'title' => '100% Produk UMKM Asli',
                            'desc' => 'Seluruh produk dikurasi langsung dari pengrajin, petani kopi, dan pelaku kuliner lokal terpercaya.',
                            'color' => 'bg-[#F3EEFF] text-[#6C4AB6]',
                        ],
                        [
                            'title' => 'Komunikasi Langsung',
                            'desc' => 'Konsultasi stok, varian, dan pemesanan langsung terhubung ke penjual melalui WhatsApp secara cepat.',
                            'color' => 'bg-[#FFF4E8] text-[#FF9F43]',
                        ],
                        [
                            'title' => 'Harga Jujur & Transparan',
                            'desc' => 'Tanpa biaya tersembunyi, membantu pelaku UMKM mendapatkan margin adil dan pembeli memperoleh harga terbaik.',
                            'color' => 'bg-emerald-50 text-emerald-600',
                        ],
                        [
                            'title' => 'Dukung Ekonomi Lokal',
                            'desc' => 'Berkontribusi nyata memperluas pasar digital dan meningkatkan daya saing produk karya anak bangsa.',
                            'color' => 'bg-sky-50 text-sky-600',
                        ],
                    ];
                @endphp

                @foreach ($benefits as $index => $benefit)
                    <div class="rounded-2xl p-6 bg-[#F8F9FC] border border-slate-100">
                        <div class="w-11 h-11 rounded-2xl {{ $benefit['color'] }} font-extrabold text-base flex items-center justify-center">
                            0{{ $index + 1 }}
                        </div>
                        <h3 class="mt-4 text-base font-bold text-[#20243A]">{{ $benefit['title'] }}</h3>
                        <p class="mt-2 text-sm text-[#5D647D] leading-relaxed">{{ $benefit['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
