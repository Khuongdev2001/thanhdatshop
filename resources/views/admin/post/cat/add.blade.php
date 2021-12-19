@extends("admin.master.layout")
@section("title","Thêm Danh Mục Bài Viết")
@section("css")
    <!-- datatable CSS
		============================================ -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
     <!-- customer datatable CSS
		============================================ -->
    <link rel="stylesheet" href="{{asset("source/admin/css/datatable/datatable.css")}}">
@endsection
@section("js")
    <!-- datatable JS
	============================================ -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <!-- validate JS
	============================================ -->
    <script src="{{asset("source/admin/js/validate/validate.js")}}"></script>
    <script>
        /* Start Validate Form Add Cat */
        Validator({
            form:"#form-add-cat",
            rules:[
                Validator.isRequired("#cat_title","Không Được Để Trống Danh Mục!"),
                Validator.minLengthValue("#cat_title","Tên Danh Mục Tối Thiểu 2 Từ!",2),
                Validator.maxLengthValue("#cat_title","Tên Danh Mục Tối Đa 50 Từ!",50),
                Validator.isNumber("#sort","Vị Trí Dạng Số"),
                Validator.maxValue("#sort","Tối Đa 100!",100)
            ]
        })

        /* Handle Datatable */
        $('#table.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("admin.post.category.datatable")}}',
            columns: [
                { data: "cat_id", name: "cat_id" },
                { data: "cat_title", name: "cat_title" },
                { data: "sort", name: "sort" },
                { data: "fullname", name: "fullname" },
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
                           <h2>{{isset($cat) ? "Cập Nhật Danh Mục" : "Thêm Danh Mục"}}</h2>
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
                     <form id="form-add-cat" action="{{ isset($cat) 
                     ? route("admin.post.category.update",$cat->cat_id) 
                     : route("admin.post.category.add")
                     }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <table id="table" class="dataTable text-white">
                                    <thead>
                                        <tr>
                                            <th data-field="cat_id">ID</th>
                                            <th data-field="cat_title" data-editable="true">T.D.Mục</th>
                                            <th data-field="sort" data-editable="true">V.Trí</th>
                                            <th data-field="fullname" data-editable="true">NG.Tạo</th>
                                            <th data-field="created_at" data-editable="true">N.Tạo</th>
                                            <th data-field="action">H.Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr>
                                            <td>1</td>
                                            <td>
                                                <span>adsf</span>
                                            </td>
                                            <td>
                                                <span>
                                                    Khách Hàng
                                                </span>
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
                                        </tr> --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <!-- cat title -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="cat_title" name="cat_title" 
                                           value="{{old("cat_title") ?? $cat->cat_title ?? null}}" placeholder="Tên Danh Mục">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- cat slug -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="cat_slug" name="cat_slug" 
                                           value="{{$cat->cat_slug ?? null}}" placeholder="slug" disabled>
                                     </div>
                                </div>
                                <!-- cat parent -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <select class="form-control pro-edt-select form-control-primary" id="parent_id" name="parent_id">
                                            <option value="">Danh Mục Cha</option>
                                            {{ showCat($cats,0,!empty($cat) ? $cat->parent_id : null) }}
                                         </select>
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- sort -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="sort" name="sort" 
                                        value="{{$cat->sort ?? null}}" placeholder="Vị Trí">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <div class="text-center custom-pro-edt-ds">
                                    <button class="btn btn-ctl-bt waves-effect waves-light m-r-10">Lưu </button>
                                    <a href="{{route("admin.post.category.add")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại Thêm D.Mục</a>
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