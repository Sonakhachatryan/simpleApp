@extends('user.index')

@section('account-content')
    <h1>Answer
        <a href="{{ url('user/question/answer/' . $answer->question->id . '/edit') }}" class="btn btn-primary btn-xs"
           title="Edit Answer"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'post',
            'url' => ['/user/question/answer',$answer->question->id],
            'style' => 'display:inline'
        ]) !!}
        <input type="hidden" name="_method" value="DELETE">
        <button type='button' data="{{csrf_token()}}" value="{{ $answer->question->id }}"
                class='delete btn btn-danger btn-xs' title='Delete Answer'>
            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Answer"/>
        </button>
        <button id="delete" hidden type="submit"></button>
        {!! Form::close() !!}</h1>
    <hr/>
    <div id="success">
        @include('layouts.messages')
    </div>
    <h3>{{ $answer->question->content }}</h3>
    <hr/>
    <h4><span>Name:</span>
        <span>
        @if($answer->alias)
                {{ $answer->user->alias }}
            @else
                {{ $user->user()->name }}
            @endif
        </span>
    </h4>
    <hr/>
    <p>{{ $answer->content }}</p>


    @if($user->user()->status == 'gold')
        <h1> Videos </h1>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th> Name</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($answer->videos as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->url }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>


        <h1> Images </h1>
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th>S.No</th>
                <th> Image</th>
                <th> Name</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($answer->images as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{$x }}</td>
                    <td><img class="upload-image" src="{{ url('images/'.$item->url) }}"/></td>
                    <td>{{ $item->url }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

@endsection