@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row mt50">
                <div class="col-md-10 col-md-offset-1">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $answer->question->content }}</div>

                        <div class="panel-body">
                            @if($answer->content)
                                <p>{{ $answer->content }}</p>
                            @endif
                            <hr/>
                            <div>
                                @if($answer->alias)
                                    <span class="mr10">     {{ $answer->user->alias }}</span>
                                @else
                                    <a href="{{ url('user', $answer->user->id) }}"><span
                                                class="mr10">{{  $answer->user->name }}</span> </a>
                                @endif
                                <span class="mr10"> {{ $answer->created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
