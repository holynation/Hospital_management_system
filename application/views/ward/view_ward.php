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
                View Ward
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li><a href="#"> Ward</a></li>
                <li class="active">
                    View Ward
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
                                <a href="<?php echo base_url('ward/create'); ?>">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  Add Ward
                                </button></a>
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
                                        <th>Ward Name</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                        <th>No. Of Bed</th>
                                        <th>Charge</th>
                                        <th>Status</th>
                                        <th>Modifier</th>
                                        <th>Date Created</th>
                                        <th>Date Modified</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <?php 
                                        if($data_ward == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php }else{ ?>
                                    
                                    <tbody>
                                        <?php
                                        $i = 1;
                                            foreach($data_ward as $ward):
                                        ?>
                                    <tr>
                                        <td><?php echo $i; $i++; ?></td>
                                        <td><?php echo $ward->ward_name; ?> </td>
                                        <td><?php echo $ward->category; ?></td>
                                        <td><?php echo $ward->description; ?></td>
                                        <td><?php echo $ward->no_of_bed; ?></td>
                                        <td><?php echo $ward->charge; ?></td>
                                        <td><?php echo $ward->status; ?></td>
                                        <?php
                                            if($ward->user_modified){ ?>
                                            <td class="text text-primary"><?php echo $ward->user_modified; ?></td>
                                        <?php }else{ ?>
                                            <td>False</td>
                                      <?php  } ?>

                                        <td><?php echo $ward->date_created; ?></td>
                                        <td><?php echo $ward->date_modified; ?></td>
                                        <td>
                                            <a href="<?php echo base_url('ward/edit_ward/'. $ward->id); ?>">
                                                <button class="btn btn-primary btn-xs" data-placement="top" title="Edit Ward"><span class="fa fa-fw ti-pencil"></span></button>
                                            </a>
                                            <?php 
                                                if($ward->status == 'Active'){ ?>
                                                <button class="btn btn-icon btn-warning btn-xs" data-toggle="modal" data-target="#status_<?php echo $ward->id; ?>" data-placement="top" title="Change Status"><i class="icon fa fa-fw ti-check-box" aria-hidden="true"></i></button>
                                          <?php  }else{ ?>
                                                  <button class="btn btn-icon btn-success btn-xs" data-toggle="modal" data-target="#status2_<?php echo $ward->id; ?>" data-placement="top" title="Change Status"><i class="icon fa fa-fw ti-check-box" aria-hidden="true"></i></button>
                                              <?php  }
                                            ?>
                                            <?php if($permission != 'admin'){ ?>
                                            <button class="btn btn-icon btn-danger btn-xs" data-placement="top" disabled><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Delete Ward"></i></button>
                                            <?php }else{ ?>
                                                <button class="btn btn-icon btn-danger btn-xs" data-toggle="modal" data-target="#delete_<?php echo $ward->id; ?>" data-placement="top"><i class="icon fa fa-fw ti-trash" aria-hidden="true" title="Delete Ward"></i></button>
                                         <?php } ?>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete_<?php echo $ward->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo base_url('appointment/delete'); ?>" method="post">
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
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="deleteWard(<?php echo $ward->id; ?>);">
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
                                    <div class="modal fade" id="status_<?php echo $ward->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo base_url('appointment/delete'); ?>" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title custom_align" id="Heading5">Update Ward Status </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure you want to
                                                        change the ward status of this record ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="updateWard(<?php echo $ward->id; ?>);">
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
                                    <div class="modal fade" id="status2_<?php echo $ward->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="<?php echo base_url('appointment/delete'); ?>" method="post">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                    <h4 class="modal-title custom_align" id="Heading5">Update Ward Status </h4>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="alert alert-info">
                                                        <span class="glyphicon glyphicon-info-sign"></span>&nbsp; Are you sure you want to
                                                        change the ward status of this record ?
                                                    </div>
                                                </div>
                                                <div class="modal-footer ">
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="updateWard2(<?php echo $ward->id; ?>);">
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
						            	function deleteWard(id){

						            		$.post('<?php echo base_url();?>ward/delete/' + id, { delete: 'deleting' },
                                              function(result){
                                                // console.log(result);
                                                alert(result);
                                                window.location.reload();
                                            });
						            	}

                                        function updateWard(id){

                                            $.post('<?php echo base_url();?>ward/update_status/' + id, { update_status: 'deleting', task : 'Inactive' },
                                              function(result){
                                                // console.log(result);
                                                alert(result);
                                                window.location.reload();
                                            });
                                        }
                                        function updateWard2(id){

                                            $.post('<?php echo base_url();?>ward/update_status/' + id, { update_status: 'deleting', task : 'Active' },
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








