@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

        <h1>Users</h1>
        <div class="table">
            <table class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                    <th>S.No</th>
                    <th> Name</th>
                    <th> Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                {{-- */$x=0;/* --}}
                @foreach($users as $item)
                    {{-- */$x++;/* --}}
                    <tr>
                        <td>{{ $users->perPage()*($users->currentPage()-1)+$x  }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>
                            <a href="{{ url('/admin/users/' . $item->id) }}" class="btn btn-success btn-xs"
                               title="View User"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                            <a href="{{ url('/admin/users/' . $item->id . '/questionary') }}" class="btn btn-primary btn-xs" title="View User Questionary"><span
                                        class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                            {{--<a href="{{ url('/admin/users/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"--}}
                               {{--title="Edit User"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>--}}
                            {{--@if($item->deleted_at != null)--}}
                                {{--<a href="{{ url('/admin/users/' . $item->id . '/activate') }}"--}}
                                   {{--class="btn btn-success btn-xs"--}}
                                   {{--title="Active User"><span class="glyphicon glyphicon-ok" aria-hidden="true"/></a>--}}
                            {{--@endif--}}
                            {{--{!! Form::open([--}}
                                {{--'method'=>'DELETE',--}}
                                {{--'url' => ['/admin/users', $item->id],--}}
                                {{--'style' => 'display:inline'--}}
                            {{--]) !!}--}}
                            {{--{!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete User" />', array(--}}
                                    {{--'type' => 'submit',--}}
                                    {{--'class' => 'btn btn-danger btn-xs',--}}
                                    {{--'title' => 'Delete User',--}}
                                    {{--'onclick'=>'return confirm("Confirm delete?")'--}}
                            {{--)) !!}--}}
                            {{--{!! Form::close() !!}--}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination-wrapper"> {!! $users->render() !!} </div>
        </div>

    {{--</div>--}}
@endsection
