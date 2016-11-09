@extends('layouts.app')

@section('content')
    <section class="contact-page">
        <div class="row">
            <div class="back">
                <div id="map" class = "hidden" style="width:100%;height:383px"></div>
                {{--<iframe id="map"  class="hidden map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d27681.31632455856!2d-94.33307875982915!3d29.859528244780524!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x863eda2bb6d1c729%3A0x7a7d5bb657a377bc!2sHamshire%2C+TX+77622!5e0!3m2!1sen!2s!4v1474977847178" width="100%" height="383" frameborder="0" style="border:0" allowfullscreen></iframe>--}}
            </div>
        </div>

        <div class="content">

            <div class="content-info">
                <div class="all-content">
                    <div class="info-blocks">
                        <img src="{{ url('images/inner-images/adress.png') }}" alt="adress">
                        @foreach($address as $address)
                            <p>{{ $address->value }}</p>
                        @endforeach
                    </div>
                    <div class="info-blocks">
                        <img src="{{ url('images/inner-images/call.png') }}" alt="call">
                        @foreach($phones as $phone)
                            <p>{{ $phone->value }}</p>
                        @endforeach
                    </div>
                    <div class="info-blocks">
                        <img src="{{ url('images/inner-images/mail.png') }}" alt="mail">
                        @foreach($emails as $email)
                            <p>{{ $email->value }}</p>
                        @endforeach
                    </div>
                </div>
            </div>


            <div class="contact-form">
                <div class="form-title">
                    <div class="form-title-words">
                        <h2>Contact Form</h2>
                    </div>
                </div>

                <div class="form-content">
                    <div class="all-content">
                        <div class="forms-content-center">
                            <form action="{{ url('contact') }}" method="post">
                                {{ csrf_field() }}
                                <div class="text-fields">
                                    <input type="text" placeholder="Name:" name="name">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif


                                    <input type="text" placeholder="Phone:" name="phone">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                    <input type="email" placeholder="E-Mail:" name="email">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <textarea name="content"  cols="30" rows="10" placeholder="Message"></textarea>
                                @if ($errors->has('content'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('content') }}</strong>
                                    </span>
                                @endif

                                <button type="submit" id="send">Send</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>



            <div class="follow">
                <div class="all-content">
                    <div class="follow-content">
                        <p>Follow Us:</p>
                        <div class="follow-links">
                            <a href="{{ url($facebook->value) }}"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                            <a href="{{ url($twitter->value) }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                            <a href="{{ url($pinterest->value) }}"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                            <a href="{{ url($google->value) }}"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>

    </section>
    @endsection

@section('script')
    <script src="{{ url('js/map.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?callback=myMap&key=AIzaSyDua4uvlc6LziS9nIs1pKJjMWQo_VlVhfE"></script>
    @endsection