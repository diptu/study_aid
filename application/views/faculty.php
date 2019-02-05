<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');


if($this->session->has_userdata("type") && $this->session->userdata("type") == "faculty"){

  if(!isset($res)){
?>


  <div class="container">
    <div class="row">
					<div class="col-md-3">
						<div class="grey-box-icon">
							<div class="icon-box-top grey-box-icon-pos">

                <img src="<?base_url()?>assets/images/1.png" alt="" />
							</div><!--icon box top -->
							<h4>Create Classroom</h4>
							<p>Under create classroom section you can create a new classroom.
              You will provided by an access key . To enter this classroom student will need this access key. </p>
     						<p><a href="#"><em>Read More</em></a></p>
						</div><!--grey box -->
					</div><!--/span3-->
					<div class="col-md-3">
						<div class="grey-box-icon">
							<div class="icon-box-top grey-box-icon-pos">
								<img src="<?base_url()?>assets/images/2.png" alt="" />
							</div><!--icon box top -->
							<h4>Create online quiz</h4>
							<p>You can set quiz under your classroom .
              You can publish this quiz only then student will be given permission to
            participate this quiz for amount of time you have fixed.  </p>
     						<p><a href="#"><em>Read More</em></a></p>
						</div><!--grey box -->
					</div><!--/span3-->
					<div class="col-md-3">
						<div class="grey-box-icon">
							<div class="icon-box-top grey-box-icon-pos">
								<img src="<?base_url()?>assets/images/3.png" alt="" />
							</div><!--icon box top -->
							<h4>Live lecture</h4>
							<p>You can go live and system will generate a id for the specfic classroom which will be intigrated with facebook group  </p>
     						<p><a href="#"><em>Read More</em></a></p>
						</div><!--grey box -->
					</div><!--/span3-->
					<div class="col-md-3">
						<div class="grey-box-icon">
							<div class="icon-box-top grey-box-icon-pos">
								<img src="<?base_url()?>assets/images/4.png" alt="" />
							</div><!--icon box top -->
							<h4>Graphical analysis</h4>
							<p>Prerformance of the student represented in grap section for better experience .</p>
     						<p><a href="#"><em>Read More →</em></a></p>
						</div><!--grey box -->
					</div><!--/span3-->
				</div>
    </div>
<?php }else{ ?>

<div class="container">

  <?php
  if($this->session->flashdata('faculty_err')!=null){
    echo $this->session->flashdata('faculty_err').'<br>';
  }
  if(isset($res)){
    foreach ($res->result_array() as  $row2) {?>







    <div class="col-md-4">
    <div  class="row flat">



    				<ul  align="center" class="plan plan2">



    					<li class="plan-name">Explore this Classroom
    					</li>
    					<li class="plan-price">
    						<strong>Class Name </strong>
    					</li>
    					<li>
    						<strong><?=anchor("Classroom/classroom/".$row2['cid'], $row2['cname']."<br>".$row2['about']."<br>".$row2['owner']) ?></strong>
    					</li>
    					<li>
    						<strong>Live lecture</strong>
    					</li>

    					<li class="plan-action">
              <?= anchor("Live/go_live/".$row2['cid'],"Go Live")?>

    					</li>

    				</ul>
    			</div>
        </div>



  <?php }

}else{
    //echo "Welcome!";
  }
   ?>

</div>







<?php }

}else{
redirect("Login");

}
include('footer.php');
?>
