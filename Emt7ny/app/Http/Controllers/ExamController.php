<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\exam;
use Illuminate\Support\Str;
use App\exams_teacher;
use App\question;

/**
 * @group Exam
 * 
 */
class ExamController extends Controller
{
    /**
     * Create Exam
     * A teacher creates exam and sets its title, instructions and duration.
     * It returns the exam id, and then the teacher can add questions to it.
     * If there is no logged-in user or he is not a teacher, it returns an error
     * 
     * @authenticated
     * 
     * @response 400 {"error":"The user is not a teacher"}
     * @response 401 {"error":"The user is not authorized"}
     * @response 200 {"id":11}
     * 
     * @bodyParam title string required The title of the exam. Example: Arabic_Exam_2018
     * @bodyParam instructions text The instructions of the exam (if any). Example:calculators are not allowed
     * @bodyParam duration time The duration of the exam, must follow the format `"H:i"`, default is `02:30`. Example: 02:30
     * 
     */
    public function createExam(Request $request)
    {
        $validator = validator($request->all(), [
            'title' => 'required|string',
            'instructions' => 'string',
            'duration' => 'date_format:"H:i"',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $teacher = auth()->user();
        if (!$teacher) {
            return response()->json(['error' => 'The user is not authorized'], 401);
        }
        if (!$teacher->isTeacher) {
            return response()->json(['error' => 'The user is not a teacher'], 400);
        }

        $exam = exam::create($request->only('title', 'instructions', 'duration'));
        exams_teacher::create(['examId' => $exam->id, 'teacherId' => $teacher->id]);

        return response()->json(['id' => $exam->id]);
    }

    /**
     * Edit Exam
     * A teacher edits an exam title, instructions and duration.
     * Returns the exam data after edit.
     * If the logged-in user is not a registered teacher of the exam it returns an error.
     * 
     * @authenticated
     * 
     * @response 400 {"error":"The user is not a teacher"}
     * @response 401 {"error":"The user is not authorized"}
     * @response 404 {"error":"The exam is not found"}
     * @response 400 {"error":"the user is not a registered teacher of the exam"}
     * @response 200 {
     *  "id": 11,
     *  "code": "45EeiadOFV",
     *  "duration": "02:30:00",
     *  "title": "english Exam 2018",
     *  "instructions": null,
     *  "teacherId": 12,
     *  "created_at": "2019-08-20 03:02:32",
     *  "updated_at": "2019-08-21 16:07:26"
     * }
     * 
     * @bodyParam id integer required The id of the exam to be edited. Example: 11
     * @bodyParam title string The new title of the exam. Example: Arabic_Exam_2018
     * @bodyParam instructions text The new instructions of the exam. Example:calculators are not allowed
     * @bodyParam duration time The new duration of the exam, must follow the format `"H:i"`, default is `02:30`. Example: 02:30
     */
    public function editExam(Request $request)
    {
        $validator = validator($request->all(), [
            'id' => 'required|integer',
            'title' => 'string',
            'instructions' => 'string',
            'duration' => 'date_format:"H:i"'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $teacher = auth()->user();
        if (!$teacher) {
            return response()->json(['error' => 'the user is not authorized'], 401);
        }
        if (!$teacher->isTeacher) {
            return response()->json(['error' => 'the user is not a teacher'], 400);
        }
        $exam = exam::find($request->id);
        if (!$exam) {
            return response()->json(['error' => 'The exam is not found'], 404);
        }
        if (!$exam->teachers->pluck('id')->contains($teacher->id)) {
            return response()->json(['error' => 'the user is not a registered teacher of the exam'], 400);
        }
        $exam->update($request->only('title', 'instructions', 'duration'));
        unset($exam->teacher);
        return response()->json($exam);
    }

    /**
     * View Exam
     * A user view an Exam data.
     * It returns title, instructions, duration, fullmark and questions of the exam.
     * If the user isn't a registered student or teacher in the exam, it returns an error
     * 
     * @authenticated
     * 
     * @responseFile 404 responses/examNotFound.json
     * @responseFile 400 responses/userNotRegisteredInExam.json
     * @responseFile 401 responses/userIsNotAuthorized.json
     * @responseFile responses/validViewExam.json
     * 
     * @bodyParam id integer required The id of the exam to be viewed. Example:11
     */
    public function viewExam(Request $request)
    {
        $validator = validator($request->only('id'), ['id' => 'integer|required']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $user = auth()->user();
        $exam = exam::find($request->id);
        if (!$exam) {
            return response()->json(['error' => 'The exam is not found'], 404);
        }
        if (!$user) {
            return response()->json(['error' => 'The user is not authorized'], 401);
        }
        if (!$exam->teachers->pluck('id')->contains($user->id) && !$exam->students->pluck('id')->contains($user->id)) {
            return response()->json(['error' => 'the user is not a registerd student or teacher in the exam'], 400);
        }
        $exam = exam::query()->where('id', $request->id)->with('questions.choices', 'questions.pictures')->first();
        return response()->json($exam);
    }

    /**
     * Delete Exam
     * The creator of the exam deletes the exam.
     * The request returns a message that indicates that the exam is deleted successfully.
     * If the logged-in user is not the creator of the exam 
     * (the first registered teacher of the exam), it returns an error.
     * 
     * @authenticated
     * 
     * @response 401 {"error":"The user is not authorized"}
     * @response 404 {"error":"The exam is not found"}
     * @response 400 {"error":"The user is not the creator of the exam"}
     * @response 200 {"result":"The exam is deleted successfully"}
     * 
     * @bodyParam id integer required The id of the exam to be deleted. Example:11
     */
    public function deleteExam(Request $request)
    {
        $validator = validator($request->only('id'), ['id' => 'integer|required']);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $teacher = auth()->user();
        if (!$teacher) {
            return response()->json(['error' => 'The user is not authorized'], 401);
        }
        $exam = exam::query()->find($request->id);
        if (!$exam) {
            return response()->json(['error' => 'The exam is not found'], 404);
        }
        $creatorId = exams_teacher::query()->where('examId', $exam->id)->oldest()->first()->teacherId;
        if ($teacher->id != $creatorId) {
            return response()->json(['error' => 'The user is not the creator of the exam'], 400);
        }
        $exam->delete();
        return response()->json(['result' => 'The exam is deleted successfully']);
    }

    /**
     * Add Question
     * The registered teachers of the exam add question to it.
     * It returns the id of the added question.
     * If the logged-in user is not a registered teacher of the exam, it returns an error
     * 
     * @authenticated
     * 
     * @response 401 {"error":"The user is not authorized"}
     * @response 404 {"error":"The exam is not found"}
     * @response 400 {"error":"The user is not a registered teacher of the exam"}
     * @response 200 {"id":62}
     * 
     * @bodyParam examId integer required The id of the exam that the question is added to. Example:11
     * @bodyParam question text required The text of the question to be added. Example:What's the area of Egypt?
     * @bodyParam fullmark integer The fullmark of the question to be added, default is 2. Example: 2
     */
    public function addQuestion(Request $request)
    {
        $validator = validator($request->all(), [
            'examId' => 'integer|required',
            'question' => 'string|required',
            'fullmark' => 'integer'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $teacher = auth()->user();
        if (!$teacher) {
            return response()->json(['error' => 'The user is not authorized'], 401);
        }
        $exam = exam::query()->find($request->examId);
        if (!$exam) {
            return response()->json(['error' => 'The exam is not found'], 404);
        }
        if (!$exam->teachers->pluck('id')->contains($teacher->id)) {
            return response()->json(['error' => 'The user is not a registered teacher of the exam'], 400);
        }
        $question = question::create($request->only('examId', 'question', 'fullmark'));
        $exam->setUpdatedAt(now())->save();
        return response()->json(['id' => $question->id]);
    }

    /**
     * Delete Question
     * The registered teachers of the exam removes a question.
     * It returns a message that indicates that the question is deleted successfully from the exam.
     * If the logged-in user is not a registered teacher of the exam, it returns an error.
     * If the given question doesn't belong to the given exam, it returns an error.
     * @authenticated
     * 
     * @response 401 {"error":"The user is not authorized"}
     * @response 404 {"error":"The exam is not found"}
     * @response 400 {"error":"The user is not a registered teacher of the exam"}
     * @response 404 {"error":"The question is not found"}
     * @response 400 {"error":"The question doesn't belong to the exam"}
     * @response 200 {"result":"The question is deleted successfully"}
     * 
     * @bodyParam examId integer required the id of the exam that the question is deleted from. Example:11
     * @bodyParam questionId integer required the id of the question to be deleted from the exam.
     */
    public function deleteQuestion(Request $request)
    {
        $validator = validator($request->all(), [
            'examId' => 'integer|required',
            'questionId' => 'integer|required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $exam = exam::query()->find($request->examId);
        if (!$exam) {
            return response()->json(['error' => 'The exam is not found'], 404);
        }
        $question = question::query()->find($request->questionId);
        if (!$question) {
            return response()->json(['error' => 'The question is not found'], 404);
        }
        if ($question->examId != $exam->id) {
            return response()->json(['error' => "The question doesn't belong to the exam"], 400);
        }
        $teacher = auth()->user();
        if (!$teacher) {
            return response()->json(['error' => 'The user is not authorized'], 401);
        }
        if (!$exam->teachers->pluck('id')->contains($teacher->id)) {
            return response()->json(['error' => 'The user is not a registered teacher of the exam'], 400);
        }
        $question->delete();
        $exam->setUpdatedAt(now())->save();
        return response()->json(['result' => 'The question is deleted successfully']);
    }
}
