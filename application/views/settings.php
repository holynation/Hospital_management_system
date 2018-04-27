<?php
$user_data = is_logged();
if(!$user_data){
    redirect('/welcome/');
}
$get_settings = getsettingsdetails();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title> <?php echo (get_ehm_title()) ? get_ehm_title() : 'EHM Dashboard' ; ?> </title>
       <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico"/>
 
    <!-- global css -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>
     <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_clockface%2c_css%2c_clockface.css%2bvendors%2c_colorpicker%2c_css%2c_bootstrap-colorpicker.min.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.c" rel="stylesheet"/>

    <link href="<?php echo base_url(); ?>assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/select2/css/select2.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/select2/css/select2-bootstrap.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css" type="text/css" rel="stylesheet">

   <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <!-- end of global css -->
    
     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">

    <!--end of page level css-->
</head>
<body class="skin-default">

<?php  
    include 'includes/static-header.php';
?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Settings
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                  <li class="active">
                    SetUp Settings
                </li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  Settings
                                </button>
                            </h3>
                        </div>
                        
                        <?php
                            if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:40%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>

                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                            <?php } ?>

                        <?php //  this is for the validation page
                            if(validation_errors()){ ?>
                                <?php echo validation_errors('<div class="alert alert-danger" style="padding-left:40%;">','</div>'); ?>
                         <?php } ?>
                        <div class="panel-body">
                            <div class="col-md-10 ">
                                <form id="settings_form" action="<?php echo base_url('welcome/settings'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil-alt"></i> Update Settings
                                        </h3>
                                      </b>
                                      <hr>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="system_title">
                                            System Title
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="system_title" name="system_title" class="form-control" placeholder="Enter System Title" value="<?php echo $settings->title; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="pic" class="col-sm-4 control-label">System Logo</label>
                                        <div class="col-sm-4">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                                    <img src="" alt="Logo" class="profile_pic">
                                                </div>
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                                <div>
                                                        <span class="btn btn-default btn-file">
                                                        <span class="fileinput-new">Select image</span>
                                                        <span class="fileinput-exists">Change</span>
                                                        <input id="pic" name="pic_file" type="file" class="form-control"/>
                                                        </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                                </div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-sm-2">
                                            <label>Current Image</label>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;">
                                                <img src="<?php echo base_url($settings->logo); ?>" class="img-responsive" />
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="smtp_host">
                                            SMTP Host
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="smtp_host" name="smtp_host" class="form-control" placeholder="SMTP Host" value="<?php echo $settings->smtp_host; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="smtp_username">
                                            SMTP Username
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="smtp_username" name="smtp_username" class="form-control" placeholder="SMTP Host" value="<?php echo $settings->smtp_username; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="smtp_password">
                                            SMTP Password
                                        </label>
                                        <div class="col-md-6">
                                            <input type="password" id="smtp_password" name="smtp_password" class="form-control" placeholder="SMTP Password" value="<?php echo $settings->smtp_password; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="email">
                                            System Email
                                        </label>
                                        <div class="col-md-6">
                                            <input type="email" id="email" name="email" class="form-control" placeholder="SMTP Email" value="<?php echo $settings->email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="mobile">
                                             Mobile
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="mobile" name="mobile" class="form-control" placeholder="mobile" value="<?php echo $settings->mobile; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="address">
                                             Address
                                        </label>
                                        <div class="col-md-6">
                                            <textarea id="address" name="address" class="form-control" placeholder="address"><?php echo $settings->address; ?></textarea>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <br><br>
                                        <div class="form-group form-actions">
                                            <div class="col-md-6 col-md-offset-4">
                                                <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnSaveChanges">Change</button>
                                                <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>

<script type="text/javascript" src="<?php echo base_url() ; ?>assets/vendors/Buttons/js/buttons.js"></script>
<!-- global js -->
<div id="qn"></div>
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->

<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/select2/js/select2.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/settings.js" type="text/javascript"></script>
<!-- end of page level js -->

</body>
</html>


