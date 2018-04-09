<?php
$user_data = check_all_access(); // this check all the necessary access to the system and permission
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
   <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <!-- end of global css -->
    
     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">

    <!--end of page level css-->
</head>
<body class="skin-default">
 --><!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Role
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                  <li class="active">
                    Create Role
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
                                     <i class="fa fa-fw ti-list"></i>  Role
                                </button>
                            </h3>
                        </div>
                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                            <?php } ?>

                        <?php //  this is for the validation page
                            if(validation_errors()){ ?>
                                <?php echo validation_errors('<div class="alert alert-danger" style="padding-left:40%;">','</div>'); ?>
                         <?php } ?>
                        <div class="panel-body text-center">
                            <div class="col-md-10 ">
                                <form action="<?php echo base_url('role/create'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Add New Role
                                        </h3>
                                      </b>
                                      <hr>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="role_name">
                                            Role Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Enter Role Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="role_info">
                                            Descripton
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea id="role_info" name="role_info" rows="4" class="form-control resize_vertical" placeholder="Role short info "></textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <br><br>
                                        <div class="form-group form-actions">
                                            <div class="col-md-8 col-md-offset-2">
                                                <button type="submit" class="btn btn-effect-ripple btn-primary">Submit</button>
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

<!--end of page level css-->
<!-- global js -->
<div id="qn"></div>
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script><!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script><!-- end of global js -->

<!-- end of page level js -->

</body>
</html>


