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
     <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_clockface%2c_css%2c_clockface.css%2bvendors%2c_colorpicker%2c_css%2c_bootstrap-colorpicker.min.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.c" rel="stylesheet"/>
    
    <link href="<?php echo base_url(); ?>assets/vendors%2c_iCheck%2c_css%2c_all.css%2bcss%2c_passtrength%2c_passtrength.css%2bcss%2c_custom.css%2bvendors%2c_sweetalert2%2c_css%2c_sweetalert2.min.css%2bvendors%2c_bootstrapvalidator%2c_css%2c_bootstra" rel="stylesheet"/>

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>

    <link type="text/css" href="<?php echo base_url(); ?>assets/css/A.app.css.pagespeed.cf.odGN98LG8l.css" rel="stylesheet"/>
    
   <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <!-- end of global css -->

     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pickers.css">
    
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
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
                Ward
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>Ward</li>
                  <li class="active">
                    Edit Ward
                </li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="<?php echo base_url('ward/view_ward'); ?>">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  View Ward
                                </button></a>
                            </h3>
                        </div>
                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                            <?php } ?>

                        <div class="panel-body">
                            <div class="col-md-10 ">
                                <form action="<?php echo base_url('ward/update_ward'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Edit Ward
                                        </h3>
                                      </b>
                                      <hr>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="ward_name">
                                            Ward Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="hidden" name="ward_update_id" value="<?php echo $data_ward->id; ?>">
                                            <input type="text" id="ward_name" name="ward_name" class="form-control" placeholder="Enter Ward Name" value="<?php echo $data_ward->ward_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="category">
                                            Category
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <select id="category" name="category" class="form-control">
                                                <option><?php echo $data_ward->category; ?></option>
                                                <option value=""> ---- Select Category ---- </option>
                                                <option value="ICU">ICU</option>
                                                <option value="Private">Private</option>
                                                <option value="Public">Public</option>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">
                                            Descripton
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea id="description" name="description" rows="4" class="form-control resize_vertical" placeholder="Short description short info "><?php echo $data_ward->description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="no_of_bed">
                                            No. Of Bed
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="number" id="no_of_bed" name="no_of_bed" class="form-control" placeholder="No. Of Bed" value="<?php echo $data_ward->no_of_bed; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="charge">
                                            Charge
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="number" id="charge" name="charge" class="form-control" placeholder="Charge" value="<?php echo $data_ward->charge; ?>">
                                        </div>
                                    </div>
                                    <br><br/>
                                    <div class="form-group form-actions">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="submit" class="btn btn-effect-ripple btn-primary" id="btnWardUpdate" name="btnWardUpdate">Submit</button>
                                            <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                            </button>
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
<!-- global js -->
<div id="qn"></div>
<!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
</body>
</html>