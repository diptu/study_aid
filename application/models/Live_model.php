<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Live_model extends CI_model{
	public function get_video_by_cid($cid){
		
		
		$vid="SELECT * FROM live_groups l, videos v where l.cid=".$this->db->escape($cid)." and v.gid = l.gid";
		$res=$this->db->query($vid);
		return $res->result_array();
	}
	public function add_videos($gid, $vid){

		$c1= "INSERT INTO videos(gid, vid)
		values (".$this->db->escape($gid).",".$this->db->escape($vid).")";

		if (!$this->db->simple_query($c1)){
			return $this->db->error()['message'];

		}
		if($this->db->affected_rows()==1){
			return "success!";
		}
	}
	
	public function check_group_by_gid($gid){

		$grp="SELECT * FROM live_groups WHERE gid=".$this->db->escape($gid);
		$res=$this->db->query($grp);
		return $res->result_array();
	}
	public function check_group_by_cid($cid){

		$grp="SELECT * FROM live_groups WHERE cid=".$this->db->escape($cid);
		$res=$this->db->query($grp);
		return $res->result_array();
	}
	
	public function add_group($cid,$gid){

		$c1= "INSERT INTO live_groups(cid, gid)
		values (".$this->db->escape($cid).",".$this->db->escape($gid).")";

		if (!$this->db->simple_query($c1)){
			return $this->db->error()['message'];

		}
		if($this->db->affected_rows()==1){
			return "success!";
		}
	}
}
?>
