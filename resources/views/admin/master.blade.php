<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>後台</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
</head>
@guest
    <body class="hold-transition sidebar-mini login-page">
    @yield('content')
@else
    <body class="hold-transition sidebar-mini layout-fixed">
    <!-- Site wrapper -->
        <div class="wrapper">

        @include('admin.header')
        <!-- Main Sidebar Container -->
        @include('admin.sidebar')

        <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
            @yield('content')
            <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            @include('admin.footer')
        </div>
        <!-- ./wrapper -->
@endguest

<!-- jQuery -->
<script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('dist/js/demo.js') }}"></script>
<script>
    $("#cardToggle").on("click", function() {
        $('.card').each((i, val) => {
            $(val).CardWidget('toggle');
        });
    });

    $(".widget-block").on("click", function (e) {
        $(e.target).parent().CardWidget('toggle');
    });

    function deleteImg() {
        let elem = document.querySelector('#qrCodeImg');
        elem.parentNode.removeChild(elem);
        document.getElementById('deleteImgInput').checked = true;
    }

    function exportSubmit(type) {
        let elem = document.getElementById('orderTable');
        if (type === 'order') {
            elem.action = '{{ route('admin.dashboard') }}';
        } else if (type === 'excel') {
            elem.action = '{{ route('admin.order.export', 'excel') }}';
        } else if (type === 'pdf') {
            elem.action = '{{ route('admin.order.export', 'pdf') }}'
        }
        if (elem.checkValidity()) {
            elem.submit();
        }
    }

    function selectAll() {
        $('.item-check-box').each((i, val) => {
            val.checked = !val.checked;
        });
    }
</script>
<script src="{{ asset('js/admin.js') }}"></script>
</body>
</html>
