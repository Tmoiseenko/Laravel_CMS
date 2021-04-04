@extends('admin.master')

@section('title')
    АдминПанель: Дашборд
@endsection

@section('content')
    <div class="panel panel-container">
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
                        <div class="large">{{ $newsCount }}</div>
                        <div class="text-muted">Новостей</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
                        <div class="large">{{ $postsCount }}</div>
                        <div class="text-muted">Статей</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
                        <div class="large">{{ $commentsCount }}</div>
                        <div class="text-muted">Комментариев</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-orange panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
                        <div class="large">{{ $usersCount }}</div>
                        <div class="text-muted">Пользователей</div>
                    </div>
                </div>
            </div>

        </div><!--/.row-->
    </div>

    <div class="panel-body articles-container">
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $userWithMaxPost->posts_count }}</div>
                        <div class="text-muted">шт</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>Пользоветель с максимальным кол-ом постов</h4>
                        <p>{{ $userWithMaxPost->name }}</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $mostPopularPost->comments_count }}</div>
                        <div class="text-muted">шт</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            Самая обсуждаемая статья
                        </h4>
                        <p>
                            <a href="{{ route('admin.post.edit', ['post' => $mostPopularPost->slug]) }}">{{ $mostPopularPost->title }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $postMaxBody->cnt }}</div>
                        <div class="text-muted">символов</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            Самая длинная статья
                        </h4>
                        <p>
                            <a href="{{ route('admin.post.edit', ['post' => $postMaxBody->slug]) }}">{{ $postMaxBody->title }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $postMinBody->cnt }}</div>
                        <div class="text-muted">символов</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            Самая короткая статья
                        </h4>
                        <p>
                            <a href="{{ route('admin.post.edit', ['post' => $postMinBody->slug]) }}">{{ $postMinBody->title }}</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $avgUSerPosts }}</div>
                        <div class="text-muted">шт</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            Среднее количество статей у активного пользователя
                        </h4>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
    </div>


@endsection
