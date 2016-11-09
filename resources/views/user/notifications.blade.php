@extends('user.index')

@section('account-content')
    <div class="tabs-content">
        <div class="tab1-content">
            <div class="info-blocks">
                <div class="tabs-horizontal-content">
                    <div class="js-active-tab " data-tab="1">
                        {{-- */$x=0;/* --}}
                        @foreach($notifications as $notification)
                            {{-- */$x++;/* --}}
                        <article class="tabs-block {{ $notification->status == 'viewed' ? 'user-viewed' : 'user-not-viewed'}}">
                            <span class="number">{{$notifications->perPage()*($notifications->currentPage()-1)+$x }}</span>

                            <a href="{{ url('user/notification/changeStatus', $notification->id) }}">     <h3 class="title-in-block">{{ $notification->notification->content }}</h3>
                            </a>
                        </article>
                        @endforeach
                        <div class="pagination-wrapper"> {!! $notifications->render() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
