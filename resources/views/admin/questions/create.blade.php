@extends('admin.layouts.app')

@section('content')
{{--<div class="container">--}}

    <h1>Create New Question</h1>
    <hr/>
<div id="success">
    @include('layouts.messages')
</div>
    {!! Form::open(['url' => '/admin/questions', 'class' => 'form-horizontal', 'files' => true]) !!}

                    <div class="form-group {{ $errors->has('content') ? 'has-error' : ''}}">
                {!! Form::label('content', 'Content', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('content', '<p class="help-block">:message</p>') !!}
                </div>
            </div>


        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Create', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

{{--</div>--}}
@endsection