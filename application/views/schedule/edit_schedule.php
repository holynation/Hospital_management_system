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
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_daterangepicker%2c_css%2c_daterangepicker.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.css%2bvendors%2c_datedropper%2c_datedropper.css%2bvend" rel="stylesheet"/>
    <!-- end of global css -->

    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-multiselect/css/bootstrap-multiselect.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendors/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendors/select2/css/select2-bootstrap.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendors/selectize/css/selectize.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendors/selectric/css/selectric.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendors/selectize/css/selectize.bootstrap3.css" rel="stylesheet" type="text/css">
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/css/all.css" rel="stylesheet" type="text/css">
    <Link href="<?php echo base_url(); ?>assets/vendors/iCheck/css/line/line.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">

    <!--page level css -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>

    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/pickers.css">
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <section class="content-header">
            <!--section starts-->
            <h1> Schedule</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li class="">
                    Schedule
                </li>
                <li class="active">
                    Edit Schedule
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
                                     <i class="fa fa-fw ti-list"></i>  Edit Schedule
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

                        <?php

                            if(!$data_schedule){
                                return false;
                            }
                        ?>

                        <div class="panel-body text-center">
                            <div class="col-md-10 ">
                                <form id="form-validation5" action="<?php echo base_url('schedule/update'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Edit Schedule
                                        </h3>
                                      </b>
                                      <hr>
                                      <input type="hidden" name="update_schedule_id" value="<?php echo $data_schedule->id; ?>" />
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="doctor_name">
                                            Doctor Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                        <?php $doctor = $this->Model_schedule->get_doctor_by_id($data_schedule->doctor_id); 
                                            $docname = "Dr. " . $doctor->first_name . ' ' .$doctor->last_name;
                                        ?>
                                            <select id="dynamicnew" class="form-control" name="doctor_name" placeholder="Enter Doctor Name">
                                                <option value="<?php echo $doctor->id; ?>"> <?php echo $docname; ?> </option>
                                            </select>
                                        </div>
                                    </div>
                                     <div class="form-group">
                                        <label class="col-md-4 control-label">
                                            Available Days
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <select id="dynamic" class="form-control" name="available_days">
                                                <option value="<?php echo $data_schedule->available_days; ?>"><?php echo $data_schedule->available_days; ?></option>
                                                <option value="">  Select option </option>
                                                <option value="Sunday">Sunday</option>
                                                <option value="Monday">Monday</option>
                                                <option value="Tuesday">Tuesday</option>
                                                <option value="Wednesday">Wednesday</option>
                                                <option value="Thursday">Thursday</option>
                                                <option value="Friday">Friday</option>
                                                <option value="Saturday">Saturday</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="datetime2">
                                            Available Time 
                                              <span class="text-danger">*</span>
                                         </label>
                                        <div class="col-md-6">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-laptop"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="datetime2" name="available_time_start" placeholder="Start-Time" value="<?php echo $data_schedule->available_time_start; ?>" />
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <div class="input-group-addon">
                                                        <i class="fa fa-laptop"></i>
                                                    </div>
                                                    <input type="text" class="form-control" id="datetime12" name="available_time_end" placeholder="End-Time" value="<?php echo $data_schedule->available_time_end; ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <br><br>
                                        <div class="form-group form-actions">
                                            <div class="col-md-8 col-md-offset-2">
                                                <button type="submit" name="btnUpdateSchedule" class="btn btn-effect-ripple btn-primary">Update</button>
                                                <!-- <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                                </button> -->
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--rightside bar -->
            <div class="background-overlay"></div>
        </section>
        <!--main content ends-->
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- global js -->
<?php include (APPPATH . 'views/schedule/footer_schedule.php'); ?>
<!-- end of page level js -->
</body>
</html>
