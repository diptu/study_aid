<?php

defined ('BASEPATH') OR EXIT ('no access given');
include('header.php');
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

     								<th ><li ><a  class="btn-theme btn-small" data-filter=".webdesign">Quiz name</a></li></th>
     								<th><li><a  class="btn-theme btn-small" data-filter=".webdesign"> Total questions</a></li></th>

     								<th><li><a  class="btn-theme btn-small" data-filter=".webdesign">Marks</a></li></th>
     								<th><li><a  class="btn-theme btn-small" data-filter=".webdesign">Duration</a></li></th>
     								<th><li><a  class="btn-theme btn-small" data-filter=".webdesign">Action</a></li></th>

     							  </tr>

                                    <?php foreach($quiz as $q){ ?>
                    							  <tr>
                    								<td><?=$q['title']?></td>
                    								<td><?=$q['total']?></td>
                    								<td><?=$q['each_ques_mark']*$q['total']?></td>
                    								<td><?=$q['duration']?></td>
                                    <?php if($q['is_published']==0 && $this->session->userdata("type")=="faculty"){?>
                    								      <!--here previous call was anchor("Quiz/participate/".$q['quiz_id'],"permit student access"-->
                    								       <td><?=anchor("Quiz/publish/".$q['quiz_id'],"permit student access");?></td>
                                    <?php   }   ?>

                                    <?php if($q['is_published']==0 && $this->session->userdata("type")=="student"){?>
                                                <td>unavailable</td>
                                    <?php } ?>

                                    <?php if($q['is_published']==1 && $this->session->userdata("type")=="faculty"){?>
                                                  <td>student access enabled </td>
                                    <?php } ?>


                                    <?php if($q['is_published']==1 && $this->session->userdata("type")=="student" ){
                                                  $is_participated = false;
                                                  $d = new DateTime($q['date']);
                                                      // five hour fast from UTC .. subtracted 5 hour 5*60*60
                                                  $targetDate =  $d->getTimestamp()  + $q['duration'] *60;
                                                  $actualDate = time();
                                                  $secondsDiff = $targetDate - $actualDate;
                                                  foreach ($his as  $value) {
                                                        if($value['quiz_id']==$q['quiz_id'])

                                                          $is_participated=true;
                                                  }

                                                        if(!$is_participated &&   $secondsDiff <1){

                                      ?>
                                                        <td>Missed</td>

                                                  <?php
                                                        }

                                                        else   if(!$is_participated &&   $secondsDiff >1){
                                                  ?>
                                            <!-- previously was anchor("Quiz/participate/".$q['quiz_id'],"Enter " -->
                                                      <td><?=anchor("Quiz/new_participate/".$q['quiz_id'],"Enter");?></td>

                                                  <?php
                                                        }

                                                        else{ ?>

                                                        <td>already participated</td> <?php

                                                          }
                                        }
                                    ?>

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
include('footer.php');
?>
