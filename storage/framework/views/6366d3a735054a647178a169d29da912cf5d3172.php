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
        
            <!--Continually expanded and constantly improved Inspinia Admin Them (IN+)-->
        </p>
        <p>Email in. To see it in action.</p>
        <?php if(Session::has('codemessage')): ?>
            <div class="alert alert-danger"><?php echo e(Session::get('codemessage')); ?></div>
        <?php endif; ?>
        <?php if(Session::has('codemessage1')): ?>
            <div class="alert alert-success"><?php echo e(Session::get('codemessage1')); ?></div>
        <?php endif; ?>
        <form class="m-t" role="form" action="<?php echo e(route('resetpasswordlink')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="EmailId">
                <?php if($errors->has('email')): ?>
                    <span class="help-block">
                                        <strong style="color: red"><?php echo e($errors->first('email')); ?></strong>
                                    </span>
                <?php endif; ?>
            </div>
            <button type="submit" class="btn btn-primary block full-width m-b">Submit</button>
            <a href="<?php echo e(url('/Admin')); ?>"><small>Back to login</small></a>
        </form>
        <p class="m-t"> <small>Inspinia we app framework base on Bootstrap 3 &copy; 2014</small> </p>
    </div>
</div>

<!-- Mainly scripts -->
<script src="<?php echo e(asset('public/Admin-assets/js/jquery-3.1.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/Admin-assets/js/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/Admin-assets/js/bootstrap.js')); ?>"></script>

</body>

</html>
