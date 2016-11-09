@extends('user.index')

@section('account-content')
    <div class="tabs-content">
        <div class="tab1-content">
            <div class="info-blocks">

                <div class="tabs-horizontal">

                    <ul>
                        <li data-tab="1" class="js-tab js-active-tab"><a href="#tab1" class="tab">Total</a></li>
                        <li data-tab="2" class="js-tab"><a href="#tab2" class="tab">Today</a></li>
                        <li data-tab="3" class="js-tab"><a href="#tab3" class="tab">Not Answered</a></li>

                    </ul>

                </div>

                <div class="tabs-horizontal-content">
                    <div class="js-active-tab" data-tab="1">
                        {{--   */$x=0;/* --}}
                          @foreach($total_questions as $item)
                           {{--    */$x++;/* --}}
                              <article class="tabs-block">
                                  <span class="number">{{ $total_questions->perPage()*($total_questions->currentPage()-1)+$x }}</span>
                                <a href="{{ ($item->pivot->status == 'Not Answered' || $item->pivot->status == 'Deleted') ? url('/user/question/' . $item->id . '/answer') : url('/user/question/answer/' . $item->id . '/show') }}">
                                    <h3 class="title-in-block">{{ $item->content }}</h3>
                                </a>
                                  <p class="content-in-block">{{ $item->pivot->status }}</p>
                              </article>
                          @endforeach
                              <div class="pagination-wrapper"> {!! $total_questions->appends(array_except(Request::query(), 'total_questions'))->links() !!} </div>
                      </div>

                      <div  data-tab="2">
                          {{-- */$x=0;/* --}}
                        @foreach($today_questions as $item)
                            {{-- */$x++;/* --}}
                            <article class="tabs-block">
                                <span class="number">{{ $today_questions->perPage()*($today_questions->currentPage()-1)+$x }}</span>
                                <a href="{{ ($item->users[0]->pivot->status == 'Not Answered' || $item->users[0]->pivot->status == 'Deleted') ? url('/user/question/' . $item->id . '/answer') : url('/user/question/answer/' . $item->id . '/show') }}">
                                    <h3 class="title-in-block">{{ $item->content }}</h3>
                                </a>
                                <p class="content-in-block">{{ $item->users[0]->pivot->status }}</p>
                            </article>
                        @endforeach
                        <div class="pagination-wrapper"> {!! $today_questions->appends(array_except(Request::query(), 'today_questions'))->links() !!} </div>
                    </div>

                    <div data-tab="3">
                        {{-- */$x=0;/* --}}
                        @foreach($not_answered_questions as $item)
                            {{-- */$x++;/* --}}
                            <article class="tabs-block">
                                <span class="number">{{ $not_answered_questions->perPage()*($not_answered_questions->currentPage()-1)+$x }}</span>
                                <a href="{{ ($item->users[0]->pivot->status == 'Not Answered' || $item->users[0]->pivot->status == 'Deleted') ? url('/user/question/' . $item->id . '/answer') : url('/user/question/answer/' . $item->id . '/show') }}">
                                    <h3 class="title-in-block">{{ $item->content }}</h3>
                                </a>
                                <p class="content-in-block">{{ $item->users[0]->pivot->status }}</p>
                            </article>
                        @endforeach
                        <div class="pagination-wrapper"> {!! $not_answered_questions->appends(array_except(Request::query(), 'not_answered_questions'))->links() !!} </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


