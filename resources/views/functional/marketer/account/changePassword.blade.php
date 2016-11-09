@extends('user.index')

@section('account-content')
    {{--<div class="container">--}}

    <h1>Change Password</h1>
    <div id="success">
        @include('layouts.messages')
    </div>
    {!! Form::open([
        'method' => 'post',
        'url' => ['/marketer/account-details/password'],
        'class' => 'form-horizontal',
    ]) !!}


    <div class="form-group {{ session()->has('old_password') ? 'has-error' : ''}}">
        {!! Form::label('old_password', 'Old Password', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('old_password', null, ['class' => 'form-control']) !!}
            {!! session()->has('old_password') ? "<p class='help-block'>" . session('old_password') ."</p>" : ''!!}
        </div>
    </div>

    <div class="form-group {{ $errors->has('password') ? 'has-error' : ''}}">
        {!! Form::label('password', 'Password', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password', null, ['class' => 'form-control']) !!}
            {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
        </div>
    </div>


    <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : ''}}">
        {!! Form::label('password_confirmation', 'Confirm', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            {!! Form::password('password_confirmation', null, ['class' => 'form-control']) !!}
            {!! $errors->first('password_confirmation', '<p class="help-block">:message</p>') !!}
        </div>
    </div>



    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Change', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}
    {{--</div>--}}
@endsection

