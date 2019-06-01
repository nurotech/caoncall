<?php

class customer{
    
    /**
     * It will check user's login status
     * @param int via ajax
     * */
    function check_login_status(){
        $user_session=$this->session->userdata('user');
        $user_id=$user_session['id'];
        $flag=0;
        if($user_id){
            $flag=1;
        }
        echo $flag;
    }
}


$user_session=$this->session->userdata('user');
$user_id=$user_session['id'];
$flag=0;
if($user_id){
    $flag=1;
}
?>

<form>
	<input id="user_flag" value="<?php echo $flag;?>">
	
	
	<button id="next">Next</button>
	<div id="cb"></div>
</form>

<script>
var get_flag=$("#user_flag").val();
if(!get_flag){
	$(".cb").html("<p style='red'>Please login to continue .<a href=''>click ghere otl ogin</a></p>");
}


$("#next").click(function(){
	$.post("auth/check_login_status",function(res){
			if(res==0){
				//show login
				$(".cb").html("<p style='red'>Please login to continue .<a href=''>click ghere otl ogin</a></p>");
			}
		});	
});

</script>
