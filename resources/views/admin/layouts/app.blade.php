<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
@include('admin.partial.head')
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    @include('admin.partial.header')
    @include('admin.partial.sidebar')
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    @include('admin.layouts.error')
                </div>
            </div>
            @hasSection('content')
                @yield('content')
            @else
                There was an error reading the content...
            @endif
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.1.0
        </div>
        <strong>Copyright &copy; 2019-2020 <a target="_blank" href="https://beeknights.com">Beeknights</a>.</strong> All rights
        reserved.
    </footer>
</div>
<!-- ./wrapper -->
@include('admin.partial.js')
<script>
    $(function(){
        $('.delete-item').click(function(){
            if (confirm("Are you sure?")) {
                $("#" + $(this).data('form')).submit();
            }
        });
    });
    $('div.alert').not('.alert-important').delay(5000).fadeOut(350);
</script>
@yield('footer')
</body>
</html>
