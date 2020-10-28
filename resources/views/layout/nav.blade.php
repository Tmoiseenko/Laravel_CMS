<div class="row flex-nowrap justify-content-between align-items-center">
    <div class="col-4 pt-1">
        <a class="text-muted" href="#">Subscribe</a>
    </div>
    <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="{{ route('home') }}">{{ config('app.name') }}</a>
    </div>
    <div class="col-4 d-flex justify-content-end align-items-center">
            <!-- Authentication Links -->
            @guest
                    <a class="nav-link" href="{{ route('login') }}">Войти</a>
                @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">Регистрация</a>
                @endif
            @else
                    <a class="nav-link">
                        {{ Auth::user()->name }}
                    </a>

                        <a class="nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            Выйти
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>

            @endguest

    </div>
</div>
<div class="container mt-5">
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-between">
            <a class="p-2 text-muted" href="{{ route('home') }}">Главная</a>
            <a class="p-2 text-muted" href="{{ route('about') }}">О нас</a>
            <a class="p-2 text-muted" href="{{ route('contact') }}">Контакты</a>
            <a class="p-2 text-muted" href="{{ route('feedback.show') }}">Обращения</a>
            <a class="p-2 text-muted" href="{{ route('post.create') }}">Создать статью</a>
            <a class="p-2 text-muted" href="/admin">Админ. раздел</a>
        </nav>
    </div>
</div>
