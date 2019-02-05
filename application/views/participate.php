<?php
defined ('BASEPATH') OR EXIT ('no access given');

include('header.php');

  //echo $quiz[0]['duration'];
    /*echo '<pre>';
    print_r($quiz);
    echo  '</pre>';*/
  //  echo var_dump($quiz);
 ?>


<div class="content">
	<div class="container">
		<div class="row">

			<div class="col-xs-12 col-sm-6 col-md-5 col-lg-12">
				<div class="row btn-c well">
					<div class="col-xs-12 col-sm-6 col-md-5 col-lg-12">

						<h3 class="text-center text_underline"> Timer : <span id='timer'></span> </h3><hr>

						<form class="form-horizontal" id='quiz_form' role="form" action='<?=base_url("Quiz/submit_answer")?>' method='post'>
             <input type="hidden" value="<?php echo $quiz_id ?>" name="quiz_id"/>
              <?php
							foreach ($questions as $q) {

								echo "<h2>".$q['ques_text']." ?</h2><br>";

								foreach ($options as $q2) {
									if($q['question_id']==$q2['question_id']){
							?>

										<input type="radio" value="<?= $q2['option_id'] ?>" id='op_<?= $q2['option_id'];?>' name='<?= $q['question_id'];?>'/>
										<label for="op_<?= $q2['option_id'];?>"><?= $q2['option_text'];?></label>
										<br>


							<?php  	}
								}
								echo '<hr>';


							}

							?>

							<button class='next btn btn-success' type='submit'>Submit</button>
						</form>

					</div>
				</div>

			</div>

		</div>
	</div>
</div>

	 <script>
   <?php
   if (isset($_SESSION['targetdate'])) {
       $targetDate = $_SESSION['targetdate'];
   } else {

       $targetDate = time() + ($quiz[0]['duration'] *60);
       $_SESSION['targetdate'] = $targetDate;
   }
   $actualDate = time();
   $secondsDiff = $targetDate - $actualDate;


    ?>
		var c = <?= $secondsDiff;?>;
        var t;
        timedCount();

        function timedCount() {

        	var hours = parseInt( c / 3600 ) % 24;
        	var minutes = parseInt( c / 60 ) % 60;
        	var seconds = c % 60;

        	var result = (hours < 10 ? "0" + hours : hours) + ":" + (minutes < 10 ? "0" + minutes : minutes) + ":" + (seconds  < 10 ? "0" + seconds : seconds);


        	$('#timer').html(result);
            if(c == 0 ){
            	setConfirmUnload(false);
                $("#quiz_form").submit();
            }
            c = c - 1;

            t = setTimeout(function(){ timedCount() }, 1000);
        }

	 </script>


 <script type="text/javascript">

    setConfirmUnload(true);
    function setConfirmUnload(on)
    {
        window.onbeforeunload = on ? unloadMessage : null;
    }
    function unloadMessage()
    {
        return 'Do not load this page';
    }

    $(document).on('click', 'button:submit',function(){
    	setConfirmUnload(false);
    });



</script>
<?php
include('footer.php');
?>
