@props(['product'])

<article class="group bg-white rounded-2xl border border-slate-200/80 overflow-hidden flex flex-col dif-card-hover">
    <a href="{{ route('products.show', $product->slug) }}" class="relative block aspect-[4/3] overflow-hidden bg-[#F3EEFF]">
        <img
            src="{{ $product->image_url }}"
            alt="{{ $product->name }}"
            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
            loading="lazy"
        >
        @if($product->category)
            <span class="absolute top-3 left-3 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-white/95 text-[#6C4AB6] shadow-sm backdrop-blur">
                {{ $product->category->name }}
            </span>
        @endif
        <span class="absolute top-3 right-3 inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $product->stock > 0 ? 'bg-emerald-500/95 text-white' : 'bg-rose-500/95 text-white' }}">
            {{ $product->stock > 0 ? 'Stok '.$product->stock : 'Habis' }}
        </span>
    </a>

    <div class="p-5 flex-1 flex flex-col">
        <a href="{{ route('products.show', $product->slug) }}" class="block">
            <h3 class="text-base font-bold text-[#20243A] group-hover:text-[#6C4AB6] transition-colors line-clamp-2 leading-snug">
                {{ $product->name }}
            </h3>
        </a>

        <p class="mt-2 text-sm text-[#5D647D] line-clamp-2 leading-relaxed flex-1">
            {{ \Illuminate\Support\Str::limit($product->description, 95) }}
        </p>

        <div class="mt-5 pt-4 border-t border-slate-100 flex items-center justify-between gap-3">
            <div>
                <span class="block text-[11px] uppercase tracking-wider font-semibold text-slate-400">Harga</span>
                <span class="text-lg font-extrabold text-[#6C4AB6]">{{ $product->formatted_price }}</span>
            </div>

            <a
                href="{{ route('products.show', $product->slug) }}"
                class="inline-flex items-center gap-1.5 px-4 py-2.5 rounded-xl text-xs font-bold dif-btn-primary shrink-0"
            >
                Lihat Detail
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M5 12h14"/>
                    <path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
    </div>
</article>
