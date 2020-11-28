<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>" dir="<?php echo e(__('voyager::generic.is_rtl') == 'true' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="robots" content="none" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="admin login">
    <title><?php echo $__env->yieldContent('title', 'Admin - '.Voyager::setting("admin.title")); ?></title>
    <link rel="stylesheet" href="<?php echo e(voyager_asset('css/app.css')); ?>">
    <?php if(__('voyager::generic.is_rtl') == 'true'): ?>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.css">
        <link rel="stylesheet" href="<?php echo e(voyager_asset('css/rtl.css')); ?>">
    <?php endif; ?>
    <style>
        body {
            background-image:url('<?php echo e(Voyager::image( Voyager::setting("admin.bg_image"), voyager_asset("images/bg.jpg") )); ?>');
            background-color: <?php echo e(Voyager::setting("admin.bg_color", "#FFFFFF" )); ?>;
        }
        body.login .login-sidebar {
            border-top:5px solid <?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        @media (max-width: 767px) {
            body.login .login-sidebar {
                border-top:0px !important;
                border-left:5px solid <?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
            }
        }
        body.login .form-group-default.focused{
            border-color:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        .login-button, .bar:before, .bar:after{
            background:<?php echo e(config('voyager.primary_color','#22A7F0')); ?>;
        }
        .remember-me-text{
            padding:0 5px;
        }
    </style>
    
    <?php echo $__env->yieldContent('pre_css'); ?>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
</head>
<body class="login">
<div class="container-fluid">
    <div class="row">
        <div class="faded-bg animated"></div>
        <div class="hidden-xs col-sm-7 col-md-8">
            <div class="clearfix">
                <div class="col-sm-12 col-md-10 col-md-offset-2">
                    <div class="logo-title-container">
                        <?php $admin_logo_img = Voyager::setting('admin.icon_image', ''); ?>
                        <?php if($admin_logo_img == ''): ?>
                            <img class="img-responsive pull-left flip logo hidden-xs animated fadeIn" src="<?php echo e(voyager_asset('images/logo-icon-light.png')); ?>" alt="Logo Icon">
                        <?php else: ?>
                            <img class="img-responsive pull-left flip logo hidden-xs animated fadeIn" src="<?php echo e(Voyager::image($admin_logo_img)); ?>" alt="Logo Icon">
                        <?php endif; ?>
                        <div class="copy animated fadeIn">
                            <h1><?php echo e(Voyager::setting('admin.title', 'Voyager')); ?></h1>
                            <p><?php echo e(Voyager::setting('admin.description', __('voyager::login.welcome'))); ?></p>
                        </div>
                    </div> <!-- .logo-title-container -->
                </div>
            </div>
        </div>

        <div class="col-xs-12 col-sm-5 col-md-4 login-sidebar">

           <?php echo $__env->yieldContent('content'); ?>

        </div> <!-- .login-sidebar -->
    </div> <!-- .row -->
</div> <!-- .container-fluid -->
<?php echo $__env->yieldContent('post_js'); ?>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\test\adminpanel6\vendor\tcg\voyager\src/../resources/views/auth/master.blade.php ENDPATH**/ ?>