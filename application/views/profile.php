<!DOCTYPE html>
<html lang="en">
<head>
  <title>dashboard</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700%7CGoogle+Sans:400,500%7CProduct+Sans:400&amp;lang=">
    <style>
        @import url(https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css);
@import url(https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.3/css/mdb.min.css);

body{
       background: #fff;
    cursor: auto;
   font-family: "Google Sans",Roboto,Arial,Helvetica,sans-serif;
    font-size: 1em;
    font-style: normal;
    font-weight: 300;
    line-height: 1.444;
    margin: 0;
    padding: 0;
    overflow-wrap: break-word;
    word-wrap: break-word;
}
.hm-gradient {
    background-image: linear-gradient(to top, #f3e7e9 0%, #e3eeff 99%, #e3eeff 100%);
}
.darken-grey-text {
    color: #2E2E2E;
}

.navbar .dropdown-menu a:hover {
    color: #616161 !important;
}
.darken-grey-text {
    color: #2E2E2E;
}
@media (min-width: 600px)
{
.nav-item .nav-link  {
    line-height: 1.71429;
    font-size: 14px;
    letter-spacing: .25px;

}
}


@media (min-width: 900px)
{
.nav-item .nav-link {
    line-height: 1.85714;
    color: #5f6368;
    font-size: 14px;
    font-weight: 400;
    height: auto;
    letter-spacing: .25px;
    padding: 10px 0 9px;
    width: auto;
}
}

.nav-item .nav-link {
    color: #5f6368;

    display: table-cell;
    font-family: "Google Sans",Roboto,Arial,Helvetica,sans-serif;
    font-size: 14px;
    font-weight: 400;
    height: 48px;
    letter-spacing: .25px;
    padding-left: 16px;
    padding-right: 16px;
    vertical-align: middle;
      padding: 10px 0 9px;
    width: auto;
      line-height: 1.85714;
}


@media (min-width: 900px)
{
.nav-item {
    float: left;
    height: 100%;
    margin-left: 26px;
    position: relative;
    width: auto;
  color: #5f6368;
  font-size:14px;
}
}
.navbar-light{
    background: #fff;
    box-shadow: 0 2px 6px 0 rgba(0,0,0,.12), inset 0 -1px 0 0 #dadce0;
    left: 0;
    right: 0;
    top: 0;
    transform: translate3d(0,0,0);
    transition: transform .4s,background .4s;
    z-index: 100;
}
#demo{
    background: #1a73e8;
    letter-spacing: .5px;border-radius:2px;border-radius: 4px;
    box-sizing: border-box;
    color: #fff;
    cursor: pointer;
    float: right;
    font-size: .875em;
    margin: 0;
    padding: 13px 16px;
    transition: box-shadow 150ms cubic-bezier(0.4, 0, 0.2, 1);
    user-select: none;"
}
h1{
  webkit-font-smoothing: antialiased;
    text-rendering: optimizeLegibility;
    color: #202124;
    font-family: "Google Sans",Roboto,Arial,Helvetica,sans-serif;
    font-weight: 400;
    -webkit-hyphens: auto;
    -ms-hyphens: auto;
    hyphens: auto;
    overflow-wrap: initial;
    word-wrap: initial;
    font-size: 36px;
}
@media (min-width: 1024px)
{
h1 {
    line-height: 1.17857;
    font-size: 56px;
    letter-spacing: -.5px;
}
}
p{
    line-height: 26px;
    font-size:18px;
}
    </style>
</head>
<body>
  
            <nav class="mb-4 navbar navbar-expand-lg navbar-light ">
                <!-- Navbar brand -->
                <a class="navbar-brand font-bold" href="#">Navbar</a>
                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="#">Overview</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">How it Works</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link f" href="#">Cost</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">FAQ</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">Resources</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">Contact</a>
                        </li>
                    </ul>

                    <form class="form-inline md-form mb-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item">
                                <a class="nav-link btn btn-sm btn-primary" href="<?php echo site_url('logout')?>">Logout</a>
                                 </li>
                        </ul>
                    </form>

                </div>
                <!-- Collapsible content -->
            </nav>
        <!-- @deepak -->
    <div class="container">
        <div class="content-body">
            <div class="content-body">
            <section id="basic-form-layouts">
	        <div class="row match-height">
		        <div class="col-md-12">
			    <div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form-center">Edit Details</h4>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
					 <?php
					if($this->session->flashdata('success_msg')){
						echo "<div class='alert alert-success' style='background-color: green;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
						".$this->session->flashdata('success_msg')."</div>";
					}
					if(validation_errors()){
						echo "<div class='alert alert-danger' style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
						".validation_errors()."</div>";
					}
					if($this->session->flashdata('error_msg')){
						echo "<div class='alert alert-danger'  style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
						".$this->session->flashdata('error_msg')."</div>";
					}
					
				/*	if(!empty($user_info)){
					    $action_url=site_url("profile?id=".$user_info['id']);
					}else{
					    $action_url=site_url("profile");
					}*/

                   //$expert_info = $this->session->userdata('user') <?php echo $action_url ;
                 
                   ?>
			     <form class="form" method="post" action="<?php echo site_url("profile/update") ?>" enctype="multipart/form-data">
			          <input type="hidden" name="id" value="<?php echo $user_info['id']?>">
                        <div class="form-body">
                          <h4 class="form-section"></h4>

                          <div class="row">
                              <div class="form-group col-md-6 mb-2">
                                  <input value="<?php echo show_value('name',$user_info['name'])?>" type="text" id="name" class="form-control border-primary" placeholder="Name" name="name" required>
                              </div>
                              <div class="form-group col-md-6 mb-2">
                                  <input  value="<?php echo show_value('email',$user_info['email'])?>" type="email" id="userinput3" class="form-control border-primary" placeholder="Email" name="email" required>
                              </div>
                          </div>

                            <div class="row">
                              <div class="form-group col-md-6 mb-2">
                              	<label>Mobile No.</label>
                                  <input disabled  value="<?php echo $user_info['mobile']?>" type="text" class="form-control border-primary">
                              </div>
                              
                               <div class="form-group col-md-6 mb-2">
                               
                                  <input  value="" type="text" id="userinput2" class="form-control border-primary" placeholder="Password" name="password">
                                  <small><b>Note </b> If you don't wish to change password.Leave it blank.</small>

                              </div>
                              
                            </div>
                            
                            <div class="form-actions left">
                              <input type="submit" class="btn btn-primary" name="user_submit" value="update">
                        </div>
                    </div>
              </form>
				</div>
				</div>
			</div>
		</div>
	</div>
</section>
        </div>
        </div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
