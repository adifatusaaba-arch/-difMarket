@if (session('success'))
    <div data-alert-box class="mb-6 flex items-start justify-between gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3.5 text-emerald-900 shadow-sm">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-emerald-600 mt-0.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                <polyline points="22 4 12 14.01 9 11.01"/>
            </svg>
            <p class="text-sm font-medium">{{ session('success') }}</p>
        </div>
        <button type="button" data-dismiss-alert class="text-emerald-700 hover:text-emerald-950 p-1 rounded-lg" aria-label="Tutup notifikasi">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
    </div>
@endif

@if (session('error'))
    <div data-alert-box class="mb-6 flex items-start justify-between gap-3 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3.5 text-rose-900 shadow-sm">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 text-rose-600 mt-0.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="10"/>
                <line x1="12" y1="8" x2="12" y2="12"/>
                <line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            <p class="text-sm font-medium">{{ session('error') }}</p>
        </div>
        <button type="button" data-dismiss-alert class="text-rose-700 hover:text-rose-950 p-1 rounded-lg" aria-label="Tutup notifikasi">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
        </button>
    </div>
@endif

@if ($errors->any())
    <div data-alert-box class="mb-6 rounded-2xl border border-rose-200 bg-rose-50 px-4 py-3.5 text-rose-900 shadow-sm">
        <div class="flex items-start justify-between gap-3">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-rose-600 mt-0.5 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"/>
                    <line x1="12" y1="8" x2="12" y2="12"/>
                    <line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
                <div>
                    <p class="text-sm font-bold">Mohon periksa kembali data yang Anda masukkan:</p>
                    <ul class="mt-1.5 list-disc list-inside text-xs sm:text-sm space-y-0.5 text-rose-800">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <button type="button" data-dismiss-alert class="text-rose-700 hover:text-rose-950 p-1 rounded-lg" aria-label="Tutup notifikasi">
                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6 6 18M6 6l12 12"/></svg>
            </button>
        </div>
    </div>
@endif
