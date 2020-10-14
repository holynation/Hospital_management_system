<?php
$user_data = is_logged();
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
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>
<body class="skin-default">
--><!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View ANC
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li><a href="#"> ANC</a></li>
                <li class="active">
                     Antenatal Clinic
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
                                <!--       <a href="<?php echo base_url('casenote/add_casenote/')?>">  <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-plus"></i>  Create New Casenote
                                </button>
                            </a> -->
                            </div>
                            <div class="tools pull-right"></div>
                        </div>

                        <br />
                        <div class="clearfix"></div>
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
                                        <th>Patient Name</th>
                                        <th>History of pregnancy</th>
                                        <th>Symptomps </th>
                                        <th>Abnormalities</th>
                                        <th>Comments </th>
                                        <th>Pelvic Assessment </th>
                                        <th>General Condition</th>
                                        <th>Oedema Examination </th>
                                        <th>Anaemia </th>
                                        <th>Respiratory System</th>
                                        <th>Cardiovascular</th>
                                        <th>Abdomen</th>
                                        <th>Spleen</th>
                                        <th>Gestational Age</th>
                                        <th>Booking Date</th>
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

                                            <td><?php echo $cn->hop ; ?></td>
                                            <td><?php echo $cn->symptomp ; ?></td>
                                            <td><?php echo $cn->abnormalties ; ?></td>
                                            <td><?php echo $cn->comments ; ?></td>
                                            <td><?php echo $cn->pelvic ; ?></td>
                                            <td><?php echo $cn->general ; ?></td>
                                            <td><?php echo $cn->oedema ; ?></td>
                                            <td><?php echo $cn->anaemia ; ?></td>
                                            <td><?php echo $cn->respiratory ; ?></td>
                                            <td><?php echo $cn->cardiovascular ; ?></td>
                                            <td><?php echo $cn->abdomen ; ?></td>
                                            <td><?php echo $cn->spleen ; ?></td>
                                            <td><?php echo $cn->gestational ; ?></td>
                                            <td><?php echo $cn->booking_date ; ?></td>

                                            <td> <?php
                                                $patient_name = $this->Model_casenote->get_doctor_by_id($cn->created_by);
                                                echo "Dr. ".$patient_name->first_name;
                                                ?></td>
                                            <td><?php echo $cn->date_created ; ?></td>
                                            <td><?php if($cn->updated_by == ""){echo "not yet modified";}else{echo $cn->updated_by ;} ?></td>

                                            <td>

                                                <a href="
                                            <?php echo base_url('casenote/edit_casenote/'. $cn->id); ?>">
                                                    <button class="btn btn-primary btn-xs" data-placement="top"><span class="fa fa-fw ti-pencil"></span></button>
                                                </a>
                                                <button class="btn btn-icon btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $cn->id; ?>" data-placement="top"><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Cancel casenote"></i></button>

                                            </td>
                                        </tr>
                                        </tbody>
                                        <div class="modal fade" id="delete_<?php echo $cn->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form action="<?php echo base_url('casenote/delete'); ?>" method="post">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                            <h4 class="modal-title custom_align" id="Heading5">Delete this entry </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="alert alert-info">
                                                                <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure you want to
                                                                delete this record ?
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer ">
                                                            <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="deleteAppoint(<?php echo $cn->id; ?>);">
                                                                <span class="glyphicon glyphicon-ok-sign"></span> Yes
                                                            </button>
                                                            <button type="button" class="btn btn-success" data-dismiss="modal">
                                                                <span class="glyphicon glyphicon-remove"></span> No
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                /.modal-content
                                            </div>
                                            /.modal-dialog
                                        </div>
                                        <script>
                                            function deleteAppoint(id){

                                                $.post('<?php echo base_url();?>casenote/delete/' + id, { delete: 'deleting' },
                                                    function(result){
                                                        // console.log(result);
                                                        location.reload();
                                                        alert(result);

                                                    });
                                            }
                                        </script>
                                    <?php endforeach; } ?>
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
<!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>

<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script><!-- end of global js -->
<!-- begining of page level js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/dataTables.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/dataTables.buttons.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/dataTables.colReorder.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/dataTables.rowReorder.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/buttons.colVis.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/buttons.html5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/buttons.bootstrap.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/buttons.print.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/datatables/js/dataTables.scroller.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/advanced_datatables.js" type="text/javascript"></script>
<!-- end of page level js -->

</body>
</html>








