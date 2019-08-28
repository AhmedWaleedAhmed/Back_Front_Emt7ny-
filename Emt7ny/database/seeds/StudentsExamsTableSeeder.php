<?php

use Illuminate\Database\Seeder;
use App\students_exam;

class StudentsExamsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(students_exam::class, 10)->create();
    }
}
