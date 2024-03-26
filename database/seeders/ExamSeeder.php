<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        DB::table('exam_masters')->insert([
            'category_id' => 1,
            'name' => 'Listening Daily Activiy',
            'exam_date' => $now,
            'exam_duration' => '20',
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('exam_masters')->insert([
            'category_id' => 2,
            'name' => 'Listening How to work in factory',
            'exam_date' => $now,
            'exam_duration' => '20',
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
