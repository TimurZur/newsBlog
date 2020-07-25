<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\News;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function submit(NewsRequest $req){
        $news = new News();
        $news->headline = trim($req->input('headline'));
        $news->description = trim($req->input('description'));
        $news->text = trim($req->input('newsText'));
        $news->likes = 0;
        $news->category = $req->input('category');
        $news->deleted = 0;
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
    public function allData(){
        $news = new News;
        return view('home',['data'=>$news->all()]);
    }

    public function showOneNews($id){
        $news = new News;
        return view('oneNews',['data'=>$news->find($id)]);
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
        $news->category = $req->input('category');
        $news->deleted = 0;
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
