<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registration extends CI_Controller {

	public function __construct(){
		parent:: __construct();
		$this->load->model('Registration_model');
		$this->load->model('Facebook_model');
	}


	public function index(){
		$data['login_url'] = $this->Facebook_model->loginUrl();
		$this->load->view('registration',$data);
		$reg=$this->input->post();

		if(isset($reg['userName'])!=null){
			//echo var_dump($reg);
			$flag=$this->Registration_model->getRegistered($reg);

			if($flag==1){
				echo "Your information has been updated<br>";
			}

			else
				echo "Something went wrong!<br>";


			if($reg['type']=="student"){
				//$this->session->set_userdata(array("username"=>$username));
					 $this->session->set_userdata(array("username"=>$reg['userName'], "type"=>$reg['type']));
				 redirect("Login/student");

			 }
			 else if($reg['type']=="faculty"){
				 $this->session->set_userdata(array("username"=>$reg['userName'], "type"=>$reg['type']));
				 redirect("Login/faculty");
			 }

		}

	}

	public function login_with_facebook(){
		if($this->Facebook_model->logged_in()){

			$user = $this->Facebook_model->getProfile();


			// var_dump($user['birthday']);
			// echo "<hr>";

			$data['name']=$user['name'];
			$email=explode("@",$user['email']);
			$data['username']=$email[0];
			$data['email']=$user['email'];


			 $data['gender']=$user['gender'];
			 

			// $data['location']=$user['location']['name'];
			// $bday=explode(" ",$user['birthday']->date);

			// $data['birthday']=$bday[0];


			$data['propic'] = $this->Facebook_model->getDp();
			$data['login_url'] = $this->Facebook_model->loginUrl();
			$this->load->view('registration', $data);


		}
	}

	public function user_login(){

		if($this->Facebook_model->setSession()){
			redirect(base_url('Registration/login_with_facebook'));
		}else{
			$this->load->view('user/failed');
		}

	}
	public function logout(){
		$this->Facebook_model->logout();
	}



}
