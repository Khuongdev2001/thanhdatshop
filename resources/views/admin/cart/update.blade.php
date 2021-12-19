@extends('admin.master.layout')
@section("title","Cập Nhật Đơn Hàng")
@section('css')
    <!-- notification Css
	============================================ -->
@endsection
@section('js')
@endsection
@section('content')
<div class="breadcome-area">
    <div class="container-fluid">
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
             <div class="breadcome-list">
                <div class="row">
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="breadcomb-wp">
                         <div class="breadcomb-icon">
                            <i class="icon nalika-home"></i>
                         </div>
                         <div class="breadcomb-ctn">
                            <h2>Cập Nhật Đơn Hàng</h2>
                            <p>Welcome to Nalika <span class="bread-ntd">Admin Template</span></p>
                         </div>
                      </div>
                   </div>
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                      <div class="breadcomb-report">
                         <button data-toggle="tooltip" data-placement="left" title="Download Report" class="btn"><i class="icon nalika-download"></i></button>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
 <div class="single-product-tab-area mg-b-30">
    <!-- Single pro tab review Start-->
    <div class="single-pro-review-area">
       <div class="container-fluid">
          <div class="row">
             <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="review-tab-pro-inner">
                   <div id="myTabContent" class="tab-content custom-product-edit">
                      <form id="form-update-cart" action="{{route("admin.cart.update",$cart->cart_id)}}" 
                      enctype="multipart/form-data" method="POST">
                         @csrf
                        <label for="">Thay Đổi Trang Thái Đơn Hàng</label>
                        <select name="cart_status" id="cart_status" class="form-control">
                            @foreach($cartStatus as $key=>$value)
                                <option value="{{$key}}" @if($key==$cart->cart_status) selected @endif>{{$value}}</option>
                            @endforeach
                        </select>
                        <div class="form-group text-center custom-pro-edt-ds my-10">
                            <button class="btn btn-ctl-bt waves-effect waves-light">Cập Nhật</button>
                        </div>
                      </form>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection