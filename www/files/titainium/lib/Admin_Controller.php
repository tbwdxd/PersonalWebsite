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
class addstudentController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
    $department = $this->model->get_dep();
    $this->view= & new addstudentView($success,"",$department);
  }
}
class addstuController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $error=$this->model->add_stu();
    $department = $this->model->get_dep();
    if ($error == ""){
      $success=1;
      $this->view=& new addstudentView($success,"",$department);
    }
    else{
      $success=0;
      $this->view= & new addstudentView($success,$error,$department);
    }
  }
}
class modifystudentController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
    $this->view= & new searchstuView($success);
  }
}
class searchstuController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $student =  $this->model->search_stu();
    $department = $this->model->get_dep();
    if (!empty($student)){
      $success = 3;
      $this->view= & new modifystuView($success,"",$department,$student);
    }
    else{
      $success = 0;
      $this->view= & new searchstuView($success);
    }
  }
}
class updatestuController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $error=$this->model->update_stu();
    if ($error == ""){
      $success = 1;
      $this->view= & new searchstuView($success);
    }
    else{
      $success = 0;
      $student =  $this->model->search_stu();
      $department = $this->model->get_dep();
      $this->view= & new modifystuView($success,$error,$department,$student);
    }
  }
}
class addfacultyController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
    $department = $this->model->get_dep();
    $this->view= & new addfacultyView($success,"",$department);
  }
}
class addfacController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $error=$this->model->add_fac();
    $department = $this->model->get_dep();
    if ($error == ""){
      $success=1;
      $this->view=& new addfacultyView($success,"",$department);
    }
    else{
      $success=0;
      $this->view= & new addfacultyView($success,$error,$department);
    }
  }
}
class modifyfacultyController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
    $this->view= & new searchfacView($success);
  }
}
class searchfacController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $faculty =  $this->model->search_fac();
    $department = $this->model->get_dep();
    if (!empty($faculty)){
      $success = 3;
      $this->view= & new modifyfacView($success,"",$department,$faculty);
    }
    else{
      $success = 0;
      $this->view= & new searchfacView($success);
    }
  }
}
class updatefacController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $error=$this->model->update_stu();
    if ($error == ""){
      $success = 1;
      $this->view= & new searchfacView($success);
    }
    else{
      $success = 0;
      $faculty =  $this->model->search_fac();
      $department = $this->model->get_dep();
      $this->view= & new modifystuView($success,$error,$department,$faculty);
    }
  }
}
class adddepartmentController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
    $this->view= & new adddepartmentView($success);
  }
}
class adddepController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    if ($this->model->add_dep()) $success=1;
    else $success=0;
    $this->view= & new adddepartmentView($success);
  }
}
class addcoursedetailController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
     $department = $this->model->get_dep();
    $this->view= & new addcoursedetailView($success,$department);
  }
}
class addcdetController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $department = $this->model->get_dep();
    if ($this->model->add_cdet()) $success=1;
    else $success=0;
    $this->view= & new addcoursedetailView($success,$department);
  }
}
class addcourseController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $success = 3;
    $detail=$this->model->get_detail();
    $faculty=$this->model->get_faculty();
    $this->view= & new addcourseView($success,$detail,$faculty,"");
  }
}
class addcsController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $error=$this->model->add_cs();
    $detail=$this->model->get_detail();
    $faculty=$this->model->get_faculty();
    if ($error == ""){
      $success=1;
      $this->view=& new addcourseView($success,$detail,$faculty,"");
    }
    else{
      $success=0;
      $this->view= & new addcourseView($success,$detail,$faculty,$error);
    }
  }
}
class viewcourseController extends Controller{
  function __construct (& $data){
    parent::__construct($data);
    $course=$this->model->get_course();
    $detail=$this->model->get_detail();
    $department = $this->model->get_dep();
    $faculty=$this->model->get_faculty();
    $this->view= & new viewcourseView($course,$detail,$faculty,$department);
  }
}
?>