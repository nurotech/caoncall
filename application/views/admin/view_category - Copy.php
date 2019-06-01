<?php  $this->load->view("admin/partials/header");?>
<?php  $this->load->view("admin/partials/sidebar");?>

<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Category Management</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="index.html">Category</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">View Category</a>
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
					<h4 class="card-title" id="basic-layout-form-center">Category Details</h4>
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
					if(!empty($expert_details)){
					    $action_url=site_url("admin/expert?expert_id=".$expert_details['id']);
					}else{
					    $action_url=site_url("admin/expert");
					}
					?>		

				 <div class="card-body card-dashboard">				 
				 	<form action="<?php echo site_url('admin/category/view')?>" method="get">
				 	<div class="form-group">
				 	<label>Select Category to Filter</label>
				 		<select class="form-control" name="filter_cid">
				 			<option value="selected">-- Select Category --</option>
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
				 			<button class="btn btn-primary">Go</button>
				 			<a href="<?php echo site_url('admin/category/view')?>" class="btn btn-danger">Reset</a>
				 		</div>				 	
				 	</form>				 
				 </div>

         <!-- filter by all category  10/05/2019 -->
         <div class="card-body card-dashboard">         
          <form action="<?php echo site_url('admin/category/view')?>" method="get">
          <div class="form-group">
            <label>Select Category to Filter</label>
            <select class="form-control" name="filter_cid">
              <option value="">-- Please Select --</option>
              <option value="">Main Category</option>
              <option value="">Sub Category</option>
              <option value="">All category</option>
                             
            </select>         
          </div>
            <div class="form-group">
              <button class="btn btn-primary">Go</button>
              <a href="<?php echo site_url('admin/category/view')?>" class="btn btn-danger">Reset</a>
            </div>          
          </form>         
         </div>
         <!-- 10/05/2019 -->
				 
                    <div class="card-body card-dashboard">
                        <p class="card-text"></p>
                        <table class="table table-striped table-bordered zero-configuration">
                        <thead>
                                    <tr>
                                    		<th>Sr.No.</th>                                               
                                            <th>Name</th>
                                           <!--  <th>Main Category</th> -->
                                            <th>Status</th>
                                            <th>Action</th>                                   
                                    </tr>

                            </thead>
                            <tbody>
                            <?php                         
                            //pre($main_cats); // main category                       
                            	if(!empty($cat_list)){
                            	    $sr_no=1;
        								foreach($cat_list as $mk=>$mv){
        									?>
        									<tr>
        									<td><?php echo $sr_no;?></td>
        										<td><?php echo $mv['cat_name']; ?></td>
                            <!-- <td> -->
                              <!-- for main category -->
                              	<?php
                              		/*if($mv['pid']!="0"){
                              		    $cat_info=get_category_info($mv['pid']);
                              		    echo $cat_info['cat_name'];
                              		}      */                        		
                              		?>                         
                              
                            <!-- </td> -->
        										<td>
                            <?php 
                            if($mv['status']=="1"){
                            $link=site_url('admin/category/update_status/'.$mv['cat_id'].'/0');
                            echo '<a title="Inactive" class="text-danger" data-toggle="tooltip"  href="'.$link.'"><i class="fa fa-ban"></i></a>'; 
                            }else{
                           $link=site_url('admin/category/update_status/'.$mv['cat_id'].'/1');
                           echo '<a title="Active" class="text-success" data-toggle="tooltip"  href="'.$link.'"><i class="fa fa-circle-o"></i></a>';
                            }
                          ?>
        									</td>
        								  <td>
        									<a href="<?php echo site_url('admin/category?cat_id='.$mv['cat_id']); ?>"><i class="fa fa-pencil"></i></a>
        									<a class='text-danger' href="<?php echo site_url('admin/category/delete?cat_id='.$mv['cat_id']); ?>"><i class="fa fa-close"></i></a>					
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

<?php  $this->load->view("admin/partials/footer");?>

