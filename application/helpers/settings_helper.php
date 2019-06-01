<?php
/**
 * Get selected date's time
 * @param int $expert_id
 * @param string $date
 * */
    //getting profile image
  function profileimg(){
  //get id
  $ci=& get_instance();
  $expert_info=$ci->session->userdata('expert');
  //pre($expert_info);die;
  $id=$expert_info['id'];
  $row=$ci->db->get_where("expert",array("id"=>$id))->row_array();
  if($row['profile_pic']){
    return $row['profile_pic'];
  }else{
    return false;
  }
}

function get_apnt_times($expert_id,$date,$service_id){
    $ci=& get_instance();
    return $ci->db->get_where("appoint_time",array("service_id"=>$service_id,"expert_id"=>$expert_id,"date"=>$date))->result_array();
}
function hoursRange( $lower = 0, $upper = 86400, $step = 3600, $format = '' ) {
    $times = array();

    if ( empty( $format ) ) {
        $format = 'g:i a';
    }

    foreach ( range( $lower, $upper, $step ) as $increment ) {
        $increment = gmdate( 'H:i', $increment );

        list( $hour, $minutes ) = explode( ':', $increment );

        $date = new DateTime( $hour . ':' . $minutes );

        $times[(string) $increment] = $date->format( $format );
    }

    return $times;
}
/**
 * Get assigned sub categories of expert
 * @param int $expert_id
 * */
function get_expert_sucats($expert_id){
    $ci=& get_instance();
    $rows=$ci->db->get_where("expert_assigned_cats",array("expert_id"=>$expert_id))->result_array();
    if(!empty($rows)){
        $cats=array();
        foreach($rows as $rk=>$rv){
            $cat_info=get_category_info($rv['sub_cat_id']);
            $cats[]=$cat_info['cat_name'];
        }
        return $cats;
    }else{
        return false;
    }
}
function get_service_type_info($service_id){
    $ci=& get_instance();
    return $ci->db->get_where("services",array("id"=>$service_id))->row_array();
}
/**
 * Get Category Information
 * @param $cat_id
 * */
function get_category_info($cat_id){
    $ci=& get_instance();
    return $ci->db->get_where("categories",array("cat_id"=>$cat_id))->row_array();
}

/**
 * Get Category Information
 * @param $cat_id
 * */
function get_expert_info($exp_id){
    $ci=& get_instance();
    return $ci->db->get_where("expert",array("id"=>$exp_id))->row_array();
}
function get_lang_id(){
    $ci=& get_instance();
    $lang_id=$ci->session->userdata("lang_id");
    if(!isset($lang_id)){
        return "en";
    }else if(isset($lang_id)){
        return $lang_id;
    }
    else{
        return false;
    }
}

function Get_Lang_Teachers($language_id){
	$ci=& get_instance();
	$orws= $ci->db->get_where("ea_users",array("teacher_lang"=>$language_id))->result_array();
	if(!empty($orws)){
		return $orws;
	}else{
		return false;
	}
}

function Get_Lang_Teachers_imploded($language_id){
	$ci=& get_instance();
	$orws= $ci->db->get_where("ea_users",array("teacher_lang"=>$language_id))->result_array();
	if(!empty($orws)){
		$array=array();
		foreach($orws as $ok=>$ov){
			$array[]="<label class='label label-success'>".$ov['first_name']." ".$ov['last_name']."</label>";
		}
		return $array;
	}else{
		return false;
	}
}

function get_appointment_info($id){
	$ci=& get_instance();
	$rows=$ci->db->get_where("ea_appointments",array("id"=>$id))->result_array();
	if(!empty($rows)){
		return $rows['0'];
	}else{
		return false;
	}
}
function get_zone_date($triggerOn,$zone_name=false){
	$newdate = new DateTime($triggerOn);
	if($zone_name){
		$newdate->setTimezone(new DateTimeZone($zone_name));
	}else{
		$newdate->setTimezone(new DateTimeZone("UTC"));
	}
	return $newdate->format("Y-m-d H:i:s");
}
function get_user_timezone($user_id){
	$ci=& get_instance();
	$rows=$ci->db->get_where("ea_users",array('id'=>$user_id))->result_array();
	if(!empty($rows)){
		return $rows['0'];
	}else{
		return false;
	}
}
function converToTz($time="",$toTz='',$fromTz='')
{
	// timezone by php friendly values
	$date = new DateTime($time, new DateTimeZone($fromTz));
	$date->setTimezone(new DateTimeZone($toTz));
	$time= $date->format('Y-m-d H:i:s');
	return $time;
}
function converToTz_myaccount($time="",$toTz='',$fromTz='')
{
	// timezone by php friendly values
	$date = new DateTime($time, new DateTimeZone($fromTz));
	$date->setTimezone(new DateTimeZone($toTz));
	$time= $date->format('Y-m-d H:i:s');
	return $time;
}

function formatOffset($offset) {
	$hours = $offset / 3600;
	$remainder = $offset % 3600;
	$sign = $hours > 0 ? '+' : '-';
	$hour = (int) abs($hours);
	$minutes = (int) abs($remainder / 60);

	if ($hour == 0 AND $minutes == 0) {
		$sign = ' ';
	}
	return $sign . str_pad($hour, 2, '0', STR_PAD_LEFT) .':'. str_pad($minutes,2, '0');

}

