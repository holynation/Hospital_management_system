<?php
$user_data = is_logged();
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
    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_daterangepicker%2c_css%2c_daterangepicker.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.css%2bvendors%2c_datedropper%2c_datedropper.css%2bvend" rel="stylesheet"/>

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
                Casenote
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    Casenote
                </li>
                <li class="active">
                    Edit Casenote
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
                                <a href="<?php echo base_url('casenote/view_casenote'); ?>">
                                    <button class="button button-rounded button-primary-flat hvr-hang">
                                        <i class="fa fa-fw ti-list"></i>  View Casenote
                                    </button>
                                </a>
                            </h3>
                        </div>


                        <div class="panel-body">
                            <div class="col-md-8 col-md-offset-2 ">


                                    <form method="post"
                                          action="<?php echo base_url('casenote/update_casenote'); ?>
                                                    "   class="form-horizontal form-bordered">
                                        <div class="row">

                                            <div class="form-group striped-col">
                                                <label class="col-sm-3 control-label" for="health_status">
                                                    Complaint
                                                </label>
                                                <div class="col-sm-6">
                                                    <input type="text" id="health_status" name="health_status" class="form-control" placeholder="Enter Patient Health condition" value="<?php echo $data_casenote->health_status; ?>" required="required">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="description">
                                                    Diagnosis
                                                </label>
                                                <div class="col-sm-6">
                                                    <textarea id="description" name="description" rows="4" class="form-control resize_vertical" value="<?php echo $data_casenote->diagnosis; ?>"  placeholder="<?php echo $data_casenote->diagnosis; ?>" required="required"></textarea>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-sm-3 control-label" for="prescription">
                                                    Drug Prescription
                                                </label>
                                                <div class="col-sm-6">
                                                    <textarea id="prescription" name="prescription" rows="4" class="form-control resize_vertical" placeholder="<?php echo $data_casenote->prescription; ?>" value="<?php echo $data_casenote->prescription; ?>" required="required"></textarea>
                                                </div>
                                            </div>

                                            <input type="hidden" name="case_id" value="<?php echo $data_casenote->id; ?>">




                                            <div class="form-group form-actions">
                                                <div class="col-md-6 col-md-offset-5">
                                                    <button type="submit"  name="Update" class="btn btn-effect-ripple btn-primary" >Update</button>

                                                </div>
                                            </div>

                                        </div>
                                    </form><br/><br/>




                                <!-- end of div -->

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
<!-- begining of page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/toolbar/js/jquery.toolbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/pickers.js" type="text/javascript"></script>
<!-- end of page level js -->


</body>
</html>