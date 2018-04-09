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
     <!-- global css -->

    <link type="text/css" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_daterangepicker%2c_css%2c_daterangepicker.css%2bvendors%2c_datetimepicker%2c_css%2c_bootstrap-datetimepicker.min.css%2bvendors%2c_datedropper%2c_datedropper.css%2bvend" rel="stylesheet"/>

    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>

    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <link href="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/css/datepicker.css" type="text/css" rel="stylesheet">
    
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
                Bed
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                  <li class="active">
                    Assign Bed
                </li>
            </ol>
        </section>
        <!--section ends-->
        <?php
            foreach($data_patient as $patient):
        ?>
        <section class="content">
            <!--main content-->
            <div class="row">
                <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                 <button class="button button-rounded button-primary-flat hvr-hang">
                                     <i class="fa fa-fw ti-list"></i>  Bed Assign
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
                        <div class="panel-body">
                            <div class="col-md-10 ">
                                <form action="<?php echo base_url('ward/bed_assign/'. $patient->id); ?>" method="post" class="form-horizontal">
                                      <hr>
                                      <b class="text-center">
                                        <h3 class="panel-title"> 
                                           <i class="fa fa-fw ti-pencil"></i> Assign Bed
                                        </h3>
                                      </b>
                                      <hr>
                                    <input type="hidden" name="type" value="Walk in appointment" />
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="val-patientname">
                                            Patient Name
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="hidden" name="patient_id" value="<?php echo $patient->id; ?>">
                                            <input type="text" name="patient_name" class="form-control" placeholder="Enter Patient Name" value="<?php echo $patient->first_name, ' ', $patient->last_name; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                         <label class="col-md-4 control-label" for="department">
                                            Ward Type 
                                              <span class="text-danger">*</span>
                                         </label>
                                          <div class="col-md-6">
                                            <select id="ward_type" name="ward_type" class="form-control">
                                                <option value=""> Please select ward </option>
                                            <?php foreach($wards as $ward): ?>
                                                <option value="<?php echo $ward->id; ?>"><?php echo $ward->ward_name , ' ', ' (', ($ward->category), ')'; ?></option>
                                            <?php endforeach; ?>
                                            </select>
                                            <br>
                                                <div id="feedbackcheck"></div>
                                          </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="assign_date">
                                            Assign Date
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-sm-6">
                                            <div class="input-group ">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-fw ti-calendar"></i>
                                                </div>
                                                <input class="form-control" id="datetimepicker1" name="assign_date" size="40" placeholder="YYYY-MM-DD">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-4 control-label" for="description">
                                            Description
                                            <span class="text-danger">*</span>
                                        </label>
                                        <div class="col-md-6">
                                            <textarea id="description" name="description" rows="4" class="form-control resize_vertical" placeholder="Description... "></textarea>
                                        </div>
                                    </div>
                                    <br><br/>
                                    <div class="form-group form-actions">
                                        <div class="col-md-6 col-md-offset-5">
                                            <button type="submit" class="btn btn-effect-ripple btn-primary" id="btnBedAssign">Submit</button>
                                            <button type="reset" class="btn btn-effect-ripple btn-default reset_btn">Reset
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <script type="text/javascript">
                                        $(document).ready(function(){
                                            $('#btnBedAssign').on('click', function(){
                                                var ward = $('#ward').val();
                                                var datetime20 = $('#datetime20').val();
                                                var description = $('#description').val();

                                                if(ward == '' || datetime20 == '' || description == ''){
                                                    $('#ward,#datetime20,#description').css({
                                                            'border-color' : 'red',
                                                            'border-style' : 'solid',
                                                            'border-width' : '0.5px'
                                                    });
                                                        return false;
                                                } 

                                                return true;
                                            });

                                            $('#ward_type').on('change', function(){
                                                var data = $('#ward_type').val();
                                                $.post('<?php echo base_url();?>ward/check_avaliabilty', { id: data },
                                                  function(result){
                                                    // console.log(result);
                                                    $('#feedbackcheck').html(result).show();
                                                });
                                            });

                                        });
                                        
                                    </script>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
        <?php endforeach; ?>
        <!-- /.content -->
    </aside>
    <!-- /.right-side -->
</div>
<!-- global js -->
<div id="qn"></div>
<!-- end of global js -->
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
    $(document).ready(function(){
      var date_input=$('input[id="datetimepicker1"]'); //our date input has the name "date"
      var container=$('.row form-group').length>0 ? $('.row form-group').parent() : "body";
      var options={
        format: 'yyyy/mm/dd',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
</body>
</html>