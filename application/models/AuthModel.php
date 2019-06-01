<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AuthModel extends CI_Model{

    public function validatelogin($mobile, $password){

        $query=$this->db->where(['mobile'=>$mobile,'password'=>sha1($password)]);
        $obj=$this->db->get('users')->row();
        return $obj;
    }

}
