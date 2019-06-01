<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url('ca_assets/images/favicon.ico')?>">

    <title>Reminder</title>
  
	<!-- Bootstrap 4.0-->
	<link rel="stylesheet" href="<?php echo base_url('ca_assets/assets/vendor_components/bootstrap/dist/css/bootstrap.min.css')?>">
	
	<!-- Bootstrap extend-->
	<link rel="stylesheet" href="<?php echo base_url('ca_assets/css/bootstrap-extend.css')?>">
	
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url('ca_assets/css/master_style.css')?>">

	<!-- Superieur Admin skins -->
	<link rel="stylesheet" href="<?php echo base_url('ca_assets/css/skins/_all-skins.css')?>">	
     <link rel="stylesheet" href="<?php echo base_url('ca_assets/css/iziToast.min.css')?>">
  <script src="<?php echo base_url('ca_assets/js/iziToast.min.js')?>" type="text/javascript"></script>
	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>
<body class="hold-transition bg-img" style="background-image: url(<?php echo base_url('ca_assets/images/gallery/full/6.jpg')?>" data-overlay="4">
	<style>.auth-2 {
    width: 426px;
    margin: 0;
    padding: 7% 30px;
    float: right;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.6);
    overflow-y: scroll;
    color: #ffffff;
}</style>
	<div class="auth-2-outer row align-items-center h-p100 m-0">
		<div class="auth-2">
		  <div class="auth-logo font-size-40">
			<a href="index.html" class="text-white"><b>Otp </b>Verification</a>
		  </div>
		  <!-- /.login-logo -->
		  <div class="auth-body">			
            <p class="auth-msg"><h3><?php echo $this->session->flashdata('msg'); ?></h3> </p>

			<form action="<?php echo base_url('review/verify')?>"  method="post" class="form-element">
			  <div class="form-group has-feedback">
				<input type="text" class="form-control" name="otp" placeholder="Enter Your Otp Here..." required>
				<span class="ion ion-person form-control-feedback "></span>
			  </div>
			  
			  <div class="row">
				<!--<div class="col-12">-->
				<!--  <div class="checkbox">-->
				<!--	<input type="checkbox" id="basic_checkbox_1" >-->
				<!--	<label for="basic_checkbox_1">I agree to the <a href="auth_register2.html#" class="text-danger"><b>Terms</b></a></label>-->
				<!--  </div>-->
				<!--</div>-->
				<!-- /.col -->
				<div class="col-12 text-center">
				  <button type="submit" name="verify_otp" class="btn btn-block mt-10 btn-success">Submit</button>
				</div>
				<!-- /.col -->
			  </div>
			</form>

			<!--<div class="text-center text-white">-->
			<!--  <p class="mt-50">- Sign With -</p>-->
			<!--  <p class="gap-items-2 mb-20">-->
			<!--	  <a class="btn btn-social-icon btn-outline btn-white" href="auth_register2.html#"><i class="fa fa-facebook"></i></a>-->
			<!--	  <a class="btn btn-social-icon btn-outline btn-white" href="auth_register2.html#"><i class="fa fa-twitter"></i></a>-->
			<!--	  <a class="btn btn-social-icon btn-outline btn-white" href="auth_register2.html#"><i class="fa fa-google-plus"></i></a>-->
			<!--	  <a class="btn btn-social-icon btn-outline btn-white" href="auth_register2.html#"><i class="fa fa-instagram"></i></a>-->
			<!--	</p>	-->
			<!--</div>-->
			<!-- /.social-auth-links -->

			<div class="margin-top-30 text-center">
				<!--<p>Already have an account? <a href="index.php" class="text-info m-l-5">Sign In</a></p>-->
			</div>

		  </div>
		</div>
	
	</div>
	

	<!-- jQuery 3 -->
	<script src="<?php echo base_url('ca_assets/assets/vendor_components/jquery-3.3.1/jquery-3.3.1.js')?>"></script>
	
	<!-- popper -->
	<script src="<?php echo base_url('ca_assets/assets/vendor_components/popper/dist/popper.min.js')?>"></script>
	
	<!-- Bootstrap 4.0-->
	<script src="<?php echo base_url('ca_assets/assets/vendor_components/bootstrap/dist/js/bootstrap.min.js')?>"></script>
</body>
</html>