@extends('admin.layouts.app')
@section('title','Change password')
@section('content')
    <div class="box">
        <div class="box-header with-border">
              <h3 class="box-title">@yield('title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <form class="form-horizontal" method="POST" action="{{ route('postChangePassword') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="old_password" class="col-md-4 control-label">Old Password</label>

                            <div class="col-md-6">
                                <input id="old_password" type="password" class="form-control" name="old_password" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="new_password" class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                                <input id="new_password" type="password" class="form-control" name="new_password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="confirm_password" type="password" class="form-control" name="confirm_password" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
@endsection
