
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
       <!-- Left side column. contains the logo and sidebar -->
        
       <?php $this->load->view('navigation/admin_nav'); ?>

      <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View All Staffs
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="index-2.html">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    View All Staffs
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel filterable">
                        <div class="panel-heading clearfix  ">
                            <div class="panel-title pull-left">
                                <i class="ti-user"></i> <b> ALL STAFF LIST</b>
                            </div>
                            <div class="tools pull-right"></div>
                        </div><br />
                        <a href="<?php echo base_url('staff/add_staff'); ?>" class="btn btn-primary pull-right" style="margin-right:2%;padding:5px 5%;" >Add Staff</a>
                        <br />
                        <?php
                            if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:40%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Staff Id</th>
                                        <th>Picture</th>
                                        <th>Title</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Middle Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>DOB</th>
                                        <th>Gender</th>
                                        <th>Marital Status</th>
                                        <th>Mobile</th>
                                        <th>State</th>
                                        <th>LGA</th>
                                        <th>Address</th>
                                        <th>Kin First Name</th>
                                        <th>Kin Middle Name</th>
                                        <th>Kin Last Name</th>
                                        <th>Relationship </th>
                                        <th>Kin Mobile</th>
                                        <th>Kin Address</th>
                                        <th>Department</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Date Created</th>
                                        <th>Date Modified</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <?php 
                                        if($data_staff == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php }else{ ?>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                            foreach($data_staff as $staff):
                                        ?>
                                        <?php
                                            if($staff->status == 'Inactive' && $permission != 'admin'){ ?>
                                        <tr></tr>
                                           <?php }else{
                                        ?>
                                    <tr>
                                        <td><?php echo $i;$i++; ?></td>
                                        <td><?php echo $staff->staff_id; ?></td>
                                        <td><img src="<?php echo base_url($staff->img_path); ?>" alt="picture" class="img-responsive"></td>
                                        <td><?php echo $staff->title; ?></td>
                                        <td><?php echo $staff->staff_username; ?></td>
                                        <td><?php echo $staff->first_name; ?></td>
                                        <td><?php echo $staff->middle_name; ?></td>
                                        <td><?php echo $staff->last_name; ?></td>
                                        <td><?php echo $staff->email; ?></td>
                                        <td><?php echo get_current_age($staff->birth); ?></td>
                                        <td><?php echo $staff->gender; ?></td>
                                        <td><?php echo $staff->marital_status; ?></td>
                                        <td><?php echo $staff->phone_no; ?></td>

                                        <?php $name = $this->Model_staff->display_state($staff->state); 
                                            if($name == ''){ ?>
                                                <td><?php echo ' '; ?></td>
                                           <?php }else{ ?>
                                             <td><?php echo $name->state_name; ?></td>
                                        <?php } ?>
                                        <td><?php echo $staff->lga; ?></td>
                                        <td><?php echo $staff->address; ?></td>
                                        <td><?php echo $staff->firstname_kin; ?></td>
                                        <td><?php echo $staff->middle_name_kin; ?></td>
                                        <td><?php echo $staff->last_name_kin; ?></td>
                                        <td><?php echo $staff->relationship_kin; ?></td>
                                        <td><?php echo $staff->phone_kin; ?></td>
                                        <td><?php echo $staff->address_kin; ?></td>
                                        <?php
                                            $depart_name = $this->Model_staff->get_depart_name($staff->department_id)->row();
                                        ?>
                                        <td><?php echo $depart_name->department_name; ?></td>
                                        <td><?php echo $staff->role; ?></td>
                                        <td><?php echo $staff->status; ?></td>
                                        <td><?php echo $staff->date_created; ?></td>
                                        <td><?php echo $staff->date_modified; ?></td>
                                        <td>
                                            <p>
                                                <a href="<?php echo base_url('staff/edit_staff/'. $staff->id); ?>" class="btn btn-primary">
                                                    <span class="fa fa-fw ti-pencil"></span> Edit
                                                </a>
                                            </p>
                                            <p>
                                                <a href="<?php echo base_url('staff/detail_staff/' . $staff->id); ?>" class="btn btn-primary">
                                                    <span class="fa fa-fw ti-eye"></span> View Staff
                                                </a>
                                            </p>
                                            <?php 
                                            if($permission == 'admin'){
                                                if($staff->status == 'Active'){ ?>
                                                <button class="btn btn-icon btn-warning btn-xs" data-toggle="modal" data-target="#status_<?php echo $staff->id; ?>" data-placement="top" title="Disable Staff"><i class="icon fa fa-fw ti-na" aria-hidden="true"></i> Disable Staff</button>
                                          <?php  }else{ ?>
                                                  <button class="btn btn-icon btn-success btn-xs" data-toggle="modal" data-target="#status2_<?php echo $staff->id; ?>" data-placement="top" title="Enable Staff"><i class="icon fa fa-fw ti-check-box" aria-hidden="true"></i> Enable Staff</button>
                                              <?php  } }
                                            ?>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    <div class="modal fade" id="status_<?php echo $staff->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title custom_align" id="Heading5">Update Staff Status </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure you want to
                                                        change the staff status of this record ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="updateStaff(<?php echo $staff->id; ?>);">
                                                        <span class="glyphicon glyphicon-ok-sign"></span> Yes
                                                    </button>
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">
                                                        <span class="glyphicon glyphicon-remove"></span> No
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <div class="modal fade" id="status2_<?php echo $staff->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title custom_align" id="Heading5">Update Staff Status </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure you want to
                                                        change the Staff status of this record ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="updateStaff2(<?php echo $staff->id; ?>);">
                                                        <span class="glyphicon glyphicon-ok-sign"></span> Yes
                                                    </button>
                                                    <button type="button" class="btn btn-success" data-dismiss="modal">
                                                        <span class="glyphicon glyphicon-remove"></span> No
                                                    </button>
                                                </div>
                                                </form>
                                            </div>
                                            <!-- /.modal-content -->
                                        </div>
                                        <!-- /.modal-dialog -->
                                    </div>
                                    <?php endforeach; }  ?>
                                    </tbody>
                                    <script type="text/javascript">
                                        function updateStaff(id){

                                            $.post('<?php echo base_url();?>staff/update_status/' + id, { update_status: 'updating', task : 'Inactive' },
                                              function(result){
                                                // console.log(result);
                                                alert(result);
                                                window.location.reload();
                                            });
                                        }
                                        function updateStaff2(id){

                                            $.post('<?php echo base_url();?>staff/update_status/' + id, { update_status: 'updating', task : 'Active' },
                                              function(result){
                                                // console.log(result);
                                                alert(result);
                                                window.location.reload();
                                            });
                                        }
                                    </script>
                                
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            <div class="background-overlay"></div>
        </section>
    </aside>
</div>
<!-- wrapper-->
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script><!-- end of global js -->
<?php include (APPPATH . 'views/templates/footer_view.php'); ?>
</body>
</html>
