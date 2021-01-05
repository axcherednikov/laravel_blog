<div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="{{ route('home', [], false) }}">{{ config('app.name') }}</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('admin.home', [], false) }}">Главная</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.posts.index', [], false) }}">Статьи</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.news.index', [], false) }}">Новости</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.feedback.show', [], false) }}">Список обращений</a>
                </li>

            </ul>

            <a class="btn btn-outline-success my-2 my-sm-0" >Search</a>
        </div>
    </nav>

</div>
