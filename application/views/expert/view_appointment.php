<?php  $this->load->view("expert/partials/header"); ?>
<?php  $this->load->view("expert/partials/sidebar"); ?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Appointment Management</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Expert Appointment</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">View Appointment</a>
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
					<h4 class="card-title" id="basic-layout-form-center">User Appointments</h4>
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
					?>
					  <div class="card-body card-dashboard">
                        <p class="card-text"></p>
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                                    <tr>
                                    		<th>Sr.No.</th>
                                            <th>Expert</th>
                                            <th>Service Name</th>
                                            <th>Date</th>                                           
                                            <th>Action</th>

                                    </tr>

                            </thead>
                            <tbody>
                            <?php
                              //pre($appt_list);die;
                            	if($appt_list){
                            	    $sr_no=1;
        								foreach($appt_list as $mk=>$mv){
        								    $expert_info=get_expert_info($mv['expert_id']);
        								    $service_info=get_service_type_info($mv['service_id']);
        									?>
        									<tr>
        									<td><?php echo $sr_no;?></td>
        									<td><?php 
        									echo $expert_info['name'];
        									?></td>
                      					    <td><?php echo $service_info['name']; ?></td>
        									<td><?php echo $mv['date']; ?></td>        								
                          					<td>

<!-- Modal -->
<div id="myModal<?php echo $mv['id']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      	<p><?php echo $expert_info['name'];?>'s Appointment Time - <b><?php echo $mv['date']; ?></b> </p>
        <button type="button" class="close" data-dismiss="modal">&times;</button>        
      </div>
      <div class="modal-body">
      <table>
      <thead>
      <tr>
      	<th>Sr.No.</th>
      	<th>Start Time</th>
      	<th>End Time</th>
      	<th>Action</th>
      </tr>
      </thead>  
      <tbody>    
      	<?php 
      	$get_apnt_times=get_apnt_times($mv['expert_id'],$mv['date'],$mv['service_id']);
      	if(!empty($get_apnt_times)){
      	    $sr=1;
      	    foreach($get_apnt_times as $gk=>$gv){
      	        
      	    $start_time=date('g:i a',strtotime($gv['start_time']));
      	    $end_time=date('g:i a',strtotime($gv['end_time']));
      	        
      	    echo "<tr id=tr".$gv['id'].">";
      	     echo "<td>$sr</td>";
      	     echo "<td>$start_time</td>";
      	     echo "<td>$end_time</td>";
      	     ?>
      	     <td><a href="javascript:delete_time(<?php echo $gv['id']?>)"><i class='fa fa-close'></></a></td>
      	     <?php 
            echo "</tr>";
            $sr++;
      	    }
      	}
      	?>
      	</tbody>
	</table>
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- modal box end -->
                          					 
                          					
                          					<a class='text-info' data-toggle='tooltip' title='View' href='javascript:void(0)'><i data-toggle="modal" data-target="#myModal<?php echo $mv['id']?>" class='fa fa-eye'></i></a>
                          					
                          					<a class='text-primary' data-toggle='tooltip' title='Edit' href='<?php echo site_url("expert/appointment?expert_id=".$mv['expert_id']."&date=".$mv['date'])?>'><i class='fa fa-pencil'></i></a>                          					
                          					<a title="Delete" data-toggle="tooltip"  href="<?php echo site_url('expert/appointment/delete_appoints/'.$mv['expert_id'].'/'.$mv['date'])?>" onclick="return confirm('Are you sure you want to delete records of the selected date?')" class="text-danger"><i class="fa fa-close"></i></a>
                          					</td>
        								   </tr>
        									<?php
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

<?php  $this->load->view("expert/partials/footer");?>
<script>
function delete_time(time_row_id){
	$.post("<?php echo site_url('expert/appointment/delete_time')?>",{"row_id":time_row_id},function(res){
		console.log(res);
		$("#tr"+time_row_id).fadeOut("slow");
	});	
}
</script>