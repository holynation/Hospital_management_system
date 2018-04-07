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
                        <h3>EHM/
                            <small><?php echo get_user_role($user_data); ?> Dashboard</small>
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
                                <h3 class="text-dark"><b>375</b></h3>
                                <p>Appointments</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <h5 class="text-dark">Today Appointment</h5>
                                <h5 class="text-dark"><b>375</b></h5>
                                <hr>
                                <p>Create New Appointment</p>
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
                                <h3 class="text-dark"><b>125</b></h3>
                                <p>Patient</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                 <h5 class="text-dark">Today Stat</h5>
                                <h5 class="text-dark"><b>37</b></h5>
                                <hr>
                                <p>View All</p>
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
                                <h3 class="text-dark"><b>75</b></h3>
                                <p>Case Note</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                <h5 class="text-dark">New Case Note</h5>
                                <h5 class="text-dark"><b>375</b></h5>
                                <hr>
                                <p>View Case Note</p>
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
                                <h3 class="text-dark"><b>125</b></h3>
                                <p>Doctor</p>
                            </div>
                            <div class="clearfix"></div>
                        </div><a href="">
                        <div class="widget-bg-color-icon card-box back">
                            <div class="text-center">
                                 <h5 class="text-dark">Today Stat</h5>
                                <h5 class="text-dark"><b>37</b></h5>
                                <hr>
                                <p>View All</p>
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
                                <button class="button button-rounded button-primary-flat hvr-hang pull-right">
                                     <i class="fa fa-fw ti-list"></i>  View All Case note(s)
                                </button>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Casenote(s)</h3>
                                  
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
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                               <!--      <?php 
                                        if($data_cn == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php exit; }?>

                                    <?php
                                    $i = 1;
                                        foreach($data_cn as $cn):
                                    ?> -->
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

                                        <td>
                                            <?php
                                                       foreach($data_appointment as $appointment):
                                                   ?> 
                                            <a href="
                                            <?php echo base_url('casenote/edit_casenote/'. $appointment->id); ?>">
                                                <button class="btn btn-primary btn-xs" data-placement="top"><span class="fa fa-fw ti-pencil"></span></button>
                                            </a>
                                            <button class="btn btn-icon btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $appointment->id; ?>" data-placement="top"><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Cancel Appointment"></i></button>
                                            
                                            <? endforeach ?>

                                        </td>
                                    </tr>
                                    </tbody>
                               
                                <!--     <?php endforeach; ?> -->
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

<script type="text/javascript" src="<?php echo base_url() ; ?>assets/vendors/Buttons/js/buttons.js"></script>
    
     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">
