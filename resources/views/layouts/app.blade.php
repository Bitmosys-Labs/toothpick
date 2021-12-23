<!DOCTYPE html>
<html class="no-js css-menubar" lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="bootstrap admin template">
  <meta name="author" content="">

  <title>Login | Remark Admin Template</title>

  <link rel="apple-touch-icon" href="{{ asset('admin_assets') }}/assets/images/apple-touch-icon.png">
  <link rel="shortcut icon" href="{{ asset('admin_assets') }}/assets/images/favicon.ico">

  <!-- Stylesheets -->
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/css/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/css/site.min.css">

  <!-- Plugins -->
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/jquery-mmenu/jquery-mmenu.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/assets/examples/css/pages/login.css">


  <!-- Fonts -->
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="{{ asset('admin_assets') }}/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

    <!--[if lt IE 9]>
    <script src="{{ asset('admin_assets') }}/global/vendor/html5shiv/html5shiv.min.js"></script>
  <![endif]-->

    <!--[if lt IE 10]>
    <script src="{{ asset('admin_assets') }}/global/vendor/media-match/media.match.min.js"></script>
    <script src="{{ asset('admin_assets') }}/global/vendor/respond/respond.min.js"></script>
  <![endif]-->

  <!-- Scripts -->
  <script src="{{ asset('admin_assets') }}/global/vendor/breakpoints/breakpoints.js"></script>

  <script>
    Breakpoints();
  </script>
</head>
<body class="animsition page-login layout-full page-dark">
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->
        @yield('content')

      <!-- Page -->

      <!-- End Page -->


      <!-- Core  -->
      <script src="{{ asset('admin_assets') }}/global/vendor/babel-external-helpers/babel-external-helpers.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/jquery/jquery.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/popper-js/umd/popper.min.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/bootstrap/bootstrap.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/animsition/animsition.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/mousewheel/jquery.mousewheel.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/asscrollbar/jquery-asScrollbar.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/asscrollable/jquery-asScrollable.js"></script>

      <!-- Plugins -->
      <script src="{{ asset('admin_assets') }}/global/vendor/jquery-mmenu/jquery.mmenu.min.all.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/switchery/switchery.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/intro-js/intro.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/screenfull/screenfull.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/slidepanel/jquery-slidePanel.js"></script>
      <script src="{{ asset('admin_assets') }}/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>

      <!-- Scripts -->
      <script src="{{ asset('admin_assets') }}/js/Component.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Plugin.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Base.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Config.js"></script>

      <script src="{{ asset('admin_assets') }}/assets/js/Section/Menubar.js"></script>
      <script src="{{ asset('admin_assets') }}/assets/js/Section/Sidebar.js"></script>
      <script src="{{ asset('admin_assets') }}/assets/js/Section/PageAside.js"></script>
      <script src="{{ asset('admin_assets') }}/assets/js/Section/GridMenu.js"></script>

      <!-- Config -->
      <script src="{{ asset('admin_assets') }}/js/config/colors.js"></script>
      <script src="{{ asset('admin_assets') }}/assets/js/config/tour.js"></script>
      <script>Config.set('assets', '{{ asset('admin_assets') }}/assets');</script>

      <!-- Page -->
      <script src="{{ asset('admin_assets') }}/assets/js/Site.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Plugin/asscrollable.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Plugin/slidepanel.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Plugin/switchery.js"></script>
      <script src="{{ asset('admin_assets') }}/js/Plugin/jquery-placeholder.js"></script>

      <script>
        (function(document, window, $){
          'use strict';

          var Site = window.Site;
          $(document).ready(function(){
            Site.run();
          });
        })(document, window, jQuery);
      </script>

    </body>
    </html>
