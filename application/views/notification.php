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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/A.vendors%2c%2c_animate%2c%2c_animate.min.css%2bcss%2c%2c_timeline.css%2cMcc.ReTYUCJp7a.css.pagespeed.cf.qE8YFaQB7_.css"/>
    
    <!--end of page level css-->
    <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
</head>

<body class="skin-default">
<!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">

    <?php $this->load->view('navigation/admin_nav'); ?>
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
                <div class="col-md-7 col-sm-offset-2 timeline_panel">
                    <div class="panel ">
                        <div class="panel-heading">
                            <h3 class="panel-title">
                                <i class="fa fa-fw ti-time"></i> Notifications
                            </h3>
                            <span class="pull-right">
                                <i class="fa fa-fw ti-angle-up clickable"></i>
                                <i class="fa fa-fw ti-close removepanel clickable"></i>
                            </span>
                        </div>
                        <div class="panel-body">
                            <!--timeline-->
                            <div>
                                <ul class="timeline-update">
                                    <!-- this is for notice board section -->
                                    <?php 
                                        $table = '';
                                        $table_id = '';
                                        foreach($notification as $notify):
                                            $json_data = $notify->foreign_table_id;
                                            $json_data = json_decode($json_data);
                                            // print_r($json_data);
                                            $table = $json_data->table;
                                            $table_id = $json_data->id;

                                            if($table == 'notice_board'){
                                                $notices = $this->Model_staff->get_general_by_id($table,$table_id);
                                                if($notices == 'no result'){
                                                    die('No results found from notice Board...');
                                                }

                                                foreach($notices as $notice): ?>
                                                <li id="noticeList<?php echo $notify->id; ?>">
                                                    <div class="timeline-badge center">
                                                        <i class="fa fa-fw ti-bell fa-2x" style="color:skyblue;"></i>
                                                    </div>
                                                    <div class="timeline-panel" style="display:inline-block;">
                                                        <div class="timeline-heading">
                                                            <h4 class="timeline-title"><?php echo $notice->title; ?> </h4>
                                                            <p>
                                                                <small class="text-default-gray"><?php
                                                                    // $this->load->library('dateCreate');
                                                                    echo dateCreate::timeAgo($notify->date_created);
                                                                 ?></small>
                                                            </p>
                                                        </div>
                                                        <div class="timeline-body">
                                                            <p>
                                                                <?php echo wordwrap($notice->description, 50, "<br />\n"); ?>
                                                                <br />
                                                                <?php if($notice->start_date){
                                                                    echo "<b>Start:</b> " . dateCreate::dateFormat($notice->start_date);
                                                                }
                                                                 echo "<br />";
                                                                if($notice->end_date){
                                                                    echo "<b>End:</b> " . dateCreate::dateFormat($notice->end_date); 
                                                                }

                                                                ?>
                                                            </p>    
                                                        </div>
                                                    </div>
                                                </li>
                                                <script type="text/javascript">
                                                    $('.timeline-update #noticeList<?php echo $notify->id; ?> .timeline-panel').on('mouseleave', function(){
                                                        var id = '<?php echo $notify->id; ?>';

                                                        $.post('<?php echo base_url();?>welcome/update_notify_status/' + id, 
                                                            {
                                                                task: 'Update Status',
                                                                notification_id: id
                                                            },
                                                            function(result){
                                                                // console.log('status change...');
                                                        });
                                                    });
                                                </script>
                                         <?php  endforeach; } ?>
                                    
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <!--timeline ends-->
                        </div>
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
<script src="<?php echo base_url(); ?>assets/vendors/wow%2c_js%2c_wow.min.js%2badvanced_newsTicker%2c_js%2c_newsTicker.js.pagespeed.jc.TQnAnqcAda.js"></script><script>eval(mod_pagespeed_R4JiAJwt5S);</script>
<script>eval(mod_pagespeed_Xt7vQBy9oO);</script>
<script type="text/javascript">//<![CDATA[
"use strict";$(document).ready(function(){new WOW().init();if($('.timeline-update').length>0){$('.timeline-update').newsTicker({row_height:120,max_rows:3,speed:2000,direction:'up',duration:3500,autostart:1,pauseOnHover:1});}});
//]]></script>
<!-- end of page level js -->
</body>
</html>
