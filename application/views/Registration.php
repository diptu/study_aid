<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("username")==null){
// if(!isset($username)){

// }
// else{
	// echo anchor('Registration/logout','Logout from '.$name);
	// echo "<br><br>";
// }
?>



	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>Study aid </title>
	<link rel="favicon" href="<?=base_url()?>/assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/font-awesome.min.css">
	<!-- Custom styles-->
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="<?=base_url()?>/assets/css/style.css">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="<?=base_url()?>/assets/js/html5shiv.js"></script>
	<script src="<?=base_url()?>/assets/js/respond.min.js"></script>
	<![endif]-->


	<!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<a class="navbar-brand" href="/">
					<img src="<?=base_url()?>/assets/images/234.png" height="200%" alt="Logo"></a>
			</div>
		</div>
	</div><br><br>





	<!--<div class="container">

		<div class="login-form">
			<div class="form-header">
				<h1 class="text-center">Registration</h1>
			</div>
			<form id="login-form" method="post" class="form-signin" role="form" action="">
				<input name="username" id="username" type="text" class="form-control" placeholder="Username" autofocus>
				<input name="fullName" id="fullName" type="text" class="form-control" placeholder="Full name">
				<input name="userEmail" id="email" type="email" class="form-control" placeholder="Email address">
				<input name="password" id="password" type="password" class="form-control" placeholder="New password">
				<input name="mobile_number" id="mobile_number" type="text" class="form-control" placeholder="Mobile">
				<input name="address" id="address" type="text" class="form-control" placeholder="Address">
				<input name="birthday" id="birthday" type="date" class="form-control" placeholder="Birthday">
				<select name="gender" class="form-control" required>
					<option value="">Select gender</option>
					<option value="male" <?php if(isset($gender) && $gender=="male") echo "checked"; ?>>Male</option>
					<option value="female" <?php if(isset($gender) && $gender=="female") echo "checked"; ?>>Female</option>
				</select>
				<select name="type" class="form-control" required>
					<option value="">Sign up as</option>
					<option value="faculty">Faculty</option>
					<option value="student">Student</option>
				</select>
				<input class="btn btn-block bt-login" name="register-user" type="submit" value="Sign up">

			</form>

			<div class="form-footer">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
						<?= anchor($login_url,"Login with Facebook"); ?>

					</div>

					<div class="col-xs-6 col-sm-6 col-md-6">
						<?= anchor("Login","Sign in"); ?>
					</div>
				</div>
			</div>
			<br/>

		</div>
	</div>-->


	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-8">
						<center><h3 class="section-title">Registration</h3></center>




						<form class="form-light mt-20"  method="post"  role="form" action="">
							<div class="form-group">
								<label>Username</label>
							<input name="username" id="username" type="text" class="form-control" placeholder="Username" value="<?php if (isset($username)){ echo $username;}?>" autofocus>
							</div>

							<div class="form-group">
								<label>Full name</label>
							<input name="fullName" id="fullName" type="text" class="form-control" placeholder="Full name" value="<?php if (isset($name)){ echo $name;}?>">
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input name="userEmail" id="email" type="email" class="form-control" placeholder="Email address" value="<?php if (isset($email)){ echo $email;}?>">
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Phone</label>
										<input type="text" class="form-control" placeholder="Phone number">
									</div>
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input name="password" id="password" type="password" class="form-control" placeholder="New password">

							</div>

							<div class="form-group">
								<label>Address</label>
								<input name="address" id="address" type="text" class="form-control" placeholder="Address">

							</div>

							<div class="form-group">
								<label>Birthday</label>
								<input name="birthday" id="birthday" type="date" class="form-control" placeholder="Birthday">
							</div>

							<select name="gender" class="form-control" required>
					<option value="">Select gender</option>
					<option value="male" <?php if(isset($gender) && $gender=="male") echo "checked"; ?>>Male</option>
					<option value="female" <?php if(isset($gender) && $gender=="female") echo "checked"; ?>>Female</option>
				</select><br>
				<select name="type" class="form-control" required>
					<option value="">Sign up as</option>
					<option value="faculty">Faculty</option>
					<option value="student">Student</option>
				</select><br>
				<center><input class="btn btn-two" name="register-user" type="submit" value="Sign up"></center>

							<p><br/></p>
						</form>


					</div>

					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<h3 class="section-title">Contact us</h3><br>
								<div class="contact-info">
									<h5>Address</h5>
									<p>Please stay tuned . Contact information will be provided soon .</p>

									<h5>Email</h5>
									<p>studyaid@gmail.com</p>

									<h5>Phone</h5>
									<p>+8801708400643</p>
								</div>
							</div>
						</div>
					</div>


						<div class="row">
							<div class="col-md-8">
								<?= anchor($login_url,"Login with Facebook"); ?>
							</div>

							<div class="col-md-8">
								<?= anchor("Login","Sign in"); ?>
							</div>
						</div>


				</div>
			</div>
	<!-- /container -->



<?php
}
else{
	redirect("Login");
}
include('footer.php');
 ?>
