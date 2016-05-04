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
class signinController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if($this->model->login()){
			header("Location:?action=account_detail");
		}
		else{
			$error['HeadErr'] = "Invalid Email/Password. Please try again.";
			$this->view=& new indexView($error);
		}
	}
}
class logoutController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$this->model->logout();
		$this->view=& new logoutView();
	}
}
class accountController extends Controller{
	function __construct (& $data){
		parent:: __construct($data);
		$user = $this->model->print_detail();
		if($_SESSION['is_employee']==1){
			header("Location:EMP\?action=");
		}
		else{
			$subscription = $this->model->get_sub();
			$this->view= & new accountView($user,$subscription);
		}
	}
}
class accmanagementController extends Controller{
	function __construct (& $data){
		parent:: __construct($data);
		$user = $this->model->print_detail();
		if($_SESSION['is_employee']==1){
			$error="";
			$this->view= & new EMPaccmanagementView($user,$error);
		}
		else{
			$subscription = $this->model->get_sub();
			$error="";
			$this->view= & new accmanagementView($user,$subscription,$error);
		}
	}
}
class updateacctController extends Controller{
	function __construct (& $data){
		parent:: __construct($data);
		$isEmp=@$_GET['isEmp'];
		$error=$this->model->updateacct($isEmp);
		if ($error == "")
		$this->view=& new updateView();
		else
		$this->view= & new accmanagementView($user,$subscription,$error);
		}
	}
class passwordController extends Controller{
	function __construct (& $data){
		parent:: __construct($data);
		$error="";
		$this->view= & new passwordView($error);
		}
	}
class updatepassController extends Controller{
	function __construct (&$data){
		parent:: __construct($data);
		$error=$this->model->updatepass();
		if ($error == "")
		$this->view=& new updatepassView();
		else
		$this->view= & new passwordView($error);
		}
}
class registerController extends Controller{
	function __construct (& $data) {
      	parent::__construct($data);
		$subscription = $this->model->get_sub();
		$error="";
   		$this->view= & new registerView($error,$subscription);
	}
}
class registController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$error=$this->model->regist();
		if ($error == "")
		$this->view=& new registedView();
		else{
			$subscription = $this->model->get_sub();
			$this->view= & new registerView($error,$subscription);
		}
		}
	}
class listController extends Controller{
	function __construct (& $data) {
      	parent::__construct($data);
		$details1=$this->model->getdetail_by_date();
		$details2=$this->model->getdetail_by_rent();
   	  	$this->view=& new listView($details1,$details2);
	}
}
class poolController extends Controller{
	function __construct (& $data) {
      	parent::__construct($data);
		$details=$this->model->getdetail();
   	  	$this->view=& new poolView($details);
	}
}
class searchrentController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$email=$_POST['uEmail'];
		$id=$this->model->get_user_id($email);
		if (!empty($id)){
			$history = $this->model->get_history($id);
			$productT=$this->model->get_history_product($history);
			$detailT= $this->model->get_history_detail($productT);
			$queue = $this->model->get_queue($id);
			$details= $this->model->get_queue_detail($queue);
			$this->view= & new rentalqueueView($productT,$detailT,$history,$details,$queue);
		}
		else
			$this->view= & new rentalqueueView("","","","","");
	}
}
class searchuserController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$email=$_POST['uEmail'];
		$user=$this->model->get_user($email);
		$subscription = $this->model->get_sub();
		$error="";
		if (!empty($user))
			$this->view=& new accmanagementView($user,$subscription,$error);
		else
			$this->view=& new accmanagementView("","","");
	}
}
class searchempController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$email=$_POST['eEmail'];
		$user=$this->model->get_emp($email);
		$error="";
		if (!empty($user))
			$this->view= & new EMPaccmanagementView($user,$error);
		else
			$this->view=& new accmanagementView("","","");
	}
}
class showdetailController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id=$_GET['id'];
		$product=$this->model->get_products_by_detail($id);
		$detail=$this->model->get_detail_by_id($id);
		$this->view= & new showdetailView($product,$detail);
	}
}
class rentController extends Controller {
	function __construct (& $data){
		parent::__construct($data);
			$this->model->putinqueue();
			$this->view=& new emptyView();
			header("Location:?action=rentalqueue");
	}
}
class confirmrentController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		if ($this->model->check_emp()){
			$error['HeadErr']="Please Login to Rent games";
			$this->view=& new indexView($error);
		}
		$id=$_GET['id'];
		$pdid = $this->model->get_pdid_by_queue($id);
		$cid = $this->model->get_cid_by_queue($id);
		$pid = $this->model->get_first_avaliable_item($pdid);
		if($pid != ""){
			if ($this->model->check_status($pid)){
				$this->model->dropitem($id);
				$success = $this->model->confirmrent($pid,$cid);
					if($success){
						$this->model->set_rented($pid);
						$this->view=& new confirmrentView($success);
					}
			}
			else {
				$success = false;
				$this->view=& new confirmrentView($success);
			}
		}
		else
			$this->view=& new noitemView();

	}
}

class rentalqueueController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id = $_SESSION['CID'];
		$history = $this->model->get_history($id);
		$productT=$this->model->get_history_product($history);
		$detailT= $this->model->get_history_detail($productT);
		$queue = $this->model->get_queue($id);
		$details= $this->model->get_queue_detail($queue);
		$this->view= & new rentalqueueView($productT,$detailT,$history,$details,$queue);
	}
}

class basketController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id = "";
		if (@$_SESSION['CID'])
			$id = $_SESSION['CID'];
		if ($id!=""){
			$queue = $this->model->get_queue($id);
			$detailT= $this->model->get_queue_detail($queue);
			$this->view= & new basketView($detailT,$detailT);
		}
		else {
			$this->view= & new emptyView();
		}
	}
}
class returnController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$success=$this->model->returnitem();
		$this->view=& new returnitemView($success);
	}
}
class tradeinController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$success=$this->model->place_tradein();
		$this->view=& new placetradeinView($success);
	}
}
class tradeinstatusController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$trade=$this->model->get_trade();
		$details=$this->model->getdetail();
		$this->view=& new tradeinstatusView($trade,$details);
	}
}
class searchproductController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$product=$this->model->searchproduct();
		$this->view=& new searchplistView($product);
	}
}
class dropitemController extends Controller{
	function __construct (& $data){
		parent::__construct($data);
		$id=$_GET['id'];
		$this->model->dropitem($id);
		$this->view=& new emptyView($product);
		header("Location:?action=rentalqueue");
	}
}

?>
