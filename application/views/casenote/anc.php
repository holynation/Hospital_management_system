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
    
    <link href="<?php echo base_url(); ?>assets/vendors%2c_iCheck%2c_css%2c_all.css%2bcss%2c_passtrength%2c_passtrength.css%2bcss%2c_custom.css%2bvendors%2c_sweetalert2%2c_css%2c_sweetalert2.min.css%2bvendors%2c_bootstrapvalidator%2c_css%2c_bootstra" rel="stylesheet"/>

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>

    <link type="text/css" href="<?php echo base_url(); ?>assets/css/A.app.css.pagespeed.cf.odGN98LG8l.css" rel="stylesheet"/>
    
   <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <!-- end of global css -->

     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">
    
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
                Ante-Natal Clinic
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                  <li class="active">
                    ANC
                </li>
            </ol>
        </section>
        <!--section ends-->
        <?php
            if($patient):
        ?>
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  Ante-Natal Clinic
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
                        <div class="panel-body">


                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel ">
                                        <div class="panel-body">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <div class="text-center mbl m-t-10">
                                                        <img src="<?php echo base_url($patient->picture_path); ?>" alt="img" class="img-circle img-bor"/>
                                                    </div>
                                                </div>
                                                <div class="profile_user">
                                                    <h3 class="user_name_max"> <?php echo $patient->title; ?> <?php echo $patient->first_name, ' ', $patient->last_name; ?> <?php echo $patient->middle_name; ?></h3>


                                                </div>

                                                <div class="profile_user">
                                                    <h3 style="color: brown"> Complaint </h3>
                                                    <div class="form-group striped-col">
                                                        <p>
                                                            <?php
                                                            foreach($data_appointment as $appointment):
                                                            ?>
                                                            <?php echo $appointment->complaint; ?></p>
                                                        <?php endforeach; ?>

                                                    </div>

                                                </div>


                                                <div class="profile_user">
                                                    <h3> Personal Info </h3>
                                                    <div class="form-group striped-col">
                                                        <p><?php echo get_current_age($patient->dob); ?> | <?php echo $patient->gender; ?> | <?php echo $patient->marital_status ; ?></p>
                                                        <p><?php echo $patient->email; ?> | <?php echo $patient->phone_no; ?></p>
                                                        <p><?php echo $patient->lga; ?> | <?php echo $patient->occupation; ?></p>
                                                        <p><?php echo $patient->address; ?></p>

                                                    </div>

                                                </div>
                                                &nbsp;&nbsp;



                                            </div>
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <!-- Nav tabs -->
                                                        <ul class="nav nav-tabs nav-custom">
                                                            <li class="active">
                                                                <a href="#tab-personal" data-toggle="tab">
                                                                    <strong>Doctor in charge:

                                                                        <?php echo $data_doctor->title; ?> <?php echo $data_doctor->first_name, ' ', $data_doctor->last_name; ?> <?php echo $data_doctor->middle_name; ?>


                                                                        <!--        <?php
                                                                        foreach($data_appointment as $appointment):
                                                                            ?>
                                                    <?php echo base_url('casenote/create/'. $appointment->id); ?>
                                                     <?php endforeach; ?> -->
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

                                                                            <label class="container striped-col">Complaint History</label>


                                                                            <div class="form-group">
                                                                                <label class="col-sm-3 control-label" for="description">
                                                                                    Presenting complaint
                                                                                </label>
                                                                                <div class="col-sm-6">
                                                                                    <textarea id="description" name="description" rows="7" class="form-control resize_vertical" placeholder="Enter the information here ... ..." required="required"></textarea>
                                                                                </div>
                                                                            </div>

                                                                            <div class="form-group">
                                                                                <label class="col-sm-3 control-label" for="description">
                                                                                    History of presenting complaint
                                                                                </label>
                                                                                <div class="col-sm-6">
                                                                                    <textarea id="description" name="description" rows="7" class="form-control resize_vertical" placeholder="Enter the information here ... ..." required="required"></textarea>
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </form><br/><br/>




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
<!-- global js -->
<div id="qn"></div>
<!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/iCheck/js/icheck.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<!-- end of page level js -->

</body>
</html>