@extends('user.index')

@section('style')
    <link rel="stylesheet" href="{{ url('css/checkbox.css') }}">
@endsection

@section('account-content')
    <div class="tabs-content">
        <div class="answer-page">
            <p>
                {{$question->content}}
            </p>
            {!! Form::open([
  'method' => 'post',
  'url' => ['/user/question/answer/'. $question->id .'/edit'],
  'files' => true,
  'id' => "answer"
]) !!}
            @if(isset($user->user()->alias))
                <div class="alias-check"><span>Show Alias</span><input type="checkbox" name="checkbox3" id="checkbox3"
                                                                       class="ios-toggle" {{ $answer->alias == 1 ? "checked='checked'" :''}}/>
                    <label for="checkbox3" class="checkbox-label checkbox-label3"></label>
                </div>
            @endif
            <div class="answer-block">
                {{ csrf_field() }}
                <textarea name="content" id="content"  cols="30" rows="10" placeholder="type...">@if($answer->content != NULL){{$answer->content}}@endif</textarea>

                @if($user->user()->status == 'gold')
                    <div class="img-answer-block">
                        <div id="images-table"></div>
                        {{--<label for="images">--}}
                        {{--<img src="{{ url('images/inner-images/photo-icon.png') }}" alt="photo-icon"--}}
                        {{--class="answer-icon">--}}
                        {{--<div class="loader">--}}
                        {{--<div class="loader-line"></div>--}}
                        {{--</div>--}}
                        {{--<div class="image-block">--}}
                        {{--<a href="#"> <i class="fa fa-times" aria-hidden="true"></i></a>--}}
                        {{--<img src="http://shushi168.com/data/out/114/37353480-image.png" alt="">--}}
                        {{--</div>--}}
                        {{--<div class="overlay"></div>--}}
                        {{--</label>--}}
                        <label for="images"><img src="{{url('images/inner-images/photo-icon.png')}}"
                                                 alt="photo-icon"
                                                 class="answer-icon">
                            <div class="loader">
                                <div class="loader-line"></div>
                            </div>
                            <div class="image-block">
                                <!--<img src="http://shushi168.com/data/out/114/37353480-image.png" alt="">-->
                            </div>
                            <div class="overlay"></div>
                        </label>

                        <input type="file" id="images" name="images[]" multiple="multiple" class="hidden">
                        <input id="removed-images" type="hidden" name="removed_images" value="">
                        <input id="images-alias" type="hidden" name="alias" value="0">
                    </div>

                    <div class="video-answer-block">
                        <div id="videos-table"></div>
                        <label for="videos"><img src="{{ url('images/inner-images/video-icon.png') }}"
                                                 alt="video-icon"
                                                 class="answer-icon-video"></label><input
                                type="file" id="video1" class="hidden">
                        <input type="file" id="videos" name="videos[]" multiple="multiple" class="hidden"/>
                        <input id="alias-videos" type="hidden" name="alias" value="0">
                        <input id="removed-videos" type="hidden" name="removed_videos" value="">
                    </div>
                @endif
            </div>
            <button type="submit">Update</button>
            {!! Form::close() !!}
        </div>
    </div>




@endsection

@section('script')
    @parent
    {{--@include('user.answer.partials.imageUploadScript')--}}
    {{--@include('user.answer.partials.videoUploadScript')--}}

    <script src="{{ url('js/imageUpload.js') }}"></script>
    <script src="{{ url('js/videoUpload.js') }}"></script>
    <script src="{{ url('js/checkbox.js') }}"></script>
    <script>
        $('#checkbox3').on('change', function () {
            if ($('#checkbox3:checked').length) {
                $.ajax({
                    url: "{{ url('user/question/answer/' . $question->id . '/1') }}",
                });
            }

            if (!$('#checkbox3:checked').length) {
                $.ajax({
                    url: "{{ url('user/question/answer/' . $question->id . '/0') }}",
                });
            }
        });
    </script>
@endsection

{{--@section('account-content')--}}
{{--<div class="tex">--}}
{{--<h1>Update Question Answer</h1>--}}
{{--<hr/>--}}
{{--<h3>{{ $question->content }}</h3>--}}
{{--<div id="success">--}}
{{--@include('layouts.messages')--}}
{{--</div>--}}
{{--<hr/>--}}

{{--@if($answer->alias)--}}
{{--<a href="{{ url('user/question/answer' . $question->id . '/false') }}">Use name</a>--}}
{{--@else--}}
{{--<a href="{{ url('user/question/answer' . $question->id . '/true') }}">Use name</a>--}}
{{--@endif--}}

{{--{!! Form::open([--}}
{{--'url' => '/user/question/answer/'. $question->id .'/edit',--}}
{{--'class' => 'form-horizontal',--}}
{{--'files' => true,--}}
{{--'method' => "post"--}}
{{--]) !!}--}}


{{--<div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">--}}
{{--{!! Form::label('content', 'Content', ['class' => 'col-sm-3 control-label']) !!}--}}
{{--<div class="col-sm-6">--}}
{{--{!! Form::textarea('content', $answer->content, ['class' => 'form-control']) !!}--}}
{{--{!! $errors->first('content', '<p class="help-block">:message</p>') !!}--}}
{{--</div>--}}
{{--</div>--}}

{{--<div class="form-group">--}}
{{--<div class="col-sm-offset-3 col-sm-3">--}}
{{--{!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}--}}
{{--</div>--}}
{{--</div>--}}
{{--{!! Form::close() !!}--}}
{{--</div>--}}
{{--@if($user->user()->role == 'gold')--}}
{{--@include('user.answer.partials._videoAndImageUpload')--}}
{{--@endif--}}
{{--@endsection--}}