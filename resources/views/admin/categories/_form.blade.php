@php
    $isEdit = isset($category);
@endphp

<div class="space-y-5 max-w-2xl">
    <div>
        <label for="name" class="block text-sm font-bold text-[#20243A] mb-1.5">Nama Kategori <span class="text-rose-500">*</span></label>
        <input
            type="text"
            id="name"
            name="name"
            data-slug-source
            value="{{ old('name', $category->name ?? '') }}"
            placeholder="Contoh: Kuliner & Camilan"
            class="w-full px-4 py-3 rounded-xl border {{ $errors->has('name') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
            required
        >
        @error('name')
            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="slug" class="block text-sm font-bold text-[#20243A] mb-1.5">Slug URL</label>
        <input
            type="text"
            id="slug"
            name="slug"
            data-slug-target
            value="{{ old('slug', $category->slug ?? '') }}"
            placeholder="otomatis-dari-nama-kategori"
            class="w-full px-4 py-3 rounded-xl border {{ $errors->has('slug') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
        >
        @error('slug')
            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="description" class="block text-sm font-bold text-[#20243A] mb-1.5">Deskripsi Kategori</label>
        <textarea
            id="description"
            name="description"
            rows="4"
            placeholder="Jelaskan jenis produk UMKM yang termasuk dalam kategori ini..."
            class="w-full px-4 py-3 rounded-xl border {{ $errors->has('description') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
        >{{ old('description', $category->description ?? '') }}</textarea>
        @error('description')
            <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
        @enderror
    </div>

    <div class="pt-4 border-t border-slate-100 flex items-center gap-3">
        <button type="submit" class="px-7 py-3 rounded-xl text-sm font-bold dif-btn-primary cursor-pointer">
            {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Kategori' }}
        </button>
        <a href="{{ route('admin.categories.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold border border-slate-200 text-[#5D647D] hover:bg-slate-50">
            Batal
        </a>
    </div>
</div>
