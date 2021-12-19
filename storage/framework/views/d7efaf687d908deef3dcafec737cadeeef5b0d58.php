
<?php $__env->startSection("title","Danh Sách Đơn Hàng"); ?>
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
        ajax: '<?php echo e(route("admin.cart.datatable")); ?>',
        columns: [
            { data: "code", name: "code",orderable:"desc" },
            { data: "url", name: "url" },
            { data: "cart_info", name: "cart_info" },
            { data: "address", name: "address"},
            { data: "buyer_fullname", name: "brand_name"},
            { data: "buyer_phone", name: "buyer_phone" },
            { data: "total_price", name: "total_price"},  
            { data: "cart_status", name: "cart_status"},
            { data: "created_at", name: "created_at"},
            { data: "action", name: "action",orderable: false },
        ]
    });
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
                            <h1>Đơn Hàng <span class="table-project-n">Data</span> Table</h1>
                        </div>
                    </div>
                    <div class="sparkline13-graph">
                        <div class="datatable-dashv1-list custom-datatable-overright">
                            <table id="table" class="dataTable text-white">
                                <thead>
                                    <tr>
                                        <th data-field="code">Code</th>
                                        <th data-field="url">Ảnh</th>
                                        <th data-field="cart_info" data-editable="true">Thông Tin</th>
                                        <th data-field="address" data-editable="true">Địa Chỉ</th>
                                        <th data-field="buyer_fullname" data-editable="true">Tên Người Nhận</th>
                                        <th data-field="buyer_phone" data-editable="true">SĐT</th>
                                        <th data-field="total_price" data-editable="true">Tổng Tiền</th>
                                        <th data-field="cart_status" data-editable="true">T.Thái</th>
                                        <th data-field="created_at" data-editable="true">Ngày Đặt</th>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make("admin.master.layout", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/admin/cart/index.blade.php ENDPATH**/ ?>