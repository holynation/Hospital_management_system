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
    <title> <?php echo $get_settings->title; ?> | <?php if($user_data->status == 'success'){ echo $user_data->role; }else{ echo ' ';} ?> Dashboard </title>
       <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico"/>
 
    <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/A.app.css.pagespeed.cf.odGN98LG8l.css" rel="stylesheet"/>
    <link href="<?php echo base_url(); ?>assets/vendors%2c_iCheck%2c_css%2c_all.css%2bvendors%2c_datetime%2c_css%2c_jquery.datetimepicker.css%2bvendors%2c_bootstrap-touchspin%2c_css%2c_jquery.bootstrap-touchspin.css%2bcss%2c_custom.css.pagespe" rel="stylesheet"/>
    
    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_daterangepicker%2c_css%2c_daterangepicker.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.css%2bvendors%2c_datedropper%2c_datedropper.css%2bvend" rel="stylesheet"/>
   <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <!-- end of global css -->
    
     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">
     <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/datepicker.css">
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
            <!--section starts-->
            <h1>
                Pharmacy
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li>Pharmacy</li>
                  <li> Medicine</li>
                  <li class="active">Edit Medicine</li>
            </ol>
        </section>
        <!--section ends-->
        <?php
            if($data_medicine):
        ?>
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <a href="<?php echo base_url('pharmacy/view_medicine'); ?>">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                    <i class="fa fa-fw ti-list"></i>  View Medicine
                                </button></a>
                            </h3>
                        </div>
                        <?php 
                            if($data_medicine == 'no result'){ ?>
                            <div class="alert alert-danger"> No result found on this patient... </div>
                        <?php  }else if($this->session->flashdata('success')){ ?>
                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:60%;"><?php echo $this->session->flashdata('success') ?></div>
                            <?php } ?>
                        <div class="panel-body text-center">
                            <div class="col-md-12">
                                <form action="<?php echo base_url('pharmacy/edit_medicine_update'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Edit Medicine
                                        </h3>
                                      </b>
                                      <hr>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="name"> Name
                                                </label>
                                                <input type="hidden" name="update_medicine_id" value="<?php echo $data_medicine->id; ?>">
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Medicine Name" value="<?php echo $data_medicine->name; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="medicine_category">Category</label>
                                                <div class="col-sm-9 m-t-10">
                                                    <select class="form-control" name="medicine_category" id="medicine_category">
                                                        <option value="<?php echo $data_medicine->category; ?>"><?php echo $data_medicine->category_name; ?></option>
                                                        <?php foreach($category as $c): ?>
                                                        <option value="<?php echo $c->id; ?>"><?php echo $c->category_name; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="manufacture_date">Manufacture Date</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group ">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-fw ti-calendar"></i>
                                                        </div>
                                                        <input class="form-control" id="datetime20" name="manufacture_date" size="40" placeholder="YYYY-MM-DD" value="<?php echo $data_medicine->manufacture_date; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="form">Form</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="form" name="form" placeholder="Drug Form (e.g:Caps)" value="<?php echo $data_medicine->form; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="effect">Effects</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="effect" name="effect" placeholder="Drug Effect" value="<?php echo $data_medicine->effect; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="generic_name">Generic
                                                    Name
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="generic_name" name="generic_name" placeholder="Generic Name" value="<?php echo $data_medicine->generic_name; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="quantity">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo $data_medicine->quantity; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="expire_date">Expire Date</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group ">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-fw ti-calendar"></i>
                                                        </div>
                                                        <input class="form-control" id="datetime201" name="expire_date" size="40" placeholder="YYYY-MM-DD" value="<?php echo $data_medicine->expire_date; ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="packing">Packing</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="packing" name="packing" placeholder="Drug packing" value="<?php echo $data_medicine->packing; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="selling_price">Selling Price</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price" value="<?php echo $data_medicine->selling_price; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="row">
                                            <hr>
                                              <b class="text-center">
                                                <h3 class="panel-title"> Supplier Info
                                                </h3>
                                              </b>
                                            <hr>
                                        <div class="col-sm-12 col-sm-offset-1">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="company">Company</label>
                                                <div class="col-sm-5">
                                                    <input type="text" class="form-control" id="company" name="company" placeholder="Company" value="<?php echo $data_medicine->company; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="purchase_price">Purchase Price</label>
                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" id="purchase_price" name="purchase_price" placeholder="purchase Price" value="<?php echo $data_medicine->purchase_price; ?>">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <br><br>
                                            <div class="form-group form-actions">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnUpdateMedicine" id="btnUpdateMedicine">Update</button>
                                                    <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
        <!-- /.content -->
        <?php endif; ?>
    </aside>
    <!-- /.right-side -->
</div>

<script type="text/javascript" src="<?php echo base_url() ; ?>assets/vendors/Buttons/js/buttons.js"></script>

<!--end of page level css-->
<!-- global js -->
<div id="qn"></div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- end of page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/colorpicker/js/bootstrap-colorpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/clockpicker/js/bootstrap-clockpicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-multiselect/js/bootstrap-multiselect.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/clockface/js/clockface.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/toolbar/js/jquery.toolbar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/pickers.js" type="text/javascript"></script>

<script src="<?php echo base_url(); ?>assets/vendors/iCheck/js/icheck.js" type="text/javascript"></script></script>
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-touchspin/js/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
</body>
</html>


