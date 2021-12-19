@extends("user.master.layout")
@section("title","Trang Chủ Thành Đạt")
@section("js")
@endsection
@section("content")
<div id="box-slider">
    <div class="sliders">
        <div class="wp-sliders">
            @foreach($sliderBigs as $slider)
            <div class="slider-item">
                <a href="{{$slider->slider_link}}" class="slider-thumbnail">
                    <img 
                    src="{{asset("source/img/web/slider_loading.png")}}" 
                    data-src="{{asset($slider->slider_thumbnail)}}?time={{time()}}" class="thumbnail h-100 w-100 lazy">
                </a>
                <div class="lds-ring loader">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <nav class="navigate">
        <a href="" class="prev-slider"><i class="fas fa-arrow-left"></i></a>
        <a href="" class="next-slider"><i class="fas fa-arrow-right"></i></a>
    </nav>
</div>
<form id="hero-search" action="{{route("product")}}">
    <div class="container">
        <h2 class="title">Xin Chào Quý Khách Bạn Muốn Gì?</h2>
        <div class="form-group form-group-append">
            <input type="text" name="search" class="form-hero-control">
            <button class="btn btn-search" ><i class="fas fa-search"></i></button>
        </div>
    </div>
</form>
<div id="content">
    <div class="container">
        <!-- Main Categrory -->
        <div id="main-category">
            <h3 class="title">Danh Mục Của Shop</h3>
            <ul id="categorys" class="overflow-scroll overflow-y-hidden">
                @foreach($mainCats as $category)
                <li class="cat-item text-center col-xl-1 col-lg-2 col-md-2 col-sm-3 col-6">
                    <a href="{{route("product",[$category->cat_slug,"cat_id"=>$category->cat_id])}}" class="cat-link box-thumbnail d-inline-block">
                        <img data-src="{{ asset($category->cat_thumbnail)}}"
                            class="thumbnail-cat w-100 lazy h-100" alt="">
                    </a>
                    <a href="" class="cat-link fs-13 d-block">
                        {{$category->cat_title}}
                    </a>
                </li>
                @endforeach
            </ul>
        </div>
        @foreach($catProducts as $key => $cat)
        <div class="box-product load-data load-product" data-cat="{{$cat->cat_id}}">
            <div class="top-cat">
                <h3 class="title">{{$cat->cat_title}}</h3>
                <ul class="sub-cat">
                    @php
                        $catChildrens=$cat->getChildrens();
                    @endphp
                    @foreach($catChildrens as $catChildren)
                        <li class="cat-item" data-cat="{{$catChildren->cat_id}}">
                            <div class="box">
                                <a href="javascript:void(0)" class="cat-thumbail d-inline-block">
                                    <img data-src="{{ asset($catChildren->cat_thumbnail)}}"
                                        class="thumbnail w-100 lazy" alt="{{$cat->cat_title}}">
                                </a>
                                <a href="javascript:void(0)" class="cat-title d-block">{{$catChildren->cat_title}}</a>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="products mb-30">
                <!--Inser Dom-->
            </div>
            <div class="lds-ring loader loader-dark">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
            @if($key===0)
            <!-- Slider Sub -->
            <div class="slider-sub">
                @foreach($sliderSmalls as $slider)
                <div class="slider-item">
                    <a href="" class="slider-link round-5 overflow-hidden">
                        <img src="{{ asset($slider->slider_thumbnail)}}" class="slider-thumbnail w-100 h-100" alt="">
                    </a>
                </div>
                @endforeach
            </div>
            @endif
        @endforeach
        @foreach($catPosts as $catPost)
        <div class="box-post load-data load-post py-50" data-cat="{{$catPost->cat_id}}">
            <div class="top-post">
                <h3 class="title">{{$catPost->cat_title}}</h3>
                {{-- <p class="subtitle">Chia Sẽ Kiến Thức Của Bạn</p> --}}
            </div>
            <div class="posts mb-20">
                 <!--Inser Dom-->
            </div>
            <div class="lds-ring loader loader-dark">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection