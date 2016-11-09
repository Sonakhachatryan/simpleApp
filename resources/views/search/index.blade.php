@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt50">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Search</div>

                    <div class="panel-body">

                        {!! Form::open(['url' => 'search', 'class' => 'clearfix']) !!}
                        <div class="form-group {{ $errors->has('tag') ? 'has-error' : ''}}">
                            <div class="col-sm-6">
                                {!! Form::text('tag', null, ['class' => 'form-control']) !!}
                            </div>
                            <div class="col-sm-3">
                                {!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}

                        <div class="mt10">
                            @foreach($tags as $tag)
                                <a href="{{ url('search',$tag->id) }}"><span class="mr10">{{ $tag->name  }}</span></a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection