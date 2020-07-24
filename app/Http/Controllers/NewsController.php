<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\News;
class NewsController extends Controller
{
    public function submit(NewsRequest $req){
        $news = new News();
        $news->headline = $req->input('headline');
        $news->description = $req->input('description');
        $news->text = $req->input('newsText');
        $news->likes = 77;
        $news->category = $req->input('category');
        $news->deleted = 0;
        $news->save();
        return redirect()->route('home');
    }
}
