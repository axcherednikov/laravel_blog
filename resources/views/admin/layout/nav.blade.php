<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home', [], false) }}">{{ config('app.name') }}</a>

        <div class="navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{ request()->is('admin')  ? 'active' : ''}}">
                    <a href="{{ route('admin.home', [], false) }}" class="nav-link">Главная</a>
                </li>

                <li class="nav-item {{ request()->is('admin/posts*')  ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.posts.index', [], false) }}">Статьи</a>
                </li>

                <li class="nav-item {{ request()->is('admin/news*')  ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.news.index', [], false) }}">Новости</a>
                </li>

                <li class="nav-item {{ request()->is('admin/feedback*')  ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.feedback.index', [], false) }}">Список обращений</a>
                </li>

                <li class="nav-item {{ request()->is('admin/reports*')  ? 'active' : ''}}">
                    <a class="nav-link" href="{{ route('admin.reports.index', [], false) }}">Отчёты</a>
                </li>
            </ul>

        {{-- <a class="btn btn-outline-success my-2 my-sm-0" >Search</a> --}}
        </div>
    </nav>
</div>
