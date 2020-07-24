@extends('layouts.app')

@section('title')Создать новость@endsection

@section('content')
    <h1 class="mb-3">Добавить новость</h1>
    <form action="{{route('create-submit')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="headline">Заголовок</label>
            <input type="text" name="headline" id="headline" class="form-control" placeholder="Заголовок">
        </div>
        <div class="form-group">
            <label for="image">Изображение</label>
            <input type="file" name="image" id="image" class="image-input">
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
                <option value="Спорт">Спорт</option>
                <option value="Политика">Политика</option>
                <option value="Коронавирус">Коронавирус</option>
            </select>
        </div>
        <input type="submit" value="Создать" class="btn btn-success">
    </form>
@endsection
