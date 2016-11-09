@extends('user.index')

@section('account-content')
    <div class="tex">
    <h1>Answer To Question</h1>
    <hr/>
    <h3>{{ $question->content }}</h3>
    <div id="success">
        @include('layouts.messages')
    </div>
    <hr/>

    {!! Form::open([
    'url' => '/user/question/'. $question->id .'/answer',
    'class' => 'form-horizontal',
    'files' => true,
    'method' => "post",
    'id' => 'answer'
    ]) !!}

    <div class="form-group {{ $errors->has('alias') ? 'has-error' : ''}}">
        {!! Form::label('alias', 'Alias', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            No{!! Form::radio('alias', '0', true) !!}
            @if($user->user()->alias)
                Yes{!! Form::radio('alias', '1') !!}
            @endif
            {!! $errors->first('alias', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
        {!! Form::label('content', 'Content', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Answer', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

</div>

@include('user.answer.partials._videoAndImageUpload')

@endsection



