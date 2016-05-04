<?php

class Model {
    
    var $data; 
    function __construct(&$data) {
        $this->data=$data; 
    }
    function get_dep(){
		$dep = $this->data->fetchRows("SELECT * FROM department WHERE NOT Department_ID = 1");
		return $dep;
		}
	function get_course(){
		$dep = $this->data->fetchRows("SELECT * FROM course");
		return $dep;
		}
	function get_detail(){
		$dep = $this->data->fetchRows("SELECT * FROM course_detail");
		return $dep;
		}
	function get_faculty(){
		$dep = $this->data->fetchRows("SELECT * FROM account WHERE Type = 2");
		return $dep;
		}
	function search_stu(){
		$CWID = $_POST['CWID'];
		$stu = $this->data->fetchRows("SELECT * FROM account WHERE CWID = $CWID AND Type = 1");
		return $stu;
		}
	function search_fac(){
		$CWID = $_POST['CWID'];
		$fac = $this->data->fetchRows("SELECT * FROM account WHERE CWID = $CWID AND Type = 2");
		return $fac;
		}
    function add_stu(){
		$isError = false;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(empty($_POST["firstname"])) {
			$error['fnameErr'] = "First name is required.";
			$isError = true;
		}
		else {
			$fname = test_input($_POST["firstname"]);
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
			
			if(empty($_POST["lastname"])) {
				$error['lnameErr'] = "Last name is required.";
				$isError = true;
			}
			else {
				$lname = test_input($_POST["lastname"]);
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
			
			if(empty($_POST["password"])) {
				$error['pwdErr'] = "Password is required.";
				$isError = true;
			}
			else {
				$pwd = test_input($_POST["password"]);
			}
			
			if(empty($_POST["password1"])) {
				$error['pwd1Err'] = "Please Re-Enter Your Password.";
				$isError = true;
			}
			else {
				$pwd1= test_input($_POST["password1"]);
				if($pwd != $pwd1) {
					$error['pwd1Err'] = $error['pwdErr'] = "Passwords do not match.";
					$isError = true;
				}
			}
			if(empty($_POST["address"])) {
				$address = "";
			}
			else {
				$address = test_input($_POST["address"]);
			}
			
			if(!$isError) {
				$depID = $_POST["department"];
				$enc_pwd = hash("sha512", $pwd);
				$sql= "SELECT * FROM account WHERE Email='$email'";
				if($this->data->fetchRows($sql)){
					$error['emailErr']="This email address is already registered!";
					return $error;
				}
				else{
					$sql="INSERT INTO account VALUES ('','$enc_pwd','$fname','$lname','$email','$depID',1,'$address')";
     				if ($this->data->query($sql)){
					$error="";	
					return $error;	
					}
				}
			}
			else{
				return $error;
			}
		}
	function update_stu(){
		$isError = false;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(empty($_POST["firstname"])) {
			$error['fnameErr'] = "First name is required.";
			$isError = true;
		}
		else {
			$fname = test_input($_POST["firstname"]);
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
			
			if(empty($_POST["lastname"])) {
				$error['lnameErr'] = "Last name is required.";
				$isError = true;
			}
			else {
				$lname = test_input($_POST["lastname"]);
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
			
			if(empty($_POST["address"])) {
				$address = "";
			}
			else {
				$address = test_input($_POST["address"]);
			}
			
			if(!$isError) {
				$CWID = $_POST["CWID"];
				$depID = $_POST["department"];
				$sql="UPDATE account SET First_Name ='$fname', Last_Name = '$lname' , Email = '$email', Department_ID = '$depID', Address = '$address' WHERE CWID = $CWID";
     			if ($this->data->query($sql)){
					$error="";	
					return $error;	
					}
			}
			else{
				return $error;
			}
		}
	function add_fac(){
		$isError = false;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(empty($_POST["firstname"])) {
			$error['fnameErr'] = "First name is required.";
			$isError = true;
		}
		else {
			$fname = test_input($_POST["firstname"]);
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
			
			if(empty($_POST["lastname"])) {
				$error['lnameErr'] = "Last name is required.";
				$isError = true;
			}
			else {
				$lname = test_input($_POST["lastname"]);
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
			
			if(empty($_POST["password"])) {
				$error['pwdErr'] = "Password is required.";
				$isError = true;
			}
			else {
				$pwd = test_input($_POST["password"]);
			}
			
			if(empty($_POST["password1"])) {
				$error['pwd1Err'] = "Please Re-Enter Your Password.";
				$isError = true;
			}
			else {
				$pwd1= test_input($_POST["password1"]);
				if($pwd != $pwd1) {
					$error['pwd1Err'] = $error['pwdErr'] = "Passwords do not match.";
					$isError = true;
				}
			}
			if(empty($_POST["address"])) {
				$address = "";
			}
			else {
				$address = test_input($_POST["address"]);
			}
			
			if(!$isError) {
				$depID = $_POST["department"];
				$enc_pwd = hash("sha512", $pwd);
				$sql= "SELECT * FROM account WHERE Email='$email'";
				if($this->data->fetchRows($sql)){
					$error['emailErr']="This email address is already registered!";
					return $error;
				}
				else{
					$sql="INSERT INTO account VALUES ('','$enc_pwd','$fname','$lname','$email','$depID',2,'$address')";
     				if ($this->data->query($sql)){
					$error="";	
					return $error;	
					}
				}
			}
			else{
				return $error;
			}
		}
	function update_fac(){
		$isError = false;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(empty($_POST["firstname"])) {
			$error['fnameErr'] = "First name is required.";
			$isError = true;
		}
		else {
			$fname = test_input($_POST["firstname"]);
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
			
			if(empty($_POST["lastname"])) {
				$error['lnameErr'] = "Last name is required.";
				$isError = true;
			}
			else {
				$lname = test_input($_POST["lastname"]);
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
			
			if(empty($_POST["address"])) {
				$address = "";
			}
			else {
				$address = test_input($_POST["address"]);
			}
			
			if(!$isError) {
				$CWID = $_POST["CWID"];
				$depID = $_POST["department"];
				$sql="UPDATE account SET First_Name ='$fname', Last_Name = '$lname' , Email = '$email', Department_ID = '$depID', Address = '$address' WHERE CWID = $CWID";
     			if ($this->data->query($sql)){
					$error="";	
					return $error;	
					}
			}
			else{
				return $error;
			}
		}
	function add_dep(){
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(@$_POST["dpname"] != ""){
			$dpname = test_input($_POST["dpname"]);
			$dpphone = test_input($_POST["dpphone"]);
			$dpemail = test_input($_POST["dpemail"]);
			$sql="INSERT INTO department VALUES ('','$dpname','$dpphone','$dpemail')";
     		if ($this->data->query($sql)) return true;
     			else return false;
     	}
     	else return false;
	}
	function add_cdet(){
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(@$_POST["csname"] != "" && @$_POST["csunit"] != ""){
			$csname = test_input($_POST["csname"]);
			$csunit = test_input($_POST["csunit"]);
			$csbook = test_input($_POST["csbook"]);
			$depID = $_POST["department"];
			$cstype = $_POST["cstype"];
			$sql="INSERT INTO course_detail VALUES ('','$csname','$depID','$csunit','$cstype','$csbook')";
     		if ($this->data->query($sql)) return true;
     			else return false;
     	}
     	else return false;
	}
	function add_cs(){
		$isError = false;
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		if(empty($_POST["loc"])) {
			$error['locErr'] = "Location is required.";
			$isError = true;
		}
		else {
			$loc = test_input($_POST["loc"]);
			// check if name only contains letters and whitespace
			
			if(empty($_POST["date"])) {
				$error['dateErr'] = "Date is required.";
				$isError = true;
			}
			else {
				$date = test_input($_POST["date"]);
			}
			
			if(empty($_POST["capa"])) {
				$error['capaErr'] = "Capacity is required.";
				$isError = true;
			}
			else {
				$capa = test_input($_POST["capa"]);
				// check if e-mail address syntax is valid
				if(!preg_match("/^[1-9][0-9]*$/",$capa)) {
					$error['capaErr'] = "Invalid capacity format";
					$isError = true;
				}
				if(strlen($capa)>3) {
					$error['capaErr'] = "Your capacity must be less than 3 digits.";
					$isError = true;
				}
			}
		}
			if(!$isError) {
				$cdid = $_POST["cdid"];
				$CWID = $_POST["CWID"];
				$time = $_POST["cstime"];
				$sql= "SELECT * FROM course WHERE Time_Chunk='$time' AND Location = '$loc'";
				$sql1= "SELECT * FROM course WHERE Instructor_CWID='$CWID' AND Time_Chunk = '$time'";
				$sql3= "SELECT * FROM account WHERE CWID='$CWID'";
				$sql4= "SELECT * FROM course_detail WHERE Detail_ID='$cdid'";
				$faculty = $this->data->fetchRows($sql3);
				$detail = $this->data->fetchRows($sql4);
				foreach ($faculty as $value){
						$dpid1 = $value['Department_ID'];
					}
				foreach ($detail as $value){
						$dpid2 = $value['Department_ID'];
					}
				if($this->data->fetchRows($sql)){
					$error['HeadErr']="Duplicate Course at Same Time Same Location!";
					return $error;
				}
				else if($this->data->fetchRows($sql1)){
					$error['HeadErr']="Duplicate Course for Same Instructor at Same Time or Same Location!";
					return $error;
				}
				else if($dpid1 != $dpid2){
					$error['HeadErr']="This Instructor is Not Eligable for This Course!";
					return $error;
				}
				else{
					$sql= "SELECT * FROM course WHERE Detail_ID='$cdid'";
					$courses =$this->data->fetchRows($sql);
					$section =0;
					foreach ($courses as $value){
						if ($section <  $value['Section_Number'])
							$section = $value['Section_Number'];
					}
					$section ++;
					$sql2="INSERT INTO course VALUES ('','$cdid','$time','$section','$CWID', '$dpid1','$capa','$loc','$date')";
     				if ($this->data->query($sql2)){
					$error="";	
					return $error;	
					}
				}
			}
			else{
				$error['HeadErr'] ="Add Course Section Unsuccessful,Please Check Your Input.";
				return $error;
			}
	}
}
?>