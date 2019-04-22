<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>CajasMisterio</title>
    <link rel="shortcut icon" sizes="196x196" href="<?php echo e(asset('public/favicon.png')); ?> ">
    <link href="<?php echo e(asset('public/Admin-assets/css/bootstrap.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/Admin-assets/font-awesome/css/font-awesome.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/Admin-assets/css/animate.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('public/Admin-assets/css/style.css')); ?>" rel="stylesheet">

</head>

<body class="gray-bg">

<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <div>

            <h1 class="logo-name">Cajas</h1>

        </div>
        <h3>Welcome to CajasMisterio</h3>


        <?php if(Session::has('message')): ?>
            <div class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo e(session('message')); ?>

            </div>
        <?php endif; ?>
        <?php if(Session::has('passmsg')): ?>
            <div class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo e(session('passmsg')); ?>

            </div>
        <?php endif; ?>
        <form class="m-t" role="form" action="<?php echo e(route('adminlogin')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <input type="text" name="EmailId" value="<?php echo e(old('EmailId')); ?>" class="form-control" placeholder="EmailId">
                <?php if($errors->has('EmailId')): ?>
                    <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('EmailId')); ?></strong>
                                    </span>
                <?php endif; ?>
            </div>
            <div class="form-group">
                <input type="password" name="Password" class="form-control" placeholder="Password">
                <?php if($errors->has('Password')): ?>
                    <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('Password')); ?></strong>
                                    </span>
                <?php endif; ?>
            </div>
            <input type="hidden" value="1" name="RoleId">
            <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
            <a href="<?php echo e(url('/forgotpassword')); ?>"><small>Forgot password</small></a>
        </form>

    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo e(asset('public/Admin-assets/js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/Admin-assets/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/Admin-assets/js/bootstrap.js')); ?>"></script>

</body>

</html>
