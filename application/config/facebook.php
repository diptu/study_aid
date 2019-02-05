<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$config['api_id']       = '1991410494465424';
$config['api_secret']   = 'fcc0cf93a7e8d233ff38db7d9f8a0acd';
$config['redirect_url'] = base_url('Registration/user_login');
$config['logout_url']   = base_url('Registration');      
$config['permissions']  = array('email','public_profile','user_birthday','user_location');

?>
