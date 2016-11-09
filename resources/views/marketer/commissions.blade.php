@extends('marketer.index')

@section('account-content')
    <div class="tex">
    <h1>Commissions</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> Month </th>
                <th> Commission </th>
                <th> Payed </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($commissions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $commissions->perPage()*($commissions->currentPage()-1)+$x }}</td>
                    <td><a href="{{ url('marketer/users?date=' . $item->created_at->format('m/Y') ) }}">{{ $item->created_at->format('m/Y') }}</a></td>
                    <td>{{ $item->commissios }}</td>
                    <td>
                        @if($item->payment_date)
                            {{ $item->payed }} $ at {{ $item->payment_date }}
                        @else
                           Not Payed
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $commissions->render() !!} </div>
    </div>
    </div>
@endsection
