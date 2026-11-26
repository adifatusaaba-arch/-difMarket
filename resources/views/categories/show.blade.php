@extends('layouts.app')

@section('title', $category->name . ' - Kategori @difMarket')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div class="flex items-start gap-4">
                    <div class="w-14 h-14 rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] flex items-center justify-center shrink-0">
                        <x-category-icon :slug="$category->slug" />
                    </div>
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-[#FF9F43]">Kategori UMKM</span>
                        <h1 class="mt-1 text-3xl sm:text-4xl font-extrabold text-[#20243A]">{{ $category->name }}</h1>
                        @if ($category->description)
                            <p class="mt-2 text-sm sm:text-base text-[#5D647D] max-w-2xl">{{ $category->description }}</p>
                        @endif
                    </div>
                </div>

                <a href="{{ route('categories.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-bold border border-slate-200 text-[#20243A] hover:border-[#6C4AB6] hover:text-[#6C4AB6] self-start">
                    &larr; Semua Kategori
                </a>
            </div>

            <div class="mt-7 flex flex-wrap gap-2">
                @foreach ($categories as $item)
                    <a
                        href="{{ route('categories.show', $item->slug) }}"
                        class="px-4 py-1.5 rounded-full text-xs font-bold transition-colors {{ $item->id === $category->id ? 'bg-[#6C4AB6] text-white' : 'bg-slate-100 text-[#5D647D] hover:bg-[#F3EEFF] hover:text-[#6C4AB6]' }}"
                    >
                        {{ $item->name }} ({{ $item->products_count }})
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if ($products->isEmpty())
            <div class="bg-white rounded-3xl border border-slate-200 p-12 text-center">
                <h2 class="text-lg font-bold text-[#20243A]">Belum Ada Produk</h2>
                <p class="mt-1 text-sm text-[#5D647D]">Saat ini belum ada produk pada kategori {{ $category->name }}.</p>
                <a href="{{ route('products.index') }}" class="mt-6 inline-flex items-center px-6 py-3 rounded-xl text-sm font-bold dif-btn-primary">
                    Jelajahi Produk Lain
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
