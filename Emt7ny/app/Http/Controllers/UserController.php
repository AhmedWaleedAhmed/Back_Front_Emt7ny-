<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Validator;
use Response;


/**
 * @group User
 * 
 */
class UserController extends Controller
{
    /**
     * EditProfile
     * 
     * 
     * this function will edit the profile of the user like edit (Photo  , name , password) 
     *  
     * 
     * @bodyParam name string The new name of the user.
     * @bodyParam password string The new password of the user.
     * @bodyParam image binary The new image of the user.
     * 
     * 
     * @response 201 {
     *  "status": "true",
     *  "userId": 2,
     *  "userName": "Waleed",
     *  "image": null
     * }
     * 
     * @response 404 {
     *   "status": "false",
     *   "errors": "The name must be a string."
     * }
     * 
     * @response 201 {
     *  "status": "false",
     * "Message": "nothing to be updated"
     * }
     */
    public function editProfile (Request $request)
    {
        $Validations    = array(
            "name"         => "string",
            "password"          => "string",
            "image"         => "image"
        );
        $Data = validator::make($request->all(), $Validations);
        if (!($Data->fails())) {
            // this line to get the id of the authenticated user
            /*
            * can be witen in this way 
            * $id = auth()->id();
            */ 
            $id = auth()->user()['id'];
            //echo($id); 
            $bool = 0; 
            if( User::find($id) )
            {
                if (!empty($request['name']))
                {
                    DB::table('users')
                            ->updateOrInsert(
                                ['id' => $id,],
                                ["name"  => $request["name"],   
                                'updated_at'=>now()]
                    );
                    $bool =1 ;
                }
                if (!empty($request['password']))
                {
                    DB::table('users')
                            ->updateOrInsert(
                                ['id' => $id,],
                                ["password"  => $request["password"],   
                                'updated_at'=>now()]
                    );
                    $bool =1 ;
                }
                if (!empty($request['image']))
                {
                    DB::table('users')
                            ->updateOrInsert(
                                ['id' => $id,],
                                ["image"  => $request["image"],   
                                'updated_at'=>now()]
                    );
                    $bool =1 ;
                }
                if ($bool == 1 )
                {
                    $user =User::find($id);
                    return response()->json([
                        "status" => "true" , "userId" => $id, "userName" => $user['name'] ,
                        "image" =>  $user['image'] ,
                    ]);
                }
                else{
                    return response()->json([
                        "status" => "false" , "Message" => "nothing to be updated"
                    ]); 
                }
                
            }
            else
            {
                return response()->json([
                    "status" => "false" , "Message" => "There are a problem in this user"
                ]);
            }
        }
        else {
            return response(["status" => "false", "errors" => $Data->messages()->first()]);
        }
    }


    /**
     * ViewProfile
     * 
     * 
     * this function will view the profile of the user 
     *  
     * 
     * 
     * @response 201 {
     * 
     *  "status": "true",
     *  "userId": 2,
     *  "userName": "Waleed",
     *  "image": null,
     *  "status_user": null,
     *  "email": "ahmdwaleed@gmail.com"
     * 
     *}
     *
     * @response 404 {
     *  "status": "false" ,
     *  "Message": "There are a problem in this user"
     * }
     */
    public function viewProfile (Request $request)
    { 
        $Validations    = array(
            "userId"  => "integer",
        );
        $Data = validator::make($request->all(), $Validations);
        if (!($Data->fails())) 
        {
            if(!empty($request["userId"]))
            {
                $id = $request["userId"]; 
                if( User::find($id) )
                {
                    $user =User::find($id);
                    return response()->json([
                        "status" => "true" , "userId" => $id, "userName" => $user['name'] ,
                        "image" =>  $user['image'] , "isTeacher" => $user['isTeacher'] 
                        , "email" => $user['email']
                    ]); 
                    
                }
                else
                {
                    return response()->json([
                        "status" => "false" , "Message" => "There is a problem in this user"
                    ]);
                }
            }
            else
            {
                $id = auth()->user()['id']; 
                if( User::find($id) )
                {
                    $user =User::find($id);
                    return response()->json([
                        "status" => "true" , "userId" => $id, "userName" => $user['name'] ,
                        "image" =>  $user['image'] , "isTeacher" => $user['isTeacher'] 
                        , "email" => $user['email']
                    ]); 
                      
                }
                else
                {
                    return response()->json([
                        "status" => "false" , "Message" => "There is a problem in this user"
                    ]);
                }
            }
        } 
        else
        {
            return response(["status" => "false", "errors" => $Data->messages()->first()]);
        }
        
    }

