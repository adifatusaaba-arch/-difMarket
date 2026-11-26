<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard Admin') - @difMarket</title>
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
<body class="min-h-screen bg-[#F8F9FC] text-[#20243A]">
    <div class="min-h-screen flex">
        {{-- Mobile Backdrop --}}
        <div data-admin-backdrop class="fixed inset-0 bg-slate-900/50 z-40 hidden lg:hidden"></div>

        {{-- Sidebar Admin --}}
        <aside data-admin-sidebar class="fixed inset-y-0 left-0 z-50 w-72 bg-[#20243A] text-white flex flex-col transform -translate-x-full lg:translate-x-0 lg:static transition-transform duration-200 ease-in-out shrink-0">
            <div class="h-18 px-6 flex items-center border-b border-white/10">
                <a href="{{ route('admin.dashboard') }}">
                    <x-brand-logo dark />
                </a>
            </div>

            <div class="px-4 py-6 flex-1 space-y-1.5 overflow-y-auto">
                <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Menu Utama</p>

                <a
                    href="{{ route('admin.dashboard') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-[#6C4AB6] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="9" rx="1.5"/><rect x="14" y="3" width="7" height="5" rx="1.5"/><rect x="14" y="12" width="7" height="9" rx="1.5"/><rect x="3" y="16" width="7" height="5" rx="1.5"/></svg>
                    Dashboard
                </a>

                <a
                    href="{{ route('admin.products.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-[#6C4AB6] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m7.5 4.27 9 5.15"/><path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"/><path d="m3.3 7 8.7 5 8.7-5"/><path d="M12 22V12"/></svg>
                    Kelola Produk
                </a>

                <a
                    href="{{ route('admin.categories.index') }}"
                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-[#6C4AB6] text-white shadow-sm' : 'text-slate-300 hover:bg-white/10 hover:text-white' }}"
                >
                    <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 20h16a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.93a2 2 0 0 1-1.66-.9l-.82-1.2A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13c0 1.1.9 2 2 2Z"/></svg>
                    Kelola Kategori
                </a>

                <div class="pt-6 mt-6 border-t border-white/10">
                    <p class="px-3 text-[11px] font-bold uppercase tracking-wider text-slate-400 mb-2">Tautan</p>
                    <a
                        href="{{ route('home') }}"
                        class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-slate-300 hover:bg-white/10 hover:text-white transition-colors"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/><polyline points="15 3 21 3 21 9"/><line x1="10" y1="14" x2="21" y2="3"/></svg>
                        Lihat Halaman Publik
                    </a>
                </div>
            </div>

            <div class="p-4 border-t border-white/10">
                <div class="mb-3 px-3 py-2 rounded-xl bg-white/5">
                    <p class="text-xs font-bold text-white truncate">{{ auth()->user()->name }}</p>
                    <p class="text-[11px] text-slate-400 truncate">{{ auth()->user()->email }}</p>
                </div>
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button
                        type="submit"
                        class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl text-sm font-bold bg-rose-500/20 text-rose-200 hover:bg-rose-500 hover:text-white transition-colors cursor-pointer"
                    >
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Main Content --}}
        <div class="flex-1 flex flex-col min-w-0">
            <header class="h-18 bg-white border-b border-slate-200/80 px-4 sm:px-8 flex items-center justify-between gap-4 sticky top-0 z-30">
                <div class="flex items-center gap-3">
                    <button
                        type="button"
                        data-admin-sidebar-toggle
                        aria-label="Buka menu admin"
                        class="lg:hidden p-2 rounded-xl border border-slate-200 text-[#20243A] hover:bg-slate-50"
                    >
                        <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="3" y1="6" x2="21" y2="6"/><line x1="3" y1="12" x2="21" y2="12"/><line x1="3" y1="18" x2="21" y2="18"/></svg>
                    </button>
                    <div>
                        <h1 class="text-lg sm:text-xl font-extrabold text-[#20243A]">@yield('page_title', 'Dashboard Admin')</h1>
                        <p class="text-xs text-[#5D647D] hidden sm:block">@yield('page_subtitle', 'Kelola produk dan kategori UMKM @difMarket')</p>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl text-xs sm:text-sm font-bold dif-btn-primary">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"><path d="M12 5v14M5 12h14"/></svg>
                        <span class="hidden sm:inline">Tambah Produk</span>
                    </a>
                </div>
            </header>

            <main class="flex-1 p-4 sm:p-8 max-w-7xl w-full mx-auto">
                <x-flash-alert />
                @yield('content')
            </main>
        </div>
    </div>
</body>
</html>
