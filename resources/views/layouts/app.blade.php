<!DOCTYPE html>
<html>

<head>

    <title>KEEPING IT SIMPLE SOLUTIONS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('libs/bootstrap.min.css ') }}">
    <link rel="stylesheet" href="{{ url('libs/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ url('css/scss/keeping.css') }}">
    <link rel="stylesheet" href="{{ url('css/scss/hover.css') }}">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{ url('css/sweetalert.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/custom.css') }}">
    @yield('style')
</head>


<body>
<header>
    <nav class="navbar ">
        <div class="container-fluid menu">
            <div class="row">
                <div class="navbar-header left-menu">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand pull-right" href="{{ url('/') }}">KEEPING IT SIMPLE SOLUTIONS LLC</a>
                </div>
                <div class="collapse navbar-collapse right-menu" id="myNavbar">
                    <div class="all-search hidden">
                        <form method="post" action="{{ url('search') }}" id="nav-search">
                            {{ csrf_field() }}
                        <input type="text" class="search-block " placeholder="Search">
                        <i class="fa fa-times text-right close-search" aria-hidden="true"></i>
                            <i class="fa fa-search mr20 search-submit" aria-hidden="true"></i>

                        </form>
                    </div>
                    <ul class="nav navbar-nav">
                        <li><a id= 'menu-home' href="{{ url('/home') }}">Home</a></li>

                        <li><a id= 'menu-about' href="{{ url('about') }}"> About Us </a></li>
                        <li><a id= 'menu-partnerWithUS' href="{{ url('partnerWithUS') }}"> Partner With Us</a></li>
                        <li><a id= 'menu-search' href="{{ url('search') }}"> Services</a></li>
                        <li><a id= 'menu-contact' href="{{ url('contact') }}"> Contact </a></li>
                        @if (isset($user))
                            <li><a href="#" class="search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li>
                                <a href="#"><img src="{{ url('images/users', $user->user()->avatar) }}" alt=""
                                                 class="img-circle" id="profile-menu"></a>
                                <div id="profile-menu-dropdown">
                                    <i class="fa fa-caret-up arrow-up" aria-hidden="true"></i>
                                    <ul>
                                        <li><a href="{{ url('/user/account') }}"><i class="fa fa-user"
                                                                                    aria-hidden="true"></i> My
                                                Account</a></li>
                                        <li><a href="{{ url('user/notification/all') }}"><i class="fa fa-globe"
                                                                                            aria-hidden="true"></i>
                                                Notification {{ $unread_notifications_count != 0 ? $unread_notifications_count :'' }}</a></li>
                                        <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out"
                                                                              aria-hidden="true"></i> Log out</a></li>
                                    </ul>
                                </div>
                            </li>
                        @elseif(isset($marketer))
                            <li><a href="#" class="search"><i class="fa fa-search" aria-hidden="true"></i></a></li>
                            <li>
                                <a href="#"><img src="{{ url('images/marketers', $marketer->user()->avatar) }}" alt=""
                                                 class="img-circle" id="profile-menu"></a>
                                <div id="profile-menu-dropdown">
                                    <i class="fa fa-caret-up arrow-up" aria-hidden="true"></i>
                                    <ul>
                                        <li><a href="{{ url('/marketer/account') }}"><i class="fa fa-user"
                                                                                    aria-hidden="true"></i> My
                                                Account</a></li>
                                        <li><a href="{{ url('marketer/notification/all') }}"><i class="fa fa-globe"
                                                                                            aria-hidden="true"></i>
                                                Notification {{ $unread_notifications_count }}</a></li>
                                        <li><a href="{{ url('marketer/logout') }}"><i class="fa fa-sign-out"
                                                                              aria-hidden="true"></i> Log out</a></li>
                                    </ul>
                                </div>
                            </li>
                        @else

                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">Login <span
                                            class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <form method="POST" action="{{ url('/login') }}">
                                        {{ csrf_field() }}
                                        <li class="login user">
                                            <span id="user"><i class="fa fa-user" aria-hidden="true"></i></span>
                                            <input type="email" placeholder="Email" name="email">
                                        </li>
                                        <li class="login password">
                                            <span id="password"><i class="fa fa-unlock-alt"
                                                                   aria-hidden="true"></i></span>
                                            <input type="password" placeholder="Password" name="password">
                                        </li>
                                        <div class="{{ ($errors->has('password') || $errors->has('email'))? ' has-error' : '' }}">
                                            <span class="help-block">
                                        <strong>
                                             @if ($errors->has('email'))
                                                {{ $errors->first('email') }}
                                            @elseif($errors->has('password'))
                                                {{ $errors->first('password') }}
                                            @endif
                                                </strong>
                                              </span>
                                        </div>

                                        <li>Not a member?<a href="{{ url('/register') }}">Register now</a></li>
                                        <button type="submit" class="btn btn-xs btn-primary">Log In</button>
                                    </form>
                                </ul>
                            </li>
                            <li><a href="#" class="search"><i class="fa fa-search" aria-hidden="true"></i></a></li>


                        @endif


                    </ul>


                </div>
            </div>
        </div>
    </nav>
</header>

@yield('content')

<footer>

    <div class="footer-content">

        <div class="col-sm-3"><img src="{{ url('images/inner-images/logo-footer.png') }}" alt=""></div>
        <div class="col-xs-2">

            <h5>PRODUCT</h5>
            <a>Features</a>
            <a>Pricing</a>
            <a>Terms of Service</a>

        </div>

        <div class="col-xs-2">

            <h5>COMPANY</h5>
            <a>About Us</a>
            <a>Blog</a>
            <a>Contact Us</a>


        </div>

        <div class="col-xs-2">

            <h5>LEARN MORE</h5>
            <a>Support</a>
            <a>Referral Program</a>


        </div>

        <div class="col-sm-3 logo-links">
            <div class="pull-right logo-links-content ">
                <h5>CONNECT WITH US</h5>


                <a href="#"><i class="fa fa-facebook facebook" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-google-plus google" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a>
                <a href="#"><i class="fa fa-wifi wifi" aria-hidden="true"></i></a>

                <p>Copyright Info</p>
            </div>

        </div>

    </div>


</footer>


<script src="{{ url('https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js') }}"></script>
<script src="{{ url('js/bootstrap.min.js') }}"></script>
<script src="{{ url('js/search.js') }}"></script>
<script src="{{ url('js/login.js') }}"></script>
<script src="{{ url('js/dropdown.js') }}"></script>
<script src="{{ url('js/custom.js') }}"></script>
<script src="{{ url('js/sweetalert.min.js') }}"></script>
<script src="{{ url('js/activeMneu.js') }}"></script>
@yield('script')
</body>
</html>