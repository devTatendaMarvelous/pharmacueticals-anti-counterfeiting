<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Fastkart">
    <meta name="keywords" content="Fastkart">
    <meta name="author" content="Fastkart">
    <link rel="icon" href="{{asset('logo.png')}}" type="image/x-icon">
    <title>Anti Counterfeit</title>

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/bootstrap.css')}}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}" />

    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/font-awesome.css')}}">

    <!-- feather icon css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/feather-icon.css')}}">

    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/slick/slick.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/slick/slick-theme.css')}}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bulk-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/vendors/animate.css')}}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{ URL::to('toastr.min.css') }}">
    <script src="{{ URL::to('toastr_jquery.min.js') }}"></script>
	<script src="{{ URL::to('toastr.min.js') }}"></script>
</head>

<body class="bg-effect" style="background-image: url('{{asset('landing-bg.jpg')}}');background-repeat: no-repeat;background-size: cover;min-height: auto;">

    <!-- Loader Start -->
 <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    <header class="pb-md-4 pb-0">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row p-0">
                    <div class="col-xxl-5 d-xxl-block d-none">
                        <div class="top-left-header row">
                              <a href="/" class="web-logo nav-logo col-3">
                                <img src="{{asset('logo.png')}}" class="img-fluid blur-up lazyload" alt="" style="max-width: 245px;">
                            </a>
                            <h2 class="text-white col-9 text-center"></h2>
                        </div>
                    </div>
                    <div class="col-1"></div>
                    <div class="col-xxl-6 col-lg-6 d-lg-block d-none mt-5">
                        <div class="header-offer">
                            <div class="notification-slider">
                                @forelse ( $notifications as $notification)
                                    <div>
                                    <div class="timer-notification ">
                                           <h3 class="text-black"> {{$notification->notification}}</h3>
                                    </div>
                                </div>
                                @empty
                                <h5 class="text-black">
                                    Anti Counterfeit
                                </h5>
                                @endforelse
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>

                            <div class="middle-box">

                                <div class="search-box">
                                    <div class="input-group">
                                        <form action="{{ route('search') }}" method="Get">
                                            {{-- @csrf --}}

                                            <input type="search" class="form-control" name="search" placeholder="I'm searching for..."
                                                aria-label="Recipient's username" aria-describedby="button-addon2">
                                            <button class="btn" type="submit" id="button-addon2" style="position: relative;bottom: 50px;left: 520px;">
                                                <i data-feather="search"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type" placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <a href="/carts" class="btn p-0 position-relative header-wishlist">
                                                <i data-feather="shopping-cart"></i>
                                                <span class="position-absolute top-0 start-100 translate-middle badge">
                                                       {{ $cartItems}}
                                                </span>
                                            </a>
                                        </div>
                                    </li>
                                    <li class="right-side ">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon  ">
                                                <a href="/check-verification" class="btn "style="background:  #1c5b77; color:#fff; margin-right:5px;">Check Verification</a>
                                            </div>
                                            @guest
                                            <div class="delivery-icon  ">
                                                <a href="/login" class="btn "style="background:  #1c5b77; color:#fff; margin-right:5px;">Log In</a>
                                            </div>
                                            <div class="delivery-detail ">
                                                <a href="/register" class="btn "style="background:  #1c5b77; color:#fff;">Register</a>
                                            </div>
                                                @else
                                                <h3 class="btn" style="background:  #1c5b77; color:#fff;margin-right:5px;">{{ Auth::user()->name }}</h3>

                                                <form action="{{ route('logout') }}" method="POST">
                                                                @csrf
                                                        <button type="submit" class="btn " style="background:  #1c5b77; color:#fff;"><i data-feather="log-out"></i>
                                                    <span>Log out</span></button>
                                                </form>
                                            @endguest

                                        </div>


                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="/">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li>
                <a href="search.html" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>Search</span>
                </a>
            </li>

            <li>
                <a href="wishlist.html" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li>
                <a href="cart.html">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->
{!! Toastr::message() !!}
    @yield('content')
    <!-- Footer Section Start -->
    <footer class="section-t-space mt-5">
        <div class="container-fluid-lg">

            <div class="sub-footer section-small-space">
                <div class="reserve">
                    <h6 class="text-content">Copyright {{date('Y')}}  ©  {{ config('app.name') }} by Nicole</h6>
                </div>

{{--                <div class="payment">--}}
{{--                    <img src="{{asset('frontend/images/payment/1.png')}}" class="blur-up lazyload" alt="">--}}
{{--                </div>--}}

                <div class="social-link">
                    <h6 class="text-content">Stay connected :</h6>
                    <ul>
                        <li>
                            <a href="https://www.facebook.com/" target="_blank">
                                <i class="fa-brands fa-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/" target="_blank">
                                <i class="fa-brands fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.instagram.com/" target="_blank">
                                <i class="fa-brands fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://in.pinterest.com/" target="_blank">
                                <i class="fa-brands fa-pinterest-p"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->



    <!-- Modal Start -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Logging Out</h5>
                    <p>Are you sure you want to log out?</p>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="button-box">
                        <button type="button" class="btn btn--no" data-bs-dismiss="modal">No</button>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal End -->


    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- latest jquery-->
    <script src="{{asset('frontend/js/jquery-3.6.0.min.js')}}"></script>

    <!-- jquery ui-->
    <script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>

    <!-- Bootstrap js-->
    <script src="{{asset('frontend/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap/popper.min.js')}}"></script>

    <!-- feather icon js-->
    <script src="{{asset('frontend/js/feather/feather.min.js')}}"></script>
    <script src="{{asset('frontend/js/feather/feather-icon.js')}}"></script>

    <!-- Lazyload Js -->
    <script src="{{asset('frontend/js/lazysizes.min.js')}}"></script>

    <!-- Slick js-->
    <script src="{{asset('frontend/js/slick/slick.js')}}"></script>
    <script src="{{asset('frontend/js/slick/slick-animation.min.js')}}"></script>
    <script src="{{asset('frontend/js/slick/custom_slick.js')}}"></script>

    <!-- Auto Height Js -->
    <script src="{{asset('frontend/js/auto-height.js')}}"></script>

    <!-- Timer Js -->
    <script src="{{asset('frontend/js/timer1.js')}}"></script>

    <!-- Fly Cart Js -->
    <script src="{{asset('frontend/js/fly-cart.js')}}"></script>

    <!-- Quantity js -->
    <script src="{{asset('frontend/js/quantity-2.js')}}"></script>

    <!-- WOW js -->
    <script src="{{asset('frontend/js/wow.min.js')}}"></script>
    <script src="{{asset('frontend/js/custom-wow.js')}}"></script>

    <!-- script js -->
    <script src="{{asset('frontend/js/script.js')}}"></script>

    <!-- thme setting js -->
    <script src="{{asset('frontend/js/theme-setting.js')}}"></script>
</body>


</html>