function get_timezone_dropdown($user_tz=false){

	$timezones = array(
			'Pacific/Midway'       => "(UTC-11:00) Midway Island",
			'US/Samoa'             => "(UTC-11:00) Samoa",
			'US/Hawaii'            => "(UTC-10:00) Hawaii",
			'US/Alaska'            => "(UTC-09:00) Alaska",
			'US/Pacific'           => "(UTC-08:00) Pacific Time (US &amp; Canada)",
			'America/Tijuana'      => "(UTC-08:00) Tijuana",
			'US/Arizona'           => "(UTC-07:00) Arizona",
			'US/Mountain'          => "(UTC-07:00) Mountain Time (US &amp; Canada)",
			'America/Chihuahua'    => "(UTC-07:00) Chihuahua",
			'America/Mazatlan'     => "(UTC-07:00) Mazatlan",
			'America/Mexico_City'  => "(UTC-06:00) Mexico City",
			'America/Monterrey'    => "(UTC-06:00) Monterrey",
			'Canada/Saskatchewan'  => "(UTC-06:00) Saskatchewan",
			'US/Central'           => "(UTC-06:00) Central Time (US &amp; Canada)",
			'US/Eastern'           => "(UTC-05:00) Eastern Time (US &amp; Canada)",
			'US/East-Indiana'      => "(UTC-05:00) Indiana (East)",
			'America/Bogota'       => "(UTC-05:00) Bogota",
			'America/Lima'         => "(UTC-05:00) Lima",
			'America/Caracas'      => "(UTC-04:30) Caracas",
			'Canada/Atlantic'      => "(UTC-04:00) Atlantic Time (Canada)",
			'America/La_Paz'       => "(UTC-04:00) La Paz",
			'America/Santiago'     => "(UTC-04:00) Santiago",
			'Canada/Newfoundland'  => "(UTC-03:30) Newfoundland",
			'America/Buenos_Aires' => "(UTC-03:00) Buenos Aires",
			'Greenland'            => "(UTC-03:00) Greenland",
			'Atlantic/Stanley'     => "(UTC-02:00) Stanley",
			'Atlantic/Azores'      => "(UTC-01:00) Azores",
			'Atlantic/Cape_Verde'  => "(UTC-01:00) Cape Verde Is.",
			'Africa/Casablanca'    => "(UTC) Casablanca",
			'Europe/Dublin'        => "(UTC) Dublin",
			'Europe/Lisbon'        => "(UTC) Lisbon",
			'Europe/London'        => "(UTC) London",
			'Africa/Monrovia'      => "(UTC) Monrovia",
			'Europe/Amsterdam'     => "(UTC+01:00) Amsterdam",
			'Europe/Belgrade'      => "(UTC+01:00) Belgrade",
			'Europe/Berlin'        => "(UTC+01:00) Berlin",
			'Europe/Bratislava'    => "(UTC+01:00) Bratislava",
			'Europe/Brussels'      => "(UTC+01:00) Brussels",
			'Europe/Budapest'      => "(UTC+01:00) Budapest",
			'Europe/Copenhagen'    => "(UTC+01:00) Copenhagen",
			'Europe/Ljubljana'     => "(UTC+01:00) Ljubljana",
			'Europe/Madrid'        => "(UTC+01:00) Madrid",
			'Europe/Paris'         => "(UTC+01:00) Paris",
			'Europe/Prague'        => "(UTC+01:00) Prague",
			'Europe/Rome'          => "(UTC+01:00) Rome",
			'Europe/Sarajevo'      => "(UTC+01:00) Sarajevo",
			'Europe/Skopje'        => "(UTC+01:00) Skopje",
			'Europe/Stockholm'     => "(UTC+01:00) Stockholm",
			'Europe/Vienna'        => "(UTC+01:00) Vienna",
			'Europe/Warsaw'        => "(UTC+01:00) Warsaw",
			'Europe/Zagreb'        => "(UTC+01:00) Zagreb",
			'Europe/Athens'        => "(UTC+02:00) Athens",
			'Europe/Bucharest'     => "(UTC+02:00) Bucharest",
			'Africa/Cairo'         => "(UTC+02:00) Cairo",
			'Africa/Harare'        => "(UTC+02:00) Harare",
			'Europe/Helsinki'      => "(UTC+02:00) Helsinki",
			'Europe/Istanbul'      => "(UTC+02:00) Istanbul",
			'Asia/Jerusalem'       => "(UTC+02:00) Jerusalem",
			'Europe/Kiev'          => "(UTC+02:00) Kyiv",
			'Europe/Minsk'         => "(UTC+02:00) Minsk",
			'Europe/Riga'          => "(UTC+02:00) Riga",
			'Europe/Sofia'         => "(UTC+02:00) Sofia",
			'Europe/Tallinn'       => "(UTC+02:00) Tallinn",
			'Europe/Vilnius'       => "(UTC+02:00) Vilnius",
			'Asia/Baghdad'         => "(UTC+03:00) Baghdad",
			'Asia/Kuwait'          => "(UTC+03:00) Kuwait",
			'Africa/Nairobi'       => "(UTC+03:00) Nairobi",
			'Asia/Riyadh'          => "(UTC+03:00) Riyadh",
			'Europe/Moscow'        => "(UTC+03:00) Moscow",
			'Asia/Tehran'          => "(UTC+03:30) Tehran",
			'Asia/Baku'            => "(UTC+04:00) Baku",
			'Europe/Volgograd'     => "(UTC+04:00) Volgograd",
			'Asia/Muscat'          => "(UTC+04:00) Muscat",
			'Asia/Tbilisi'         => "(UTC+04:00) Tbilisi",
			'Asia/Yerevan'         => "(UTC+04:00) Yerevan",
			'Asia/Kabul'           => "(UTC+04:30) Kabul",
			'Asia/Karachi'         => "(UTC+05:00) Karachi",
			'Asia/Tashkent'        => "(UTC+05:00) Tashkent",
			'Asia/Kolkata'         => "(UTC+05:30) Kolkata",
			'Asia/Kathmandu'       => "(UTC+05:45) Kathmandu",
			'Asia/Yekaterinburg'   => "(UTC+06:00) Ekaterinburg",
			'Asia/Almaty'          => "(UTC+06:00) Almaty",
			'Asia/Dhaka'           => "(UTC+06:00) Dhaka",
			'Asia/Novosibirsk'     => "(UTC+07:00) Novosibirsk",
			'Asia/Bangkok'         => "(UTC+07:00) Bangkok",
			'Asia/Jakarta'         => "(UTC+07:00) Jakarta",
			'Asia/Krasnoyarsk'     => "(UTC+08:00) Krasnoyarsk",
			'Asia/Chongqing'       => "(UTC+08:00) Chongqing",
			'Asia/Hong_Kong'       => "(UTC+08:00) Hong Kong",
			'Asia/Kuala_Lumpur'    => "(UTC+08:00) Kuala Lumpur",
			'Australia/Perth'      => "(UTC+08:00) Perth",
			'Asia/Singapore'       => "(UTC+08:00) Singapore",
			'Asia/Taipei'          => "(UTC+08:00) Taipei",
			'Asia/Ulaanbaatar'     => "(UTC+08:00) Ulaan Bataar",
			'Asia/Urumqi'          => "(UTC+08:00) Urumqi",
			'Asia/Irkutsk'         => "(UTC+09:00) Irkutsk",
			'Asia/Seoul'           => "(UTC+09:00) Seoul",
			'Asia/Tokyo'           => "(UTC+09:00) Tokyo",
			'Australia/Adelaide'   => "(UTC+09:30) Adelaide",
			'Australia/Darwin'     => "(UTC+09:30) Darwin",
			'Asia/Yakutsk'         => "(UTC+10:00) Yakutsk",
			'Australia/Brisbane'   => "(UTC+10:00) Brisbane",
			'Australia/Canberra'   => "(UTC+10:00) Canberra",
			'Pacific/Guam'         => "(UTC+10:00) Guam",
			'Australia/Hobart'     => "(UTC+10:00) Hobart",
			'Australia/Melbourne'  => "(UTC+10:00) Melbourne",
			'Pacific/Port_Moresby' => "(UTC+10:00) Port Moresby",
			'Australia/Sydney'     => "(UTC+10:00) Sydney",
			'Asia/Vladivostok'     => "(UTC+11:00) Vladivostok",
			'Asia/Magadan'         => "(UTC+12:00) Magadan",
			'Pacific/Auckland'     => "(UTC+12:00) Auckland",
			'Pacific/Fiji'         => "(UTC+12:00) Fiji",
	);
	echo '<select name="userTimeZone" id="userTimeZone">';
	echo "<option value=''>Select Your Timezone</option>";
	foreach($timezones as $tz=>$tv) {
		if($user_tz==$tz){
			echo '<option selected value="' .$tz. '">'.$tv.'</option>';
		}else{
			echo '<option value="' .$tz. '">'.$tv.'</option>';
		}
	}
	echo '</select>';

	/*
	echo '<select name="userTimeZone" id="userTimeZone">';
	echo "<option value=''>Select Your Timezone</option>";
	?>

<option value="Pacific/Midway">(UTC-11:00) Midway Island, Samoa</option>
<option value="America/Adak">(UTC-10:00) Hawaii-Aleutian</option>
<option value="Etc/UTC+10">(UTC-10:00) Hawaii</option>
<option value="Pacific/Marquesas">(UTC-09:30) Marquesas Islands</option>
<option value="Pacific/Gambier">(UTC-09:00) Gambier Islands</option>
<option value="America/Anchorage">(UTC-09:00) Alaska</option>
<option value="America/Ensenada">(UTC-08:00) Tijuana, Baja California</option>
<option value="Etc/UTC+8">(UTC-08:00) Pitcairn Islands</option>
<option value="America/Los_Angeles">(UTC-08:00) Pacific Time (US & Canada)</option>
<option value="America/Denver">(UTC-07:00) Mountain Time (US & Canada)</option>
<option value="America/Chihuahua">(UTC-07:00) Chihuahua, La Paz, Mazatlan</option>
<option value="America/Dawson_Creek">(UTC-07:00) Arizona</option>
<option value="America/Belize">(UTC-06:00) Saskatchewan, Central America</option>
<option value="America/Cancun">(UTC-06:00) Guadalajara, Mexico City, Monterrey</option>
<option value="Chile/EasterIsland">(UTC-06:00) Easter Island</option>
<option value="America/Chicago">(UTC-06:00) Central Time (US & Canada)</option>
<option value="America/New_York">(UTC-05:00) Eastern Time (US & Canada)</option>
<option value="America/Havana">(UTC-05:00) Cuba</option>
<option value="America/Bogota">(UTC-05:00) Bogota, Lima, Quito, Rio Branco</option>
<option value="America/Caracas">(UTC-04:30) Caracas</option>
<option value="America/Santiago">(UTC-04:00) Santiago</option>
<option value="America/La_Paz">(UTC-04:00) La Paz</option>
<option value="Atlantic/Stanley">(UTC-04:00) Faukland Islands</option>
<option value="America/Campo_Grande">(UTC-04:00) Brazil</option>
<option value="America/Goose_Bay">(UTC-04:00) Atlantic Time (Goose Bay)</option>
<option value="America/Glace_Bay">(UTC-04:00) Atlantic Time (Canada)</option>
<option value="America/St_Johns">(UTC-03:30) Newfoundland</option>
<option value="America/Araguaina">(UTC-03:00) UTC-3</option>
<option value="America/Montevideo">(UTC-03:00) Montevideo</option>
<option value="America/Miquelon">(UTC-03:00) Miquelon, St. Pierre</option>
<option value="America/Godthab">(UTC-03:00) Greenland</option>
<option value="America/Argentina/Buenos_Aires">(UTC-03:00) Buenos Aires</option>
<option value="America/Sao_Paulo">(UTC-03:00) Brasilia</option>
<option value="America/Noronha">(UTC-02:00) Mid-Atlantic</option>
<option value="Atlantic/Cape_Verde">(UTC-01:00) Cape Verde Is.</option>
<option value="Atlantic/Azores">(UTC-01:00) Azores</option>
<option value="Europe/Belfast">(UTC) Greenwich Mean Time : Belfast</option>
<option value="Europe/Dublin">(UTC) Greenwich Mean Time : Dublin</option>
<option value="Europe/Lisbon">(UTC) Greenwich Mean Time : Lisbon</option>
<option value="Europe/London">(UTC) Greenwich Mean Time : London</option>
<option value="Africa/Abidjan">(UTC) Monrovia, Reykjavik</option>
<option value="Europe/Amsterdam">(UTC+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
<option value="Europe/Belgrade">(UTC+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
<option value="Europe/Brussels">(UTC+01:00) Brussels, Copenhagen, Madrid, Paris</option>
<option value="Africa/Algiers">(UTC+01:00) West Central Africa</option>
<option value="Africa/Windhoek">(UTC+01:00) Windhoek</option>
<option value="Asia/Beirut">(UTC+02:00) Beirut</option>
<option value="Africa/Cairo">(UTC+02:00) Cairo</option>
<option value="Asia/Gaza">(UTC+02:00) Gaza</option>
<option value="Africa/Blantyre">(UTC+02:00) Harare, Pretoria</option>
<option value="Asia/Jerusalem">(UTC+02:00) Jerusalem</option>
<option value="Europe/Minsk">(UTC+02:00) Minsk</option>
<option value="Asia/Damascus">(UTC+02:00) Syria</option>
<option value="Europe/Moscow">(UTC+03:00) Moscow, St. Petersburg, Volgograd</option>
<option value="Africa/Addis_Ababa">(UTC+03:00) Nairobi</option>
<option value="Asia/Tehran">(UTC+03:30) Tehran</option>
<option value="Asia/Dubai">(UTC+04:00) Abu Dhabi, Muscat</option>
<option value="Asia/Yerevan">(UTC+04:00) Yerevan</option>
<option value="Asia/Kabul">(UTC+04:30) Kabul</option>
<option value="Asia/Yekaterinburg">(UTC+05:00) Ekaterinburg</option>
<option value="Asia/Tashkent">(UTC+05:00) Tashkent</option>
<option value="Asia/Kolkata">(UTC+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
<option value="Asia/Katmandu">(UTC+05:45) Kathmandu</option>
<option value="Asia/Dhaka">(UTC+06:00) Astana, Dhaka</option>
<option value="Asia/Novosibirsk">(UTC+06:00) Novosibirsk</option>
<option value="Asia/Rangoon">(UTC+06:30) Yangon (Rangoon)</option>
<option value="Asia/Bangkok">(UTC+07:00) Bangkok, Hanoi, Jakarta</option>
<option value="Asia/Krasnoyarsk">(UTC+07:00) Krasnoyarsk</option>
<option value="Asia/Hong_Kong">(UTC+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
<option value="Asia/Irkutsk">(UTC+08:00) Irkutsk, Ulaan Bataar</option>
<option value="Australia/Perth">(UTC+08:00) Perth</option>
<option value="Australia/Eucla">(UTC+08:45) Eucla</option>
<option value="Asia/Tokyo">(UTC+09:00) Osaka, Sapporo, Tokyo</option>
<option value="Asia/Seoul">(UTC+09:00) Seoul</option>
<option value="Asia/Yakutsk">(UTC+09:00) Yakutsk</option>
<option value="Australia/Adelaide">(UTC+09:30) Adelaide</option>
<option value="Australia/Darwin">(UTC+09:30) Darwin</option>
<option value="Australia/Brisbane">(UTC+10:00) Brisbane</option>
<option value="Australia/Hobart">(UTC+10:00) Hobart</option>
<option value="Asia/Vladivostok">(UTC+10:00) Vladivostok</option>
<option value="Australia/Lord_Howe">(UTC+10:30) Lord Howe Island</option>
<option value="Etc/UTC-11">(UTC+11:00) Solomon Is., New Caledonia</option>
<option value="Asia/Magadan">(UTC+11:00) Magadan</option>
<option value="Pacific/Norfolk">(UTC+11:30) Norfolk Island</option>
<option value="Asia/Anadyr">(UTC+12:00) Anadyr, Kamchatka</option>
<option value="Pacific/Auckland">(UTC+12:00) Auckland, Wellington</option>
<option value="Etc/UTC-12">(UTC+12:00) Fiji, Kamchatka, Marshall Is.</option>
<option value="Pacific/Chatham">(UTC+12:45) Chatham Islands</option>
<option value="Pacific/Tongatapu">(UTC+13:00) Nuku'alofa</option>
<option value="Pacific/Kiritimati">(UTC+14:00) Kiritimati</option>
	<?php
	echo '</select>';*/
}

