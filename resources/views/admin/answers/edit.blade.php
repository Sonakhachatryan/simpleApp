@extends('admin.layouts.app')

@section('content')
    <h1>Update Question Answer</h1>
    <hr/>
    <h3>{{ $answer->question->content }}
        <a href="{{ url('admin/answer/' . $answer->id .'/approve') }}" class="btn btn-success btn-xs"
           title="Approve Answer"><span class="glyphicon glyphicon-ok" aria-hidden="true"/></a>

    </h3>
    <div id="success">
        @include('layouts.messages')
    </div>
    <hr/>

    {!! Form::open([
    'url' => 'admin/answer/'. $answer->id .'/edit',
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
@endsection