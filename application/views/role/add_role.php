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
                                        <!-- <th>Email</th> -->
                                        <th>Department</th>
                                        <th>Assign Role</th>
                                        <th>Permission</th>
                                        <th>Type</th>
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
                                        <!-- <td><?php// echo $staff->email; ?></td> -->
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
                                                            <option value="<?php echo $staff->role; ?>"><?php  $role_name = $this->Model_staff->get_role_id($staff->role);
                                                             echo ($role_name != 'no result') ? $role_name->role_name : ' ';
                                                             ?></option>
                                                        <?php endif; ?>
                                                            <option value="">Select role...</option>
                                                            <?php foreach($data_roles as $role): ?>
                                                            <option value="<?php echo $role->id; ?>"><?php echo $role->role_name; ?></option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <!-- /.form group -->
                                                </div>
                                            </p>
                                        </td>
                                        <td>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <select class="form-control" name="assign_permission" id="assign_permission_<?php echo $staff->id; ?>">
                                                        <option value="">Assign permission...</option>
                                                        <?php 
                                                        $p_value = get_enum_value();
                                                        for($i=0; $i < count($p_value); $i++): ?>
                                                        <option value="<?php echo $p_value[$i]; ?>">
                                                            <?php 
                                                                if($p_value[$i] == 'r'){
                                                                    echo 'View';
                                                                } else if($p_value[$i] == 'w'){
                                                                    echo 'Modify';
                                                                }
                                                            ?>
                                                        </option>
                                                        <?php endfor; ?>
                                                    </select>
                                                </div>
                                                <!-- /.form group -->
                                            </div>
                                        </td>
                                        <td>
                                            <?php
                                                $check = $this->db->get_where('permission', array('staff_id' => $staff->id))->row();
                                                if(!$check){
                                                    echo 'Null';
                                                }else if($check->permissions == 'r'){
                                                    echo 'Read';
                                                }else if($check->permissions == 'w'){
                                                    echo 'Modify';
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <p>
                                                <?php
                                                $check = $this->db->get_where('permission', array('staff_id' => $staff->id))->row();
                                                    if(!$check){ ?>
                                                    <span class="label label-sm label-danger" id="unassign_<?php echo $staff->id; ?>">Unassigned</span>
                                               <?php }else{ ?>
                                               <span class="label label-sm label-success" id="assign_<?php echo $staff->id; ?>">Assigned</span>
                                                <?php  } ?>
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
                                                                alert(result);
                                                                window.location.reload();
                                                            }else{
                                                                alert(result);
                                                                // $('#assign_<?php //echo $staff->id; ?>').hide();
                                                            }
                                                    });
                                            });

                                            $('#assign_permission_<?php echo $staff->id; ?>').on('change', function(){
                                                var role_id = $('#assign_role_<?php echo $staff->id; ?>').val(), permission = $('#assign_permission_<?php echo $staff->id; ?>').val(),
                                                    staff_id = '<?php echo $staff->id; ?>';
                                            // alert(role);
                                                    $.post('<?php echo base_url();?>staff/assign_permission', { staff_id: staff_id,role_id: role_id,permission: permission },
                                                          function(result){
                                                            // console.log(result);
                                                            if(result == 'permitted'){
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
