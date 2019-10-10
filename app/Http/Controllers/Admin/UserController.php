<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator, Hash, Excel;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        $q = trim(urldecode($request->input('q')));
        $query = User::latest();
        if ($q) {
            $query->where('email', 'LIKE', "%" . $q . "%")
                ->orWhere('name', 'LIKE', "%" . $q . "%");
        }
        if($request->get('export')){
            $type =$request->get('export');
            $items = $query->get();
            $captions = ['Id', 'Name', 'Email', 'Created at', 'Updated at'];
            export($items, $captions, $type,'List_User', 'sheet1');
            return back();
        }
        
        $items = $query->paginate(config("constants.ITEM_PER_PAGE"));
        return view('admin.users.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.form', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param UserCreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {

        try {
            User::create([
                'email' => $request->input("email"),
                'name' => $request->input("name"),
                'role_id' => $request->input("role_id"),
                'password' => bcrypt('123123123'),
            ]);
        } catch (\Exception $e) {
            flash($e->getMessage(), 'danger');
            return back()->withInput();
        }

        flash('Add user successfully!', 'success');
        return redirect(route('users.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::pluck('name', 'id');
        return view('admin.users.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserUpdateRequest $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->all());

        flash('Update user successfully!', 'success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        if (Auth::user()->id == $user->id) {
            flash('You can\'t delete yourself!', 'danger');
            return back();
        }

        $user->delete();
        flash('Delete user successfully!', 'success');
        return redirect(route('users.index'));
    }

    public function getChangePassword()
    {
        return view('auth.passwords.chang_password');

    }
    public function postChangePassword(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'old_password'=> 'required|string|min:6',
            'new_password' => 'required|string|min:6',
            'confirm_password' => 'required|string|min:6|same:new_password'
        ]);
        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $current_password = Auth::User()->password;
        if(!Hash::check($data['old_password'], $current_password)){
            flash('Please enter correct old password', 'danger');
            return back();
        }
        $user_id = Auth::User()->id;                       
        $obj_user = User::find($user_id);
        $obj_user->password = Hash::make($data['new_password']);;
        $obj_user->save();
        flash('Change password successfully!', 'success');
        return redirect(route('home'));
    }
}
