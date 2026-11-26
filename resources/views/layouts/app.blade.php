<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', '@difMarket - Marketplace Produk UMKM Modern')</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="min-h-screen flex flex-col bg-[#F8F9FC] text-[#20243A]">
    {{-- Navbar Publik --}}
    <header class="sticky top-0 z-40 bg-white/95 backdrop-blur-md border-b border-slate-200/80 shadow-xs">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="h-18 flex items-center justify-between gap-4">
                <a href="{{ route('home') }}" class="shrink-0">
                    <x-brand-logo />
                </a>

                <nav class="hidden md:flex items-center gap-1" aria-label="Navigasi Utama">
                    @php
                        $navItems = [
                            ['route' => 'home', 'label' => 'Beranda', 'active' => request()->routeIs('home')],
                            ['route' => 'products.index', 'label' => 'Produk', 'active' => request()->routeIs('products.*')],
                            ['route' => 'categories.index', 'label' => 'Kategori', 'active' => request()->routeIs('categories.*')],
                            ['route' => 'about', 'label' => 'Tentang Kami', 'active' => request()->routeIs('about')],
                            ['route' => 'contact', 'label' => 'Kontak', 'active' => request()->routeIs('contact')],
                        ];
                    @endphp

                    @foreach ($navItems as $item)
                        <a
                            href="{{ route($item['route']) }}"
                            class="px-4 py-2 rounded-xl text-sm font-semibold transition-colors {{ $item['active'] ? 'bg-[#F3EEFF] text-[#6C4AB6]' : 'text-[#5D647D] hover:text-[#6C4AB6] hover:bg-slate-50' }}"
                        >
                            {{ $item['label'] }}
                        </a>
                    @endforeach
                </nav>

                <div class="hidden md:flex items-center gap-3">
                    <a
                        href="{{ route('products.index') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-semibold border border-slate-200 text-[#20243A] hover:border-[#6C4AB6] hover:text-[#6C4AB6] transition-colors"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><path d="m21 21-4.3-4.3"/></svg>
                        Cari Produk
                    </a>
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold dif-btn-primary">
                                Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('admin.login') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold dif-btn-accent">
                            Admin Login
                        </a>
                    @endauth
                </div>

                <button
                    type="button"
                    data-mobile-menu-toggle
                    aria-expanded="false"
                    aria-label="Buka menu navigasi"
                    class="md:hidden inline-flex items-center justify-center p-2.5 rounded-xl border border-slate-200 text-[#20243A] hover:bg-slate-50"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round">
                        <line x1="3" y1="6" x2="21" y2="6"/>
                        <line x1="3" y1="12" x2="21" y2="12"/>
                        <line x1="3" y1="18" x2="21" y2="18"/>
                    </svg>
                </button>
            </div>

            {{-- Mobile Drawer --}}
            <div data-mobile-menu class="hidden md:hidden pb-4 border-t border-slate-100 pt-3 space-y-1">
                @foreach ($navItems as $item)
                    <a
                        href="{{ route($item['route']) }}"
                        class="block px-4 py-2.5 rounded-xl text-sm font-semibold {{ $item['active'] ? 'bg-[#F3EEFF] text-[#6C4AB6]' : 'text-[#5D647D] hover:bg-slate-50' }}"
                    >
                        {{ $item['label'] }}
                    </a>
                @endforeach
                <div class="pt-2 flex flex-col gap-2">
                    @auth
                        @if(auth()->user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="text-center px-4 py-2.5 rounded-xl text-sm font-bold dif-btn-primary">
                                Dashboard Admin
                            </a>
                        @endif
                    @else
                        <a href="{{ route('admin.login') }}" class="text-center px-4 py-2.5 rounded-xl text-sm font-bold dif-btn-accent">
                            Admin Login
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    {{-- Konten Utama --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- Footer --}}
    <footer class="bg-[#20243A] text-slate-300 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <div class="lg:col-span-1">
                    <x-brand-logo dark />
                    <p class="mt-4 text-sm text-slate-400 leading-relaxed">
                        Platform marketplace UMKM modern yang mempertemukan produk lokal berkualitas dari seluruh Indonesia dengan pembeli secara langsung, cepat, dan terpercaya.
                    </p>
                    <div class="mt-5 flex items-center gap-3">
                        <a href="{{ config('difmarket.socials.instagram') }}" target="_blank" rel="noopener" aria-label="Instagram @difMarket" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#6C4AB6] text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><circle cx="12" cy="12" r="4"/><circle cx="17.5" cy="6.5" r="1"/></svg>
                        </a>
                        <a href="{{ config('difmarket.socials.facebook') }}" target="_blank" rel="noopener" aria-label="Facebook @difMarket" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#6C4AB6] text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </a>
                        <a href="{{ config('difmarket.socials.tiktok') }}" target="_blank" rel="noopener" aria-label="TikTok @difMarket" class="w-9 h-9 rounded-xl bg-white/10 hover:bg-[#6C4AB6] text-white flex items-center justify-center transition-colors">
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Navigasi</h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}" class="hover:text-[#FF9F43] transition-colors">Beranda</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-[#FF9F43] transition-colors">Katalog Produk</a></li>
                        <li><a href="{{ route('categories.index') }}" class="hover:text-[#FF9F43] transition-colors">Kategori UMKM</a></li>
                        <li><a href="{{ route('about') }}" class="hover:text-[#FF9F43] transition-colors">Tentang Kami</a></li>
                        <li><a href="{{ route('contact') }}" class="hover:text-[#FF9F43] transition-colors">Kontak Kami</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Informasi Usaha</h4>
                    <ul class="space-y-3 text-sm text-slate-400">
                        <li class="flex items-start gap-2.5">
                            <svg class="w-4 h-4 text-[#FF9F43] mt-0.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span>{{ config('difmarket.address') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#FF9F43] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                            <span>{{ config('difmarket.email') }}</span>
                        </li>
                        <li class="flex items-center gap-2.5">
                            <svg class="w-4 h-4 text-[#FF9F43] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                            <span>{{ config('difmarket.whatsapp_display') }}</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-white mb-4">Jam Operasional</h4>
                    <p class="text-sm text-slate-400">{{ config('difmarket.hours') }}</p>
                    <div class="mt-5 p-4 rounded-2xl bg-white/5 border border-white/10">
                        <p class="text-xs text-slate-300 font-semibold">Pelaku UMKM?</p>
                        <p class="mt-1 text-xs text-slate-400">Daftarkan produk unggulan Anda bersama @difMarket untuk menjangkau lebih banyak pembeli.</p>
                        <a href="{{ route('contact') }}" class="mt-3 inline-flex items-center gap-1.5 text-xs font-bold text-[#FF9F43] hover:underline">
                            Hubungi Tim Kami
                            <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-8 border-t border-white/10 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-slate-400">
                <p>&copy; {{ date('Y') }} @difMarket. Seluruh hak cipta dilindungi.</p>
                <p>Dibangun untuk mendukung pertumbuhan UMKM Lokal Indonesia.</p>
            </div>
        </div>
    </footer>
</body>
</html>
