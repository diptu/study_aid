<?php  if (! defined('BASEPATH')) exit('No direct script access allowed');
	require 'application/vendor/Facebook/autoload.php';
   
    Class Facebook_model extends CI_model {


    	protected $ins;
        public $fb;
        public $permissions;
        public $helper;
        
    	public function __construct(){
            $this->ins =& get_instance();
            $this->ins->load->config('facebook');
            $this->redirectUrl = $this->ins->config->item('redirect_url');
            $this->permissions = $this->ins->config->item('permissions');
            
            
            if(! isset($_SESSION)){
            session_start();
        	}
    	}
        
        public function logged_in(){
            if(isset($_SESSION['accessToken'])){
                return TRUE;
            }else{
                return FALSE;
            }
        }

        public function getFb(){
            $fb = new Facebook\Facebook([

                 'app_id' => $this->ins->config->item('api_id'),
                 'app_secret' => $this->ins->config->item('api_secret'),
                 'default_graph_version' => 'v2.10',
                
                ]);
            return $fb;
        }

       
    	public function loginUrl(){
                $fb = $this->getFb();
                $this->helper = $fb->getRedirectLoginHelper();
				$loginUrl = $this->helper->getLoginUrl($this->redirectUrl, $this->permissions);
                return $loginUrl;

           
    	}

    
        public function setSession(){
            
            
            $fb = $this->getFb();
            $helper = $fb->getRedirectLoginHelper();

            try {
              $accessToken = $helper->getAccessToken();
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
              
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
              
            }

            if (isset($accessToken)) {
              
              $_SESSION['accessToken'] = (string) $accessToken;
            } 
			if ($helper->getError()) {

				return FALSE;
            }

            return TRUE;
        }


        public function getProfile(){
            $fb = $this->getFb();
            try {
          
			  $response = $fb->get('/me?fields=id,name,email,gender,link',$_SESSION['accessToken']);
			} catch(Facebook\Exceptions\FacebookResponseException $e) {
			  echo 'Graph returned an error: ' . $e->getMessage();
			  exit;
			} catch(Facebook\Exceptions\FacebookSDKException $e) {
			  echo 'Facebook SDK returned an error: ' . $e->getMessage();
			  exit;
			}

			$user = $response->getGraphUser();
			
			// print_r("<pre>");
			// print_r($user['birthday']);
			// print_r("</pre>");
			 return $user;

        }
        

      
        public function getDp(){
             $fb = $this->getFb();
             try {
                $uid = $this->getUserId();
                
                $response = $fb->get('/me/picture?type=large&redirect=false',$_SESSION['accessToken']);
                 } catch(Facebook\Exceptions\FacebookResponseException $e) {
                    echo 'Graph returned an error: ' . $e->getMessage();
                    exit;}
                catch(Facebook\Exceptions\FacebookSDKException $e) {
                    echo 'Facebook SDK returned an error: ' . $e->getMessage();
                     exit;
                }

                $picture =  $response->getGraphObject();
                $src = $picture['url'];
                return $src;

        }
        
        
        public function logoutUrl(){
            return $this->ins->config->item('logout_url');

        }

        public function logout(){
            if($this->logged_in()){
                unset($_SESSION['accessToken']);
                redirect($this->logoutUrl());
            }else{
                redirect($this->logoutUrl());
            }
            
        }
        
        public function getUserId(){
            $data = $this->getProfile();
            return $data['id'];

        }
    }