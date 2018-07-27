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
    
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
   <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                View Medicine Sold
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li><a href="#"> Pharmacy</a></li>
                <!-- <li>Medicine</li> -->
                <li class="active">
                   Medicine Sold
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
                                <a href="<?php echo base_url('pharmacy/pos'); ?>">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-pencil"></i> Administer Drug
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
                                        <th>Patient Name</th>
                                        <th>Medicine Name</th>
                                        <th>Cost Price</th>
                                        <th>Discount</th>
                                        <th>Sold Price</th>
                                        <th>Date Created</th>
                                        <th>Issued By</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <?php 
                                        if($data_sold == 'no result'){ ?>
                                        <div class="alert alert-danger"> No record found... </div>
                                    <?php  }else{ ?>

                                    
                                    <tbody>
                                        <?php
                                            $j = 1;
                                            foreach($data_sold as $sold):
                                        ?>
                                    <tr>
                                        <td><?php echo $j; $j++; ?></td>
                                        <td>
                                            <?php
                                                if($sold->patient_id){
                                                    $patient_info = $this->Model_patient->get_patient_by_id($sold->patient_id);
                                                    echo $patient_info->first_name, ' ', $patient_info->last_name;
                                                }
                                            ?>
                                        </td>
                                        <?php 
                                            $medicine_name = '';
                                            $sum_price = 0;
                                                $each_id = explode(",",$sold->medicine_id);
                                                $each_quantity = explode(",", $sold->quantity);

                                                foreach($each_id as $medicine_id){
                                                $medicine_name .=  ',' .$this->Model_pharmacy->get_medicine_by_id($medicine_id)->name;
                                                } 
                                            ?>

                                            <?php 
                                                for($i=0; $i<count($each_quantity); $i++){
                                                    $sum_price +=($this->Model_pharmacy->get_medicine_by_id($each_id[$i])->selling_price * $each_quantity[$i]);
                                                }
                                            ?>

                                        <td><?php echo substr($medicine_name,1); ?></td>
                                        <td><?php echo $sum_price; ?></td>
                                        <td><?php echo $sold->discount; ?></td>
                                        <td><?php echo $sold->total; ?></td>
                                        <td><?php echo $sold->date_created; ?></td>
                                        <td><?php echo $sold->submitted_by; ?></td>
                                        <td>
                                            <p>
                                            <?php 
                                            if($permission != 'admin'){ ?>
                                                <button type="button" class="btn btn-icon btn-danger btn-round m-r-10" data-toggle="modal" data-target="#delete_<?php echo $sold->id; ?>" data-placement="top" disabled><i class="icon fa fa-fw ti-trash" aria-hidden="true"></i></button>
                                          <?php  }else{ ?>
                                               <button type="button" class="btn btn-icon btn-danger btn-round m-r-10" data-toggle="modal" data-target="#delete_<?php echo $sold->id; ?>" data-placement="top"><i class="icon fa fa-fw ti-trash" aria-hidden="true"></i></button>
                                          <?php  }  ?>
                                            </p>
                                            <p>
                                                <a href="<?php echo base_url('pharmacy/print_invoice/'. $sold->id . '/'. md5($sold->id)); ?>" class="btn btn-primary"> <i class="icon fa fa-fw ti-printer"></i> Invoice</a>
                                            </p>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete_<?php echo $sold->id; ?>" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
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
                                                    <button type="click" class="btn btn-danger" data-dismiss="modal" onclick="deleteOrder(<?php echo $sold->id; ?>);">
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
                                        function deleteOrder(id){

                                            $.post('<?php echo base_url();?>pharmacy/delete/' + id, { delete: 'deleting',task: 'medicine_sold' },
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








