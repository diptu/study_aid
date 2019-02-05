<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("username")){

  if($this->session->has_userdata("type") && $this->session->userdata("type") == "student"){


    redirect("Login/student");

  }
  else if($this->session->has_userdata("type") && $this->session->userdata("type") == "faculty"){


    redirect("Login/faculty");
  }


}
else{
?>

	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>Study aid </title>
	<link rel="favicon" href="assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<!-- Custom styles-->
	<link rel="stylesheet" href="assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="assets/css/style.css">


	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<center><a class="navbar-brand" href="#">
					<img src="assets/images/234.png" height="200%" alt="Tomaly thik kore kaj kore nai"></a></center>
			</div>
		</div>
	</div><br><br>




	<div class="container">
				<div class="row">
					<div class="col-md-8">
						<center><h3 class="section-title">Login</h3></center>






						<form class="form-light mt-20"  method="post"  role="form" action="">
							<div class="form-group">
								<label>Username</label>
							<input name="username" id="username" type="text" class="form-control" placeholder="Username" autofocus>
							</div>


							<div class="form-group">
								<label>Password</label>
								<input name="password" id="password" type="password" class="form-control" placeholder="New password"><br>
							</div>

				<center><input class="btn btn-two" name="login" type="submit" value="Sign in"></center>

							<p><br/></p>
						</form>
					</div>


				<!--<div class="row">
					<div class="col-md-8">
						<?= anchor("","Login with Facebook"); ?>

					</div>-->

					<div class="col-md-8">
						<?= anchor("Registration","Sign up"); ?>
					</div>
				</div>



			</div>
			</div>
	<!-- /container -->


<?php

}
include('footer.php');
?>
