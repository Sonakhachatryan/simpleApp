@extends('admin.layouts.app')

@section('content')

    <h1> Partner Page </h1>
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
            <tr>
                <td>Right Text</td>
                <td>{{ $record->right_text }}</td>
                <td>
                    <button value='{"url":"{{ url("/admin/partnerPage/right_text/edit") }}","inputVal": "{{ $record->right_text }}" }' class="btn btn-primary btn-xs contact"
                            title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                </td>
            </tr>
            <tr>
                <td>Left Text</td>
                <td>{{ $record->left_text }}</td>
                <td>
                    <button value='{"url":"{{ url("/admin/partnerPage/left_text/edit") }}","inputVal": "{{ $record->left_text }}" }' class="btn btn-primary btn-xs contact"
                            title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                </td>
            </tr>
            <tr>
                <td>Heading1</td>
                <td>{{ $record->heading1 }}</td>
                <td>
                    <button value='{"url":"{{ url("/admin/partnerPage/heading1/edit") }}","inputVal": "{{ $record->heading1 }}" }' class="btn btn-primary btn-xs contact"
                            title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                </td>
            </tr>
            <tr>
                <td>Heading2</td>
                <td>{{ $record->heading2 }}</td>
                <td>
                    <button value='{"url":"{{ url("/admin/partnerPage/heading2/edit") }}","inputVal": "{{ $record->heading2 }}" }' class="btn btn-primary btn-xs contact"
                            title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                </td>
            </tr>
            <tr>
                <td>Heading3</td>
                <td>{{ $record->heading3 }}</td>
                <td>
                    <button value='{"url":"{{ url("/admin/partnerPage/heading3/edit") }}","inputVal": "{{ $record->heading3 }}" }' class="btn btn-primary btn-xs contact"
                            title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                </td>
            </tr>
            </tbody>
        </table>

    </div>

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
                        <input name="value" value="" class="form-control" type="text">
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
            var url = jQuery.parseJSON( $(this).val()).url;
            if(url.indexOf("about_content") != -1 ) {
                $('input[name="value"]').attr('type', 'textarea');

            }
            $('input[name="value"]').val(jQuery.parseJSON( $(this).val()) . inputVal);
            $('.open-modal').click();
        })
    </script>
@endsection