function get_timezone_dropdown_old($user_tz=false){
$utc = new DateTimeZone('UTC');
$dt = new DateTime('now', $utc);

echo '<select name="userTimeZone" id="userTimeZone">';
echo "<option value=''>Select Your Timezone</option>";
foreach(DateTimeZone::listIdentifiers() as $tz) {
	$current_tz = new DateTimeZone($tz);
	$offset =  $current_tz->getOffset($dt);
	$transition =  $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
	$abbr = $transition[0]['abbr'];
	if($user_tz==$tz){
		echo '<option selected value="' .$tz. '">' .$tz. ' [' .$abbr. ' '. formatOffset($offset). ']</option>';
	}else{
		echo '<option value="' .$tz. '">' .$tz. ' [' .$abbr. ' '. formatOffset($offset). ']</option>';
	}
}
echo '</select>';
}

function get_timezone_offsets(){
	$utc = new DateTimeZone('UTC');
	$dt = new DateTime('now', $utc);

		foreach(DateTimeZone::listIdentifiers() as $tz) {
			$current_tz = new DateTimeZone($tz);
			$offset =  $current_tz->getOffset($dt);
			$transition =  $current_tz->getTransitions($dt->getTimestamp(), $dt->getTimestamp());
			$abbr = $transition[0]['abbr'];
			$offset_array[$tz]=formatOffset($offset);
		}
		return json_encode($offset_array,true);

}
/**
 * Get ea langs by booking id
 * */
