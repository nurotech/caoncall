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
                  <li class="breadcrumb-item active">View Experts
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
					<h4 class="card-title" id="basic-layout-form-center">View Experts</h4>
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

					?>
					<table class="table table-bordered">
					<thead>
						<tr>
							<th>Sr.No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Mobile</th>
							<th data-toggle="tooltip" title="Experience">Exp.</th>
							<th>Action</th>
						</tr>
						</thead>
						<tbody>
						<?php
						if(!empty($experts_data)){
						    $sr_no=1;
						    foreach($experts_data as $ek=>$ev){
						        echo "<tr>";
						          echo "<td>$sr_no</td>";
						          echo "<td>".$ev['name']."</td>";
						          echo "<td>".$ev['email']."</td>";
						          echo "<td>".$ev['mobile']."</td>";
						          echo "<td>".$ev['experience']."</td>";
						          echo "<td>";?>


<!-- Modal -->
<div id="myModal<?php echo $ev['id']?>" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
      <h4 class="modal-title">View Details - <?php echo $ev['name'];?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        	<p><b>Name</b>:<span><?php echo $ev['name']?></span></p>
        	<p><b>Email</b>:<span><?php echo $ev['email']?></span></p>
        	<p><b>Mobile</b>:<span><?php echo $ev['mobile']?></span></p>
        	<p><b>Qualification</b>:<span><?php echo $ev['qualification']?></span></p>
        	<p><b>Experience</b>:<span><?php echo $ev['experience']?></span></p>
        	<p><b>Speciality</b>:<span><?php echo $ev['speciality']?></span></p>
        	<p><b>Short Profile</b>:<span><?php echo html_entity_decode(htmlentities($ev['short_profile']))?></span></p>
        	<p><b>Profile</b>:<span>
        		<?php
        		if($ev['profile_pic']){
        		    $img_path=admin_assets()."expert/".$ev['profile_pic'];
        		    echo "<a target='_blank' href='$img_path'><img src='$img_path' style='width:50px;height:50px;' class='img-responsive'></a>";
        		}
        		?>
        	</span></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
	<!-- Modal end-->
						        	<a data-target="#myModal<?php echo $ev['id']?>" title="View" data-toggle="modal" class="label label-success" href="javascript:void(0);"><i class="fa fa-eye"></i></a>
						              <a title="Edit" data-toggle="tooltip"  class="text-primary" href="<?php echo site_url('admin/expert?expert_id='.$ev['id'])?>"><i class="fa fa-pencil"></i></a>
						           <?php
						           if($ev['status']=="1"){
						               $link=site_url('admin/expert/update_status/'.$ev['id'].'/0');
						              echo '<a title="Inactive" class="text-danger" data-toggle="tooltip"  href="'.$link.'"><i class="fa fa-ban"></i></a>';
						           }else{
						               $link=site_url('admin/expert/update_status/'.$ev['id'].'/1');
						               echo '<a title="Active" class="text-success" data-toggle="tooltip"  href="'.$link.'"><i class="fa fa-circle-o"></i></a>';
						           }
						           ?>
						              <a title="Delete Expert" data-toggle="tooltip"  href="<?php echo site_url('admin/expert/delete/'.$ev['id'])?>" onclick="return confirm('Are you sure you want to delete this expert?')" class="text-danger"><i class="fa fa-close"></i></a>
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
