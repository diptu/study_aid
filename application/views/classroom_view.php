<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("type") && $this->session->userdata("type") == "faculty"){
?>
<div class="container">
  <div  class="row flat">
  <div class="col-lg-6 col-md-3 col-xs-8">
  				<ul  align="center" class="plan plan2">
            <form action="" method ="post">


  					<li class="plan-name">Create new Classroom
  					</li>
  					<li class="plan-price">
  						<strong>Class Name </strong>
  					</li>
  					<li>
  						<strong><input type="text"  class="form-control" name="className" required><br></strong>
  					</li>
  					<li>
  						<strong>About this class</strong>
  					</li>
  					<li>
  						<strong><input type="text"  class="form-control" name="about" required><br></strong>
  					</li>

  					<li class="plan-action">
  						<input type="submit" class="btn" name="create" value="Create">
  					</li>
            </form>
  				</ul>
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
