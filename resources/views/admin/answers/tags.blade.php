@extends('admin.layouts.app')

@section('style')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet"/>
@endsection

@section('content')
    {{--<div class="container">--}}
    <h1>Answer Tags</h1>
    <a class="btn btn-success" href="{{ url('admin/user/' . $answer->user_id . '/question/' . $answer->question_id . '/answer') }}"> Go To Answer</a>
    <hr/>
    <div id="success">
        @include('layouts.messages')
    </div>
    {!! Form::open(['url' => '/admin/answer/' . $answer->id . '/tags/add', 'class' => 'form-horizontal', 'method' => 'post']) !!}

    <div class="form-group {{ $errors->has('tags') ? 'has-error' : ''}}">
        {!! Form::label('tags', 'Users', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <select class="form-control" multiple="multiple" data-placeholder="Choose tags" name="tags[]">
                @foreach($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('tags', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Add', ['class' => 'btn btn-primary form-control']) !!}
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
                <th> Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($answer->tags as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $answer->tags->perPage()*($answer->tags->currentPage()-1)+$x }}</td>
                    <td><a href="{{ url('admin/tags',$item->id) }}">{{ $item->name }}</a></td>
                    <td>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/answer/' . $answer->id . '/tags/remove/' . $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <input type="hidden" name="current_page" value="{{ $answer->tags->currentPage() }}">
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
        <div class="pagination-wrapper"> {!! $answer->tags->render() !!} </div>
    </div>


    {{--</div>--}}
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection