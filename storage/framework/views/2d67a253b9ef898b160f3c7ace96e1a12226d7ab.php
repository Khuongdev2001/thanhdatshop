<?php $__currentLoopData = $menuMobiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $menu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php if($menu["parent_id"]==$parent_id): ?>
        <?php if(isset($isChild)): ?>
        <ul class="submenu">
        <?php endif; ?>
            <li class="menu-item">
                <span class="menu-text">
                    <a href="<?php echo e($menu->menu_link ? $menu->menu_link :"javavscript:void(0) "); ?>" 
                    class="menu-link"><?php echo e($menu->menu_title); ?></a>
                    <span class="icon"><i class="fas fa-chevron-right"></i></span>
                </span>
                <?php
                unset($menuMobiles[$key])
                ?>
                <?php echo $__env->make("user.master.menuMobile",[
                    "menuMobiles"=>$menuMobiles,
                    "parent_id" => $menu->menu_id,
                    "isChild"=>true
                ], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </li>
        <?php if(isset($isChild)): ?>
        </ul>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/user/master/menuMobile.blade.php ENDPATH**/ ?>