<aside class="left-side sidebar-offcanvas">
        <!-- sidebar: style can be found in sidebar-->
        <section class="sidebar">
            <div id="menu" role="navigation">
                <div class="nav_profile">
                    <div class="media profile-left">
                        <a class="pull-left profile-thumb" href="#">
                            <img src="<?php echo base_url(); ?>assets/img/authors/36x36xavatar.jpg.pagespeed.ic.pYS-GhQje9.jpg" class="img-circle" alt="User Image"></a>
                        <div class="content-profile">
                            <h4 class="media-heading">Dr Freeman</h4>
                            <ul class="icon-list">
                               
                                <li>
                                    <a href="lockscreen.html">
                                        <i class="fa fa-fw ti-lock"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="edit_user.html">
                                        <i class="fa fa-fw ti-settings"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('staff/logout'); ?>">
                                        <i class="fa fa-fw ti-shift-right"></i>
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
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-pencil-alt"></i>
                                     Add Department
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Department
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
                            <i class="menu-icon ti-pencil-alt"></i>
                            <span>Appointments</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="<?php echo base_url('appointment/create'); ?>">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add an Appointment
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Appointment List
                                </a>
                            </li>
                        </ul>
                    </li>



                      <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-id-badge"></i>
                            <span>Doctors</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-pencil-alt"></i>
                                     Add Doctor
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Doctor
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
                            <i class="menu-icon ti-files"></i>
                            <span>Case Manager</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Create Case Note
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Case Note
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                    View ANC Case Note
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                    View Patient Case Summary
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
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Bed
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-list"></i>
                                     Bed List
                                </a>
                            </li>
                              <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Assign Bed
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
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
                    </li>



                  <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-credit-card"></i>
                            <span>Billing</span>
                         </a>
                    </li>




                  <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-shield"></i>
                            <span>Insurance</span>
                         </a>
                        <ul class="sub-menu">
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-marker-alt"></i>
                                     Add Insurance
                                </a>   
                            </li>
                            <li>
                                <a href="javascript:void(0)">
                                    <i class="fa fa-fw ti-eye"></i>
                                     View Insurance
                                </a>
                            </li>
                        </ul>
                    </li>



                  <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-agenda"></i>
                            <span>Report</span>
                         </a>
                    </li>




                  <li class="menu-dropdown">
                        <a href="javascript:void(0)">
                            <i class="menu-icon ti-settings"></i>
                            <span>Settings</span>
                         </a>
                  </li>

                      </ul>
                <!-- / .navigation --> </div>
            <!-- menu --> </section>
        <!-- /.sidebar --> </aside>