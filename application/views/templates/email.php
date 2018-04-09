<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8" />

  <title>Technode Solutions - EHM mail</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <style type="text/css">

  		.container{
  			padding-right: 15px;padding-left: 15px;margin-right: auto;margin-left: auto;
  		}
  		.box-container{
  			font-family : 'Open Sans', sans-serif;
  			background   : radial-gradient(ellipse at center, #fff 0%, #d0d0d0 100%);
  			position: absolute;
		    z-index: -1;
		    top: 0;
		    bottom: 0;
		    background-repeat: no-repeat;
		    background-size: auto;
		    margin:20px 20%;
		    opacity:.951;
  			padding : 40px 15px;
		    margin-bottom: 10px;
  		}
  		@media (min-width: 768px) {
		  .container {
		    width: 750px;
		  }
		}
		@media (min-width: 992px) {
		  .container {
		    width: 970px;
		  }
		}
		@media (min-width: 1200px) {
		  .container {
		    width: 1170px;
		  }
		}

  </style>

</head>

<body class="container">
	
<div class="box-container">
	<div class="box" style="background: #fff;margin:10px 20%;padding:20px;width:55%;text-align: center;">
		<div style="font-size: 26px;font-weight: 700;letter-spacing: -0.02em;line-height: 32px;color: #41637e;font-family: sans-serif;text-align: center" align="center" id="emb-email-header">EHM</div>
		<br />
		<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Hey <em> <?php echo $name;?> </em>,</p>

		<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> We want to help you reset your password! Please <i><a href="<?php echo base_url('welcome/reset_password_form/'. $email . '/' . $email_code); ?>">click here</a></i> to reset your password. </p>

	<!-- <a href="<?php echo base_url('welcome/reset_password_form/'. $email . '/' . $email_code); ?>"></a> -->

		<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px"> We are your friend , Technode Solutions. This email is sent from our software as per resetting your password. </p>
		<p style="Margin-top: 0;color: #565656;font-family: Georgia,serif;font-size: 16px;line-height: 25px;Margin-bottom: 25px">Thank you!</p>
	</div>
</div>

</body>

</html>