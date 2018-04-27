<?php
$user_data = is_logged();
$get_settings = getsettingsdetails();
?>
<script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>

<script type="text/javascript">
    function checkNotification(){
        $.post('<?php echo base_url(); ?>welcome/check_notify',
         {
            task: 'notification check'
         }, 
         function(result){
            if(result == 'true'){
                $('#notifyId').hide();
            }else if(result == 'false'){
                $('#notifyId').show();
            }
        });
    }
</script>

<header class="header">
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="<?php echo base_url('welcome/dashboard'); ?>" class="logo">
            <!-- Add the class icon to your logo image or logo icon to add the margining -->
            <img src="<?php echo base_url(); ?><?php echo $get_settings->logo; ?>" alt="logo"/><b style="color: white">  EHM</b>
        </a>
        <!-- Header Navbar: style can be found in header-->
        <!-- Sidebar toggle button-->
        <!-- Sidebar toggle button-->
        <div>
            <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button"> <i class="fa fa-fw ti-menu"></i>
            </a>
        </div>
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li>
                    <div class="row">
                        <form action="<?php echo base_url('welcome/search'); ?>" method="get" role class="form-inline my-2 my-lg-0 mr-lg-2">
                            <div class="form-group">
                                <div class="col-sm-9" style="position: relative;">
                                    <input type="text" class="form-control input-sm" name="search_patient" style="position: relative;left:-50%;top:10px;width:155%;" placeholder="search for...">
                                </div>
                                <button type="submit" class="btn btn-icon btn-primary btn-sm" style="margin-top: 10px;margin-left:-8px;margin-bottom: -5px;"><i class="icon fa fa-fw ti-search" aria-hidden="true"></i></button>
                            </div>
                        </form>
                    </div>
                </li>
                <!-- <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-fw ti-bell"></i>
                        <span class="label label-success">2</span>
                    </a>
                </li> -->
                <!-- User Account: style can be found in dropdown-->
                
                <li>
                    <a href="#" class="dropdown-toggle toggle-right" data-toggle="dropdown">
                        <i class="fa fa-fw ti-view-list black"></i>
                        <span class="label label-success" id="notifyId" style="display: none;"><span class="label label-success label-mini pull-right"><b>New</b></span></span>

                    </a>
                </li>
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle padding-user" data-toggle="dropdown">
                        <img src="<?php echo base_url(); ?><?php echo $user_data->img_path; ?>" width="35" class="img-circle img-responsive pull-left" height="35" alt="User Image">
                        <div class="riot">
                            <div>
                                <?php echo $user_data->first_name, ' ', $user_data->last_name; ?>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>