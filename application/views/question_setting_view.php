<?php
defined('BASEPATH') or exit ('no access given');
include('header.php');
if($this->session->userdata('type')=='faculty' && isset($quantity)!=NULL ){
?>



	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-9">



            <h3 class="section-title">Enter question(s) details </h3>
            <p>
            </p>




            <form  class="form-light mt-20" action="<?= base_url('Quiz/add_question/'.$quantity);?>" method="post">

              <input type="hidden"  name="quiz_title" value="<?=$quiz_title?>"> <br>
              <input type="hidden"  name="marks_per_question" value="<?=$marks_per_question?>"> <br>
              <input type="hidden"  name="time" value="<?=$time?>"> <br>
              <input type="hidden"  name="class_id" value="<?=$class_id?>"> <br>
              <?php
              $x=1;
              while ($quantity-- ){
              ?>
              <div class="form-group"
                <label><?="<br>Question Number ".$x."<br><br><br>";?></label>
              </div>

                <textarea rows="4" class="form-control" cols="50" name="question<?=$x?>" placeholder="Write question"></textarea> <br>
                <input type="text" class="form-control"  name="option1<?=$x?>" placeholder="Enter option a "> <br>
                <input type="text" class="form-control"  name="option2<?=$x?>" placeholder="Enter option b "> <br>
                <input type="text" class="form-control"  name="option3<?=$x?>" placeholder="Enter option c "> <br>
                <input type="text" class="form-control"  name="option4<?=$x?>" placeholder="Enter option a "> <br>


                Correct answer:<br>
                <select name="ans<?=$x?>">

                <option value="a">Option a</option>
                <option value="b">Option b</option>
                <option value="c">Option c</option>
                <option value="d">Option d</option>



                </select>
                <br><br>
                <hr>

                <?php
                $x++;
                }
                ?>
                <br>
                <input type="submit"  class="btn btn-two"  name="submit" value="submit">

              <p><br/></p>
            </form>


          </div>

				</div>
			</div>

	<!-- /container -->

<?php
}


else{
  redirect('Quiz/faculty_course_view');
  //redirect('Classroom/classroom'.$class_id);
  echo "sorry ! you are not allowed to access this page!";
}
include('footer.php');

 ?>
