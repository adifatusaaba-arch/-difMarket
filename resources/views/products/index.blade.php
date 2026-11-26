@extends('layouts.app')

@section('title', 'Katalog Produk UMKM - @difMarket')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="max-w-2xl">
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#6C4AB6]">Katalog Resmi</span>
                <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-[#20243A]">Jelajahi Produk UMKM</h1>
                <p class="mt-2 text-sm sm:text-base text-[#5D647D]">
                    Cari dan saring produk unggulan berdasarkan kategori atau kata kunci sesuai kebutuhan Anda.
                </p>
            </div>

            {{-- Filter & Pencarian --}}
            <form action="{{ route('products.index') }}" method="GET" class="mt-8 grid grid-cols-1 md:grid-cols-12 gap-3">
                <div class="md:col-span-5 relative">
                    <span class="absolute inset-y-0 left-4 flex items-center text-slate-400 pointer-events-none">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                    </span>
                    <input
                        type="text"
                        name="q"
                        value="{{ $search }}"
                        placeholder="Cari nama produk atau deskripsi..."
                        class="w-full pl-11 pr-4 py-3 rounded-xl border border-slate-200 bg-[#F8F9FC] text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    >
                </div>

                <div class="md:col-span-3">
                    <select
                        name="kategori"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-[#F8F9FC] text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    >
                        <option value="">Semua Kategori</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}" @selected($categorySlug === $category->slug)>
                                {{ $category->name }} ({{ $category->products_count }})
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="md:col-span-2">
                    <select
                        name="urut"
                        class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-[#F8F9FC] text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    >
                        <option value="terbaru" @selected($sort === 'terbaru')>Terbaru</option>
                        <option value="termurah" @selected($sort === 'termurah')>Harga Termurah</option>
                        <option value="termahal" @selected($sort === 'termahal')>Harga Termahal</option>
                        <option value="nama" @selected($sort === 'nama')>Nama (A-Z)</option>
                    </select>
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button type="submit" class="flex-1 px-5 py-3 rounded-xl text-sm font-bold dif-btn-primary cursor-pointer">
                        Terapkan
                    </button>
                    @if ($search || $categorySlug || $sort !== 'terbaru')
                        <a href="{{ route('products.index') }}" class="px-3.5 py-3 rounded-xl text-sm font-semibold border border-slate-200 text-[#5D647D] hover:bg-slate-100" title="Reset Filter">
                            Reset
                        </a>
                    @endif
                </div>
            </form>

            {{-- Quick Category Chips --}}
            <div class="mt-5 flex flex-wrap gap-2">
                <a
                    href="{{ route('products.index', array_filter(['q' => $search, 'urut' => $sort !== 'terbaru' ? $sort : null])) }}"
                    class="px-4 py-1.5 rounded-full text-xs font-bold transition-colors {{ ! $categorySlug ? 'bg-[#6C4AB6] text-white' : 'bg-[#F3EEFF] text-[#6C4AB6] hover:bg-[#6C4AB6] hover:text-white' }}"
                >
                    Semua
                </a>
                @foreach ($categories as $category)
                    <a
                        href="{{ route('products.index', array_filter(['kategori' => $category->slug, 'q' => $search, 'urut' => $sort !== 'terbaru' ? $sort : null])) }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-colors {{ $categorySlug === $category->slug ? 'bg-[#6C4AB6] text-white' : 'bg-slate-100 text-[#5D647D] hover:bg-[#F3EEFF] hover:text-[#6C4AB6]' }}"
                    >
                        {{ $category->name }}
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="mb-6 flex items-center justify-between text-sm text-[#5D647D]">
            <p>
                Menampilkan <span class="font-bold text-[#20243A]">{{ $products->total() }}</span> produk
                @if ($activeCategory)
                    dalam kategori <span class="font-bold text-[#6C4AB6]">{{ $activeCategory->name }}</span>
                @endif
                @if ($search)
                    untuk kata kunci "<span class="font-bold text-[#20243A]">{{ $search }}</span>"
                @endif
            </p>
        </div>

        @if ($products->isEmpty())
            <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center">
                <div class="w-16 h-16 mx-auto rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] flex items-center justify-center">
                    <svg class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                </div>
                <h2 class="mt-4 text-lg font-bold text-[#20243A]">Produk Tidak Ditemukan</h2>
                <p class="mt-1 text-sm text-[#5D647D]">Coba ubah kata kunci pencarian atau pilih kategori lainnya.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center px-6 py-3 rounded-xl text-sm font-bold dif-btn-primary">
                    Lihat Semua Produk
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>

            <div class="mt-10">
                {{ $products->links() }}
            </div>
        @endif
    </section>
@endsection
