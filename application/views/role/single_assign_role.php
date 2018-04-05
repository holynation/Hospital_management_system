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
    
    
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom_css/realtime_form.css">
    <!-- end of global css -->
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
            <h1>Assign Role</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li> Role</li>
                <li class="active">
                    <a href="">Assign Role</a>
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <?php
            foreach($data_staff as $staff):
        ?>
        <section class="content">
            <div class="row">
                <div class="col-md-8">
                    <div style="margin:5px 5px 10px;">
                        <a href="<?php echo base_url('staff/view_staff'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-list icon-list"></i> View Staff</a>
                    </div>
                    <div class="panel col-sm-offset-3">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw ti-home"></i> Assign Staff Role
                            </h3>
                            <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                        </div>
                        <br />
                        <?php 
                            if($data_roles == 'no result'){ ?>
                            <div class="alert alert-danger"> Please go to the role module and create a role for the staffs... </div>
                        <?php  }else if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:60%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>
                        <div class="panel-body">
                            <form>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Username</label>
                                            <input type="text" class="form-control" placeholder="Username" value="<?php echo $staff->staff_username; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Name</label>
                                            <input type="text" class="form-control" placeholder="" value="<?php echo $staff->first_name, ' ', $staff->last_name ; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="control-label">Email</label>
                                            <input type="text" class="form-control" placeholder="" value="<?php echo $staff->email; ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                            <label for="adult-number">Assign Role</label>
                                            <select class="form-control" name="assign_role" id="assign_role_<?php echo $staff->id; ?>">
                                                <?php 
                                                    $check = $staff->role;
                                                    if($check != ''):
                                                ?>
                                                    <option value="<?php echo $staff->role; ?>"><?php echo $staff->role; ?></option>
                                                <?php endif; ?>
                                                <option value="">Assign role...</option>
                                                <?php foreach($data_roles as $role): ?>
                                                <option value="<?php echo $role->role_name; ?>"><?php echo $role->role_name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <?php
                                        $check = $staff->role;
                                            if($check == ''){ ?>
                                            <span class="label label-sm label-danger" id="unassign_<?php echo $staff->id; ?>">Unassigned</span>
                                       <?php }else{ ?>
                                       <span class="label label-sm label-success" id="assign_<?php echo $staff->id; ?>">Assigned</span>
                                        <?php  } ?>
                                    </div>
                                </div>
                                    
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#assign_role_<?php echo $staff->id; ?>').on('change', function(){
                                        var role = $('#assign_role_<?php echo $staff->id; ?>').val();
                                        var id = '<?php echo $staff->id; ?>';
                                        // alert(role);
                                            $.post('<?php echo base_url();?>staff/assign_role', { id: id, role: role },
                                                  function(result){
                                                    // console.log(result);
                                                    if(result == 'updated'){
                                                        $('#unassign_<?php echo $staff->id; ?>').hide();
                                                        $('#assign_<?php echo $staff->id; ?>').show();
                                                        alert(result);
                                                        window.location.reload();
                                                    }else{
                                                        alert(result);
                                                        window.location.reload();
                                                    }
                                            });
                                        });
                                    });
                                </script>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
    <?php endforeach; ?>
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
<script src="<?php echo base_url(); ?>assets/vendors/iCheck/js/icheck.js" type="text/javascript"></script></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/js/custom_js/realtime_form.js" type="text/javascript"></script>
<!-- end of page level js -->
<script>function isNumber(evt,element){var charCode=(evt.which)?evt.which:event.keyCode;if((charCode!=46||$(element).val().indexOf('.')!=-1)&&(charCode<48||charCode>57))return false;return true;}</script>
</body>

</html>
