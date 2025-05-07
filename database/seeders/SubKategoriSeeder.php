<?php

namespace Database\Seeders;

use App\Models\SubKategori;
use Illuminate\Database\Seeder;

class SubKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = ['Gaji Bulanan', 'Jajan', 'Belanja Mingguan', 'Belanja Perabotan Rumah'];

        foreach ($category as $item) {
            SubKategori::create(['sub_kategori' => $item]);
        }
    }
}
