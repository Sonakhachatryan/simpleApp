@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>User {{ $user->id }}
        <a href="{{ url('/admin/users/' . $user->id . '/questionary') }}" class="btn btn-primary btn-xs" title="View User Questionary"><span
                    class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
        {{--@if($user->deleted_at != null)--}}
            {{--<a href="{{ url('/admin/users/' . $user->id . '/activate') }}"--}}
               {{--class="btn btn-success btn-xs"--}}
               {{--title="Active User"><span class="glyphicon glyphicon-ok" aria-hidden="true"/></a>--}}
        {{--@endif--}}
        {{--{!! Form::open([--}}
            {{--'method'=>'DELETE',--}}
            {{--'url' => ['users', $user->id],--}}
            {{--'style' => 'display:inline'--}}
        {{--]) !!}--}}
        {{--{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(--}}
                {{--'type' => 'submit',--}}
                {{--'class' => 'btn btn-danger btn-xs',--}}
                {{--'title' => 'Delete User',--}}
                {{--'onclick'=>'return confirm("Confirm delete?")'--}}
        {{--))!!}--}}
        {{--{!! Form::close() !!}--}}
    </h1>
    <img class="image" src="{{ url('images/users/',$user->avatar) }}">
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $user->id }}</td>
            </tr>
            <tr>
                <th> Name</th>
                <td> {{ $user->name }} </td>
            </tr>
            <tr>
                <th> Email</th>
                <td> {{ $user->email }} </td>
            </tr>
            <tr>
                <th> Status</th>
                <td> {{ $user->status }} </td>
            </tr>
            <tr>
                <th> Created at</th>
                <td> {{ $user->created_at }} </td>
            </tr>
            </tbody>
        </table>
    </div>

    {{--</div>--}}
@endsection
