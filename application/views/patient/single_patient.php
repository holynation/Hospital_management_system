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
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Patient
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    Patients
                </li>
                <li class="active">
                    View Patient
                </li>
            </ol>
        </section>
        <?php
            foreach($data_patient as $patient):
        ?>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin:5px 5px 10px;">
                            <a href="<?php echo base_url('patient/view_patient'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list icon-list"></i> View Patient</a>
                    </div>
                    <div class="panel ">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-center mbl m-t-10">
                                        <img src="<?php echo base_url($patient->picture_path); ?>" alt="img" class="img-circle img-bor"/>
                                    </div>
                                </div>
                                <div class="profile_user">
                                    <h3 class="user_name_max"><?php echo $patient->first_name, ' ', $patient->last_name; ?></h3>
                                    <p><?php echo $patient->email; ?> / <?php echo $patient->phone_no; ?></p>
                                    <span class="fa-stack faceb fa-lg">
                                         <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-stack-1x fa-facebook fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack googleplus fa-lg">
                                         <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-google-plus fa-inverse"></i>
                                    </span>
                                    <span class="fa-stack tweet-btn fa-lg">
                                         <i class="fa fa-circle fa-stack-2x"></i>
                                        <i class="fa fa-flag fa-stack-1x fa-twitter fa-inverse"></i>
                                    </span>
                                </div>
                                &nbsp;&nbsp;
                                <div class="profile_user">
                                    <a href="<?php echo base_url('appointment/create/' . $patient->id); ?>"><button type="button" class="btn btn-success btn-sm">Book Appointment</button></a>
                                    <a href="<?php echo base_url('ward/bed_assign/' . $patient->id); ?>"><button type="button" class="btn btn-info btn-sm">Assign Bed</button></a>
                                </div>
                                <br/>
                                <div class="panel panel-widget panel-default">
                                    <div class="panel-heading">
                                        <span class="panel-title"> <i class="icon-chart icons"></i> Patient Status<i class="icon-settings icons pull-right"></i></span>
                                    </div>
                                    <div class="panel-body profile_status">
                                        <div>
                                            <p>
                                                <strong>Appointment Status</strong>
                                                <small class="pull-right text-muted">
                                                    <?php 
                                                    $appointment = '';
                                                       $appointment = $this->Model_patient->get_appointment($patient->id);
                                                       if($appointment == 'no result'){
                                                         echo 'No appointment yet...';
                                                       }else{
                                                        $appointment = $appointment ->row();
                                                        echo $appointment->appointment_date;

                                                       if($appointment->status == 'true'){ ?>
                                                        <span class="ti-check-box" style="color:green;font-size:18px;"></span>
                                                    <?php   }else{ ?>
                                                        <span class="ti-na" style="color:red;font-size:18px;"></span>
                                                   <?php } } ?>
                                                </small>
                                            </p>
                                            <hr />
                                        </div>
                                        <?php
                                            if($patient->modifier){ ?>
                                                <div>
                                            <p>
                                                <strong>Modifier</strong>
                                                <small class="pull-right text-muted">
                                                    <i class="icon-pencil icons"></i> <?php echo $patient->modifier; ?>
                                                </small>
                                            </p>
                                            <hr />
                                        </div>
                                           <?php } ?>
                                        
                                        <div>
                                            <p>
                                                <strong>Date Created</strong>
                                                <small class="pull-right text-muted">
                                                      <?php  
                                                        $date_data = $patient->date_created;
                                                        $date_created = DateCreate::dateFormat($date_data); ?>
                                                        <i class="icon-calendar icons"></i> <?php echo $date_created; ?>
                                                </small>
                                            </p>
                                        </div>
                                        <hr />
                                        <div>
                                            <p>
                                                <strong>Last Modified</strong>
                                                <small class="pull-right text-muted">
                                                      <?php  
                                                        $date_data = $patient->date_modified;
                                                        $date_created = DateCreate::dateFormat($date_data); ?>
                                                        <i class="icon-calendar icons"></i> <?php echo $date_created; ?>
                                                </small>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-custom">
                                            <li class="active">
                                                <a href="#tab-personal" data-toggle="tab">
                                                    <strong>Personal</strong>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#Next-kin" data-toggle="tab">
                                                    <strong>Next Kin</strong>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#tab-health" data-toggle="tab">
                                                    <strong>Health Info</strong>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content nopadding noborder">
                                            <div id="tab-personal" class="tab-pane animated fadeInRight fade in active">
                                                <div class="col-sm-12">
                                                    <form method="post" class="form-horizontal form-bordered">
                                                        <div class="row">
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="title">Title</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Text" value="<?php echo $patient->title; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="first-name">First Name</label>
                                                                <div class="col-sm-6">
                                                                    <input type="email" id="first-name" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $patient->first_name; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="last-name">Last Name</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $patient->last_name; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="middle-name">Middle Name</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $patient->middle_name; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="dob">Date Of Birth</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="dob" name="dob" class="form-control" placeholder="Date Of Birth" value="<?php echo $patient->dob; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="gender">Gender</label>
                                                                <div class="col-sm-6">
                                                                    <select id="gender" name="gender" class="form-control" size="1">
                                                                        <option value="<?php echo $patient->gender; ?>"><?php echo $patient->gender; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="marital_status">Marital Status</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="marital_status" name="marital_status" class="form-control" placeholder="Marital Status" value="<?php echo $patient->marital_status; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="email">Email</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $patient->email; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="phone">Phone Num</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Num" value="<?php echo $patient->phone_no; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="state">State</label>
                                                                <div class="col-sm-6">
                                                                    <select id="state" name="state" class="form-control" disabled size="1">
                                                                        <?php $name = $this->Model_staff->display_state($patient->state); 
                                                                            if($name == ''){ ?>
                                                                                <option value=""></option>
                                                                            <?php }else{ ?>
                                                                                <option value="<?php echo $name->state_name; ?>"><?php echo $name->state_name; ?></option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="lga">LGA</label>
                                                                <div class="col-sm-6">
                                                                    <select id="lga" name="lga" class="form-control" size="1">
                                                                        <option value="<?php echo $patient->lga; ?>"><?php echo $patient->lga; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="address">Address</label>
                                                                <div class="col-sm-6">
                                                                    <textarea id="address" name="address" rows="7" class="form-control resize_vertical" placeholder="Address...." disabled><?php echo $patient->address; ?></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="occupation">Occupation</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="occupation" name="occupation" class="form-control" placeholder="Occupation" value="<?php echo $patient->occupation; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="city">City</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" id="city" name="city" class="form-control" placeholder="City" value="<?php echo $patient->city_address; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!-- tab-pane -->
                                            <div class="row tab-pane" id="Next-kin">
                                                <form class="form-horizontal" role="form">
                                                <div class="col-md-6 col-lg-6 col-sm-6 bord">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="col-sm-4 control-label" for="first-name">First Name</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="email" id="first-name" name="first_name" class="form-control" placeholder="First Name Kin" value="<?php echo $patient->firstname_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-sm-6 bord">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="col-sm-3 control-label" for="last-name">Last Name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Last Name Kin" value="<?php echo $patient->last_name_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-sm-6 bord">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <label class="col-sm-3 control-label" for="middle-name">Middle Name</label>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="Middle Name Kin" value="<?php echo $patient->middle_name_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-sm-6 bord">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <label class="col-sm-3 control-label" for="relationship">Relationship</label>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input type="text" id="relationship" name="relationship" class="form-control" placeholder="Relationship Kin" value="<?php echo $patient->relationship_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="col-md-10 col-lg-12 col-sm-12 bord">
                                                            <div class="row">
                                                                <div class="col-md-2">
                                                                    <label class="col-sm-4 control-label" for="phone">Phone Num</label>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" id="phone" name="phone_kin" class="form-control" placeholder="Phone Kin" value="<?php echo $patient->phone_kin; ?>" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-lg-6 col-sm-6 bord">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <label class="col-sm-3 control-label" for="address">Address</label>
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <textarea id="address" name="address" rows="7" class="form-control resize_vertical" placeholder="Kin Address...." disabled><?php echo $patient->address_kin; ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="tab-health">
                                                <div class="row">
                                                    <div class="col-sm-12 form-group">
                                                        <label class="col-sm-2 control-label" for="genotype">Genotype</label>
                                                        <div class="col-sm-4">
                                                            <select id="genotype" name="genotype" class="form-control" size="1" disabled>
                                                                <option value="<?php echo $patient->genotype; ?>"><?php echo $patient->genotype; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="col-sm-2 control-label" for="blood_group">Blood Group</label>
                                                        <div class="col-sm-4">
                                                            <select id="blood_group" name="blood_group" class="form-control" size="1" disabled>
                                                            <option value="<?php echo $patient->blood_group; ?>"><?php echo $patient->blood_group; ?></option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 form-group">
                                                        <label class="col-sm-2 control-label" for="blood_group">Allergy</label>
                                                        <div class="col-sm-4">
                                                            <textarea rows="7" class="form-control resize_vertical" placeholder="Allergy" disabled><?php echo $patient->allergy; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- events -->
                                            </div>
                                            <!-- tab-pane -->
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
        <?php endforeach; ?>
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
