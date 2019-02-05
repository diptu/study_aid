<?php
defined ('BASEPATH') OR EXIT ('no access given');

include('header.php');

if($this->session->userdata('type')=='faculty'){

?>



	<!-- container -->
	<div class="container">
				<div class="row">
					<div class="col-md-8">
						<h3 class="section-title">Add Quiz</h3>
						<p>
						</p>

              <form  class="form-light mt-20" action="<?= base_url('Quiz/question_details/'.$class_id);?>" method="post">
							<div class="form-group">
								<label>Title</label>
                <input type="text" class="form-control"  name="quiz_title" placeholder="Enter quiz title">
							</div>

              <div class="form-group">
								<label>Question Amount</label>
                  <input type="number"  class="form-control" name="quantity" min="1"   placeholder="Enter question amount">

							</div>

              <div class="form-group">
                <label>Marks per question</label>
              <input type="number"  class="form-control" name="marks_per_question" min="1"   placeholder="Marks per question">
              </div>

							<div class="form-group">
								<label>duration</label>
								  <input type="number" class="form-control"  name="time" min="1"   placeholder="Quiz duration (in minute)">
							</div>
                <input type="submit" class="btn btn-two" name="go" value="submit">
							<p><br/></p>
						</form>
					</div>
					<div class="col-md-4">
						<div class="row">
							<div class="col-md-6">
								<h3 class="section-title">Description</h3>
								<div class="contact-info">
									<h5>Title</h5>
									<p>Give this quiz a prpper title to uniquely identify </p>

									<h5>Marks per question</h5>
									<p>Each question will carry same amount of marks which will be used to provide overview of the Prerformance</p>

									<h5>Duration</h5>
									<p>Please set one or two minute extra in case there is a possibility of slow internet service </p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<!-- /container -->


<?php
}else{
    echo "sorry you are not allowed to access this page!";
}


include('footer.php');
?>


