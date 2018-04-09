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
     <!-- global css -->

   <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>

    <!-- end of global css -->
    
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
            <!--section starts-->
            <h1>
                Ward
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                  <li class="active">
                    Add Ward
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
                                     <i class="fa fa-fw ti-list"></i>  Ward
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
                            <div class="col-md-10 ">
                                <form action="<?php echo base_url('ward/create'); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Add New Ward
                                        </h3>
                                      </b>
                                      <hr>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="ward_name">
                                            Ward Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" id="ward_name" name="ward_name" class="form-control" placeholder="Enter Ward Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="category">
                                            Category
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <select id="category" name="category" class="form-control">
                                                <option value=""> ---- Select Category ---- </option>
                                                <option value="ICU">ICU</option>
                                                <option value="Private">Private</option>
                                                <option value="Public">Public</option>
                                             </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">
                                            Descripton
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea id="description" name="description" rows="4" class="form-control resize_vertical" placeholder="Short description short info "></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="no_of_bed">
                                            No. Of Bed
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="number" id="no_of_bed" name="no_of_bed" class="form-control" placeholder="No. Of Bed">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="charge">
                                            Charge
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="number" id="charge" name="charge" class="form-control" placeholder="Charge">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <br><br>
                                        <div class="form-group form-actions">
                                            <div class="col-md-8 col-md-offset-2">
                                                <button type="submit" class="btn btn-effect-ripple btn-primary" name="btnCreateWard" id="btnCreateWard">Submit</button>
                                                <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                        $('#btnCreateWard').on('click', function(){
                                            var ward_name = $('#ward_name').val();
                                            var category = $('#category').val();
                                            var description = $('#description').val();
                                            var no_bed = $('#no_of_bed').val();
                                            var charge = $('#charge').val();

                                            if(ward_name == '' || category == '' || description == '' || no_bed == '' || charge == ''){
                                                $('#ward_name,#category,#description,#no_of_bed,#charge').css({
                                                    'border-color' : 'red',
                                                    'border-style' : 'solid',
                                                    'border-width' : '0.5px'
                                                });
                                                return false;
                                            }
                                            return true;
                                        });
                                    });
                                </script>
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
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script><!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 

<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script><!-- end of global js -->

<!-- end of page level js -->

</body>
</html>


