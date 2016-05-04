<?php

class Model {
    
    var $data; 
    function __construct(&$data) {
        $this->data=$data; 
    }
	function get_emp($email){
		$user=$this->data->fetchRows("SELECT * FROM employee WHERE Emp_Email='$email'");
		return $user;
		}
    function printTable() {    
        $products=$this->data->fetchRows("SELECT * FROM products");
        return $products;    
    }
	function getsub(){
		$sub = $this->data->fetchRows("SELECT * FROM subscription_plan");
		return $sub;
	}
	function getdetail(){
		$detail = $this->data->fetchRows("SELECT * FROM product_details");
		return $detail;
	}
	function get_trades(){
		$historys=$this->data->fetchRows("SELECT * FROM trade");
        return $historys;  
		}
	function get_opentrades(){
		$historys=$this->data->fetchRows("SELECT * FROM trade where Trade_Status = 0");
        return $historys;  
		}
	function updateProduct(){
		$i = $_GET['id'];
		$newPDID = $_POST["PDID$i"];
		$newUnitCost = $_POST["UC$i"];
		$newTradeID = $_POST["TID$i"];
		$newProductStatus = $_POST["ProductStatus$i"];
		$sql="UPDATE products SET P_D_ID='$newPDID',Unit_Cost='$newUnitCost',Product_Status='$newProductStatus',Trade_ID='$newTradeID' where P_ID =". $_GET['id'];
     	if ($this->data->query($sql)) return true;
     	else return false;
	}
	function updateDetail(){
		$i = $_GET['id'];
		$newPT = $_POST["PT$i"];
		$newPD = $_POST["PD$i"];
		$newPP = $_POST["PP$i"];
		$newRD = $_POST["RD$i"];
		$newRT = $_POST["RT$i"];
		$newPM = $_POST["PM$i"];
		$newCD = @$_POST["CD$i"];
		if ($newCD!= "")
			$sql="UPDATE product_details SET Product_Title='$newPT',Product_Developer='$newPD',Product_Publisher='$newPP',Release_Date='$newRD',ESRB_Rating='$newRT',Cover_dir ='$newCD', Platform = '$newPM' where P_D_ID =".$_GET['id'];
		else
			$sql="UPDATE product_details SET Product_Title='$newPT',Product_Developer='$newPD',Product_Publisher='$newPP',Release_Date='$newRD',ESRB_Rating='$newRT', Platform = '$newPM' where P_D_ID =".$_GET['id'];
     	if ($this->data->query($sql)) return true;
     	else return false;
	}
	
	function add_detail(){
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		$newPDT = test_input($_POST["newPDT"]);
		$newPDD = test_input($_POST["newPDD"]);
		$newPDP = test_input($_POST["newPDP"]);
		$newRD = test_input($_POST["newRD"]);
		$newESRB = test_input($_POST["newESRB"]);
		$newPM = test_input($_POST["newPM"]);
		$newCD = test_input($_POST["newCD"]);
		$sql="INSERT INTO product_details VALUES ('','$newPDT','$newPDD','$newPDP','$newRD','$newESRB','$newCD','$newPM','')";
     	if ($this->data->query($sql)) return true;
     	else return false;
	}
	
	function addProduct() {
		$newPDID = $_POST["newPDID"];
		$newUnitCost = $_POST["newUnitCost"];
		$newTradeID = $_POST["newTradeID"];
		$newProductStatus = $_POST["newProductStatus"];
		$sql="INSERT INTO products VALUES ('','$newPDID','$newUnitCost','$newProductStatus','$newTradeID','')";
     	if ($this->data->query($sql)) return true;
     	else return false;
	}

