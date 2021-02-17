@extends('admin.master')

@section('content')
    <div class="panel panel-default">
    <h3 class="panel-heading">Итоговый отчет</h3>
        <form class="panel-body" method="post" action="{{ route('admin.report.create', $template) }}">
            @csrf
            <div class="form-group">
                <label>Включить в отчет следующие параметры</label>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="postsCount">Обшее количество Статей
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="commentsCount">Обшее количество Новостей
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="usersCount">Обшее количество Пользователей
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="comments_count">Обшее количество Коментариев
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="userWithMaxPost">Пользоветель с максимальным кол-ом постов
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="mostPopularPost">Самая обсуждаемая статья
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="postMaxBody">Самая длинная статья
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="postMinBody">Самая короткая статья
                    </label>
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="avgUSerPosts">Среднее количество статей у активного пользователя
                    </label>
                </div>
            </div>

            <div class="form-group">
                <p><b>Прикрепить вложение в формате:</b></p>
                <div class="checkbox">
                    <p>
                        <input id="not_export" type="radio" name="export" value="not_export" checked>
                        <label for="not_export">Не прикреплять</label>
                    </p>
                    <p>
                        <input id="pdf" type="radio" name="export" value="pdf">
                        <label for="pdf">PDF </label>
                    </p>
                    <p>
                        <input id="xlsx" type="radio" name="export" value="xlsx">
                        <label for="xlsx">Excel</label>
                    </p>
                </div>
            </div>

            <button type="submit" class="btn btn-md btn-primary">С генерировать отчет</button>
        </form>
    </div>
@endsection
