<!-- Main Header -->
<header class="main-header">
    <!-- Logo -->
    <a href="{{ url('/admin/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LT</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>LTE Laravel </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
            {{--<li class="dropdown messages-menu">--}}
            {{--<!-- Menu toggle button -->--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="fa fa-envelope-o"></i>--}}
            {{--<span class="label label-success">4</span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li class="header">{{ trans('adminlte_lang::message.tabmessages') }}</li>--}}
            {{--<li>--}}
            {{--<!-- inner menu: contains the messages -->--}}
            {{--<ul class="menu">--}}
            {{--<li><!-- start message -->--}}
            {{--<a href="#">--}}
            {{--<div class="pull-left">--}}
            {{--<!-- User Image -->--}}
            {{--<img src="/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>--}}
            {{--</div>--}}
            {{--<!-- Message title and timestamp -->--}}
            {{--<h4>--}}
            {{--{{ trans('adminlte_lang::message.supteam') }}--}}
            {{--<small><i class="fa fa-clock-o"></i> 5 mins</small>--}}
            {{--</h4>--}}
            {{--<!-- The message -->--}}
            {{--<p>{{ trans('adminlte_lang::message.awesometheme') }}</p>--}}
            {{--</a>--}}
            {{--</li><!-- end message -->--}}
            {{--</ul><!-- /.menu -->--}}
            {{--</li>--}}
            {{--<li class="footer"><a href="#">c</a></li>--}}
            {{--</ul>--}}
            {{--</li><!-- /.messages-menu -->--}}

            <!-- Notifications Menu -->
            {{--<li class="dropdown notifications-menu">--}}
            {{--<!-- Menu toggle button -->--}}
            {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
            {{--<i class="fa fa-bell-o"></i>--}}
            {{--<span class="label label-warning">10</span>--}}
            {{--</a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li class="header">{{ trans('adminlte_lang::message.notifications') }}</li>--}}
            {{--<li>--}}
            {{--<!-- Inner Menu: contains the notifications -->--}}
            {{--<ul class="menu">--}}
            {{--<li><!-- start notification -->--}}
            {{--<a href="#">--}}
            {{--<i class="fa fa-users text-aqua"></i> {{ trans('adminlte_lang::message.newmembers') }}--}}
            {{--</a>--}}
            {{--</li><!-- end notification -->--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="footer"><a href="#">{{ trans('adminlte_lang::message.viewall') }}</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        @if($unread_notifications_count != 0)
                            <span class="label label-danger">{{ $unread_notifications_count }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                @foreach($unread_notifications as $notification)
                                    <li><!-- Task item -->
                                        <a href="{{ url('admin/notification/changeStatus', $notification->id) }}">
                                            <p>{{ $notification->notification->content }}</p>
                                        </a>
                                    </li><!-- end task item -->
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{ url('admin/notification/all') }}">Show All Notifications</a>
                        </li>
                    </ul>
                </li>
                {{--{{dd(auth('admin')->check())}}--}}
                @if (!auth('admin')->check())
                    <li><a href="{{ url('/admin/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/admin/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
            @else
                <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{asset('/img/user2-160x160.jpg')}}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ $admin->user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{asset('/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image"/>
                                <p>
                                    {{ $admin->user()->name }}
                                    <small>{{ trans('adminlte_lang::message.login') }} Nov. 2012</small>
                                </p>
                            </li>
                            <!-- Menu Body -->
                            <li class="user-body">
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.followers') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.sales') }}</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">{{ trans('adminlte_lang::message.friends') }}</a>
                                </div>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#"
                                       class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.profile') }}</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/admin/logout') }}"
                                       class="btn btn-default btn-flat">{{ trans('adminlte_lang::message.signout') }}</a>
                                </div>
                            </li>
                        </ul>
                    </li>
            @endif

            <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>
