<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("type") && $this->session->userdata("type") == "student"){




?>

<div class="container">

  <?php
  if($this->session->flashdata('err')!=null){
    echo $this->session->flashdata('err').'<br>';
  }

  foreach ($res->result_array() as  $row2) {

?>

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
              <?= anchor("Live/view_live/".$row2['cid'],"View Live")?>

    					</li>

    				</ul>
    			</div>
        </div>

      <?php } ?>
    </div>

<?php }
else{
redirect("Login");

}
include('footer.php');
?>
