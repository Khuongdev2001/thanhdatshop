@extends("admin.master.layout")
@section("title","Danh Sách Trang")
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
    <script>
        /* Handle Datatable */
        $('#table.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{route("admin.page.datatable")}}',
        columns: [
            { data: "page_id", name: "page_id" },
            { data: "page_title", name: "page_title"},
            { data: "fullname", name: "fullname"},  
            { data: "page_status", name: "page_status"},
            { data: "created_at", name: "created_at"},
            { data: "action", name: "action",orderable: false },
        ]
    });

    /* Handle Delete page*/
    $(document).on("click",".btn-delete",handleDeletepage)
    function handleDeletepage(e){
        const status = confirm("Xóa Sẽ Không Phục Hồi Được?");
        if(status){
            const response=Fetch.get(this.href);
            response.then(data=>data.json())
            .then(result =>{
                if(result.status){
                    Toastr({ type:"success", title:"Success", message:result.message });
                    $('#table.dataTable').DataTable().ajax.reload();
                }
            }) 
        }
        e.preventDefault();
    }
    </script>
@endsection
@section("content")
<div class="wp-sweetalert">
    <div class="sweetalert-close"></div>
    <div class="sweetalert-dialog">

    </div>
</div>
<div class="data-table-area mg-tb-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="sparkline13-hd">
                        <div class="main-sparkline13-hd">
                            <h1>Products <span class="table-project-n">Data</span> Table</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <div id="toolbar">
                                <select class="form-control">
                                    <option value="">Export Basic</option>
                                    <option value="all">Export All</option>
                                    <option value="selected">Export Selected</option>
                                </select>
                            </div>
                            <table id="table" class="dataTable text-white">
                                <thead>
                                    <tr>
                                        <th data-field="page_id">ID</th>
                                        <th data-field="page_title" data-editable="true">T.Trang</th>
                                        <th data-field="fullname" data-editable="true">N.Tạo</th>
                                        <th data-field="page_status" data-editable="true">T.Thái</th>
                                        <th data-field="created_at" data-editable="true">Ngày Tạo</th>
                                        <th data-field="action">H.Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection