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

class table1Controller extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$details=$this->model->getdetail();
		$this->view= & new Table1View($details);
	}
}
class table2Controller extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->view= & new Table2View();
	}
}
class printController extends Controller{   
	function __construct (& $data) {
     	parent::__construct($data);
		$details=$this->model->getdetail();
      	$products=$this->model->printTable();
   	  	$this->view=& new printView($products,$details);
	}
}
class printdetailController extends Controller{   
	function __construct (& $data) {
     	parent::__construct($data);
		$details=$this->model->getdetail();
   	  	$this->view=& new printdetailView($details);
	}
}

class updateController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if ($this->model->updateProduct()) $success=1;
		else $success=0;
		$this->view=& new updateView($success);
	}
}
class updatedetailController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if ($this->model->updateDetail()) $success=1;
		else $success=0;
		$this->view=& new updateDetailView($success);
	}
}


class addController extends Controller{
	function __construct (& $data) {
      	parent::__construct($data);
   		if ($this->model->addProduct()) $success=1;
  		else $success=0;
   		$this->view=& new addView($success);
	}
}

class add_detailController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if ($this->model->add_detail()) $success=1;
		else $success=0;
		$this->view=& new add_detailView($success);
	}
}

class deleteController extends Controller{
	function __construct (& $data) {
      	parent::__construct($data);
     	if ($this->model->deleteProduct()) $success=1;
  		else $success=0;
   		$this->view=& new deleteView($success);
	}
}
class submanagementController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$sub = $this->model->getsub();
		$this->view=& new submanagementView($sub);
	}
}
class updatesubController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if ($this->model->updatesub()) $success=1;
  		else $success=0;
   		$this->view=& new updatesubView($success);
	}
}
class addsubController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->model->addsub();
		$sub = $this->model->getsub();
		$this->view=& new submanagementView($sub);
	}
}
class addempController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$error="";
		$this->view = & new addempView($error);
	}
}
class registempController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$error=$this->model->registemp();
		if ($error == "")
		$this->view=& new registedempView();
		else{
			$this->view= & new addempView($error);
		}
	}
}
class modifyacctController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$error="";
		$this->view = & new searchacctView($error);
	}
}
class rentalcontrolController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$error="";
		$this->view = & new searchrentView($error);
	}
}
class empinfoController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$email=$_SESSION['Email'];
		$user = $this->model->get_emp($email);
		$this->view = & new EMPView($user);
	}
}
class tradeinmanagementController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$trades = $this->model->get_opentrades();
		$this->view = & new tradelistView($trades);
	}
}
class updatetradeController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$success= $this->model->update_trades();
		$this->view = & new updatetradeView($success);
	}
}
class denytradeController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$success=$this->model->deny_trades();
		$this->view = & new denytradeView($success);
	}
}
class tradelistController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$trades=$this->model->get_trades();
		$this->view = & new tradeView($trades);
	}
}
class panelController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->view = & new panelView();
	}
}
?>
