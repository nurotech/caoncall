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
                  <li class="breadcrumb-item active">Assign Category
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
					<h4 class="card-title" id="basic-layout-form-center">Assigned Category to Expert</h4>
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
					
					<span class="error_callback">
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
					//pre($assigned_exp_cats);
					//pre($experts_data);
					//pre($edit_info);
					
					?>
					</span>	
														 
				 	<form action="javascript:void(0)" method="post" id="exp_form">
				 	<input type="hidden" name="form_expert_id" value="<?php echo $expert_info['id'];?>">				 	
				 	 	<div class="form-group">
				 	<label>Select Expert</label>
				 		<select class="form-control" name="exp_id" id="expert_id">
				 			<option value="">--Select--</option>
				 			<?php 
				 			if(!empty($experts_data)){
				 			    foreach($experts_data as $exp_key=>$exp_val){
				 			        if($expert_info['id']==$exp_val['id']){
				 			            echo "<option selected value='".$exp_val['id']."'>".$exp_val['name']."</option>";
				 			        }else{
				 			            echo "<option value='".$exp_val['id']."'>".$exp_val['name']."</option>";
				 			        }
				 			    }
				 			}				 			
				 			?>				 							 			
				 		</select>				 	
				 	</div>
				 	
				 	<div class="form-group">
				 	<label>Select Main Category</label>
				 		<select class="form-control" name="main_cid" id="main_cid">
				 			<option value="">--Select--</option>
				 			<?php 
				 			if(!empty($main_cats)){
				 			    foreach($main_cats as $main_key=>$main_val){
				 			        if($this->input->get('filter_cid')==$main_val['cat_id']){
				 			            echo "<option selected value='".$main_val['cat_id']."'>".$main_val['cat_name']."</option>";
				 			        }else{
				 			            echo "<option value='".$main_val['cat_id']."'>".$main_val['cat_name']."</option>";
				 			        }				 			        
				 			    }
				 			}				 			
				 			?>				 							 			
				 		</select>				 	
				 	</div>
				 	
				 	<div class="form-group">
				 		<span id="checks_cb">
				 		
				 		</span>
				 	</div>
				 					 	
				<!--  	<div class="form-group">
				 	<label>Select Sub Category</label>
				 		<select class="form-control" name="sub_cid" id="sub_cid">
				 			<option value="">--Select--</option>				 						 							 			
				 		</select>				 	
				 	</div>	 -->			 
				 	
				 	
				 		
				 		<div class="form-group">
				 			<button class="btn btn-primary" id="btn_assign">Save</button>				 			
				 			<a href="<?php echo site_url("admin/expert/view_assigned_cats")?>" class="btn btn-danger">Cancel</a>
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

$("#main_cid").change(function(){
	$.post("<?php echo site_url('admin/expert/get_subcats2')?>",{"main_cid":$(this).val(),"expert_id":$("#expert_id").val()},function(res){
		console.log(res);		
		/*$("#sub_cid").html(res);*/
		$("#checks_cb").html(res);
				
	});	
});

$("#btn_assign").click(function(){
	$(".error_callback").html("");
	$.post("<?php echo site_url('admin/expert/save_exp_cat')?>",$("#exp_form").serialize(),function(res){			
		if(res=="success"){
			window.location.href="<?php echo site_url("admin/expert/view_assigned_cats")?>";
		}else{
				$(".error_callback").html(res);
			}
		
	});	
});
    <?php /* if(!empty($edit_info)){
    $cat_info=get_category_info($edit_info['cat_id']);
    ?>
	$("#main_cid").trigger("change").val(<?php echo $cat_info['pid']?>);

	$.post("<?php echo site_url('admin/expert/get_subcats')?>",{"main_cid":<?php echo $cat_info['pid']?>,"selected_cat":<?php echo $edit_info['cat_id'];?>},function(res){
		$("#sub_cid").html(res);
	});		
    <?php } */?>
</script>