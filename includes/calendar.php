
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="img/favicon.ico"/>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <!-- global css -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/A.css%2c%2c_app.css%2bvendors%2c%2c_fullcalendar%2c%2c_css%2c%2c_fullcalendar.css%2cMcc.UiJmvK7HaD.css.pagespeed.cf.GbxSN3BXVE.css" rel="stylesheet"/>
    <!-- end of global css -->
    <!--page level css -->
    
    <link href="<?php echo base_url(); ?>assets/vendors/fullcalendar/css/A.fullcalendar.print.css.pagespeed.cf.FAJJJTFOoN.css" rel="stylesheet" media='print' type="text/css">
    <link href="<?php echo base_url(); ?>assets/A.vendors%2c%2c_iCheck%2c%2c_css%2c%2c_all.css%2bcss%2c%2c_custom.css%2cMcc.6serMRMs1h.css.pagespeed.cf.iXeewdnDOo.css" rel="stylesheet" type="text/css"/>
    
    <style id="skin">.skin-default .sidebar a{color:#808b9c;-webkit-font-smoothing:antialiased}.skin-default .icon-list li a:hover{background:#eee}@media screen and (min-width:550px){.skin-default .navbar .navbar-right>.nav{margin-right:15px}}</style>
    <link href="<?php echo base_url(); ?>assets/css/A.calendar_custom.css.pagespeed.cf.paH_K2wors.css" rel="stylesheet" type="text/css"/>
    <!--end of page level css-->
</head>

<body class="skin-default">
<div class="wrapper row-offcanvas row-offcanvas-left">
    <aside class="right-side">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-3">
                    <div class="box">
                        <div class="box-title">
                            <h3>Draggable Events</h3>
                            <div class="pull-right box-toolbar">
                                <a href="#" class="btn btn-link btn-xs" data-toggle="modal" data-target="#myModal">
                                    <i class="fa ti-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="box-body">
                            <div id='external-events'>
                                <div class='external-event palette-warning'>Team Out</div>
                                <div class='external-event palette-primary'>Product Seminar</div>
                                <div class='external-event palette-danger'>Client Meeting</div>
                                <div class='external-event palette-info'>Repeating Event</div>
                                <div class='external-event palette-success'>Anniversary Celebrations</div>
                                <p class="well no-border no-radius">
                                    <input type='checkbox' class="custom_icheck" id='drop-remove'/>
                                    <label for='drop-remove'>remove after drop</label>
                                </p>
                            </div>
                        </div>
                        <div class="box-footer">
                            <a href="#" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">Create
                                event</a>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <div class="col-md-9">
                    <div class="box">
                        <div class="box-body">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- Modal -->
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title" id="myModalLabel">
                                <i class="fa ti-plus icon-align"></i> Create Event
                            </h4>
                        </div>
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="text" id="new-event" class="form-control" placeholder="Event">
                                <div class="input-group-btn">
                                    <button type="button" id="color-chooser-btn" class="btn dropdown-toggle" data-toggle="dropdown">
                                        Select
                                        <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu pull-right" id="color-chooser">
                                        <li>
                                            <a class="palette-primary" href="#">Primary</a>
                                        </li>
                                        <li>
                                            <a class="palette-success" href="#">Success</a>
                                        </li>
                                        <li>
                                            <a class="palette-info" href="#">Info</a>
                                        </li>
                                        <li>
                                            <a class="palette-warning" href="#">warning</a>
                                        </li>
                                        <li>
                                            <a class="palette-danger" href="#">Danger</a>
                                        </li>
                                        <li>
                                            <a class="palette-default" href="#">Default</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- /btn-group -->
                            </div>
                            <!-- /input-group -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger pull-right" id="close_calendar_event" data-dismiss="modal">
                                Close
                                <i class="fa ti-close icon-align"></i>
                            </button>
                            <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                                <i class="fa ti-plus icon-align"></i> Add
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
        <!-- /.content -->
    </aside>
</div>
<!-- global js -->
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->
<script src="<?php echo base_url(); ?>assets/vendors/moment/js/moment.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/fullcalendar/js/fullcalendar.min.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/vendors/iCheck/js/icheck.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom_js/calendar_custom.js" type="text/javascript"></script>
<!-- end of page level js -->
</body>

</html>
