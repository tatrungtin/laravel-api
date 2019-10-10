@extends('admin.layouts.app')
@if (!empty($user))
    @section('title','Edit User')
@else
   @section('title','Add User')
@endif
@section('content')
    <div class="box news-form">
        <div class="box-header with-border">
              <h3 class="box-title">@yield('title')</h3>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    @if (!empty($user))
                    {!! Form::model($user, ['method' => 'PATCH', 'route' => ['users.update', $user->id]]) !!}
                    @else
                    {!! Form::open(['route' => ['users.store']]) !!}
                    @endif

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        @if (!empty($user))
                            {!! Form::email('email', null, ['readonly' => 'readonly', 'class' => 'form-control', 'placeholder' => "Email"]) !!}
                        @else
                            {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => "Email"]) !!}
                        @endif
                    </div>

                    <div class="form-group">
                        {!! Form::label('name', 'Name') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Name"]) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('role_id', 'Role') !!}
                        {!!Form::select('role_id', $roles, !empty($user) ? $user->role->id : null, ['class' => 'form-control'])!!}
                    </div>

                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-2 margin-b-5">{!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}</div>
                            <div class="col-sm-2 margin-b-5"><a href="{{ route("users.index") }}" class="btn btn-primary form-control">Back</a></div>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection