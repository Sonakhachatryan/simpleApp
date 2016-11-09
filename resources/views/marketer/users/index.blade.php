@extends('marketer.index')

@section('account-content')
    <div class="tex">
        {{-- */$x=0;/* --}}
            @foreach($users as $item)
                {{-- */$x++;/* --}}
                <article class="tabs-block">
                    <span class="number">{{ $users->perPage()*($users->currentPage()-1)+$x }}</span>
                        <a href="{{ url('marketer/users', $item->id)  }}">
                            <h3 class="title-in-block">{{ $item->name }}</h3>
                    </a>
                    <p class="content-in-block"> <span> Created at : {{ $item->created_at }}</span>  <span> Status : {{ $item->status }}</span></p>
                </article>
            @endforeach
            <div class="pagination-wrapper"> {!! $users->render() !!} </div>
        </div>
@endsection