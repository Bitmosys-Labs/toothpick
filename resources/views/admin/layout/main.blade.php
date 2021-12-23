<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="bootstrap admin template">
    <meta name="author" content="">

    <title>Dashboard | Admin</title>

    <link rel="apple-touch-icon" href="{{ asset('admin_assets') }}/assets/images/apple-touch-icon.png">
    <link rel="shortcut icon" href="{{ asset('admin_assets') }}/assets/images/favicon.ico">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/css/bootstrap-extend.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/css/site.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/animsition/animsition.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/asscrollable/asScrollable.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/switchery/switchery.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/intro-js/introjs.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/slidepanel/slidePanel.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/flag-icon-css/flag-icon.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/chartist/chartist.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/examples/css/dashboard/v1.css">


    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/fonts/weather-icons/weather-icons.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/fonts/web-icons/web-icons.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/fonts/brand-icons/brand-icons.min.css">
    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <link rel="stylesheet" href="{{ asset('admin_assets') }}/css/thestyle.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/css/bootstrap-datepicker.css">

    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/fonts/material-design/material-design.min.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-fixedheader-bs4/dataTables.fixedheader.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-fixedcolumns-bs4/dataTables.fixedcolumns.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-rowgroup-bs4/dataTables.rowgroup.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-scroller-bs4/dataTables.scroller.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-select-bs4/dataTables.select.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-responsive-bs4/dataTables.responsive.bootstrap4.css">
    <link rel="stylesheet"
          href="{{ asset('admin_assets') }}/global/vendor/datatables.net-buttons-bs4/dataTables.buttons.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/examples/css/tables/datatable.min.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/examples/css/tables/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/examples/css/forms/validation.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

<!--[if lt IE 9]>
    <script src="{{ asset('admin_assets') }}/global/vendor/html5shiv/html5shiv.min.js"></script>
    <![endif]-->

<!--[if lt IE 10]>
    <script src="{{ asset('admin_assets') }}/global/vendor/media-match/media.match.min.js"></script>
    <script src="{{ asset('admin_assets') }}/global/vendor/respond/respond.min.js"></script>
    <![endif]-->

    <!-- Scripts -->
    <script src="{{ asset('admin_assets') }}/global/vendor/jquery/jquery.js"></script>
    <script src="{{ asset('admin_assets') }}/global/vendor/breakpoints/breakpoints.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

    <script>
        Breakpoints();
    </script>
</head>

<body class="animsition dashboard">

        @include('admin.includes.header')
        @include('admin.includes.menu')
        <div class="page">
            @yield('content')
        </div>
        @include('admin.includes.footer')

        <!-- Core  -->
        <script src="{{ asset('admin_assets') }}/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/popper-js/umd/popper.min.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/bootstrap/bootstrap.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/animsition/animsition.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/mousewheel/jquery.mousewheel.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/asscrollable/jquery-asScrollable.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>

        <!-- Plugins -->
        <script src="{{ asset('admin_assets') }}/global/vendor/switchery/switchery.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/intro-js/intro.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/screenfull/screenfull.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/slidepanel/jquery-slidePanel.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/skycons/skycons.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/chartist/chartist.min.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/aspieprogress/jquery-asPieProgress.min.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/jvectormap/jquery-jvectormap.min.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/jvectormap/maps/jquery-jvectormap-au-mill-en.js"></script>
        <script src="{{ asset('admin_assets') }}/global/vendor/matchheight/jquery.matchHeight-min.js"></script>

        <!-- Scripts -->
        <script src="{{ asset('admin_assets') }}/global/js/Component.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Plugin.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Base.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Config.js"></script>

        <script src="{{ asset('admin_assets') }}/assets/js/Section/Menubar.js"></script>
        <script src="{{ asset('admin_assets') }}/assets/js/Section/GridMenu.js"></script>
        <script src="{{ asset('admin_assets') }}/assets/js/Section/Sidebar.js"></script>
        <script src="{{ asset('admin_assets') }}/assets/js/Section/PageAside.js"></script>
        <script src="{{ asset('admin_assets') }}/assets/js/Plugin/menu.js"></script>

        <script src="{{ asset('admin_assets') }}/global/js/config/colors.js"></script>
        <script src="{{ asset('admin_assets') }}/assets/js/config/tour.js"></script>
        <script>Config.set('assets', '{{ asset('admin_assets') }}/assets');</script>

        <!-- Page -->
        <script src="{{ asset('admin_assets') }}/assets/js/Site.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Plugin/asscrollable.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Plugin/slidepanel.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Plugin/switchery.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Plugin/matchheight.js"></script>
        <script src="{{ asset('admin_assets') }}/global/js/Plugin/jvectormap.js"></script>

        <script src="{{ asset('admin_assets') }}/assets/examples/js/dashboard/v1.js"></script>


        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <script src="{{ asset('admin_assets') }}/jquery-datatable/jquery.dataTables.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/skin/bootstrap/js/dataTables.bootstrap.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/dataTables.buttons.min.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/buttons.flash.min.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/jszip.min.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/pdfmake.min.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/vfs_fonts.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/buttons.html5.min.js"></script>
        <script src="{{ asset('admin_assets') }}/jquery-datatable/extensions/export/buttons.print.min.js"></script>

        <script src="{{ asset('admin_assets') }}/global/vendor/jquery-ui/widgets/datepicker.js"></script>
        <script src="{{ asset('admin_assets') }}/js/Plugin/bootstrap-datepicker.js"></script>
        <script src="{{ asset('admin_assets') }}/js/jquery.ajaxuploader.js"></script>

        <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
</body>

</html>
