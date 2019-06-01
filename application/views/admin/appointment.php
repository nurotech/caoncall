<?php  $this->load->view("admin/partials/header"); ?>
<?php  $this->load->view("admin/partials/sidebar"); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo admin_assets()?>css/multi-select.css">
<div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-md-8 col-12 mb-2 breadcrumb-new">
            <h3 class="content-header-title mb-0 d-inline-block">Appointment Management</h3>
            <div class="row breadcrumbs-top d-inline-block">
              <div class="breadcrumb-wrapper col-12">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="#">Appointment</a>
                  </li>
                  <li class="breadcrumb-item"><a href="#">Add Appointment</a>
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
          <h4 class="card-title" id="basic-layout-form-center">Appointment Details</h4>
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

          if(!empty($appt_list)){
              $action_url=site_url("admin/appointment?app_id=".$appt_list['app_id']);
          }else{
              $action_url=site_url("admin/appointment");
          }          
          ?>          
        <form id="apt_form" class="form" method="post" action="javascript:void(0)">
        	
              <div class="row justify-content-md-center">

                <div class="col-md-6">
                   <div class="form-body">

                     <div class="form-group">
                     <label for="eventInput1">Select Expert</label>
                      <?php
                      echo '<select name="expert_id" class="form-control">';
                      echo '<option value="">-Select Expert-</option>';
                      
                    if(!empty($exp_list)){
                        //pre($exp_list);die;
                        foreach($exp_list as $mk=>$mv){
                            if($apnt_edit['expert_id']==$mv['id']){
                                echo "<option selected value='".$mv['id']."'>".$mv['name']."</option>";
                            }else{
                                echo "<option value='".$mv['id']."'>".$mv['name']."</option>";
                            }
                          }
                        }
                    echo '</select>';
                  ?>
                    </div>
                  </div>

                  <div class="form-body">
                    <div class="form-group">
                    <label for="eventInput1">Select Service</label>
                    <?php
                    echo '<select name="service_id" class="form-control">';
                    echo '<option value="">-Select Service-</option>';
                      //service_list
                    if(!empty($service_list)){
                        foreach($service_list as $mk=>$mv){
                            if($apnt_edit['service_id']==$mv['id']){
                                echo "<option selected value='".$mv['id']."'>".$mv['name']."</option>";
                            }else{
                                echo "<option value='".$mv['id']."'>".$mv['name']."</option>";
                            }
                          }
                        }
                    echo '</select>';
                    ?>
                    </div>
                  </div>
                   <div class="form-body">
                    <div class="form-group">
                      <label for="eventInput1">Start Date</label>
                      <input autocomplete="off" value="<?php echo $apnt_edit['date']?>" type="text" id="datepicker" name="date" class="form-control" placeholder="MM-DD-YYYY">
                    </div>
                  </div>
                  
                   <div class="form-body">
                    <div class="form-group">
                      <label for="eventInput1">End Date</label>
                      <input autocomplete="off" value="<?php echo $apnt_edit['date']?>" type="text" id="datepicker1" name="date1" class="form-control" placeholder="MM-DD-YYYY">
                    </div>
                  </div>
                  
                  

      <div class="form-body" id="time_div">
        <div class="form-group">
            <label for="eventInput1">Select Time</label>
     <select multiple="multiple" id="my-select" name="time[]">
	<?php
	$hours_Range=hoursRange();
	if(!empty($hours_Range)){
	    foreach($hours_Range as $hk=>$hv){
	        //g:i a 
	        $start_time=$hk;
	        $end_time=date('H:i',strtotime($hk."+1 hour"));
	        $time_string_keys=$start_time."-".$end_time;//for drodown keys 

	        $start_time_value=date('g:i a',strtotime($hk));
	        $end_time_value=date('g:i a',strtotime($hk."+1 hour"));

	        $time_string_val=$start_time_value." - ".$end_time_value;//for dropdown values

	        /* if(in_array($hk,$apnt_time_edit_parsed)){
	            echo "<option selected value='$time_string_keys'>$time_string_val</option>";
	        }else{*/
	            echo "<option value='$time_string_keys'>$time_string_val</option>";
	        //}
	   }
	}
	?>
    </select>
    </div>
  </div>
                </div>
              </div>
              <div class="form-actions left">
                <button type="submit" class="btn btn-success btn-apt">
                  Submit
                </button>
                
                <div class="callbacks"></div>                
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
  $( function() {
	  $('#datepicker').datepicker({
		    dateFormat: 'dd-mm-yy',
		    onSelect: function(dateText){
		     $("#time_div").slideDown("slow");
		    }
		});
	  $('#datepicker1').datepicker({
		    dateFormat: 'dd-mm-yy',
		    onSelect: function(dateText){
		     $("#time_div").slideDown("slow");
		    }
		});
  } );
  </script>
  <script src="<?php echo admin_assets()?>js/jquery.multi-select.js"></script>

  <script>
  $('#my-select').multiSelect();
  /*Increate some width of multiselect box to fit the time string within*/
  $('.ms-selectable').css('width', '50%');
  $('.ms-selection').css('width', '50%');
  </script>
<script>
	$(".btn-apt").click(function(){
		$(".callbacks").html("Sending...");
		$.post("<?php echo site_url('admin/appointment/throw_data')?>",$("#apt_form").serialize(),function(res){
			$(".callbacks").html(res);



			
			$('html, body').animate({
		        scrollTop: $(".callbacks").offset().top
		    },500);
		    
				
		});
	});
</script>