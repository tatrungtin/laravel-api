<?php

namespace App\Http\Controllers\Api;

use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Http\Responses\APIResponse;
use Validator,Hash,Auth;

class UserController extends Controller
{
    public function index(Request $request){
        $keyword = $request->input('keyword','');
        $limit = (int)$request->input('limit',config("constants.ITEM_PER_PAGE"));
        $query = User::query();
        if(!empty($keyword)){
            $query->where(function($query)use($keyword){
            	$query->where("name","like","%$keyword%")
            	->orwhere("email","like","%$keyword%");
            });
        }
        $user = $query->paginate($limit);
        return APIResponse::success(compact('user'));
    }

    public function create(){
        $role = Role::all();
        return APIResponse::success(compact('role'));
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|email|max:191|unique:users,email',
            'password'=> 'required|max:191|min:6',
            'name' => 'required|max:191',
            'role_id' => 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $data = $request->all();
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return APIResponse::success(compact('user'));
    }

    public function edit(User $user){
        $role =  Role::all();
        return APIResponse::success(compact('role','user'));
    }

    public function update(Request $request,User $user){
        $data = $request->only(['name','email','role_id']);
        $validator = Validator::make($data, [
            'email' => 'required|string|email|max:191|unique:users,email,'.$user->id,
            'name' => 'required|max:191',
            'role_id' => 'required'
        ]);
        if ($validator->fails()) {
            return APIResponse::fail([],$validator->errors()->first());
        }
        $user->update($data);
        return APIResponse::success(compact('user'));
    }

    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            return APIResponse::fail([],'You can\'t delete yourself!');
        }
        $user->delete();
        return APIResponse::success([],'Delete user successfully!');
    }
}
