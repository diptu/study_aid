<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Graph extends CI_Controller{
	public function __construct(){
		parent::__construct();
		$this->load->model('Classroom_model');
		$this->load->model('login_model');

	}
	public function get($username){

		$this->load->view("graph_view");
		
		

	}
	
}
?>
