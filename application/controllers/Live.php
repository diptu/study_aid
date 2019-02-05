<?php
defined('BASEPATH') OR exit ('No dirrect access allowed');


  class Live extends CI_Controller{

    public function __construct(){
      parent:: __construct();
      $this->load->model('Live_model');
    }
	
	
	public function view_live($cid){
		
		
		require 'application/vendor/Facebook/autoload.php';
		

		$fb = new Facebook\Facebook([
		  'app_id' => '1991410494465424',
		  'app_secret' => 'fcc0cf93a7e8d233ff38db7d9f8a0acd',
		  'default_graph_version' => 'v2.10'
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		define('APP_URL', base_url('Live/view_live/'.$cid));

		$permissions = ['email'];

		try {
			if (isset($_SESSION['fb_token'])) {
				$accessToken = $_SESSION['fb_token'];
			} else {
				$accessToken = $helper->getAccessToken();
			}
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			
			echo 'Graph returned an error: ' . $e->getMessage();

			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		 }

		if (isset($accessToken)) {
			if (isset($_SESSION['fb_token'])) {
				$fb->setDefaultAccessToken($_SESSION['fb_token']);
			} else {
				$_SESSION['fb_token'] = (string) $accessToken;
				$oAuth2Client = $fb->getOAuth2Client();
				$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_token']);
				$_SESSION['fb_token'] = (string) $longLivedAccessToken;
				$fb->setDefaultAccessToken($_SESSION['fb_token']);
			}

		
			try {
				$user = $fb->get('/me');
				$user = $user->getGraphNode()->asArray();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				
				echo 'Graph returned an error: ' . $e->getMessage();
				session_destroy();
				
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}
			
			$res = $this->Live_model->get_video_by_cid($cid);
			$LiveVideo='';
			if(isset($res) && $res!=null){
				$vid = $res[0]['vid'];
			
				$LiveVideo = $fb->get('/'.$vid);
				$LiveVideo = $LiveVideo->getGraphNode()->asArray();
			}
			
			//print_r($LiveVideo); //status['LIVE', 'VOD'], embed_html, title	
			
			$data['LiveVideo'] = $LiveVideo;
			
			$this->load->view("student_live_view",$data);
		} 
		else {
			$loginUrl = $helper->getLoginUrl(APP_URL, $permissions);
			//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
			echo "<script>window.top.location.href='".$loginUrl."'</script>";
		}
		
	}
	
	public function start_live($gid){
		require 'application/vendor/Facebook/autoload.php';
		
		$title = $this->input->post("title");
		$description = $this->input->post("description");
		$this->session->set_userdata(array('title'=>$title,'description'=>$description));

		$fb = new Facebook\Facebook([
		  'app_id' => '1991410494465424',
		  'app_secret' => 'fcc0cf93a7e8d233ff38db7d9f8a0acd',
		  'default_graph_version' => 'v2.10'
		  ]);

		$helper = $fb->getRedirectLoginHelper();

		define('APP_URL', base_url('Live/start_live/'.$gid));

		$permissions = ['publish_actions'];

		try {
			if (isset($_SESSION['fb_token'])) {
				$accessToken = $_SESSION['fb_token'];
			} else {
				$accessToken = $helper->getAccessToken();
			}
		} catch(Facebook\Exceptions\FacebookResponseException $e) {
			
			echo 'Graph returned an error: ' . $e->getMessage();

			exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
			
			echo 'Facebook SDK returned an error: ' . $e->getMessage();
			exit;
		 }

		if (isset($accessToken)) {
			if (isset($_SESSION['fb_token'])) {
				$fb->setDefaultAccessToken($_SESSION['fb_token']);
			} else {
				$_SESSION['fb_token'] = (string) $accessToken;
				$oAuth2Client = $fb->getOAuth2Client();
				$longLivedAccessToken = $oAuth2Client->getLongLivedAccessToken($_SESSION['fb_token']);
				$_SESSION['fb_token'] = (string) $longLivedAccessToken;
				$fb->setDefaultAccessToken($_SESSION['fb_token']);
			}

		
			try {
				$user = $fb->get('/me');
				$user = $user->getGraphNode()->asArray();
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
				
				echo 'Graph returned an error: ' . $e->getMessage();
				session_destroy();
				
				exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
				
				echo 'Facebook SDK returned an error: ' . $e->getMessage();
				exit;
			}

			$title = $this->session->userdata('title');
			$description = $this->session->userdata('description');
			$create_live_video = $fb->post('/'.$gid.'/live_videos', ['title' => $title, 'description' => $description]);
			$create_live_video = $create_live_video->getGraphNode()->asArray();
			$data['create_live_video'] = $create_live_video;
			
			$this->Live_model->add_videos($gid, $create_live_video['id']);
			//print_r($create_live_video);
			$res = $this->Live_model->check_group_by_gid($gid);
			$data['cid'] = $res[0]['cid'];
			$data['has_group'] = $res;
			$this->load->view("live_view",$data);
		} 
		else {
			$loginUrl = $helper->getLoginUrl(APP_URL, $permissions);
			//echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
			echo "<script>window.top.location.href='".$loginUrl."'</script>";
		}
		
	}
	
	public function add_group($cid){
		$gid = $this->input->post("gid");
		$res = $this->Live_model->add_group($cid,$gid);
		// if($res=='success'){
			// $this->session->set_flashdata(array("msg"=>" added! "));
		// }
		redirect('Live/go_live/'.$cid);
	}
	
	public function go_live($cid){
		$res = $this->Live_model->check_group_by_cid($cid);
		$data['cid'] = $cid;
		$data['has_group'] = $res;
		$this->load->view("live_view",$data);
	}
  }