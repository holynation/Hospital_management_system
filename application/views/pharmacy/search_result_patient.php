
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
                                        if($search_result == null){ ?>
                                            <div class="alert alert-warning"> You didn't search for any patient... </div>
                                        <?php  }
                                        else if($search_result == 'no result'){ ?>
                                            <div class="alert alert-danger"> No patient found... </div>
                                        <?php }else{ ?>

                                        <?php  
                                        $i = 1;
                                        foreach($search_result as $result):   ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $i;$i++; ?></td>
                                            <td><?php echo $result->patient_id; ?></td>
                                            <td><?php echo $result->first_name . ' '. $result->last_name. ' ' .$result->middle_name;  ?></td>
                                            <td><?php echo $result->gender; ?></td>
                                            <td><?php echo $result->phone_no; ?></td>
                                            <td><?php echo $result->email; ?></td>
                                            <td><?php echo $result->address; ?></td>
                                            <td><a class="btn btn-info" href="<?php echo base_url('pharmacy/administer/'. $result->id); ?>">Administer Drug</a></td>
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

