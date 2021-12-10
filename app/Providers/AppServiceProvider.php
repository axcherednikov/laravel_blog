<?php

namespace App\Providers;

use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use App\Models\Task\Step;
use App\Models\Task\Task;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Blade::if('admin', fn() => auth()->check() && auth()->user()->isAdmin());

        Paginator::defaultSimpleView('pagination::simple-default');
        Paginator::defaultView('pagination::bootstrap-4');

        Relation::$morphMap = [
            'tasks' => Task::class,
            'steps' => Step::class,
            'posts' => Post::class,
            'news'  => News::class,
        ];
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.sidebar', function($view) {
            $view->with('tagsTaskCloud', Tag::tagsTaskCloud());
            $view->with('tagsPostCloud', Tag::tagsPostCloud());
            $view->with('tagsNewsCloud', Tag::tagsNewsCloud());
        });
    }
}