function get_ea_langs($book_id){
	$ci=& get_instance();
	return $ci->db->get_where("ea_appointments",array('sw_booking_id'=>$book_id))->result_array();
}

/**
 * Get lang info by its id
 */
function get_ea_langs_info($lang_id){
	$ci=& get_instance();
	return $ci->db->get_where("sw_course",array('id'=>$lang_id))->result_array();
}

function get_ea_langs_wise_teacher($lang_id){
	$ci=& get_instance();
	return $ci->db->get_where("ea_users",array('teacher_lang'=>$lang_id))->result_array();
}
function check_lang_and_teacher($teacher_id,$lang_id){
	$ci=& get_instance();
	return $ci->db->get_where("sw_course",array('id'=>$lang_id,'teacher_id'=>$teacher_id))->result_array();
}
function array_multi_unique($multiArray){

	$uniqueArray = array();

	foreach($multiArray as $subArray){

		if(!in_array($subArray, $uniqueArray)){
			$uniqueArray[] = $subArray;
		}
	}
	return $uniqueArray;
}

/**
 * Check if given booking has appointments
 * */
function get_ea_appoint_details($booking_id){
	$ci=& get_instance();
	return $ci->db->get_where("ea_appointments",array("sw_booking_id"=>$booking_id))->result_array();

}


