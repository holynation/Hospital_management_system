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
    <!-- end of global css -->
    <!--page level css -->
    <link href="<?php echo base_url(); ?>assets/vendors%2c_iCheck%2c_css%2c_all.css%2bcss%2c_passtrength%2c_passtrength.css%2bcss%2c_custom.css%2bvendors%2c_sweetalert2%2c_css%2c_sweetalert2.min.css%2bvendors%2c_bootstrapvalidator%2c_css%2c_bootstra" rel="stylesheet"/>

    <link href="<?php echo base_url(); ?>assets/vendors/jasny-bootstrap/css/jasny-bootstrap.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/select2/css/select2.min.css" type="text/css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendors/select2/css/select2-bootstrap.css" type="text/css" rel="stylesheet">

    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom_css/A.form2.css%2bform3.css%2cMcc.waUisHSW80.css.pagespeed.cf.U8Tkz4m-7S.css"/>
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
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
                Add Staff
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard') ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                  <li class="active">
                    Add Staff
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
                                <i class="fa fa-fw ti-star"></i> Add New Staff
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                            </span>
                        </div>
                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                            <?php } ?>

                        <?php //  this is for the validation page
                            if(validation_errors()){ ?>
                                <?php echo validation_errors('<div class="alert alert-danger" style="padding-left:40%;">','</div>'); ?>
                         <?php } ?>
                        <div class="panel-body text-center">
                            <form id="form-validation" action="<?php echo base_url('staff/add_staff'); ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                                <hr><b class="text-center">PERSONAL INFORMATION</b><hr>
                                <div class ="row">
                                <div class=col-md-12>

                            <div class=col-md-6>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="title">
                                        Title 
                                          <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select id="title" name="title" class="form-control">
                                            <option value="<?php echo set_value('title'); ?>"><?php echo set_value('title'); ?></option>
                                            <option value=""> Please select a title </option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="username">
                                        Username
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="username" name="username" class="form-control" value="<?php echo set_value('username'); ?>" placeholder="Enter your username">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val-firstname">
                                        Firstname
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="val-firstname" name="first_name" class="form-control" placeholder="Enter your firstname" value="<?php echo set_value('first_name'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val-lastname">
                                        Lastname
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="val-lastname" name="last_name" class="form-control" placeholder="Enter your lastname" value="<?php echo set_value('last_name'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val-middlename">
                                        Middlename
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="val-middlename" name="middle_name" class="form-control" placeholder="Enter your middlename" value="<?php echo set_value('middle_name'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your valid email" value="<?php echo set_value('email'); ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="gender">
                                        Gender
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="gender" name="gender" class="form-control">
                                            <option value="<?php echo set_value('gender') ?>"> <?php echo set_value('gender'); ?> </option>
                                            <option value=""> Please select a gender</option>
                                            <option value="Male">Male</option>
                                            <option value="Female">Female</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class ="row">
                                <div class=col-md-6>
                                    <!-- we wanna come back to this aspect -->
                                <div class="form-group">
                                    <label for='datetimepicker1' class="col-md-4 control-label" >
                                            Date of Birth
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="datetimepicker1" name="datetimepicker1">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="marital-status">
                                        Marital Status
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="marital-status" name="marital_status" class="form-control">
                                            <option value="<?php echo set_value('marital_status'); ?>"><?php echo set_value('marital_status'); ?></option>
                                            <option value=""> Please select your marital status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="number" name="phone_no" class="form-control" placeholder="Enter your phone number" value="<?php echo set_value('phone_no'); ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="state">
                                        State
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="state" name="state" class="form-control">
                                            <option value=""> Please select your state</option>
                                            <?php
                                                $origins = $this->Model_staff->get_state()->result();
                                                foreach($origins as $origin):
                                            ?>
                                            <option value="<?php echo $origin->id;?>"><?php echo $origin->state_name;?></option>
                                            <?php endforeach; ?>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#state').on('change', function(){
                                                        var data = $('#state').val();
                                                        $.post('<?php echo base_url();?>staff/load_state', { id: data },
                                                          function(result){
                                                            // console.log(result);
                                                            $('#feedbackLga').html(result).show();
                                                        });
                                                    });
                                                });
                                                  
                                            </script>
                                        </select>
                                    </div>
                                </div>

                                <!-- This is where ajax is populate the LGA -->
                                <div id="feedbackLga"></div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="address">
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea id="address" name="address" rows="4" class="form-control resize_vertical" placeholder="Enter your full Address"><?php echo set_value('address'); ?></textarea>
                                    </div>
                                </div>
                            </div>

                            </div>

                            <hr>
                            <b class="text-center">Upload Picture</b><hr>
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="fileinput-new thumbnail" style="width: 200px; height: 200px;">
                                            <img src="" alt="Logo" class="profile_pic">
                                        </div>
                                        <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 200px;"></div>
                                        <div>
                                                <span class="btn btn-default btn-file">
                                                <span class="fileinput-new">Select image</span>
                                                <span class="fileinput-exists">Change</span>
                                                <input id="pic" name="pic_file" type="file" class="form-control"/>
                                                </span>
                                            <a href="#" class="btn btn-danger fileinput-exists" data-dismiss="fileinput">Remove</a>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                <hr><b class="text-center">NEXT OF KIN INFORMATION</b><hr>

                                <div class ="row">
                                <div class=col-md-12>
                                <div class=col-md-6>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="relationship">
                                        Relationship
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="relationship" name="relationship_kin" class="form-control">
                                            <option value="<?php echo set_value('relationship_kin');  ?>"><?php echo set_value('relationship_kin');  ?></option>
                                            <option value="">Please select one </option>
                                            <option value="Father">Father</option>
                                            <option value="Mother">Mother</option>
                                            <option value="Spouse">Spouse</option>
                                            <option value="Siblings">Siblings</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="firstname_kin">
                                        Firstname 
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="firstname_kin" name="firstname_kin" class="form-control" placeholder="Enter your firstname" value="<?php echo set_value('firstname_kin');  ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="last_name_kin">
                                        Lastname
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="last_name_kin" name="last_name_kin" class="form-control" placeholder="Enter your lastname" value="<?php echo set_value('last_name_kin');  ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="middle_name_kin">
                                        Middlename
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="middle_name_kin" name="middle_name_kin" class="form-control" placeholder="Enter your middlename" value="<?php echo set_value('middle_name_kin');  ?>">
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="col-md-4 control-label" for="phone_kin">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="phone_kin" name="phone_kin" class="form-control" placeholder="Enter your phone number" value="<?php echo set_value('phone_kin');  ?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-4 control-label" for="address_kin">
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea id="address_kin" name="address_kin" rows="4" class="form-control resize_vertical" placeholder="Enter your full Address"><?php echo set_value('address_kin');  ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                            <div class="row">
                              <hr>
                                 <b class="text-center">ROLE & PASSWORD CREATION</b>
                              <hr>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="department_id">
                                        Department
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="department_id" name="department_id" class="form-control">
                                            <option value=""> Please select department </option>
                                            <?php foreach($departments as $department): ?>
                                            <option value="<?php echo $department->id; ?>"><?php echo $department->department_name; ?></option>
                                        <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="password">
                                        Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="confirmpassword">
                                        Confirm Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="password" id="confirmpassword" name="confirmpassword" class="form-control" placeholder="Confirm password">
                                    </div>
                                </div>
                                <div class="form-group form-actions">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnSubmitStaff">Submit</button>
                                        <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                        </button>
                                    </div>
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
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->

<!-- begining of page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/vendors/jasny-bootstrap/js/jasny-bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/select2/js/select2.js" type="text/javascript"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/bootstrapvalidator/js/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_js/form_validations.js"></script>
<!-- end of page level js -->

</body>
</html>
