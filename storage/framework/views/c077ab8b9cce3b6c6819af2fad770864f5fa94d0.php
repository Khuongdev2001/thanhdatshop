
<?php $__env->startSection("title","Danh Sách Thành Viên"); ?>
<?php $__env->startSection("css"); ?>    
    <!-- datatable CSS
		============================================ -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.7/css/jquery.dataTables.min.css">
     <!-- customer datatable CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo e(asset("source/admin/css/datatable/datatable.css")); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection("js"); ?>
    <!-- datatable JS
	============================================ -->
    <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
    <script>
        /* Handle Datatable */
        $('#table.dataTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '<?php echo e(route("admin.user.datatable")); ?>',
        columns: [
            { data: "user_id", name: "user_id" },
            { data: "avatar", name: "avatar",orderable:false },
            { data: "fullname", name: "fullname" },
            { data: "email", name: "email" },
            { data: "phone", name: "phone" },
            { data: "user_active_mail", name: "user_active_mail" },
            { data: "level", name: "level" },
            { data: "user_created_at", name: "user_created_at" },
            { data: "action", name: "action",orderable: false },
        ]
    });

    /* Handle Change Level*/
    $(document).on("click",".btn-lock",function (e) {
        /* Find Element Td Span */
        const levelHTML=$(this).parents("tr").children("td")[6].children[0];
        const response=Fetch.get(this.href);
        response.then(data=>data.json())
        .then((result)=>{
            if(!result.status){
                return Toastr({ type:"error", title:"Error", message:result.message });
            }
            Toastr({ type:"success", title:"Success", message:result.message });
            const convert =[
                { className:"btn-success", i:'<i class="fa fa-unlock" aria-hidden="true"></i>'},
                { className:"btn-warning",i:'<i class="fa fa-lock" aria-hidden="true"></i>'}
            ]
            this.classList.remove("btn-warning");
            this.classList.remove("btn-success");
            this.classList.add(convert[result.data.level].className);
            this.innerHTML=convert[result.data.level].i;
            levelHTML.innerHTML=result.data.levelText;
        })
        e.preventDefault();
    })
    </script>
<?php $__env->stopSection(); ?>
<?php $__env->startSection("content"); ?>
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
                                        <th data-field="user_id">ID</th>
                                        <th data-field="avatar" data-editable="true">Ảnh</th>
                                        <th data-field="fullname" data-editable="true">H.Tên</th>
                                        <th data-field="email" data-editable="true">Email</th>
                                        <th data-field="phone" data-editable="true">Đ.Thoại</th>
                                        <th data-field="user_active_mail" data-editable="true">T.Thái</th>
                                        <th data-field="level" data-editable="true">C.Bậc</th>
                                        <th data-field="user_created_at" data-editable="true">N.Tạo</th>
                                        <th data-field="action">H.Động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>
                                            <a href="" class="box-thumbnail no-image avatar">
                                                
                                            </a>
                                        </td>
                                        <td>
                                            <span>
                                                Nguyễn Hữu Khương
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                khuongdev2001@gmail.com
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                0394182551
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                Chưa Kích Hoạt
                                            </span>
                                        </td>
                                        <td>
                                            <span>
                                                Khách Hàng
                                            </span>
                                        </td>
                                        <td>
                                            12/10/2021
                                        </td>
                                        <td>
                                            <div>
                                                <a href="" class="btn  btn-info btn-edit"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="" class="btn btn-warning btn-lock"><i class="fa fa-lock" aria-hidden="true"></i></a>
                                                <a href="" class="btn btn-danger btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/admin/user/index.blade.php ENDPATH**/ ?>