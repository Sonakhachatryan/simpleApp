@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Edit Question {{ $question->id }}</h1>
    <div id="success">
        @include('layouts.messages')
    </div>
    {!! Form::model($question, [
        'method' => 'PATCH',
        'url' => ['/admin/questions', $question->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
        {!! Form::label('content', 'Content', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
            {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Update', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    {{--</div>--}}
@endsection