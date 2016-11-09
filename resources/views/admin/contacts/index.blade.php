@extends('admin.layouts.app')

@section('content')
    {{--<div class="container">--}}

    <h1>Contact Page</h1>
    <div id="success">
        @include('layouts.messages')
    </div>

    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> Field </th>
                <th> Value </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            @foreach($contacts as $item)
                <tr>
                    <td>{{ $item->role }}</td>
                    <td>{{ $item->value }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/contacts/" . $item->id . "/edit") }}","inputVal": "{{ $item->value }}" }' class="btn btn-primary btn-xs contact"
                                title="Edit Contact"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


<hr/>
    <h3>Addresses <button value='{"url":"{{ url("/admin/contacts/address/create") }}","inputVal":""}' class="btn btn-primary btn-xs contact" title="Add New Address"><span
                    class="glyphicon glyphicon-plus" aria-hidden="true"/></button></h3>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> Address </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($address as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->value }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/contacts/" . $item->id . "/edit") }}","inputVal": "{{ $item->value }}" }' class="btn btn-primary btn-xs contact"
                           title="Edit Address"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/contacts', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                class='delete btn btn-danger btn-xs' title='Delete Offer'>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Address"/>
                        </button>
                        <button class="button-delete" hidden type="submit"></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>

    <hr/>
    <h3>Phones <button value='{"url":"{{ url("/admin/contacts/phone/create") }}","inputVal":""}' class="btn btn-primary btn-xs contact" title="Add New Phone Number"><span
                    class="glyphicon glyphicon-plus" aria-hidden="true"/></button></h3>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> Phone </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($phones as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->value }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/contacts/" . $item->id . "/edit") }}","inputVal": "{{ $item->value }}" }' class="btn btn-primary btn-xs contact"
                           title="Edit Phone"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/contacts', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                class='delete btn btn-danger btn-xs' title='Delete Phone'>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Phone"/>
                        </button>
                        <button class="button-delete" hidden type="submit"></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>


    <hr/>
    <h3>E-Mail <button value='{"url":"{{ url("/admin/contacts/email/create") }}","inputVal":""}' class="btn btn-primary btn-xs contact" title="Add New E-Mail"><span
                    class="glyphicon glyphicon-plus" aria-hidden="true"/></button></h3>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No </th>
                <th> E-Mail </th>
                <th> Actions </th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($emails as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $x }}</td>
                    <td>{{ $item->value }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/contacts/" . $item->id . "/edit") }}","inputVal": "{{ $item->value }}" }' class="btn btn-primary btn-xs contact"
                           title="Edit Phone"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/admin/contacts', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                        <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                class='delete btn btn-danger btn-xs' title='Delete E-mail'>
                            <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete E-mail"/>
                        </button>
                        <button class="button-delete" hidden type="submit"></button>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

    </div>
    {{--</div>--}}


    <button type="button" class="btn btn-primary btn-lg open-modal hidden" data-toggle="modal" data-target="#myModal">
    </button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Contact</h4>
                </div>
                <div class="modal-body">
                    <form  action="" id="form">
                        <input name="value" value="" class="form-control">
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" form="form">Save</button>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script>
        $('.contact').on('click',function () {
            $('#form').attr('action',jQuery.parseJSON( $(this).val()) .url);
            $('input[name="value"]').val(jQuery.parseJSON( $(this).val()) . inputVal);
            $('.open-modal').click();
        })
    </script>
@endsection

