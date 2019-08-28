<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ExamsTableSeeder::class,
            QuestionsTableSeeder::class,
            PictureQuestionsTableSeeder::class,
            AnswersTableSeeder::class,
            PictureAnswersTableSeeder::class,
            StudentsExamsTableSeeder::class,
            ExamsTeachersTableSeeder::class
        ]);
    }
}
