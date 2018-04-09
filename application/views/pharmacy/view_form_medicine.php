<?php
$user_data = is_logged();
if(!$user_data){
    redirect('/welcome/');
} ?>
<form action="<?php echo base_url('pharmacy/medicine_order'); ?>" method="post" class="form-horizontal">
<div class="col-sm-4">
    <div class="panel">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa ti-list" aria-hidden="true"></i> Selected Drugs
            </h3>
        </div>
        <div class="panel-body">
            <div class="box-body">
                <div class="form-group">
                    <p id="select_value"><strong>
                        <?php 
                            $name = '';
                        foreach($result as $r): ?>
                    	   <?php $name .=  ',' .$r->name; ?>
                        <?php endforeach; ?>
                        <?php echo substr($name,1); ?>
                    </strong></p>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel ">
        <div class="panel-heading">
            <h3 class="panel-title">
                <i class="fa ti-list" aria-hidden="true"></i> Selected Item
            </h3>
        </div>
        <div class="panel-body">
            <div class="col-lg-12 col-sm-12 col-md-12">
                    <?php foreach($result as $re): ?>
                    <div class="form-group">
                        <label class="col-lg-5 col-sm-5 col-md-5 control-label">
                            Name :
                        </label>
                        <div class="col-sm-7">
                            <?php echo $re->name; ?>
                            <input type="hidden" name="medicine_name[]" id="medicine_name[]" value="<?php echo $re->name; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 col-sm-5 col-md-5 control-label">
                            Company :
                        </label>
                        <div class="col-sm-7">
                            <?php echo $re->company; ?>
                            <input type="hidden" name="medicine_company[]" id="medicine_company[]" value="<?php echo $re->company; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 col-sm-5 col-md-5 control-label">
                            Price :
                        </label>
                        <div class="col-sm-7">
                             <?php echo $re->selling_price; ?>
                            <input type="hidden" id="price_<?php echo $re->id; ?>" value="<?php echo $re->selling_price; ?>" />
                            <input type="hidden" name="medicine_price[]" id="medicine_price[]" value="<?php echo $re->selling_price; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 col-sm-5 col-md-5 control-label">
                            Current Stock :
                        </label>
                        <div class="col-sm-7">
                            <div name="dbstock"><?php echo $re->quantity; ?></div>
                            <input type="hidden" name="medicine_stock[]" id="medicine_stock[]" value="<?php echo $re->quantity; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-5 col-sm-5 col-md-5 control-label">
                            Quantity :
                        </label>
                        <div id="stockFeeds_<?php echo $re->id; ?>"></div><br>
                        <div class="col-sm-7">
                            <input type="text" name="medicine_quantity[]" id="medicine_quantity_<?php echo $re->id; ?>" value="1" class="form-control" autocomplete="off">
                        </div>
                        <input type="hidden" id="hidden_<?php echo $re->id; ?>" name="medicineId[]" value="<?php echo $re->id; ?>"/>
                        <input type="hidden" name="patientId" value="<?php echo $patient_id; ?>"/>
                    </div>

                    <hr />
                    <script type="text/javascript">
                        $(document).ready(function(){
                            $('#medicine_quantity_<?php echo $re->id; ?>').keyup(function(){
                                var quantity = $.trim($(this).val()),
                                    id = $('#hidden_<?php echo $re->id; ?>').val();
                                if(quantity == null){
                                    return false;
                                }

                                $.ajax({
                                    url: '<?php echo base_url('pharmacy/check_stock'); ?>',
                                    type: 'post',
                                    cache: false,
                                    data: {
                                        task: 'check_stock',
                                        id: id,
                                        quantity: quantity
                                    },
                                    success: function(result){      
                                        $('#stockFeeds_<?php echo $re->id; ?>').html(result);
                                    }
                                });
                            }); 
                        });
                    </script>
                    <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
<div class="col-sm-4">
    <div class="panel">
        <div class="panel-body">
            <div class="col-sm-12">
                <div class="clearfix"></div>
                <div class="btn-section">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <span class="center">
                            <button type="submit" class="btn btn-responsive button-alignment btn-primary" name="btnMedicineOrder"> Submit
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>