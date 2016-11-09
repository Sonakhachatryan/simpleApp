@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <div id="success">
        @include('layouts.messages')
    </div>
    <h1>Tag {{ $tag->id }}
        <a href="{{ url('admin/tags/' . $tag->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Tag"><span
                    class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/tags', $tag->id],
                            'style' => 'display:inline'
                        ]) !!}
        {{--<input type="hidden" name="current_page" value="{{ $tags->currentPage() }}">--}}
        <button type='button' data="{{csrf_token()}}" value="{{ $tag->id }}"
                class='delete btn btn-danger btn-xs' title='Delete Offer'>
            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag"/>
        </button>
        <button class="button-delete" hidden type="submit"></button>
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>ID</th>
                <td>{{ $tag->id }}</td>
            </tr>
            <tr>
                <th> Name</th>
                <td> {{ $tag->name }} </td>
            </tr>
            </tbody>
        </table>
    </div>

    {{--</div>--}}
@endsection
