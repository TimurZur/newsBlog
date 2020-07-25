@extends('layouts.app')

@section('title')Главная@endsection

@section('content')
    <!--<h1>Новости</h1>-->
    <div class="news-wrapper row">
    @foreach($data as $el)
            @if($el->deleted != 1)
                <div class="news col-xs-12 col-sm-12 col-lg-8 col-xl-6">
                    <div class="news__category"><div class="news__category-label"></div>{{$el->category}}</div>
                    <div class="news__image">
                        @if(!is_null($el->photo))
                            <img src="{{asset('storage/'.$el->photo)}}" alt="{{$el->headline}}" class="">
                    @endif
                    <!--<span>https://avatars.mds.yandex.net/get-ynews/1738766/04e967c0f3a7393e6299989bd358c3f2/563x304</span>-->
                    </div>
                    <a class="news__header" href="{{route('one-news',$el->id)}}"><h3>{{$el->headline}}</h3></a>
                    <div class="news__description">
                        {{$el->description}}
                    </div>
                    <div class="news__info">
                        <small class="text-muted">{{$el->created_at}}</small>
                        <div class="news__likes">
                            <span class="likesCount">{{$el->likes}}</span>
                            <input type="hidden" class="newsID" value="{{$el->id}}">
                            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill likesButton" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            @endif
    @endforeach
        </div>
@endsection
