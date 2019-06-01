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
                  <li class="breadcrumb-item"><a href="#">Add category</a>
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

					if(!empty($cat_list)){
					    $action_url=site_url("admin/category?cat_id=".$cat_list['cat_id']);
					}else{
					    $action_url=site_url("admin/category");
					}
					?>

				<form class="form" method="post" action="<?php echo $action_url ?>">
							<div class="row justify-content-md-center">
								<div class="col-md-6">

									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1"></label>
											<input type="hidden" name="form_cat_id" class="form-control"
											value="<?php echo $cat_list['cat_id']; ?>">
										</div>
									</div>

									<div class="form-body">
										<div class="form-group">
											<label for="eventInput1">Category Name</label>
											<input type="text" name="cat_name" class="form-control" placeholder="Enter Category Name" value="<?php echo $cat_list['cat_name']; ?>">
										</div>
									</div>

									<div class="form-body">
										<div class="form-group">
										<label for="eventInput1">Select Category</label>
										<?php
                    echo '<select name="pid" class="form-control">';
										echo '<option value="">--Select Category--</option>';
											if(!empty($main_cats)){
        								foreach($main_cats as $mk=>$mv){
        									if($cat_list['pid']==$mv['cat_id']){
											echo "<option selected value='".$mv['cat_id']."'>".$mv['cat_name']."</option>";
        									}else{
        									echo "<option value='".$mv['cat_id']."'>".$mv['cat_name']."</option>";
        									}
        								}
        							}
										echo '</select>';
									?>
										</div>
									</div>
								</div>
							</div>

							<div class="form-actions left">
								<button type="submit" class="btn btn-success">
									Submit
								</button>
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
