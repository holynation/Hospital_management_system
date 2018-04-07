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
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_bootstrap-table%2c_css%2c_bootstrap-table.min.css%2bcss%2c_custom.css.pagespeed.cc.7zClYA9zvj.css"/>
    <!-- end of global css -->
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/css/datepicker.css" type="text/css" rel="stylesheet">
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom_css/bootstrap_tables.css">
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->

<?php include 'includes/static-header.php'; ?>

<?php $this->load->view('navigation/admin_nav'); ?>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Update Patient
        </h1>
        <ol class="breadcrumb">
            <li>
                <a href="<?php echo base_url('welcome/dashboard'); ?>">
                    <i class="fa fa-fw ti-home"></i> Dashboard
                </a>
            </li>
            <li class="active">
                Update Patient
            </li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- table start-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel filterable">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="ti-layout-grid2"></i> Update Patient Table
                        </h3>
                    </div>
                    <div class="col-md-4" style="margin:15px 15px 0px;">
                        <a href="<?php echo base_url('patient/view_patient'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list icon-list"></i> View Patient</a>
                    </div>
                    <?php
                    if(isset($error)){ ?>
                        <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                    <?php } ?>

                    <?php
                    foreach($data_patient as $patient):
                        ?>
                        <div class="panel-body text-center">
                            <form id="" action="<?php echo base_url('patient/update_patient2'); ?>" method="post" class="form-horizontal">

                                                    <div class="">
                                                        <hr><b class="text-center">HEALTH INFO</b><hr>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="genotype">
                                                                Genotype
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <select id="genotype" name="genotype" class="form-control" disabled>
                                                                    <option value="<?php echo $patient->genotype;  ?>"><?php echo $patient->genotype;  ?></option>
                                                                    <option value=""> Please select one </option>
                                                                    <option value="AA">AA</option>
                                                                    <option value="AS">AS</option>
                                                                    <option value="SS">SS</option>
                                                                    <option value="AC">AC</option>
                                                                    <option value="CC">CC</option>
                                                                    <option value="SC">SC</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="blood_group">
                                                                Blood Group
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <select id="blood_group" name="blood_group" class="form-control" disabled>
                                                                    <option value="<?php echo $patient->blood_group;  ?>"><?php echo $patient->blood_group;  ?></option>
                                                                    <option value=""> Please select one </option>
                                                                    <option value="A+">A+</option>
                                                                    <option value="A-">A-</option>
                                                                    <option value="B+">B+</option>
                                                                    <option value="B-">B-</option>
                                                                    <option value="O+">O+</option>
                                                                    <option value="O-">O-</option>
                                                                    <option value="AB+">AB+</option>
                                                                    <option value="AB-">AB-</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="val-firstname">
                                                                Blood Pressure
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="val-firstname" name="blood_pressure" class="form-control"  placeholder="<?php echo $patient->blood_pressure; ?>"  value="<?php echo $patient->blood_pressure; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="val-firstname">
                                                                Weight
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="val-firstname" name="weight" class="form-control"  placeholder="<?php echo $patient->weight; ?>"  value="<?php echo $patient->weight; ?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="val-firstname">
                                                                Height
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="val-firstname" name="height" class="form-control"  placeholder="<?php echo $patient->height; ?>"  value="<?php echo $patient->height; ?>">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="val-firstname">
                                                                Pulse
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="val-firstname" name="pulse" class="form-control"  placeholder="<?php echo $patient->pulse; ?>"  value="<?php echo $patient->pulse; ?>">
                                                            </div>
                                                        </div>


                                                        <div class="form-group">
                                                            <label class="col-md-4 control-label" for="val-firstname">
                                                                Body Temperature
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="col-md-6">
                                                                <input type="text" id="val-firstname" name="body_temprature" class="form-control"  placeholder="<?php echo $patient->body_temprature; ?>"  value="<?php echo $patient->body_temprature; ?>">
                                                            </div>
                                                        </div>

                                                        <input type="hidden" name="patient_update_id" value="<?php echo $patient->id; ?>" />




                                                        <div class="row">
                                                            <br><br>
                                                            <div class="form-group form-actions">
                                                                <div class="col-md-8 col-md-offset-2">
                                                                    <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnPatientUpdate2">Update</button>
                                                                </div>
                                                            </div>
                                                        </div>
                            </form>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <!-- table end-->
        <div class="background-overlay"></div>
    </section>
</aside>
</div>
<!-- wrapper-->
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script><!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function(){
        var date_input=$('input[id="datetimepicker1"]'); //our date input has the name "date"
        var container=$('.row form-group').length>0 ? $('.row form-group').parent() : "body";
        var options={
            format: 'yyyy/mm/dd',
            container: container,
            todayHighlight: true,
            autoclose: true,
        };
        date_input.datepicker(options);
    })
</script>
</body>
</html>
