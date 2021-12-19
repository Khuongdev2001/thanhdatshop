@extends('admin.master.layout')
@section("title",isset($product) ? "Cập Nhật Sản Phẩm" : "Thêm Sản Phẩm")
@section('css')
    <!-- notification Css
	============================================ -->
<link rel="stylesheet" href="{{asset("source/admin/css/upload/upload_platform2.css")}}">
@endsection
@section('js')
@include('admin.include.tinyEditor')
<script src="{{asset("source/admin/js/upload/upload_platform2.js")}}"></script>
<script src="{{asset("source/admin/js/validate/validate.js")}}"></script>
    <script>
        /* Handle Upload File Js */        
        const preloaded = {!! isset($productThumbnails) ? json_encode($productThumbnails) : "[]" !!};
        $('.input-images').imageUploader(
            {
                imagesInputName: 'files',
                preloadedInputName: 'imgs',
                maxSize: 1 * 1024 * 1024,
                maxFiles: 10,
                preloaded
            }
        );
        /* Start Validate Form Login */
        Validator({
            form:"#form-add-product",
            rules:[
                Validator.isRequired("#product_title","Không Được Để Trống Tên Sản Phẩm!"),
                Validator.maxLengthValue("#product_title","Tên Sản Phẩm Tối Đa 150 Từ!",150)
            ]
        })
        FormatNumberInput([
           "#price-old-format",
           "#price-format"
        ]);
    </script>
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
                            <h2>{{isset($product) ? "Cập Nhật Sản Phẩm" : "Thêm Sản Phẩm"}}</h2>
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
                      <form id="form-add-product" action="{{ isset($product) 
                      ? route("admin.product.update",$product->product_id) 
                      : route("admin.product.add")
                      }}" enctype="multipart/form-data" method="POST">
                         @csrf
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <div class="review-content-section">
                                  <div class="form-group mg-b-pro-edt">
                                     <input type="text" id="product_title" class="form-control" name="product_title" 
                                        value="{{old("product_title") ?? $product->product_title ?? null}}" placeholder="Tên Sản Phẩm">
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                                  <div class="row mg-b-pro-edt">
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="product_slug" class="form-control" name="product_slug" 
                                           value="{{old("product_slug") ?? $product->product_slug ?? null}}" placeholder="Slug" disabled >
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                     <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                       <select class="form-control pro-edt-select form-control-primary" id="brand_id" name="brand_id">
                                          <option>Thương Hiệu</option>
                                          @foreach($brands as $brand)
                                          <option value="{{$brand->brand_id}}"
                                          {{ old("brand_id") 
                                          ? (old("brand_id") == $brand
                                             ? "selected"
                                             : null
                                             )
                                          : (isset($product) && $brand->brand_id==$product->brand_id
                                             ?  "selected"
                                             : null
                                             )
                                          }}
                                          >{{$brand->brand_name}}</option>
                                          @endforeach
                                       </select>
                                    </div>                                     
                                  </div>
                                  <div class="row mg-b-pro-edt">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="price-format" data-target="#price" class="form-control" 
                                             placeholder="Giá Mới" >
                                            <input type="hidden" id="price" name="price" value="{{old("price") ?? $product->price ?? null}}">
                                            <span class="help-block small invalid-feedback"></span>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <input type="text" id="price-old-format" data-target="#price_old" class="form-control" 
                                             placeholder="Giá Cũ" >
                                             <input type="hidden" id="price_old" name="price_old"  value="{{old("price_old") ?? $product->price_old ?? null}}">
                                            <span class="help-block small invalid-feedback"></span>
                                        </div>
                                  </div>
                                  <div class="form-group mg-b-pro-edt">
                                    <div class="input-images"></div>
                                 </div>
                               </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <div class="review-content-section">
                                <div class="mg-b-pro-edt">
                                    <select class="form-control pro-edt-select form-control-primary" id="product_status" name="product_status">
                                       @foreach(["Lưu Tạm","Xuất Bản"] as $key=>$status)
                                       <option value="{{$key}}"
                                       {{ old("product_status") 
                                       ? (old("product_status") == $key
                                            ? "selected"
                                            : null
                                          )
                                       : (isset($product) && $key==$product->product_status
                                            ?  "selected"
                                            : null
                                          )
                                        }}
                                       >{{$status}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                                  <div class="mg-b-pro-edt">
                                     <select class="form-control pro-edt-select form-control-primary" id="cat_id" name="cat_id">
                                        <option value="">Danh Mục</option>
                                        {!!showCat($cats,0,old("cat_id") ?? $product->cat_id ?? null)!!}
                                     </select>
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                                  <div class="mg-b-pro-edt">
                                    <textarea class="form-control" name="product_description" id="product_description" rows="10" placeholder="Mô Tả Sản Phẩm">{{
                                        old("product_description") ?? $product->product_description ?? null
                                    }}</textarea>
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="review-content-section">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="mg-b-pro-edt">
                                        <textarea class="form-control" id="product_content" rows="40" name="product_content" placeholder="Nội Dung Sản Phẩm">{{
                                            old("product_content") ?? $product->product_content ?? null
                                        }}</textarea>
                                        <span class="help-block small invalid-feedback"></span>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                               <div class="text-center custom-pro-edt-ds">
                                  <button class="btn btn-ctl-bt waves-effect waves-light m-r-10">Lưu
                                  </button>
                                  <a href="{{route("admin.product.add")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại
                                  </a>
                               </div>
                            </div>
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