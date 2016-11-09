@extends('admin.layouts.app')

@section('content')
{{--<div class="container">--}}

    <h1>Question {{ $question->id }}
        <a href="{{ url('admin/questions/' . $question->id . '/edit') }}" class="btn btn-primary btn-xs" title="Edit Question"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['admin/questions', $question->id],
            'style' => 'display:inline'
        ]) !!}
        <button type='button' data="{{csrf_token()}}" value="{{ $question->id }}"
                class='delete btn btn-danger btn-xs' title='Delete Offer'>
            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag"/>
        </button>
        <button id="delete_tag" hidden type="submit"></button>
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $question->id }}</td>
                </tr>
                <tr><th> Content </th><td> {{ $question->content }} </td></tr>
            </tbody>
        </table>

    </div>




{{--</div>--}}
@endsection

