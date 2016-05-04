<?php


class Controller {
    var $model;  
    var $view;   
    function __construct (& $data) {
        $this->model=& new Model($data);
    }
  	function getView() {   
    	return $this->view;
  	}
}
class indexController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->view= & new indexView("");
	}
}
class loginController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->view= & new loginView("");
	}
}
class signinController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if($this->model->login()){
			header("Location:index.php");
			exit();
		}
		else{
			$error['HeadErr'] = "Invalid CWID/Password. Please try again.";
			$this->view=& new loginView($error);
		}
	}
}

class logoutController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->model->logout();
		$error['HeadNot'] = "Logout Sucessfully.";
		$this->view=& new loginView($error);
	}
}
class profileController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$department=$this->model->get_dep();
		$user=$this->model->getuserbysession();
		$this->view= & new ProfileView($user,$department);
	}
}
class enrollcourseController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$user=$this->model->getuserbysession();
		$course=$this->model->get_coursebysession();
    	$detail=$this->model->get_detail();
    	$department = $this->model->get_dep();
    	$faculty=$this->model->get_faculty();
    	$exception=$this->model->get_exception();
    	$this->view= & new enrollcourseView($course,$detail,$faculty,$department,$exception,3,"");
		}
}
class enrollController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$error=$this->model->enroll();
		$user=$this->model->getuserbysession();
		$course=$this->model->get_coursebysession();
    	$detail=$this->model->get_detail();
    	$department = $this->model->get_dep();
    	$faculty=$this->model->get_faculty();
    	$exception=$this->model->get_exception();
		if ($error == ""){
       		$success=1;
       		$this->view=& new enrollcourseView($course,$detail,$faculty,$department,$exception,$success,"");
     	}
     	else{
       		$success=0;
       		$this->view= & new enrollcourseView($course,$detail,$faculty,$department,$exception,$success,$error);
     	} 
	}
}
class viewcourseController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$user=$this->model->getuserbysession();
		$course=$this->model->get_coursebypick();
    	$detail=$this->model->get_detail();
    	$department = $this->model->get_dep();
    	$faculty=$this->model->get_faculty();
    	$exception=$this->model->get_exception();
    	$this->view= & new managetableView($course,$detail,$faculty,$department,$exception,3,"",0);
		}
}
class viewcoursefacController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$user=$this->model->getuserbysession();
		$course=$this->model->get_coursebyins();
    	$detail=$this->model->get_detail();
    	$department = $this->model->get_dep();
    	$faculty=$this->model->get_faculty();
    	$exception=$this->model->get_exception();
    	$this->view= & new managetableView($course,$detail,$faculty,$department,$exception,3,"",1);
		}
}
class managestuController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$cid=$_GET["id"];
		$CWID=$_SESSION['CWID'];
		$course=$this->model->get_coursebyid($cid);
		$csdt=$this->model->get_detailbyid($cid);
		$grade=$this->model->get_gradebycourse($CWID,$cid);
		$file=$this->model->get_matbycourse($cid);
		$hwmat=$this->model->get_hwmatbycourse($cid);
    	$this->view= & new stumanageView($course,$csdt,$grade,$file,$hwmat,3,"");
		}
}
class managefacController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id=$_GET["id"];
		$course=$this->model->get_coursebyid($id);
		$csdt=$this->model->get_detailbyid($id);
		$student=$this->model->get_studentbycourse($id);
		$file=$this->model->get_matbycourse($id);
		$hwmat=$this->model->get_hwmatbycourse($id);
    	$this->view= & new manageView($course,$csdt,$student,$file,$hwmat,3,"");
		}
}
class uploadmatController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $id=$_GET["id"];
    if ($this->model->uploadfile()) $success=1;
    else $success=0;
	$course=$this->model->get_coursebyid($id);
	$csdt=$this->model->get_detailbyid($id);
	$student=$this->model->get_studentbycourse($id);
	$file=$this->model->get_matbycourse($id);
	$hwmat=$this->model->get_hwmatbycourse($id);
    $this->view= & new manageView($course,$csdt,$student,$file,$hwmat,$success,"");
  }
}
class addgradesecController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $id=$_GET["id"];
    if ($this->model->addgradesec()) $success=1;
    else $success=0;
	$course=$this->model->get_coursebyid($id);
	$csdt=$this->model->get_detailbyid($id);
	$student=$this->model->get_studentbycourse($id);
	$file=$this->model->get_matbycourse($id);
	$hwmat=$this->model->get_hwmatbycourse($id);
    $this->view= & new manageView($course,$csdt,$student,$file,$hwmat,$success,"");
  }
}
class uploadhwController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $id=$_GET["id"];
    if ($this->model->uploadhw()) $success=1;
    else $success=0;
	$course=$this->model->get_coursebyid($id);
	$csdt=$this->model->get_detailbyid($id);
	$student=$this->model->get_studentbycourse($id);
	$file=$this->model->get_matbycourse($id);
    $this->view= & new manageView($course,$csdt,$student,$file,$success,"");
  }
}
class lookstudentController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id=$_GET['id'];
		$cid=$_GET['cid'];
		$student=$this->model->getuserbyid($id);
		$this->view= & new GradeView($student,$id,$cid,3);
	}
}
class gradeController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id=$_GET['id'];
		$cid=$_GET['cid'];
	    $error=$this->model->update_grade($id,$cid);
	    $student=$this->model->getuserbyid($id);
	    if ($error == ""){
	      $success = 1;
	      $this->view= & new GradeView($student,$id,$cid,$success);
	    }
	    else{
	      $success = 0;
	      $this->view= & new GradeView($student,$id,$cid,$success);
		}
	}
}
?>
