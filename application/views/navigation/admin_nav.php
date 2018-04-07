<?php
$user_data = is_logged();
if(!$user_data){
    redirect('/welcome/');
}
$get_settings = getsettingsdetails();
$name = get_user_role($user_data) . ' ' . $user_data->first_name;
$role = strtolower(get_user_role($user_data)); //this is the only place where i have use this function
?>
<!-- <div class="wrapper row-offcanvas row-offcanvas-left"> -->
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="#">
                            <img src="<?php echo base_url(); ?><?php echo $user_data->img_path; ?>" class="img-circle" alt="User Image">
                        </a>
                        <div class="content-profile">
                            <h4 class="media-heading"><?php echo $name; ?></h4>
                            <ul class="icon-list">
                                <!-- <li>
                                    <a href="lockscreen.html">
                                        <i class="fa fa-fw ti-lock"></i>
                                    </a>
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url('welcome/edit_user'); ?>">
                                        <i class="fa fa-fw ti-settings" title="edit user"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('staff/logout'); ?>">
                                        <i class="fa fa-fw ti-shift-right" title="logout"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <ul class="navigation"> 
                    <li class="active" id="active">
                        <a href="<?php echo base_url('welcome/dashboard'); ?>">
                            <i class="menu-icon ti-desktop"></i>
                            <span class="mm-text ">Dashboard</span>
                        </a>
                    </li>
                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-menu"></i>
                            <span>Departments</span>
                         </a>
                        <ul class="sub-menu">
                            <?php //if($role == 'admin' || $role =='doctor'): ?>
                            <li>
                                <a href="<?php echo base_url('department/create'); ?>">
                                    <i class="fa fa-fw ti-pencil-alt"></i>
                                     Add Department
                                </a>   
                            </li>
                            <?php //endif; ?>
                            <li>
                                <a href="<?php echo base_url('department/view_department'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Department
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-layout-list-thumb"></i>
                            <span>Staff Directory</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('staff/add_staff'); ?>">
                                    <i class="fa fa-fw ti-pencil-alt"></i>
                                     Add New Staff
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('staff/view_staff'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View All Staffs
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-user"></i>
                            <span>Patients</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('patient/add_patient'); ?>">
                                    <i class="fa fa-fw ti-pencil-alt"></i>
                                     Add Patient
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('patient/view_patient'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Patient
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-calendar"></i>
                            <span>Schedule</span>
                         </a>
                        <ul class="sub-menu">
                            <?php if($role == 'admin' || $role == 'doctor'): ?>
                            <li>
                                <a href="<?php echo base_url('schedule/create'); ?>">
                                    <i class="fa fa-fw ti-pencil-alt"></i>
                                     Add Schedule
                                </a>   
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php echo base_url('schedule/view_schedule'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     Schedule List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-pencil-alt"></i>
                            <span>Appointments</span>
                         </a>
                        <ul class="sub-menu">
                            <!-- <li>
                                <a href="<?php //echo base_url('appointment/create'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add an Appointment
                                </a>   
                            </li> -->
                            <li>
                                <a href="<?php echo base_url('appointment/view_appoint') ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Appointment List
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="menu-dropdown">
                            <a href="javascript:void(0)">
                                <i class="menu-icon ti-files"></i>
                                <span>Case Manager</span>
                             </a>
                            <ul class="sub-menu">
                           <!--      <li>
                                    <a href="<?php echo base_url('casenote/add_casenote') ?>">
                                        <i class="fa fa-fw ti-marker-alt"></i>
                                         Create Case Note
                                    </a>   
                                </li> -->
                                <li>
                                    <a href="<?php echo base_url('casenote/view_casenote') ?>">
                                        <i class="fa fa-fw ti-eye"></i>
                                         View Case Note
                                    </a>
                                </li>
                            </ul>
                    </li>

                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-notepad"></i>
                            <span>Bed/Ward Management</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('ward/create'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Ward
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('ward/view_ward'); ?>">
                                    <i class="fa fa-fw ti-list"></i>
                                     Ward List
                                </a>
                            </li>
                              <!-- <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Assign Bed
                                </a>   
                            </li> -->
                            <li>
                                <a href="<?php echo base_url('ward/view_bed_assign'); ?>">
                                    <i class="fa fa-fw ti-list"></i>
                                     Bed Assign List
                                </a>
                            </li>
                        </ul>
                    </li>

                  <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-support"></i>
                            <span>Pharmacy</span>
                         </a>
                         <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('pharmacy/pos'); ?>">
                                    <i class="fa fa-fw ti-money"></i>
                                    POS
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharmacy/view_medicine_sold'); ?>">
                                    <i class="fa fa-fw ti-money"></i>
                                    Medicine Sold 
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharmacy/createMedicine'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Medicine
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharmacy/view_medicine'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Medicine
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharmacy/createCategory'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Category
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('pharmacy/view_category'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Category
                                </a>
                            </li>
                        </ul>
                    </li>

                    <!-- <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-credit-card"></i>
                            <span>Billing</span>
                         </a>
                    </li> -->

                <?php if($role == 'admin'):  ?>
                  <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-shield"></i>
                            <span>Insurance</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('insurance/create_package'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Package
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('insurance/create_Nhis'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add NHIS Package
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('insurance/view_package'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Insurance
                                </a>
                            </li>
                        </ul>
                    </li>
                <?php endif; ?>

                  <!-- <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-agenda"></i>
                            <span>Report</span>
                         </a>
                    </li> -->

                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-write"></i>
                            <span>Role</span>
                         </a>
                        <ul class="sub-menu">
                            <?php if(strtolower($role) == 'admin'):  ?>
                            <li>
                                <a href="<?php echo base_url('role/create'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Create Role
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('staff/role'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Assign Role
                                </a>   
                            </li>
                            <?php endif; ?>
                            <li>
                                <a href="<?php  echo base_url('role/view_role'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View all Role
                                </a>   
                            </li>
                        </ul>
                    </li>
                <?php if($role == 'admin'): ?>    
                    <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-bell"></i>
                            <span>Noticeboard</span>
                         </a>
                         <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('welcome/noticeboard'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Notice
                                </a>   
                            </li>
                            <li>
                                <a href="<?php echo base_url('welcome/view_noticeboard'); ?>">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Notice
                                </a>   
                            </li>
                         </ul>
                  </li>
                  <li class="menu-dropdown">
                        <a href="<?php echo base_url('welcome/settings'); ?>">
                            <i class="menu-icon ti-settings"></i>
                            <span>Settings</span>
                         </a>
                  </li>
                <?php endif; ?>
                  <li>
                      <a href="<?php echo base_url('staff/logout'); ?>">
                        <i class="menu-icon fa fa-fw ti-shift-right" title="logout"></i>
                        <span>Logout</span>
                    </a>
                  </li>

                </ul>
                <!-- / .navigation --> 
            </div>
            <!-- menu --> 
        </section>
        <!-- /.sidebar -->
    </aside>
  


