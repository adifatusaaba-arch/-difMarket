<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Isi 5 contoh pesan kontak masuk dari pengunjung dan calon mitra UMKM.
     */
    public function run(): void
    {
        $messages = [
            [
                'email' => 'rina.wijaya@example.com',
                'subject' => 'Pendaftaran Mitra UMKM Kuliner',
                'name' => 'Rina Wijaya',
                'phone' => '081298765432',
                'message' => 'Halo tim @difMarket, saya produsen kue kering rumahan di Bandung dan ingin mendaftarkan 5 varian produk ke etalase.',
            ],
            [
                'email' => 'hendra.putra@example.com',
                'subject' => 'Pemesanan Hampers Korporat',
                'name' => 'Hendra Putra',
                'phone' => '081345678901',
                'message' => 'Apakah Paket Hampers Bambu Etnik Nusantara tersedia untuk pemesanan sebanyak 50 paket dengan kartu ucapan perusahaan?',
            ],
            [
                'email' => 'nadia.kusuma@example.com',
                'subject' => 'Pertanyaan Pengiriman Luar Pulau',
                'name' => 'Nadia Kusuma',
                'phone' => '085612349876',
                'message' => 'Saya ingin memesan Kopi Arabika Gayo dan Keripik Tempe ke Makassar. Apakah pengemasan aman untuk pengiriman jarak jauh?',
            ],
            [
                'email' => 'fajar.nugroho@example.com',
                'subject' => 'Stok Ukuran Kemeja Batik Parang',
                'name' => 'Fajar Nugroho',
                'phone' => '082187654321',
                'message' => 'Permisi admin, apakah Kemeja Batik Tulis Modern Parang ukuran XL masih ready untuk pengiriman hari ini?',
            ],
            [
                'email' => 'maya.sari@example.com',
                'subject' => 'Kolaborasi Bazar UMKM Lokal',
                'name' => 'Maya Sari',
                'phone' => '087811223344',
                'message' => 'Kami dari komunitas UMKM Jawa Barat ingin mengajak @difMarket berkolaborasi dalam kegiatan bazar produk lokal bulan depan.',
            ],
        ];

        foreach ($messages as $item) {
            ContactMessage::updateOrCreate(
                [
                    'email' => $item['email'],
                    'subject' => $item['subject'],
                ],
                $item
            );
        }
    }
}
