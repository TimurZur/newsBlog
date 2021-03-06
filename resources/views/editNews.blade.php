@extends('layouts.app')

@section('title')Редактировать новость@endsection

@section('content')
    <h1 class="mb-3">Редактировать новость</h1>
    <form action="{{route('news-edit-submit',$data->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="headline">Заголовок</label>
            <input type="text" name="headline" id="headline" value="{{$data->headline}}" class="form-control" placeholder="Заголовок">
        </div>
        <div class="form-group d-flex flex-column">
            <div class="custom-file">
                <label for="photo" class="custom-file-label">Изображение</label>
                <input type="file" name="photo" id="photo" class="image-input custom-file-input">
            </div>
            <div class="news__image preview-image col-xs-12 col-sm-12 col-lg-8 col-xl-6" id="preview-image">
                <img src="{{asset('storage/'.$data->photo)}}" alt="" id="preview-image-img">
            </div>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control" placeholder="Краткое описание">{{$data->description}}</textarea>
        </div>
        <div class="form-group">
            <label for="newsText">Текст</label>
            <textarea name="newsText" id="newsText" class="form-control" rows="7" placeholder="Текст новости">{{$data->text}}</textarea>
        </div>
        <div class="form-group">
            <label for="category">Рубрика</label>
            <select name="category" id="category" class="form-control">
                <option {{$data->category_id=='1'?'selected ':''}}value="1">Политика</option>
                <option {{$data->category_id=='2'?'selected ':''}}value="2">Спорт</option>
                <option {{$data->category_id=='3'?'selected ':''}}value="3">Коронавирус</option>
            </select>
        </div>
        <input type="submit" value="Сохранить" class="btn btn-success">
    </form>
@endsection
