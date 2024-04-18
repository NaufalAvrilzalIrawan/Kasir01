<?php

namespace Database\Seeders;

use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Produk::create([
            'namaProduk' => 'Indomie Goreng',
            'harga' => 3500,
            'stok' => 500,
            'created_at' => null,
            'updated_at' => null,
        ]);
    }
}
