<!DOCTYPE html>
<html lang="en">
<head>
  <title>CAonCall</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:100,200,300,400,500,700%7CGoogle+Sans:400,500%7CProduct+Sans:400&amp;lang=">
</head>
<body>
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
      overflow-x:hidden;
}

.darken-grey-text {
    color: #2E2E2E;
}
.navbar-light {
    background: #fff;
    box-shadow: 0 2px 6px 0 rgba(0,0,0,.12), inset 0 -1px 0 0 #dadce0;
    left: 0;
    right: 0;
    top: 0;
    transform: translate3d(0,0,0);
    transition: transform .4s,background .4s;
    z-index: 100;
    padding: 0px;
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
@import url('//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
 .isa_success {
margin: 10px 0px;
padding:10px;
 
}

.isa_success {
    color: #4F8A10;
    background-color: #DFF2BF;
}
.isa_success i{
    margin:10px 22px;
    font-size:1.5em;
    vertical-align:middle;
}

/** form-group **/
.form-group {
    margin-bottom: .1rem;
}

/*color for text  background-color: antiquewhite;*/
.error_input {
    color: red;
    padding: 0px;
    line-height: 1.2;
    font-size: 14px;
    margin-top: -13px;
}

.btn.btn-lg {
    font-size: .9rem;
    padding: 0.5rem 2.4rem;
}
    </style>
            <nav class="mb-4 navbar navbar-expand-lg navbar-light ">
                <!-- Navbar brand -->
                <a class="navbar-brand font-bold" href="#"><img src="<?php echo assets_url()?>assets/images/caoncall.png" style="margin-top:6px;"></a>
                <!-- Collapse button -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <!-- Collapsible content -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Links -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link " href="<?php echo site_url();?>">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link f" href="#">Prices</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">Experts</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link " href="#">About</a>
                        </li>
                          <li class="nav-item">
                            <a class="nav-link " href="#">FAQ's</a>
                        </li>
                           <li class="nav-item">
                            <a class="nav-link " href="#">Contact Us</a>
                        </li>
                    </ul>
                    <!-- Links -->
                    <!-- Search form -->
<!--                     <form class="form-inline md-form mb-0"> -->
                  <ul class="navbar-nav mr-auto">
                  <li class="nav-item">
                <a class="nav-link " style="height:40px;" href="<?php echo site_url('auth')?>">Login</a>
                                 </li>
					<li class="nav-item">
                <a class="nav-link "  style="background-color: #3D7BD6;
    border-radius: 50px;
    padding: 3px 20px;
    height: 30px;
    margin-top: 7px;color:white;" href="<?php echo site_url('signup')?>">Sign Up</a>
                                 </li>
					</ul>
<!--                     </form> -->
                </div>
                <!-- Collapsible content -->
            </nav>


            <div class="container" >
            <div class="row">
            <div class="col-md-6"></div>
            <div class="col-md-6">
 



              <?php
              if($this->session->flashdata('success_msg')){
              echo "<div class='isa_success'>
              ".$this->session->flashdata('success_msg')."</div>";
              }
             /*  if(validation_errors()){
              echo "<div class='alert alert-danger' style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
              ".validation_errors()."</div>";
              } */
              if($this->session->flashdata('error_msg')){
              echo "<div class='alert alert-danger'  style='background-color: #f7f0f0;padding: 5px;font-family: cursive;color: red;margin-bottom: 5px;'>
              ".$this->session->flashdata('error_msg')."</div>";
              }
              ?>
              <h2 class="text-align:center;" style="color:#1a73e8">Log In your Account</h2>
              <form action="<?php echo site_url('auth')?>" method="post">
              <div class="form-group">
                <label for="mobile"></label>                
                <input type="text" class="form-control" id="mobile" placeholder="Enter Mobile No." name="mobile" value="<?php echo set_value('mobile') ?>">
                 <?php echo form_error('mobile'); ?>
              </div>
              <div class="form-group">                
                <label for="pwd"></label>                
                <input type="password" class="form-control" id="pwd" placeholder="Enter password." name="password" value="<?php echo set_value('password') ?>">
                 <?php echo form_error('password'); ?>
              </div>
              <br>
              <div class="form-group">
              <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            </div>
            <div class="form-group">
                      <p class="float-sm-right text-center"><a href="<?php echo site_url('signup') ?>" class="card-link">Sign Up</a></p>
<small><a href="<?php echo site_url('recover') ?>">Forgot Password ?</a></small>


                  </div>
            </form>
            </div>
            </div>
            </div>

</body>
</html>
