@extends('admin.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    {{--<div class="container">--}}
    <h1>Question shareing</h1>
    <hr/>
    <div id="success">
        @include('layouts.messages')
    </div>
    <h3>{{ $question->content }}</h3>
    {!! Form::open(['url' => '/admin/questions/' . $question->id . '/share', 'class' => 'form-horizontal', 'method' => 'post']) !!}

    <div class="form-group {{ $errors->has('users') ? 'has-error' : ''}}">
        {!! Form::label('users', 'Users', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <select class="form-control" multiple="multiple" data-placeholder="Choose user" name="users[]">
                @foreach($adding_users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('users', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Ask', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    <h1>Users</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No</th>
                <th> Name</th>
                <th> Status</th>
                <th> Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $users->perPage()*($users->currentPage()-1)+$x }}</td>
                    <td><a href="{{ url('admin/users',$item->user_id) }}">{{ $item->name }}</a></td>
                    <td>
                        {{$item->status}}
                    </td>
                    <td>
                        @if($item->status !== 'Not Answered')
                        <a href="{{ url('admin/user/' . $item->user_id . '/question/' . $question->id . '/answer') }}"
                           class="btn btn-success btn-xs"
                           title="View Answer"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        @endif
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/questions/remove/' . $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <input type="hidden" name="current_page" value="{{ $users->currentPage() }}">
                        <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                class='delete btn btn-danger btn-xs' title='Delete Question'>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Questions"/>
                        </button>
                        <button class="button-delete" hidden type="submit"></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $users->render() !!} </div>
    </div>


    {{--</div>--}}
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection