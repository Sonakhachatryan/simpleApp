@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Notifications <a href="{{ url('/notifications/create') }}" class="btn btn-primary btn-xs" title="Add New Notification"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Title </th><th> Content </th><th>Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($notifications as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->title }}</td><td>{{ $item->content }}</td>
                    <td>
                        <a href="{{ url('/notifications/' . $item->id) }}" class="btn btn-success btn-xs" title="View Notification"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/notifications/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Notification"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/notifications', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Notification" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Notification',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $notifications->render() !!} </div>
    </div>

</div>
@endsection
