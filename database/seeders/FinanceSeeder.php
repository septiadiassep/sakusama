<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class FinanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $users = User::all();

        $category = ['Pemasukan', 'Pengeluaran'];
        $sub_category = ['Gaji', 'Dagang', 'Jajan', 'Tagihan', 'Investasi'];

        for ($i = 0; $i < 10; $i++) {
            DB::table('finance')->insert([
                'tgl_proses' => now(),
                'id_pencatat' => $users->random()->id,
                'jumlah_rupiah' => $faker->randomFloat(2, 1000, 1000000), 
                'kategori' => $faker->randomElement($category), 
                'sub_kategori' => $faker->randomElement($sub_category), 
            ]);
        }
    }
}
