@extends('user.index')

@section('account-content')
    {{--{{dd($questions)}}--}}
    <h1>Questions</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
                <th> S.No</th>
                <th> Content</th>
                <th> Answer Status</th>
                <th> Actions</th>
            </tr>
            </thead>
            <tbody>
            {{-- */$x=0;/* --}}
            @foreach($questions as $item)
                {{-- */$x++;/* --}}
                <tr>
                    <td>{{ $questions->perPage()*($questions->currentPage()-1)+$x }}</td>
                    <td>{{ $item->content }}</td>
                    <td>{{ $item->pivot->status }}</td>
                    <td>
                        @if($item->pivot->status == 'Not Answered' || $item->pivot->status == 'Deleted' )
                            <a href="{{ url('/user/question/' . $item->id . '/answer') }}"
                               class="btn btn-success btn-xs"
                               title="Answer to question."><span class="glyphicon glyphicon-file"
                                                                 aria-hidden="true"/></a>
                        @else
                            <a href="{{ url('/user/question/answer/' . $item->id . '/show') }}"
                               class="btn btn-success btn-xs"
                               title="Show answer."><span class="glyphicon glyphicon-eye-open"
                                                          aria-hidden="true"/></a>
                            <a href="{{ url('/user/question/answer/' . $item->id . '/edit') }}"
                               class="btn btn-primary btn-xs"
                               title="Update answer"><span class="glyphicon glyphicon-pencil"
                                                           aria-hidden="true"/></a>
                            {!! Form::open([
          'method'=>'post',
          'url' => ['/user/question/answer', $item->id],
          'style' => 'display:inline'
      ]) !!}
                            <input type="hidden" name="current_page" value="{{ $questions->currentPage() }}">
                            <input type="hidden" name="_method" value="DELETE">
                            <button type='button' data="{{csrf_token()}}" value="{{ $item->id }}"
                                    class='delete btn btn-danger btn-xs' title='Delete Offer'>
                                <span class="glyphicon glyphicon-trash" aria-hidden="true" title="Delete Tag"/>
                            </button>
                            <button class="button-delete" hidden type="submit"></button>
                            {!! Form::close() !!}
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $questions->render() !!} </div>
    </div>
@endsection