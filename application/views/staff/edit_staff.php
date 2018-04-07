<?php
$user_data = check_all_access(); // this check all the necessary access to the system and permission
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
    <!--page level css -->	
    
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
                Update Staff
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    Update Staff
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
                                <i class="ti-layout-grid2"></i> Update Staff Table
                            </h3>
                        </div>
                        <div class="col-md-4" style="margin:10px 0;">
                            <a href="<?php echo base_url('staff/view_staff'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list icon-list"></i> View Staff</a>
                        </div>
                        <?php
                            foreach($data_staff as $staff):
                        ?>
                        <div class="panel-body text-center">
                            <form id="" action="<?php echo base_url('staff/update_staff'); ?>" method="post" class="form-horizontal">
                                <hr><b class="text-center">PERSONAL INFORMATION</b><hr>
                                <div class ="row">
                                <div class=col-md-12>
                            <input type="hidden" name="staff_update_id" value="<?php echo $staff->id; ?>" />
                            <div class=col-md-6>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="staff_id">
                                        Staff Id
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="staff_id" name="staff_id" class="form-control" value="<?php echo $staff->staff_id; ?>" placeholder="Enter your username" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="staff_username">
                                        Staff Username
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="staff_username" name="staff_username" class="form-control" value="<?php echo $staff->staff_username; ?>" placeholder="" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="title">
                                        Title 
                                          <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <select id="title" name="title" class="form-control">
                                            <option value="<?php echo $staff->title; ?>"><?php echo $staff->title; ?></option>
                                            <option value=""> Please select a title </option>
                                            <option value="Mr">Mr</option>
                                            <option value="Mrs">Mrs</option>
                                            <option value="Miss">Miss</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val-firstname">
                                        Firstname
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="val-firstname" name="first_name" class="form-control" placeholder="Enter your firstname" value="<?php echo $staff->first_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val-lastname">
                                        Lastname
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="val-lastname" name="last_name" class="form-control" placeholder="Enter your lastname" value="<?php echo $staff->last_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="val-middlename">
                                        Middlename
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="val-middlename" name="middlename" class="form-control" placeholder="Enter your middlename" value="<?php echo $staff->middle_name; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for='datetimepicker1' class="col-md-4 control-label" >
                                            Date of Birth
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="date" class="form-control" id="datetimepicker1" name="datetimepicker1" value="<?php echo $staff->birth; ?>">
                                            <span class="input-group-addon">
                                                <i class="fa fa-fw ti-calendar"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="gender">
                                        Gender
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="gender" name="gender" class="form-control">
                                            <option value="<?php echo $staff->gender; ?>"> <?php echo $staff->gender; ?> </option>
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
                                    <label class="col-md-4 control-label" for="marital-status">
                                        Marital Status
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="marital-status" name="marital_status" class="form-control">
                                            <option value="<?php echo $staff->marital_status; ?>"><?php echo $staff->marital_status; ?></option>
                                            <option value=""> Please select your marital status</option>
                                            <option value="Single">Single</option>
                                            <option value="Married">Married</option>
                                            <option value="Divorced">Divorced</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="email">
                                        Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Enter your valid email" value="<?php echo $staff->email; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="number">
                                        Phone Number
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="number" name="phone_no" class="form-control" placeholder="Enter your phone number" value="<?php echo $staff->phone_no; ?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="state">
                                        State Of Origin
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="state" name="state" class="form-control">

                                            <?php $name = $this->Model_staff->display_state($staff->state); 
                                                if($name == ''){ ?>
                                                        <option value="">  </option>
                                                <?php }else{ ?>
                                                    <option value="<?php echo $name->id;?>"><?php echo $name->state_name;?> </option>
                                            <?php } ?>

                                            <option value=""> Please select your state</option>
                                            <?php
                                                $origins = $this->Model_staff->get_state()->result();
                                                foreach($origins as $origin):
                                            ?>

                                            <option value="<?php echo $origin->id;?>"><?php echo $origin->state_name;?> </option>
                                            <?php endforeach; ?>
                                            <script>
                                                $(document).ready(function(){
                                                    $('#state').on('change', function(){
                                                        var data = $('#state').val();
                                                        $.post('<?php echo base_url();?>staff/load_state', { id: data },
                                                          function(result){
                                                            // console.log(result);
                                                            if(result != ''){
                                                                $('#feedbackLga').html(result).show();
                                                                $('#lga_hide').hide();
                                                            }
                                                        });
                                                    });
                                                });
                                                  
                                            </script>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" id="lga_hide">
                                    <label class="col-md-4 control-label" for="val-lga">
                                        LGA
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                         <select id="val-lga" name="lga" class="form-control">
                                            <option value="<?php echo $staff->lga; ?>"><?php echo $staff->lga; ?></option>
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
                                        <textarea id="address" name="address" rows="4" class="form-control resize_vertical" placeholder="Enter your full Address"><?php echo $staff->address; ?></textarea>
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
                                            <option value="<?php echo $staff->relationship_kin;  ?>"><?php echo $staff->relationship_kin;  ?></option>
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
                                        <input type="text" id="firstname_kin" name="firstname_kin" class="form-control" placeholder="Enter your firstname" value="<?php echo $staff->firstname_kin;  ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="last_name_kin">
                                        Lastname
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="last_name_kin" name="last_name_kin" class="form-control" placeholder="Enter your lastname" value="<?php echo $staff->last_name_kin;  ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="middle_name_kin">
                                        Middlename
                                    </label>
                                    <div class="col-md-6">
                                        <input type="text" id="middle_name_kin" name="middle_name_kin" class="form-control" placeholder="Enter your middlename" value="<?php echo $staff->middle_name_kin;  ?>">
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
                                        <input type="text" id="phone_kin" name="phone_kin" class="form-control" placeholder="Enter your phone number" value="<?php echo $staff->phone_kin;  ?>">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-md-4 control-label" for="address_kin">
                                        Address
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-md-6">
                                        <textarea id="address_kin" name="address_kin" rows="4" class="form-control resize_vertical" placeholder="Enter your full Address"><?php echo $staff->address_kin;  ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <hr><b class="text-center"><hr>
                            <br>
                            <div class="row">
                                <hr><b class="text-center">ROLE</b><hr>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="department_id">
                                        Department
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="department_id" name="department_id" class="form-control" disabled>
                                            <?php
                                                $depart_name = $this->Model_staff->get_depart_name($staff->department_id)->row();
                                             ?>
                                            <option value="<?php echo $depart_name->department_name; ?>"> <?php echo $depart_name->department_name; ?> </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="role">
                                        Role
                                    <span class="text-danger">*</span>
                                    </label>        
                                    <div class="col-md-6">
                                        <select id="role" name="role" class="form-control" disabled>
                                            <option value="<?php echo $staff->role;  ?>"><?php echo $staff->role;  ?></option>
                                            <option value=""> Please select one</option>
                                            <option value="Dr">Dr</option>
                                            <option value="Nurse">Nurse</option>
                                            <option value="Mid Wife">Mid Wife</option>
                                        </select>
                                    </div>
                                </div>
                            <div class="row">
                                <br><br>
                                <div class="form-group form-actions">
                                    <div class="col-md-8 col-md-offset-2">
                                        <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnStaffUpdate">Update</button>
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
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="https://cdn.jsdelivr.net/g/bootstrap@3.3.7,bootstrap.switch@3.3.2,jquery.nicescroll@3.6.0"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script><!-- end of global js -->
<!-- begining of page level js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/editable-table/js/mindmup-editabletable.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/bootstrap-table/js/bootstrap-table.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/tableExport.jquery.plugin/tableExport.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/bootstrap_tables.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>
</html>
