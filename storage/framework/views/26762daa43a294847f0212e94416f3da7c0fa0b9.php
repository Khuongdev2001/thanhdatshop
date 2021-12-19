<!-- jquery
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/vendor/jquery-1.12.4.min.js")); ?>"></script>
<!-- bootstrap JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/bootstrap.min.js")); ?>"></script>

<!-- meanmenu JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/jquery.meanmenu.js")); ?>"></script>

<!-- mCustomScrollbar JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/scrollbar/jquery.mCustomScrollbar.concat.min.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/scrollbar/mCustomScrollbar-active.js")); ?>"></script>
<!-- metisMenu JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/metisMenu/metisMenu.min.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/metisMenu/metisMenu-active.js")); ?>"></script>
<!-- sparkline JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/sparkline/jquery.sparkline.min.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/sparkline/jquery.charts-sparkline.js")); ?>"></script>
<!-- calendar JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/calendar/moment.min.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/calendar/fullcalendar.min.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/calendar/fullcalendar-active.js")); ?>"></script>
	<!-- float JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/flot/jquery.flot.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/flot/jquery.flot.resize.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/flot/curvedLines.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/flot/flot-active.js")); ?>"></script>
<!-- plugins JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/plugins.js")); ?>"></script>
<!-- main JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/main.js")); ?>"></script>
<!-- notification JS
		============================================ -->
<script src="<?php echo e(asset("source/admin/js/notifications/notification.js")); ?>"></script>

<script>
    /* Start Notification Js*/
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Toastr({ type:"error", title:"Error", message:"<?php echo e($error); ?>",delay:2000 })
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
	<?php if(session("success")): ?>
		Toastr({ type:"success", title:"Success", message:"<?php echo e(session('success')); ?>",delay:2000 })
	<?php endif; ?>
</script>
<?php echo $__env->yieldContent('js'); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/admin/master/footer.blade.php ENDPATH**/ ?>