<?php if($paginator->hasPages()): ?>
<ul class="paginates">
    <?php if($paginator->previousPageUrl()): ?>
    <li class="paginate-item">
        <a href="<?php echo e($paginator->previousPageUrl()); ?>" class="paginate-link"><i class="fas fa-chevron-left"></i></a>
    </li>
    <?php endif; ?>
    <?php $__currentLoopData = $elements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $element): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(is_array($element)): ?>
            <?php $__currentLoopData = $element; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($page == $paginator->currentPage()): ?>
                <li class="paginate-item">
                    <a href="<?php echo e($url); ?>" class="paginate-link active"><?php echo e($page); ?></a>
                </li>
            <?php else: ?>
                <li class="paginate-item">
                    <a href="<?php echo e($url); ?>" class="paginate-link"><?php echo e($page); ?></a>
                </li>
            <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php if($paginator->hasMorePages()): ?>
    <li class="paginate-item">
        <a href="<?php echo e($paginator->nextPageUrl()); ?>" class="paginate-link"><i class="fas fa-chevron-right"></i></a>
    </li>
    <?php endif; ?>
</ul>
<?php endif; ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/paginate/index.blade.php ENDPATH**/ ?>