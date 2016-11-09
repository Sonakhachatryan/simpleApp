@extends('admin.layouts.app')

@section('content')

    <h1> About Page </h1>
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
                    <td>Devider Text</td>
                    <td>{{ $record->devider_text }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/aboutPage/devider_text/edit") }}","inputVal": "{{ $record->devider_text }}" }' class="btn btn-primary btn-xs contact"
                                title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                    </td>
                </tr>
                <tr>
                    <td>About Hading</td>
                    <td>{{ $record->about_hading }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/aboutPage/about_hading/edit") }}","inputVal": "{{ $record->about_hading }}" }' class="btn btn-primary btn-xs contact"
                                title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                    </td>
                </tr>
                <tr>
                    <td>About Content</td>
                    <td>{{ $record->about_content }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/aboutPage/about_content/edit") }}","inputVal": "{{ $record->about_content }}" }' class="btn btn-primary btn-xs contact"
                                title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                    </td>
                </tr>
                <tr>
                    <td>Image Head</td>
                    <td>{{ $record->image_haed }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/aboutPage/image_haed/edit") }}","inputVal": "{{ $record->image_haed }}" }' class="btn btn-primary btn-xs contact"
                                title="Edit About Page"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></button>
                    </td>
                </tr>
                <tr>
                    <td>Image Text</td>
                    <td>{{ $record->image_text }}</td>
                    <td>
                        <button value='{"url":"{{ url("/admin/aboutPage/image_text/edit") }}","inputVal": "{{ $record->image_text }}" }' class="btn btn-primary btn-xs contact"
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

