@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-md-12">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <p>You are logged in!</p>
    </div>
</div>
@endsection
