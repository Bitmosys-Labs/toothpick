<!-- Created by Ashish Shrestha -->
<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>{{ $page['title'] ?? 'Lifeline' }}</title>

    <?php $cssVersion = "1.1"; ?>

<!------------------------ Meta Starts ---------------------->
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('client_assets')}}/img/site_logo.png">

    <meta property="og:title" content=""/>
    <meta property="og:type"   content="website" />
    <meta property="og:url"    content="" />
    <meta property="og:site_name" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:image:alt" content="">
    <meta property="og:description" content="">
    <!------------------------- Meta Ends ----------------------->


    <!----------------------- Fonts Starts ---------------------->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <!------------------------ Fonts Ends ----------------------->


    <!-------------------- Components Starts -------------------->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <link href="{{asset('client_assets')}}/css/bowercomponent/slick-theme.css" rel="stylesheet">
    <link href="{{asset('client_assets')}}/css/bowercomponent/slick.css" rel="stylesheet">
    <link href="{{asset('client_assets')}}/css/bowercomponent/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    <link href="{{asset('client_assets')}}/css/bowercomponent/lightbox.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
    <!--------------------- Components Ends --------------------->


    <!-------------------- Site Style Starts -------------------->
    <link href="{{asset('client_assets')}}/css/global.css" rel="stylesheet">
    <link href="{{asset('client_assets')}}/css/thestyles.css" rel="stylesheet">
    <link href="{{asset('client_assets')}}/css/responsive.css" rel="stylesheet">
    <!--------------------- Site Style Ends --------------------->

    <!-------------------- Site Script Starts -------------------->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <!-------------------- Site Script Ends -------------------->

</head>
@include('frontend.includes.header')
<div>
    @yield('content')
</div>
@include('frontend.includes.footer')
