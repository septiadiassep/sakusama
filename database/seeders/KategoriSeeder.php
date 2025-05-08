<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $type = ['Pemasukan', 'Pengeluaran'];

        foreach ($type as $item) {
            Kategori::create(['kategori' => $item]);
        }
    }
}
