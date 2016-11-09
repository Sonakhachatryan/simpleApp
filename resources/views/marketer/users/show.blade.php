@extends('marketer.index')

@section('account-content')
    <div class="tex">
        <img class="image" src="{{ url('images/users/',$showing_user->avatar) }}">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover">
                <tbody>
                <tr>
                    <th>ID</th>
                    <td>{{ $showing_user->id }}</td>
                </tr>
                <tr>
                    <th> Name</th>
                    <td> {{ $showing_user->name }} </td>
                </tr>
                <tr>
                    <th> Email</th>
                    <td> {{ $showing_user->email }} </td>
                </tr>
                <tr>
                    <th> Status</th>
                    <td> {{ $showing_user->status }} </td>
                </tr>
                <tr>
                    <th> Created at</th>
                    <td> {{ $showing_user->created_at }} </td>
                </tr>
                </tbody>
            </table>
    </div>
@endsection