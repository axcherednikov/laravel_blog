<?php

use App\Models\Comment\Comment;
use App\Models\News\News;
use App\Models\Post\Post;
use App\Models\Tag\Tag;
use App\Models\User;

return [

    News::class => 'Новости',
    Tag::class => 'Теги',
    Post::class => 'Статьи',
    User::class => 'Пользователи',
    Comment::class => 'Комментарии',

];
