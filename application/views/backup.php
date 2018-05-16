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
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css" rel="stylesheet"/>
    <!-- end of global css -->
    <!--page level css -->
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/A.vendors%2c%2c_sweetalert2%2c%2c_css%2c%2c_sweetalert2.min.css%2bcss%2c%2c_custom_css%2c%2c_sweet_alert2.css%2cMcc.aDftwHNxe5.css.pagespeed.cf.EQTeZyXS9Z.css"/>
    
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">

    <?php 
    include (APPPATH.'views/navigation/admin_nav.php');
    // $this->load->view('navigation/admin_nav');
     ?>

    <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <!--section starts-->
            <h1>Notification</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    Notification
                </li>
            </ol>
        </section>
        <!--section ends-->
        <!--section ends-->
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="ti-harddrives" aria-hidden="true"></i>
                                Backup Database
                            </h3>
                            <span class="pull-right">
                                    <i class="fa fa-fw ti-angle-up clickable"></i>
                                    <i class="fa fa-fw ti-close removepanel clickable"></i>
                                </span>
                        </div>
                        <div class="panel-body">
                            <!--=============panel content starting=============-->
                            <div class="row m-a-10">
                                <div class="col-md-6 col-sm-6 col-sm-offset-3">
                                    <div class="panel  panel-default hvr-sweep-to-right">
                                        <div class="panel-body ok_message text-center">
                                            <h5 class="alert alert-info"> Backup Database <i class="ti-harddrives"></i></h5>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!--first row end-->
                            <!--=================== panel content end ======================-->
                        </div>
                        <!--end of panel body-->
                    </div>
                </div>
            </div>
            <!--main content ends-->
            <div class="background-overlay"></div>
        </section>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- ./wrapper -->
<!-- global js -->

<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/vendors/sweetalert2/js/sweetalert2.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/custom_js/sweetalert.js"></script>
<!-- end of page level js -->
</body>
</html>
