<?php

namespace App\Providers;

use App\Models\Post\Tag;
use App\Services\PostsService;
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
        $this->app->bind(PostsService::class, function () {
            return new PostsService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.sidebar', function ($view) {
            $view->with('tagsTaskCloud', \App\Models\Task\Tag::tagsCloud());
            $view->with('tagsPostCloud', Tag::tagsCloud());
        });
    }
}
