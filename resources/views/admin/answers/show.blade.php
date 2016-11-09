@extends('admin.layouts.app')

@section('content')
    {{--{{ dd($answer->images) }}--}}
    <h1>Answer
        <a href="{{ url('admin/answer/' . $answer->id .'/edit') }}" class="btn btn-primary btn-xs"
           title="Edit Answer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        <a href="{{ url('admin/answer/' . $answer->id .'/tags') }}" class="btn btn-warning btn-xs"
           title="Tags"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"/></a>
        <a href="{{ url('admin/answer/' . $answer->id .'/approve') }}" class="btn btn-success btn-xs"
           title="Approve Answer"><span class="glyphicon glyphicon-ok" aria-hidden="true"/></a>
        {{--{!! Form::open([--}}
        {{--'method'=>'post',--}}
        {{--'url' => ['/user/question/answer', $question->id],--}}
        {{--'style' => 'display:inline'--}}
        {{--]) !!}--}}
        {{--<input type="hidden" name="_method" value="DELETE">--}}
        {{--<button type='button' data="{{csrf_token()}}" value="{{ $question->id }}"--}}
        {{--class='delete btn btn-danger btn-xs' title='Delete Answer'>--}}
        {{--<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Answer"/>--}}
        {{--</button>--}}
        {{--<button id="delete" hidden type="submit"></button>--}}
        {{--{!! Form::close() !!}--}}
    </h1>
    <hr/>
    <div id="success">
        @include('layouts.messages')
    </div>
    <h3>{{ $question->content }}</h3>
    <hr/>
    <h4><span>User Name:</span>
        <span>
        @if($answer->alias)
                <a href="{{ url('admin/users', $answer->user->id) }}">{{ $answer->user->alias }}</a>
            @else
                <a href="{{ url('admin/users', $answer->user->id) }}">   {{ $answer->user->name }}</a>
            @endif
        </span>
    </h4>
    <p>{{ $answer->content }}</p>

    @if(count($answer->images)>0)
        <h2>Images</h2>
        <hr/>
        <section class="image-show center slider">
            @foreach($answer->images as $image)
                <div><img src="{{ url('images/' . $image->url) }}"></div>
            @endforeach
        </section>

        <div class="image1 slider-nav">
            @foreach($answer->images as $image)
                <div class="slider-img h100"><img src="{{ url('images/' . $image->url) }}"></div>
            @endforeach
        </div>
    @endif

    @if(count($answer->videos)>0)
        <h2>Videos</h2>
        <hr/>
        <section class="video-show center slider">
            @foreach($answer->videos as $video)
                <video controls src="{{ url('videos',$video->url) }}" allowfullscreen></video>
            @endforeach
        </section>

        <div class="video slider-nav">
            @foreach($answer->videos as $video)
                <video src="{{ url('videos',$video->url) }}" allowfullscreen></video>
            @endforeach
        </div>

    @endif
@endsection

@section('script')
    <script>

        $('.image-show').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.image1'
        });

        $('.image1').slick({
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.image-show',
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: "unslick"
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });


        $('.video-show').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.video'
        });

        $('.video').slick({
            arrows: false,
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.video-show',
            dots: false,
            centerMode: true,
            focusOnSelect: true,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: "unslick"
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
                // You can unslick at a given breakpoint now by adding:
                // settings: "unslick"
                // instead of a settings object
            ]
        });

    </script>
@endsection
