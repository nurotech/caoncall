<?php  $this->load->view("admin/partials/header");?>
<?php  $this->load->view("admin/partials/sidebar");?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block"></h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Home</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Expert Management</a>
                  </li>
                  <li class="breadcrumb-item active"><?php echo (empty($expert_details))?"Add Expert":"Update Expert";?>
                  </li>
                </ol>
              </div>
            </div>
          </div>
          <div class="content-header-right col-md-4 col-12">
            <div class="btn-group float-md-right">            
              <div class="dropdown-menu arrow"><a class="dropdown-item" href="#"><i class="fa fa-calendar mr-1"></i> Calender</a><a class="dropdown-item" href="#"><i class="fa fa-cart-plus mr-1"></i> Cart</a><a class="dropdown-item" href="#"><i class="fa fa-life-ring mr-1"></i> Support</a>
                <div class="dropdown-divider"></div><a class="dropdown-item" href="#"><i class="fa fa-cog mr-1"></i> Settings</a>
              </div>
            </div>
          </div>
        </div>
  <div class="content-body">
<section id="basic-form-layouts">

	<div class="row match-height">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title" id="basic-layout-form-center"><?php echo (empty($expert_details))?"Add Expert":"Update Expert";?></h4>
					<a class="heading-elements-toggle"><i class="fa fa-ellipsis-v font-medium-3"></i></a>
					<div class="heading-elements">
						<ul class="list-inline mb-0">
							<li><a data-action="collapse"><i class="ft-minus"></i></a></li>
							<li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
							<li><a data-action="expand"><i class="ft-maximize"></i></a></li>
							<li><a data-action="close"><i class="ft-x"></i></a></li>
						</ul>
					</div>
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
					if(!empty($expert_details)){
					    $action_url=site_url("admin/expert?expert_id=".$expert_details['id']);
					}else{
					    $action_url=site_url("admin/expert");
					}
					?>		
					
			                 <form class="form" method="post" action="<?php echo $action_url?>" enctype="multipart/form-data">
			                 <input type="hidden" name="form_edit_id" value="<?php echo $expert_details['id']?>">
                        <div class="form-body">
                          <h4 class="form-section"></h4>

                          <div class="row">
                              <div class="form-group col-md-6 mb-2">
                                <label for="name">Name</label>
                                  <input value="<?php echo show_value('name',$expert_details['name'])?>" type="text" id="name" class="form-control border-primary" placeholder="Name" name="name" required>
                              </div>
                              <div class="form-group col-md-6 mb-2">
                                <label for="userinput3">Email</label>
                                  <input  value="<?php echo show_value('email',$expert_details['email'])?>" type="email" id="userinput3" class="form-control border-primary" placeholder="Email" name="email" required>
                              </div>                 
                          </div>                        

                            <div class="row">                              
                              <div class="form-group col-md-6 mb-2">
                                <label for="userinput4">Mobile</label>
                                  <input  value="<?php echo show_value('mobile',$expert_details['mobile'])?>" type="number" id="userinput4" class="form-control border-primary" placeholder="Mobile" name="mobile" required>
                              </div>
                               <div class="form-group col-md-6 mb-2">
                                <label for="userinput2">Password</label>
                                  <input  value="" type="text" id="userinput2" class="form-control border-primary" placeholder="Password" name="password">
                                     <?php 
                                  if(!empty($expert_details)){
                                      ?>
                                      <small><b>Note:</b>If you don't wish to change password,Leave it blank.</small>
                                      <?php
                                  }
                                  ?>
                              </div>
                            </div>

                            <div class="row">
                              <div class="form-group col-md-6 mb-2">
                                <label for="userinput3">Qualification</label>
                                  <input  value="<?php echo show_value('qualif',$expert_details['qualification'])?>" type="text" id="userinput3" class="form-control border-primary" placeholder="Qualification" name="qualif" required>
                              </div>
                              <div class="form-group col-md-6 mb-2">
                                <label for="userinput4">Experience</label>
                                  <input value="<?php echo show_value('exp',$expert_details['experience'])?>" type="text" id="userinput4" class="form-control border-primary" placeholder="Experience" name="exp">
                              </div>
                            </div>                
                            
                            <div class="row">
                              <div class="form-group col-12 mb-2">
                                <label for="userinput6">Select Profile Pic</label>
                              	<input class="form-control border-primary" type="file" name="profile_pic" placeholder="File" id="userinput6">
                              	<?php 
                              	if($expert_details['profile_pic']){
                              	    $profile_path=admin_assets()."expert/".$expert_details['profile_pic'];
                              	     echo "<a href='$profile_path' target='_blank'><img style='width:50px;height:50px;' src='".$profile_path."' class='img-responsive'></a>";   
                              	}                              	
                              	?>
                              </div>
                            </div>
                            
                               <div class="row">
                              <div class="form-group col-12 mb-2">
                                <label>Speciality</label>
                                <input value="<?php echo show_value('speciality',$expert_details['speciality'])?>"  class="form-control border-primary" type="text" placeholder="Speciality" id="userinput7" name="speciality">
                              </div>
                            </div> 
                            
                            <div class="row">
                              <div class="form-group col-12 mb-2">
                                <label for="editor1">Short Profile</label>
                                  <textarea id="editor1" rows="5" class="form-control border-primary" name="short_profile" placeholder="Short Profile"><?php echo show_value('short_profile',$expert_details['short_profile'])?></textarea>
                              </div>
                            </div> 

                         
                            <div class="form-actions left">                             
                              <input type="submit" class="btn btn-primary" name="expert_submit" value="<?php echo (empty($expert_details))?"Add Expert":"Update Expert";?>">
                              <a href="<?php echo site_url('admin/expert/view')?>" class="btn btn-danger">Cancel</a>                             
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

<?php  $this->load->view("admin/partials/footer");?>
<script src="//cdn.ckeditor.com/4.11.4/standard/ckeditor.js"></script>
  			<script>
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                CKEDITOR.replace( 'editor1' );
            </script>
