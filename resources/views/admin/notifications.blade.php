@extends('admin.layouts.app')

@section('content')
    {{-- */$x=0;/* --}}
    @foreach($notifications as $notification)
        {{-- */$x++;/* --}}
        <a href="{{ url('admin/notification/changeStatus', $notification->id) }}">
            <div class="p10 {{ $notification->status == 'viewed' ? 'viewed' : 'not-viewed'}}">
                {{ $notification->notification->content }}
            </div>
        </a>
    @endforeach
    <div class="pagination-wrapper"> {!! $notifications->render() !!} </div>
@endsection
