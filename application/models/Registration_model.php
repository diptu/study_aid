<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration_model extends CI_model{

	public function getRegistered($reg){
		//echo var_dump($reg);
		if($reg['type']=="student"){
		if($reg['gender']=="Male")
			$reg['profile_pic']="male_student.jpg";
		else
			$reg['profile_pic']="female_student.jpg";
		}
		else{
			if ($reg['gender']=="Male")
				$reg['profile_pic']="male_faculty.jpg";
		else
			$reg['profile_pic']="female_faculty.jpg";



		}
		$sql = "INSERT INTO user (user_name,full_name,profile_pic,email,gender,birthday,mobile_number,address)

				VALUES (".$this->db->escape($reg['userName']).", ".$this->db->escape($reg['fullName']).",".$this->db->escape($reg['profile_pic']).",".$this->db->escape($reg['userEmail']).",
				".$this->db->escape($reg['gender']).",".$this->db->escape($reg['birthday']).",".$this->db->escape($reg['mobile_number']).",".$this->db->escape($reg['address']).")";
		$sql2= "INSERT INTO login(user_name,password,user_type)
			values (".$this->db->escape($reg['userName']).",".$this->db->escape($reg['password']).",".$this->db->escape($reg['type']).")";
				$this->db->query($sql);
				$this->db->query($sql2);
		return $this->db->affected_rows();


	}

}
