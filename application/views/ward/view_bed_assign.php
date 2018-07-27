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
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>
<body class="skin-default">
<!-- <div class="preloader">
    <div class="loader_img"><img src="img/loader.gif.pagespeed.ce.9OKnn8kx6t.gif" alt="loading..." height="64" width="64"></div>
</div>
 --><!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
   <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Bed Assign List
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li><a href="#"> Ward</a></li>
                <li class="active">
                    Bed Assign List
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
                                     <i class="fa fa-fw ti-list"></i>  Bed List
                                </button>
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
                                        <th>Ward Name</th>
                                        <th>Category</th>
                                        <th>Charge</th>
                                        <th>Day</th>
                                        <th>Total</th>
                                        <th>Assign Date</th>
                                        <th>Discharge Date</th>
                                        <th>Assign By</th>
                                        <th>Discharge Status</th>
                                        <th>Date Modified</th>
                                        <th>Modifier</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <?php 
                                        if($data_ward_list == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php }else{ ?>

                                    <tbody>
                                        <?php
                                        $i = 1;
                                            foreach($data_ward_list as $bed):
                                        ?>
                                    <tr>
                                        <td><?php echo $i; $i++; ?></td>
                                        <td><?php $patient_name = $this->Model_patient->get_patient_by_id($bed->patient_id);
                                        	if(!$patient_name){
                                        		echo 'patient not found';
                                        	}
                                        		echo $patient_name->first_name, ' ', $patient_name->last_name;
                                        	?>
                                        </td>
                                        <td><?php echo $bed->ward_name; ?> </td>
                                        <td><?php echo $bed->category; ?></td>
                                        <td><?php 
                                        	if($bed->charge != 0){
                                        		echo $bed->charge;
                                         }else{
                                        	echo 'Null';
                                        } ?>
                                    	</td>

                                        <td><?php 
                                        if($bed->no_of_day != 0){
                                        	echo $bed->no_of_day;
                                         }else{
                                        	echo 'Null';
                                        } ?>
                                        </td>
                                         <!-- i wanna use this section to calc the total amount -->
                                       
                                        <td><?php 
                                        	if($bed->total_amount != 0){
                                        	echo $bed->total_amount; 
                                         }else{
                                        	echo 'Null' ; //$total
                                        } ?>
                                    	</td>
                                        <td><?php echo $bed->assign_date; ?></td>
                                        <td><?php echo $bed->discharge_date; ?></td>
                                        <?php
                                        	$this->Model_staff->find_id($bed->assign_by);
											$user_assign = $this->Model_staff->data();
                                        ?>
                                        <td><?php echo $user_assign->first_name, ' ', $user_assign->last_name; ?></td>
                                        <td><?php 
                                        	if($bed->discharge_status == 'Inactive'){
                                        		echo '<span class="label label-sm label-danger"> No</span>';
                                        	}else{
                                        		echo '<span class="label label-sm label-success"> Yes</span>';
                                        	}
                                         ?></td>
                                         <td><?php echo $bed->date_modified; ?></td>
                                         <td><?php echo $bed->modifier; ?></td>
                                        <td>
                                        	<!-- substr(md5('ehm' . $bed->id), 1,10) -->
                                        	<a href="<?php echo base_url('ward/discharge_date/'. $bed->id); ?>">
                                        	<button class="btn btn-info btn-xs" data-placement="top" title="Discharge Patient"><span class="fa fa-fw ti-calendar"></span>Discharge</button>
                                        	</a>
                                            <a href="<?php echo base_url('ward/edit_bed_assign/'. substr(md5('ehm' . $bed->id), 1,10). '/' .$bed->id); ?>">
                                                <button class="btn btn-primary btn-xs" data-placement="top" title="Edit Bed Assign"><span class="fa fa-fw ti-pencil"></span></button>
                                            </a>
                                            <?php if($permission != 'admin'){?>
                                            <button class="btn btn-icon btn-danger btn-xs" data-placement="top" disabled><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Delete Bed"></i></button>
                                            <?php }else{ ?>
                                                <button class="btn btn-icon btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $bed->id; ?>" data-placement="top"><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Delete Bed"></i></button>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete_<?php echo $bed->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="" method="post">
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
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="deleteBedAssign(<?php echo $bed->id; ?>);">
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
                                    <?php endforeach; } ?>
                                    </tbody>

						            <script>
						            	function deleteBedAssign(id){

						            		$.post('<?php echo base_url();?>ward/delete_bed/' + id, { delete: 'deleting' },
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
<!-- end of global js -->
<?php include (APPPATH . 'views/templates/footer_view.php'); ?>

</body>
</html>








