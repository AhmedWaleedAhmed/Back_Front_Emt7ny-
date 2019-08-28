<?php

use Illuminate\Database\Seeder;
use App\exams_teacher;
use App\exam;
use App\User;

class ExamsTeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teacherIds = User::query()->where('isTeacher', 1)->pluck('id');
        if ($teacherIds->isEmpty()) {
            $teacherIds = factory(User::class, 3)->state('teacher')->create()->pluck('id');
        }
        $exams = exam::all();
        foreach ($exams as $exam) {
            exams_teacher::create(['examId' => $exam->id, 'teacherId' => $teacherIds->random()]);
        }
    }
}
