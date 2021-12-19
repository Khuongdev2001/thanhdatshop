@extends("user.master.layout")
@section("title","Bài Viết Của Tôi")
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
                <span>Bài Viết</span>
            </a>
        </div>
        <div class="box-post load-data load-post" data-cat="{{$cat->cat_id}}">
            <div class="top-post">
                <h3 class="title">{{$cat->cat_title}}</h3>
                {{-- <p class="subtitle">Chia Sẽ Kiến Thức Của Bạn</p> --}}
            </div>
            <div class="posts mb-20">
               <!-- insert dom !-->
            </div>
            <div class="lds-ring loader loader-dark">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
        @include("user.product.include.productSeen")
    </div>
</div>
@endsection