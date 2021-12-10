<?php

namespace App\Providers;

use App\Models\Post\Post;
use App\Models\Task\Step;
use App\Models\Task\Task;
use App\Policies\PostPolicy;
use App\Policies\StepPolicy;
use App\Policies\TaskPolicy;
use Illuminate\Contracts\Auth\Access\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Task::class => TaskPolicy::class,
        Step::class => StepPolicy::class,
        Post::class => PostPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @param Gate $gate
     * @return void
     */
    public function boot(Gate $gate)
    {
        $this->registerPolicies();

        $gate->before(function($user) {
            if ($user->isAdmin()) {
                return true;
            }
        });
    }
}
