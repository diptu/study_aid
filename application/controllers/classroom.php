<?php
defined('BASEPATH') OR exit ('No dirrect access allowed');


  class Classroom extends CI_Controller{

    public function __construct(){
      parent:: __construct();
      $this->load->model('Classroom_model');
    }
	
	public function all_students($cid){
		$res = $this->Classroom_model->get_all_students($cid);
		$data['all_students'] = $res;
		$this->load->view('all_students',$data);
		//print_r($res);
		
	}
    public function student_course_view(){

      //$this->session->set_userdata(arr"username","type");
      $user_name=$this->session->userdata("username");
      $res=$this->Classroom_model->view_classes($user_name);
      $data['res'] = $res;
      $this->load->view("classroom_student_view",$data);
    //  $class_info=$this->Classroom_model->view_classes("username","type");
    //  $this->load->view("classroom_student_view");


    }

    public function faculty_course_view(){

      //$this->session->set_userdata(arr"username","type");
      $user_name=$this->session->userdata("username");
      $res=$this->Classroom_model->view_faculty_classes($user_name);
      $data['res'] = $res;
      $this->load->view("faculty",$data);
    //  $class_info=$this->Classroom_model->view_classes("username","type");
    //  $this->load->view("classroom_student_view");


    }

	public function new_classroom(){
		$this->load->view("classroom_view");
		$className=$this->input->post("className");

		$about=$this->input->post("about");
		//echo $classKey."<br>";
		if(isset($className)){
			$classroom=$this->Classroom_model->updateClassroom($className, $about, $this->session->userdata("username"));
			//echo $classroom."<br>";
      ?>
      <div role="alert"  class="alert alert-success">
        <button data-dismiss="alert" class="close"  name="cls" type="button"><span aria-hidden="true">x</span><span class="sr-only">Close</span></button>

          <?=$classroom ;?>

      </div>


      <?php

		}

	}

	public function enroll_student(){
		$access_key=$this->input->post("access_key");
    //echo $access_key;
		$s=$this->Classroom_model->add_student($access_key, $this->session->userdata("username"));

		$this->load->view("student",$this->session->userdata("username"),$this->session->userdata("type"));

	}

	public function classroom($cid){


      if($this->session->userdata("type")=="student"){

      $enrolled_class_id = $this->Classroom_model->fetch_enrolled_student_by_class_user($this->session->userdata("username"),$cid);
      if(isset($enrolled_class_id[0]['cid'])){




        		$res = $this->Classroom_model->fetch_class_by_id($cid);

        		$posts = $this->Classroom_model->fetch_post_by_cid($cid);

        		 /*print_r("<pre>");
        		 print_r($enrolled_class_id);
        		 print_r("</pre>");*/
        		// echo $res->cname;
        		if(!empty($posts))
        		$res->posts = $posts;
        		$res->get_comment = function($pid){
        		  return $this->Classroom_model->fetch_comment_by_pid($pid);
        		};

        		$this->load->view("classroom",$res);
      }
      else{

        $this->session->set_flashdata(array("err"=>"Don't be too smart! you are not enrolled  in this coures ".$cid));
        redirect('Classroom/student_course_view');
        //echo "Don't be too smart! you are not enrolled  in this coures ";

      }

    }else{


              $faculty_classroom=$this->Classroom_model->check_faculty_classroom($this->session->userdata("username"),$cid);

              if(isset($faculty_classroom[0]['cid'])){
             $res = $this->Classroom_model->fetch_class_by_id($cid);

              $posts = $this->Classroom_model->fetch_post_by_cid($cid);

              /* print_r("<pre>");
               print_r($faculty_classroom);
               print_r("</pre>");*/
              // echo $res->cname;
             if(!empty($posts))
              $res->posts = $posts;
              $res->get_comment = function($pid){
                return $this->Classroom_model->fetch_comment_by_pid($pid);
              };

              $this->load->view("classroom",$res);
            }

      else{
        $this->session->set_flashdata(array("faculty_err"=>"Sorry,you are not permitted to access this class ".$cid));
        redirect('Classroom/faculty_course_view');
      }
      }
    }


	public function add_status($cid){

		$text = $this->input->post("announcement");
		$created_date = date("Y-m-d");
		$attachment = $_FILES['attachment']['name'];
		$res = $this->Classroom_model->add_status($cid, $text, $created_date, $attachment, $this->session->userdata("username"));
		if(is_numeric($res)){
			if($attachment!=''){

				@mkdir('./attachments/post/'.$res);
				$config['upload_path'] = './attachments/post/'.$res.'/';
				$config['allowed_types'] = '*';
				$this->load->library('upload', $config);
				$config['file_name'] = $_FILES['attachment']['name'];
				$this->upload->initialize($config);
				$this->upload->do_upload('attachment');
				$upload_data = $this->upload->data();
			}
			$msg = 'Status updated!';
		}
		else{
			$msg = 'Failed!';
		}

		$this->session->set_flashdata('msg',$msg);
		redirect('Classroom/classroom/'.$cid);

	}
  public function add_comment($pid){

		$text = $this->input->post("cmnt_".$pid);
    $cid= $this->input->post("cid");
		$created_date = date("Y-m-d");

		$res = $this->Classroom_model->add_comment($pid, $text, $created_date, $this->session->userdata("username"));
    //$data['msg']=$res;
    $this->session->set_flashdata(array("comment_response"=>$res));
    redirect("Classroom/classroom/".$cid);
		//echo $res;
    //$this->load->view("classroom",$data);

	}


	public function test(){

		if(isset($_POST['post'])){
	echo "if";
	$target_dir = "http://localhost/study_aid/uploads/";
	$target_file = $target_dir . $_POST['attachment'];
	$uploadOk = 1;
	//$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image

	// Check if file already exists
	if (file_exists($target_file)) {
	    echo "Sorry, file already exists.";
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["attachment"]["size"] > 500000) {
	    echo "Sorry, your file is too large.";
	   	$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
	    echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
	        echo "The file ". basename( $_FILES["attachment"]["name"]). " has been uploaded.";
	    } else {
	        echo "Sorry, there was an error uploading your file.";
	    }
	}

	}
else{
	echo "else";
}
	}



  }




?>
