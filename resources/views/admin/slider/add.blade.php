@extends("admin.master.layout")
@section("title",isset($slider) ? "Cập Nhật Slider" :"Thêm Slider")
@section("css")
    <!-- datatable CSS
		============================================ -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
     <!-- customer datatable CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset("source/admin/css/datatable/datatable.css")}}">
        <!-- upload file CSS
	============================================ -->
    <link rel="stylesheet" href="{{asset("source/admin/css/upload/upload.css")}}">
@endsection
@section("js")
    <!-- datatable JS
	============================================ -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- validate JS
	============================================ -->
    <script src="{{asset("source/admin/js/validate/validate.js")}}"></script>
    <!-- upload file JS
	============================================ -->
    <script src="{{asset("source/admin/js/upload/upload.js")}}"></script>
    <script>
        /* Start Validate Form Add slider */
        Validator({
            form:"#form-add-slider",
            rules:[
                Validator.isNumber("#sort","Vị Trí Dạng Số"),
                Validator.maxValue("#sort","Tối Đa 100!",100),
                Validator.isRequiredUpload(".input-file","#file-old","Không Để Trống Ảnh File")
            ]
        })

        /* Handle Datatable */
        $('#table.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("admin.slider.datatable")}}',
            columns: [
                { data: "slider_id", name: "slider_id" },
                { data: "slider_thumbnail", name:"slider_thumbnail"},
                { data: "slider_link", name: "slider_link" },
                { data: "sort", name: "sort" },
                { data: "slider_type", name: "slider_type" },
                { data: "slider_status", name: "slider_status" },
                { data: "fullname", name: "fullname" },
                { data: "created_at", name: "created_at" },
                { data: "action", name: "action",orderable: false }
            ]
        });

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
            file: "{{isset($slider->slider_thumbnail) ? asset($slider->slider_thumbnail) : "" }}"
        });

        /* Handle Delete Post*/
         $(document).on("click",".btn-delete",handleDeleteslider)
         function handleDeleteslider(e){
            const status = confirm("Xóa D.Mục Sẽ Không Phục Hồi Được?");
            if(status){
                window.losliderion.href=this.href;
            }
            e.preventDefault();
         }
         
    </script>
@endsection
@section("content")
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
                           <h2>{{isset($slider) ? "Cập Nhật Slider" : "Thêm Slider"}}</h2>
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
                     <form id="form-add-slider" action="{{ isset($slider) 
                     ? route("admin.slider.update",$slider->slider_id) 
                     : route("admin.slider.add")
                     }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <table id="table" class="dataTable text-white">
                                    <thead>
                                        <tr>
                                            <th data-field="slider_id">ID</th>
                                            <th data-field="slider_thumbnail">A.Slider</th>
                                            <th data-field="sort" data-editable="true">Link</th>
                                            <th data-field="sort" data-editable="true">V.Trí</th>
                                            <th data-field="sort" data-editable="true">Loại</th>
                                            <th data-field="sort" data-editable="true">T.Thái</th>
                                            <th data-field="fullname" data-editable="true">NG.Tạo</th>
                                            <th data-field="created_at" data-editable="true">N.Tạo</th>
                                            <th data-field="action">H.Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <!-- thumbnail-->
                                <div class="form-group">
                                    <span class="text-white">Ảnh Slider</span>
                                    <div class="mg-b-pro-edt upload-widget-wrapper">
                                        <div class="upload-file">
                                            <a href="javacript:void(0)" class="box-thumbnail"><img src="{{asset("source/admin/css/upload/img/icon.png")}}" class="thumbnail"></a>
                                            <div class="box-btn">                    
                                               <a href="" class="btn-upload">Choose files to Upload</a>
                                            </div>
                                            <input type="file" name="file" class="input-file" accept="image/png, image/jpeg">
                                            <span class="help-block small invalid-feedback d-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <!-- slider status -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <select class="form-control pro-edt-select form-control-primary" id="slider_status" name="slider_status">
                                            @foreach(["Lưu Tạm","Xuất Bản"] as $key=>$type)
                                            <option value="{{$key}}"
                                            {{ old("slider_status")
                                            ? (old("slider_status")==$key 
                                                ? "selected"
                                                :  null
                                                ) 
                                            : (isset($slider) && $key==$slider->slider_status
                                                 ?  "selected"
                                                 : null
                                                 )
                                             }}
                                            >{{$type}}</option>
                                            @endforeach
                                         </select>
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- slider type -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <select class="form-control pro-edt-select form-control-primary" id="slider_type" name="slider_type">
                                            @foreach(["Slider Loại Nhỏ","Slider Loại Lớn"] as $key=>$type)
                                            <option value="{{$key}}"
                                            {{ old("slider_type")
                                            ? (old("slider_type")==$key 
                                                ? "selected"
                                                :  null
                                                ) 
                                            : (isset($slider) && $key==$slider->slider_type
                                                 ?  "selected"
                                                 : null
                                                 )
                                             }}
                                            >{{$type}}</option>
                                            @endforeach
                                         </select>
                                     </div>
                                </div>
                                <!-- slider type -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" placeholder="link đến" name="slider_link" value="{{old("slider_link")?? $slider->slider_link ?? null}}">
                                     </div>
                                </div>
                                <!-- sort -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="sort" name="sort" 
                                        value="{{$slider->sort ?? null}}" placeholder="Vị Trí">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <div class="text-center custom-pro-edt-ds">
                                    <button class="btn btn-ctl-bt waves-effect waves-light m-r-10">Lưu </button>
                                    <a href="{{route("admin.slider.add")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại Thêm Slider</a>
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