<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\APIBaseController as APIBaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use DB;

class LoginTokenController extends APIBaseController
{
    public function index()
    {
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();

            // ลบรายการ Token เก่าของ user นี้ออก
            $token_delete =  DB::table('oauth_access_tokens')->where('user_id', $user->id)->delete();
            
            if($token_delete){
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                return $this->sendResponse($success, 'User login successfully.');
            }

        }
        else{
            return $this->sendError('Unauthorised.');
        }
    }
}
