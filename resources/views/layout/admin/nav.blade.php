<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <div class="profile-sidebar">
        <div class="profile-userpic">
            <img src="http://placehold.it/50/30a5ff/fff" class="img-responsive" alt="">
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
        <li class="nav-link @linkactive('admin.post')"><a href="{{ route('admin.post') }}"><em class="fa fa-calendar"></em> Статьи</a></li>
        <li class="nav-link @linkactive('admin.news')"><a href="{{ route('admin.news') }}"><em class="fa fa-calendar"></em> Новости</a></li>
        <li>
            <a class="nav-link" href="{{ route('logout') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <em class="fa fa-power-off">&nbsp;</em> Выйти
            </a>
        </li>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </ul>
</div><!--/.sidebar-->

