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
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title> <?php echo (get_ehm_title()) ? get_ehm_title() : 'EHM Dashboard' ; ?> </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link type="text/css" rel="stylesheet" href="<?php echo base_url(); ?>assets/css%2c_app.css%2bvendors%2c_bootstrap-table%2c_css%2c_bootstrap-table.min.css%2bcss%2c_custom.css.pagespeed.cc.7zClYA9zvj.css"/>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.4.7.0.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!-- <body onload="window.print();"> -->
  <body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <?php
            print_r($patient);
          ?>
          <img src="<?php echo base_url($get_settings->logo); ?>" alt="System Logo" class="img-circle"/> <?php echo $get_settings->title . '. ' ; ?>
          <small class="pull-right">Date: <?php echo date('d/m/Y'); ?></small>
        </h2> 
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong><?php echo $get_settings->title; ?></strong><br>
          <?php echo wordwrap($get_settings->address, 28, "<br />\n"); ?> <br />
          Phone: <?php echo $get_settings->mobile; ?><br>
          Email: <?php echo $get_settings->email; ?>
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
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
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice</b><br>
        <br>
        <b>Payment Due:</b> <?php echo get_date_format(); ?><br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th>Item Name</th>
            <th>Unit Cost</th>
            <th>Quantity</th>
            <th>Total (<?php echo get_local_currency(); ?>)</th>
          </tr>
          </thead>
          <tbody>

          <tr>
            <td></td>
          </tr>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">

        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          <ul>
            <li>An invoice must accompany products returned for warantty</li>
            <li>Balance due within 10 days of invoice date,1.5% interest/month thereafter.</li>
            <li>All goods returned for replacement/credit must be saleable condition with original
                  packaging.
            </li>
          </ul>
          <br />
          Issued by: 
        </p>
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <p class="lead">Amount Due </p>

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th style="width:50%">Subtotal:</th>
              <td></td>
            </tr>
            <tr>
              <th>Discount</th>
              <td></td>
            </tr>
            <tr>
              <th>Total:</th>
              <td></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