function get_eauser_settings($user_id){
	$ci=& get_instance();
	$rows=$ci->db->get_where("ea_user_settings",array('id_users'=>$user_id))->result_array();
	if(!empty($rows)){
		return $rows['0'];
	}else{
		return false;
	}
}

/* ----------------------------------------------------------------------------
 * Easy!Appointments - Open Source Web Scheduler
 *
 * @package     EasyAppointments
 * @author      A.Tselegidis <alextselegidis@gmail.com>
 * @copyright   Copyright (c) 2013 - 2016, Alex Tselegidis
 * @license     http://opensource.org/licenses/GPL-3.0 - GPLv3
 * @link        http://easyappointments.org
 * @since       v1.0.0
 * ---------------------------------------------------------------------------- */

/**
 * Get date in RFC3339
 * For example used in XML/Atom
 *
 * @link http://stackoverflow.com/questions/5671433/php-time-to-google-calendar-dates-time-format
 *
 * @param integer $timestamp
 * @return string date in RFC3339
 * @author Boris Korobkov
 */
function date3339($timestamp=0) {

	if (!$timestamp) {
		$timestamp = time();
	}
	$date = date('Y-m-d\TH:i:s', $timestamp);

	$matches = array();
	if (preg_match('/^([\-+])(\d{2})(\d{2})$/', date('O', $timestamp), $matches)) {
		$date .= $matches[1].$matches[2].':'.$matches[3];
	} else {
		$date .= 'Z';
	}
	return $date;
}

/**
 * Generate a hash of password string.
 *
 * For user security, all system passwords are stored in hash string into the database. Use
 * this method to produce the hashed password.
 *
 * @param string $salt Salt value for current user. This value is stored on the database and
 * is used when generating the password hash.
 * @param string $password Given string password.
 * @return string Returns the hash string of the given password.
 */
function hash_password($salt, $password) {
	$half = (int)(strlen($salt) / 2);
	$hash = hash('sha256', substr($salt, 0, $half ) . $password . substr($salt, $half));

	for ($i = 0; $i < 100000; $i++) {
		$hash = hash('sha256', $hash);
	}

	return $hash;
}

/**
 * Generate a new password salt.
 *
 * This method will not check if the salt is unique in database. This must be done
 * from the calling procedure.
 *
 * @return string Returns a salt string.
 */
function generate_salt() {
	$max_length = 100;
	$salt = hash('sha256', (uniqid(rand(), true)));
	return substr($salt, 0, $max_length);
}

/**
 * This method generates a random string.
 *
 * @param int $length (OPTIONAL = 10) The length of the generated string.
 * @return string Returns the randomly generated string.
 * @link http://stackoverflow.com/a/4356295/1718162
 */
function generate_random_string($length = 10) {
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	$random_string = '';
	for ($i = 0; $i < $length; $i++) {
		$random_string .= $characters[rand(0, strlen($characters) - 1)];
	}
	return $random_string;
}

/* End of file general_helper.php */
/* Location: ./application/helpers/general_helper.php */







function get_eauser_details($user_id){
	$ci=& get_instance();
	$rows=$ci->db->get_where("ea_users",array("id"=>$user_id))->result_array();
	if(!empty($rows)){
		return $rows['0'];
	}else{
		return false;
	}
}


function get_user_details($user_id){
	$ci=& get_instance();
	$rows=$ci->db->get_where("ea_users",array("id"=>$user_id))->result_array();
	if(!empty($rows)){
		return $rows['0'];
	}else{
		return false;
	}
}
/**
 * Show form value
 * */
