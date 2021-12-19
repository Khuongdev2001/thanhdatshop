@extends("admin.master.layout")
@section("title",empty($menu) ? "Thêm Menu" : "Cập Nhật Menu")
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
            form:"#form-add-menu",
            rules:[
                Validator.isRequired("#menu_title","Không Được Để Trống Menu!"),
                Validator.minLengthValue("#menu_title","Tên Menu Tối Thiểu 2 Từ!",2),
                Validator.maxLengthValue("#menu_title","Tên Menu Tối Đa 50 Từ!",50),
                Validator.maxLengthValue("#menu_link","Link Menu Tối Đa 100 Từ!",100),
                Validator.isNumber("#sort","Vị Trí Dạng Số"),
                Validator.maxValue("#sort","Tối Đa 100!",100)
            ]
        })

        /* Handle Datatable */
        $('#table.dataTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route("admin.template.menu.datatable")}}',
            columns: [
                { data: "module_id", name: "module_id",orderable:false },
                { data: "module_title", name: "module_title" },
                { data: "menu_link", name: "menu_link" },
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
                window.lomenuion.href=this.href;
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
                           <h2>{{isset($menu) ? "Cập Nhật Menu" : "Thêm Menu"}}</h2>
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
                     <form id="form-add-menu" action="{{ isset($menu) 
                     ? route("admin.template.menu.update",$menu->menu_id) 
                     : route("admin.template.menu.add")
                     }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-8">
                                <table id="table" class="dataTable text-white">
                                    <thead>
                                        <tr>
                                            <th data-field="module_id">ID</th>
                                            <th data-field="module_title" data-editable="true">T.D.Mục</th>
                                            <th data-field="menu_link" data-editable="true">Link</th>
                                            <th data-field="sort" data-editable="true">V.Trí</th>
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
                                <!-- menu title -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="menu_title" name="menu_title" 
                                           value="{{old("menu_title") ?? $menu->menu_title ?? null}}" placeholder="Tên Menu">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- menu link -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="menu_link" name="menu_link" 
                                           value="{{$menu->menu_link ?? null}}" placeholder="link">
                                     </div>
                                </div>
                                <!-- menu parent -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <select class="form-control pro-edt-select form-control-primary" id="parent_id" name="parent_id">
                                            <option value="">Menu Cha</option>
                                            {{ showCat($menus,0,!empty($menu) ? $menu->parent_id : null) }}
                                         </select>
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <!-- sort -->
                                <div class="form-group">
                                    <div class="mg-b-pro-edt">
                                        <input type="text" class="form-control" id="sort" name="sort" 
                                        value="{{$menu->sort ?? null}}" placeholder="Vị Trí">
                                        <span class="help-block small invalid-feedback"></span>
                                     </div>
                                </div>
                                <div class="text-center custom-pro-edt-ds">
                                    <button class="btn btn-ctl-bt waves-effect waves-light m-r-10">Lưu </button>
                                    <a href="{{route("admin.template.menu.add")}}" class="btn btn-ctl-bt waves-effect waves-light">Quay Lại Thêm Menu</a>
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