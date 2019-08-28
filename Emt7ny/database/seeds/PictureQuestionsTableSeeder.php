<?php

use Illuminate\Database\Seeder;
use App\picture_question;

class PictureQuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(picture_question::class, 30)->create();
    }
}
