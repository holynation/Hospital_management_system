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
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css" rel="stylesheet"/>
    <!-- end of global css -->
    <!--page level css -->
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/A.vendors%2c%2c_simple-line-icons%2c%2c_css%2c%2c_simple-line-icons.css%2bvendors%2c%2c_animate%2c%2c_animate.min.css%2bcss%2c%2c_custom_css%2c%2c_user_profile.css%2cMcc.7mNdQ0eL1J.css.pagespeed.cf.iRYiW"/>
    
    
    <!--end of page level css-->
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->

          <?php
                            if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:40%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>


        <section class="content-header">
            <h1>
                Create Patient Casenote
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    Case Manager
                </li>
                <li class="active">
                    Case note
                </li>
            </ol>
        </section>
      
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel ">
                        <div class="panel-body">
             
                            <div class="col-md-10 col-md-offset-2">
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                                                  <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-custom">
                                            <li class="active">
                                                <a href="#tab-personal" data-toggle="tab">
                                                    <strong>CREATE CASENOTE
                                </strong>
                                                </a>
                                            </li>
                                        </ul>
                                    
                                        <!-- Tab panes -->
                                        <div class="tab-content nopadding noborder">
                                            <div id="tab-personal" class="tab-pane animated fadeInRight fade in active">
                                                <div class="col-sm-12">
                                                    <form method="post" 
                                                    action="<?php echo base_url('casenote/create_direct'); ?>
                                                    "   class="form-horizontal form-bordered">
                                                        <div class="row">

                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="health_status">
                                                                 Health State <span style="color: red">*</span>
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="health_status" name="health_status" class="form-control" placeholder="Enter Patient Health condition" value=""  required="required">
                                                                </div>
                                                            </div>                                                        

                                                              <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="description">
                                                                    Description
                                                                </label>
                                                                <div class="col-sm-6">
                                                                    <textarea id="description" name="description" rows="7" class="form-control resize_vertical" placeholder="Description of activities to be carried out...." required="required"></textarea>
                                                                </div>
                                                            </div>

                                                                        <input type="text"  name="app_id"   value="<?php
                                                      // foreach($data_appointment as $appointment):
                                                   ?> 
                                                    <?php// echo $appointment->id; ?>
                                                    <?php// endforeach; ?>"  hidden>

                                                             <input type="text"  name="patient_id"   value="<?php //echo $patient->id; ?>"  hidden>
                                                              <input type="text"  name="created_by"   value="<?php// echo $data_doctor->id; ?>"  hidden>

                                                            <div class="form-group form-actions">
                                                              <div class="col-md-6 col-md-offset-5">
                                                                <button type="submit" class="btn btn-effect-ripple btn-primary" >Submit</button>
                                                                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                                                   </button>
                                                               </div>
                                                            </div>
                                                                     
                                                        </div>
                                                    </form><br/><br/>


                                                     <div class="panel panel-widget panel-default">
                                 
                                </div>
                                                

                                                </div> <!-- end of div -->
                                            </div>
                                      
                                        </div>
                                        <!-- tab-content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
    </aside>
</div>
<!--wrapper ends-->
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
</body>

</html>
