<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan ringkasan statistik dan data terbaru di dashboard admin.
     */
    public function __invoke(): View
    {
        $stats = [
            'total_products' => Product::count(),
            'total_categories' => Category::count(),
            'total_stock' => (int) Product::sum('stock'),
            'low_stock_products' => Product::where('stock', '<=', 10)->count(),
            'total_messages' => ContactMessage::count(),
        ];

        $recentProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('products')
            ->orderByDesc('products_count')
            ->get();

        $recentMessages = ContactMessage::latest()
            ->take(4)
            ->get();

        return view('admin.dashboard', compact(
            'stats',
            'recentProducts',
            'categories',
            'recentMessages'
        ));
    }
}
