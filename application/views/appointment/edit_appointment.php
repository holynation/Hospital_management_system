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
                Appointment
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    Appointment
                </li>
                  <li class="active">
                    Edit Appointment
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
                                <a href="<?php echo base_url('appointment/view_appoint'); ?>">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  View Appointment
                                </button>
                                </a>
                            </h3>
                        </div>
                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                            <?php } ?>

                        <div class="panel-body">
                            <div class="col-md-10 ">
                                <form action="<?php echo base_url('appointment/update_appointment'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Edit Appointment
                                        </h3>
                                      </b>
                                      <hr>
                                    <input type="hidden" name="type" value="<?php echo $data_appointment->type; ?>" />
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="val-patientname">
                                            Patient Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="hidden" name="patient_update_id" value="<?php echo $data_appointment->id; ?>">
                                            <input type="text" id="val-patientname" name="patient_name" class="form-control" placeholder="Enter Patient Name" value="<?php 
                                            $patient_name = $this->Model_appointment->get_patient_by_id($data_appointment->patient_id);
                                            echo $patient_name->first_name, ' ', $patient_name->last_name;
                                        ?>" disabled>
                                        </div>
                                    </div>
                                    <?php 
                                            $doctor = $this->Model_appointment->get_doctor_by_id($data_appointment->doctor_name);
                                            $middle = substr($doctor->middle_name, 0, 1);
                                    ?>
                                    <div class="form-group">
                                         <label class="col-md-4 control-label" for="department">
                                            Department 
                                              <span class="text-danger">*</span>
                                         </label>
                                          <div class="col-md-6">
                                            <select id="department" name="department" class="form-control" disabled>
                                                <option value="<?php echo $data_appointment->department; ?>"> 
                                                    <?php $depart_name = $this->Model_staff->get_depart_name($data_appointment->department)->row(); ?>

                                                    <?php echo $depart_name->department_name; ?>
                                                </option>
                                                <option value=""> Please select department </option>
                                            <?php foreach($departments as $department): ?>
                                                <option value="<?php echo $department->id; ?>"><?php echo $department->department_name; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                          </div>
                                    </div>
                                    <script>
                                        $(document).ready(function(){
                                            $('#department').on('change', function(){
                                                var data = $('#department').val();
                                                $.post('<?php echo base_url();?>appointment/load_doctor_1', { department_id: data },
                                                  function(result){
                                                    // console.log(result);
                                                    $('#feedbackDoctor').html(result).show();
                                                    $('#doctor_name2').hide();
                                                });
                                            });
                                        });
                                          
                                    </script>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="doctor_name">
                                            Doctor Name 
                                              <span class="text-danger">*</span>
                                         </label>
                                         
                                        <div class="col-md-6">
                                            <div id="feedbackDoctor"></div>
                                            <!-- this shows the default value of assigned value -->
                                            <select id="doctor_name2" class="form-control" disabled>
                                                <option value="<?php echo $doctor->id; ?>">Dr. <?php echo $doctor->first_name, ' ', $middle , (empty($middle)) ? '' : '. ' ,$doctor->last_name; ?></option>
                                            </select>
                                            <br>
                                                <div id="feedbackschedule"></div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="val-username">
                                            Appointment Date
                                             <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <div class='input-group date'>
                                                <input type="text" class="form-control" id="datetime1" name="appointment_date" value="<?php echo $data_appointment->appointment_date; ?>" />
                                                <span class="input-group-addon">
                                                 <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                              </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="complaint">
                                            Complaint
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea id="complaint" name="complaint" rows="4" class="form-control resize_vertical" placeholder="Let us know your Complaint "><?php echo $data_appointment->complaint; ?></textarea>
                                        </div>
                                    </div>
                                    <br><br/>
                                    <div class="form-group form-actions">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="submit" class="btn btn-effect-ripple btn-primary" id="btnAppointUpdate" name="btnAppointUpdate">Submit</button>
                                            <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $('#btnAppointUpdate').on('submit', function(){
                                                var department = $('#department').val();
                                                var doctor_name = $('#doctor_name2').val();
                                                var complaint = $('#complaint').val();

                                                if(department == '' || doctor_name == '' || complaint == ''){
                                                    $('#department,#doctor_name2,#datetime1,#complaint').css({
                                                            'border-color' : 'red',
                                                            'border-style' : 'solid',
                                                            'border-width' : '0.5px'
                                                    });
                                                        return false;
                                                } 

                                                return true;
                                            });
                                        });
                                    </script>
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