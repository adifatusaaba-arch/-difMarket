<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman beranda publik @difMarket.
     */
    public function __invoke(): View
    {
        $categories = Category::withCount('products')
            ->orderBy('name')
            ->get();

        $featuredProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->orderByDesc('stock')
            ->take(4)
            ->get();

        $latestProducts = Product::with('category')
            ->latest()
            ->take(8)
            ->get();

        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'total_stock' => (int) Product::sum('stock'),
        ];

        return view('home', compact('categories', 'featuredProducts', 'latestProducts', 'stats'));
    }
}
