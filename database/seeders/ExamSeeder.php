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
            'exam_id' => 'EXAM.03.2024.1',
            'category_id' => 1,
            'abbreviation' => 'KMZ',
            'name' => 'CBT Batch 1 - 29 Maret 2024',
            'exam_date' => '2024-03-29',
            'exam_duration' => 30,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);

        DB::table('exam_masters')->insert([
            'exam_id' => 'EXAM.03.2024.2',
            'category_id' => 1,
            'abbreviation' => 'KMZ',
            'name' => 'CBT Batch 2 - 30 April 2024',
            'exam_date' => '2024-04-30',
            'exam_duration' => 60,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now
        ]);
    }
}
