@extends('layouts.app')

@section('title')Главная@endsection

@section('content')
    <!--<h1>Новости</h1>-->
    <div class="row d-flex align-items-center justify-content-center sortWrapper">
        <form action="{{route('home')}}" method="get" class="sortType col-xs-12 col-sm-12 col-lg-8 col-xl-6">
            <div class="form-group">
                <label for="sort">Сортировка:</label>
                <select name="sort" id="sort" class="form-control">
                    <option {{$sortType=='date'?'selected ':''}} value="date">По дате создания</option>
                    <option {{$sortType=='date_desc'?'selected ':''}}value="date_desc">По убыванию даты создания</option>
                    <option {{$sortType=='likes'?'selected ':''}}value="likes">По количеству лайков</option>
                    <option {{$sortType=='likes_asc'?'selected ':''}}value="likes_asc">По возрастанию количества лайков</option>
                </select>
            </div>
            <div class="form-group">
                <label for="category">Рубрика</label>
                <select name="category" id="category" class="form-control">
                    <option value="all">Все</option>
                    <option {{$categoryType=='1'?'selected ':''}}value="1">Политика</option>
                    <option {{$categoryType=='2'?'selected ':''}}value="2">Спорт</option>
                    <option {{$categoryType=='3'?'selected ':''}}value="3">Коронавирус</option>
                </select>
            </div>
            <input type="submit" class="btn btn-primary mt-3" value="Ок">
        </form>
    </div>
    <div class="news-wrapper row">
    @foreach($data as $el)
            @if($el->deleted != 1)
                <div class="news col-xs-12 col-sm-12 col-lg-8 col-xl-6">
                    <div class="news__category text-capitalize"><div class="news__category-label"></div>{{$categories[$el->category_id-1]->name}}</div>
                    <div class="news__image">
                        @if(!is_null($el->photo))
                            <img src="{{asset('storage/'.$el->photo)}}" alt="{{$el->headline}}" class="">
                    @endif
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
