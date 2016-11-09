@extends('admin.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    {{--<div class="container">--}}
    <h1>{{ $user->name }} Questionary</h1>
    <hr/>
    <div id="success">
        @include('layouts.messages')
    </div>

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No</th>
                <th> Content</th>
                <th> Status</th>
                <th> Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($user->questions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $user->questions->perPage()*($user->questions->currentPage()-1)+$x }}</td>
                    <td>
                        {{$item->content}}
                    </td>
                    <td>
                        {{$item->pivot->status}}
                    </td>
                    <td>
                        @if($item->status !== 'Not Answered')
                            <a href="{{ url('admin/user/' . $user->id . '/question/' . $item->id . '/answer') }}"
                               class="btn btn-success btn-xs"
                               title="View Answer"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        @endif
                        {{--{!! Form::open([--}}
                            {{--'method'=>'DELETE',--}}
                            {{--'url' => ['/admin/questions/remove/' . $item->id],--}}
                            {{--'style' => 'display:inline'--}}
                        {{--]) !!}--}}
                        {{--<input type="hidden" name="current_page" value="{{ $users->currentPage() }}">--}}
                        {{--<button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"--}}
                                {{--class='delete btn btn-danger btn-xs' title='Delete Question'>--}}
                            {{--<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Questions"/>--}}
                        {{--</button>--}}
                        {{--<button id="delete" hidden type="submit"></button>--}}
                        {{--{!! Form::close() !!}--}}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $user->questions->render() !!} </div>
    </div>


    {{--</div>--}}
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection