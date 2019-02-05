<?php
defined ('BASEPATH') OR EXIT ('No access given');


class Quiz_model extends CI_model{

	public function total_questions($quiz_id){
		$sql = "SELECT total from quiz where quiz_id=".$this->db->escape($quiz_id);
		$sql2 = $this->db->query($sql);

		$res  = $sql2->result_array();
		$total = 0;
		foreach ($res as $key => $value) {

			$total			= $value['total'];
		}

		return	 (int)$total;

	}

		public function upate_total_question($quiz_id){
			$sql = "SELECT count(*) as left_blank , total FROM questions as que,`quiz` as q WHERE  que.quiz_id=q.quiz_id and que.ques_text='' and que.quiz_id="
			.$this->db->escape($quiz_id);
			$sql2 = $this->db->query($sql);

			$res  = $sql2->result_array();
			$left_blank=0;
			$total = 0;
			foreach ($res as $key => $value) {
				$left_blank = $value['left_blank'];
				$total			= $value['total'];
			}
			$left_blank =  (int)$left_blank;
			$total			=	 (int)$total - $left_blank;
			//echo $total;
			$sql3 ="UPDATE `quiz` SET `total`=".$this->db->escape($total)." WHERE quiz_id=".$this->db->escape($quiz_id);
			 $this->db->query($sql3);

	 	 		return $this->db->affected_rows();
			/*echo '<pre>';
			print_r($res);
			echo  '</pre>';*/
		}

		public function  check_history_by_quiz_id($user_name,$quiz_id){
			//echo $user_name;
			$sql="SELECT * FROM `history` WHERE user_name=".$this->db->escape($user_name)." and quiz_id=".$this->db->escape($quiz_id);
			$sql2=$this->db->query($sql);
			$result=$sql2->result_array();
		if(isset($result[0]['quiz_id'])==NULL)
		 		return 0;
			else
		 			return 1;


			/*echo '<pre>';
			print_r($result);
			echo  '</pre>';*/

		}

		public function quiz_published($quiz_id){
			$attampt_date = date("Y-m-d H:i:s");

			$q = "UPDATE `quiz` SET `date`=".$this->db->escape($attampt_date)." ,`is_published`=1 WHERE quiz_id=".$this->db->escape($quiz_id);
				$this->db->query($q);
			//echo	var_dump($q);
			return $this->db->affected_rows();


		}

		public function check_quiz_participation($class_id,$user_name){


			$sql = "SELECT distinct q.quiz_id,h.user_name FROM `quiz`as q , `history` as h WHERE q.quiz_id = h.quiz_id and q.class_id ="
			.$this->db->escape($class_id)." and h.user_name=".$this->db->escape($user_name);
			$sql2 = $this->db->query($sql);
			$res = $sql2->result_array();
			return $res;
		}


		public function fatch_class_id($quiz_id){
			$sql="SELECT distinct class_id FROM `quiz` WHERE quiz_id=".$this->db->escape($quiz_id);
			$sql2 = $this->db->query($sql);
			$res = $sql2->result_array();

			/*echo '<pre>';
			print_r($res);
			echo  '</pre>';*/

			return $res;


	}

	public function check_previous_score($class_id,$username){

					$s1 = "SELECT * FROM `rank`  WHERE user_name=".$this->db->escape($username)." and class_id=".$this->db->escape($class_id);
					$s2 = $this->db->query($s1);
					$res = $s2->result_array();
					/*echo '<pre>';
					print_r($res);
					echo  '</pre>';*/
					return $res;

	}

	public function get_ranking($class_id){

			$s1 = "SELECT * FROM `rank` as r , `user` as u WHERE r.user_name=u.user_name and r.class_id=".$this->db->escape($class_id)."ORDER by score DESC";
			$s2 = $this->db->query($s1);
			$res = $s2->result_array();
			/*echo '<pre>';
			print_r($res);
			echo  '</pre>';*/
			return $res;

	}


