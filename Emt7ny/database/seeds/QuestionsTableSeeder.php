<?php

use Illuminate\Database\Seeder;
use App\question;
use App\choice_question;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(question::class, 10)->create()
            ->each(function ($question) {
                $question->choices()->saveMany(factory(choice_question::class, 4)->make());
            });
    }
}
