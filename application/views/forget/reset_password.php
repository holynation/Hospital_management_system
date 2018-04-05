<!DOCTYPE html>
<html>

<head>
    <title>Reset Password | ::EHM::</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- Bootstrap -->
    <link href="<?php echo base_url(); ?>assets/A.css%2c%2c_bootstrap.min.css%2bvendors%2c%2c_bootstrapvalidator%2c%2c_css%2c%2c_bootstrapValidator.min.css%2cMcc.qrTFo4dmSE.css.pagespeed.cf.bmuAQNO1q3.css" rel="stylesheet"/>
    <!-- end of bootstrap -->
    <!--page level css -->
    
    <link href="<?php echo base_url(); ?>assets/css/A.login.css.pagespeed.cf.uxB68C_gDO.css" rel="stylesheet">
    <!--end page level css-->
</head>

<body id="sign-in">
<div class="preloader">
    <div class="loader_img"><img src="<?php echo base_url(); ?>assets/img/loader.gif.pagespeed.ce.9OKnn8kx6t.gif" alt="loading..." height="64" width="64"></div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1 login-form">
                <h2 class="text-center">
                    <img src="<?php echo base_url(); ?>assets/img/pages/xclear_black.png.pagespeed.ic.aWoM-UtxIO.png" alt="Logo">
                </h2>
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="text-center">Reset Password</h4>
                    </div>
                    <!-- this is an error message from controller,email not exist -->
                    <?php  
                       if(isset($error)){ ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>  
                     <?php  }  ?>
                    <div class="col-xs-12">
                        <form action="<?php echo base_url('welcome/update_password'); ?>" id="authentication" method="post" class="reset_validator">
                            <?php if(isset($email_hash, $email_code)) { ?>
                            <input type="hidden" name="email_hash" value="<?php echo $email_hash; ?>" />
                            <input type="hidden" name="email_code" value="<?php echo $email_code; ?>" />
                            <?php  } ?>
                                <div class="form-group">
                                    <label for="email" class="sr-only">Email</label>
                                    <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Email" value="<?php echo (isset($email)) ? $email : ''; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <label for="confirm-password" class="sr-only">Password</label>
                                    <input type="password" class="form-control form-control-lg" id="confirm-password" name="password_confirm" placeholder="Confirm Password">
                                </div>
                            <div class="form-group">
                                <input type="submit" value="Reset Password" class="btn btn-primary center-block"/>
                            </div>
                        </form>
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
<script src="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_js/reset_password.js"></script>
<!-- end of page level js -->
</body>

</html>
