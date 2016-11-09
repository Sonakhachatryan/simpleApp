@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Tags <a href="{{ url('/admin/tags/create') }}" class="btn btn-primary btn-xs" title="Add New Tag"><span
                    class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div id="success">
        @include('layouts.messages')
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th> Name </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($tags as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $tags->perPage()*($tags->currentPage()-1)+$x  }}</td>
                    <td>{{ $item->name }}</td>
                    <td>
                        <a href="{{ url('/admin/tags/' . $item->id) }}" class="btn btn-success btn-xs" title="View Tag"><span
                                    class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/admin/tags/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs"
                           title="Edit Tag"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/tags', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <input type="hidden" name="current_page" value="{{ $tags->currentPage() }}">
                        <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                class='delete btn btn-danger btn-xs' title='Delete Offer'>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag"/>
                        </button>
                        <button class="button-delete" hidden type="submit"></button>
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

