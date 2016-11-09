@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}
    <div id="success">
        @include('layouts.messages')
    </div>
    <h1>Marketer
        @if($marketer->deleted_at)
            <a href="{{ url('/admin/marketers/activate' . $marketer->id) }}" class="btn btn-warning btn-xs" title="Activate Marketer"><span
                        class="glyphicon glyphicon-ban-circle" aria-hidden="true"/></a>
        @endif
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
            <tr>
                <th>ID</th>
                <td> {{ $marketer->id }} </td>
            </tr>
            <tr>
                <th> Name </th>
                <td> {{ $marketer->name }} </td>
            </tr>
            <tr>
                <th> Email </th>
                <td> {{ $marketer->email }} </td>
            </tr>
            <tr>
                <th> Promo Code </th>
                <td> {{ $marketer->promo_code }} </td>
            </tr>
            <tr>
                <th> Current Commissions </th>
                <td> {{ $marketer->current_commissions }} </td>
            </tr>
            <tr>
                <th> Status </th>
                <td>
                    @if($marketer->deleted_at)
                        Not Active
                    @else
                        Active
                    @endif
                </td>
            </tr>
            <tr>
                <th> Contract</th>
                <td> <a href="{{ url('admin/marketers/contract/' . $marketer->id) }}"><i class="icon-download-alt"> </i>{{ $marketer->contract }} $marketer->contract </a></td>
            </tr>
            </tbody>
        </table>
    </div>

    <h2>Commissions</h2>
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
            @foreach($marketer->commissions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $marketer->commissions->perPage()*($marketer->commissions->currentPage()-1)+$x }}</td>
                    <td>{{ $item->created_at->format('m/Y') }}</td>
                    <td>{{ $item->commissios }}</td>
                    <td>
                        @if($item->payment_date)
                            {{ $item->payed }} $ at {{ $item->payment_date }}
                        @else
                            Not Payed
                            <button type="button" class="btn btn-success btn-xs editPayment" data-toggle="modal" data-target="#paymentModal" value="{{ $item }}"><span
                                        class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $marketer->commissions->render() !!} </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="paymentModalLabel">Pay commission</h4>
                </div>
                <div class="modal-body">
                    <form id="pay" action="{{ url('admin/marketers/pay') }}" method="post">
                        {{ csrf_field() }}
                        <input type="number" step="any" name="money" > $
                        <input type="hidden" name="id" >
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" form="pay" class="btn btn-primary">Pay</button>
                </div>
            </div>
        </div>
    </div>

    {{--</div>--}}
@endsection

@section('script')
    <script>
        $('.editPayment').on('click',function () {
            $('input[name="money"]').val(JSON.parse($(this).val()).commissios);
            $('input[name="id"]').val(JSON.parse($(this).val()).id);
        })
    </script>
@endsection
