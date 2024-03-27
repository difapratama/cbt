<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        // question one 
        $questionId = DB::table('questions')->insertGetId([
            'exam_id' => 1,
            'question_text' => '한국어를 쓰기 위해 사용되는 한글 알파벳 시스템은 무엇입니까?',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Insert choices associated with the question
        $choices = [
            ['question_id' => $questionId, 'choice_text' => '한글', 'is_correct' => 1],
            ['question_id' => $questionId, 'choice_text' => '한자', 'is_correct' => 0],
            ['question_id' => $questionId, 'choice_text' => '카타카나', 'is_correct' => 0],
            ['question_id' => $questionId, 'choice_text' => '히라가나', 'is_correct' => 0],
        ];

        DB::table('choices')->insert($choices);

        // question two 
        $questionId = DB::table('questions')->insertGetId([
            'exam_id' => 1,
            'question_text' => '대한민국은 어느 국제 기구의 회원입니까?',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Insert choices associated with the question
        $choices = [
            ['question_id' => $questionId, 'choice_text' => '북대서양 조약 기구 (NATO)', 'is_correct' => 0],
            ['question_id' => $questionId, 'choice_text' => '아세안', 'is_correct' => 0],
            ['question_id' => $questionId, 'choice_text' => '경제 협력 개발 기구 (OECD)', 'is_correct' => 1],
            ['question_id' => $questionId, 'choice_text' => '석유 수출국 기구 (OPEC)', 'is_correct' => 0],
        ];

        DB::table('choices')->insert($choices);

        // question three 
        $questionId = DB::table('questions')->insertGetId([
            'exam_id' => 2,
            'question_text' => '문재인 대통령은 어느 정당에 속해 있습니까?',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        // Insert choices associated with the question
        $choices = [
            ['question_id' => $questionId, 'choice_text' => '자유한국당', 'is_correct' => 0],
            ['question_id' => $questionId, 'choice_text' => '더불어민주당', 'is_correct' => 0],
            ['question_id' => $questionId, 'choice_text' => '바른미래당', 'is_correct' => 1],
            ['question_id' => $questionId, 'choice_text' => '국민의힘', 'is_correct' => 0],
        ];

        DB::table('choices')->insert($choices);
    }
}
