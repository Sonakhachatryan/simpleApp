@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ url('css/checkbox.css') }}">
@endsection

@section('content')
    <section class="registration-page">
        <div class="content">
            <div class="registration-title">
                <div class="registration-title-words">
                    <h2>CREATE AN ACCOUNT</h2>
                </div>
            </div>

            <div class="all-content">
                <div class="registration-forms">
                    <div id="success">
                        @include('layouts.messages')
                    </div>
                    <form method="POST" action="{{ url('/register') }}" id="register">

                        <div class="left-block-forms">
                            {{ csrf_field() }}
                            <div class="input-blocks {{ $errors->has('name') ? ' has-error' : '' }}">
                                <label for="name-user">Name</label>
                                <input type="text" id="name-user" placeholder="Name" lian="22" data-value="Name"
                                       name="name" value="{{ old('name') }}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class="input-blocks {{ ($errors->has('email')  || isset($email_error)  )? ' has-error': '' }}">
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

                            <div class="input-blocks {{ $errors->has('promo_code') ? ' has-error' : '' }} ">
                                <label for="promo_code">Promo Code</label>
                                <input type="text" id="promo_code" placeholder="Promo Code"
                                       data-value="Promo Code" name="promo_code" value="{{ old('promo_code') }}">

                                @if ($errors->has('promo_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('promo_code') }}</strong>
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="right-block-forms">
                            <h3>Become a Gold User</h3>

                            <input type="hidden" name="status" value="silver" id="status">
                            <div class="forms-check">
                                <p>
                                    <span class="silver">Silver</span>
                                    <span class="right-form-top">
                                <input type="checkbox" name="checkbox1" id="checkbox1" class="ios-toggle"/>
                                <label for="checkbox1" class="checkbox-label"></label>
                            </span> <span class="gold">Gold</span></p>

                            </div>

                            <h3>Pay with</h3>


                            <input type="hidden" name="payment" value="paypal" id="payment">
                            <input type="hidden" name="stripeToken" value="" id="stripeToken">
                            <div class="forms-check ">
                                <div class="payment-methods">
                                    <img src="{{ url('images/inner-images/paypal.png') }}" alt="paypal"><span
                                            class="right-form-bottom">

                                    <input type="checkbox" name="checkbox2" id="checkbox2" class="ios-toggle"/>

                                    <label for="checkbox2" class="checkbox-label"></label>
                                </span><img src="{{ url('images/inner-images/card.png') }}" alt="cards" class="cards">
                                </div>
                            </div>
                        </div>
                        <div class="payment-errors has-error"></div>

                        <button type="submit" id="submit">Register</button>
                    </form>
                </div>
            </div>

        </div>

        </div>

        </div>

        <div class="transperent" id="modal">

            <div class="all-content">
                <div class="pop-up ">

                    <div class="title-popUP">
                        <h2>Payment Info</h2>
                    </div>

                    <div class="pop-content">
                        <img src="{{ url('images/inner-images/cards-pop.png') }}" alt="cards">
                        <form action="#">

                            <input type="text" placeholder="Card number" class="card-number" id="card-number1">


                            <div class="pop-row ">


                                <div class="pop-sections">
                                    <label> Expiries</label>

                                    <div>
                                        <select id="month" onchange="" size="1" class="card_expiry_month">
                                            <option value="01" selected="selected">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>

                                        <input id="year_start" class="card_expiry_year" type="number" min="2016"
                                               max="2036"/>
                                    </div>
                                </div>

                                <div>
                                    <label for="digits" class="digits-label">CVC</label>
                                    <div>
                                        <input type="text" placeholder="3 digits" id="digits" class="card_cvc">
                                    </div>
                                </div>
                            </div>

                            <div class="names-pop">
                                <input type="text" placeholder="First name">
                                <input type="text" placeholder="Last name" class="last-name">
                            </div>
                            <button type="button" id="modal-button">Pay</button>
                        </form>

                    </div>


                </div>

            </div>
        </div>

    </section>
@endsection

@section('script')
    <script src="{{ url('js/map.js') }}"></script>
    <script src="{{ url('js/focusInput.js') }}"></script>
    <script src="{{ url('js/checkbox.js') }}"></script>

    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script type="text/javascript">
        Stripe.setPublishableKey('{{env('STRIPE_KEY')}}');

        $('#checkbox1').on('change', function () {
            if ($(this).is(':checked'))
                $('#status').val('gold');
            else
                $('#status').val('silver');
            console.log($('#status').val());
        })

        $('#checkbox2').on('change', function () {
            if ($(this).is(':checked'))
                $('#payment').val('card');
            else
                $('#payment').val('paypal');
        })

        var button_click = false;
        $('#modal-button').on('click', function () {
            $('#modal').attr('class', 'hidden');
            button_click = true;
            stripe();
        })
        var ban;
        $("#month").on("click", function () {
            var selElementVal = $(this).find(":selected").attr('value');
            ban = selElementVal;
        })

        $('#modal').on('hidden', function () {
            if (!button_click) {
                $('#payment').val('paypal');
                $("#checkbox2").prop("checked", false);
            }

        })

        function stripe() {
            var card_number = $('#card-number1').val();
            var card_cvc = $('#digits').val();
            var card_expiry_month = ban;
            var card_expiry_year = $('#year_start').val();

            console.log(card_cvc);

            Stripe.card.createToken({
                number: card_number,
                cvc: card_cvc,
                exp_month: card_expiry_month,
                exp_year: card_expiry_year,
            }, function (status, response) {

                var $form = $('#register');
                if (response.error) { // Problem!
                    // Show the errors on the form
                    $('.payment-errors').text('Something wenth wrong, please refresh the page, and try again');
                    $('#submit').prop('disabled', true); // Re-enable submission

                } else { // Token was created!
                    // Get the token ID:
                    var token = response.id;
                    // Insert the token into the form so it gets submitted to the server:
                    $('#stripeToken').val(token);


                }
            })
        }


    </script>

@endsection
