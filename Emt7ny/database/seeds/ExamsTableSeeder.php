<?php

use Illuminate\Database\Seeder;
use App\exam;
use App\question;

class ExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(exam::class, 10)->create()
            ->each(function ($exam) {
                $exam->questions()->saveMany(factory(question::class, 4)->make());
            });
    }
}
