<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * {parameter} - обязательный параметр
     * {parameter?} - необязательный параметр
     * {parameter=argument} - аргумент по умолчанию
     * {parameter*} -параметр в виде массива
     * {--option=argument} - опции команды
     * {--option} - опции без аргументов приравниваются к логическому значению
     * {--option=*} - массив опций
     * {parameter : description} - описание
     *
     * @var string
     */
    protected $signature = 'app:say_hello 
        {users?* : Пользователи} 
        {--s|subject=Hello : Заголовк письма} 
        {--c|class : Преобразовать в имя класса}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Отправить привет пользователю';

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
        if (app()->environment() == 'local') {
            return 0;
        }

        $users = $this->argument('users')
            ? User::findOrFail($this->argument('users'))
            : User::all();

        $subject = $this->option('subject');

        if ($this->option('class')) {
            $subject = Str::studly($subject);
        }

        $users->map->notify(new \App\Notifications\SayHello($subject));

        $this->info('Уведомления отправлены!');

        return 0;
    }
}
