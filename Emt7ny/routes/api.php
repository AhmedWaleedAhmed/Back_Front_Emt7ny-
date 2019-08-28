<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group([

    'middleware' => 'api',

], function ($router) {

    Route::post('login', 'AuthController@login');
    Route::post('signup', 'AuthController@signup');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('sendPasswordResetLink', 'ResetPasswordController@sendemail');
    Route::post('resetPassword', 'ChangePasswordController@process');
    Route::patch('EditProfile', 'UserController@editProfile');
    Route::get('ViewProfile', 'UserController@viewProfile');
    Route::delete('DeleteProfile', 'UserController@deleteProfile');
    Route::get('ViewTeacherExams', 'UserController@viewTeacherExams');
    Route::get('ViewStudentExams', 'UserController@viewStudentExams');

    Route::post('CreateExam', 'ExamController@createExam');
    Route::patch('EditExam', 'ExamController@editExam');
    Route::post('ViewExam', 'ExamController@viewExam');
    Route::delete('DeleteExam', 'ExamController@deleteExam');
    Route::post('AddQuestion', 'ExamController@addQuestion');
    Route::delete('DeleteQuestion', 'ExamController@deleteQuestion');

    
    /*Route::get('ViewStudentExamAnswers', 'StudentController@viewStudentExamAnswers');
    Route::post('RegisterStudent', 'StudentController@registerStudent');
    Route::get('ViewStudentExams', 'StudentController@viewStudentExams');

    Route::post('AnswerQuestion', 'AnswerController@answerQuestion');
    Route::post('AddAnswerPicture', 'AnswerController@addAnswerPicture');
    Route::post('CorrectAnswer', 'AnswerController@correctAnswer');


    Route::patch('EditQuestion', 'QuestionController@editQuestion');
    Route::post('AddQuestionChoice', 'QuestionController@addQuestionChoice');
    Route::patch('EditQuestionChoice', 'QuestionController@editQuestionChoice');
    Route::delete('DeleteQuestionChoice', 'QuestionController@deleteQuestionChoice');
    Route::post('AddQuestionPicture', 'QuestionController@addQuestionPicture');
    Route::patch('EditQuestionPicture', 'QuestionController@editQuestionPicture');
    Route::delete('DeleteQuestionPicture', 'QuestionController@deleteQuestionPicture');

    Route::get('Search', 'GeneralController@search');*/
});