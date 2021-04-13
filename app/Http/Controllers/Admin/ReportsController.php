<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Jobs\CountModelsReport;
use App\Models\Comment\Comment;
use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ReportsController extends Controller
{
    public function index(): Factory|View|Application
    {
        return view('admin.reports.index');
    }

    public function total(): Factory|View|Application
    {
        $models = collect([
            News::class => 'Новости',
            Tag::class => 'Теги',
            Post::class => 'Статьи',
            User::class => 'Пользователи',
            Comment::class => 'Комментарии',
        ]);

        return view('admin.reports.total', compact('models'));
    }

    public function generate(): RedirectResponse
    {
        $models = request()->input('reports_list');

        if ($models) {

            $newModels = [];

            foreach ($models as $model) {
                $temp = explode('|', $model);

                $newModels[$temp[0]] = $temp[1];
            }

            CountModelsReport::dispatch($newModels, auth()->user()->email);

            flash('После создания отчёт будет отправлен Вам на почту!');
        } else {
            flash('Выберите модели из списка для получения отчёта', 'warning');
        }

        return back();
    }
}
