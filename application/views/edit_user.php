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
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/app.css" rel="stylesheet"/>
    <!-- end of global css -->
    <!--page level css -->
    <link href="<?php echo base_url(); ?>assets/vendors/iCheck/css/all.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-fileinput/css/fileinput.min.css" media="all" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/css/bootstrapValidator.min.css" type="text/css" rel="stylesheet">
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/formelements.css">
    <!--end of page level css-->
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php
    include 'includes/static-header.php';
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>
                Edit Info
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    Edit Info
                </li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw ti-move"></i> Change Info
                            </h3>
                            <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                        </div>
                        <br/>
                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="margin-left:20%;padding-left:4%;width:40%;"><?php echo $error; ?></div>
                            <?php } ?>

                            <?php
                            if(isset($success)){ ?>
                            <div class="alert alert-success" style="margin-left:20%;padding-left:4%;width:40%;"><?php echo $success; ?></div>
                            <?php } ?>

                        <div class="panel-body">
                            <form id="edit_user" action="<?php echo base_url('welcome/edit_user'); ?>" method="POST" class="form-horizontal" role="form">
                                <input type="hidden" name="user_update_id" value="<?php echo $user_data->id; ?>">
                                <div class="form-group">
                                    <label for="input-text" class="col-sm-2 control-label">Username</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="usernmae" name="username" placeholder="Username" value="<?php echo $user_data->staff_username; ?>">
                                    </div>
                                </div>
                                <?php 
                                    if($permission == 'admin'){ ?>
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">First Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="first_name" name="first_name" placeholder="First Name" value="<?php echo $user_data->first_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">Middle Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="middle_name" name="middle_name" placeholder="Middle Name" value="<?php echo $user_data->middle_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">Last Name</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Last Name" value="<?php echo $user_data->last_name; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="<?php echo $user_data->email; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="input-text" class="col-sm-2 control-label">Mobile Num</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="phone_no" name="phone_no" placeholder="Mobile Num" value="<?php echo $user_data->phone_no; ?>">
                                        </div>
                                    </div>
                               <?php } ?>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">Current Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Current Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword" class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="form-group form-actions">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnSaveChanges">Change</button>
                                        <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                        </button>
                                    </div>
                                </div>
                            </form>
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
<!-- ./wrapper -->
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script><!-- end of global js -->

<!-- page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/settings.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>
</html>
