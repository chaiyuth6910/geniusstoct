<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\v1\APIBaseController as APIBaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Validator;

class RegisterTokenController extends APIBaseController
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'gender'=>'required',
            'department'=>'required',
            'isAdmin'=>'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] = $user->createToken('MyApp')->accessToken;
        $success['name'] = $user->fullname;
        
        return $this->sendResponse($success, 'User register successfully.');
    }
}
