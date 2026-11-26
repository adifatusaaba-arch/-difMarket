<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Isi 5 kategori produk UMKM unggulan.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Kuliner & Camilan',
                'slug' => 'kuliner-camilan',
                'description' => 'Aneka makanan ringan, kue kering, sambal kemasan, dan jajanan khas Nusantara produksi UMKM lokal.',
            ],
            [
                'name' => 'Fashion & Batik',
                'slug' => 'fashion-batik',
                'description' => 'Busana batik modern, tenun etnik, tas kanvas, dan aksesori fesyen karya perajin lokal.',
            ],
            [
                'name' => 'Kerajinan Tangan',
                'slug' => 'kerajinan-tangan',
                'description' => 'Produk kriya rotan, keramik, kayu ukir, dan dekorasi rumah ramah lingkungan buatan tangan.',
            ],
            [
                'name' => 'Kopi & Minuman',
                'slug' => 'kopi-minuman',
                'description' => 'Biji kopi single origin, teh artisan, dan minuman rempah tradisional siap seduh.',
            ],
            [
                'name' => 'Perawatan & Herbal',
                'slug' => 'perawatan-herbal',
                'description' => 'Sabun alami, minyak esensial, lulur tradisional, dan jamu herbal higienis berbahan alami.',
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}
