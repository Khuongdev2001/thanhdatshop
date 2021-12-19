<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | Nalika - Material Admin Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <!-- Bootstrap CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo e(asset("source/admin/css/bootstrap.min.css")); ?>">
    <!-- Fontawesome CSS
		============================================ -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo e(asset("source/admin/css/style.css")); ?>">
    <!-- responsive CSS
		============================================ -->
    <link rel="stylesheet" href="<?php echo e(asset("source/admin/css/responsive.css")); ?>">
    <!-- notification Css
        ============================================ -->
    <link rel="stylesheet" href="<?php echo e(asset("source/admin/css/notifications/style.css")); ?>">

</head>

<body>
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

    <div class="color-line mb-4"></div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
            <div class="col-md-4 col-md-4 col-sm-4 col-xs-12">
                <div class="text-center m-b-md custom-login">
                    <h3>PLEASE LOGIN TO APP</h3>
                    <p>This is the best app ever!</p>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form action="<?php echo e(route("admin.user.login")); ?>" method="POST" id="loginForm">
                            <?php echo csrf_field(); ?>
                            <div class="form-group invalid">
                                <label class="control-label" for="email">Email:*</label>
                                <input type="text" placeholder="example@gmail.com" title="Please enter you email" value="<?php echo e(old("email")); ?>" name="email" id="email" class="form-control is-invalid">
                                <span class="help-block small invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Password:*</label>
                                <input type="password" title="Please enter your password" placeholder="******" value="<?php echo e(old("password")); ?>" name="password" id="password" class="form-control">
                                <span class="help-block small invalid-feedback"></span>
                            </div>
                            <div class="checkbox login-checkbox">
                                <label>
										<input type="checkbox" class="i-checks"> Remember me </label>
                                <p class="help-block small">(if this is a private computer)</p>
                            </div>
                            <button class="btn btn-success btn-block loginbtn">Login</button>
                            <a class="btn btn-default btn-block" href="#">Register</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
        </div>
        <div class="row">
            <div class="col-md-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <p>Copyright © 2018 <a href="https://colorlib.com/wp/templates/">Colorlib</a> All rights reserved.</p>
            </div>
        </div>
    </div>
</body>
<script src="<?php echo e(asset("source/admin/js/validate/validate.js")); ?>"></script>
<script src="<?php echo e(asset("source/admin/js/notifications/notification.js")); ?>"></script>
<script>
    /* Start Validate Form Login */
    Validator({
            form:"#loginForm",
            rules:[
                Validator.isRequired("#email","Không Được Để Trống Email!"),
                Validator.isEmail("#email","Sai Định Dạng Email"),
                Validator.isRequired("#password","Không Được Để Trống Mật Khẩu!")
            ]
        })

    /* Start Notification Js*/
    <?php if($errors->any()): ?>
        <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            Toastr({ type:"error", title:"Error", message:"<?php echo e($error); ?>" })
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <?php endif; ?>
</script>
</html><?php /**PATH C:\xampp\htdocs\laravel\thanh_dat\thanhdat_cosmetics\resources\views/admin/user/login.blade.php ENDPATH**/ ?>