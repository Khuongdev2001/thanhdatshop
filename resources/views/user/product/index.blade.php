@extends("user.master.layout")
@section("title","Danh Sách Sản Phẩm")
@section("js")
@endsection
@section("content")
<div id="content">
    <div class="container">
        <div class="breadcrumb">
            <a href="" class="breadcrumb-item">
                <span>Trang Chủ</span>
            </a>
            <a href="" class="breadcrumb-icon">
                <i class="fas fa-chevron-right"></i>
            </a>
            <a href="" class="breadcrumb-item">
                <span>Sản phẩm</span>
            </a>
        </div>
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
        <div class="product-box product-filter bg-light">
            <form class="sidebar-filter bg-light h-100 fs-13">
                <a href="" class="btn-sidebar-exit d-none d-inline-block-1024 ">
                    <i class="fas fa-times"></i>
                </a>
                <div class="sidebar-dialog h-100"></div>
                <!-- filter search -->
                <div class="filter-search filter">
                    <h3 class="title pb-10">Tìm Kiếm Sản Phẩm</h3>
                    <div class="form-group">
                        <input type="text" class="form-control" id="search" name="search" value="">
                        <a href="javascript:void(0)" class="btn-search"><i class="fas fa-search"></i></a>
                    </div>
                </div>
                <!-- filter cat -->
                <div class="filter-cat filter">
                    <h3 class="title">Danh Mục Nghành Hàng</h3>
                    @foreach($cats as $cat)
                    <div class="form-group form-group-hero input-style">
                        <input type="checkbox" class="form-check-control" id="cat_{{$cat->cat_id}}" value="{{$cat->cat_id}}"
                        name="cat_id">
                        <label class="checkbox" for="cat_{{$cat->cat_id}}"></label>
                        <label class="cat-name pl-10" for="cat_{{$cat->cat_id}}">{{$cat->cat_title}}</label>
                    </div>
                    @endforeach
                </div>
                <!-- filter price -->
                <div class="filter-price filter">
                    <h3 class="title">Giá Sản Phẩm</h3>
                    @foreach([
                        null=>"Mặt Định",
                        "0,100000"=>"Dưới 100.000VNĐ",
                        "100000,400000" => "100.000VNĐ-400.000VNĐ",
                        "400000,800000" => "400.000VNĐ-800.000VNĐ",
                        "800000,10000000000000" => "Trên 800.000VNĐ"
                    ] as $index => $value)
                        <div class="form-group form-group-hero input-style" id="box-filter-price">
                            <input type="radio" name="price" class="form-check-control" id="{{$index ?: "default"}}" value="{{$index}}">
                            <label class="radio" for="{{$index ?: "default"}}"></label>
                            <label class="price pl-10" for="{{$index ?: "default"}}">{{$value}}</label>
                        </div>
                    @endforeach
                </div>
                <!-- filter brand -->
                <div class="filter-brand filter">
                    <h3 class="title">Thương Hiệu</h3>
                    @foreach($brands as $brand)
                    <div class="form-group form-group-hero input-style">
                        <input type="checkbox" class="form-check-control" name="brand_id" value="{{$brand->brand_id}}"
                        id="brand_{{$brand->brand_id}}">
                        <label class="checkbox" for="brand_{{$brand->brand_id}}"></label>
                        <label class="price pl-10" for="brand_{{$brand->brand_id}}">{{$brand->brand_name}}</label>
                    </div>
                    @endforeach
                </div>
            </form>
            <div class="product-filtered">
                <h3 class="title py-10">Phụ Liệu Tóc</h3>
                <div class="box-product">
                    <!-- filter sort -->
                    <div class="filter-sort fs-16">
                        <a class="pr-10 input-style">
                            <div class="d-inline-block">
                                <input type="radio" class="form-check-control" name="price_sort" value="desc" id="price_desc">
                                <label class="radio" for="price_desc"></label>
                            </div>    
                            <label class="cat-name pl-5" for="price_desc">
                                Giá
                                <i class="fas fa-sort-amount-down-alt"></i>
                            </label>
                        </a>
                        <a class="pr-10 input-style">
                            <div class="d-inline-block">
                                <input type="radio" class="form-check-control" name="price_sort" value="asc" id="price_asc">
                                <label class="radio" for="price_asc"></label>
                            </div>    
                            <label class="cat-name pl-5" for="price_asc">
                                Giá
                                <i class="fas fa-sort-amount-up-alt"></i>
                            </label>
                        </a>

                        <a href="" data-target=".sidebar-filter" class="btn-show-filter py-5 float-right d-none d-inline-block-1024">
                            Lọc
                            <i class="fas fa-filter"></i>
                        </a>
                    </div>
                    <div class="products w-100">
                        <div class="lds-ring loader loader-dark">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include("user.product.include.productSeen")
    </div>
</div>
@endsection