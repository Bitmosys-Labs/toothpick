@extends('frontend.layouts.main')

@section('content')

    {{--<div class="page vertical-align text-center" data-animsition-in="fade-in" data-animsition-out="fade-out">--}}
    {{--        <div class="page-content vertical-align-middle animation-slide-top animation-duration-1">--}}
    {{--          <div class="brand">--}}
    {{--            <img class="brand-img" src="{{ asset('admin_assets') }}/assets//images/logo.png" alt="...">--}}
    {{--            <h2 class="brand-text">{{ __('Login') }}</h2>--}}
    {{--          </div>--}}
    {{--          <p>Sign into your pages account</p>--}}
    {{--            @if(Session::has('message'))--}}
    {{--                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>--}}
    {{--            @endif--}}
    {{--            <form method="POST" action="{{ route('login') }}">--}}
    {{--                @csrf--}}
    {{--            <div class="form-group">--}}
    {{--              <label class="sr-only" for="email">{{ __('E-Mail Address') }}</label>--}}
    {{--              <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>--}}

    {{--                    @error('username')--}}
    {{--                        <span class="invalid-feedback" role="alert">--}}
    {{--                            <strong>{{ $message }}</strong>--}}
    {{--                        </span>--}}
    {{--                    @enderror--}}

    {{--            </div>--}}

    {{--            <div class="form-group">--}}
    {{--              <label class="sr-only" for="inputPassword">{{ __('Password') }}</label>--}}
    {{--                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

    {{--                                @error('password')--}}
    {{--                                    <span class="invalid-feedback" role="alert">--}}
    {{--                                        <strong>{{ $message }}</strong>--}}
    {{--                                    </span>--}}
    {{--                                @enderror--}}
    {{--            </div>--}}
    {{--            <div class="form-group clearfix">--}}
    {{--              <div class="checkbox-custom checkbox-inline checkbox-primary float-left">--}}
    {{--                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}
    {{--                <label for="remember">Remember me</label>--}}
    {{--              </div>--}}
    {{--            </div>--}}
    {{--            <button type="submit" class="btn btn-primary btn-block">Sign in</button>--}}
    {{--          </form>--}}

    {{--          <footer class="page-copyright page-copyright-inverse">--}}
    {{--            <p></p>--}}
    {{--            <p>?? {{ date('Y') }}. All RIGHT RESERVED.</p>--}}

    {{--          </footer>--}}
    {{--        </div>--}}
    {{--      </div>--}}

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <div class="wrapper">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->

            <!-- Login Form -->
            <div class="fadeIn first">
                <img class="navbar-brand-logo" src="{{ asset('admin_assets/photos/logo.png') }}" title="TDS" style="height: 10%; width: 20%; margin-top: 20px; margin-bottom: 20px;">
            </div>
            <form style="width: 100%" method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" id="username"  class="fadeIn second" name="username" placeholder="Email" value="{{ old('username') }}" required autocomplete="username">
                {{--            @error('username')--}}
                {{--                <span class="invalid-feedback" role="alert">--}}
                {{--                    <strong>{{ $message }}</strong>--}}
                {{--                </span>--}}
                {{--            @enderror--}}
                {{--            <input type="password" id="password" class="fadeIn third" name="login" placeholder="password">--}}
                <input id="password" type="password" class="fadeIn third" name="password" required autocomplete="current-password" placeholder="password">
                {{--            @error('password')--}}
                {{--                <span class="invalid-feedback" role="alert">--}}
                {{--                    <strong>{{ $message }}</strong>--}}
                {{--                </span>--}}
                {{--            @enderror--}}

                <input type="submit" class="fadeIn fourth" value="Log In">
            </form>
            <!-- Remind Passowrd -->
            {{--        <div id="formFooter">--}}
            {{--            <a class="underlineHover" href="#">Forgot Password?</a>--}}
            {{--        </div>--}}

        </div>
    </div>
@endsection
