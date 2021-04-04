@extends('layout.master')

@section('title')
    Контакты
@endsection

@section('content')
    <h3 class="pb-3 mb-4 font-italic border-bottom">
        Контакты
    </h3>
    <div class="row">
        <div class="col-6">
            <p>
                <strong>
                    Москва, Ленинский проспект, дом 6, строение 20
                </strong>
            </p>
            <p>+7 (495) 154-09-36</p>
            <p>hello@skillbox.ru</p>

            <p>
                <strong>Как пройти пешком:</strong>
                С кольцевой Октябрьской выйдите на Ленинский проспект и пройдите по нему направо. После магазина re:Store пройдите в проем между домами. Зайдите в арку в дальнем конце двора. Время в пути 5-7 минут.
            </p>
            <p>
                <strong>Как проехать на машине:</strong>
                Въезд на парковку осуществляется с Ленинского проспекта.
            </p>
        </div>
        <div class="col-6">
            <img class="img-fluid" src="/img/contacts-map.png" alt="карта">
        </div>
        <div class="col-12 mt-5">
            <h3 class="pb-3 mb-4 font-italic border-bottom">Форма обратной связи</h3>
            @include('layout.errors')
            <form method="post" action="/admin/feedback">
                @csrf
                <div class="form-group">
                    <label for="InputEmail1">Введите ваш Email</label>
                    <input type="email" class="form-control" id="InputEmail1" name="email" aria-describedby="emailHelp">
                </div>
                <div class="form-group">
                    <label for="FormControlTextarea1">Ваше сообщение</label>
                    <textarea class="form-control" id="FormControlTextarea1" name="text" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection
