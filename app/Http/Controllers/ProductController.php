<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Tampilkan daftar produk dengan pencarian, filter kategori, dan pengurutan.
     */
    public function index(Request $request): View
    {
        $search = $request->string('q')->trim()->value() ?: null;
        $categorySlug = $request->string('kategori')->trim()->value() ?: null;
        $sort = $request->string('urut')->trim()->value() ?: 'terbaru';

        $query = Product::with('category')->filter($search, $categorySlug);

        match ($sort) {
            'termurah' => $query->orderBy('price'),
            'termahal' => $query->orderByDesc('price'),
            'nama' => $query->orderBy('name'),
            default => $query->latest(),
        };

        $products = $query->paginate(9)->withQueryString();
        $categories = Category::withCount('products')->orderBy('name')->get();
        $activeCategory = $categorySlug
            ? $categories->firstWhere('slug', $categorySlug)
            : null;

        return view('products.index', compact(
            'products',
            'categories',
            'activeCategory',
            'search',
            'categorySlug',
            'sort'
        ));
    }

    /**
     * Tampilkan halaman detail produk beserta produk terkait.
     */
    public function show(Product $product): View
    {
        $product->load('category');

        $relatedProducts = Product::with('category')
            ->where('category_id', $product->category_id)
            ->whereKeyNot($product->id)
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}
