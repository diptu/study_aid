<?php
defined('BASEPATH') OR exit('No direct script access allowed');
include('header.php');
if($this->session->has_userdata("type")){

?>



	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-8">


							<h3 class="section-title">
								<?="Class name :  ".$cname."<br>Semester :  ".$semester." "
								.$year."<br>Faculty		:	 ".$owner."<br>";?></h3>


						<?php
						if(isset($msg)) echo  $msg;
						?>
						<?php if($this->session->flashdata('msg')) { ?>
								 <div role="alert" class="alert alert-success">
										 <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>

										 <?=$this->session->flashdata('msg')?>
								 </div>
						 <?php } ?>
						<form action="<?=base_url("Classroom/add_status/".$cid)?>" method="post" enctype="multipart/form-data">
			<br>
							<textarea class="form-control" name="announcement" placeholder="Write a status..."rows=5></textarea><br>

							<br>      <input type="file" name="attachment" value="<?php if(isset($_POST['attachment'])!=null)echo basename($_FILES['attachment']['name']);?> "/>


						</br><center><input type="submit" class="btn btn-two"  name="post" value="Post"/></center>
						</form>

					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<h3 class="section-title">Option</h3>
								<div class="contact-info">

									<?php

									if($this->session->userdata("type")=="faculty"){?>

									<p>	<?=anchor("Quiz/add_quiz/".$cid, "Add quiz")."<br>";?> </p>
										<p><?=anchor("Quiz/quiz_history/".$cid, "View quiz history")."<br>";?></p>
										<p><?= anchor("Quiz/rank/".$cid, "View class ranking ")."<br>"; ?></p>
										
										<p><?= anchor("Classroom/all_students/".$cid, "View Students")."<br>"; ?></p>
									<?php } ?>

									<p> <?=anchor("Quiz/view_quiz/".$cid, "View quiz")."<br>"; ?></p>

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<!-- /container -->


<br><br><br>




	<!-- container -->

	<!-- /container -->


	<?php

	if(isset($posts)){
	?>

	<div class="container">
				<div class="row">
					<div class="col-md-8">

						<h3 class="section-title">Previous post(s)</h3>

						<?php

						 if($this->session->flashdata('comment_response')) { ?>
								 <div role="alert" class="alert alert-success">
										 <button data-dismiss="alert" class="close" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>

										 <?=$this->session->flashdata('comment_response')?>
								 </div>
						 <?php } ?>


					</div>

				</div>
			</div><br><br>

	<?php


		foreach($posts as $p){
	?>

		<div class="container">
					<div class="row">
						<div class="col-md-8">


							<div class="col-xs-12 col-sm-6 col-md-5 col-lg-12">
						   		<div class="row btn-c well">
											<div class="col-xs-12 col-sm-6 col-md-5 col-lg-12">
	<?php
			echo "<b>".$p['full_name']."</b> - <font color='grey'>".$p['created_date']."</font><br><br>";
			echo "<p>".$p['text']."</p><br>";
			if(isset($p['attachment']) && $p['attachment']!=''){

				echo "<h3>Attachment: <a href='".base_url('attachments/post/'.$p['pid'].'/'.$p['attachment'])."' target='_blank'>".$p['attachment']."</a></h3><br>";
			}




	?>



			<form action="<?=base_url("Classroom/add_comment/".$p['pid'])?>" method="post">
				<br>
				<input class="form-control" type="text" placeholder="Make a comment ... "  name="cmnt_<?=$p['pid'];?>"><br>
				<input type="hidden" name="cid" value="<?=$cid?>"/>
				<input type="submit" name="button_<?=$p['pid'];?>" value="comment"/>
			</form>


	<?php
			$comment= $get_comment($p['pid']);
			if(isset($comment)){

				 echo "<br><br><br>previous Comments : <br><br>";
				 foreach ($comment as $c) { ?>

					<p> <?= "<br>".$c['user_name'].": ".$c['text'];?></p>

				 <?php }
				 echo "<hr>";
			}


	?>						</div>
								</div>
								</div>
							</div>

						</div>
					</div><br><br>

	<?php

}


	?>


	<?php

	}
	?>


    </div>




<?php

}
else{
	redirect("Login");

}

include('footer.php');
?>
