<?php $__currentLoopData = $menus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<?php if($menu["parent_id"]==$parent_id): ?>
    <?php if(isset($isChild)): ?>
    <ul class="sub-menu">
    <?php endif; ?>
        <li class="menu-item">
            <a href="<?php echo e($menu->menu_link ? $menu->menu_link :"javavscript:void(0) "); ?>" 
                class="menu-link"><?php echo e($menu->menu_title); ?></a>
            <?php
                unset($menus[$key])
            ?>
            <?php echo $__env->make("user.master.menu",[
                "menus"=>$menus,
                "parent_id" => $menu->menu_id,
                "isChild"=>true
            ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </li>
    <?php if(isset($isChild)): ?>
    </ul>
    <?php endif; ?>
<?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/master/menu.blade.php ENDPATH**/ ?>