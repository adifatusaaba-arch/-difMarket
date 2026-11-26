@extends('layouts.app')

@section('title', 'Kontak Kami - @difMarket')

@section('content')
    <section class="bg-white border-b border-slate-200/80">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10 sm:py-14">
            <span class="text-xs font-extrabold uppercase tracking-widest text-[#6C4AB6]">Hubungi @difMarket</span>
            <h1 class="mt-2 text-3xl sm:text-4xl font-extrabold text-[#20243A]">Kontak & Layanan Bantuan</h1>
            <p class="mt-2 text-sm sm:text-base text-[#5D647D] max-w-2xl">
                Punya pertanyaan seputar produk UMKM, kemitraan penjual, atau layanan kami? Jangan ragu menghubungi tim @difMarket.
            </p>
        </div>
    </section>

    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            {{-- Informasi Kontak --}}
            <div class="lg:col-span-5 space-y-5">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-7 shadow-sm space-y-6">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-[#F3EEFF] text-[#6C4AB6] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="4" width="20" height="16" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-[#20243A]">Email Resmi</h2>
                            <p class="mt-1 text-sm text-[#5D647D]">{{ config('difmarket.email') }}</p>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-[#20243A]">Nomor WhatsApp</h2>
                            <p class="mt-1 text-sm text-[#5D647D]">{{ config('difmarket.whatsapp_display') }}</p>
                            <a href="https://wa.me/{{ config('difmarket.whatsapp_number') }}" target="_blank" rel="noopener" class="mt-2 inline-flex items-center text-xs font-bold text-emerald-600 hover:underline">
                                Chat via WhatsApp &rarr;
                            </a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-2xl bg-[#FFF4E8] text-[#FF9F43] flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                        </div>
                        <div>
                            <h2 class="text-sm font-bold text-[#20243A]">Alamat Usaha</h2>
                            <p class="mt-1 text-sm text-[#5D647D] leading-relaxed">{{ config('difmarket.address') }}</p>
                        </div>
                    </div>

                    <div class="pt-4 border-t border-slate-100">
                        <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Jam Operasional</p>
                        <p class="mt-1 text-sm font-semibold text-[#20243A]">{{ config('difmarket.hours') }}</p>
                    </div>
                </div>
            </div>

            {{-- Formulir Pesan --}}
            <div class="lg:col-span-7">
                <div class="bg-white rounded-3xl border border-slate-200/80 p-7 sm:p-9 shadow-sm">
                    <h2 class="text-xl font-extrabold text-[#20243A]">Kirim Pesan kepada Kami</h2>
                    <p class="mt-1 text-sm text-[#5D647D] mb-6">Silakan isi formulir di bawah ini, tim kami akan segera membalas pesan Anda.</p>

                    <x-flash-alert />

                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="name" class="block text-sm font-bold text-[#20243A] mb-1.5">Nama Lengkap <span class="text-rose-500">*</span></label>
                                <input
                                    type="text"
                                    id="name"
                                    name="name"
                                    value="{{ old('name') }}"
                                    placeholder="Contoh: Siti Rahmawati"
                                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                                    required
                                >
                                @error('name')
                                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-bold text-[#20243A] mb-1.5">Alamat Email <span class="text-rose-500">*</span></label>
                                <input
                                    type="email"
                                    id="email"
                                    name="email"
                                    value="{{ old('email') }}"
                                    placeholder="nama@email.com"
                                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('email') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                                    required
                                >
                                @error('email')
                                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="phone" class="block text-sm font-bold text-[#20243A] mb-1.5">Nomor WhatsApp / Telepon</label>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    value="{{ old('phone') }}"
                                    placeholder="0812xxxxxxxx"
                                    class="w-full px-4 py-3 rounded-xl border border-slate-200 bg-[#F8F9FC] text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                                >
                                @error('phone')
                                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="subject" class="block text-sm font-bold text-[#20243A] mb-1.5">Subjek Pesan <span class="text-rose-500">*</span></label>
                                <input
                                    type="text"
                                    id="subject"
                                    name="subject"
                                    value="{{ old('subject') }}"
                                    placeholder="Contoh: Kemitraan Produk UMKM"
                                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('subject') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                                    required
                                >
                                @error('subject')
                                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-bold text-[#20243A] mb-1.5">Isi Pesan <span class="text-rose-500">*</span></label>
                            <textarea
                                id="message"
                                name="message"
                                rows="5"
                                placeholder="Tuliskan pertanyaan atau pesan Anda secara lengkap..."
                                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('message') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                                required
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="inline-flex items-center gap-2 px-7 py-3.5 rounded-2xl text-sm font-bold dif-btn-primary cursor-pointer">
                            Kirim Pesan
                            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
