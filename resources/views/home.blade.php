@extends('layouts.app')

@section('content')
    <section class="home-page">
        <div class="row">
            <div class="back">
                <div class="back-content">
                    <h1>{{ $header->value }}</h1>
                    <h2>{{ $content->value }}</h2>
                </div>
            </div>
            <div class="content">
                <div class="service">
                    <h2 class="text-center">Our Services</h2>
                    <div class="service-content col-sm-8">
                        <div class="col-sm-3 block">
                            <h4>Search</h4>
                            <div class="overlay">
                                <article class="border-hover">
                                    <p class="top-block">{{ $search->value }}</p>
                                    <a href="{{ url('/search') }}" class="bottom-block">view more</a>
                                </article>
                            </div>
                        </div>
                        <div class="col-sm-3 block">
                            <h4>Register Now</h4>
                            <div class="overlay">
                                <article class="border-hover">

                                    <p class="top-block">{{ $register->value }}</p>
                                    <a href="{{ url('/register') }}" class="bottom-block">view more</a>
                                </article>
                            </div>
                        </div>
                        <div class="col-sm-3 block">
                            <h4>Marketers part</h4>
                            <div class="overlay">
                                <article class="border-hover">
                                    <p class="top-block">{{ $marketer1->value }}  </p>
                                    <a href="{{ url('/partnerWithUS')}}" class="bottom-block">view more</a>
                                </article>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="about">
                    <h2>About Us</h2>
                    <div class="about-content">
                        <p>{{ $about->value }} </p>
                        <a href="{{ url('about') }}">read more >></a>
                    </div>
                </div>
                <div class="test">
                    <div class="test-title">
                        <div class="test-title-cont">
                            <h2>Testimonials</h2>
                        </div>
                    </div>
                    <div class="test-content">
                        <div class="test-cont">
                            <div class="left-block">
                                <div class="test-video col-md-6">
                                    <video controls >
                                        <source src="{{ url('videos/video/Paul.mp4') }}" type="video/mp4">
                                    </video>
                                </div>
                            </div>
                            <div class="right-block">
                                <div class="test-message col-md-6">
                                    <div class="massage-block">
                                        <div class="messages">
                                            <div class="message">
                                                <img src="{{ url('images/inner-images/profile.png') }}" class="img-circle" alt="photo" width="105" height="96">
                                                <p class="number-message">66</p>
                                                <p class="message-text">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Has been the industry's standard.</p>
                                                <p class="massage-author text-right">Mark Jhonson</p>
                                            </div>

                                            <div class="message">
                                                <img src="{{ url('images/inner-images/profile.png') }}" class="img-circle" alt="photo" width="105" height="96">
                                                <p class="number-message">66</p>
                                                <p class="message-text">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Has been the industry's standard.</p>
                                                <p class="massage-author text-right">Mark Jhonson</p>
                                            </div>
                                            <div class="message">
                                                <img src="{{ url('images/inner-images/profile.png') }}" class="img-circle" alt="photo" width="105" height="96">
                                                <p class="number-message">66</p>
                                                <p class="message-text">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Has been the industry's standard.</p>
                                                <p class="massage-author text-right">Mark Jhonson</p>
                                            </div>
                                            <div class="message">
                                                <img src="{{ url('images/inner-images/profile.png') }}" class="img-circle" alt="photo" width="105" height="96">
                                                <p class="number-message">66</p>
                                                <p class="message-text">Lorem Ipsum is simply dummy text of the printing and
                                                    typesetting industry. Has been the industry's standard.</p>
                                                <p class="massage-author text-right">Mark Jhonson</p>
                                            </div>
                                        </div>

                                        <div class="add">
                                            <input type="text" placeholder="add a comment">
                                            <button>add</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
