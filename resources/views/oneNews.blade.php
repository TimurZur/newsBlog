@extends('layouts.app')
@section('title'){{$data->headline}}@endsection

@section('content')
    <div class="news-wrapper row">
        <div class="news col-xs-12 col-sm-12 col-lg-8 col-xl-6">
            <div class="news__category text-capitalize"><div class="news__category-label"></div>{{$categories[$data->category_id-1]->name}}</div>
            <div class="news__image">
                @if(!is_null($data->photo))
                    <img src="{{asset('storage/'.$data->photo)}}" alt="{{$data->headline}}" class="">
            @endif
            </div>
            <h3 class="news__header mb-4">{{$data->headline}}</h3>
            <div class="news__test">{{$data->text}}</div>
            <div class="news__info">
                <small class="text-muted">{{$data->created_at}}</small>
                <div class="news__likes">
                    <span class="likesCount">{{$data->likes}}</span>
                    <input type="hidden" class="newsID" value="{{$data->id}}">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-heart-fill likesButton" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z"/>
                    </svg>
                </div>
            </div>
            <div class="controls">
                <a href="{{route('news-edit',$data->id)}}" class="btn btn-primary">Редактировать</a>
                <a href="{{route('news-delete',$data->id)}}" class="btn btn-danger">Удалить</a>
            </div>
        </div>
    </div>
@endsection
