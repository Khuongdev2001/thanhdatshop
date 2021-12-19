<!DOCTYPE html>
<html lang="en">

<head>
    @include("user.master.header")
</head>

<body class="dark">
    <div id="wrapper">
        <header>
            <div class="container">
                <nav id="nav">
                    <a href="{{route("home")}}" class="d-block" id="main-logo">
                        <img src="{{asset("source/img/web/logo.jpg")}}" class="logo w-100" alt="logo thành đạt">
                    </a>
                    <ul id="main-menu">
                        @include("user.master.menu",["menus"=>$menus,"parent_id"=>0])
                    </ul>
                    <!-- Menu Mobile !-->
                    <div id="box-menu-mobile" class="d-none">
                        <div class="box-overflow">
                            <div class="box-btn">
                                <a href="" class="btn-exit"><i class="fas fa-times"></i></a>
                            </div>
                            <a href="{{route("home")}}" class="d-block" id="main-logo">
                                <img src="{{asset("source/img/web/logo.jpg")}}" class="logo w-100" alt="logo thành đạt">
                            </a>
                            <ul id="main-menu-mobile">
                                @include("user.master.menuMobile",["menuMobiles"=>$menuMobiles,"parent_id"=>0])
                            </ul>
                        </div>
                    </div>
                </nav>
                <div id="heade-auth">
                    @auth
                    <div class="dropdown is-login">
                        <a href="" class="box-thumbnail" data-toggle="dropdown">
                            @if($userLogin->avatar)
                                <img data-src="{{asset($userLogin->avatar)}}" class="w-100 thumbnail lazy d-block" alt="">
                            @elseif($userLogin->avatar_cdn)
                                <img data-src="{{$userLogin->avatar_cdn}}" class="w-100 thumbnail lazy d-block" alt="">      
                            @else
                            <span class="w-100 thumbnail d-block"></span>                            
                            @endif
                        </a>
                        <div class="dropdown-menu">
                            <div class="top">
                                <i class="fas fa-caret-up"></i>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{route("cart.history")}}" class="dropdown-link">
                                    <span class="title"><i class="fas fa-chart-line"></i></span>
                                    <span class="content">Đơn Hàng Của Tôi</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{route("user.address")}}" class="dropdown-link">
                                    <span class="title"><i class="fas fa-map-marker-alt"></i></span>
                                    <span class="content">DS Địa Chỉ</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{route("user.account")}}" class="dropdown-link">
                                    <span class="title"><i class="fas fa-user"></i></span>
                                    <span class="content">{{$userLogin->fullname}}</span>
                                </a>
                            </div>
                            <div class="dropdown-item">
                                <a href="{{route("logout")}}" class="dropdown-link">
                                    <span class="title"><i class="fas fa-sign-out-alt"></i></span>
                                    <span class="content fs-1">Đăng Xuất</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endauth
                    @guest
                    <a href="" class="btn-login btn btn-yellow btn-round" data-toggle="modal" data-target="#modal-login">Đăng Nhập</a>   
                    @endguest
                    <a href="{{route("cart")}}" class="box-cart">
                        <span class="cart-icon">
                            <span class="cart-num">{{session("cart.cartInfo.totalQty",0)}}</span>
                            <i class="fas fa-shopping-cart"></i>
                        </span>
                        <span class="cart-title">Giỏ Hàng</span>
                    </a>
                    <a href="" class="btn-mode"><i class="fas fa-moon"></i></a>
                    <a href="" class="btn-open-menu-mobile"><i class="fas fa-bars"></i></a>
                </div>
            </div>
        </header>
        <div id="wp-content">
            @yield("content")
        </div>
        @include("user.master.footer")
    </div>
    @include("user.master.modal")
</body>
    <!-- defind router Js
		============================================ -->
        <script src="{{asset("source/js/router.js")}}"></script>
    <!-- defind function Js
		============================================ -->
        <script src="{{asset("source/js/function.js")}}"></script>
    <!-- app Js
		============================================ -->
    <script src="{{asset("source/js/app.js")}}"></script>
    <script>
        /* Start Notification Js*/
        @if($errors->any())
            @foreach($errors->all() as $error)
                Toastr({ type:"error", title:"Error", message:"{{$error}}"})
            @endforeach
        @endif
        @if(session("success"))
            Toastr({ type:"success", title:"Success", message:"{{session('success')}}"})
        @endif
    </script>
    @yield("js")
</html>