<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'headline'=>'required',
            'description'=>'required',
            'newsText'=>'required',
            'category'=>'required',
            'photo'=>'image|mimes:jpeg,png,jpg,gif,webp|max:1024'
        ];
    }
    public function messages()
    {
        return [
            'headline.required'=>'Введите заголовок',
            'description.required'=>'Введите описание',
            'newsText.required'=>'Введите текст новости',
            'category.required'=>'Выберите категорию',
            'photo.mimes'=>'Фото только jpeg,png,jpg,gif,webp',
            'photo.max'=>'Максимальный размер изображения - 1МБ',
            'photo.image'=>'Загружайте только файлы изображений'
        ];
    }
}
