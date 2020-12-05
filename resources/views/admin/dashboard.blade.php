@extends('admin.master')
@section('content')
    <div class="panel panel-container">
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
                        <div class="large">{{ $news->count() }}</div>
                        <div class="text-muted">Новостей</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-red panel-widget ">
                    <div class="row no-padding"><em class="fa fa-xl fa-search color-red"></em>
                        <div class="large">{{ $posts->count() }}</div>
                        <div class="text-muted">Статей</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-teal panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-shopping-cart color-blue"></em>
                        <div class="large">{{ $news->count() }}</div>
                        <div class="text-muted">Среднее кол-во статей</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-blue panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-comments color-orange"></em>
                        <div class="large">{{ $comments->count() }}</div>
                        <div class="text-muted">Комментариев</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-orange panel-widget border-right">
                    <div class="row no-padding"><em class="fa fa-xl fa-users color-teal"></em>
                        <div class="large">{{ $users->count() }}</div>
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
                        <div class="large">{{ $maxPostCount }}</div>
                        <div class="text-muted">шт</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>{{ $userWithMaxPost->name }}</h4>
                        <p>Пользоветель с максимальным кол-ом постов</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $maxCommentCount }}</div>
                        <div class="text-muted">шт</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            <a href="{{ route('admin.post.edit', ['post' => $mostPopularPost->slug]) }}">{{ $mostPopularPost->title }}</a>
                        </h4>
                        <p>Самая обсуждаемая статья</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $postsWithLength->first()->length }}</div>
                        <div class="text-muted">символов</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            <a href="{{ route('admin.post.edit', ['post' => $postsWithLength->first()->slug]) }}">{{ $postsWithLength->first()->title }}</a>
                        </h4>
                        <p>Самая длинная статья</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $postsWithLength->last()->length }}</div>
                        <div class="text-muted">символов</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        <h4>
                            <a href="{{ route('admin.post.edit', ['post' => $postsWithLength->last()->slug]) }}">{{ $postsWithLength->last()->title }}</a>
                        </h4>
                        <p>Самая короткая статья</p>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
        <div class="article border-bottom">
            <div class="col-xs-12">
                <div class="row">
                    <div class="col-xs-2 col-md-2 date">
                        <div class="large">{{ $mostFicklePostRaw->cnt ?? 0 }}</div>
                        <div class="text-muted">кол-во изменений</div>
                    </div>
                    <div class="col-xs-10 col-md-10">
                        @if($mostFicklePost)
                            <h4>
                                <a href="{{ route('admin.post.edit', ['post' => $mostFicklePost->slug]) }}">{{ $mostFicklePost->title }}</a>
                            </h4>
                            <p>Самая непостоянная статья</p>
                        @else
                            <p>Статьи не изменялись</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="clear"></div>
        </div><!--End .article-->
    </div>

    <div class="article border-bottom">
            <h4>Среднее количество статей у автором</h4>
            <table class="table mt-4">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Среднее кол-во статей</th>
                    <th scope="col">Имя автора</th>
                </tr>
                </thead>
                <tbody>
                @if($avgPostCount)
                    @foreach($avgPostCount as $post)
                        <tr>
                            <th scope="row">{{ round($post->cnt) }}</th>
                            <td>{{ $post->name }}</td>
                        </tr>
                    @endforeach
                @endif
                </tbody>
            </table>
        </div>

@endsection