function show_value($set_value,$edit_value=false){
	if(set_value($set_value)){
		return set_value($set_value);
	}else{
		return $edit_value;
	}
}
function check_glf_checked($stu_glf_data,$id){
	if(!empty($stu_glf_data)){
		foreach($stu_glf_data as $key=>$value){
			if($value['glf_id']==$id){
				return true;
			}
		}
	}else{
		return false;
	}
}
/**
 * Return parent data by student id
 * @param $student_id
 * @return Returns false if no matches found
 * */
function get_parent_info_email_id($email_id){
	$ci=& get_instance();
	$sql="SELECT * FROM `parent_login` where `username`='$email_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row['0'];
	}else{
		return false;
	}
}

function get_parent_info_id($id){
	$ci=& get_instance();
	$sql="SELECT * FROM `parent_login` where `id`='$id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row['0'];
	}else{
		return false;
	}
}

function get_schedule_info($id){
	$ci=& get_instance();
	$sql="SELECT * FROM `schedule` where `id`='$id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row['0'];
	}else{
		return false;
	}
}
/**
 * check if parent has any students
 * @return Boolean true or false
 * */
function check_parent_students(){
	$ci=& get_instance();
	$parent_info=$ci->session->userdata('parent');
	$query=$ci->db->get_where('student_details',array('parent_id'=>$parent_info['id']));
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}

/**
 * Debug funtion for developer :: Ignore this funtion
 * @param $debug variable or array
 * @return Show debug info in printed human readable format
 * */
function pre($debug){
	//echo "<pre style='background-color: #184a39;'>";
	echo "<pre style='background-color:cyan'>";
	print_r($debug);
	echo "</pre>";
}
function pre_dump($debug){
	echo "<pre style='background-color: aquamarine;'>";
	var_dump($debug);
	echo "</pre>";
}
/**
 * Get all classes
 * */
function get_user_classes(){
	$ci = & get_instance();
	$sql="SELECT * FROM `class` order by `id` ASC";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}
/*REturn particular class information by class id*/

function get_user_class_info($class_id){
	$ci = & get_instance();
	$sql="SELECT * FROM `class` where `id`='$class_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}
/**
 * Get student information
 * @param $id
 * */
function get_student_info($student_id){
	$ci = & get_instance();
	$sql="SELECT * FROM `student_details` where `id`='$student_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}
function get_scheduled_students($sch_id){
	$ci = & get_instance();
	$sql="SELECT * FROM `schedule_student` where `schedule_id`='$sch_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}
function get_course_info($student_id){
	$ci = & get_instance();
	$sql="SELECT * FROM `course` where `id`='$student_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}
function get_sw_course_info($id){
	$ci = & get_instance();
	$sql="SELECT * FROM `sw_course` where `id`='$id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row['0'];
	}else{
		return false;
	}
}
function get_sw_user_info($id){
	$ci = & get_instance();
	$sql="SELECT * FROM `sw_users` where `id`='$id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row['0'];
	}else{
		return false;
	}
}
function get_teacher_info($student_id){
	$ci = & get_instance();
	$sql="SELECT * FROM `teacher_login` where `id`='$student_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}


function get_sw_teacher_info($student_id){
	$ci = & get_instance();
	$sql="SELECT * FROM `ea_users` where `id`='$student_id'";
	$query=$ci->db->query($sql);
	$row=$query->result_array();
	if(!empty($row)){
		return $row;
	}else{
		return false;
	}
}

function assets_url()
{
	return base_url();
}
function admin_assets()
{
	return base_url()."assets/admin/";
}

function expert_assets()
{
	return base_url()."assets/admin/expert/";
}

/**
 * @param question id
 * @param student id
 * $param type e.g. t1 or t2(t1 is 3 option type and t2 is two option question)
 * */
function get_answer($question_id,$student_id,$type=false)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `answer` where `qid`='$question_id' AND `stu_id`='$student_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		if($type===false){
			return $resp['0'];
		}else{
			return $resp['0'][$type];
		}

	}else{
		return false;
	}
}
function test123(){
	echo "hello";
}
/**
 * Get Health Standard Json File path height
 */
function get_json_path(){
	$get_site_url=str_replace('index.php','',site_url());
	return $get_site_url."assets/json/standard.json";
}
/**
 * Get Health Standard Json File path weight
 */
function get_json_path1(){
	$get_site_url=str_replace('index.php','',site_url());
	return $get_site_url."assets/json/standard1.json";
}
/**
 * Returns cities list in <option value='1'>Agra</option> format
 */
function get_cities()
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `city` order by city asc");
	foreach($query->result_array() as $k=>$v)
	{
		echo "<option value='{$v['id']}'>{$v['city']}</option>";
	}

}

function get_cities_for_select($selected_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `city` order by city asc");
	foreach($query->result_array() as $k=>$v)
	{
		if($selected_id==$v['id']){
			echo "<option selected value='{$v['id']}'>{$v['city']}</option>";
		}else{
			echo "<option value='{$v['id']}'>{$v['city']}</option>";
		}
	}

}


/* Get Access Token from db google table*/
function get_access_token(){
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `google`");
	$gtoken=$query->result_array();
	if(!empty($gtoken)){
		unset($gtoken['0']['id']);
	//	unset($gtoken['0']['parent_id']);
		return $gtoken['0'];
	}else{
		return false;
	}
}

/**
 * Fetch city name from db
 * @param $city_id
 * @return city Name
 * */
function get_city_name($city_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT `city` FROM `city` where `id`='$city_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		$resp=$resp['0'];
		return $resp['city'];
	}else{
		return false;
	}
}

/**
 * Returns nurse list in format
 */
function get_nurse($get_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT `id`,`notification_count` FROM `teacher_login` where `id`='$get_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		$resp=$resp['0'];
		return $resp['notification_count'];
	}else{
		return false;
	}

}

