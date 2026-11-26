@php
    $isEdit = isset($product);
@endphp

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="lg:col-span-8 space-y-5">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="name" class="block text-sm font-bold text-[#20243A] mb-1.5">Nama Produk <span class="text-rose-500">*</span></label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    data-slug-source
                    value="{{ old('name', $product->name ?? '') }}"
                    placeholder="Contoh: Kopi Robusta Temanggung 250g"
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
                    value="{{ old('slug', $product->slug ?? '') }}"
                    placeholder="otomatis-dari-nama-produk"
                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('slug') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                >
                @error('slug')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
            <div>
                <label for="category_id" class="block text-sm font-bold text-[#20243A] mb-1.5">Kategori <span class="text-rose-500">*</span></label>
                <select
                    id="category_id"
                    name="category_id"
                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('category_id') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    required
                >
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $product->category_id ?? '') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="price" class="block text-sm font-bold text-[#20243A] mb-1.5">Harga (Rp) <span class="text-rose-500">*</span></label>
                <input
                    type="number"
                    id="price"
                    name="price"
                    min="0"
                    step="1"
                    value="{{ old('price', $product->price ?? '') }}"
                    placeholder="50000"
                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('price') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    required
                >
                @error('price')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="stock" class="block text-sm font-bold text-[#20243A] mb-1.5">Stok <span class="text-rose-500">*</span></label>
                <input
                    type="number"
                    id="stock"
                    name="stock"
                    min="0"
                    step="1"
                    value="{{ old('stock', $product->stock ?? 0) }}"
                    placeholder="25"
                    class="w-full px-4 py-3 rounded-xl border {{ $errors->has('stock') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                    required
                >
                @error('stock')
                    <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div>
            <label for="description" class="block text-sm font-bold text-[#20243A] mb-1.5">Deskripsi Lengkap <span class="text-rose-500">*</span></label>
            <textarea
                id="description"
                name="description"
                rows="6"
                placeholder="Jelaskan keunggulan, bahan baku, ukuran/berat, serta cara pemesanan produk UMKM..."
                class="w-full px-4 py-3 rounded-xl border {{ $errors->has('description') ? 'border-rose-400 bg-rose-50/40' : 'border-slate-200 bg-[#F8F9FC]' }} text-sm focus:bg-white focus:border-[#6C4AB6] focus:outline-none"
                required
            >{{ old('description', $product->description ?? '') }}</textarea>
            @error('description')
                <p class="mt-1 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="lg:col-span-4 space-y-4">
        <div class="rounded-2xl border border-slate-200 bg-[#F8F9FC] p-5">
            <label for="image" class="block text-sm font-bold text-[#20243A] mb-2">
                Foto Produk @if(! $isEdit)<span class="text-rose-500">*</span>@endif
            </label>

            <div class="aspect-[4/3] rounded-xl overflow-hidden bg-white border border-dashed border-slate-300 flex items-center justify-center mb-4">
                <img
                    src="{{ $isEdit ? $product->image_url : '' }}"
                    alt="Pratinjau foto produk"
                    data-image-preview
                    class="w-full h-full object-cover {{ $isEdit ? '' : 'hidden' }}"
                >
                <div data-image-placeholder class="text-center p-4 {{ $isEdit ? 'hidden' : '' }}">
                    <svg class="w-10 h-10 mx-auto text-slate-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="m21 15-5-5L5 21"/></svg>
                    <p class="mt-2 text-xs font-semibold text-[#5D647D]">Pratinjau gambar produk</p>
                </div>
            </div>

            <input
                type="file"
                id="image"
                name="image"
                data-image-input
                accept=".jpg,.jpeg,.png,.webp,image/jpeg,image/png,image/webp"
                class="block w-full text-xs text-[#5D647D] file:mr-3 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-[#6C4AB6] file:text-white hover:file:bg-[#58399B] cursor-pointer"
                {{ $isEdit ? '' : 'required' }}
            >
            <p data-image-filename class="mt-2 text-xs text-[#6C4AB6] font-medium"></p>
            <p class="mt-1.5 text-[11px] text-[#5D647D]">
                Format: JPG, JPEG, PNG, atau WEBP. Maksimal 2 MB.
                @if ($isEdit)
                    Biarkan kosong jika tidak ingin mengganti foto saat ini.
                @endif
            </p>
            @error('image')
                <p class="mt-1.5 text-xs text-rose-600 font-medium">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<div class="mt-8 pt-6 border-t border-slate-100 flex flex-wrap items-center gap-3">
    <button type="submit" class="px-7 py-3 rounded-xl text-sm font-bold dif-btn-primary cursor-pointer">
        {{ $isEdit ? 'Simpan Perubahan' : 'Simpan Produk' }}
    </button>
    <a href="{{ route('admin.products.index') }}" class="px-6 py-3 rounded-xl text-sm font-bold border border-slate-200 text-[#5D647D] hover:bg-slate-50">
        Batal
    </a>
</div>
