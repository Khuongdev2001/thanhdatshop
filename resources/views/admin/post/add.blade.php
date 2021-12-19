@extends('admin.master.layout')
@section("title",isset($post) ? "Cập Nhật Bài Viết" : "Thêm Bài Viết")
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
        /* Handle Upload File Js */        
        UploadFile({
            selectorBtnUpload: ".btn-upload",
            selectorInput: ".input-file",
            callbackUpload: function (e) {
                const source = URL.createObjectURL(e.target.files[0]);
                UploadFile.createElement(source);
            },
            tests: [
                UploadFile.validateFileMaxSize(1000000,()=>{
                    /* Hanlde Error*/
                    Toastr({ type:"error", title:"Error", message:"Kích Thước Tối Đa 1MB" })
                }),
                UploadFile.isImage(()=>{
                    /* Handle Error*/
                    Toastr({ type:"error", title:"Error", message:"Không Phải Định Dạng Ảnh"});
                })
            ],
            file: "{{isset($post->post_thumbnail) ? asset($post->post_thumbnail) : "" }}"
        });

        /* Start Validate Form Login */
        Validator({
            form:"#form-add-post",
            rules:[
                Validator.isRequired("#post_title","Không Được Để Trống Tên Bài Viết!"),
                Validator.maxLengthValue("#post_title","Tên Bài Viết Tối Đa 150 Từ!",150),
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
                            <h2>{{isset($post) ? "Cập Nhật Bài Viết" : "Thêm Bài Viết"}}</h2>
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
                      <form id="form-add-post" action="{{ isset($post) 
                      ? route("admin.post.update",$post->post_id) 
                      : route("admin.post.add")
                      }}" enctype="multipart/form-data" method="POST">
                         @csrf
                         <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <div class="review-content-section">
                                  <div class="form-group mg-b-pro-edt">
                                     <input type="text" id="post_title" class="form-control" name="post_title" 
                                        value="{{old("post_title") ?? $post->post_title ?? null}}" placeholder="Tên Bài Viết">
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                                  <div class="mg-b-pro-edt">
                                     <input type="text" id="post_slug" class="form-control" name="post_slug" 
                                        value="{{old("post_slug") ?? $post->post_slug ?? null}}" placeholder="Slug" disabled >
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                                  <div class="mg-b-pro-edt upload-widget-wrapper">
                                    <div class="upload-file">
                                        <a href="javacript:void(0)" class="box-thumbnail"><img src="{{asset("source/admin/css/upload/img/icon.png")}}" class="thumbnail"></a>
                                        <div class="box-btn">                    
                                           <a href="" class="btn-upload">Choose files to Upload</a>
                                           <input type="file" name="file" class="input-file" accept="image/png, image/jpeg">
                                        </div>
                                    </div>
                                </div>
                               </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                               <div class="review-content-section">
                                <div class="mg-b-pro-edt">
                                    <select class="form-control pro-edt-select form-control-primary" id="post_status" name="post_status">
                                       @foreach(["Lưu Tạm","Xuất Bản"] as $key=>$status)
                                       <option value="{{$key}}"
                                       {{ old("post_status") 
                                       ? "selected" 
                                       : (isset($post) && $key==$post->post_status
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
                                        {!!showCat($cats,0,old("cat_id") ?? $post->cat_id ?? null)!!}
                                     </select>
                                     <span class="help-block small invalid-feedback"></span>
                                  </div>
                                  <div class="mg-b-pro-edt">
                                    <textarea class="form-control" name="post_description" rows="10" placeholder="Mô Tả Bài Viết">
                                        {{old("post_description") ?? $post->post_description ?? null}}
                                    </textarea>
                                    <span class="help-block small invalid-feedback"></span>
                                 </div>
                               </div>
                            </div>
                         </div>
                         <div class="row">
                            <div class="review-content-section">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="mg-b-pro-edt">
                                        <textarea class="form-control" id="post_content" rows="40" name="post_content" placeholder="Nội Dung Bài Viết">
                                            {{old("post_content") ?? $post->post_content ?? null}}
                                        </textarea>
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
                                  <a href="{{route("admin.post")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại
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