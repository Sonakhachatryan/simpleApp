@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt50">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">User<br/>
                        <img src="{{ url('images/users/' . $searching_user->avatar ) }}" class="user-image"><br/>
                       Name:{{ $searching_user->name }}<br/>
                       Email:{{ $searching_user->email }}
                    </div>

                    <div class="panel-body">
                        @if($searching_user->answers->count() != 0)
                            @foreach($searching_user->answers as $answer)
                                {{--{{dd($answer->content)}}--}}
                                <h2>{{ $answer->question->content }}</h2>
                                @if($answer->content != "")
                                    <p>{{ substr($answer->content,0,100)}}</p>
                                @endif
                                <a href="{{ url('answer',$answer->id) }}">View all answer</a>
                            @endforeach
                            <div class="pagination-wrapper"> {!! $searching_user->answers->render() !!} </div>
                        @else
                            <h3> NO RESULTS </h3>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection