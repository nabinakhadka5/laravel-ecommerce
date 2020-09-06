<!-- START SIDEBAR-->
<nav class="page-sidebar" id="sidebar">
    <div id="sidebar-collapse">
        <div class="admin-block d-flex">
            <div  style="color:#cccccc;">
                <i class="fa fa-user fa-3x">
                    <div></div>
                </i>
            </div>
            <div class="admin-info">
                <div class="font-strong">{{request()->user()->name}}</div><small>{{request()->user()->role}}</small></div>
        </div>
        <ul class="side-menu metismenu">
            <li>
                <a class="active" href="{{route(auth()->user()->role)}}"><i class="sidebar-item-icon fa fa-th-large"></i>
                    <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li class="heading">FEATURES</li>

            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-images"></i>
                    <span class="nav-label">Slider Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('slider.create')}}">Add Slider</a>
                    </li>
                    <li>
                        <a href="{{ route('slider.index') }}">List Slider
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-sitemap"></i>
                    <span class="nav-label">Category Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('category.create')}}">Add Category</a>
                    </li>
                    <li>
                        <a href="{{ route('category.index') }}">List Category
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-basket"></i>
                    <span class="nav-label">Product Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="{{ route('product.create') }}">Add Product</a>
                    </li>
                    <li>
                        <a href="{{ route('product.index') }}">List Product
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                    <span class="nav-label">Order Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="javascript:;">List Order
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-user"></i>
                    <span class="nav-label">User Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">
                    <li>
                        <a href="javascript:;">Add User</a>
                    </li>
                    <li>
                        <a href="javascript:;">List User
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-comments"></i>
                    <span class="nav-label">Review Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="javascript:;">List Review
                        </a>
                    </li>

                </ul>
            </li>
            <li>
                <a href="javascript:;"><i class="sidebar-item-icon fa fa-file"></i>
                    <span class="nav-label">Pages Manager</span><i class="fa fa-angle-left arrow"></i></a>
                <ul class="nav-2-level collapse">

                    <li>
                        <a href="{{ route('page.index') }}">List Pages
                        </a>
                    </li>

                </ul>
            </li>
        </ul>
    </div>
</nav>
<!-- END SIDEBAR-->