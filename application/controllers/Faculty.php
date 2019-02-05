<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Faculty extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Classroom_model');
		$this->load->model('login_model');

	}
	public function index(){

		$this->load->view("faculty");
		
		

	}
	
}
?>
