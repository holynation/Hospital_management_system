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
    <?php 
    include (APPPATH.'views/navigation/admin_nav.php');
    // $this->load->view('navigation/admin_nav'); 
    ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Staff
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#"> Staff</a>
                </li>
                <li class="active">
                    View Staff
                </li>
            </ol>
        </section>
        <?php
            foreach($data_staff as $staff):
        ?>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div style="margin:5px 5px 10px;">
                            <a href="<?php echo base_url('staff/view_staff'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list icon-list"></i> View Staff</a>
                    </div>
                    <div class="panel ">
                        <div class="panel-body">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <div class="text-center mbl m-t-10">
                                        <img src="<?php echo base_url($staff->img_path); ?>" alt="img" class="img-circle img-bor"/>
                                    </div>
                                </div>
                                <div class="profile_user">
                                    <h3 class="user_name_max"><?php echo $staff->first_name, ' ', $staff->last_name; ?></h3>
                                    <p><?php echo $staff->email; ?> / <?php echo $staff->phone_no; ?></p>
                                    &nbsp;
                                    <div class="profile_user">
                                        <a href=""><button type="button" class="btn btn-info btn-sm"><?php
                                            $depart_name = $this->Model_staff->get_depart_name($staff->department_id)->row();
                                        ?>
                                        <?php echo $depart_name->department_name; ?> Department</button></a>
                                    </div>
                                    <br/>
                                    <!-- <span class="fa-stack faceb fa-lg">
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
                                    </span> -->
                                </div>
                                &nbsp;&nbsp;
                                <?php
                                 if($staff->role == 'Doctor'){ ?>
                                 <div class="profile_user">
                                    <a href="<?php echo base_url('schedule/create/' . $staff->id); ?>"><button type="button" class="btn btn-success btn-sm">Create Schedule</button></a>
                                </div>
                            <?php }  ?>
                                
                                <br/>
                                <div class="panel panel-widget panel-default">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs nav-custom">
                                            <li class="active">
                                                <a href="#tab-activity" data-toggle="tab">
                                                    <strong>Personal Info</strong>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#followers" data-toggle="tab">
                                                    <strong>Kin Info</strong>
                                                </a>
                                            </li>
                                            <?php
                                                if($staff->role == 'Doctor'){ ?>
                                                <li>
                                                <a href="#tab-events" data-toggle="tab">
                                                    <strong>My Events</strong>
                                                </a>
                                            </li>
                                           <?php } ?>
                                            
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content nopadding noborder">
                                            <div id="tab-activity" class="tab-pane animated fadeInRight fade in active">
                                                <div class="col-md-12">
                                                    <div class="panel">
                                                        <div class="panel-heading">
                                                            <h3 class="panel-title">
                                                                <i class="fa fa-fw ti-move"></i>
                                                            </h3>
                                                            <span class="pull-right">
                                                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                                                            </span>
                                                        </div>
                                                        <div class="panel-body">
                                                            <form class="form-horizontal" role="form">
                                                                <br/>
                                                                <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="title">Title</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="title" name="title" class="form-control" placeholder="Text" value="<?php echo $staff->title; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="first-name">First Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="email" id="first-name" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $staff->first_name; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="last-name">Last Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $staff->last_name; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="middle-name">Middle Name</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $staff->middle_name; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="dob">Date Of Birth</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="dob" name="dob" class="form-control" placeholder="Date Of Birth" value="<?php echo $staff->birth; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="gender">Gender</label>
                                                                <div class="col-sm-8">
                                                                    <select id="gender" name="gender" class="form-control" size="1">
                                                                        <option value="<?php echo $staff->gender; ?>"><?php echo $staff->gender; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="marital_status">Marital Status</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="marital_status" name="marital_status" class="form-control" placeholder="Marital Status" value="<?php echo $staff->marital_status; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="email">Email</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="<?php echo $staff->email; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="phone">Phone Num</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Phone Num" value="<?php echo $staff->phone_no; ?>" disabled>
                                                                </div>
                                                            </div>
                                                            <div class="form-group striped-col">
                                                                <label class="col-sm-3 control-label" for="state">State</label>
                                                                <div class="col-sm-8">
                                                                    <select id="state" name="state" class="form-control" disabled size="1">
                                                                        <?php $name = $this->Model_staff->display_state($staff->state); 
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
                                                                <div class="col-sm-8">
                                                                    <select id="lga" name="lga" class="form-control" size="1">
                                                                        <option value="<?php echo $staff->lga; ?>"><?php echo $staff->lga; ?></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="col-sm-3 control-label" for="address">Address</label>
                                                                <div class="col-sm-8">
                                                                    <textarea id="address" name="address" rows="7" class="form-control resize_vertical" placeholder="Address...." disabled><?php echo $staff->address; ?></textarea>
                                                                </div>
                                                            </div>
                                                            </form>
                                                        </div>
                                                     </div>
                                                </div>
                                            </div>
                                            <!-- tab-pane -->
                                            <div class="tab-pane" id="followers">
                                                <div class="row">
                                                    <form class="form-horizontal" role="form">
                                                    <div class="form-group striped-col">
                                                        <label class="col-sm-3 control-label" for="first-name">First Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="email" id="first-name" name="first_name" class="form-control" placeholder="First Name" value="<?php echo $staff->firstname_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label" for="last-name">Last Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="last-name" name="last_name" class="form-control" placeholder="Last Name" value="<?php echo $staff->last_name_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group striped-col">
                                                        <label class="col-sm-3 control-label" for="middle-name">Middle Name</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $staff->middle_name_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group striped-col">
                                                        <label class="col-sm-3 control-label" for="middle-name">Relationship</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="Middle Name" value="<?php echo $staff->relationship_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group striped-col">
                                                        <label class="col-sm-3 control-label" for="middle-name"> Phone Num</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="" value="<?php echo $staff->phone_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="form-group striped-col">
                                                        <label class="col-sm-3 control-label" for="middle-name">  Address</label>
                                                        <div class="col-sm-6">
                                                            <input type="text" id="middle-name" name="middle_name" class="form-control" placeholder="" value="<?php echo $staff->address_kin; ?>" disabled>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab-events">
                                                <div class="events">
                                                    <h5 class="lg-title m-b-15"> Events Details</h5>
                                                    <div class="row m-t-l-10">
                                                        <div class="col-sm-12 col-md-12 bord">
                                                            <?php
                                                                $result = $this->Model_staff->get_doctor_appointment($staff->id);
                                                                if($result == 'no result'){ ?>
                                                                    <div class="alert alert-warning">
                                                                        <p>No appointment yet..</p>
                                                                    </div>
                                                               <?php }else{ ?>

                                                             <?php  
                                                                foreach($result as $r):
                                                             $patients = $this->Model_staff->get_patient_by_id($r->patient_id)->row();
                                                             ?>
                                                                    <div class="media">
                                                                        <a class="pull-left" href="#">
                                                                            <img class="media-object thumbnail" src="<?php echo base_url($patients->picture_path); ?>" alt="image" height="80" width="80"/>
                                                                        </a>
                                                                        <div class="media-body">
                                                                            <i>Patient: <?php echo $patients->first_name ,' ', $patients->last_name; ?></i>
                                                                            <h4 class="event-title">
                                                                                <a href="#"><?php echo $r->type; ?></a>
                                                                            </h4>
                                                                            <small class="text-muted">
                                                                                <i class="icon-calendar icons"></i>
                                                                                <?php 
                                                                                    echo dateCreate::dateFormat($r->appointment_date);
                                                                                 ?>
                                                                                 at
                                                                                 <?php
                                                                                   echo dateCreate::get_time($r->appointment_date);
                                                                                 ?>
                                                                            </small>
                                                                            <p>
                                                                               <?php echo $r->complaint; ?>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>
                                                            <!-- media -->
                                                            <?php   } ?>
                                                            
                                                        </div>
                                                        <!-- col-sm-6 -->
                                                    </div>
                                                    <!-- row -->
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
