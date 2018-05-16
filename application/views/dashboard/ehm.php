<?php
$user_data = is_logged();
$get_settings = getsettingsdetails();
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->

    <?php 
    include (APPPATH.'views/navigation/admin_nav.php');
    // $this->load->view('navigation/admin_nav');
     ?>

    <aside class="right-side">
           <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-8">
                    <div class="header-element">
                        <h3>EHM /
                            <small><?php echo get_user_role($user_data); ?> Dashboard</small>
                        </h3>
                    </div>
                </div>
            </div>
        </section>

        <section class="content">
            <div class="row">
                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon pull-left">
                                <i class="ti-user text-info" style="margin-top: 10px"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b><?php  $count_patient = $this->db->count_all('patient');
                                if($count_patient == ''){ ?>
                                    <p>No patient yet...</p>
                              <?php  }else{ ?>
                                    <?php echo $count_patient; ?>
                            <?php  } ?></b></h3>
                                <p>Patients</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                 <h5 class="text-dark">Today Stat</h5>
                                <h5 class="text-dark"><b>
                                    <?php
                                        $result = $this->Model_staff->get_today_db('patient');
                                        if($result == 'no result'){
                                            echo 'No Patient yet...';
                                        }else{
                                            echo $result;
                                        }
                                    ?></b></h5>
                                <hr>
                                <a href="<?php echo base_url('patient/view_patient'); ?>">View All</a>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon pull-left">
                                <i class="ti-pencil-alt text-warning"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b><?php  $count_appointment = $this->db->count_all('appointment');
                                if($count_appointment == ''){ ?>
                                    <p>No appointment yet...</p>
                              <?php  }else{ ?>
                                    <?php echo $count_appointment; ?>
                            <?php  } ?></b></h3>
                                <p>Appointments</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <h5 class="text-dark">Today Appointment</h5>
                                <h5 class="text-dark"><b>
                                    <?php
                                        $result = $this->Model_staff->get_today_db('appointment');
                                        if($result == 'no result'){
                                            echo 'No Appointment today yet...';
                                        }else{
                                            echo $result;
                                        }
                                    ?>
                                </b></h5>
                                <hr>
                                <a href="<?php echo base_url('appointment/view_appoint'); ?>">View Appointment</a>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon pull-left">
                               <i class="ti-id-badge"></i>
                            </div>
                            <div class="text-right">
                                <h3><b id="widget_count3">
                                    <?php
                                        $this->db->select('*');
                                        $this->db->from('role');
                                        $this->db->join('staff', 'staff.role = role.id');
                                        $this->db->where('role_name', 'Doctor');
                                        $result = $this->db->get();
                                        $count_doctor = $result->num_rows();
                                        if($result->num_rows() > 0){
                                            echo $count_doctor;
                                        }else{
                                            echo 'No Doctor yet...';
                                        }
                                    ?>
                                </b></h3>
                                <p>Doctor</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <h5 class="text-dark">New Doctor</h5>
                                <h5 class="text-dark"><b>
                                    <?php
                                        $result = $this->Model_staff->get_today_doctor('staff');
                                        if($result == 'no result'){
                                            echo 'No new Doctor today...';
                                        }else{
                                            echo $result;
                                        }
                                    ?>
                                </b></h5>
                                <hr>
                                <a href="<?php echo base_url('staff/view_staff'); ?>">View All</a>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon pull-left">
                               <i class="ti-list"></i>
                            </div>
                            <div class="text-right">
                                <h3><b id="widget_count3">
                                    <?php
                                        $this->db->select('*');
                                        $this->db->from('department');
                                        $result = $this->db->get();
                                        $count_department = $result->num_rows();
                                        if($result->num_rows() > 0){
                                            echo $count_department;
                                        }else{
                                            echo 'No Department yet...';
                                        }
                                    ?>
                                </b></h3>
                                <p>Department</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <h5 class="text-dark">Department</h5>
                                <h5 class="text-dark"><b>
                                    <?php
                                        $this->db->select('*');
                                        $this->db->from('department');
                                        $result = $this->db->get();
                                        $count_department = $result->num_rows();
                                        if($result->num_rows() > 0){
                                            echo $count_department;
                                        }else{
                                            echo 'No Department yet...';
                                        }
                                    ?>
                                </b></h5>
                                <hr>
                                <a href="<?php echo base_url('department/view_department'); ?>">View All</a>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                    </div>
                </div>

                <!-- <div class="col-sm-6 col-md-6 col-lg-3">
                    <div class="flip">
                        <div class="widget-bg-color-icon card-box front">
                            <div class="bg-icon pull-left">
                                <i class="ti-support text-danger"></i>
                            </div>
                            <div class="text-right">
                                <h3 class="text-dark"><b>152</b></h3>
                                <p>Pharmacy</p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                       <a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <h5 class="text-dark">Drug Sold today</h5>
                                <h5 class="text-dark"><b>37</b></h5>
                                <hr>
                                <p>Goto Pharmacy</p>
                            </div>
                            <div class="clearfix"></div>
                        </div></a>
                    </div>
                </div> -->
            </div>

            <div class="row">
                <div class="col-lg-8 col-xs-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Appointment(s)</h3>
                            <button type="button" class="btn btn-labeled btn-success">
                                    <span class="btn-label">
                                    <i class="ti-check"></i>
                                </span> Checked
                            </button>
                            <button type="button" class="btn btn-labeled btn-danger">
                                    <span class="btn-label">
                                    <i class="ti-close"></i>
                                </span> Unchecked
                            </button>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Patient Name</th>
                                            <th>Department</th>                                        
                                            <th>Appointment Date</th>
                                            <th>Appointment Type</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        if($data_appointment == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php  }else{ ?>

                                    <?php
                                    $i = 1;
                                        foreach($data_appointment as $appoint):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i; $i++; ?></td>
                                            <td>
                                            <?php 
                                                $patient_name = $this->Model_appointment->get_patient_by_id($appoint->patient_id);
                                                echo $patient_name->first_name, ' ', $patient_name->last_name;
                                            ?> 
                                            </td>
                                            <td>
                                                <?php $depart_name = $this->Model_staff->get_depart_name($appoint->department)->row(); ?>
                                                <?php echo $depart_name->department_name; ?>
                                            </td>

                                            <td><?php echo $appoint->appointment_date; ?></td>
                                            <td><?php echo $appoint->type; ?></td>
                                            <td>
                                                <?php if($appoint->status == 'true'){ ?>
                                                        <button class="btn btn-success" title="checked"><i class="ti-check"></i></button> 
                                                <?php }else{  ?>
                                                    <button class="btn btn-danger" title="Unchecked"><i class="ti-close"></i></button>
                                             <?php  }  ?>
                                                
                                            </td>
                                            <td>
                                                <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#viewappoint_<?php echo $appoint->id; ?>" data-placement="top" title="View Appointment" onclick="updateAppointmentStatus(<?php echo $appoint->id; ?>);"><span class="fa fa-fw ti-eye"></span></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <div class="modal fade" id="viewappoint_<?php echo $appoint->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title custom_align" id="Heading5">View Appointment </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Patient Name</label>
                                                                    <input type="text" class="form-control" placeholder="Username" value="<?php $patient_name = $this->Model_appointment->get_patient_by_id($appoint->patient_id);
                                                                    echo $patient_name->first_name, ' ', $patient_name->last_name; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Department</label>
                                                                    <input type="text" class="form-control" placeholder="" value="<?php $depart_name = $this->Model_staff->get_depart_name($appoint->department)->row();
                                                                    echo $depart_name->department_name; ?> ">
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-12">
                                                                <div class="form-group">
                                                                    <label class="control-label">Appointment Date</label>
                                                                    <input type="text" class="form-control" placeholder="" value="<?php echo  $appoint->appointment_date; ?>">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal">
                                                        <span class="glyphicon glyphicon-ok-sign"></span> Done
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
                                    <?php endforeach; } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-xs-12">
                    <div class="row">
                        <div class="col-lg-12 col-sm-6">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Noticeboard</h3>
                                </div>
                                <div class="panel-body">
                                    <div>
                                        <ul class="timeline timeline-update">
                                    <!-- this is for notice board section -->
                                    <?php 
                                        $table = '';
                                        $table_id = '';
                                        foreach($notification as $notify):
                                            $json_data = $notify->foreign_table_id;
                                            $json_data = json_decode($json_data);
                                            // print_r($json_data);
                                            $table = $json_data->table;
                                            $table_id = $json_data->id;

                                            if($table == 'notice_board'){
                                                $notices = $this->Model_staff->get_general_by_id($table,$table_id);
                                                if($notices == 'no result'){
                                                    die('No results found from notice Board...');
                                                }

                                                foreach($notices as $notice): ?>
                                                <li id="noticeList<?php echo $notify->id; ?>">
                                                    <div class="timeline-badge center">
                                                        <i class="fa fa-fw ti-bell fa-2x" style="color:skyblue;"></i>
                                                    </div>
                                                    <div class="timeline-panel" style="display:inline-block;">
                                                        <div class="timeline-heading">
                                                            <h4 class="timeline-title"><?php echo $notice->title; ?> </h4>
                                                            <p>
                                                                <small class="text-default-gray"><?php
                                                                    // $this->load->library('dateCreate');
                                                                    echo dateCreate::timeAgo($notify->date_created);
                                                                 ?></small>
                                                            </p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p>
                                                                <?php echo wordwrap($notice->description, 50, "<br />\n"); ?>
                                                                <br />
                                                                <?php if($notice->start_date){
                                                                    echo "<b>Start:</b> " . dateCreate::dateFormat($notice->start_date);
                                                                }
                                                                 echo "<br />";
                                                                if($notice->end_date){
                                                                    echo "<b>End:</b> " . dateCreate::dateFormat($notice->end_date); 
                                                                }

                                                                ?>
                                                            </p>    
                                                        </div>
                                                    </div>
                                                </li>
                                                <script type="text/javascript">
                                                    $('.timeline-update #noticeList<?php echo $notify->id; ?> .timeline-panel').on('mouseleave', function(){
                                                        var id = '<?php echo $notify->id; ?>';

                                                        $.post('<?php echo base_url();?>welcome/update_notify_status/' + id, 
                                                            {
                                                                task: 'Update Status',
                                                                notification_id: id
                                                            },
                                                            function(result){
                                                                // console.log('status change...');
                                                        });
                                                    });
                                                </script>
                                         <?php  endforeach; } ?>
                                    
                                    <?php endforeach; ?>
                                </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-sm-6">
                           <a href="<?php echo base_url('casenote/view_casenote'); ?>">
                              <button class="button button-rounded button-primary-flat hvr-hang pull-right">
                       <i class="fa fa-fw ti-list"></i>  View All Case note(s)
                        </button></a>
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Casenote(s)</h3>
                          
                        </div>
                        <div class="panel-body">
                           <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Patient Name</th>
                                            <th>Complaint</th>
                                            <th>Prescription</th>
                                            <th>Diagnosis</th>
                                            <th>Managed by</th>
                                            <th>Date Created</th>
                                            <th>Modified by</th>
                                        </tr>
                                    </thead>
                             <?php 
                                if($data_cn == 'no result'){ ?>
                                <div class="alert alert-danger"> No record found... </div>
                            <?php  }else{ ?>

                                    <?php
                                    $i = 1;
                                        foreach($data_cn as $cn):
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i; $i++; ?></td>
                                            <td>
                                            <?php 
                                                $patient_name = $this->Model_casenote->get_patient_by_id($cn->patient_id);
                                                echo $patient_name->first_name;
                                            ?>
                                            </td>

                                            <td><?php echo $cn->health_status ; ?></td>
                                            <td><?php echo $cn->prescription ; ?></td>
                                            <td><?php echo $cn->diagnosis ; ?></td>
                                            <td> <?php 
                                                $patient_name = $this->Model_casenote->get_doctor_by_id($cn->created_by);
                                                echo "Dr. ".$patient_name->first_name;
                                            ?></td>
                                            <td><?php echo $cn->date_created ; ?></td>
                                            <td><?php if($cn->updated_by == ""){echo "not yet modified";}else{echo $cn->updated_by ;} ?></td>
                                        </tr>
                                     </tbody>
                                    <?php endforeach; } ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php include ('includes/notification_sidebar.php'); ?>

            <div class="background-overlay"></div>
        </section>
        <!-- /.content --> </aside>
    <!-- /.right-side --> </div>
<!-- ./wrapper -->