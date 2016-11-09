@extends('layouts.app')

@section('style')
    <link href="{{ url('css/simple-sidebar.css') }}" rel="stylesheet">
@endsection
@section('content')
    <div class="container">
        <div id="wrapper">

            <!-- Sidebar -->
            <div id="sidebar-wrapper">
                <ul class="sidebar-nav">
                    <li class="sidebar-brand">
                        <a href="#">
                            Start Bootstrap
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/marketer/account') }}">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ url('/marketer/commissions') }}">Commissions</a>
                    </li>
                    <li>
                        <a href="{{ url('/marketer/account-details') }}">My Account</a>
                    </li>
                </ul>
            </div>
            <!-- /#sidebar-wrapper -->

            <!-- Page Content -->
            <div id="page-content-wrapper">
                @yield('account-content')
            </div>
            <!-- /#page-content-wrapper -->

        </div>
    </div>
@endsection
@section('script')
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    @yield('account-script')
@endsection