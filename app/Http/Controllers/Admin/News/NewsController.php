<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Models\News\News;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::simplePaginate(5);

        return view('admin.news.index', compact('news'));
    }
}
