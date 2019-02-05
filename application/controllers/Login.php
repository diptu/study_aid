<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Classroom_model');
		$this->load->model('login_model');

	}
	public function index(){
		if($this->session->has_userdata("type")==null){
			$this->load->view("login_view");
			$username = $this->input->post("username");
			$password = $this->input->post("password");
			$type=$this->login_model->getInfo($username, $password);
			echo $type;
			if(isset($type) && $type=="student"){

				$this->session->set_userdata(array("username"=>$username, "type"=>$type));
				redirect("Student");


			}
			else if(isset($type) && $type=="faculty"){
				$this->session->set_userdata(array("username"=>$username, "type"=>$type));

				redirect("Faculty");
			}
		}
		else{
			redirect($this->session->userdata("type"));
		}


	}
	
	
	public function logout(){
		$this->session->unset_userdata("username");
		$this->session->unset_userdata("type");
		$this->session->unset_userdata("fb_token");
		redirect("Login");
	}
}
?>
