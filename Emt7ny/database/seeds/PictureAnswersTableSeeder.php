<?php

use Illuminate\Database\Seeder;
use App\picture_answer;

class PictureAnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(picture_answer::class, 20)->create();
    }
}
