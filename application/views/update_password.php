<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>

<body class="hold-transition bg-img" style="background-image: url('<?php echo base_url('#')?>" data-overlay="4">

	<div class="container h-p100">
		<div class="row align-items-center justify-content-md-center h-p100">
			<div class="col-12">
				<div class="row no-gutters justify-content-md-center">
					<div class="col-lg-4 col-md-5 col-12">
						<div class="content-top-agile h-p100">
							<h2>Enter Password to update</h2>
						</div>
					</div>
					<div class="col-lg-5 col-md-5 col-12">
						<div class="p-40 bg-white content-bottom">
						    <p class="auth-msg"><h3><?php echo $this->session->flashdata('success_msg'); ?></h3> </p>
						    <!-- recover password -->
							<form action="<?php echo site_url('recover/password') ?>" method="post" class="form-element">
								<div class="form-group">
									<div class="input-group mb-3">
										<div class="input-group-prepend">
											<span class="input-group-text bg-info border-info"><i class="ti-email"></i></span>
										</div>
										<!-- <input type="email" class="form-control pl-15" placeholder="Your Email"> -->
										<input type="password" name="rpass" class="form-control pl-15" placeholder="enter your password" required>
									</div>
								</div>
								  <div class="row">
									<div class="col-12 text-center">
									  <button type="submit" class="btn btn-info btn-block margin-top-10">Submit</button>
									</div>
								  </div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


</body>
</html>
