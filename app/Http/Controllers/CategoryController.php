<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Tampilkan seluruh kategori produk beserta daftar produk per kategori.
     */
    public function index(): View
    {
        $categories = Category::withCount('products')
            ->with(['products' => fn ($query) => $query->latest()->take(4)])
            ->orderBy('name')
            ->get();

        return view('categories.index', compact('categories'));
    }

    /**
     * Tampilkan daftar produk pada kategori tertentu.
     */
    public function show(Category $category): View
    {
        $categories = Category::withCount('products')->orderBy('name')->get();
        $products = $category->products()
            ->with('category')
            ->latest()
            ->paginate(9);

        return view('categories.show', compact('category', 'categories', 'products'));
    }
}
