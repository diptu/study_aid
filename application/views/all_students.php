
<?php

defined ('BASEPATH') OR EXIT ('no access given');
include('header.php');
if($this->session->userdata("type")=="faculty"){
/*
foreach ($h as $key => $value) {
    echo $value["full_name"]." ".$value["user_name"]."  score : ".$value["score"]." class id : ".$value["class_id"]."<br>";
}
*/
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
  					</p>
  					<div class="row">
  						<nav id="filter" class="col-md-12 text-center">
  							<ul>
                 <table style="width:100%" border="1">
    							  <tr >

    								<th ><li ><a  class="btn-theme btn-small" data-filter=".webdesign">User Name</a></li></th>
    								<th><li><a  class="btn-theme btn-small" data-filter=".webdesign">  Graph analysis</a></li></th>

    							

    							  </tr>

                     							  <?php foreach ($all_students as $value) { ?>
                     							  <tr>
                     								<td align="center"><?=$value['user_name']?></td>
													<td align="center"><?=anchor('Graph/get/'.$value['user_name'],'Click')?></td>
                     								<!--<td align="center"><?=$value['full_name']?></td>
                     								<td align="center"><?=$value['email']?></td>
                     								<td align="center"><?=$value['gender']?></td>
                     								<td align="center"><?=$value['score']?></td>-->
                     							  </tr>
                     							  <?php }?>

    							</table>


  							</ul>
  						</nav>

  					</div>

  				</section>
  			</div>
  		</div>

  	</section>
  	<!-- /container -->








<?php
}
else{
  echo "Sorry! you don't have permission to access this page!";
}
include('footer.php');
?>
