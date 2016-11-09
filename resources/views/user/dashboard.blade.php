@extends('user.index')

@section('account-content')
    <div class="tabs-content">
        <div class="tab1-title">
            <h2> {{ $user->user()->name }}
                @if($user->user()->status == 'gold')
                   <img src="{{ url('images/inner-images/gold.png') }}" alt="status-gold">
                @endif
            </h2>
        </div>

        <div class="tab1-content">
            <p>
                {{  $user->user()->about != NULL ?  $user->user()->about :'' }}
            </p>
           <div class="contact-info">
                <div class="links">
                    <a href="{{ $user->user()->facebook != NULL ? $user->user()->facebook : '#'  }}"><i class="fa fa-facebook facebook" aria-hidden="true"></i></a>
                    <a href="{{ $user->user()->twitter != NULL ? $user->user()->twitter : '#'  }}"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                    <a href="{{ $user->user()->google != NULL ? $user->user()->google : '#'  }}"><i class="fa fa-google-plus google-plus" aria-hidden="true"></i></a>
                    <a href="{{ $user->user()->pinterest != NULL ? $user->user()->pinterest : '#'  }}"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                </div>
                <p><i class="fa fa-envelope-o" aria-hidden="true"></i> {{ $user->user()->email  }}</p>
           </div>
           <div class="info-blocks">
                <div class="tabs-horizontal">
                    <ul>
                        <li data-tab="1" class="js-tab js-active-tab"><a href="#" class="tab">Last 4 questions</a></li>
                        {{--<li data-tab="2" class="js-tab"><a href="#" class="tab">Total</a></li>--}}
                        {{--<li data-tab="3" class="js-tab"><a href="#" class="tab">Activity</a></li>--}}
                    </ul>
                </div>
                <div class="tabs-horizontal-content">
                    <div class="js-active-tab " data-tab="1">
                        {{-- */$x=0;/* --}}
                        @foreach($questions as $item)
                            {{-- */$x++;/* --}}
                            <article class="tabs-block">
                                <span class="number">{{ $x }}</span>

                                <h3 class="title-in-block"><a href="{{ ($item->pivot->status == 'Not Answered' || $item->pivot->status == 'Deleted') ? url('/user/question/' . $item->id . '/answer') : url('/user/question/answer/' . $item->id . '/show') }}">{{ $item->content }}</a></h3>

                                <p class="content-in-block">{{ $item->pivot->status }}</p>

                            </article>
                        @endforeach
                  </div>
                </div>
            </div>
       </div>
    </div>
@endsection

