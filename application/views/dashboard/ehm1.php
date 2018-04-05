<?php
$user_data = is_logged();
$get_settings = getsettingsdetails();
?>
<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>

    <aside class="right-side">
           <section class="content-header">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-5 col-xs-8">
                    <div class="header-element">
                        <h3>EHM/
                            <small>Doctor Dashboard</small>
                        </h3>
                    </div>
                </div>
                <div class="col-lg-4 col-lg-offset-2 col-md-6 col-sm-7 col-xs-4">
                    
                </div>
            </div>
        </section>
        <section class="content">
                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Statstitics</h3>
                            </div>
                            <div class="panel-body">
                                    
                                <div class="col-lg-3">
                                    <div class="flip">
                                        <div class="widget-bg-color-icon card-box front">
                                            <div class="bg-icon pull-left">
                                                <i class="ti-pencil-alt text-warning" style="margin-top: 10px"></i>
                                            </div>
                                            <div class="text-right">
                                                <h3 class="text-dark"><b>
                                                    <?php 
                                                        $result = $this->Model_appointment->count_doctor_appoint($user_data->id);
                                                        if($result == 'no result'){
                                                            echo 'No Appointment yet...';
                                                        }else{
                                                            echo $result;
                                                        }
                                                     ?>
                                                </b></h3>
                                                <p>Appointments</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><a href="">
                                        <div class="widget-bg-color-icon card-box back">
                                            <div class="text-center">
                                                <h5 class="text-dark">Today Appointment</h5>
                                                <h5 class="text-dark"><b>
                                                    <?php
                                                        $result = $this->Model_appointment->count_get_today_db($user_data->id,'appointment');
                                                        if($result == 'no result'){
                                                            echo 'No Appointment today yet...';
                                                        }else{
                                                            echo $result;
                                                        }
                                                    ?>
                                                </b></h5>
                                                <hr>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div></a>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                        <div class="flip">
                                            <div class="widget-bg-color-icon card-box front">
                                                <div class="bg-icon pull-left">
                                                    <i class="ti-user text-info" style="margin-top: 10px"></i>
                                                </div>
                                                <div class="text-right">
                                                    <h3 class="text-dark"><b>
                                                        <?php  $count_patient = $this->db->count_all('patient');
                                                        if($count_patient == ''){ ?>
                                                            <p>No patient yet...</p>
                                                      <?php  }else{ ?>
                                                            <?php echo $count_patient; ?>
                                                    <?php  } ?>
                                                    </b></h3>
                                                    <p>Patient</p>
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
                                                        ?>
                                                    </b></h5>
                                                    <hr>
                                                    <a href="<?php echo base_url('patient/view_patient'); ?>">View All</a>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div></a>
                                        </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="flip">
                                        <div class="widget-bg-color-icon card-box front">
                                            <div class="bg-icon pull-left">
                                                <i class="ti-agenda text-warning" style="margin-top: 10px"></i>
                                            </div>
                                            <div class="text-right">
                                                <h3 class="text-dark"><b>
                                                    <?php
                                                       $result = $this->Model_casenote->count_doctor_casenote($user_data->id);
                                                       if($result == 'no result'){
                                                            echo '<p>Null</p>';
                                                        }else{
                                                            echo $result;
                                                        }
                                                    ?></b></h3>
                                                <p>Case Note</p>
                                            </div>
                                            <div class="clearfix"></div>
                                        </div><a href="">
                                        <div class="widget-bg-color-icon card-box back">
                                            <div class="text-center">
                                                <h5 class="text-dark">New Case Note</h5>
                                                <h5 class="text-dark"><b>
                                                    <?php

                                                        $result = $this->Model_casenote->count_get_today_db($user_data->id);
                                                        if($result == 'no result'){
                                                            echo 'No new casenote today yet...';
                                                        }else{
                                                            echo $result;
                                                        }
                                                    ?>
                                                </b></h5>
                                                <hr>
                                                <!-- <p>View Case Note</p> -->
                                            </div>
                                            <div class="clearfix"></div>
                                        </div></a>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                        <div class="flip">
                                            <div class="widget-bg-color-icon card-box front">
                                                <div class="bg-icon pull-left">
                                                    <i class="ti-user text-danger" style="margin-top: 10px"></i>
                                                </div>
                                                <div class="text-right">
                                                    <h3 class="text-dark"><b>
                                                        <?php
                                                        $this->db->select();
                                                        $this->db->from('staff');
                                                        $this->db->where('role', 'Doctor');
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
                                                     <h5 class="text-dark">Today Stat</h5>
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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">New Appointment(s)</h3>
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
                                        <?php exit; }?>

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
                                            <td><?php echo $appoint->status; ?></td>
                                            <td>
                                                
                                                <?php
                                                    if($appoint->type == 'Schedule appointment'){ ?>
                                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#viewappoint_<?php echo $appoint->id; ?>" data-placement="top" title="View Appointment" onclick="updateAppointmentStatus(<?php echo $appoint->id; ?>);"><span class="fa fa-fw ti-eye"></span></button>
                                                  <?php  }else{ ?>
                                                        <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#viewappoint_<?php echo $appoint->id; ?>" data-placement="top" title="View Appointment" disabled><span class="fa fa-fw ti-eye"></span></button>
                                                 <?php  }  ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                        <div class="modal fade" id="viewappoint" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
                                                                <div class="col-sm-12">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Complaint</label>
                                                                        <input type="text" class="form-control" placeholder="" value="<?php echo $appoint->complaint; ?>">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer ">
                                                        <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="updateAppointmentStatus(<?php echo $appoint->id; ?>);">
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
                                        <script>
                                            function updateAppointmentStatus(id){

                                                $.post('<?php echo base_url();?>welcome/updateAppointmentStatus/' + id, { task: 'update_status' },
                                                  function(result){
                                                    // console.log(result);
                                                    alert(result);
                                                    window.location.reload();
                                                });
                                            }
                                        </script>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <button class="button button-rounded button-primary-flat hvr-hang pull-right">
                             <i class="fa fa-fw ti-list"></i>  View All Case note(s)
                        </button>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title">Last Casenote(s)</h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table1">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Patient Name</th>
                                                <th>Health State</th>
                                                <th>Description</th>
                                                <th>Managed by</th>
                                                <th>Date Created</th>
                                                <th>Modified by</th>
                                                <th>Action</th>
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
                                                <td><?php echo $cn->description ; ?></td>
                                                <td> <?php 
                                                    $patient_name = $this->Model_casenote->get_doctor_by_id($cn->created_by);
                                                    echo "Dr. ".$patient_name->first_name;
                                                ?></td>
                                                <td><?php echo $cn->date_created ; ?></td>
                                                <td><?php if($cn->updated_by == ""){echo "not yet modified";}else{echo $cn->updated_by ;} ?></td>

                                                <td>
                                                    <?php
                                                         foreach($data_appointment as $appointment):
                                                    ?> 
                                                    <a href="
                                                    <?php echo base_url('casenote/edit_casenote/'. $appointment->id); ?>">
                                                        <button class="btn btn-primary btn-xs" data-placement="top"><span class="fa fa-fw ti-pencil"></span></button>
                                                    </a>
                                                    <button class="btn btn-icon btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $appointment->id; ?>" data-placement="top"><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Cancel Appointment"></i></button>
                                                    <?php endforeach; ?>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <?php

                                        endforeach;
                                            } 
                                         ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="background-overlay"></div>
        </section>
        <!-- /.content --> </aside>
    <!-- /.right-side --> </div>
<!-- ./wrapper -->

