<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Classroom_model extends CI_model{
	
	
	public function get_all_students($cid){
		$s = "SELECT * FROM `enrolled_student` WHERE cid=".$this->db->escape($cid);
		$s2 =  $this->db->query($s);
		$res= $s2->result_array($s2);
		return $res;
	}
	public function check_faculty_classroom($username,$cid){
				$sql="SELECT cid FROM `classroom` WHERE owner=".$this->db->escape($username)." and cid=".$this->db->escape($cid);
				$sql2=$this->db->query($sql);
				$res=$sql2->result_array($sql2);
				/*print_r("<pre>");
				 print_r($res);
				 print_r("</pre>");*/
				 return $res;
	}


	public function fetch_enrolled_student_by_class_user($username,$cid){
		$s = "SELECT cid FROM `enrolled_student` WHERE user_name=".$this->db->escape($username)." and cid=".$this->db->escape($cid);
		$s2 =  $this->db->query($s);
		$res= $s2->result_array($s2);
		return $res;
		/*print_r("<pre>");
		print_r($res);
		print_r("</pre>");*/

	}


	public function fetch_comment_by_pid($pid){

			$cmnt="SELECT * FROM `comment` as c,`user`as u WHERE c.user_name=u.user_name and c.pid=".$this->ecp($pid) ;
			$res=$this->db->query($cmnt);
			return $res->result_array();
	}

	public function add_comment($pid, $text, $created_date, $user_name){

		$c1= "INSERT INTO comment(user_name,text,pid,created_date)
		values (".$this->ecp($user_name).",".$this->ecp($text).",".$this->ecp($pid).",".$this->ecp($created_date).")";

		if (!$this->db->simple_query($c1)){
			return $this->db->error()['message'];

		}

		if($this->db->affected_rows()==1){
			return "Commented successfully!";
		}
		else{
			return "Something wrong!";
		}
	}


	public function fetch_post_by_cid($cid){


		$query="SELECT * FROM `user` as u,`post` as p WHERE p.user_name=u.user_name && cid=".$this->ecp($cid)." order by pid desc";
		$result=$this->db->query($query);
		return $result->result_array();
	}



	public function add_status($cid, $text, $created_date,$attachment, $user_name){



		$c1= "INSERT INTO post(cid,text,created_date,attachment,user_name)
		values (".$this->ecp($cid).",".$this->ecp($text).",".$this->ecp($created_date).",".$this->ecp($attachment).",".$this->ecp($user_name).")";

		if (!$this->db->simple_query($c1)){
			return $this->db->error()['message'];

		}

		if($this->db->affected_rows()==1){
			return $this->db->insert_id();
		}
		else{
			return "Something wrong!";
		}
	}

	public function fetch_class_by_id($cid){

		$query="SELECT * FROM classroom WHERE cid=".$this->ecp($cid);
		$result=$this->db->query($query);
		return $result->row();
	}

	public function view_classes($user_name){

		$class_number="SELECT * FROM enrolled_student as e,classroom as c WHERE e.cid=c.cid and  e.user_name=".$this->ecp($user_name);
		$class_number=$this->db->query($class_number);
		return $class_number;
	}
	public function view_faculty_classes($user_name){

		$class_number="SELECT * FROM classroom WHERE owner=".$this->ecp($user_name);
		$class_number=$this->db->query($class_number);
		return $class_number;
	}


	public function add_student($key,$student){
		$cid="select cid from classroom where access_key =".$this->ecp($key);

		$cid = $this->db->query($cid);

		$cid = $cid->row('cid');


		$c1= "INSERT INTO enrolled_student(cid, user_name)
		values (".$this->ecp($cid).",".$this->ecp($student).")";

		if (!$this->db->simple_query($c1)){
			return $this->db->error()['message'];

		}
		if($this->db->affected_rows()==1){
			return "success!";
		}
	}

	public function updateClassroom($className, $about, $owner){
		$year = date("Y");
		$semester = $this->getSemester();
		$classKey = $this->randomString(12);
		$c1= "INSERT INTO classroom(cname,about,access_key,semester,year,owner)
		values (".$this->ecp($className).",".$this->ecp($about).",".$this->ecp($classKey).",".$this->ecp($semester).",".$this->ecp($year).",".$this->ecp($owner).")";

		if (!$this->db->simple_query($c1)){
			return $this->db->error()['message'];

		}

		if($this->db->affected_rows()==1){
			return "Access key: ".$classKey;
		}
		else{
			return "Something wrong!";
		}
	}
	public function getSemester(){
		$m = date("m");
		if($m <=1 && $m >=4){
			return "Spring";
		}
		else if($m <=5 && $m >=8){
			return "Summer";
		}
		else{
			return "Fall";
		}

	}
	public function ecp($data){
		return $this->db->escape($data);
	}

	public function randomString($length =10 ) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}
}
?>
