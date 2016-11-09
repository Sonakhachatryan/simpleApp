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
    {!! Form::open(['url' => '/admin/questions/' . $question->id . '/tags', 'class' => 'form-horizontal', 'method' => 'post']) !!}

    <div class="form-group {{ $errors->has('tags') ? 'has-error' : ''}}">
        {!! Form::label('tags', 'Tags', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-6">
            <select class="form-control" multiple="multiple" data-placeholder="Choose tag" name="tags[]">
                @foreach($adding_tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            {!! $errors->first('tags', '<p class="help-block">:message</p>') !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-3">
            {!! Form::submit('Ask', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </div>
    {!! Form::close() !!}

    <h1>Tags</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No</th>
                <th> Name </th>
                <th> Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tags as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $tags->perPage()*($tags->currentPage()-1)+$x }}</td>
                    <td><a href="{{ url('admin/tags',$item->tag_id) }}">{{ $item->name }}</a></td>
                    <td>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/questions/remove/' . $item->id . '/tag'],
                            'style' => 'display:inline'
                        ]) !!}
                        <input type="hidden" name="current_page" value="{{ $tags->currentPage() }}">
                        <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                class='delete btn btn-danger btn-xs' title='Delete Tag'>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag"/>
                        </button>
                        <button id="delete" hidden type="submit"></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $tags->render() !!} </div>
    </div>


    {{--</div>--}}
@endsection


@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script type="text/javascript">
        $('select').select2();
    </script>
@endsection