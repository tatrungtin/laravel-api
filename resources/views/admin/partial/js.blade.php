<script src="adminAsset/vendor/jquery/dist/jquery.min.js"></script>
<script src="adminAsset/vendor/jquery-ui/jquery-ui.min.js"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="adminAsset/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
{{--<script src="adminAsset/vendor/raphael/raphael.min.js"></script>--}}
{{--<script src="adminAsset/vendor/jquery-knob/dist/jquery.knob.min.js"></script>--}}

<!-- daterangepicker -->
{{--<script src="adminAsset/vendor/moment/min/moment.min.js"></script>--}}
{{--<script src="adminAsset/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>--}}

<!-- datepicker -->
{{--<script src="adminAsset/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>--}}

<!-- Slimscroll -->
<script src="adminAsset/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<!-- FastClick -->
<script src="adminAsset/vendor/fastclick/lib/fastclick.js"></script>

{{--<script src="adminAsset/plugins/iCheck/icheck.min.js"></script>--}}

<!-- adminAssetLTE App -->
<script src="adminAsset/dist/js/adminlte.min.js"></script>

<script src="js/sidebar.js"></script>
{{--<script src="adminAsset/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>--}}

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name=csrf-token]').attr('content')
        }
    });
    $("#sidebar_toggle").click(function() {
        if(localStorage.getItem("sidebar")){
            localStorage.removeItem("sidebar");
        } else {
            localStorage.setItem("sidebar", "sidebar-collapse");
        }
    });

    if(localStorage.getItem("sidebar")){
        $('body').addClass('sidebar-collapse');
    }
</script>

{{--<script src="adminAsset/plugins/loading/loadingoverlay.min.js"></script>--}}

<!-- PNotify -->
{{--<script src="adminAsset/plugins/pnotify/dist/pnotify.js"></script>--}}
{{--<script src="adminAsset/plugins/pnotify/dist/pnotify.buttons.js"></script>--}}
{{--<script src="adminAsset/plugins/pnotify/dist/pnotify.nonblock.js"></script>--}}

{{--<script src="adminAsset/plugins/switchery/dist/switchery.min.js"></script>--}}
{{--<script src="adminAsset/plugins/jquery-confirm/jquery-confirm.min.js"></script>--}}