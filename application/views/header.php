<!--
Author: WebThemez
Author URL: http://webthemez.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="free-educational-responsive-web-template-webEdu">
	<meta name="author" content="webThemez.com">
	<title>Study aid </title>
	<link rel="favicon" href="<?=base_url()?>assets/images/favicon.png">
	<link rel="stylesheet" media="screen" href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,700">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/font-awesome.min.css">
	<!-- Custom styles-->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap-theme.css" media="screen">
	<link rel="stylesheet" href="<?=base_url()?>assets/css/style.css">
	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="assets/js/html5shiv.js"></script>
	<script src="assets/js/respond.min.js"></script>
	<![endif]-->
</head>

<body>

 <?php
 if($this->session->has_userdata("type") && $this->session->userdata("type") == "student"){

?>
<!-- Fixed navbar -->
<div class="navbar navbar-inverse">
 <div class="container">
	 <div class="navbar-header">
		 <!-- Button for smallest screens -->
		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
		 <a class="navbar-brand" href="<?=base_url()?>">
			 <img src="<?=base_url()?>assets/images/234.png" height="200%" alt="Tomaly thik kore kaj kore nai"></a>
	 </div>
	 <div class="navbar-collapse collapse">
		 <ul class="nav navbar-nav pull-right mainNav">
			 <li ><a href="<?=base_url()?>">HOME</a></li>
					<li><?= anchor('Classroom/student_course_view','COURSES');?></li>

					<li class="dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Welcome <?=$this->session->userdata("username");?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<!--<li><a href="sidebar-right.html">Right Sidebar</a></li>-->
							<li> <?= anchor("Login/logout", "Logout");?></li>

						</ul>
					</li>
					<!--<li><a href="contact.html">Contact</a></li>-->
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div><br><br><br>
	<!-- /.navbar -->

	<?php

	}
	 else if($this->session->has_userdata("type") && $this->session->userdata("type") == "faculty"){
	?>
	 <!-- Fixed navbar -->
	<div class="navbar navbar-inverse">
		<div class="container">
			<div class="navbar-header">
				<!-- Button for smallest screens -->
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
				<a class="navbar-brand" href="<?=base_url()?>">
					<img src="<?=base_url()?>assets/images/234.png" height="200%" alt="Tomaly thik kore kaj kore nai"></a>
			</div>
			<div class="navbar-collapse collapse">
				<ul class="nav navbar-nav pull-right mainNav">
					<li ><a href="<?=base_url()?>">HOME</a></li>

					<li ><?= anchor('Classroom/faculty_course_view','COURSES');?></li>
					<li><?=anchor("Classroom/new_classroom", "CREATE A NEW CLASS")."<br>";?></li>
					<li class="dropdown ">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						Welcome <?=$this->session->userdata("username");?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<!--<li><a href="sidebar-right.html">Right Sidebar</a></li>-->
							<li> <?= anchor("Login/logout", "Logout");?></li>

						</ul>
					</li>
					<!--<li><a href="contact.html">Contact</a></li>-->
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div><br><br><br>
	<!-- /.navbar -->


	<?php
	}
	?>
<body>