/**
 * Returns doctor list in format
 */
function get_doctor($get_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT `id`,`notification_count` FROM `doctor_login` where `id`='$get_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		$resp=$resp['0'];
		return $resp['notification_count'];
	}else{
		return false;
	}

}

/**
 * Returns select cities list in <option value='1' selected>Agra</option> format
 */
function get_select_cities($city_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `city` order by city asc");
	foreach($query->result_array() as $k=>$v)
	{?>
		<option value='<?php echo $v['id'];?>'<?php if($v['id']==$city_id){ echo"selected"; }?>><?php echo $v['city'];?></option>
	<?php }

}

/**
 * Fetch school name from db
 * @param $school_id
 * @return school Name
 * */
function get_school_name($school_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT `id`,`school_name` FROM `school_user` where `id`='$school_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		$resp=$resp['0'];
		return $resp['school_name'];
	}else{
		return false;
	}
}
/*
 * Fetch Nurse name from db
 * @param $Nurse_id
 * @return Nurse Name
 * */
function get_nurse_name($nurse_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT `id`,`fname`,`lname` FROM `teacher_login` where `id`='$nurse_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		$resp=$resp['0'];
		return $resp['fname']." ".$resp['lname'];
	}else{
		return false;
	}
}
/*
 * Fetch dentist name from db
 * @param type
 * @return dentist Name
 * */
function get_dentist_name($type_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT `id`,`fname`,`lname` FROM `doctor_login` where `id`='$type_id'");
	$resp=$query->result_array();
	if(!empty($resp)){
		$resp=$resp['0'];
		return $resp['fname']." ".$resp['lname'];
	}else{
		return false;
	}
}
/**
 * Get Standard params of students's height
 */
function get_json_db(){
	$ci = & get_instance();
    $query=$ci->db->query("SELECT * FROM `height`");
    $rows=$query->result_array();
    if(!empty($rows)){
        $json_arr=array();
    foreach($query->result_array() as $json_k=>$json_val)
    {
    	 $json_arr[$json_val['id']]=$json_val;
    }
       //write it to physical location as file.json
    $target_loc_file="assets/json/standard.json";
    $file_json=json_encode($json_arr,true);
    file_put_contents($target_loc_file,$file_json);
    }

}
/**
 * Get Standard params of students's weight
 */
function get_json_db1(){
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `weight`");
	$rows=$query->result_array();
	if(!empty($rows)){
		$json_arr=array();
		foreach($query->result_array() as $json_k=>$json_val)
		{
			$json_arr[$json_val['id']]=$json_val;
		}
		//write it to physical location as file.json
		$target_loc_file="assets/json/standard1.json";
		$file_json=json_encode($json_arr,true);
		file_put_contents($target_loc_file,$file_json);
	}

}
/* Get student Year Total*/
function get_stu_year($stu_id){
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `student_details` where `id`='$stu_id'");
	$temp_arr=$query->result_array();
	if(empty($temp_arr)){
		return false;
	}else{
		$age=date('Y',strtotime($temp_arr['0']['dob']));
		$get_curr_date=date('Y',time());
		return $get_curr_date-$age;

	}
}


 /**
	 * Creating calendar via google api
	 * @param $cal_code Calendar unique name
	 * @return return newly created calendar id
	 * */
function get_notify($get_cal_id){
		require_once APPPATH.'third_party/Google/autoload.php';
		$credentials=google_credentials();
		$client_id = $credentials['client_id'];
		$client_secret = $credentials['client_secret'];
		$redirect_uri = $credentials['redirect_uri'];
		/************************************************
		 Make an API request on behalf of a user. In
		this case we need to have a valid OAuth 2.0
		token for the user, so we need to send them
		through a login flow. To do this we need some
		information from our API console project.
		************************************************/
		$client = new Google_Client();
		$client->setClientId($client_id);
		$client->setClientSecret($client_secret);
		$client->setRedirectUri($redirect_uri);
		$client->addScope("https://www.googleapis.com/auth/calendar");
		$client->addScope("https://www.googleapis.com/auth/calendar.readonly");
		//$client->addScope("profile");
		//$service = new Google_Service_Oauth2($client);
		$service = new Google_Service_Calendar($client);


		/* Get access token from db and if expired then refresh it use it */
		$gtoken=get_access_token();
		$new_token=json_encode($gtoken);

		if(!$client->isAccessTokenExpired($new_token))
		{
			//if access token is not expired then use it
			$_SESSION['access_token']=$new_token;
		}else{
			//if access token is expired then refresh it and use it
			if(empty($gtoken)){
				die("Google API Access Token is not found in database");
			}else{
				$client->refreshToken($gtoken['refresh_token']);
				$_SESSION['access_token']=$client->getAccessToken();
			}
		}

		/* Get access token from db END */


		if (isset($_SESSION['access_token']) && $_SESSION['access_token']) {
			$client->setAccessToken($_SESSION['access_token']);
		} else {
			$authUrl = $client->createAuthUrl();
		}

                //get calendar id of logged in nurse
              // $get_calinfo=$this->session->userdata('nurse');
              //  $get_cal_id=$get_calinfo['google_cal_id'];
                if(isset($get_cal_id)){
                    $events = $service->events->listEvents($get_cal_id);

                return $events;
                }else{
                    return false;
                }

	}


        /**
 * Returns select Degree list in <option value='1' selected>MBBS</option> format
 */
function get_select_degree($get_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `wh_degre` order by name asc");
	foreach($query->result_array() as $k=>$v)
	{?>
		<option value='<?php echo $v['id'];?>'<?php if($v['id']==$get_id){ echo"selected"; }?>><?php echo $v['name'];?></option>
	<?php }

}

    /**
 * Returns Degree list in <option value='1'>MBBS</option> format
 */
