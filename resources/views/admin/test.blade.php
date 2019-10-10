@extends('admin.layouts.app')

@section('title', 'Test')

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h3>Form 1</h3>
        {!! Form::open(['route' => ['test.store']]) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Name"]) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
            @endif
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'Email') !!}
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "Email"]) !!}
            @if ($errors->has('email'))
                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
            @endif
        </div>

        <div class="form-group">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary form-control']) !!}
        </div>

        {!! Form::close() !!}

        <hr>

        <h3>Form 2</h3>
        {!! Form::open(['route' => ['test.store'], 'class' => 'form-horizontal']) !!}

        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
            {!! Form::label('name', 'Name', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
            {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => "Name"]) !!}
            @if ($errors->has('name'))
                <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
            @endif
            </div>
        </div>

        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
            {!! Form::label('email', 'E-Mail Address', ['class' => 'col-md-3 control-label']) !!}
            <div class="col-md-9">
            {!! Form::text('email', null, ['class' => 'form-control', 'placeholder' => "E-Mail Address"]) !!}
            @if ($errors->has('email'))
                <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
            @endif
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-8 col-md-offset-3">
            {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
            </div>
        </div>

        {!! Form::close() !!}

        <hr>

        <button class="btn btn-success" id="button-test-ajax-get">Test AJAX GET</button>
        <p id="text-test-ajax-get"></p>
        <button class="btn btn-success" id="button-test-ajax-post">Test AJAX POST</button>
        <p id="text-test-ajax-post"></p>
    </div>
</div>
@endsection

@section('footer')
<script>
    $(function () {
        $('#button-test-ajax-get').click(function () {
            $.get('{{ url('test/user') }}')
                .done(function (data) {
                    $('#text-test-ajax-get').text(JSON.stringify(data));
                })
                .fail(function (error) {
                    $('#text-test-ajax-get').text(error.responseJSON.message);
                });
        });

        $('#button-test-ajax-post').click(function () {
            $.post('{{ url('test/user') }}')
                .done(function (data) {
                    $('#text-test-ajax-post').text(JSON.stringify(data));
                })
                .fail(function (error) {
                    $('#text-test-ajax-post').text(error.responseJSON.message);
                });
        });
    });
</script>
@endsection
