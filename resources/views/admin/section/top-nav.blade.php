<header class="header">
    <div class="page-brand">
        <a class="link" href="{{ route(request()->user()->role) }}">
                    <span class="brand">Admin
                        <span class="brand-tip">Ecommerce</span>
                    </span>
            <span class="brand-mini">AE</span>
        </a>
    </div>
    <div class="flexbox flex-1">
        <!-- START TOP-LEFT TOOLBAR-->
        <ul class="nav navbar-toolbar">
            <li>
                <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
            </li>

        </ul>
        <!-- END TOP-LEFT TOOLBAR-->
        <!-- START TOP-RIGHT TOOLBAR-->
        <ul class="nav navbar-toolbar">

            <li class="dropdown dropdown-notification">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-bell rel">
                        <span class="notify-signal">
                        </span>
                    </i>
                </a>
                <ul class="dropdown-menu dropdown-menu-right dropdown-menu-media">
                    <li class="dropdown-menu-header">
                        <div>
                            <span><strong>5 New</strong> Notifications</span>
                            <a class="pull-right" href="javascript:;">view all</a>
                        </div>
                    </li>
                    <li class="list-group list-group-divider scroller" data-height="240px" data-color="#71808f">
                        <div>

                            <a class="list-group-item">
                                <div class="media">
                                    <div class="media-img">
                                        <span class="badge badge-default badge-big"><i class="fa fa-shopping-basket"></i></span>
                                    </div>
                                    <div class="media-body">
                                        <div class="font-13">You have 12 new orders</div><small class="text-muted">40 mins</small></div>
                                </div>
                            </a>

                        </div>
                    </li>
                </ul>
            </li>
            <li class="dropdown dropdown-user">
                <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                    <i class="fa fa-user"></i>
                    &nbsp;&nbsp;&nbsp;
                    {{request()->user()->name}}<i class="fa fa-angle-down m-l-5"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                    <li class="dropdown-divider"></li>
                    <a class="dropdown-item" href="" onclick="event.preventDefault();document.getElementById('logout-form').submit()">
                        <i class="fa fa-power-off"></i>Logout
                    </a>

                    {{Form::open(['url'=>route('logout'),'class'=>'d-none','id'=>'logout-form'] )}}
                    @csrf
                    {{Form::close()}}

                </ul>
            </li>
        </ul>
        <!-- END TOP-RIGHT TOOLBAR-->
    </div>
</header>
<!-- END HEADER-->