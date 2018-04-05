<?php
$user_data = is_logged();
$get_settings = getsettingsdetails();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title> <?php echo $get_settings->title; ?> | <?php if($user_data->status == 'success'){ echo $user_data->role; }else{ echo ' ';} ?> Dashboard </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/A.app.css.pagespeed.cf.odGN98LG8l.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/vendors%2c_iCheck%2c_css%2c_all.css%2bvendors%2c_datetime%2c_css%2c_jquery.datetimepicker.css%2bvendors%2c_bootstrap-touchspin%2c_css%2c_jquery.bootstrap-touchspin.css%2bcss%2c_custom.css.pagespe" rel="stylesheet"/>
    
    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_daterangepicker%2c_css%2c_daterangepicker.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.css%2bvendors%2c_datedropper%2c_datedropper.css%2bvend" rel="stylesheet"/>
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <!-- end of global css -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>

<body class="skin-default">
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Discharge Date</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li> Ward</li>
                <li>Bed Assign </li>
                <li class="active"> Discharge Date</li>
            </ol>
        </section>
        <!-- Main content -->
        <?php
            if($data_patient):
        ?>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div style="margin:5px 5px 10px;">
                        <a href="<?php echo base_url('ward/view_bed_assign'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list icon-list"></i> Bed Assign List</a>
                    </div>
                    <div class="panel col-sm-offset-3">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw ti-calendar"></i> Discharge Date
                            </h3>
                            <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                        </div>
                        <br />
                        <?php 
                            if($data_patient == 'no result'){ ?>
                            <div class="alert alert-danger"> No result found on this patient... </div>
                        <?php  }else if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:60%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>
                        <div class="panel-body">
                            <form action="" method="post">
                                <div class="row">
                                    <input type="hidden" name="patient_bed_id" value="<?php echo $data_patient->id; ?>">
                                    <input type="hidden" name="charge" value="<?php echo $data_patient->charge; ?>">
                                    <input type="hidden" name="assign_date" id="assign_date" value="<?php echo $data_patient->assign_date; ?>">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Patient Name</label>
                                            <?php $patient_name = $this->Model_patient->get_patient_by_id($data_patient->patient_id);
                                            if(!$patient_name){
                                                echo 'patient not found';
                                            } ?>
                                            <input type="text" class="form-control" placeholder="Username" value="<?php echo $patient_name->first_name, ' ', $patient_name->last_name; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Assign Date</label>
                                            <input type="text" class="form-control" placeholder="" value="<?php echo $data_patient->assign_date; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Ward</label>
                                            <input type="text" class="form-control" placeholder="" value="<?php echo $data_patient->ward_name, ' (', $data_patient->category, ')' ; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Discharge Date</label>
                                            <div class="input-group ">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw ti-calendar"></i>
                                                </div>
                                                <input class="form-control" id="datetime20" name="discharge_date" size="40" placeholder="YYYY-MM-DD">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <h3><div id="no_of_days"></div></h3>
                                        </div>
                                    </div>
                                    <div class="form-group form-actions">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="submit" class="btn btn-effect-ripple btn-primary" id="btnUpdateDischargeDate" name="btnUpdateDischargeDate">Submit</button>
                                        </div>
                                    </div>
                                </div>
                                    
                                <script type="text/javascript">
                                    // $(document).ready(function(){
                                    //     $('#datetime20').change(function(){
                                    //     var date = $('#datetime20').val();
                                    //     var assign_date = $('#assign_date').val();
                                    //     var id = '<?php //echo $data_patient->id; ?>';
                                    //     // alert(id);
                                    //         $.post('<?php //echo base_url();?>ward/discharge_date_status', { task: 'no_of_days', discharge_date: date, assign_date: assign_date },
                                    //               function(result){
                                    //                 // console.log(result);
                                    //                 $('#no_of_days').html(result);
                                    //         });
                                    //     });
                                    // });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
    <?php endif; ?>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/toolbar/js/jquery.toolbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/pickers.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/iCheck/js/icheck.js" type="text/javascript"></script></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>

</html>
