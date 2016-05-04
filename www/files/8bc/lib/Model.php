<?php

class Model {
    
    var $data; 
    function __construct(&$data) {
        $this->data=$data; 
    }
	function login(){
		function test_input($data)
		{
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		// define variables and set to empty values
		$email = $pwd = "";
		$isError = false;	
		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			if (empty($_POST["Email"])) {
				$isError = true;
			}
			else {
				$email = test_input($_POST["Email"]);
				// check if e-mail address syntax is valid
				if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
					$isError = true;
				}
			}
			if (empty($_POST["Password"])) {
				$isError = true;
			}
			else {
				$pwd = hash("sha512", test_input($_POST["Password"]));
			}
		}
		if(!$isError) {
			$row=$this->data->fetchRows("SELECT * FROM customer_account WHERE Email='$email'");
			foreach($row as $value){
				if(count($value)!=0){
					$dbemail = $value['Email'];
					$dbpwd = $value['Password'];
					$CID = $value ['Customer_ID'];
					$name = $value['First_Name']." ".$value['Last_Name'];
					if(($email == $dbemail) && ($pwd == $dbpwd)) {
						$_SESSION['Email']=$dbemail;
						$_SESSION['Name']=$name;
						$_SESSION['CID']=$CID;
						$_SESSION['is_employee']=0;
						return true;
						die();
					}
				}
			}
			
			$row=$this->data->fetchRows("SELECT * FROM employee WHERE EMP_Email='$email'");
			foreach($row as $value){
				if(count($row)!=0){
					$dbemail =$value['Emp_Email'];
					$dbpwd = $value['Emp_Password'];
					$EID = $value['Employee_ID'];
					$name = $value['Employee_Fname']." ".$value['Employee_Lname'];
					if(($email == $dbemail) && ($pwd == $dbpwd)) {
						$_SESSION['Email']=$dbemail;
						$_SESSION['Name']=$name;
						$_SESSION['EID']=$EID;
						$_SESSION['is_employee']=1;
						return true;
						die();
					}
				}
			}
			return false;
		}
		return false;
	}
	function logout(){
		session_destroy();
		}
	function print_detail(){
		$email = $_SESSION['Email'];
		if($_SESSION['is_employee']!= 1)
			$user=$this->data->fetchRows("SELECT * FROM customer_account WHERE Email='$email'");
		else
			$user=$this->data->fetchRows("SELECT * FROM employee WHERE Emp_Email='$email'");
        return $user;
		}
	function get_user($email){
		$user=$this->data->fetchRows("SELECT * FROM customer_account WHERE Email like '%$email%'");
		return $user;
		}
	function get_user_id($email){
		$id= "";
		$user=$this->data->fetchRows("SELECT * FROM customer_account WHERE Email like '%$email%'");
		foreach ($user as $value){
			$id = $value['Customer_ID'];
			}
		return $id;
		}
	function get_emp($email){
		$user=$this->data->fetchRows("SELECT * FROM employee WHERE Emp_Email='$email'");
		return $user;
		}
	function get_sub(){
		$sub = $this->data->fetchRows("SELECT * FROM subscription_plan");
		return $sub;
		}
	function update($row,$input,$isEmp){
		if(@$_POST["cID"])
			$cID = $_POST["cID"];
		if ($isEmp == 1)
			$sql="UPDATE employee SET $row='$input' WHERE Employee_ID='$cID'";
		else
			$sql="UPDATE customer_account SET $row='$input' WHERE Customer_ID='$cID'";
		if ($this->data->query($sql)) return true;
     	else return false;
		}
	function updateacct($isEmp){
		function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
		}
		$is_Error = false;
		if(isset($_POST['submit'])) {
			if(empty($_POST["cFname"])) {
				$error['fnameErr'] = "First name is required.";
				$is_Error = true;
			}
			else {
				$cFName = test_input($_POST["cFname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$cFName)) {
					$error['fnameErr'] = "Only letters and white space allowed.";
					$is_Error = true;
				}
				if(strlen($cFName)>50) {
					$error['fnameErr'] = "Your name must be less than 50 characters.";
					$is_Error = true;
				}
			}
			if(empty($_POST["cLname"])) {
				$error['lnameErr'] = "First name is required.";
				$is_Error = true;
			}
			else {
				$cLName = test_input($_POST["cLname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$cLName)) {
					$error['lnameErr'] = "Only letters and white space allowed.";
					$is_Error = true;
				}
				if(strlen($cLName)>50) {
					$error['lnameErr'] = "Your name must be less than 50 characters.";
					$is_Error = true;
				}
			}
						
			if(!$is_Error) {
				if ($isEmp == 1){
					$this->update('Employee_Fname',$cFName,$isEmp);
					$this->update('Employee_Lname',$cLName,$isEmp);
					$cStreet = $_POST["cStreet"];
					$this->update('Emp_Street',$cStreet,$isEmp);
					$cCity = $_POST["cCity"];
					$this->update('Emp_City',$cCity,$isEmp);
					$cState = $_POST["cState"];
					$this->update('Emp_State',$cState,$isEmp);
					$cZip = $_POST["cZip"];
					$this->update('Emp_Zip',$cZip,$isEmp);
					$cEM = $_POST["cEM"];
					$this->update('Emp_Email',$cEM,$isEmp);
					$cStatus = $_POST["cStatus"];
					$this->update('Emp_Status',$cStatus,$isEmp);
					$Hdate = $_POST["cHdate"];
					$this->update('Hire_Date',$Hdate,$isEmp);
					$Ldate = $_POST["cLdate"];
					$this->update('Leave_Date',$Ldate,$isEmp);
					$cRT = $_POST["cRT"];
					$this->update('Pay_Rate',$cRT,$isEmp);
				}
				else{
					$cEM = $_POST["cEM"];
					$this->update('Email',$cEM,$isEmp);
					$this->update('First_Name',$cFName,$isEmp);
					$this->update('Last_Name',$cLName,$isEmp);
					$cStreet = $_POST["cStreet"];
					$this->update('Street',$cStreet,$isEmp);
					$cCity = $_POST["cCity"];
					$this->update('City',$cCity,$isEmp);
					$cState = $_POST["cState"];
					$this->update('State',$cState,$isEmp);
					$cZip = $_POST["cZip"];
					$this->update('Zip',$cZip,$isEmp);
					$sID = $_POST["subscID"];
					$this->update('Subscription_ID',$sID,$isEmp);
					$cBalance = $_POST["cBL"];
					$this->update('Total_Balance',$cBalance,$isEmp);
				}
				$error="";
				return $error;
			}
			else{
				return $error;
				}			
		}	
	}
	function updatepass(){
		function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		$is_Error = false;
		$pwd = hash("sha512", test_input($_POST["pwd"]));
		$email = $_SESSION['Email'];
		if ($_SESSION['is_employee'] == 1){
			$row=$this->data->fetchRows("SELECT * FROM employee WHERE Emp_Email='$email'");
		}
		else
			$row=$this->data->fetchRows("SELECT * FROM customer_account WHERE Email='$email'");
			foreach($row as $value){
				if(count($value)!=0){
					if ($_SESSION['is_employee'] == 1)
						$cPwd = $value['Emp_Password'];
					else
						$cPwd = $value['Password'];
				}
			}
				if($pwd == $cPwd){
					if(!(empty ($_POST["pwd1"]))){
						if(!(empty ($_POST["pwd2"]))){
							$pwd1 = test_input($_POST["pwd1"]);
							$pwd2 = test_input($_POST["pwd2"]);
							if($pwd1 == $pwd2){
								$pwdec =  hash("sha512", $pwd1);
								if ($_SESSION['is_employee'] == 1)
									$this->update("Emp_Password",$pwdec,1);
								else
									$this->update("password",$pwdec,0);
								$error="";
								return $error;
								}
							else
								$error['pwd1Err'] = $error['pwd2Err'] = "Passwords do not match.";
								return $error;
							}
						else
							$error['pwd2Err'] = "Confirm new password is required.";
							return $error;
						}
					else 
						$error['pwd1Err'] = "New password is required.";
						return $error;
					}
				else{
					$error['pwdErr'] = "Please type in correct current password";
					return $error;
					}
	}
	function regist(){
		$isError = false;
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
				if(strlen($lname)>255) {
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
				$pwd1= test_input($_POST["pwd1"]);
				if($pwd != $pwd1) {
					$error['pwd1Err'] = $error['pwdErr'] = "Passwords do not match.";
					$isError = true;
				}
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
			if(!$isError) {
				$subscID = $_POST["subscID"];
				$enc_pwd = hash("sha512", $pwd);
				$sql= "SELECT * FROM customer_account WHERE Email='$email'";
				if($this->data->fetchRows($sql)){
					$error['HeadErr']="This email address is already registered!";
					return $error;
				}
				else{
					$sql="INSERT INTO customer_account VALUES ('','$subscID','$email','$enc_pwd','$fname','$lname','$street','$city','$state','$zip','')";
     				if ($this->data->query($sql)){
					$error="";
					$_SESSION["Email"]=$email;
	
					return $error;	
					}
				}
			}
			else{
				return $error;
			}
		}
	function get_products() {    
        $products=$this->data->fetchRows("SELECT * FROM products");
        return $products;    
    } 
	function getdetail_by_date(){
		$detail = $this->data->fetchRows("SELECT * FROM product_details order by Release_Date desc limit 0,10");
		return $detail;
	}
	function get_pid_by_pdid($id){
		$products = $this->data->fetchRows("SELECT * FROM products WHERE P_D_ID = '$id'");
		$i=0;
		$pid="";
		foreach($products as $value){
			$pid[$i]= $value['P_ID'];
			$i++;
			}
		return $pid;
	}
	function get_first_avaliable_item($id){
		$products = $this->data->fetchRows("SELECT * FROM products WHERE P_D_ID = '$id'");
		$pid = "";
		foreach($products as $value){
			if ($value['Product_Status'] == 0)
				$pid = $value ['P_ID'];
			}
		return $pid;
	}
	function getdetail_by_rent(){
		$detail = $this->data->fetchRows("SELECT * FROM product_details order by Rented_Times desc limit 0,15");
		return $detail;
	}
	function getdetail(){
		$detail = $this->data->fetchRows("SELECT * FROM product_details");
		return $detail;
	}
	function get_detail_by_id($id){
		$detail = $this->data->fetchRows("SELECT * FROM product_details WHERE P_D_ID = '$id'");
		return $detail;
	}
	function get_product($id) {    
        $products=$this->data->fetchRows("SELECT * FROM products WHERE P_ID = '$id'");
        return $products;    
    }
	function get_products_by_detail($id) {    
        $products=$this->data->fetchRows("SELECT * FROM products WHERE P_D_ID = '$id' and Product_Status = '0'");
        return $products;    
    }
	function get_detail($product){
		foreach($product as $value){
			$pdid = $value['P_D_ID'];
			$detail = $this->data->fetchRows("SELECT * FROM product_details WHERE P_D_ID = '$pdid'");
		}
		return $detail;
	}
	function get_historys(){
		$historys=$this->data->fetchRows("SELECT * FROM rental_history");
        return $historys;  
		}
	function get_pdid_by_queue($id){
		$queue=$this->data->fetchRows("SELECT * FROM rental_queue WHERE Queue_ID = '$id'");
		foreach ($queue as $value ){
			$pdid = $value ['P_D_ID'];
		}
        return $pdid;  
		}
	function get_cid_by_queue($id){
		$queue=$this->data->fetchRows("SELECT * FROM rental_queue WHERE Queue_ID = '$id'");
		foreach ($queue as $value ){
			$cid = $value ['Customer_ID'];
		}
        return $cid;  
		}
	function get_pid_by_history($id){
		$history=$this->data->fetchRows("SELECT * FROM rental_history WHERE RH_ID = '$id'");
		foreach ($history as $value ){
			$pid = $value ['P_ID'];
		}
        return $pid;  
		}
	function get_history($id){
		$history=$this->data->fetchRows("SELECT * FROM rental_history where Customer_ID = $id and Date_Returned = '0000-00-00'");
		return $history;  
		}
	function get_queue($id){
		$queue=$this->data->fetchRows("SELECT * FROM rental_queue where Customer_ID = '$id'");
		return $queue;  
		}
	function get_history_product($history){
		$i=0;
		$productT="";
		foreach($history as $value){
			$p_id = $value['P_ID'];
			$productT[$i] = $this->data->fetchRows("SELECT * FROM products WHERE P_ID = '$p_id'");
			$i++;
		}
		return $productT;
	}
	function dropitem($id){
		$sql= "DELETE FROM rental_queue WHERE Queue_ID =".$id;
		$this->data->query($sql);
		}
	function get_history_detail($productT){
		$i=0;
		$detailT="";
		while (@$productT[$i]){
			foreach ($productT[$i] as $value)
				$pdid=$value['P_D_ID'];
				$detailT[$i] = $this->data->fetchRows("SELECT * FROM product_details WHERE P_D_ID = '$pdid'");
			$i++;
		}
		return $detailT;
	}
	function get_queue_detail($queue){
		$detail="";
		$i=0;
		foreach ($queue as $value){
			$pdid=$value['P_D_ID'];
			$detail[$i] = $this->data->fetchRows("SELECT * FROM product_details WHERE P_D_ID = '$pdid'");
			$i++;
		}
		return $detail;
	}
	function check_status($id){
		$i=0;
		$product_id="";
		while(@$id[$i]){
			$pid = $id[$i];
			$product = $this->data->fetchRows("SELECT * FROM products WHERE P_ID = '$pid'");
			foreach($product as $value){
				if ($value['Product_Status'] == 0)
					$product_id = $pid;
				}
				$i++;
			}
		return $product_id;
		}
	function check_emp(){
		if($_SESSION['Email'] && $_SESSION['is_employee'] != 1)
			return false;
		else
			return true;
		}
	function putinqueue(){
		$pdid=$_GET['id'];
		$cid = $_SESSION['CID'];
		$sql = "INSERT INTO rental_queue VALUES ('','$cid','$pdid')";
		if($this->data->query($sql))
			$success = true;
		else
			$success = false;
		}
	function confirmrent($pid,$cid){
		$success = false;
		$date = date("Y-m-d");
		$sql = "INSERT INTO rental_history VALUES ('','$pid','$date','','$cid')";
		if($this->data->query($sql)){
			$sql=" UPDATE products SET Rented_times = Rented_times+1 WHERE P_ID='$pid'";
			if($this->data->query($sql))
				$success = true;				
		}
		return $success;
	}
	function updatetimes($id){
		$times = 0;
		$product =$this->data->fetchRows("SELECT * FROM products WHERE P_ID = '$id'");
			foreach ($product as $value){
				$pdid = $value['P_D_ID'];
				}
		$product = $this->data->fetchRows("SELECT * FROM products WHERE P_D_ID = '$pdid'");
			foreach ($product as $value){
				$times += $value['Rented_Times'];
				}
		$sql="UPDATE product_details SET Rented_Times = $times WHERE P_D_ID='$pdid'";
		$this->data->query($sql);
	}
	function set_rented($id){
		$product =$this->data->fetchRows("SELECT * FROM products WHERE P_ID = '$id'");
		foreach($product as $value){
			$sql="UPDATE products SET Product_Status = 1 WHERE P_ID='$id'";
			$this->data->query($sql);
		}
	}
	function returnitem(){
		$id=$_GET['id'];
		//update status
		$history=$this->data->fetchRows("SELECT * FROM rental_history where RH_ID = $id and Date_Returned = '0000-00-00'");
		foreach($history as $value){
			$P_ID = $value['P_ID'];
			}
		$sql1 = "UPDATE products SET Product_Status = 0 WHERE P_ID='$P_ID'";
		$date = date("Y-m-d");
		$sql2 = "UPDATE rental_history SET Date_Returned = '$date' WHERE RH_ID='$id'";
		if($this->data->query($sql1)&&$this->data->query($sql2))
			return true;
		else
			return false;
		}
	function place_tradein(){
		$id = $_GET['id'];
		$cid = $_SESSION['CID'];
		$date = date("Y-m-d");
		$sql="INSERT INTO trade VALUES ('','$cid','$date','','$id','','','')";
		if($this->data->query($sql))
		return true;
		else
		return false;
	}
	function get_trade(){
		$cid = $_SESSION['CID'];
		$trades = $this->data->fetchRows("SELECT * FROM trade WHERE Customer_ID = '$cid'");
		return $trades;
	}
	function searchproduct(){
		$keyword = @$_POST['search'];
		$product = $this->data->fetchRows("SELECT * FROM product_details WHERE Product_Title like '%$keyword%'");
		return $product;
	}
}

?>