	public function get_quiz_history($class_id){

			$sql="SELECT * FROM `history` as h , `quiz` as q ,`user` as u where h.quiz_id = q.quiz_id and h.user_name=u.user_name and q.class_id ="
			.$this->db->escape($class_id)." ORDER by q.quiz_id ";

			$sql2=$this->db->query($sql);
			$res=$sql2->result_array();
			/*foreach ($res as $key => $value) {
				  echo $value["user_name"]."<br>";
			}*/

			/*echo '<pre>';
			print_r($res);
			echo  '</pre>';*/


			return $res;


	}


	public function history($username,$quiz_id,$score,$correct,$wrong,$class_id,$previous_score,$rank_uname){

		$attampt_date = date("Y-m-d H:i:s");
		$total_score = $score + $previous_score ;

		//echo $total_score;
		//$q3 = "UPDATE `rank` SET `score`="20  WHERE user_name="shadhin" and class_id = 1;"

		if($rank_uname==NULL){
		$q2= "INSERT INTO `rank`(user_name,score,time,class_id) VALUES (".$this->db->escape($username).
		",".$this->db->escape($score).",".$this->db->escape($attampt_date).",".$this->db->escape($class_id).")";

		$this->db->query($q2);
		}
		else{

			$q3 = "UPDATE `rank` SET `score`=".$this->db->escape($total_score)." WHERE user_name=".$this->db->escape($username)." and class_id =".$this->db->escape($class_id);
			$this->db->query($q3);
		}

		$q1="INSERT INTO history(user_name,quiz_id, score,correct,wrong,date)
		VALUES(".$this->db->escape($username).",".$this->db->escape($quiz_id).",".$this->db->escape($score).",
		".$this->db->escape($correct).",".$this->db->escape($wrong).","
		.$this->db->escape($attampt_date).")";
		$this->db->query($q1);
		return $this->db->affected_rows();

	}




	public function marks_for_each_question($quiz_id){
		$sql="SELECT each_ques_mark FROM quiz WHERE quiz_id=".$this->db->escape($quiz_id) ;
		$sql2=$this->db->query($sql);
		$res=$sql2->result_array();
		$marks_per_questions=(int)$res[0]["each_ques_mark"];

		return $marks_per_questions;


	}


	public function amount_of_questions($quiz_id){
		//echo "Quiz id : ".$quiz_id;

			$sql="SELECT count(*) FROM questions WHERE quiz_id=".$this->db->escape($quiz_id) ;
			$sql2=$this->db->query($sql);
			$res=$sql2->result_array();
			//$no_of_questions=(int)$res[0]["count(*)"];

			return $no_of_questions;
	}


	public function compute_result($hh){

			$count=0;
			$number_of_questions=0;
		foreach ($hh as $h=>$ans) {
				$sql="SELECT count(*) FROM answer WHERE question_id="
				.$this->db->escape($h)." and correct_ans=".$this->db->escape($ans);
				$q=$this->db->query($sql);

				$res=$q->result_array();

				$number_of_questions++;
				if($res[0]["count(*)"] == "1"){
					$count++;
					//echo $count."<br>";
				}

				//echo var_dump($res[0]["count(*)"])."<br>";
				//echo $res["count(*)"];
			/*	if(isset($res)==1){
					$count++;
					echo $count."<br>";
				}*/
				/*echo '<pre>';
				print_r($res);
				echo  '</pre>';*/
		}
			$data['attampts']=$number_of_questions-1;
			$data['no_of_currect_answer']=$count;

		return $data;

	}

	public function get_quiz_info($quiz_id){


		$q3= "UPDATE `quiz` SET `is_published`=1 WHERE quiz_id=".$this->db->escape($quiz_id);
		$this->db->query($q3);




		$query="SELECT * FROM quiz WHERE quiz_id=".$this->db->escape($quiz_id);
		$res=$this->db->query($query);
		return $res->result_array();


	}

	/*public function get_options($question_id){
		foreach($question_id as $qid)
		$query="SELECT * FROM `options` WHERE question_id="
		.$this->db->escape($qid['question_id']);
		$res=$this->db->query($query);
		return $res->result_array();
	}*/

	/*public function get_options(){

		$query="SELECT * FROM `options`";
		$res=$this->db->query($query);
		return $res->result_array();
	}*/
	public function get_options(){

		$query="SELECT * FROM `options` order by rand()";
		$res=$this->db->query($query);
		return $res->result_array();
	}

	public function get_questions($quiz_id){
		$query="SELECT * FROM questions WHERE ques_text!='' and  quiz_id=".$this->db->escape($quiz_id);
		$res=$this->db->query($query);
		return $res->result_array();


	}

	public function view_quiz($class_id){
		$query="SELECT * FROM quiz WHERE class_id=".$this->db->escape($class_id);
		$res=$this->db->query($query);
		return $res->result_array();

	}

    public function set_quiz($quiz_id, $quiz_title, $marks_per_question, $time, $class_id, $quantity){


		if(isset($quiz_title)!=null){

			$q1="INSERT INTO quiz(quiz_id, title,each_ques_mark,total,duration,date,class_id)
			VALUES(".$this->db->escape($quiz_id).",".$this->db->escape($quiz_title).",".$this->db->escape($marks_per_question).",
			".$this->db->escape($quantity).",".$this->db->escape($time).","
			.$this->db->escape(date("Y-m-d H:i:s")).",".$this->db->escape($class_id).")";
			$this->db->query($q1);
			return $this->db->affected_rows();

		}
		else{
			redirect('Quiz/add_quiz/'.$class_id);
		}

    }

	public function set_questions($quiz_id, $quantity, $questions){


		if(isset($questions)!=null){

			for($i=1; $i<=$quantity; $i++){
				$question_id=$this->randomString(12);
				$add_question = "INSERT INTO questions(question_id, quiz_id, ques_text, sn) VALUES(

					".$this->db->escape($question_id).",
					".$this->db->escape($quiz_id).",
					".$this->db->escape($questions['question'.$i]).",
					".$this->db->escape($i)."

				)";
				$id_one = $this->randomString(12);
				$id_two = $this->randomString(12);
				$id_three = $this->randomString(12);
				$id_four = $this->randomString(12);
				$add_option1 = "INSERT INTO options(option_id, question_id, option_text) VALUES(

					".$this->db->escape($id_one).",
					".$this->db->escape($question_id).",
					".$this->db->escape($questions['option1'.$i])."

				)";

				$add_option2 = "INSERT INTO options(option_id, question_id, option_text) VALUES(

					".$this->db->escape($id_two).",
					".$this->db->escape($question_id).",
					".$this->db->escape($questions['option2'.$i])."

				)";

				$add_option3 = "INSERT INTO options(option_id, question_id, option_text) VALUES(

					".$this->db->escape($id_three).",
					".$this->db->escape($question_id).",
					".$this->db->escape($questions['option3'.$i])."

				)";

				$add_option4 = "INSERT INTO options(option_id, question_id, option_text) VALUES(

					".$this->db->escape($id_four).",
					".$this->db->escape($question_id).",
					".$this->db->escape($questions['option4'.$i])."

				)";
				switch($questions['ans'.$i])
				{
					case 'a':
					$ans_id=$id_one;
					break;
					case 'b':
					$ans_id=$id_two;
					break;
					case 'c':
					$ans_id=$id_three;
					break;
					case 'd':
					$ans_id=$id_four;
					break;
					default:
					$ans_id=$id_one;
				}
				$add_answer = "INSERT INTO answer(correct_ans, question_id) VALUES(

					".$this->db->escape($ans_id).",
					".$this->db->escape($question_id)."

				)";
				$this->db->query($add_question);
				$this->db->query($add_option1);
				$this->db->query($add_option2);
				$this->db->query($add_option3);
				$this->db->query($add_option4);
				$this->db->query($add_answer);

			}


			return $this->db->affected_rows();

		}
		else{
			redirect('Quiz/add_quiz/'.$class_id);
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
