<body>

<!------------------------------------- Wrapper Starts ------------------------------------->
<div id="wrapper">

    <!--------------------------------- Header Wrapper Starts ---------------------------------->
    <header id="header-wrapper">
        <header id="header-wrapper">
            <div class="custom-container">
                <div class="header-container">
                    <div class="menu-items">
                        <ul>
                            <li><a href="">Discover <span><img src="{{asset('client_assets')}}/images/dropdown.png"></span></a>
                                <ul>
                                    <li><a href="#">Fundraisers</a></li>
{{--                                    <li><a href="">Success Stories</a></li>--}}
                                </ul>
                            </li>
                            <li><a href="">Fundraiser for <span><img src="{{asset('client_assets')}}/images/dropdown.png"></span></a>
                                <ul>
                                        <li><a href="#">See All</a></li>
                                </ul>
                            </li>
                            <li>
                                <span><img src="{{asset('client_assets')}}/images/search.png" ></span>
                                <input type="text" placeholder="Search">
                            </li>
                        </ul>
                    </div>
                    <div class="logo-container">
                        <a href="#">
                            <img src="{{asset('client_assets')}}/img/logo/agni-logo.png" alt="site-logo">
                        </a>
                    </div>
                    <div class="login-request">
                        @guest
                            <div class="login">
                                <a href="#">
                                    <img src="{{asset('client_assets')}}/img/icons/user.png" alt="">
                                    <span> Login</span>
                                </a>
                            </div>
                        @endguest
                        @auth
                            <div class="login">
{{--                                <a href="">--}}
                                    <form action="#" id="logout_form" method="POST">
                                        @csrf
                                    </form>
                                    <img src="{{asset('client_assets')}}/img/icons/user.png" alt="">
                                    <a href="#" onclick="submitLogoutForm()">Username<i class="fa fa-arrow-circle-o-down"></i></a>
{{--                                </a>--}}
                            </div>
                        @endauth
                        <div class="request">
                            <a href="#" class="covid-btn btn-red">Request</a>
                        </div>
                    </div>
                </div>
                <div class="navigation">
                    <div class="close-btn">
                        <img src="{{asset('client_assets')}}/img/icons/close.png">
                    </div>
                </div>
            </div>
        </header>
    </header>
    <!---------------------------------- Header Wrapper Ends ----------------------------------->



    <!-------------------------------- Content Wrapper Starts ---------------------------------->
    <div id="content-wrapper">

        <script>
            function submitLogoutForm() {
                $("#logout_form").submit();
            }
        </script>
