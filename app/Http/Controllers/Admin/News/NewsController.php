<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin\News;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsRequest;
use App\Http\Requests\TagRequest;
use App\Models\News\News;
use App\Services\TagService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class NewsController extends Controller
{
    public function index(): Factory|View|Application
    {
        $news = News::latest()->simplePaginate(20);

        return view('admin.news.index', compact('news'));
    }

    public function create(): Factory|View|Application
    {
        return view('admin.news.create');
    }

    public function store(NewsRequest $request, TagRequest $tagRequest, TagService $tagService): RedirectResponse
    {
        $news = News::create($request->validated());

        $tagService->setTags($news, $tagRequest);

        flash('Новость создана');

        return redirect()->route('admin.news.index');
    }

    public function edit(News $news): Factory|View|Application
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(News $news, NewsRequest $newsRequest, TagRequest $tagRequest, TagService $tagService): RedirectResponse
    {
        $news->update($newsRequest->validated());

        $tagService->setTags($news, $tagRequest);

        flash('Новость обновлена');

        return redirect()->route('admin.news.index');
    }

    public function destroy(News $news): RedirectResponse
    {
        $news->delete();

        flash('Новость удалена', 'danger');

        return back();
    }
}
