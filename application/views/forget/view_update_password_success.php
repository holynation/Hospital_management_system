<?php
$get_settings = getsettingsdetails();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password | ::EHM::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- Bootstrap -->
    <!-- global level css -->
    <link href="<?php echo base_url(); ?>assets/A.css%2c%2c_bootstrap.min.css%2bvendors%2c%2c_themify%2c%2c_css%2c%2c_themify-icons.css%2bvendors%2c%2c_bootstrapvalidator%2c%2c_css%2c%2c_bootstrapValidator.min.css%2cMcc.tSw-88FPFz.css.pagespeed.cf.YIK" rel="stylesheet" type="text/css"/>
    
    <!-- end of global css-->
    <!-- page level styles-->
    
    <link href="<?php echo base_url(); ?>assets/css/forgot_password.css" rel="stylesheet">
    <!-- end of page level styles-->
</head>

<body>
<div class="preloader">
    <div class="loader_img"><img src="<?php echo base_url(); ?>assets/img/loader.gif.pagespeed.ce.9OKnn8kx6t.gif" alt="loading..." height="64" width="64"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1 box animated fadeInUp">
            <h2 class="text-center">
                <img src="<?php echo base_url($get_settings->logo); ?>" alt="Logo" width="40px" height="40px">
                <p style="font-weight: bolder;color: #428bca;">E<b style="color:red;">H</b>M</p>
            </h2>
            
            <h3 class="text-center">Success</h3>

            <div class="text-center enter_email">
            	<div class="alert alert-success">
            		<p><?php echo 'Your Password has been updated! You may now login.'; ?></p>
            		<p><a href="<?php echo base_url('welcome/login'); ?>" class="btn submit-btn btn-primary">Return to login page</a></p>
            	</div>
            </div>
            
        </div>
    </div>
</div>
<!-- global vendor js-->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<!-- end of global vendor js-->
<!-- page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/forgot_password.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>
</html>
