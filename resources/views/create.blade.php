@extends('layouts.app')

@section('title')Создать новость@endsection

@section('content')
    <h1 class="mb-3">Добавить новость</h1>
    <form action="{{route('create-submit')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="headline">Заголовок</label>
            <input type="text" name="headline" id="headline" class="form-control" placeholder="Заголовок">
        </div>
        <div class="form-group d-flex flex-column">
            <div class="custom-file">
                <label for="photo" class="custom-file-label">Изображение</label>
                <input type="file" name="photo" id="photo" class="image-input custom-file-input">
            </div>
            <div class="news__image preview-image col-xs-12 col-sm-12 col-lg-8 col-xl-6" id="preview-image">
                <img src="#" alt="" id="preview-image-img">
            </div>
        </div>
        <div class="form-group">
            <label for="description">Описание</label>
            <textarea name="description" id="description" class="form-control" placeholder="Краткое описание"></textarea>
        </div>
        <div class="form-group">
            <label for="newsText">Текст</label>
            <textarea name="newsText" id="newsText" class="form-control" rows="7" placeholder="Текст новости"></textarea>
        </div>
        <div class="form-group">
            <label for="category">Рубрика</label>
            <select name="category" id="category" class="form-control">
                <option value="1">Политика</option>
                <option value="2">Спорт</option>
                <option value="3">Коронавирус</option>
            </select>
        </div>
        <input type="submit" value="Создать" class="btn btn-success">
    </form>
@endsection
