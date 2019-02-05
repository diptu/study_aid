<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("type") && $this->session->userdata("type") == "student"){
?>

<div class="content">
     	<div class="container">
     		<div class="row">

	     		<div class="col-xs-12 col-sm-6 col-md-5 col-lg-12">
	     			<div class="row btn-c well">
	     				<div class="col-xs-12 col-sm-6 col-md-5 col-lg-12">
	     					<?php
								
							if(isset($LiveVideo) && $LiveVideo!=null){
								if($LiveVideo['status']!='VOD'){
									echo $LiveVideo['embed_html']."<hr>";
								}
								else{
									echo 'Video is not live right now';
								}
							}
							else{
								echo 'Not available';
							}
							
								
							
							
							?>
	     				</div>
	     			</div>

	     		</div>

			</div>
     	</div>
    </div>


<?php
}
else{
redirect("Login");

}
include('footer.php');
?>
