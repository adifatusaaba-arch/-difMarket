<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin @difMarket',
                'email' => 'admin@difmarket.id',
                'password' => Hash::make('password123'),
                'is_admin' => true,
            ],
            [
                'name' => 'Siti Rahmawati (UMKM Kuliner)',
                'email' => 'siti.umkm@difmarket.id',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Budi Hartono (UMKM Batik)',
                'email' => 'budi.batik@difmarket.id',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Dewi Lestari (UMKM Kriya)',
                'email' => 'dewi.kriya@difmarket.id',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
            [
                'name' => 'Andi Pratama (UMKM Kopi)',
                'email' => 'andi.kopi@difmarket.id',
                'password' => Hash::make('password123'),
                'is_admin' => false,
            ],
        ];

        foreach ($users as $user) {
            User::updateOrCreate(
                ['email' => $user['email']],
                $user
            );
        }

        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
            ContactMessageSeeder::class,
        ]);
    }
}
