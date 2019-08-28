<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ChangePasswordRequest;
use DB;

class ChangePasswordController extends Controller
{
    public function process(ChangePasswordRequest $request){
        return $this->getPasswordResetTableRow($request)->count()>0 ? $this->changePassword() : 
        $this->tokenNotFound();
    }

    private function getPasswordResetTableRow ($request){
        return DB::table('password_resets')->where(['email'=>$request->email,
         'token'=>$request->resetToken]);
    }

    private function tokenNotFound(){
        return response()->json([
            "status" => "false" , "Message" => "Token or Email is incorrect"
        ]);
    }

    private function changePassword(){
        return "Ahmed";
    }
}
