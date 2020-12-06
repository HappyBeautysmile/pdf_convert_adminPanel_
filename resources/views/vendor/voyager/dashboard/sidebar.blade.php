<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
            </div><!-- .navbar-header -->
            <div class="panel widget center bgimage"
                 style="background-image:url({{ Voyager::image( Voyager::setting('admin.bg_image'),('bg.jpg') ) }}); background-size: cover; background-position: 0px;">
                <div class="dimmer"></div>
                <div class="panel-content" style="height:30px;">
                    <!-- <img src="{{ $user_avatar }}" class="avatar" alt="{{ Auth::user()->name }} avatar"> -->
                    <h4>{{ ucwords(Auth::user()->name) }}</h4>
                    <p>{{ Auth::user()->email }}</p>
                    <a href="{{ route('voyager.profile') }}" class="btn btn-primary">{{ __('voyager::generic.profile') }}</a>
                    <div style="clear:both"></div>
                </div>
            </div>

        </div>
        <div id="adminmenu">
            <ul class="nav navbar-nav">
                <li class="">
                <!-- href="{{ url('/homePage') }} -->
                    <!-- <a target="_self" href="{{ url('/admin/roles') }}">
                        <span class="icon voyager-lock"></span> <span class="title">Roles</span>
                    </a>  -->
                    <!---->
                </li>
                <li class="">
                    <a target="_self"  href="{{ url('/admin/users') }}">
                        <span class="icon voyager-person"></span> <span class="title">Users</span></a>
                </li>
            </ul>
    </nav>
</div>
