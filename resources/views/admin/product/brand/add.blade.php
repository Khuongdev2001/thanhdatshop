@extends("admin.master.layout")
@section("title",isset($brand) ? "Cập Nhật Thương Hiệu" :"Thêm Thương Hiệu")
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
        /* Start Validate Form Add Cat */
        Validator({
            form:"#form-add-brand",
            rules:[
                Validator.isRequired("#brand_name","Không Được Để Trống Thương Hiệu!"),
                Validator.minLengthValue("#brand_name","Tên Thương Hiệu Tối Thiểu 2 Từ!",2),
                Validator.maxLengthValue("#brand_name","Tên Thương Hiệu Tối Đa 50 Từ!",50),
                Validator.isNumber("#sort","Vị Trí Dạng Số"),
                Validator.maxValue("#sort","Tối Đa 100!",100)
            ]
        })

        /* Handle Datatable */
        $('#table.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("admin.product.brand.datatable")}}',
            columns: [
                { data: "brand_id", name: "brand_id",orderable: false },
                { data: "brand_image", name:"brand_image"},
                { data: "brand_name", name: "cat_name" },
                { data: "sort", name: "sort" },
                { data: "brand_link", name: "cat_link" },
                { data: "created_at", name: "created_at" },
                { data: "action", name: "action",orderable: false }
            ]
        });

        /* Handle Delete Post*/
        $(document).on("click",".btn-delete",handleDeleteCat)
         function handleDeleteCat(e){
            const status = confirm("Xóa D.Mục Sẽ Không Phục Hồi Được?");
            if(status){
                window.location.href=this.href;
            }
            e.preventDefault();
         }

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
            file: "{{isset($brand->brand_image) ? asset($brand->brand_image) : "" }}"
        });
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
                           <h2>{{isset($brand) ? "Cập Nhật Thương Hiệu" : "Thêm Thương Hiệu"}}</h2>
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
                     <form id="form-add-brand" action="{{ isset($brand) 
                     ? route("admin.product.brand.update",$brand->brand_id) 
                     : route("admin.product.brand.add")
                     }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <table id="table" class="dataTable text-white">
                                    <thead>
                                        <tr>
                                            <th data-field="brand_id">ID</th>
                                            <th data-field="brand_thumbnail">A.Thương Hiệu</th>
                                            <th data-field="brand_name" data-editable="true">T.Thương Hiệu</th>
                                            <th data-field="sort" data-editable="true">V.Trí</th>
                                            <th data-field="fullname" data-editable="true">Link</th>
                                            <th data-field="created_at" data-editable="true">N.Tạo</th>
                                            <th data-field="action">H.Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>
                                                <span>adsf</span>
                                            </td>
                                            <td>
                                                <span>
                                                    Khách Hàng
                                                </span>
                                            </td>
                                            <td></td>
                                            <td>
                                                <span>
                                                    NHK
                                                </span>
                                            </td>
                                            <td>
                                                12/10/2021
                                            </td>
                                            <td>
                                                <div>
                                                    <a href="" class="btn  btn-info btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    <a href="" class="btn btn-danger btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <!-- brand title -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="brand_name" name="brand_name" 
                                           value="{{old("brand_name") ?? $brand->brand_name ?? null}}" placeholder="Tên Thương Hiệu">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- brand link -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="brand_link" name="brand_link" 
                                           value="{{$brand->brand_link ?? null}}" placeholder="Link Đích">
                                     </div>
                                </div>
                                <!-- sort -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="sort" name="sort" 
                                        value="{{$brand->sort ?? null}}" placeholder="Vị Trí">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- thumbnail-->
                                <div class="form-group">
                                    <span class="text-white">Ảnh Thương Hiệu</span>
                                    <div class="mg-b-pro-edt upload-widget-wrapper">
                                        <div class="upload-file">
                                            <a href="" class="box-thumbnail btn-upload"><img src="{{asset("source/admin/css/upload/img/icon.png")}}" class="thumbnail"></a>
                                            <div class="box-btn">                    
                                               <a href="" class="btn-upload">Choose files to Upload</a>
                                               <input type="file" name="file" class="input-file" accept="image/png, image/jpeg">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center custom-pro-edt-ds">
                                    <button class="btn btn-ctl-bt waves-effect waves-light m-r-10">Lưu </button>
                                    <a href="{{route("admin.product.brand.add")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại Thêm T.Hiệu</a>
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