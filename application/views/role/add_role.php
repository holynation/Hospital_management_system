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
    <link href="<?php echo base_url(); ?>assets/css/datatable.css" rel="stylesheet">
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php  
    include 'includes/static-header.php';
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>Role</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    <a href="#">Role</a>
                </li>
                <li class="active">
                    Add Role
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Second Data Table Starts Here-->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="ti-list"></i> Add role
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table id="mytable" class="table table-bordred table-striped">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Staff Id</th>
                                        <th>Staff Username</th>
                                        <th>Name</th>
                                        <th>email</th>
                                        <th>Department</th>
                                        <th>Assign Role</th>
                                        <th>Status</th>
                                    </tr>
                                    </thead>
                                    <?php 
                                        if($data_staff == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php  }else if($data_roles == 'no result'){ ?>
                                        <div class="alert alert-danger"> Please go to the role module and create a role for the staffs... </div>
                                    <?php  }else{ ?>

                                    <?php
                                        $i = 1;
                                        foreach($data_staff as $staff):
                                    ?>
                                    <tbody>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $staff->staff_id; ?></td>
                                        <td><?php echo $staff->staff_username; ?></td>
                                        <td><?php echo $staff->first_name, ' ', $staff->last_name ; ?></td>
                                        <td><?php echo $staff->email; ?></td>
                                        <?php
                                            $depart_name = $this->Model_staff->get_depart_name($staff->department_id)->row();
                                            if($depart_name){ ?>
                                                <td><?php echo $depart_name->department_name; ?></td>
                                          <?php  }else{
                                                echo "<th></th>";
                                            }
                                        ?>
                                        
                                        <td>
                                            <p>
                                                <div class="col-md-12">
                                                    <div class="form-group">
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
                                                    <!-- /.form group -->
                                                </div>
                                            </p>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                $check = $staff->role;
                                                    if($check == ''){ ?>
                                                    <span class="label label-sm label-danger" id="unassign_<?php echo $staff->id; ?>">Unassigned</span>
                                               <?php }else{ ?>
                                               <span class="label label-sm label-success" id="assign_<?php echo $staff->id; ?>">Assigned</span>
                                          <?php  }
                                                ?>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
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
                                                                // $('#assign_<?php //echo $staff->id; ?>').hide();
                                                            }
                                                    });
                                            });
                                        });
                                    </script>
                                    <?php endforeach; } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- second row ends here -->

            <div class="background-overlay"></div>
        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- global js -->

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->

<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_js/simple-table.js"></script>
<!-- end of page level js -->
</body>

</html>
