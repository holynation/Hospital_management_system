<?php 
	if($id){
		$stateId = $id;
		$data = $this->Model_staff->check_lga($stateId)->result();

		if($data == NULL){
		 	echo '';
		}

		if(!$data){
		 	echo " ";
		}else{ ?>
		 	<!-- //print_r($data); -->
            <div class="form-group">
                <label class="col-md-4 control-label" for="val-lga">
                    LGA
                <span class="text-danger">*</span>
                </label>        
                <div class="col-md-6">
                    <select id="val-lga" name="lga" class="form-control">
                        <option value="">------ Select LGA ------</option>
                        <?php	foreach($data as $d){ ?>
                        <option value="<?php echo $d->local_name; ?>"> <?php echo $d->local_name; ?> </option>
                        <?php }?>
                    </select>
                </div>
            </div>

<?php  } } ?>