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
    <title> <?php echo $get_settings->title; ?> | <?php if($user_data->status == 'success'){ echo $user_data->role; }else{ echo ' ';} ?> Dashboard </title>
       <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.ico"/>
  <!-- global css -->
    <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css/A.app.css%2bcustom.css%2cMcc.Wh3kTlK9Vt.css.pagespeed.cf.Vq3xvtuJ3i.css"/>

  <!-- end of global css -->
    
    <style>.invoice_bg{margin:15px 0 30px;padding:20px}.table{border:1px solid #ccc;table-layout:fixed}.table tbody>tr{height:50px}.table-responsive{width:100%}td,th{width:40px;word-wrap:break-word}.terms_conditions{list-style:initial}.table-condensed>thead>tr>th{padding:15px 8px;width:80px}.table-condensed>thead>tr>th:first-child{width:180px}.table-responsive>.table>tbody>tr>td,.table-responsive>.table>tfoot>tr>td{padding:15px 8px;white-space:normal}#add_row i,.row_delete i{cursor:pointer}@media print{.btn-section,.left-side,.no-print,.content-header,.header,#customtable tr>td:last-child,#customtable tr>th:last-child{display:none}.table-responsive{display:inline-table;width:100%}#invoice-stmt{width:100%}.right-side{margin-left:0}}</style>
    <!--end of page level css-->
    
     <link href="<?php echo base_url() ; ?>assets/css/buttons_sass.css" rel="stylesheet">
     <script src="<?php echo base_url(); ?>assets/js/ajax_jquery.js"></script>
    <!--end of page level css-->
    
</head>
<body class="skin-default">
 --><!-- header logo: style can be found in header-->
<?php include 'includes/static-header.php'; ?>

<div class="wrapper row-offcanvas row-offcanvas-left">
    <!-- Left side column. contains the logo and sidebar -->
    <?php $this->load->view('navigation/admin_nav'); ?>
   <aside class="right-side">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Point Of Sales
            </h1>
            <ol class="breadcrumb">
                <li>
                    <a href="<?php echo base_url('welcome/dashboard'); ?>">
                        <i class="fa fa-fw ti-home"></i> Dashboard
                    </a>
                </li>
                <li><a href="#"> Pharmacy</a></li>
                <li class="active">
                   Medicine Invoice
                </li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content p-l-r-15" id="invoice-stmt">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="fa fa-fw ti-credit-card"></i> Invoice
                    </h3>
                </div>
                <div class="panel-body">
                    <form action="<?php echo base_url('pharmacy/final_order'); ?>" method="POST">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6 col-sm-12 col-xs-12 invoice_bg">
                                <h4><img src="<?php echo base_url($get_settings->logo); ?>" alt="System logo"/></h4>
                                <h4><strong>Billing Details:</strong></h4>
                                <address>
                                    <?php echo $get_settings->title; ?>
                                    <br/> <strong>Phone:</strong><?php //echo $get_settings->mobile; ?>
                                    <br/> <strong>Mail Id:</strong><?php //echo $get_settings->email; ?>
                                </address>
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12 invoice_bg text-right">
                                <div class="pull-right">
                                     <!-- i wanna use the patient id in the rand generatiom -->
                                    <h4><strong>#<?php echo rand(11,1111222); ?> /
                                     <?php $this->load->library('dateCreate');
                                        echo dateCreate::dateFormat(date('Y-m-d H:i:s'));
                                    ?>
                                     </strong></h4>
                                    <h4><strong>Invoice Info:</strong></h4>
                                    <address>
                                        <?php
                                            if(isset($patient_id)):
                                        ?>
                                        <?php $patient_info = $this->Model_patient->get_patient_by_id($patient_id); ?>
                                        <?php echo $patient_info->first_name, ' ', $patient_info->last_name; ?>
                                        <br/> <strong>Phone:</strong> <?php echo $patient_info->phone_no; ?>
                                        <br/> <strong>Mail Id:</strong> <?php echo $patient_info->email; ?>
                                        <?php endif; ?>
                                    </address>
                                    <span></span>
                                </div>
                            </div>
                        </div>
                        <?php 
                            if($this->session->userdata()){
                                $item_total = 0;
                            }
                        ?>
                        <div class="col-md-12">
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
                                        <th class="text-center" id="add_row"></th>
                                        
                                    </tr>
                                    </thead>
                                    
                                    <tbody>
                                    <?php 
                                    foreach($this->session->userdata('cart') as $cart){
                                        foreach($cart as $b){
                                     ?>
                                       <tr>
                                           <td><?php echo $b[0]; ?></td>
                                           <td><?php echo $b[1]; ?></td>
                                           <td class="text-center"><?php echo $b[2]; ?></td>
                                           <input type="hidden" name="quantity[]" value="<?php echo $b[2]; ?>" />
                                           <td></td>
                                           <td class="text-right"><?php echo $b[1] * $b[2]; ?></td>
                                           <td class="text-center row_delete">
                                                <!-- <i onclick="removeMedicine(<?php //echo $b[3]; ?>);" class="fa fa-fw ti-close"></i> -->
                                            </td>
                                            <script type="text/javascript">
                                                function removeMedicine(id){
                                                    var id = $.trim(id);
                                                    
                                                    $.post('<?php echo base_url('pharmacy/search_key_item'); ?>', {id:id},
                                                            function(result){
                                                                alert(result);
                                                                window.location.reload();
                                                            }
                                                        );
                                                }
                                            </script>
                                       </tr>

                                       <?php $item_total += ($b[1]*$b[2]);  } }  ?>
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
                                            <strong><input type="text" class="form-control" id="initialTotal" value="<?php echo $item_total; ?>" disabled></strong>
                                        </td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow"></td>
                                        <td class="emptyrow text-center"></td>
                                        <td class="emptyrow text-right">
                                            <strong>
                                                Discount: &nbsp;
                                            </strong>
                                        </td>
                                        <td class="highrow text-right">
                                            <strong contenteditable><input type="text" id="itemDiscount" class="form-control" name="itemDiscount" autocomplete="off"></strong>
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
                                            <strong id="finalTotal"><?php echo "&#8358;". $item_total; ?></strong>
                                            <input type="hidden" name="final_total" id="final_total" value="<?php echo $item_total; ?>">
                                            <input type="hidden" name="patient_id" value="<?php echo $patient_id; ?>">
                                        </td>
                                        <td></td>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <?php foreach($medicine_id as $m_id): ?>
                            <input type="hidden" name="medicine_id[]" value="<?php echo $m_id; ?>">
                        <?php endforeach; ?>
                        <div class="col-md-12">
                            <h4><Strong>Terms and conditions:</Strong></h4>
                            <ul class="terms_conditions">
                                <li>An invoice must accompany products returned for warantty</li>
                                <li>Balance due within 10 days of invoice date,1.5% interest/month thereafter.</li>
                                <li>All goods returned for replacement/credit must be saleable condition with original
                                    packaging.
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="btn-section">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <span class="pull-right">
                                <button type="submit" class="btn btn-responsive button-alignment btn-success" name="btnSubmitOrder">
                                    <i class=""><?php get_local_currency(); ?></i> Pay Now
                                </button>
                                 <button type="button" class="btn btn-responsive button-alignment btn-primary" data-toggle="button">
                                    <span style="color:#fff;" onclick="javascript:window.print();">
                                        <i class="fa fa-fw ti-printer"></i>
                                        Print
                                    </span>
                                </button>
                            </span>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <div class="background-overlay"></div>
        </section>
    </aside>
    <!-- /.right-side -->
</div>

<script type="text/javascript" src="<?php echo base_url() ; ?>assets/vendors/Buttons/js/buttons.js"></script>

    <!--end of page level css-->
<!-- global js -->
<div id="qn"></div>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script> 
<script src="<?php echo base_url(); ?>assets/js/app.js" type="text/javascript"></script>
<!-- end of global js -->
<!-- begining of page level js -->

<!-- end of page level js -->
<script type="text/javascript">
    $(document).ready(function(){
        $('#itemDiscount').keyup(function(){
            var discount = '';
            discount =  $.trim($(this).val());
            if(discount == null){
                discount = 0;
            }
            var initialTotal = $('#initialTotal').val();
            var finalTotal = $('#finalTotal');
            var hiddentotal = $('#final_total');
            
            var discountTotal = (initialTotal - discount);
            finalTotal.html("&#8358;" + discountTotal);
            hiddentotal.val(discountTotal);
        });

        // $("#customtable").on("click",".row_delete a",function(){
        //     $(this).closest("tr").remove();
        // });
    });
   
</script>

</body>
</html>








