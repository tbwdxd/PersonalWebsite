<!---this page is a one-time function to create the first system admin.-->
<?php
require_once('lib/DataAccess.php');
$data=DataAccess::getInstance('localhost','root','password','titainium');
class admin{
	var $data; 
    function __construct(&$data) {
        $this->data=$data; 
    }
	function regist(){
		$isError = false;
		if(!$isError) {
			$pwd = "password";
			$enc_pwd = hash("sha512", $pwd);
			$sql="INSERT INTO account VALUES ('','$enc_pwd','admin','admin','admin','1','3','AAA')";
     		if($this->data->query($sql))
     			echo "successful.";
            else
                echo "Error:Creation Aborted.";
		}
	}
}
class Controller {
    var $model;  
    var $view;   
    function __construct (& $data) {
        $this->model=& new admin($data);
        $this->model->regist();
    }
}

$controller=& new Controller($data); 
?>