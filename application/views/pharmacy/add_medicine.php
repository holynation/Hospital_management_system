<?php
$user_data = check_all_access(); // this check all the necessary access to the system and permission
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
                  <li class="active">
                    Add Medicine
                </li>
            </ol>
        </section>
        <!--section ends-->
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                    <i class="fa fa-fw ti-list"></i>  Add Medicine
                                </button>
                            </h3>
                        </div>
                        <?php
                            if(isset($error)){ ?>
                            <div class="alert alert-danger" style="padding-left:4%;"><?php echo $error; ?></div>
                            <?php } ?>

                        <?php //  this is for the validation page
                            if(validation_errors()){ ?>
                                <?php echo validation_errors('<div class="alert alert-danger" style="padding-left:40%;">','</div>'); ?>
                         <?php } ?>
                        <div class="panel-body text-center">
                            <div class="col-md-12">
                                <form action="<?php echo base_url('pharmacy/createMedicine'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Add New Medicine
                                        </h3>
                                      </b>
                                      <hr>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="name"> Name
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="name" name="name" placeholder="Medicine Name" value="<?php echo set_value('name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="medicine_category">Category</label>
                                                <div class="col-sm-9 m-t-10">
                                                    <select class="form-control" name="medicine_category" id="medicine_category">
                                                        <option value=""></option>
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
                                                        <input class="form-control" id="datetime20" name="manufacture_date" size="40" placeholder="YYYY-MM-DD" value="<?php echo set_value('manufacture_date'); ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="form">Form</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="form" name="form" placeholder="Drug Form (e.g:Caps)" value="<?php echo set_value('form'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="effect">Effects</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="effect" name="effect" placeholder="Drug Side Effect" value="<?php echo set_value('effect'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="generic_name">Generic
                                                    Name
                                                </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="generic_name" name="generic_name" placeholder="Generic Name" value="<?php echo set_value('generic_name'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="quantity">Quantity</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity" value="<?php echo set_value('quantity'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="expire_date">Expire Date</label>
                                                <div class="col-sm-9">
                                                    <div class="input-group ">
                                                        <div class="input-group-addon">
                                                            <i class="fa fa-fw ti-calendar"></i>
                                                        </div>
                                                        <input class="form-control" id="datetime201" name="expire_date" size="40" placeholder="YYYY-MM-DD" value="<?php echo set_value('expire_date') ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="packing">Packing</label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="form-control" id="packing" name="packing" placeholder="Drug packing" value="<?php echo set_value('packing'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="selling_price">Selling Price</label>
                                                <div class="col-sm-9">
                                                    <input type="number" class="form-control" id="selling_price" name="selling_price" placeholder="Selling Price" value="<?php echo set_value('selling_price'); ?>">
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
                                                    <input type="text" class="form-control" id="company" name="company" placeholder="Company" value="<?php echo set_value('company'); ?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-sm-3" for="purchase_price">Purchase Price</label>
                                                <div class="col-sm-5">
                                                    <input type="number" class="form-control" id="purchase_price" name="purchase_price" placeholder="purchase Price" value="<?php echo set_value('purchase_price'); ?>">
                                                </div>
                                            </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <br><br>
                                            <div class="form-group form-actions">
                                                <div class="col-md-8 col-md-offset-2">
                                                    <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnCreateMedicine" id="btnCreateMedicine">Submit</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        // $('#btnCreateMedicine').on('click', function(){
        //     var name = $('#name').val();
        //     var category = $('#medicine_category').val();
        //     var manufacture_date = $('#manufacture_date').val();
        //     var generic_name = $('#generic_name').val();
        //     var quantity = $('#quantity').val();
        //     var expire_date = $('#expire_date').val();
        //     var selling_price = $('#selling_price').val();
        //     var purchase_price = $('#purchase_price').val();

        //     if(name == '' || category == '' || manufacture_date == '' || generic_name == '' || quantity == '' || expire_date == '' || selling_price == '' || purchase_price == ''){
        //         $('#name,#medicine_category,#manufacture_date,#generic_name,#quantity,#expire_date,#selling_price,#purchase_price').css({
        //             'border-color' : 'red',
        //             'border-style' : 'solid',
        //             'border-width' : '0.3px'
        //         });
        //         return false;
        //     }
        //     return true;
        // });
    });
</script>

</body>
</html>


