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
            <div class="col-sm-12">
                    <?php foreach($result as $re): ?>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            Name :
                        </label>
                        <div class="col-sm-7">
                            <?php echo $re->name; ?>
                            <input type="hidden" name="medicine_name[]" id="medicine_name[]" value="<?php echo $re->name; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            Company :
                        </label>
                        <div class="col-sm-7">
                            <?php echo $re->company; ?>
                            <input type="hidden" name="medicine_company[]" id="medicine_company[]" value="<?php echo $re->company; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            Price :
                        </label>
                        <div class="col-sm-7">
                             <?php echo $re->selling_price; ?>
                            <input type="hidden" id="price_<?php echo $re->id; ?>" value="<?php echo $re->selling_price; ?>" />
                            <input type="hidden" name="medicine_price[]" id="medicine_price[]" value="<?php echo $re->selling_price; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            Current Stock :
                        </label>
                        <div class="col-sm-7">
                            <div name="dbstock"><?php echo $re->quantity; ?></div>
                            <input type="hidden" name="medicine_stock[]" id="medicine_stock[]" value="<?php echo $re->quantity; ?>" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-5 control-label">
                            Quantity :
                        </label>
                        <div class="col-sm-7">
                            <input type="text" name="medicine_quantity[]" id="medicine_quantity" value="1" class="form-control" autocomplete="off">
                        </div>
                        <input type="hidden" id="hidden_<?php echo $re->id; ?>" name="medicineId[]" value="<?php echo $re->id; ?>"/>
                        <input type="hidden" name="patientId" value="<?php echo $patient_id; ?>"/>
                    </div>

                    <hr />
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
                            <button type="submit" class="btn btn-responsive button-alignment btn-primary" name="btnMedicineOrder">
                                <i class="fa fa-fw ti-money"></i> Submit
                            </button>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</form>

            <!-- <div class="modal fade" id="quantity" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="" method="post">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h4 class="modal-title custom_align" id="Heading5"><i class="icon fa fa-fw ti-pencil" aria-hidden="true"></i> Invoice Preview </h4>
                        </div>
                        <div class="modal-body">
                            <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-condensed" id="customtable">
                                    <thead>
                                    <tr class="bg-primary">
                                        <th>
                                            <strong>Item Name</strong>
                                        </th>
                                        <th>
                                            <strong>Unit Cost</strong>
                                        </th>
                                        <th class="text-center">
                                            <strong>
                                                Quantity
                                            </strong>
                                        </th>
                                        <th></th>
                                        <th class="text-right">
                                            <strong>Total</strong>
                                        </th>
                                        <th class="text-center" id="add_row"><i class="fa fa-fw ti-plus"></i></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td contenteditable>
                                            Samsung Galaxy Grand
                                        </td>
                                        <td contenteditable>$700</td>
                                        <td class="text-center" contenteditable>1</td>
                                        <td></td>
                                        <td class="text-right" contenteditable>$700</td>
                                    </tr>
                                    <tr>
                                        <td contenteditable>
                                            Samsung Galaxy Core
                                        </td>
                                        <td contenteditable>$1110</td>
                                        <td class="text-center" contenteditable>1</td>
                                        <td></td>
                                        <td class="text-right" contenteditable>$1110</td>
                                    </tr>
                                    <tr>
                                        <td contenteditable>
                                            Screen Protector
                                        </td>
                                        <td contenteditable>$7</td>
                                        <td class="text-center" contenteditable>4</td>
                                        <td></td>
                                        <td class="text-right" contenteditable>$28</td>
                                    </tr>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td class="highrow"></td>
                                        <td class="highrow"></td>
                                        <td class="highrow text-center"></td>
                                        <td class="highrow text-right">
                                            <strong>
                                                Sub Total: &nbsp;
                                            </strong>
                                        </td>
                                        <td class="highrow text-right">
                                            <strong contenteditable>$1838</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"></td>
                                        <td class="emptyrow text-right">
                                            <strong>
                                                Vat: &nbsp;
                                            </strong>
                                        </td>
                                        <td class="highrow text-right">
                                            <strong contenteditable>$20</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow">
                                            <i class="livicon" data-name="barcode" data-size="60" data-loop="true"></i>
                                        </td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"></td>
                                        <td class="emptyrow text-right">
                                            <strong>
                                                Total: &nbsp;
                                            </strong>
                                        </td>
                                        <td class="highrow text-right">
                                            <strong contenteditable>$1858</strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        </div>
                        <div class="modal-footer">
                            <button type="click" class="btn btn-success" data-dismiss="modal">
                                <span class="glyphicon glyphicon-ok-sign"></span> Check Out
                            </button>
                            <button type="button" class="btn btn-warning" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span> No
                            </button>
                        </div>
                        </form>
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            <!-- </div> -->