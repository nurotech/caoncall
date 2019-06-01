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
                  <li class="breadcrumb-item active">View Assigned Sub Categories
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
					<h4 class="card-title" id="basic-layout-form-center">View Assigned Sub Categories</h4>
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
					
					?>
					</span>	
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Sr.No.</th>
								<th>Expert Name</th>
								<th>Sub Categories</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
						<?php
						if($assigned_exp_cats){
						    $sr_no=1;
						    foreach($assigned_exp_cats as $akey=>$avalue){
						        
						        /*$cat_info=get_category_info($avalue['cat_id']);*/
						        
						        /* Get assigned sub categories of expert*/
						        $assigned_subcats=get_expert_sucats($avalue['expert_id']);
						        
						        $expert_info=get_expert_info($avalue['expert_id']);
						          echo "<tr>";
						          echo "<td>$sr_no</td>";
						          echo "<td>".$expert_info['name']."</td>";
						          echo "<td>";
						          if(!empty($assigned_subcats)){
						              echo "<code>".implode('</code>&nbsp;<code>',$assigned_subcats)."</code>";
						          }
						          echo "</td>";
						          echo "<td>";?>
						          <a data-toggle="tooltip" title="Edit" href="<?php echo site_url("admin/expert/assign_cats?exp_id=".$avalue['expert_id'])?>"><i class="fa fa-edit"></i></a>
						          <a onclick="return confirm('Are you sure you want to remove expert from selected categories ?\nIf you want to remove category only then edit instead.')" data-toggle="tooltip" title="Delete" class="text-danger" href="<?php echo site_url("admin/expert/delete_assigned_cat/".$avalue['expert_id'])?>"><i class="fa fa-close"></i></a>
						          <?php echo "</td>";
						      echo "</tr>";
						              
						      $sr_no++;
						    }
						}
						              
						?>
						              
						              
						</tbody>
					</table>
								
								
		
															
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