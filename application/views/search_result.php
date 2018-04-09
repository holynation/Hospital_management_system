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
    <title> :: Search result section :: </title>
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
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <!-- end of global css -->
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
            <h1>Patient Result</h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li class="active">
                    <a href="">Search</a>
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <i class="ti-user" data-size="18" data-c="#ffffff" data-hc="#ffffff"></i> Patient List
                            </h4>
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="table">
                                    <thead>
                                        <th>ID</th>
                                        <th>Patient Id</th>
                                        <th>Name</th>
                                        <th>Gender</th>
                                        <th>Mobile Num.</th>
                                        <th>Email</th>
                                        <th>Address</th>
                                        <th>Action</th>
                                    </thead>
                                    <?php 
                                        if($results == null){ ?>
                                            <div class="alert alert-warning"> You didn't search for any patient... </div>
                                        <?php  }
                                        else if($results == 'no result'){ ?>
                                            <div class="alert alert-danger"> No patient found... </div>
                                        <?php }else{ ?>

                                        <?php  
                                        $i = 1;
                                        foreach($results as $result):   ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i;$i++; ?></td>
                                            <td><?php echo $result->patient_id; ?></td>
                                            <td><?php echo $result->first_name . ' '. $result->last_name;  ?></td>
                                            <td><?php echo $result->gender; ?></td>
                                            <td><?php echo $result->phone_no; ?></td>
                                            <td><?php echo $result->email; ?></td>
                                            <td><?php echo $result->address; ?></td>
                                            <td><a class="btn btn-info" href="<?php echo base_url('patient/single_patient/'. $result->id); ?>">Details</a></td>
                                        </tr>
                                    </tbody>
                                    <?php endforeach; }?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="background-overlay"></div>
        </section>
        <!-- /.content -->
    </aside>
</div>
<!-- /.right-side -->
<!-- ./wrapper -->
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of page level js -->

</body>


<!-- Mirrored from demo.vueadmintemplate.com/dark/blank.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 07 Feb 2018 09:04:15 GMT -->
</html>
