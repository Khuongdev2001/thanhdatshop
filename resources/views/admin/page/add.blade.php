@extends('admin.master.layout')
@section("title",isset($page) ? "Cập Nhật Trang" : "Thêm Trang")
@section('css')
    <!-- notification Css
	============================================ -->
<link rel="stylesheet" href="{{asset("source/admin/css/upload/upload.css")}}">
@endsection
@section('js')
@include('admin.include.tinyEditor')
<script src="{{asset("source/admin/js/upload/upload.js")}}"></script>
<script src="{{asset("source/admin/js/validate/validate.js")}}"></script>
    <script>
        /* Start Validate Form Login */
        Validator({
            form:"#form-add-page",
            rules:[
                Validator.isRequired("#page_title","Không Được Để Trống Tên Trang!"),
                Validator.maxLengthValue("#page_title","Tên Trang Tối Đa 150 Từ!",150),
            ]
        })
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
                            <h2>{{isset($page) ? "Cập Nhật Trang" : "Thêm Trang"}}</h2>
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
                      <form id="form-add-page" action="{{ isset($page) 
                      ? route("admin.page.update",$page->page_id) 
                      : route("admin.page.add")
                      }}" enctype="multipart/form-data" method="POST">
                         @csrf
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <div class="review-content-section">
                                  <div class="form-group mg-b-pro-edt">
                                     <input type="text" id="page_title" class="form-control" name="page_title" 
                                        value="{{old("page_title") ?? $page->page_title ?? null}}" placeholder="Tên Trang">
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                                  <div class="mg-b-pro-edt">
                                     <input type="text" id="page_slug" class="form-control" name="page_slug" 
                                        value="{{old("page_slug") ?? $page->page_slug ?? null}}" placeholder="Slug" disabled >
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                               </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <div class="review-content-section">
                                <div class="mg-b-pro-edt">
                                    <select class="form-control pro-edt-select form-control-primary" id="page_status" name="page_status">
                                       @foreach(["Lưu Tạm","Xuất Bản"] as $key=>$status)
                                       <option value="{{$key}}"
                                       {{ old("page_status") 
                                       ? "selected" 
                                       : (isset($page) && $key==$page->page_status
                                            ?  "selected"
                                            : null
                                            )
                                        }}
                                       >{{$status}}</option>
                                       @endforeach
                                    </select>
                                 </div>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="review-content-section">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="mg-b-pro-edt">
                                        <textarea class="form-control" id="page_content" rows="40" name="page_content" placeholder="Nội Dung Trang">{{
                                            old("page_content") ?? $page->page_content ?? null
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
                                  <a href="{{route("admin.page.add")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại
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