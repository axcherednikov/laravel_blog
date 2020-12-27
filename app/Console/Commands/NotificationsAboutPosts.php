<?php

namespace App\Console\Commands;

use App\Models\Post\Post;
use App\Models\User;
use App\Notifications\NewPosts;
use Carbon\Carbon;
use Illuminate\Console\Command;

class NotificationsAboutPosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'posts:notify-new {--p|period=1 : Период в днях}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Уведомление о новых статьях за указанный период в днях';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $users = User::all();

        $period = $this->option('period') ?? 1;

        $countPeriod = $period . ' ' . trans_choice('день|дня|дней', $period, [], 'ru');

        $posts = Post::whereDate('created_at', '>', Carbon::now()->subDays($period))->get();

        if ($posts->isEmpty()) {
            $this->error('За указанный период статьи отсутствуют');

            return 0;
        }

        $users->map->notify(new NewPosts($posts, $countPeriod));

        $this->info('Уведомления отправлены');

        return 0;
    }
}
