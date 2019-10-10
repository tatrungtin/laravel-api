<?php

namespace App\Http\Controllers\API;

use App\Http\Responses\APIResponse;
use Illuminate\Http\Request;
use JWTAuth;
use Validator;
use Auth;

use Tymon\JWTAuth\Exceptions\JWTException;

class JwtController extends APIController
{
    public function login(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:255',
            'password'=> 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::error400('Invalid Credentials', $validator->errors());
        }
        $credentials = $request->only('email', 'password');
        try {
            if (! $token = JWTAuth::attempt($credentials)) {
                return APIResponse::error401('Invalid Credentials. Email or password is wrong');
            }
        } catch (JWTException $e) {
            return APIResponse::error($e);
        }

        $user = JWTAuth::toUser($token);
        return APIResponse::success(compact('token', 'user'));
    }

}
