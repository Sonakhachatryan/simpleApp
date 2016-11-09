<!DOCTYPE html>
<html>

<head>
    <title>KEEPING IT SIMPLE SOLUTIONS</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ url('libs/bootstrap.min.css ') }}">
</head>


<body>
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
    <div class="pagination-wrapper"> {!! $users->appends(array_except(Request::query(), 'user_page'))->links() !!} </div>
</div>



<h1>Questions </h1>

<div class="table">
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>S.No</th>
            <th> Content</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($questions as $item)
            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $questions->perPage()*($questions->currentPage()-1)+$x }}</td>
                <td>{{ $item->content }}</td>
                <td>
                    <a href="{{ url('/admin/questions/' . $item->id) }}" class="btn btn-success btn-xs"
                       title="View Question"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                    <a href="{{ url('/admin/questions/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"
                       title="Edit Question"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                    <a href="{{ url('/admin/questions/' . $item->id . '/share') }}" class="btn btn-warning btn-xs"
                       title="Ask Question"><span class="glyphicon glyphicon-share" aria-hidden="true"/></a>
                    {{--<a href="{{ url('/admin/questions/' . $item->id . '/tags') }}" class="btn btn-info btn-xs"--}}
                    {{--title="Add Tag"><span class="glyphicon glyphicon-paperclip" aria-hidden="true"/></a>--}}
                    {!! Form::open([
                        'method'=>'DELETE',
                        'url' => ['/admin/questions', $item->id],
                        'style' => 'display:inline'
                    ]) !!}
                    <input type="hidden" name="current_page" value="{{ $questions->currentPage() }}">
                    <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                            class='delete btn btn-danger btn-xs' title='Delete Offer'>
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Questions"/>
                    </button>
                    <button class="button-delete" hidden type="submit"></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="pagination-wrapper"> {!! $questions->appends(array_except(Request::query(), 'questions_page'))->links() !!} </div>
</div>

</body>
</html>