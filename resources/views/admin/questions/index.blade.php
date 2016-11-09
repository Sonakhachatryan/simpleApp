@extends('admin.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    <h1>Questions <a href="{{ url('/admin/questions/create') }}" class="btn btn-primary btn-xs"
                     title="Add New Question"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div id="success">
        @include('layouts.messages')
    </div>
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
        <div class="pagination-wrapper"> {!! $questions->render() !!} </div>
    </div>

    {{--</div>--}}
@endsection

@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection

