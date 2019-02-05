<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("type") && $this->session->userdata("type") == "faculty"){
?>






	<!-- container -->
	<section class="container">
		<div class="row">
			<div class="col-md-12">
				<section id="portfolio" class="page-section section appear clearfix">
					<br />
					<br />
					<br />
						<br />



					<div class="row">

						<div class="col-md-12">
							<div class="row">
								<div class="portfolio-items isotopeWrapper clearfix" id="3">

									<article class="col-sm-4 isotopeItem print">
										<div class="portfolio-item">
											<img src="<?=base_url()?>assets/images/0.jpg" alt="" />
											<div class="portfolio-desc align-center">
												<div class="folio-info">

														<h5>Live Lecture</h5>

												</div>
											</div>
										</div>
									</article>
									<!-- Sidebar -->
									<aside class="col-sm-4 sidebar sidebar-right">

											<div class="panel">
												<h3>Go Live </h3>



                        <?php
        								if($this->session->flashdata('faculty_err')!=null){
        								  echo $this->session->flashdata('faculty_err').'<br>';
        								}
        								if($has_group==null){
        								echo 'First create a facebook '.anchor("https://www.facebook.com/groups/","group").' and fetch its id.';

        							?>
        							<br><br>
        							<form id="login-form" method="post" class="form-signin" role="form" action="<?=base_url('Live/add_group/'.$cid)?>">
        								<input name="gid" id="gid" type="text" class="form-control" placeholder="Group id" autofocus>

        								<input class="btn btn-block bt-login" name="add_group" type="submit" value="Add group">
        							</form>

        							<?php
        								}
        								else if(!isset($create_live_video)){
        									echo $has_group[0]['gid'];
        							?>
        							<br><br>
        								<form id="login-form" method="post" class="form-signin" role="form" action="<?=base_url('Live/start_live/'.$has_group[0]['gid'])?>">
        									<input name="title" id="title" type="text" class="form-control" placeholder="Video title" autofocus>
        									<input name="description" id="description" type="text" class="form-control" placeholder="Video description">

        									<input class="btn btn-block bt-login" name="start_live" type="submit" value="Start live">
        								</form>




        							<?php

        								}
        								else{
        									$e = explode('/', $create_live_video['stream_url']);
        									echo $create_live_video['id']."<br>".$e[4];

        								}

        							?>


											</div>

									</aside>
									<!-- /Sidebar -->


								</div>

							</div>


						</div>
					</div>

				</section>
			</div>
		</div>

	</section>
	<!-- /container -->



<?php
}
else{
redirect("Login");

}
include('footer.php');
?>
