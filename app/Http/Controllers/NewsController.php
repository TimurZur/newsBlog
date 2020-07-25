<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function submit(NewsRequest $req){
        $news = new News();
        $news->headline = trim($req->input('headline'));
        $news->description = trim($req->input('description'));
        $news->text = trim($req->input('newsText'));
        //$news->likes = 0;
        $news->category_id = intval($req->input('category'));
        //$news->deleted = 0;
        if (!is_null($req->file('photo'))) {
            // Get image file
            $image = $req->file('photo');
            $name =  $image->getClientOriginalName();
            // Define folder path
            $folder = '/uploads/images/';
            $filePath = $folder . $name;
            // Upload image
            if(!file_exists($filePath)){
                $this->uploadOne($image, $folder, 'public', $name);
            }
            $news->photo = $filePath;
        }
        $news->save();
        return redirect()->route('home')->with('success','Новость добавлена');
    }

    public function uploadOne(UploadedFile $uploadedFile, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(25);

        $file = $uploadedFile->storeAs($folder, $name, $disk);

        return $file;
    }
    public function allData(Request $req){
        $news = new News;
        $sortType = $req->sort;
        $categoryType = $req->category;

        //Группировка
        switch ($categoryType){
            case '1':
                $news = $news->where('category_id','=','1');
                break;
            case '2':
                $news = $news->where('category_id','=','2');
                break;
            case '3':
                $news = $news->where('category_id','=','3');
                break;
            default:
                $categoryType='all';
                break;
        }
        //Сортировка
        switch ($sortType){
            case 'date_desc':
                $news = $news->orderBy('created_at','desc');
                break;
            case 'likes':
                $news = $news->orderBy('likes','desc');
                break;
            case 'likes_asc':
                $news = $news->orderBy('likes','asc');
                break;
            default:
                $sortType = 'date';
                $news = $news->orderBy('created_at','asc');
                break;
        }
        //Вывод
        $categories = DB::table('categories')->select('name')->get();
        return view('home',['data'=>$news->get(),'sortType'=>$sortType, 'categoryType'=>$categoryType, 'categories'=>$categories]);
    }

    public function showOneNews($id){
        $news = new News;
        $categories = DB::table('categories')->select('name')->get();
        return view('oneNews',['data'=>$news->find($id),'categories'=>$categories]);
    }
    public function editNews($id){
        $news = new News;
        return view('editNews',['data'=>$news->find($id)]);
    }
    public function editNewsSubmit($id, NewsRequest $req){
        $news = News::find($id);
        $news->headline = trim($req->input('headline'));
        $news->description = trim($req->input('description'));
        $news->text = trim($req->input('newsText'));
        $news->category_id = intval($req->input('category'));
        //$news->deleted = 0;
        if (!is_null($req->file('photo'))) {
            // Get image file
            $image = $req->file('photo');
            $name =  $image->getClientOriginalName();
            // Define folder path
            $folder = '/uploads/images/';
            $filePath = $folder . $name;
            // Upload image
            if(!file_exists($filePath)){
                $this->uploadOne($image, $folder, 'public', $name);
                $news->photo = $filePath;
            }
        }
        $news->save();
        return redirect()->route('one-news',$id)->with('success','Новость сохранена');
    }
    public function deleteNews($id){
        $news = News::find($id);
        $news->deleted = 1;
        $news->save();
        return redirect()->route('home')->with('success','Новость удалена');
    }

    public function likeNews($id){
        $news = News::find($id);
        $news->likes += 1;
        $news->save();
        //return $news->likes;
    }
    public function getLikes($id){
        $news = News::find($id);
        return $news->likes;
    }
}
