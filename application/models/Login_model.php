<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_model{

	public function getInfo($username, $password){
		$type="";
		$q = $this->db->query("select * from login where user_name=".$this->db->escape($username)." and password=".$this->db->escape($password));
		$row = $q->row();

		if(isset($row)){
			$type = $row->user_type;
		}

		
		return $type;

	}
}
?>
