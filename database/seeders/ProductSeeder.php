<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Isi produk contoh UMKM beserta gambar nyata di public storage.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $products = [
            [
                'category_slug' => 'kuliner-camilan',
                'name' => 'Keripik Tempe Renyah Daun Jeruk',
                'slug' => 'keripik-tempe-renyah-daun-jeruk',
                'description' => "Keripik tempe pilihan dengan irisan tipis, digoreng renyah menggunakan minyak nabati berkualitas dan dibumbui aroma daun jeruk segar serta bawang putih.\n\nCocok sebagai camilan keluarga, teman makan nasi hangat, maupun oleh-oleh khas Nusantara. Dikemas dalam standing pouch kedap udara agar kerenyahan terjaga.",
                'price' => 25000,
                'stock' => 48,
                'palette' => [[255, 159, 67], [108, 74, 182]],
                'badge' => 'KULINER',
            ],
            [
                'category_slug' => 'kuliner-camilan',
                'name' => 'Sambal Roa Asap Khas Manado',
                'slug' => 'sambal-roa-asap-khas-manado',
                'description' => "Sambal ikan roa asap autentik yang diolah secara tradisional tanpa bahan pengawet. Perpaduan daging ikan roa pilihan, cabai rawit segar, dan rempah Nusantara menghasilkan cita rasa gurih pedas yang menggugah selera.\n\nKemasan botol kaca steril 180 gram, praktis dibawa bepergian atau disajikan kapan saja.",
                'price' => 42000,
                'stock' => 30,
                'palette' => [[235, 87, 87], [255, 159, 67]],
                'badge' => 'KULINER',
            ],
            [
                'category_slug' => 'fashion-batik',
                'name' => 'Kemeja Batik Tulis Modern Parang',
                'slug' => 'kemeja-batik-tulis-modern-parang',
                'description' => "Kemeja batik lengan panjang berbahan katun primisima halus yang adem dan nyaman dipakai seharian. Mengusung motif Parang kontemporer dengan sentuhan warna ungu elegan dan aksen hangat.\n\nJahitan rapi kualitas butik, tersedia ukuran M, L, dan XL untuk acara formal maupun kasual.",
                'price' => 245000,
                'stock' => 15,
                'palette' => [[108, 74, 182], [62, 42, 120]],
                'badge' => 'FASHION',
            ],
            [
                'category_slug' => 'fashion-batik',
                'name' => 'Totebag Tenun Ikat Nusantara',
                'slug' => 'totebag-tenun-ikat-nusantara',
                'description' => "Tas jinjing modern berbahan kombinasi kain tenun ikat asli pengrajin dan kanvas tebal water-repellent. Dilengkapi resleting utama, saku dalam untuk laptop 14 inci, dan tali bahu yang kokoh.\n\nMenunjang gaya harian Anda sekaligus melestarikan warisan tenun lokal.",
                'price' => 165000,
                'stock' => 22,
                'palette' => [[142, 108, 214], [255, 159, 67]],
                'badge' => 'FASHION',
            ],
            [
                'category_slug' => 'kerajinan-tangan',
                'name' => 'Keranjang Rotan Anyam Multifungsi',
                'slug' => 'keranjang-rotan-anyam-multifungsi',
                'description' => "Keranjang serbaguna hasil anyaman tangan pengrajin rotan lokal dengan finishing natural anti-jamur. Ideal untuk penyimpanan perlengkapan rumah tangga, pot tanaman indoor, maupun hampers cantik.\n\nDiameter 32 cm dengan pegangan kokoh dan tampilan minimalis hangat.",
                'price' => 135000,
                'stock' => 18,
                'palette' => [[214, 137, 68], [130, 88, 52]],
                'badge' => 'KRIYA',
            ],
            [
                'category_slug' => 'kerajinan-tangan',
                'name' => 'Set Cangkir Keramik Glazur Pastel',
                'slug' => 'set-cangkir-keramik-glazur-pastel',
                'description' => "Set 2 cangkir dan tatakan keramik handmade yang dibakar pada suhu tinggi sehingga kuat dan aman untuk minuman panas maupun dingin.\n\nFinishing glazur halus bernuansa modern minimalis, cocok untuk ruang tamu atau hadiah spesial.",
                'price' => 185000,
                'stock' => 12,
                'palette' => [[108, 74, 182], [180, 162, 230]],
                'badge' => 'KRIYA',
            ],
            [
                'category_slug' => 'kopi-minuman',
                'name' => 'Kopi Arabika Gayo Honey Roast 250g',
                'slug' => 'kopi-arabika-gayo-honey-roast-250g',
                'description' => "Biji kopi Arabika pilihan dari dataran tinggi Aceh Gayo yang diproses dengan metode honey process dan disangrai medium roast oleh roaster UMKM.\n\nMenawarkan profil rasa karamel manis, buah tropis ringan, dan aftertaste bersih. Tersedia pilihan biji utuh atau bubuk.",
                'price' => 78000,
                'stock' => 40,
                'palette' => [[92, 64, 51], [255, 159, 67]],
                'badge' => 'KOPI',
            ],
            [
                'category_slug' => 'perawatan-herbal',
                'name' => 'Sabun Organik Madu & Sereh Wangi',
                'slug' => 'sabun-organik-madu-sereh-wangi',
                'description' => "Sabun mandi batang alami yang dibuat dengan metode cold-process dari minyak kelapa murni, madu hutan asli, dan ekstrak minyak atsiri sereh wangi.\n\nMelembapkan kulit tanpa SLS/paraben serta memberikan aroma relaksasi alami setiap kali mandi.",
                'price' => 35000,
                'stock' => 60,
                'palette' => [[72, 168, 136], [108, 74, 182]],
                'badge' => 'HERBAL',
            ],
        ];

        foreach ($products as $item) {
            $categoryId = $categories[$item['category_slug']] ?? null;
            if (! $categoryId) {
                continue;
            }

            $imagePath = 'products/'.$item['slug'].'.png';
            $this->generateProductImage(
                $imagePath,
                $item['name'],
                $item['badge'],
                $item['palette'][0],
                $item['palette'][1]
            );

            Product::updateOrCreate(
                ['slug' => $item['slug']],
                [
                    'category_id' => $categoryId,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'stock' => $item['stock'],
                    'image' => $imagePath,
                ]
            );
        }
    }

    /**
     * Membuat gambar ilustrasi produk PNG berkualitas ke storage/app/public.
     */
    private function generateProductImage(
        string $storagePath,
        string $title,
        string $badge,
        array $primaryRgb,
        array $secondaryRgb
    ): void {
        if (! function_exists('imagecreatetruecolor')) {
            return;
        }

        $width = 800;
        $height = 600;
        $img = imagecreatetruecolor($width, $height);
        imagealphablending($img, true);

        // Smooth vertical-diagonal gradient background
        for ($y = 0; $y < $height; $y++) {
            $ratio = $y / $height;
            $r = (int) round($primaryRgb[0] * (1 - $ratio) + $secondaryRgb[0] * $ratio);
            $g = (int) round($primaryRgb[1] * (1 - $ratio) + $secondaryRgb[1] * $ratio);
            $b = (int) round($primaryRgb[2] * (1 - $ratio) + $secondaryRgb[2] * $ratio);
            $lineColor = imagecolorallocate($img, $r, $g, $b);
            imageline($img, 0, $y, $width, $y, $lineColor);
        }

        // Soft decorative translucent circles
        $circle1 = imagecolorallocatealpha($img, 255, 255, 255, 108);
        $circle2 = imagecolorallocatealpha($img, 255, 255, 255, 114);
        imagefilledellipse($img, 650, 120, 340, 340, $circle1);
        imagefilledellipse($img, 140, 500, 280, 280, $circle2);

        // Center showcase card
        $cardBg = imagecolorallocatealpha($img, 255, 255, 255, 18);
        imagefilledrectangle($img, 90, 110, 710, 490, $cardBg);

        // Accent bar inside card
        $accentColor = imagecolorallocate($img, 255, 159, 67);
        $purpleColor = imagecolorallocate($img, 108, 74, 182);
        $darkText = imagecolorallocate($img, 32, 36, 58);
        $mutedText = imagecolorallocate($img, 95, 102, 130);
        $white = imagecolorallocate($img, 255, 255, 255);

        imagefilledrectangle($img, 90, 110, 710, 122, $accentColor);

        // Badge pill
        imagefilledrectangle($img, 130, 160, 290, 200, $purpleColor);
        imagestring($img, 5, 152, 172, $badge, $white);

        // Brand tag on top right of card
        imagestring($img, 5, 560, 172, '@difMarket', $purpleColor);

        // Decorative product emblem circle
        $softCircle = imagecolorallocate($img, 243, 238, 255);
        imagefilledellipse($img, 400, 285, 130, 130, $softCircle);
        imagefilledellipse($img, 400, 285, 84, 84, $purpleColor);
        imagefilledellipse($img, 435, 250, 26, 26, $accentColor);
        imagestring($img, 5, 391, 277, 'UMKM', $white);

        // Centered wrapped product title
        $wrapped = wordwrap($title, 34, "\n");
        $lines = array_slice(explode("\n", $wrapped), 0, 2);
        $startY = 378;
        foreach ($lines as $idx => $line) {
            $textWidth = imagefontwidth(5) * strlen($line);
            $x = (int) (($width - $textWidth) / 2);
            imagestring($img, 5, max(110, $x), $startY + ($idx * 26), $line, $darkText);
        }

        $sub = 'Produk Pilihan UMKM Lokal Indonesia';
        $subWidth = imagefontwidth(4) * strlen($sub);
        imagestring($img, 4, (int) (($width - $subWidth) / 2), 446, $sub, $mutedText);

        ob_start();
        imagepng($img);
        $pngData = ob_get_clean();
        imagedestroy($img);

        Storage::disk('public')->put($storagePath, $pngData);
    }
}
