<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
        'price',
        'stock',
        'image',
    ];

    /**
     * Satu produk dimiliki oleh satu kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * URL gambar produk dari public storage.
     */
    public function getImageUrlAttribute(): string
    {
        if ($this->image && Storage::disk('public')->exists($this->image)) {
            return Storage::url($this->image);
        }

        return asset('images/product-placeholder.svg');
    }

    /**
     * Format harga Rupiah yang rapi.
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp '.number_format((int) $this->price, 0, ',', '.');
    }

    /**
     * URL WhatsApp siap kirim untuk menanyakan atau memesan produk.
     */
    public function getWhatsappUrlAttribute(): string
    {
        $phone = config('difmarket.whatsapp_number', '6281234567890');
        $text = sprintf(
            "Halo @difMarket, saya tertarik dengan produk *%s* (%s). Apakah stoknya masih tersedia?",
            $this->name,
            $this->formatted_price
        );

        return 'https://wa.me/'.$phone.'?text='.urlencode($text);
    }

    /**
     * Filter produk berdasarkan kata kunci pencarian dan slug kategori.
     */
    public function scopeFilter(Builder $query, ?string $search, ?string $categorySlug): Builder
    {
        return $query
            ->when($search, function (Builder $q, string $term) {
                $q->where(function (Builder $sub) use ($term) {
                    $sub->where('name', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%");
                });
            })
            ->when($categorySlug, function (Builder $q, string $slug) {
                $q->whereHas('category', fn (Builder $cat) => $cat->where('slug', $slug));
            });
    }
}
