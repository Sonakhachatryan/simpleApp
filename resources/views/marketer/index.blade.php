@extends('layouts.app')


@section('content')
    <section class="profile-page">


        <div class="content">

            <div class="all-content">

                <div class="profile-content">


                    <div class="slide-bar">

                        <div class="user-info">

                            <img src="{{ url('images/marketers/' .$marketer->user()->avatar) }}" alt="" class="img-circle">
                            <p>{{ $marketer->user()->name }}</p>
                        </div>
                        <div class="tabs">
                            <ul>
                                <li ><a href="{{ url('/marketer/account') }}" class="tab"><i class="fa fa-user" aria-hidden="true"></i> Dashboard </a></li>
                                <li ><a href="{{ url('/marketer/commissions/') }}" class="tab"><i class="fa fa-globe" aria-hidden="true"></i> Commissions </a></li>
                                <li ><a href="{{ url('/marketer/notification/all') }}" class="tab"><i class="fa fa-globe" aria-hidden="true"></i> Notifications </a> <span>{{ $unread_notifications_count != 0 ? $unread_notifications_count :'' }}</span></li>
                                <li ><a href="{{ url('/marketer/users') }}" class="tab"><i class="fa fa-globe" aria-hidden="true"></i> Users </a> </li>
                                <li ><a href="{{ url('/marketer/account-details') }}" class="tab"><i class="fa fa-cog" aria-hidden="true"></i> Settings</a></li>
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
    @yield('account-script')
@endsection