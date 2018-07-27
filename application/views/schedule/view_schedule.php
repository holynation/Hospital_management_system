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
    <title> <?php echo (get_ehm_title()) ? get_ehm_title() : 'EHM Dashboard' ; ?> </title>
       <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico"/>
  <!-- global css -->
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>
  <!-- end of global css -->

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_datatables%2c_css%2c_dataTables.bootstrap.css%2bvendors%2c_datatables%2c_css%2c_buttons.bootstrap.css%2bvendors%2c_datatables%2c_css%2c_colReorder.bootstrap.css%2bvendor"/>
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <!--end of page level css-->
     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">

    <!--end of page level css-->
</head>
<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
   <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Schedule
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li><a href="#"> Schedule</a></li>
                <li class="active">
                    View Schedule
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
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  Schedule List
                                </button>
                            </div>
                            <div class="tools pull-right"></div>
                        </div>
                        <div class="pull-right" style="margin:8px;">
                            <a href="<?php echo base_url('schedule/create'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus icon-plus"></i> Add Schedule</a>
                        </div>
                        <br />
                        <div class="clearfix"></div>
                        <?php
                            if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:25%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped" id="table1">
                                    <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Doctor Name</th>
                                        <th>Department Name</th>
                                        <th>Available Days</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        <th>Date Created</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <?php 
                                        if($data_schedule == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php  }else{ ?>

                                    
                                    <tbody>
                                        <?php
                                        $i = 1;
                                            foreach($data_schedule as $schedule):
                                        ?>
                                    <tr>
                                        <td><?php echo $i; $i++; ?></td>
                                        <?php 
                                            $doctor = $this->Model_schedule->get_doctor_by_id($schedule->doctor_id);
                                            $middle = substr($doctor->middle_name, 0, 1);
                                        ?>
                                        <td>
                                            Dr. <?php echo $doctor->first_name, ' ', $middle , (empty($middle)) ? '' : '. ' ,$doctor->last_name; ?>
                                        </td>
                                        <?php $depart_name = $this->Model_staff->get_depart_name($doctor->department_id)->row(); ?>
                                        <td><?php echo $depart_name->department_name; ?></td>
                                        <td><?php echo $schedule->available_days; ?></td>
                                        <td><?php echo $schedule->available_time_start; ?></td>
                                        <td><?php echo $schedule->available_time_end; ?></td>
                                        <td><?php echo $schedule->date_created; ?></td>
                                        <td>
                                           <!--  <a href="#">
                                            <button class="btn btn-icon btn-danger btn-xs"><i class="icon fa fa-fw ti-trash" aria-hidden="true"></i></button></a> -->
                                            <a href="<?php echo base_url('schedule/edit_schedule/'. $schedule->id); ?>">
                                                <button class="btn btn-primary btn-xs" data-placement="top"><span class="fa fa-fw ti-pencil"></span> Edit</button>
                                            </a>
                                            <a href="#<?php //echo base_url('schedule/delete/'. $schedule->id); ?>">
                                                <button class="btn btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $schedule->id; ?>" data-placement="top"><span class="fa fa-fw ti-close"></span> Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete_<?php echo $schedule->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo base_url('schedule/delete'); ?>" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title custom_align" id="Heading5">Delete this entry </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure you want to
                                                        delete this schedule ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="deleteSchedule(<?php echo $schedule->id; ?>);">
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
                                    <?php endforeach; }?>
                                    </tbody>
                                    <script>
                                        function deleteSchedule(id){

                                            $.post('<?php echo base_url();?>schedule/delete/' + id, { delete: 'deleting' },
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
            </div>
            <div class="background-overlay"></div>
        </section>
    </aside>
    <!-- /.right-side -->
</div>

<script type="text/javascript" src="<?php echo base_url() ; ?>assets/vendors/Buttons/js/buttons.js"></script>

    <!--end of page level css-->
<!-- global js -->
<div id="qn"></div>
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script><!-- end of global js -->
<?php include (APPPATH . 'views/templates/footer_view.php'); ?>

</body>
</html>








