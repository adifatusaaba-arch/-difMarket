<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContactRequest;
use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PageController extends Controller
{
    /**
     * Halaman Tentang Kami @difMarket.
     */
    public function about(): View
    {
        $stats = [
            'products' => Product::count(),
            'categories' => Category::count(),
            'total_stock' => (int) Product::sum('stock'),
        ];

        return view('pages.about', compact('stats'));
    }

    /**
     * Halaman Kontak @difMarket.
     */
    public function contact(): View
    {
        return view('pages.contact');
    }

    /**
     * Simpan pesan dari formulir kontak publik ke database.
     */
    public function sendContact(StoreContactRequest $request): RedirectResponse
    {
        ContactMessage::create($request->validated());

        return redirect()
            ->route('contact')
            ->with('success', 'Terima kasih! Pesan Anda berhasil dikirim dan akan segera kami tindak lanjuti.');
    }
}
