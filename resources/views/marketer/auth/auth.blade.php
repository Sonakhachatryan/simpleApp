@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('css/checkbox.css') }}">
@endsection

@section('content')
    <section class="registration-page">
        <div class="content">
            <div class="registration-title">
                <div class="registration-title-words">
                    <h2>Authentication</h2>
                </div>
            </div>

            <div class="all-content">
                <div class="registration-forms">
                    <form method="POST" action="{{ url('marketer/login') }}" id="login">
                        {{ csrf_field() }}
                        <div class="right-block-forms right-block-forms-out pull-left" id="forms-out">
                            <p class="form-title-sign">Sign in</p>
                            <div class="input-blocks {{ $errors->has('login_email') ? ' has-error' : '' }}">
                                <label for="email-user">E-Mail</label>
                                <input type="email" id="email-user" placeholder="E-Mail" data-value="E-Mail"
                                       name="login_email" value="{{ old('login_email') }}">

                                @if ($errors->has('login_email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login_email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="input-blocks {{ $errors->has('login_password') ? ' has-error' : '' }}">
                                <label for="password-user">Password</label>
                                <input type="password" id="password-user" placeholder="Password" data-value="Password"
                                       name="login_password">

                                @if ($errors->has('login_password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('login_password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <button type="submit" id="submit-login">Login</button>
                        </div>
                    </form>
                    <form method="POST" action="{{ url('marketer/register') }}" id="register"
                          enctype="multipart/form-data">
                        <div class=" pull-right left-block-forms" id="forms-out-register">

                            <p class="form-title-sign">Create Account</p>
                            {{ csrf_field() }}
                            <div class="input-blocks {{ $errors->has('reg_name') ? ' has-error' : '' }}">
                                <label for="name-user">Name</label>
                                <input type="text" id="name-user" placeholder="Name" lian="22" data-value="Name"
                                       name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-blocks {{ ($errors->has('email') || isset($email_error))? ' has-error' : '' }}">
                                <label for="email-user">E-Mail</label>
                                <input type="email" id="email-user" placeholder="E-Mail" data-value="E-Mail"
                                       name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @elseif(isset($email_error))
                                    <span class="help-block">
                                        <strong>{{ $email_error }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="input-blocks {{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password-user">Password</label>
                                <input type="password" id="password-user" placeholder="Password" data-value="Password"
                                       name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="input-blocks {{ $errors->has('password_confirmation') ? ' has-error' : '' }} ">
                                <label for="password-user-confirm">Confirm Password</label>
                                <input type="password" id="password-user-confirm" placeholder="Confirm Password"
                                       data-value="Confirm Password" name="password_confirmation">

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <a href="{{ url('marketer/auth/contract') }}" class="btn btn-large  link-contract"><i
                                        class="icon-download-alt"> </i> Download Contract </a>
                            <div class="input-blocks {{ $errors->has('terms') ? ' has-error' : '' }} ">
                                <label for="terms" id="contract-label">Upload Contract</label>
                                <input type="file" id="terms" name="terms" class="hidden">

                                @if ($errors->has('terms'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('terms') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <button type="submit" id="submit">Register</button>

                        </div>
                    </form>


                </div>
            </div>

        </div>

        </div>

        </div>
    {{--<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">--}}
    {{--Launch demo modal--}}
    {{--</button>--}}

    <!-- Modal -->
        {{--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="margin-top: 50px">--}}
        {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
        {{--<div class="modal-header">--}}
        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
        {{--<span aria-hidden="true">&times;</span>--}}
        {{--</button>--}}
        {{--<h4 class="modal-title" id="myModalLabel">Modal title</h4>--}}
        {{--</div>--}}
        {{--<div class="modal-body">--}}
        {{--Contact --}}
        {{--</div>--}}
        {{--<div class="modal-footer">--}}
        {{--<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
        {{--</div>--}}
    </section>
@endsection

@section('script')
    <script src="{{ url('js/footer.js') }}"></script>
    <script>
        (function () {
            var fileToUpload = [];
            var contract = $("#terms");

            contract.on('change', FileSelectHandler);
            function FileSelectHandler(e) {
                var file = e.target.files || e.dataTransfer.files;
                if (file.length != 0) {
                    fileToUpload.push(file);
                    $('#contract-label').html(file[0].name);
                }
                else{
                    $('#contract-label').html("Upload Contract");
                }
            }


        })();
    </script>
@endsection

