<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('categories')->insert([
            'name' => 'CBT Reading',
            'description' => 'Kumpulan soal soal untuk persiapan CBT Reading di Seoul',
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('categories')->insert([
            'name' => 'CBT Listening',
            'description' => 'Kumpulan soal soal untuk persiapan CBT Listening di Seoul',
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
