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

