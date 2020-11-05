<aside class="col-md-4 blog-sidebar bg-light">
    <div class="p-3 mb-3 rounded">
        <h4 class="font-italic">Теги</h4>
        @include('posts.tags', ['tags' => $tagsCloud])
    </div>


    <div class="p-3 mb-3">
        <h4 class="font-italic">Погода</h4>
            <ul class="list-group">
                <li class="list-group-item">Время года: {{ $weatherData->fact->season }}</li>
                <li class="list-group-item">Условия: {{ $weatherData->fact->condition }}
                    <img class="img-thumbnail rounded-circle" width="35px"
                         src="https://yastatic.net/weather/i/icons/blueye/color/svg/{{ $weatherData->fact->icon }}.svg" alt="">
                </li>
                <li class="list-group-item">Температура: {{ $weatherData->fact->temp }} С</li>
                <li class="list-group-item">Ощущается как: {{ $weatherData->fact->feels_like }} C</li>
            </ul>

    </div>
</aside><!-- /.blog-sidebar -->


