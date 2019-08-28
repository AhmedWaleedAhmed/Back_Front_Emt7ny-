<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use App\User;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordMail;
use Illuminate\Support\Carbon;
class ResetPasswordController extends Controller
{
    
  /**
     * sendPasswordResetLink
     * 
     * 
     * this function will send email to the user to reset the password 
     *  
     */
    public function sendemail(Request $request)
    {
         if(!$this->validateemail($request->email))
         {
              return $this->failedResponse();
         }
         $this->send($request->email);
         return $this->successResponse();
    }


    public function validateemail($email){
         // NOTE 
         // we put double ! before the next statment to make the result of this 
         // statment boolean
         return !!User::where(['email'=>$email])->first();
    }

    public function failedResponse(){
     return response()->json([
          "status" => "false" , "Message" => "Email doesn't exist"
      ]); 
    }

    public function send($email){
          $token = $this->createToken($email);
          Mail::to($email)->send(new ResetPasswordMail($token));
    }

    public function successResponse(){
     return response()->json([
          "status" => "true" , "Message" => "Email is sent, please check your mail"
      ]); 
    }

    public function createToken($email){
         $oldToken = DB::table('password_resets')->where(['email'=>$email])->first();
         if ($oldToken)
         {
              return $oldToken;
         }
         $token =str_random(60);
         $this->saveToken($token,$email);
         return $token;
    }

    public function saveToken($token, $email){
          DB::table('password_resets')->insert([
               'email' => $email,    
               'token' => $token,
               'created_at' => Carbon::now()
          ]);
    }
}
