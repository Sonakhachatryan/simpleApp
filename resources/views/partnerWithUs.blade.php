@extends('layouts.app')

@section('content')
<section class="marketer-page">
    <div class="back">
        <div class="all-content">
            <div class="back-content">
                <h1>Are you a marketeR?</h1>
               <a href="{{ url('marketer/auth') }}"> <button>join us</button></a>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="strategy-title">
            <div class="strategy-title-words">
                <h2>Our strategy</h2>
            </div>
        </div>


        <div class="all-content">
            <div class="strategy-content">
                <div class="strategy-content">
                    <div class="strategy-top">
                        <img src="{{ url('images/inner-images/strategy-top.png') }}" alt="strategy">
                        <p>{{ $record->right_text }}</p>

                    </div>
                    <div class="strategy-bottom">
                        <img src="{{ url('images/inner-images/strategy-bottom.png') }}" alt="strategy">
                        <p>{{ $record->left_text }}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="strategy-bottom-all">
            <div class="all-content">
                <div class="strategy-bottom-content">
                    <h4>{{ $record->heading1 }}</h4>
                    <h2>{{ $record->heading2 }}</h2>
                    <a href="{{ url('marketer/auth') }}"><button>Sign up now!</button></a>
                </div>
            </div>
        </div>


        <div class="bottom-link">
            <div class="all-content">
                <p>{{ $record->heading3 }}</p>
                <a href="{{ url('search') }}">go to our services  <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
            </div>
        </div>
    </div>
</section>

@endsection