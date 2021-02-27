<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="{{ asset('/img/avatar.png') }}" class="img-responsive" alt="">
        </div>
        <div class="profile-usertitle">
            <div class="profile-usertitle-name">{{ Auth::user()->name }}</div>
            <div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
        </div>
        <div class="clear"></div>
    </div>
    <div class="divider"></div>

    <ul class="nav menu">
        <li class="nav-link @linkactive('admin.index')"><a href="{{ route('admin.index') }}"><em class="fa fa-dashboard"></em> Dashboard</a></li>
        <li class="nav-link @linkactive('admin.post')"><a href="{{ route('admin.post') }}"><em class="fa fa-file-text-o"></em> Статьи</a></li>
        <li class="nav-link @linkactive('admin.news')"><a href="{{ route('admin.news') }}"><em class="fa fa-newspaper-o"></em> Новости</a></li>
        <li class="parent "><a data-toggle="collapse" href="#sub-item-1" class="collapsed" aria-expanded="false">
                <em class="fa fa-line-chart">&nbsp;</em> Отчеты <span data-toggle="collapse" href="#sub-item-1" class="icon pull-right collapsed" aria-expanded="false"><em class="fa fa-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1" aria-expanded="false" style="height: 0px;">
                <li><a class="" href="{{ route('admin.report.total', 'total') }}">
                        <span class="fa fa-arrow-right">&nbsp;</span> Итоговый
                    </a></li>
            </ul>
        </li>
    </ul>
</div><!--/.sidebar-->

