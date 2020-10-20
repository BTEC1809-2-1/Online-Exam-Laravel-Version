<?php

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
        for($i = 1; $i <= 30; $i++)
        {
            $subjectList = array('IT', 'BM', 'DS');
            $subject = array_rand($subjectList, 1);
            $subject = $subjectList[$subject];
            $question_id = 'Q'.$subject.sprintf("%06d", random_int(1, 10000));
            DB::table('questions')
            ->insert([
                'id' => $question_id,
                'question' => 'Question '.sprintf("%06d", $i),
                'subject' => $subject,
                'type' => 'SC4',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'Admin 1',
                'updated_by' => 'Admin 1'
            ]);
            $scAnswers = [];
            for($j = 1; $j <= 4; $j++)
            {
                $scAnswers[] = [
                    'index' => $j,
                    'content' => 'Answer '.$i.'-'.$j,
                ];
            }
            DB::table('answers')
            ->insert([
                'id' => 'A'.$question_id.sprintf("%06d", $i),
                'question_id' => $question_id.sprintf("%06d", $i),
                'answer' => json_encode($scAnswers),
                'is_correct' => random_int(1, 4),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'Admin 1',
                'updated_by' => 'Admin 1'
            ]);
        }

        for($i = 31; $i <= 60; $i++)
        {
            $subjectList = array('IT', 'BM', 'DS');
            $subject = array_rand($subjectList, 1);
            $subject = $subjectList[$subject];
            $question_id = 'Q'.$subject.sprintf("%06d", random_int(1, 10000));
            DB::table('questions')
            ->insert([
                'id' => $question_id,
                'question' => 'Question '.sprintf("%06d", $i),
                'subject' => $subject,
                'type' => 'TF',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'Admin 1',
                'updated_by' => 'Admin 1'
            ]);
            $tfAnswers = [];
            for($j = 1; $j <= 2; $j++)
            {
                $tfAnswers[] = [
                    'index' => $j,
                    'content' => 'Answer '.$i.'-'.$j,
                ];
            }
            DB::table('answers')
            ->insert([
                'id' => 'A'.$question_id.sprintf("%06d", $i),
                'question_id' => $question_id.sprintf("%06d", $i),
                'answer' => json_encode($tfAnswers),
                'is_correct' => random_int(1, 2),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'Admin 1',
                'updated_by' => 'Admin 1'
            ]);
        }

        for($i = 61; $i <= 90; $i++)
        {
            $subjectList = array('IT', 'BM', 'DS');
            $subject = array_rand($subjectList, 1);
            $subject = $subjectList[$subject];
            $question_id = 'Q'.$subject.sprintf("%06d", random_int(1, 10000));
            DB::table('questions')
            ->insert([
                'id' => $question_id,
                'question' => 'Question '.sprintf("%06d", $i),
                'subject' => $subject,
                'type' => 'MC4',
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'Admin 1',
                'updated_by' => 'Admin 1'
            ]);
            $mcAnswers = [];
            $mcIsCorrect = [];
            for($j = 1; $j <= 4; $j++)
            {
                $mcAnswers[] = [
                    'index' => $j,
                    'content' => 'Answer '.$i.'-'.$j,
                ];
                $mcIsCorrect[] = [
                    'index' => $j,
                    'content' => random_int(1, 2),
                ];
            }
            
            DB::table('answers')
            ->insert([
                'id' => 'A'.$question_id.sprintf("%06d", $i),
                'question_id' => $question_id.sprintf("%06d", $i),
                'answer' => json_encode($mcAnswers),
                'is_correct' => json_encode($mcIsCorrect),
                'created_at' => now(),
                'updated_at' => now(),
                'created_by' => 'Admin 1',
                'updated_by' => 'Admin 1'
            ]);
        }
    }
}
