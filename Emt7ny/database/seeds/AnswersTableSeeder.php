<?php

use Illuminate\Database\Seeder;
use App\answer;

class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(answer::class, 10)->create();
    }
}
