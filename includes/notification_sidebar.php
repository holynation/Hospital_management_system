<div id="right">
    <div id="right-slim">
        <div class="rightsidebar-right">
            <div class="rightsidebar-right-content">
                <div class="panel-tabs">
                    <ul class="nav nav-tabs nav-float" role="tablist">
                        <li class="active text-center">
                            <a href="#r_tab2" role="tab" data-toggle="tab"><i class="fa fa-fw ti-bell"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade in active" id="r_tab1">
                        <div id="slim_t1">
                            <h5 class="rightsidebar-right-heading text-uppercase text-xs">
                                <i class="fa fa-fw ti-list"></i>
                                Notice Board
                            </h5>
                            <div>
                                <ul class="list-unstyled">
                                    <?php 
                                        $notify = $this->Model_staff->get_notify();
                                        if($notify == 'no result'){ ?>
                                            <div class="alert alert-success col-sm-offset-3" style="padding-left:4.45%;width:50%;"><?php echo 'No notification yet...'; ?>
                                            </div>
                                        <?php }else{
                                        foreach($notify as $n):
                                    ?>
                                    <li class="rightsidebar-notification">
                                        <a href="#">
                                            <!-- <i class="fa ti-comments-smiley fa-fw text-primary"></i> -->
                                            <?php echo wordwrap($n->description,5);
                                                if($n->status == 'false'){ 
                                            ?>
                                            <span class="label label-success label-mini pull-right">New</span>
                                            <?php } ?>
                                        </a>
                                    </li>
                                    <hr/>
                                    <?php endforeach; } ?>
                                    <li class="text-right noti-footer"><a href="<?php echo base_url('welcome/notifyNotice'); ?>">View All Notice <i class="ti-arrow-right"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>