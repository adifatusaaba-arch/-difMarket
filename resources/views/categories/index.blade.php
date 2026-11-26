@extends('layouts.app')

@section('title', 'Kategori Produk UMKM - @difMarket')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#6C4AB6]">Eksplorasi Kategori</span>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-[#20243A]">Kategori Produk UMKM</h1>
            <p class="mt-2 text-sm sm:text-base text-[#5D647D] max-w-2xl">
                Pilih kategori produk lokal favorit Anda untuk menemukan beragam karya terbaik dari pelaku UMKM Indonesia.
            </p>

            {{-- Kartu Ringkasan Kategori --}}
            <div class="mt-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4">
                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category->slug) }}" class="group rounded-2xl p-5 bg-[#F8F9FC] border border-slate-200/80 hover:bg-white dif-card-hover">
                        <div class="w-12 h-12 rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] group-hover:bg-[#6C4AB6] group-hover:text-white transition-colors flex items-center justify-center">
                            <x-category-icon :slug="$category->slug" />
                        </div>
                        <h2 class="mt-4 text-base font-bold text-[#20243A] group-hover:text-[#6C4AB6]">{{ $category->name }}</h2>
                        <p class="mt-1 text-xs font-semibold text-[#FF9F43]">{{ $category->products_count }} Produk Tersedia</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Daftar Produk per Kategori --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 space-y-14">
        @foreach ($categories as $category)
            <div>
                <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-3 mb-6">
                    <div class="flex items-center gap-3.5">
                        <div class="w-11 h-11 rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] flex items-center justify-center shrink-0">
                            <x-category-icon :slug="$category->slug" />
                        </div>
                        <div>
                            <h2 class="text-xl sm:text-2xl font-extrabold text-[#20243A]">{{ $category->name }}</h2>
                            @if ($category->description)
                                <p class="text-sm text-[#5D647D]">{{ $category->description }}</p>
                            @endif
                        </div>
                    </div>

                    <a href="{{ route('categories.show', $category->slug) }}" class="inline-flex items-center gap-1.5 text-sm font-bold text-[#6C4AB6] hover:underline shrink-0">
                        Lihat Semua ({{ $category->products_count }}) &rarr;
                    </a>
                </div>

                @if ($category->products->isEmpty())
                    <div class="bg-white rounded-2xl border border-slate-200 p-8 text-center text-sm text-[#5D647D]">
                        Belum ada produk dalam kategori ini.
                    </div>
                @else
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($category->products as $product)
                            @php $product->setRelation('category', $category); @endphp
                            <x-product-card :product="$product" />
                        @endforeach
                    </div>
                @endif
            </div>
        @endforeach
    </section>
@endsection
