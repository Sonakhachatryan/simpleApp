@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Notification {{ $notification->id }}
        <a href="{{ url('notifications/' . $notification->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Notification"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['notifications', $notification->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Delete Notification',
                    'onclick'=>'return confirm("Confirm delete?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $notification->id }}</td>
                </tr>
                <tr><th> Title </th><td> {{ $notification->title }} </td></tr><tr><th> Content </th><td> {{ $notification->content }} </td></tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
