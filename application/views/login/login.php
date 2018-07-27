
<?php
$get_settings = getsettingsdetails();
?>
<!DOCTYPE html>
<html>
<head>
    <title> :: EHM Login Page :: </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/css%2c_bootstrap.min.css%2bvendors%2c_themify%2c_css%2c_themify-icons.css.pagespeed.cc.wUSFUx3NKa.css" rel="stylesheet"/>
    <!-- end of bootstrap -->
    <!--page level css -->
    
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck%2c_css%2c_all.css%2bbootstrapvalidator%2c_css%2c_bootstrapValidator.min.css.pagespeed.cc.X44J2Xc7_v.css" rel="stylesheet"/>
    
    <link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
    <!--end page level css-->
</head>

<body id="sign-in">
    <div class="opc">
<div class="preloader">
    <div class="loader_img"><img src="<?php echo base_url(); ?>assets/img/loader.gif.pagespeed.ce.9OKnn8kx6t.gif" alt="loading..." height="64" width="64"></div>
</div><br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 login-form">
            <div class="panel-header">
                <h2 class="text-center">
                    <img src="<?php echo base_url($get_settings->logo); ?>" alt="Logo" width="40px" height="40px">
                    <p style="font-weight: bolder;color: #428bca;">E<b style="color:red;">H</b>M</p>
                </h2>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-12">
                        <form action="<?php echo base_url('welcome/login') ?>" id="" method="post" class="">
                        <?php
                        
                        if(isset($error)){ ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php } ?>
   
                        <?php //  this is for the validation page
                            if(validation_errors()){ ?>
                                <?php echo validation_errors('<div class="alert alert-danger">','</div>'); ?>
                         <?php } ?>

                            <div class="form-group">
                                <label for="staff_username" class="sr-only"> Username</label>
                                <input type="text" class="form-control  form-control-lg" id="staff_username" name="staff_username" placeholder="Username" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" autocomplete="off">
                            </div>
                            <div class="form-group checkbox">
                                <label for="remember">
                                    <input type="checkbox" name="rememberme" id="rememberme">&nbsp; Stay Logged In
                                </label>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Sign In" name="log_show" id="log_show" class="btn btn-primary btn-block"/>
                            </div>
                            <a href="<?php echo base_url('welcome/reset'); ?>" id="forgot" class="forgot"> Reset Password ? </a>
                        </form>
                    </div>
                </div>


                    <div class="row text-center social">
                    
                    <div class="row"  style="padding-top:"40px">
                        <div class="col-sm-8 col-sm-offset-2">
                         <p>Powered by </p>
                        </div>
                    </div>
                </div>
                



            </div>
        </div>
    </div>
</div>
</div>
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<!-- end of global js -->
<!-- page level js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/iCheck/js/icheck.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_js/login.js"></script>
<!-- end of page level js -->
</body>

</html>
