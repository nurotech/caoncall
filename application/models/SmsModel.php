<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SmsModel extends CI_Model{
    
    public function sendSMS($number, $text) { 
        $url = "http://103.250.30.4/SendSMS/sendmsg.php?uname=ALERTB&pass=sms1234&send=ALERTB&dest=$number&msg=$text";
        // Set the secret here
       $request = array( 
                      
                       'message' => $text, 
                       'recipients' => array(array( 
                               'type' => 'mobile', 
                               'value' => $number 
                       ))
               );  
       $req = json_encode($request);
       $ch = curl_init( $url );  
       curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json')); 
       curl_setopt( $ch, CURLOPT_POST, true );  
       curl_setopt( $ch, CURLOPT_POSTFIELDS, $req );  
       curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );  
       $result = curl_exec($ch); 
       curl_close($ch);
       return explode(',',$result); 
    } // end_of_sendSMS

}