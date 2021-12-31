<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{route('frontend.home')}}" style="height: 100px; width: 100px;">
            <img alt="Image placeholder" src="{{asset('uploads/site_logo.svg')}}" id="navbar-logo" style="height: 80px; width: 80px;">
        </a>

        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mt-4 mt-lg-0 ml-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('frontend.home')}}">Home</a>
                </li>
{{--                <li class="nav-item dropdown dropdown-animate" data-toggle="hover">--}}
{{--                    <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>--}}
{{--                    <div class="dropdown-menu dropdown-menu-single">--}}
{{--                        <a href="index.html" class="dropdown-item">Homepage</a>--}}
{{--                        <a href="about.html" class="dropdown-item">About us</a>--}}
{{--                        <a href="contact.html" class="dropdown-item">Contact</a>--}}
{{--                        <div class="dropdown-divider"></div>--}}
{{--                        <a href="login.html" class="dropdown-item">Login</a>--}}
{{--                    </div>--}}
{{--                </li>--}}
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('about')}}">About</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('booking')}}">Book Staff</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('job')}}">Career</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{route('contact')}}">Contact</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
