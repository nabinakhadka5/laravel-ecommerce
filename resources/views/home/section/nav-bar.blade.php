 <style>

    .dropbtn{
        padding: 16px;
        font-size : 16px;
        border : none;
        cursor: pointer;
    }

    .main-menu li,
    .dropdown li {
        position : relative;
    }

    .main-menu li:hover .dropdown,
    .dropdown li:hover .dropdown-subcontent{
        display:block;
    }

    .dropdown,
    .dropdown-subcontent{
        min-width:160px;
        background-color: #f9f9f9;
        box-shadow: 8px 8px 16px 0px rgba(0,0,0,0.2);
    }

    .dropdown li a:hover,
    .dropdown-subcontent li a:hover{
        background-color: #f1f1f1
    }

    .dropdown{
        position: absolute;
        tep: 100%;
        display: none;
    }

    .dropdown-subcontent {
        position: absolute;
        left:100% ;
        top: 0;
        display: none;
    }

    .dropdown-content{
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        box-shadow: 8px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .dropdown a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {

    }

    .dropdown-hover .dropdown-content {
        display:block ;
    }

    .dropdown:hover .dropbtn {
        background-color: #dddddd;
    }


</style>



<!-- Header -->
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>

                <div class="right-top-bar flex-w h-full">
                    <a href="{{ route('page-detail','help-and-faq') }}" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>

                    @auth

                        <a href="{{ route(auth()->user()->role) }}" class="flex-c-m trans-04 p-lr-25">
                            {{ auth()->user()->name }}
                        </a>
                    @else

                        <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                            Register Account
                        </a>

                        <a href="{{ route('login') }}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>
                    @endauth

                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{ route('homepage') }} " class="logo">
                    <img src="{{ asset('images/icons/logo-01.png') }}" alt="{{ env('APP_NAME', 'Ecommerce') }}">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="active-menu">
                            <a href="{{ route('homepage') }}">Home</a>
                        </li>

                        <li>
                            <a href=" {{ route('products-list') }} ">Shop</a>
                        </li>

                       <li>
                           {{ getHeader() }}
                       </li>

                        <li class="label1" data-label1="hot">
                            <a href="{{ route('featured-product') }}">Features</a>
                        </li>

                        <li>
                            <a href="{{ route('page-detail','about-us') }}">About</a>
                        </li>

                        <li>
                            <a href="{{ route('contact-us') }}">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="0">
                        <i class="zmdi zmdi-shopping-cart"></i>
                    </div>
{{--
                    <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>--}}

                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="index.html"><img src="images/icons/logo-01.png" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
                <i class="zmdi zmdi-shopping-cart"></i>
            </div>

            <a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="left-top-bar">
                    Free shipping for standard order over $100
                </div>
            </li>

            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m p-lr-10 trans-04">
                        Help & FAQs
                    </a>

                    @auth
                        <a href="{{ route(auth()->user()->role) }}" class="flex-c-m p-lr-10 trans-04">
                            {{ auth()->user()->name }}
                        </a>

                    @else

                        <a href=" {{ route('login') }} " class="flex-c-m p-lr-10 trans-04">
                            Register Account
                        </a>
                        <a href="{{ route('login') }}" class="flex-c-m p-lr-10 trans-04">
                             Login
                        </a>
                    @endauth

                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li>
                <a href="index.html">Home</a>
                <ul class="sub-menu-m">
                    <li><a href="index.html">Homepage 1</a></li>
                    <li><a href="home-02.html">Homepage 2</a></li>
                    <li><a href="home-03.html">Homepage 3</a></li>
                </ul>
                <span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
            </li>

            <li>
                <a href="product.html">Shop</a>
            </li>

            <li>
                <a href="shoping-cart.html" class="label1 rs1" data-label1="hot">Features</a>
            </li>

            <li>
                <a href="blog.html">Blog</a>
            </li>

            <li>
                <a href="about.html">About</a>
            </li>

            <li>
                <a href="contact.html">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="images/icons/icon-close2.png" alt="CLOSE">
            </button>

            <form class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>