    /**
     * DeleteProfile
     * 
     * 
     * this function will delete the profile of the user 
     *  
     * 
     * 
     * @response 201 {
     * 
     *  "status": "true" ,
     *  "Message":  "user is deleted"
     *}
     *
     * @response 404 {
     *  "status": "false" ,
     *  "Message": "There are a problem in this user or already deleted"
     * }
     */
    public function deleteProfile ()
    {
        $id = auth()->user()['id']; 
        if( User::find($id) )
        {
            $user =User::find($id);
            $user->delete();
            return response()->json([
                "status" => "true" , "Message" => "user is deleted"
            ]);   
        }
        else
        {
            return response()->json([
                "status" => "false" , "Message" => "There are a problem in this user or already deleted"
            ]);
        }
    }

    /**
     * viewTeacherExams
     * 
     * 
     * this function will view the infromations about the eaxams of the theacher
     *  
     * 
     * 
     * @response 201 {
     *  "status": "success",
     *  "pages": [
     *   {
     *     "id": 1,
     *     "duration": "00:00:00",
     *     "instructions": "Answer",
     *     "created_at": "2019-08-21 00:00:00",
     *     "updated_at": "2019-08-21 00:00:00"
     *   }
     *     ]
     *}
     *
     * @response 404 {
     *  "status": "false" ,
     *  "Message": "There are a problem in this user or already deleted"
     * }
     */
    public function viewTeacherExams(Request $request){
        $Validations    = array(
            "teacherId"  => "integer",
        );
        $Data = validator::make($request->all(), $Validations);
        if (!($Data->fails())) 
        {
            if(!empty($request["teacherId"]))
            {
                $exams=DB::select('select * from exams e where e.id IN 
                (select examId from exams_teachers et where et.teacherId=?)',
                 [$request['teacherId']]);
                
                if($exams != NULL){
                    return Response::json(array(
                        'status' => 'success',
                        'pages' => $exams),
                        200);
                }
                else{
                    return Response::json(array(
                        'status' => 'failed',
                        'Message' => 'No data for this teacher'),
                        400);
                }
            }
            else
            {
                $tID = auth()->user()['id'];
                $exams=DB::select('select * from exams e where e.id IN 
                (select examId from exams_teachers et where et.teacherId=?)',
                [$tID]);
                 
                if($exams != NULL){
                    return Response::json(array(
                        'status' => 'success',
                        'pages' => $exams),
                        200);
                }
                else{
                    return Response::json(array(
                        'status' => 'failed',
                        'Message' => 'No data for this teacher'),
                        400);
                }
               
            }
        } 
        else
        {
            return response(["status" => "false", "errors" => $Data->messages()->first()]);
        }
    }

    /**
     * ViewStudentExams
     * 
     * 
     * this function will view the infromations about the eaxams of the student
     *  
     * 
     * 
     * @response 201 {
     *  "status": "success",
     *  "pages": [
     *   {
     *     "id": 1,
     *     "code": "2006",
     *     "duration": "00:00:00",
     *     "instructions": "Answer",
     *     "teacherId": 3,
     *     "created_at": "2019-08-21 00:00:00",
     *     "updated_at": "2019-08-21 00:00:00"
     *   }
     *     ]
     *}
     *
     * @response 404 {
     *  "status": "false" ,
     *  "Message": "There are a problem in this user or already deleted"
     * }
     */
    public function ViewStudentExams(Request $request){
        $Validations    = array(
            "studentId"  => "integer",
        );
        $Data = validator::make($request->all(), $Validations);
        if (!($Data->fails())) 
        {
            if(!empty($request["studentId"]))
            {
                
                $exams=DB::select('select * from exams e where e.id IN 
                (select examId from students_exams et where et.studentId=?)',
                [$request['studentId']]);

                if($exams != NULL){
                    return Response::json(array(
                        'status' => 'success',
                        'pages' => $exams),
                        200);
                }
                else{
                    return Response::json(array(
                        'status' => 'failed',
                        'Message' => 'No data for this student'),
                        400);
                }
            }
            else
            {
                $sID = auth()->user()['id'];
                $exams=DB::select('select * from exams e where e.id IN 
                (select examId from students_exams et where et.studentId=?)',
                [$sID]);
                
                if($exams != NULL){
                    return Response::json(array(
                        'status' => 'success',
                        'pages' => $exams),
                        200);
                }
                else{
                    return Response::json(array(
                        'status' => 'failed',
                        'Message' => 'No data for this student'),
                        400);
                }
            }
        } 
        else
        {
            return response(["status" => "false", "errors" => $Data->messages()->first()]);
        }
    }
}
