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
                  <li class="breadcrumb-item"><a href="#">Services</a>
                  </li>
                  <li class="breadcrumb-item active">Pricing
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
					<h4 class="card-title" id="basic-layout-form-center">Services</h4>
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
					
					    $action_url=site_url("admin/services_pricing");
					    ?>
					    <form action="<?php echo $action_url?>" method="post">
					    <input type="hidden" name="form_row_id" value="<?php echo $edit_info['id']?>">
					    <div class="form-group">
					    	<label>Select Service Type</label>
					    	<select class="form-control" name="service_id">
					    		<option value="">--Select--</option>
					    		<?php 
					    		if(!empty($services)){
					    		    foreach($services as $sk=>$sv){
					    		        if($sv['id']==$edit_info['service_id']){
					    		            echo "<option selected value='".$sv['id']."'>".$sv['name']."</option>";
					    		        }else{
					    		            echo "<option value='".$sv['id']."'>".$sv['name']."</option>";
					    		        }
					    		        
					    		    }
					    		}
					    		?>
					    	</select>					    
					    </div>
					    
					    <div class="form-group">
					    	<label>Package Name</label>
					    	<input value="<?php echo show_value('service_name',$edit_info['name'])?>" type="text" placeholder="Enter Package Name" name="service_name" class="form-control">
					   </div>
					   
					     <div class="form-group">
					    	<label>Enter Amount</label>
					    	<input value="<?php echo show_value('price',$edit_info['amount'])?>" type="text" placeholder="Enter Amount" name="price" class="form-control">
					   </div>
					   
					    <div class="form-group">
					    	<label>Description 1</label>
					    	<input value="<?php echo show_value('des1',$edit_info['des1'])?>" type="text" placeholder="Enter Description" name="des1" class="form-control">
					   </div>
					   
					    <div class="form-group">
					    	<label>Description 2</label>
					    	<input value="<?php echo show_value('des2',$edit_info['des2'])?>" type="text" placeholder="Enter Description" name="des2" class="form-control">
					   </div>
					    	
					    <div class="form-group">
					    	<button class="btn btn-primary">Submit</button>
					    	<a href="<?php echo site_url('admin/services_pricing')?>" class="btn btn-danger">Cancel</a>
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
<?php $this->load->view("admin/partials/footer");?>
<script>
$(document).ready(function(){
   $('#exp_table').DataTable();
});	
</script>