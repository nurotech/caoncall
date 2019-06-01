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
                  <li class="breadcrumb-item active">View
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
					if(!empty($service_info)){
					    $action_url=site_url("admin/services?sid=".$service_info['id']);
					    ?>
					    <form action="<?php echo $action_url?>" method="post">
					    <input type="hidden" name="form_serive_id" value="<?php echo $service_info['id']?>">
					    
					    <div class="form-group">
					    	<lable>Update Service Name</lable>
					    	<input type="text" name="service_name" value="<?php echo show_value('service_name',$service_info['name'])?>" class="form-control">					    
					    </div>
					    <div class="form-group">
					    	<button class="btn btn-primary">Update</button>
					    	<a href="<?php echo site_url('admin/services')?>" class="btn btn-danger">Cancel</a>
					    </div>
					    
					    </form>
					    
					    
					    <?php 
					}
					?>
					<table class="table table-bordered" id="service_table">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Name</th>					
							<th>Action</th>						
						</tr>
						</thead>
						<tbody>
						<?php 
						if(!empty($services)){
						    $sr_no=1;
						    foreach($services as $sk=>$sv){
						        echo "<tr>";
						          echo "<td>$sr_no</td>";
						          echo "<td>".$sv['name']."</td>";
						          echo "<td>";?>
						          <a title="Edit" data-toggle="tooltip" class="text-info" href="<?php echo site_url('admin/services?sid='.$sv['id'])?>"><i class="fa fa-edit"></i></a>						          
						          <a onclick="return confirm('Are you sure you want to delete this services ?')" title="Delete" data-toggle="tooltip" class="text-danger" href="<?php echo site_url("admin/services/delete/".$sv['id'])?>"><i class="fa fa-close"></i></a>
						          
						            <?php 
						            if($sv['status']=="1"){
						                $link=site_url('admin/services/update_status/'.$sv['id'].'/0');
						              echo '<a title="Inactive" class="text-danger" data-toggle="tooltip"  href="'.$link.'"><i class="fa fa-ban"></i></a>'; 
						           }else{
						               $link=site_url('admin/services/update_status/'.$sv['id'].'/1');
						               echo '<a title="Active" class="text-success" data-toggle="tooltip"  href="'.$link.'"><i class="fa fa-circle-o"></i></a>';
						           }
						           ?>
						          
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