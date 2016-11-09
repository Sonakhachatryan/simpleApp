@extends('user.index')

@section('account-content')
    <div class="tex">
    <h1>Update Question Answer</h1>
    <hr/>
    <h3>{{ $question->content }}</h3>
    <div id="success">
        @include('layouts.messages')
    </div>
    <hr/>

    @if($answer->alias)
        <a href="{{ url('user/question/answer' . $question->id . '/false') }}">Use name</a>
    @else
        <a href="{{ url('user/question/answer' . $question->id . '/true') }}">Use name</a>
    @endif

    {!! Form::open([
    'url' => '/user/question/answer/'. $question->id .'/edit',
    'class' => 'form-horizontal',
    'files' => true,
    'method' => "post"
    ]) !!}


    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
        {!! Form::label('content', 'Content', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('content', $answer->content, ['class' => 'form-control']) !!}
            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    </div>
    @include('user.answer.partials._videoAndImageUpload')
@endsection