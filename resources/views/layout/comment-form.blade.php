<form action="{{ $action }}" method="post">
    @csrf
    <div class="form-group">
        <label for="name">Ваше имя</label>
        <input type="text" class="form-control"
               name="name" id="name"
               placeholder="Иванов Иван"
               value="{{ auth()->user()->name??'' }}"
        >
    </div>
    <div class="form-group">
        <label for="email">Ваш email</label>
        <input type="email" class="form-control"
               name="email" id="email"
               placeholder="name@example.com"
               value="{{ auth()->user()->email??'' }}"
        >
    </div>
    <div class="form-group">
        <label for="message">Example textarea</label>
        <textarea class="form-control" name="message" id="message" rows="3"></textarea>
    </div>
    <div class="form-group">
        <button type="submit" class="btn btn-info">Отправить</button>
    </div>
</form>