function get_degree()
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `wh_degre` order by name asc");
	foreach($query->result_array() as $k=>$v)
	{
		echo "<option value=".$v['id'].">{$v['name']}</option>";
	}

}

  /**
 * Returns select class list in <option value='1' selected>1</option> format
 */
function get_select_class($get_id)
{
	$ci = & get_instance();
	$query=$ci->db->query("SELECT * FROM `class` order by class_name asc");
	foreach($query->result_array() as $k=>$v)
	{?>
		<option value='<?php echo $v['id'];?>'<?php if($v['id']==$get_id){ echo"selected"; }?>><?php echo $v['class_name'];?></option>
	<?php }

}

/**
 * Returns select time list in <option value='1' selected>1</option> format
 */
function get_select_time($get_id)
{
	?>

<option value="00:00"<?php if($get_id=='00:00') echo"selected";?>>00:00</option>
												<option value="00:30"<?php if($get_id=='00:30') echo"selected";?>>00:30</option>
												<option value="01:00"<?php if($get_id=='01:00') echo"selected";?>>01:00</option>
												<option value="01:30"<?php if($get_id=='01:30') echo"selected";?>>01:30</option>
												<option value="02:00"<?php if($get_id=='02:00') echo"selected";?>>02:00</option>
												<option value="02:30"<?php if($get_id=='02:30') echo"selected";?>>02:30</option>
												<option value="03:00"<?php if($get_id=='03:00') echo"selected";?>>03:00</option>
												<option value="03:30"<?php if($get_id=='03:30') echo"selected";?>>03:30</option>
												<option value="04:00"<?php if($get_id=='04:00') echo"selected";?>>04:00</option>
												<option value="04:30"<?php if($get_id=='04:30') echo"selected";?>>04:30</option>
												<option value="05:00"<?php if($get_id=='05:00') echo"selected";?>>05:00</option>
												<option value="05:30"<?php if($get_id=='05:30') echo"selected";?>>05:30</option>
												<option value="06:00"<?php if($get_id=='06:00') echo"selected";?>>06:00</option>
												<option value="06:30"<?php if($get_id=='06:30') echo"selected";?>>06:30</option>
												<option value="07:00"<?php if($get_id=='07:00') echo"selected";?>>07:00</option>
												<option value="07:30"<?php if($get_id=='07:30') echo"selected";?>>07:30</option>
												<option value="08:00"<?php if($get_id=='08:00') echo"selected";?>>08:00</option>
												<option value="08:30"<?php if($get_id=='08:30') echo"selected";?>>08:30</option>
												<option value="09:00" <?php if($get_id=='09:00') echo"selected";?>>09:00</option>
												<option value="09:30"<?php if($get_id=='09:30') echo"selected";?>>09:30</option>
												<option value="10:00"<?php if($get_id=='10:00') echo"selected";?>>10:00</option>
												<option value="10:30"<?php if($get_id=='10:30') echo"selected";?>>10:30</option>
												<option value="11:00"<?php if($get_id=='11:00') echo"selected";?>>11:00</option>
												<option value="11:30"<?php if($get_id=='11:30') echo"selected";?>>11:30</option>
												<option value="12:00"<?php if($get_id=='12:00') echo"selected";?>>12:00</option>
												<option value="12:30"<?php if($get_id=='12:30') echo"selected";?>>12:30</option>
												<option value="13:00"<?php if($get_id=='13:00') echo"selected";?>>13:00</option>
												<option value="13:30"<?php if($get_id=='13:30') echo"selected";?>>13:30</option>
												<option value="14:00"<?php if($get_id=='14:00') echo"selected";?>>14:00</option>
												<option value="14:30"<?php if($get_id=='14:30') echo"selected";?>>14:30</option>
												<option value="15:00"<?php if($get_id=='15:00') echo"selected";?>>15:00</option>
												<option value="15:30"<?php if($get_id=='15:30') echo"selected";?>>15:30</option>
												<option value="16:00"<?php if($get_id=='16:00') echo"selected";?>>16:00</option>
												<option value="16:30"<?php if($get_id=='16:30') echo"selected";?>>16:30</option>
												<option value="17:00"<?php if($get_id=='17:00') echo"selected";?>>17:00</option>
												<option value="17:30"<?php if($get_id=='17:30') echo"selected";?>>17:30</option>
												<option value="18:00"<?php if($get_id=='18:00') echo"selected";?>>18:00</option>
												<option value="18:30"<?php if($get_id=='18:30') echo"selected";?>>18:30</option>
												<option value="19:00"<?php if($get_id=='19:00') echo"selected";?>>19:00</option>
												<option value="19:30"<?php if($get_id=='19:30') echo"selected";?>>19:30</option>
												<option value="20:00"<?php if($get_id=='20:00') echo"selected";?>>20:00</option>
												<option value="20:30"<?php if($get_id=='20:30') echo"selected";?>>20:30</option>
												<option value="21:00"<?php if($get_id=='21:00') echo"selected";?>>21:00</option>
												<option value="21:30"<?php if($get_id=='21:30') echo"selected";?>>21:30</option>
												<option value="22:00"<?php if($get_id=='22:00') echo"selected";?>>22:00</option>
												<option value="22:30"<?php if($get_id=='22:30') echo"selected";?>>22:30</option>
												<option value="23:00"<?php if($get_id=='23:00') echo"selected";?>>23:00</option>
												<option value="23:30"<?php if($get_id=='23:30') echo"selected";?>>23:30</option>
												<option value="Closed"<?php if($get_id=='Closed') echo"selected";?>>Closed</option>
<?php }?>