	function deleteProduct() {   
     	$sql="DELETE FROM products WHERE P_ID =".$_GET['id'];
	 	if ($this->data->query($sql)) return true;
	 	else return false;
	}
	function updatesub(){
		$id=$_POST["fid"];
		$newdes = $_POST["fMenu"];
		$newrate = $_POST["fRate"];
		$newvb = $_POST["vb"];
		$sql= "UPDATE subscription_plan SET Description='$newdes',Rate='$newrate',Visibility='$newvb' where Subscription_ID =".$id;
		if ($this->data->query($sql)) return true;
     	else return false;
	}
	function addsub(){
		$newdes = "";
		$newrate = "";
		$newvb = "";
		$sql= "INSERT INTO subscription_plan VALUES ('','$newdes','$newrate','$newvb')";
		$this->data->query($sql);
	}
	function registemp(){
		$isError=false;
		function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		if(empty($_POST["fname"])) {
				$error['fnameErr'] = "First name is required.";
				$isError = true;
		}
		else {
			$fname = test_input($_POST["fname"]);
			// check if name only contains letters and whitespace
			if(!preg_match("/^[a-zA-Z ]*$/",$fname)) {
				$error['fnameErr'] = "Only letters and white space allowed.";
				$isError = true;
			}
			if(strlen($fname)>50) {
				$error['fnameErr'] = "Your name must be less than 50 characters.";
				$isError = true;
			}
		}
			
		if(empty($_POST["lname"])) {
			$error['lnameErr'] = "Last name is required.";
			$isError = true;
		}
		else {
			$lname = test_input($_POST["lname"]);
			// check if name only contains letters and whitespace
			if(!preg_match("/^[a-zA-Z ]*$/",$lname)) {
				$error['lnameErr'] = "Only letters and white space allowed.";
				$isError = true;
			}
			if(strlen($lname)>50) {
				$error['lnameErr'] = "Your name must be less than 50 characters.";
				$isError = true;
			}
		}
			
		if(empty($_POST["email"])) {
			$error['emailErr'] = "Email is required.";
			$isError = true;
		}
		else {
			$email = test_input($_POST["email"]);
			// check if e-mail address syntax is valid
			if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
				$error['emailErr'] = "Invalid email format";
				$isError = true;
			}
			if(strlen($email)>255) {
				$error['emailErr'] = "Your email must be less than 255 characters.";
				$isError = true;
			}
		}
		
		if(empty($_POST["pwd"])) {
			$error['pwdErr'] = "Password is required.";
			$isError = true;
		}
		else {
			$pwd = test_input($_POST["pwd"]);
		}
			
		if(empty($_POST["pwd1"])) {
			$error['pwd1Err'] = "Please Re-Enter Your Password.";
			$isError = true;
		}
		else {
			$pwd1 = test_input($_POST["pwd1"]);
			if($pwd != $pwd1) {
				$error['pwdErr'] = $error['pwd1Err'] = "Passwords do not match.";
				$isError = true;
			}
		}
		if(empty($_POST["street"])) {
			$street = "";
		}
		else {
			$street = test_input($_POST["street"]);
		}
		
		if(empty($_POST["street"])) {
			$street = "";
		}
		else {
			$street = test_input($_POST["street"]);
		}
		if(empty($_POST["city"])) {
			$city = "";
		}
		else {
			$city = test_input($_POST["city"]);
		}
		if(empty($_POST["state"])) {
			$state = "";
		}
		else {
			$state = test_input($_POST["state"]);
		}
		if(empty($_POST["zip"])) {
			$zip = "";
		}
		else {
			$zip = test_input($_POST["zip"]);
		}
		if(empty($_POST["status"])) {
			$status = "";
		}
		else {
			$status = test_input($_POST["status"]);
		}
		if(empty($_POST["hiredate"])) {
			$hiredate = "";
		}
		else {
			$hiredate = test_input($_POST["hiredate"]);
		}
		if(empty($_POST["leavedate"])) {
			$leavedate = "";
		}
		else {
			$leavedate = test_input($_POST["leavedate"]);
		}
		if(empty($_POST["payrate"])) {
			$payrate = "";
		}
		else {
			$payrate = test_input($_POST["payrate"]);
		}
		if(!$isError) {
			$enc_pwd = hash("sha512", $pwd);
			$sql= "SELECT * FROM employee WHERE Emp_Email='$email'";
			if($this->data->fetchRows($sql)){
				$error['HeadErr']="This email address is already registered!";
				return $error;
			}
			else{
				$sql="INSERT INTO employee VALUES ('','$fname','$lname','$street','$city','$state','$zip','$email','$enc_pwd','$status','$hiredate','$leavedate','$payrate')";
     			if ($this->data->query($sql)){
					$error="";
					$_SESSION["Email"]=$email;
					$_SESSION['is_employee'] = 1;
					return $error;	
				}
			}
		}
		else{
				return $error;
			}
	}
	function update_trades(){
		$is_err = false;
		$id = $_GET['id'];
		$TP= $_POST['TP'];
		$eid=$_SESSION['EID'];
		$sql= "UPDATE trade SET Trade_Price ='$TP',Employee_ID ='$eid',Trade_Status= 1 where Trade_ID =".$id;
		if($this->data->query($sql)){
			$pdid = $_POST['PDID'];
			$sql= "INSERT INTO products VALUES ('','$pdid','$TP','0','$id','')";
			if($this->data->query($sql))
				return true;
		}
		else
			return false;
	}
	function deny_trades(){
		$id = $_GET['id'];
		$eid=$_SESSION['EID'];
		$sql= "UPDATE trade SET Employee_ID ='$eid',Trade_Status= 2 where Trade_ID =".$id;
		if($this->data->query($sql))
			return true;
		else
			return false;
	}
}
?>