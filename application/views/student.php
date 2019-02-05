<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("type") && $this->session->userdata("type") == "student"){

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
											<img src="<?=base_url()?>assets/images/portfolio/img7.jpg" alt="" />
											<div class="portfolio-desc align-center">
												<div class="folio-info">

														<h5><?=anchor("Classroom/student_course_view","view courses");?></h5>

												</div>
											</div>
										</div>
									</article>
									<!-- Sidebar -->
									<aside class="col-sm-4 sidebar sidebar-right">

											<div class="panel">
												<h3>Add a classroom </h3>
													<form action="<?php echo base_url('Classroom/enroll_student');?>" method="post">


													<input type="text" name="access_key" placeholder="Input Access Key"><br><br>
													<input type="submit" name="submit" class="btn btn-two" value="	Submit"><br>
												</form>

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
