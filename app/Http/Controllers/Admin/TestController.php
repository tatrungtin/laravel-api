<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\TestRequest;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.test');
    }

    public function store(TestRequest $request)
    {
        flash('Create image success!', 'success');
        return back()->withInput();
    }

    public function user()
    {
        $user = Auth::user();
        return response()->json(compact('user'),200);
    }
}
