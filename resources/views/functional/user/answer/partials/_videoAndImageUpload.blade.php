@if(isset($answer))
    <h1> Videos </h1>
    <table class="table table-bordered table-striped table-hover">
        <thead>
        <tr>
            <th>S.No</th>
            <th> Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        {{-- */$x=0;/* --}}
        @foreach($answer->videos as $item)
            {{-- */$x++;/* --}}
            <tr>
                <td>{{ $x }}</td>
                <td>{{ $item->url }}</td>
                <td>
                    {!! Form::open([
                               'method'=>'DELETE',
                               'url' => ['/user/video', $item->id],
                               'style' => 'display:inline'
                           ]) !!}

                    <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                            class='delete btn btn-danger btn-xs' title='Delete Video'>
                        <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Video"/>
                    </button>
                    <button class="button-delete" hidden type="submit"></button>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endif

<h1> Add video </h1>
{!! Form::open([
  'method' => 'post',
  'url' => ['/user/question/' . $question->id . '/answer/videos'],
  'files' => true,
   'id' => "upload-video"
]) !!}


<fieldset>
    <div>
        <label for="videos" class="btn btn-success">Select Videos</label>
        <input type="file" id="videos" name="videos[]" multiple="multiple" class="hidden"/>
    </div>

    <input id="alias-videos" type="hidden" name="alias" value="0">
    <input id="removed-videos" type="hidden" name="removed" value="">
    <table id="videos-table" class="no-border-web table table-striped table-hover"></table>

    <div id="submitbutton-video">
        <button type="submit">Upload Files</button>
    </div>

</fieldset>

{!! Form::close() !!}

@if(isset($answer))
<h1> Images </h1>
<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>S.No</th>
        <th> Image</th>
        <th> Name</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    {{-- */$x=0;/* --}}
    @foreach($answer->images as $item)
        {{-- */$x++;/* --}}
        <tr>
            <td>{{$x }}</td>
            <td><img class="upload-image" src="{{ url('images/'.$item->url) }}"/></td>
            <td>{{ $item->url }}</td>
            <td>
                {!! Form::open([
                           'method'=>'DELETE',
                           'url' => ['/user/image', $item->id],
                           'style' => 'display:inline'
                       ]) !!}
                <input type="hidden" name="_method" value="DELETE">
                <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                        class='delete btn btn-danger btn-xs' title='Delete Image'>
                    <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Image"/>
                </button>
                <button class="button-delete" hidden type="submit"></button>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@endif


<h1> Add image </h1>
{!! Form::open([
  'method' => 'post',
  'url' => ['/user/question/' . $question->id . '/answer/images'],
  'files' => true,
   'id' => "upload-image"
]) !!}


{{--<form id="upload" url="{{ url('/admin/restaurant/images/add') }}" method="POST" enctype="multipart/form-data">--}}

<fieldset>
    <input type="hidden" id="MAX_FILE_SIZE" name="MAX_FILE_SIZE" value="300000"/>
    {{--<input type="hidden" id="token" name="_token" value="{{ csrf_token() }}" />--}}

    <div>
        <label for="images" class="btn btn-success">Select Images</label>
        <input type="file" id="images" name="images[]" multiple="multiple" class="hidden"/>
        {{--<input type="hidden" id="notUploading" name="notUploading" value="">--}}
        <input id="removed-images" type="hidden" name="removed" value="">
        <input id="images-alias" type="hidden" name="alias" value="0">
    </div>

    <table id="images-table" class="no-border-web table table-striped table-hover"></table>

    <div id="submitbutton-image">
        <button type="submit" id="upload_images">Upload Files</button>
    </div>

</fieldset>

{!! Form::close() !!}


@section('script')

    <script>
        $('#answer input[name="alias"]').on('change',function(){
            var val = $(this).val();
            $('#images-alias').val(val);
            $('#alias-videos').val(val);
        });
    </script>

   @include('user.answer.partials.imageUploadScript')
   @include('user.answer.partials.videoUploadScript')

@endsection