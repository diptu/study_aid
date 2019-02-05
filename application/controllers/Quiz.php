<?php
defined ('BASEPATH') OR EXIT ('No access given');


class Quiz extends CI_Controller{

	public function __construct(){

        parent:: __construct();
        $this->load->model('Quiz_model');
		// echo anchor("","Home<hr>");
	}


	public function index(){
        $this->load->view('quiz_view');
	}


	public function publish($quiz_id){
			$res = $this->Quiz_model->quiz_published($quiz_id);
			 $this->Quiz_model->upate_total_question($quiz_id);
			if(isset($res)==1)
				echo "Quiz has been published ";
			else {
				echo "something went wrong!";
			}
			redirect("Login");
	}

	public function new_participate($quiz_id){





		$data['quiz_id']=$quiz_id;
		//echo $data['quiz_id'];

		$quiz =$this->Quiz_model->get_quiz_info($quiz_id);
		$questions = $this->Quiz_model->get_questions($quiz_id);
		$options = $this->Quiz_model->get_options($questions);
				/*echo '<pre>';
				print_r($quiz);
				echo  '</pre>';*/
		//echo var_dump($question_id);
		//echo var_dump($option_id);

		$data['quiz'] = $quiz;
		$data['questions'] = $questions;
		$data['options'] = $options;


		///03-12-17
		/// test starts
		//$this->session->userdata("type")

				$check = $this->Quiz_model->check_history_by_quiz_id($this->session->userdata('username'),$quiz_id);

				if($check==0){
					$this->load->view('new_participate',$data);
				}

				else {
					$this->session->set_flashdata(array("err"=>"you have already been perticipated".$cid));
					redirect('Classroom/student_course_view');
					//echo "already perticipated<br>";
				}

		//$this->load->view('new_participate',$data);
	}













	public function rank($class_id){

			$res = $this->Quiz_model->get_ranking($class_id);
			/*$res = 	$this->Quiz_model->fatch_class_id($quiz_id);
			foreach ($res as $key => $value) {
					$q["class_id"]= $value["class_id"];
			}*/
			$r['res']=$res;
			//echo $q["class_id"];

		///this was right
				//$q['quiz_id']=$quiz_id;
				$this->load->view('rank_view',$r);
	}


	public function quiz_history($class_id){

		$history = $this->Quiz_model->get_quiz_history($class_id);
		/*foreach ($history as $key => $value) {
				echo $value["full_name"]." ".$value["user_name"]."  score : ".$value["score"]." class id : ".$value["class_id"]."<br>";
		}*/
		$h['history']=$history;

		$this->load->view("history_view",$h);


	}



	public function add_quiz($class_id){
		$data['class_id'] = $class_id;
        $this->load->view('add_quiz_view',$data);

	}

	public function view_quiz($class_id){

		//$data['quiz_his'] = $this->Quiz_model->check_quiz_participation($class_id,$this->session->userdata("username"));
		$quiz_his = $this->Quiz_model->check_quiz_participation($class_id,$this->session->userdata("username"));

		$data['quiz'] = $this->Quiz_model->view_quiz($class_id);
				///test start here
			$data['his']=	$quiz_his;
				/*echo '<pre>';
        print_r($data);
        echo  '</pre>';*/

				//$quiz =$this->Quiz_model->get_quiz_info($quiz_id);

				$this->load->view('quiz_view',$data);
	}

	public function question_details($class_id){
      $topic=$this->input->post();

		$topic['class_id'] = $class_id;

		$this->load->view('question_setting_view',$topic);

	}
	public function add_question($quantity){
		$quiz_title=$this->input->post('quiz_title');
		$marks_per_question=$this->input->post('marks_per_question');
		$time=$this->input->post('time');
		$class_id=$this->input->post('class_id');
		$quiz_id=$this->randomString(12);
		$set_quiz=$this->Quiz_model->set_quiz($quiz_id, $quiz_title, $marks_per_question, $time, $class_id, $quantity);
		if($set_quiz==1){
			$questions=$this->input->post();

			$set_questions = $this->Quiz_model->set_questions($quiz_id, $quantity, $questions);
			if($set_questions==1){
				redirect('Classroom/classroom/'.$class_id);
			}
		}



	}

	public function participate($quiz_id){

		$data['quiz_id']=$quiz_id;
		//echo $data['quiz_id'];

		$quiz =$this->Quiz_model->get_quiz_info($quiz_id);
		$questions = $this->Quiz_model->get_questions($quiz_id);
		$options = $this->Quiz_model->get_options($questions);
				/*echo '<pre>';
        print_r($options);
        echo  '</pre>';*/
		//echo var_dump($question_id);
		//echo var_dump($option_id);

		$data['quiz'] = $quiz;
		$data['questions'] = $questions;
		$data['options'] = $options;

		///03-12-17
		/// test starts
		//$this->session->userdata("type")

		$this->load->view('participate',$data);
	}


	public function submit_answer(){


			$_SESSION['targetdate'] = null;
			$hh = $this->input->post();
			//echo $hh[0]['quiz_id'];
			/*foreach ($hh as $h=>$ans) {
				print_r($h."-".$ans."<br>");
			}*/
			/*echo '<pre>';
			print_r($this->input->post());
			echo  '</pre>';*/

			//$correct_answer = $this->Quiz_model->compute_result($hh);
			$data = $this->Quiz_model->compute_result($hh);


			//echo var_dump($data)."<br>";
			//echo "currect answer : ".$correct_answer."<br>";
			echo $this->session->userdata("username");

			echo "<br>Total attampts  question : ".$data['attampts']."<br>currect answer : ".$data['no_of_currect_answer']."<br>";

			//$total_questions = $this->Quiz_model->amount_of_questions($hh['quiz_id']);
			$total_questions = $this->Quiz_model->total_questions($hh['quiz_id']);
			$w=(int)$data['attampts'] - (int)$data['no_of_currect_answer'];
			echo "total number questions : ".$total_questions;
			echo "<br>Wrong answer : ".$w."<br>";

			$marks_per_questions = $this->Quiz_model->marks_for_each_question($hh['quiz_id']);
			$obtain_marks = $marks_per_questions * (int)$data['no_of_currect_answer'];
			$total_marks = $total_questions * $marks_per_questions;
			echo "<br>Total marks : ".$total_marks;
			echo "<br> Marks obtain : ".$obtain_marks;

				/// test starts here
			$res = $this->Quiz_model->fatch_class_id($hh['quiz_id']);
			foreach ($res as $key => $value) {
					$class_id= $value["class_id"];
			}


						$previous_score = $this->Quiz_model->check_previous_score($class_id,$this->session->userdata("username"));


							$pre_score = 0;
							$rank_uname = NULL;


								foreach ($previous_score as $key => $value) {
									if($value["user_name"]!=NULL){
										$pre_score= $value["score"];
										$rank_uname = $value["user_name"];
									}




						}
						//echo $uname;

			$his=	$this->Quiz_model->history($this->session->userdata("username"),$hh['quiz_id'],$obtain_marks,(int)$data['no_of_currect_answer'],$w,$class_id,$pre_score,$rank_uname);
			if(isset($his)==1){
				echo "<br>Your quiz performance has been updated!";
			}

	}
	
	
	public function randomString($length =10 ) {
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) {
			$rand = mt_rand(0, $max);
			$str .= $characters[$rand];
		}
		return $str;
	}

}


?>
