<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Beeknights')</title>
    <base href="{{asset('')}}">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="adminAsset/vendor/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="adminAsset/vendor/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="adminAsset/vendor/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="adminAsset/dist/css/adminLTE.min.css">
    <!-- adminAssetLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="adminAsset/dist/css/skins/_all-skins.min.css">

    <!-- Date Picker -->
    {{--<link rel="stylesheet" href="adminAsset/vendor/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css">--}}

    <!-- Daterange picker -->
    {{--<link rel="stylesheet" href="adminAsset/vendor/bootstrap-daterangepicker/daterangepicker.css">--}}

    {{--<link rel="stylesheet" href="adminAsset/plugins/datatables/dataTables.bootstrap.css">--}}

    {{--<link rel="stylesheet" href="adminAsset/plugins/jquery-confirm/jquery-confirm.min.css">--}}

    <link rel="shortcut icon" href="" type="image/vnd.microsoft.icon">

    {{--<link rel="stylesheet" href="adminAsset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">--}}

    <!-- Switchery -->
    {{--<link href="adminAsset/plugins/switchery/dist/switchery.min.css" rel="stylesheet">--}}

    <!-- PNotify -->
    {{--<link href="adminAsset/plugins/pnotify/dist/pnotify.css" rel="stylesheet">--}}
    {{--<link href="adminAsset/plugins/pnotify/dist/pnotify.buttons.css" rel="stylesheet">--}}
    {{--<link href="adminAsset/plugins/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">--}}

    {{--<link rel="stylesheet" href="adminAsset/plugins/iCheck/all.css">--}}

    <link rel="stylesheet" href="css/style.css">

    @yield('header')

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>