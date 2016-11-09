@extends('layouts.app')
@section('content')
    <section class="profile-page">
        <div class="content">
            <div class="all-content">
                <div class="profile-content">
                    <div class="slide-bar">
                        <div class="user-info">
                            <img src="{{ url('images/users/' .$user->user()->avatar) }}" alt="" class="img-circle">
                            <p>{{ $user->user()->name }}</p>
                        </div>
                        <div class="tabs">
                            <ul>
                                <li id="sidebar-account"><a href="{{ url('/user/account') }}" class="tab"><i class="fa fa-user" aria-hidden="true"></i> Dashboard </a></li>
                                <li id="sidebar-notification"><a href="{{ url('/user/notification/all') }}" class="tab"><i class="fa fa-globe" aria-hidden="true"></i> Notification </a> <span>{{ $unread_notifications_count != 0 ? $unread_notifications_count :'' }}</span></li>
                                <li id="sidebar-questions"><a href="{{ url('user/questions') }}" class="tab"><i class="fa fa-question-circle-o" aria-hidden="true"></i> Questions </a></li>
                                {{--<li ><a href="#" class="tab"><i class="fa fa-picture-o" aria-hidden="true"></i> Images</a></li>--}}
                                {{--<li ><a href="#" class="tab"><i class="fa fa-video-camera" aria-hidden="true"></i> Video</a></li>--}}
                                <li id="sidebar-account-details"><a href="{{ url('/user/account-details') }}" class="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
                            </ul>
                        </div>
                    </div>
                    @yield('account-content')
                </div>
            </div>
        </div>

        {{--</div>--}}

        {{--</div>--}}

    </section>
@endsection
@section('script')
    <script src="{{ url('js/tabs.js') }}"></script>
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script src="{{ url('js/footer.js') }}"></script>
    <script src="{{ url('js/activeSidebar.js') }}"></script>
    @yield('account-script')
@endsection