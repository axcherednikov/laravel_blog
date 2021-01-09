<?php

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\TagRequest;
use App\Models\News\News;
use App\Services\TagService;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->simplePaginate(5);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request, TagRequest $tagRequest, TagService $tagService)
    {
        $news = News::create($request->validated());

        $tagService->setTags($news, $tagRequest);

        flash('Новость создана');

        return redirect()->route('admin.news.index');
    }

    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(News $news, NewsRequest $newsRequest, TagRequest $tagRequest, TagService $tagService)
    {
        $news->update($newsRequest->validated());

        $tagService->setTags($news, $tagRequest);

        flash('Новость обновлена');

        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news)
    {
        $news->delete();

        flash('Новость удалена', 'danger');

        return back();
    }
}
