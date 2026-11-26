@extends('layouts.admin')

@section('title', 'Edit Produk')
@section('page_title', 'Edit Produk: ' . $product->name)
@section('page_subtitle', 'Perbarui informasi produk dan foto jika diperlukan')

@section('content')
    <div class="bg-white rounded-2xl border border-slate-200/80 p-6 sm:p-8 shadow-xs">
        <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._form', ['product' => $product])
        </form>
    </div>
@endsection
