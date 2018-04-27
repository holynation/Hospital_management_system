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
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->

<?php include 'includes/static-header.php'; ?>

	<?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Patient
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>
                    Patient
                </li>
                <li class="active">
                    View Patient
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
                                <i class="ti-layout-grid2"></i> View Patient Table
                            </h3>
                        </div>
                        <div class="col-md-4" style="margin:15px;">
                            <a href="<?php echo base_url('patient/add_patient'); ?>" class="btn btn-primary"><i class="glyphicon glyphicon-plus icon-plus"></i> Add Patient</a>
                        </div>
                        <br />
                        <?php
                            if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:50%;"><?php echo $this->session->flashdata('success'); ?></div>
                            <?php } ?>
                        <div class="panel-body">
                            <table id="table4" data-toolbar="#toolbar" data-search="true" data-show-refresh="false" data-show-toggle="true" data-show-columns="true" data-show-export="true" data-detail-view="false" data-detail-formatter="detailFormatter" data-minimum-count-columns="2" data-show-pagination-switch="true" data-pagination="true" data-id-field="id" data-page-list="[10,20,40,ALL]" data-show-footer="false" data-height="700" data-side-pagination="client">
                                <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th data-field="Patient Id" data-sortable="true">Patient Id</th>
                                    <th data-field="Patient image" data-sortable="true">Patient image</th>
                                    <th data-field="First name" data-sortable="true">First name</th>
                                    <th data-field="Last name" data-sortable="true">Last name</th>
                                    <th data-field="Middle name" data-sortable="true">Middle name</th>
                                    <th data-field="Gender" data-sortable="true">Gender</th>
                                    <th data-field="Dob" data-sortable="true">Age</th>
                                    <th data-field="Phone num" data-sortable="true">Phone num</th>
                                    <th data-field="E-mail" data-sortable="true">E-mail</th>
                                    <th data-field="Address" data-sortable="true">Address</th>
                                    <th data-field="State" data-sortable="true">State</th>
                                    <th data-field="Occupation" data-sortable="true">Occupation</th>
                                    <th data-field="Allergy" data-sortable="true">Allergy</th>
                                    <th data-field="Action" data-sortable="false">Action</th>
                                </tr>
                                </thead>
                                <?php 
                                    if($data_patient == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php  }else{ ?>

                                <tbody>
                                	<?php
                                        $i = 1;
                                        foreach($data_patient as $patient):
                                    ?>
                                <tr>
                                    <td><?php echo $i;$i++; ?></td>
                                    <td><?php echo $patient->patient_id; ?></td>
                                    <td><img src="<?php echo base_url($patient->picture_path); ?>" class="img-responsive" style="height: 85px;"></td>
                                    <td><?php echo $patient->first_name; ?></td>
                                    <td><?php echo $patient->last_name; ?></td>
                                    <td><?php echo $patient->middle_name; ?></td>
                                    <td><?php echo $patient->gender; ?></td>
                                    <td><?php echo get_current_age($patient->dob); ?></td>
                                    <td><?php echo $patient->phone_no; ?></td>
                                    <td><?php echo $patient->email; ?></td>
                                    <td><?php echo $patient->address; ?></td>
                                    <?php $name = $this->Model_staff->display_state($patient->state); 
                                        if($name == ''){ ?>
                                                <td><?php echo ' '; ?></td>
                                        <?php }else{ ?>
                                            <td><?php echo $name->state_name; ?></td>
                                    <?php } ?>
                                    <td><?php echo $patient->occupation; ?></td>
                                    <td><?php echo $patient->allergy; ?></td>
                                    <td>
                                    	<p>
                                            <a href="<?php echo base_url('patient/view_patient_full/'. $patient->id); ?>" class="btn btn-primary"><span class="fa fa-fw ti-pencil"></span> Edit</a>
                                        </p>
                                        <p>
                                            <a href="<?php echo base_url('appointment/create/'. $patient->id); ?>" class="btn btn-primary"><span class="fa fa-fw ti-pencil-alt"></span> Appointment</a>
                                        </p>
                                        <p>
                                            <a href="<?php echo base_url('ward/bed_assign/'. $patient->id); ?>" class="btn btn-primary"><i class="fa fa-fw ti-notepad"></i> Assign Ward</a>
                                        </p>
                                        <p>
                                            <a href="<?php echo base_url('patient/single_patient/'. $patient->id) ?>" class="btn btn-primary"><i class="fa fa-eye"></i> Details</a>
                                        </p>
                                    </td>
                                </tr>
                                <?php endforeach; } ?>
                                </tbody>
                                
                            </table>
                        </div>
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
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/editable-table/js/mindmup-editabletable.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/bootstrap-table/js/bootstrap-table.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/tableExport.jquery.plugin/tableExport.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/bootstrap_tables.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>
</html>
