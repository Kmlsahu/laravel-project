<!-- Start Main Top -->
<div class="main-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="text-slid-box">
                    <div id="offer-box" class="carouselTicker">
                        <ul class="offer-box">
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 10%! Shop Now Man
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 50% - 80% off on Fashion
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> 20% off Entire Purchase Promo code: offT20
                            </li>
                            <li>
                                <i class="fab fa-opencart"></i> Off 50%! Shop Now
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="custom-select-box">
                    <select id="basic" class="selectpicker show-tick form-control" data-placeholder="$ USD">
                        <option>¥ JPY</option>
                        <option>$ USD</option>
                        <option>€ EUR</option>
                    </select>
                </div>
                <div class="right-phone-box">
                    <p>Call US :- <a href="#"> +11 900 800 100</a></p>
                </div>
                <div class="our-link">
                    <ul>
                        {{-- <li> --}}
                        <div class="btn-group" style="float: right;">
                            <button type="button" class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown" style="color: #ffffff; font-weight: 700; text-transform: uppercase; font-size: 14px; background-color: transparent; border: none;">
                                My Account
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                @if(Auth::user())
                                <a class="dropdown-item" href="{{ route('customer.profile') }}"><i class="fas fa-user"></i> Profile</a>
                                <a class="dropdown-item" href="{{ route('customer.logout') }}"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                @else
                                <a class="dropdown-item" href="{{ route('customer.login') }}">Sign In</a>
                                <a class="dropdown-item" href="{{ route('customer.create') }}">Sign Up</a>
                                @endif
                            </div>
                        </div>
                        {{-- </li>
                        
                        <li><a href="#">Our location</a></li> --}}
                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Main Top -->

<!-- Start Main Top -->
<header class="main-header">
    <!-- Start Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light navbar-default bootsnav">
        <div class="container">
            <!-- Start Header Navigation -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu"
                    aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="{{ '/' }}"><img src="{{ asset('web-assets/images/logo.png') }}"
                        class="logo" alt=""></a>
            </div>
            <!-- End Header Navigation -->

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="navbar-menu">
                <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                    <li class="nav-item active"><a class="nav-link" href="{{ '/' }}">Home</a></li>
                    @foreach (Category() as $cate)
                        <li class="dropdown">
                            <a href="#" class="nav-link dropdown-toggle arrow"
                                data-toggle="dropdown">{{ $cate->name }}</a>
                            <ul class="dropdown-menu">
                                <li>
                                    <ul class="menu-col">
                                        @foreach (SubCategory($cate->id) as $subcate)
                                            <li><a
                                                    href="{{ route('category', $subcate->url_key) }}">{{ $subcate->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    @endforeach

                    <li class="nav-item"><a class="nav-link" href="{{ route('contact') }}">Contact Us</a></li>
                </ul>
            </div>

            <!-- /.navbar-collapse -->

            <!-- Start Atribute Navigation -->
            <div class="attr-nav">
                <ul>
                    <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                    <li class="side-menu"><a href="#" class="cart_show">
                            <i class="fa fa-shopping-bag"></i>
                            <span class="badge">{{ cartSummaryCount() }}</span>
                        </a></li>
                </ul>
            </div>
            <!-- End Atribute Navigation -->
        </div>
        <!-- Start Side Menu -->
        <div class="side">
            <a href="#" class="close-side"><i class="fa fa-times"></i></a>
            <li class="cart-box">
                <ul class="cart-list">

                    
                    @if (function_exists('cartShow') && cartShow() && cartShow()->items)
                        @foreach (cartShow()->items as $item)
                            <li>
                                <a href="#" class="photo"><img src="{{ productImage($item->product_id) }}"
                                        class="cart-thumb" alt="" /></a>
                                <h6><a href="#">{{ $item->name }} </a></h6>
                                <p>{{ $item->qty }}x - <span class="price">₹{{ $item->price }}</span></p>
                            </li>
                        @endforeach
                        <li class="total">
                            <a href="{{ route('cart') }}" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: ₹{{ cartShow()->total }}</span>
                        </li>
                    @else
                        <li>No items in cart.</li>
                    @endif

                </ul>
            </li>
        </div>
        <!-- End Side Menu -->
    </nav>
    <!-- End Navigation -->
</header>
<!-- End Main Top -->

<!-- Start Top Search -->
<div class="top-search">
    <div class="container">
        <div class="input-group">
            <span class="input-group-addon"><i class="fa fa-search"></i></span>
            <input type="text" class="form-control" placeholder="Search">
            <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>
        </div>
    </div>
</div>
<!-- End Top Search -->
