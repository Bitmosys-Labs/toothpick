@extends('frontend.layouts.main')

@section('content')


{{--    <div id="login-page">--}}
{{--        <div class="custom-container ">--}}
{{--            <div class="inner common-flex">--}}
{{--                <div class="img-container item">--}}
{{--                    <img src="{{ asset('client_assets') }}/img/login.png">--}}
{{--                </div>--}}
{{--                <div class="login-form item">--}}
{{--                    <div class="inner center-align">--}}
{{--                        <div class="logo-with-text ">--}}
{{--                            <div class="logo-container">--}}
{{--                                <img src="{{ asset('client_assets') }}/img/logo/agni-logo.png" alt="">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="form-wrapper">--}}
{{--                            <div class="section-title">--}}
{{--                                <h2>Login Portal</h2>--}}
{{--                            </div>--}}
{{--                            @if(Session::has('message'))--}}
{{--                                <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>--}}
{{--                            @endif--}}
{{--                            <form method="POST" action="{{ route('login') }}">--}}
{{--                                @csrf--}}
{{--                                <div class="fields">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="email">{{ __('E-Mail Address') }}</label>--}}
{{--                                        <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus>--}}{{--                                    id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username" autofocus--}}
{{--                                        @error('username')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label for="password">{{ __('Password') }}</label>--}}
{{--                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}
{{--                                        @error('password')--}}
{{--                                        <span class="invalid-feedback" role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="action">--}}
{{--                                    <button type="submit" class="covid-btn btn-red">--}}
{{--                                        Login--}}
{{--                                    </button>--}}

{{--                                    <h5><a href="">FORGOT PASSWORD?</a></h5>--}}
{{--                                    <p>© {{ date('Y') }}. All RIGHT RESERVED.</p>--}}
{{--                                </div>--}}
{{--                            </form>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
<!-- Main content -->
<section>
    <div class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center min-vh-100">
            <div class="col-md-6 col-lg-5 col-xl-5 py-6 py-md-0">
                <div class="card shadow zindex-100 mb-0">
                    <div class="card-body px-md-5 py-5">
                        <div class="mb-5">
                            <h6 class="h3">Login</h6>
                            <p class="text-muted mb-0">Sign in to your account to continue.</p>
                        </div>
                        <span class="clearfix"></span>
                        @if(Session::has('message'))
                            <p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('message') }}</p>
                        @endif
                        <form method="POST" action="{{ route('login') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label class="form-control-label">Email address</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="user"></i></span>
                                    </div>
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" placeholder="example@mail.com" required>
                                    @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group mb-0">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <label class="form-control-label">Password</label>
                                    </div>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i data-feather="key"></i></span>
                                    </div>
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-block btn-primary">Sign in</button></div>
                        </form>
                    </div>
{{--                    <div class="card-footer px-md-5"><small>Not registered?</small>--}}
{{--                        <a href="#" class="small font-weight-bold">Create account</a></div>--}}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
