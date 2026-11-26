@extends('layouts.app')

@section('title', 'Tentang Kami - @difMarket')

@section('content')
    <section class="bg-gradient-to-br from-[#6C4AB6] to-[#20243A] text-white py-16 sm:py-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <span class="inline-block px-3.5 py-1 rounded-full bg-white/15 text-[#FF9F43] text-xs font-bold uppercase tracking-wider">
                Profil Usaha @difMarket
            </span>
            <h1 class="mt-4 text-3xl sm:text-5xl font-extrabold leading-tight max-w-3xl">
                Memajukan UMKM Indonesia Melalui Etalase Digital Modern
            </h1>
            <p class="mt-4 text-base sm:text-lg text-purple-100/90 max-w-2xl leading-relaxed">
                @difMarket adalah platform marketplace UMKM yang dirancang untuk memudahkan masyarakat menemukan, mengenal, dan membeli produk-produk kreatif karya pelaku usaha lokal secara aman, cepat, dan transparan.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-12">
        {{-- Visi & Misi --}}
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] flex items-center justify-center font-extrabold text-lg">
                    V
                </div>
                <h2 class="mt-5 text-2xl font-extrabold text-[#20243A]">Visi @difMarket</h2>
                <p class="mt-3 text-[#5D647D] leading-relaxed">
                    Menjadi marketplace UMKM digital terpercaya di Indonesia yang mampu mengangkat produk lokal ke panggung yang lebih luas dengan tampilan modern, mudah diakses, dan berdaya saing tinggi.
                </p>
            </div>

            <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-sm">
                <div class="w-12 h-12 rounded-2xl bg-[#FFF4E8] text-[#FF9F43] flex items-center justify-center font-extrabold text-lg">
                    M
                </div>
                <h2 class="mt-5 text-2xl font-extrabold text-[#20243A]">Misi @difMarket</h2>
                <ul class="mt-3 space-y-2.5 text-sm sm:text-base text-[#5D647D]">
                    <li class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#6C4AB6] mt-2 shrink-0"></span>
                        <span>Menyediakan katalog online yang rapi, responsif, dan profesional bagi produk UMKM.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#6C4AB6] mt-2 shrink-0"></span>
                        <span>Mempermudah interaksi langsung antara pembeli dan pelaku UMKM melalui kanal komunikasi cepat.</span>
                    </li>
                    <li class="flex items-start gap-2.5">
                        <span class="w-2 h-2 rounded-full bg-[#6C4AB6] mt-2 shrink-0"></span>
                        <span>Mendorong transformasi digital pelaku usaha mikro, kecil, dan menengah agar naik kelas.</span>
                    </li>
                </ul>
            </div>
        </div>

        {{-- Tujuan & Manfaat untuk UMKM --}}
        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 sm:p-10 shadow-sm">
            <div class="max-w-2xl">
                <span class="text-xs font-extrabold uppercase tracking-widest text-[#6C4AB6]">Dampak Nyata</span>
                <h2 class="mt-1 text-2xl sm:text-3xl font-extrabold text-[#20243A]">Tujuan & Manfaat Marketplace untuk UMKM</h2>
                <p class="mt-2 text-sm sm:text-base text-[#5D647D]">
                    @difMarket dibangun sebagai jembatan digital yang memberikan nilai tambah bagi penjual UMKM sekaligus pengalaman belanja menyenangkan bagi pembeli.
                </p>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="p-6 rounded-2xl bg-[#F8F9FC] border border-slate-100">
                    <h3 class="text-base font-bold text-[#20243A]">Jangkauan Pasar Lebih Luas</h3>
                    <p class="mt-2 text-sm text-[#5D647D] leading-relaxed">
                        Produk UMKM tidak lagi terbatas pada pembeli sekitar lokasi usaha, melainkan dapat ditemukan kapan saja secara online.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-[#F8F9FC] border border-slate-100">
                    <h3 class="text-base font-bold text-[#20243A]">Citra Brand Lebih Profesional</h3>
                    <p class="mt-2 text-sm text-[#5D647D] leading-relaxed">
                        Penyajian foto produk, harga transparan, dan deskripsi lengkap meningkatkan kepercayaan calon pelanggan.
                    </p>
                </div>
                <div class="p-6 rounded-2xl bg-[#F8F9FC] border border-slate-100">
                    <h3 class="text-base font-bold text-[#20243A]">Pengelolaan Data Terstruktur</h3>
                    <p class="mt-2 text-sm text-[#5D647D] leading-relaxed">
                        Dengan dashboard admin terintegrasi, stok, kategori, dan katalog produk dapat diperbarui secara real-time.
                    </p>
                </div>
            </div>

            <div class="mt-8 pt-8 border-t border-slate-100 flex flex-wrap items-center justify-between gap-6">
                <div class="flex flex-wrap gap-8">
                    <div>
                        <p class="text-2xl font-extrabold text-[#6C4AB6]">{{ $stats['products'] }}</p>
                        <p class="text-xs font-semibold text-[#5D647D]">Produk Aktif</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-[#FF9F43]">{{ $stats['categories'] }}</p>
                        <p class="text-xs font-semibold text-[#5D647D]">Kategori UMKM</p>
                    </div>
                    <div>
                        <p class="text-2xl font-extrabold text-[#20243A]">{{ $stats['total_stock'] }}</p>
                        <p class="text-xs font-semibold text-[#5D647D]">Total Unit Tersedia</p>
                    </div>
                </div>

                <a href="{{ route('products.index') }}" class="inline-flex items-center gap-2 px-6 py-3 rounded-xl text-sm font-bold dif-btn-primary">
                    Jelajahi Katalog Produk &rarr;
                </a>
            </div>
        </div>
    </section>
@endsection
