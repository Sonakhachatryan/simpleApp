@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Marketers</h1>
    <div id="success">
        @include('layouts.messages')
    </div>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> Name </th>
                <th> Email </th>
                <th> Promo Code </th>
                <th> Current Commissions </th>
                <th> Status </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($marketers as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $marketers->perPage()*($marketers->currentPage()-1)+$x  }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->promo_code }}</td>
                    <td>{{ $item->current_commissions }} $ </td>
                    <td>
                        @if($item->deleted_at)
                            Not Active
                            @else
                           Active
                        @endif
                    </td>
                    <td>
                        <a href="{{ url('/admin/marketers/' . $item->id) }}" class="btn btn-success btn-xs" title="View Marketer"><span
                                    class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        @if($item->deleted_at)
                            <a href="{{ url('/admin/marketers/activate' . $item->id) }}" class="btn btn-warning btn-xs" title="Activate Marketer"><span
                                        class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>

                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $marketers->render() !!} </div>
    </div>
    {{--</div>--}}
@endsection

