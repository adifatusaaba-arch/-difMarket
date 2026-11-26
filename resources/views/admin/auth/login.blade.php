<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login Admin - @difMarket</title>
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
<body class="min-h-screen bg-[#F8F9FC] text-[#20243A] flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <x-brand-logo size="lg" />
            </a>
            <p class="mt-3 text-sm text-[#5D647D]">Masuk ke Panel Pengelolaan Marketplace UMKM</p>
        </div>

        <div class="bg-white rounded-3xl border border-slate-200/80 p-8 shadow-lg shadow-purple-900/5">
            <h1 class="text-2xl font-extrabold text-[#20243A]">Login Administrator</h1>
            <p class="mt-1 text-sm text-[#5D647D] mb-6">Gunakan akun admin yang terdaftar untuk mengelola produk & kategori.</p>

            <x-flash-alert />

            <form method="POST" action="{{ route('admin.login.submit') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-bold text-[#20243A] mb-1.5">Email Admin</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="admin@difmarket.id"
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                        required
                        autofocus
                    >
                    @error('email')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-[#20243A] mb-1.5">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password"
                        class="w-full px-4 py-3 rounded-xl border {{ $errors->has('password') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                        required
                    >
                    @error('password')
                        <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center justify-between">
                    <label class="inline-flex items-center gap-2 text-xs font-medium text-[#5D647D] cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded border-slate-300 text-[#6C4AB6] focus:ring-[#6C4AB6]">
                        Ingat saya
                    </label>
                    <a href="{{ route('home') }}" class="text-xs font-bold text-[#6C4AB6] hover:underline">
                        &larr; Kembali ke Beranda
                    </a>
                </div>

                <button type="submit" class="w-full py-3.5 rounded-2xl text-sm font-bold dif-btn-primary cursor-pointer">
                    Masuk ke Dashboard
                </button>
            </form>
        </div>
    </div>
</body>
</html>
