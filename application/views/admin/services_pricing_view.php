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
                  <li class="breadcrumb-item active">View Pricing
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
					<h4 class="card-title" id="basic-layout-form-center">View Pricing</h4>
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
					}?>
					
					<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Service Type</th>
							<th>Package Name</th>
							<th>Package Amount</th>
							<th data-toggle="tooltip" title="Description 1">Desc.1</th>
							<th data-toggle="tooltip" title="Description 2">Desc.2</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(!empty($services_pacakges)){
						    $sr=1;
						    foreach($services_pacakges as $sk=>$sv){
						        $service_info=get_service_type_info($sv['service_id']);
						        
						          echo "<tr>";
						              echo "<td>$sr</td>";
						              echo "<td>".$service_info['name']."</td>";
						              echo "<td>".$sv['name']."</td>";
						              echo "<td>".$sv['amount']."</td>";
						              echo "<td>".$sv['des1']."</td>";
						              echo "<td>".$sv['des2']."</td>";
						              echo "<td>";?>
						              <a title="Edit" data-toggle="tooltip"  class="text-primary" href="<?php echo site_url('admin/services_pricing?row_id='.$sv['id'])?>"><i class="fa fa-pencil"></i></a>						              
						              <a title="Delete" data-toggle="tooltip"  href="<?php echo site_url('admin/services_pricing_view/delete/'.$sv['id'])?>" onclick="return confirm('Are you sure you want to delete this record?')" class="text-danger"><i class="fa fa-close"></i></a>
						              
						              <?php echo "</td>";						              
						          echo "</tr>";
						          $sr++;
						        
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