<!-- @deepak-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">  </head>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700%7CGoogle+Sans:400,500%7CProduct+Sans:400&amp;lang=">
  <body>
<div class="container w-50">
							<p class="auth-msg"><h3><?php echo $this->session->flashdata('success_msg'); ?></h3> </p>
									<form action="<?php echo site_url('recover/forgot') ?>"  method="post">

										<div class="form-group w-50">
											<label></label>
											<input class="form-control" type="text" name="mobile" placeholder="Enter your mobile" required>
										</div>



										<div class="form-group">
											<button type="submit" name="verify_otp" class="btn btn-lg btn-success">Submit</button>
										</div>
									</form>



		</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
