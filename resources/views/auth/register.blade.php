<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Beeknights | Register</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="adminAsset/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="adminAsset/vendor/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="adminAsset/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="adminAsset/plugins/iCheck/square/blue.css">
    <link rel="shortcut icon" href="" type="image/vnd.microsoft.icon">
</head>
<body class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a href=""><b>Bee</b>knights</a>
    </div>
    <div class="login-box-body" style="border: 4px solid rgba(36, 36, 37, 0.5);">
        <p class="login-box-msg">Register new account</p>
        <form action="{{ route('register') }}" method="post" spellcheck="false" autocomplete="on">
            {{ csrf_field() }}
            @include('admin.layouts.error')
            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }} has-feedback">
                    <input type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus placeholder="Name">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus placeholder="E-Mail Address">
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>
            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }} has-feedback">
                <input id="password" type="password" class="form-control" name="password" required placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
            </div>
            <div class="form-group has-feedback">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required placeholder="Confirm Password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8">
                     <a href="{{ route('login') }}" data-toggle="modal">Already have account?</a>
                </div>
                <div class="col-xs-4">
                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                </div>
            </div>
        </form>

        
    </div>
</div>

@include('admin.partial.js')
<script src="adminAsset/plugins/iCheck/icheck.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>