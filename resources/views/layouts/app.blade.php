<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @yield('header')
</head>
<body>
    <div id="app">
        @include('layouts.nav')

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <h2 class="panel-heading">@yield('title')</h2>

                        <div class="panel-body">
                            @include('layouts.error')
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
            }
        });

        $(function(){
            $('.delete-item').click(function(){
                if (confirm("Are you sure?")) {
                    $("#" + $(this).data('form')).submit();
                }
            });
        });
    </script>
    @yield('footer')
</body>
</html>
