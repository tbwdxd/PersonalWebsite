<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>8-bit crusader</title>
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php
session_start();
if ($_SESSION['is_employee'] == 1){
$class1 = new empolyee;
}
else{
$class1 = new customer;
}
$class1->print_table($class1->size);
?>
</body>
<?php
abstract class regist{
	public function emptyqueue($size){
		for ($i=0;$i<$size;$i++){
			$emptyqueue[$i]="";
			}
		return $emptyqueue;
		}
	public function conn($dbTable){
			$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
			mysqli_select_db($conn,"8BDB") or die("Database not found.");
			$query=mysqli_query($conn, "select * from $dbTable"); 
			return $query;
		}
	public function locate($dbTable,$index,$input){
		$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
			mysqli_select_db($conn,"8BDB") or die("Database not found.");
			$query=mysqli_query($conn, "select * from $dbTable WHERE $index = '$input'"); 
			return $query;
		}
	public function print_table($size){
		$contentqueue = $this->emptyqueue($size);
		$this->creat_form($contentqueue);
		}
	
	abstract protected function creat_form($contentqueue);
	abstract protected function register($contentqueue);
	abstract protected function check_();
	
}

class empolyee extends regist{
	var $size = 18;
	protected function creat_form($contentqueue){
		if($_SERVER["REQUEST_METHOD"] == "POST") {
		$contentqueue=$this->check_();
		}
		//definitions of the queue's index
		$fname = $contentqueue[0];
		$lname = $contentqueue[1];
		$email = $contentqueue[2];
		$pwd = $contentqueue[3];
		$pwd1 = $contentqueue[4];
		$street = $contentqueue[5];
		$city = $contentqueue[6];
		$state = $contentqueue[7];
		$zip = $contentqueue[8];
		$fnameErr= $contentqueue[9];
		$lnameErr = $contentqueue[10];
		$emailErr = $contentqueue[11];
		$pwdErr = $contentqueue[12];
		$pwd1Err = $contentqueue[13];
		$status = $contentqueue[14];
		$hiredate = $contentqueue[15];
		$leavedate = $contentqueue[16];
		$payrate = $contentqueue[17];
		$action= htmlspecialchars($_SERVER["PHP_SELF"]);

		echo "
		<h2>Employee Account Creation</h2>
		<p><span class='error'>*</span> Indicates a required field.</p>		
 			<form method='post' action= '$action'>
			<fieldset>
			<legend>Personal Information</legend>
			<label for='fname'>First Name</label><br/>
			<input type='text' name='fname' value= '$fname'>
			<span class='error'>*  $fnameErr </span><br/>
			<label for='lname'>Last Name</label><br/>
			<input type='text' name='lname' value='$lname'>
			<span class='error'>*$lnameErr</span>
		</fieldset><br/>
		<fieldset>
		  <legend>User Information</legend>
			<p>
			  <label for='email'>Email</label>
			  <br/>
			  <input type='text' name='email' value='$email'>
			  <span class='error'>* $emailErr</span><br/>
			  <label for='pwd'>Password</label>
			  <br/>
			  <input type='password' name='pwd' value='$pwd'>
			  <span class='error'>* $pwdErr</span><br/>
			  <label for='pwd1'>Confirm Password</label>
			  <br/>
			  <input type='password' name='pwd1' value='$pwd1'>
			  <span class='error'>* $pwd1Err</span><br/>
              <br/> 
			  </select>
			</p>
    </fieldset>
		<fieldset>
			<legend>Address</legend>
			<label for='street'>Street Address</label><br/>
			<input type='text' name='street' value='$street'><br/>
			<label for='city'>City</label><br/>
			<input type='text' name='city' value='$city'><br/>
			<label for='state'>State</label><br/>
			<input type='text' name='state' value='$state'><br/>
			<label for='zip'>Zip</label><br/>
			<input type='text' name='zip' value='$zip'>
		</fieldset><br/>
		<fieldset>
			<legend>Emplyee Information</legend>
			<label for='status'>Satus</label><br/>
			<input type='text' name='status' value='$status'><br/>
			<label for='hiredate'>Hire Date</label><br/>
			<input type='text' name='hiredate' value='$hiredate'><span class='error'>* Format: yyyy-mm-dd</span><br/>
			<label for='leavedate'>Leave Date</label><br/>
			<input type='text' name='leavedate' value='$leavedate'><span class='error'>* Format: yyyy-mm-dd</span><br/>
			<label for='payrate'>Pay Rate</label><br/>
			<input type='text' name='payrate' value='$payrate'>
		</fieldset><br/>
	<input type='submit' name='submit' value='Submit'>
    <input type='reset' name='reset' value='Reset'>
	</form>";	
		}
	protected function register($contentqueue){
			$job_done = false;
			$fname = $contentqueue[0];
			$lname = $contentqueue[1];
			$email = $contentqueue[2];
			$pwd = $contentqueue[3];
			$pwd1 = $contentqueue[4];
			$street = $contentqueue[5];
			$city = $contentqueue[6];
			$state = $contentqueue[7];
			$zip = $contentqueue[8];
			$status = $contentqueue[14];
			$hiredate = $contentqueue[15];
			$leavedate = $contentqueue[16];
			$payrate = $contentqueue[17];
			$enc_pwd = hash("sha512", $pwd);
			$address = 0;
			$query = $this->locate("employee","Emp_Email",$contentqueue[2]);		
			if(mysqli_num_rows($query) != 0) {
				echo "<p><span class='error'>This email address is already registered!</span></p>";
			}
			else {
				$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
				mysqli_select_db($conn,"8BDB") or die("Database not found.");
				$query = mysqli_query($conn,"INSERT INTO employee VALUES ('','$fname','$lname','$street','$city','$state','$zip','$email','$enc_pwd','$status','$hiredate','$leavedate','$payrate')");
				if ($query == FALSE){
					echo "<h1>Registration Failed</h1>";
					return $job_done;
				}
				else{
					echo "<h1>Registration Successful!</h1>";
					$job_done = true;
					return $job_done;
				}
			}
		}
	protected function check_(){
			$isError = false;
			$contentqueue=$this->emptyqueue($this->size);//creat empty queue
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if(empty($_POST["fname"])) {
				$contentqueue[9] = "First name is required.";
				$isError = true;
			}
			else {
				$contentqueue[0] = test_input($_POST["fname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$contentqueue[0])) {
					$contentqueue[9] = "Only letters and white space allowed.";
					$isError = true;
				}
				if(strlen($contentqueue[0])>50) {
					$contentqueue[9] = "Your name must be less than 50 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["lname"])) {
				$contentqueue[10] = "Last name is required.";
				$isError = true;
			}
			else {
				$contentqueue[1] = test_input($_POST["lname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$contentqueue[1])) {
					$contentqueue[10] = "Only letters and white space allowed.";
					$isError = true;
				}
				if(strlen($contentqueue[1])>50) {
					$contentqueue[10] = "Your name must be less than 50 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["email"])) {
				$contentqueue[11] = "Email is required.";
				$isError = true;
			}
			else {
				$contentqueue[2] = test_input($_POST["email"]);
				// check if e-mail address syntax is valid
				if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$contentqueue[2])) {
					$contentqueue[11] = "Invalid email format";
					$isError = true;
				}
				if(strlen($contentqueue[1])>255) {
					$contentqueue[10] = "Your email must be less than 255 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["pwd"])) {
				$contentqueue[12] = "Password is required.";
				$isError = true;
			}
			else {
				$contentqueue[3] = test_input($_POST["pwd"]);
			}
			
			if(empty($_POST["pwd1"])) {
				$contentqueue[13] = "Please Re-Enter Your Password.";
				$isError = true;
			}
			else {
				$contentqueue[4] = test_input($_POST["pwd1"]);
				if($contentqueue[3] != $contentqueue[4]) {
					$contentqueue[12] = $contentqueue[13] = "Passwords do not match.";
					$isError = true;
				}
			}
			if(empty($_POST["street"])) {
				$contentqueue[5] = "";
			}
			else {
				$contentqueue[5] = test_input($_POST["street"]);
			}
			
			if(empty($_POST["street"])) {
				$contentqueue[5] = "";
			}
			else {
				$contentqueue[5] = test_input($_POST["street"]);
			}
			if(empty($_POST["city"])) {
				$contentqueue[6] = "";
			}
			else {
				$contentqueue[6] = test_input($_POST["city"]);
			}
			if(empty($_POST["state"])) {
				$contentqueue[7] = "";
			}
			else {
				$contentqueue[7] = test_input($_POST["state"]);
			}
			if(empty($_POST["zip"])) {
				$contentqueue[8] = "";
			}
			else {
				$contentqueue[8] = test_input($_POST["zip"]);
			}
			if(empty($_POST["status"])) {
				$contentqueue[14] = "";
			}
			else {
				$contentqueue[14] = test_input($_POST["status"]);
			}
			if(empty($_POST["hiredate"])) {
				$contentqueue[15] = "";
			}
			else {
				$contentqueue[15] = test_input($_POST["hiredate"]);
			}
			if(empty($_POST["leavedate"])) {
				$contentqueue[16] = "";
			}
			else {
				$contentqueue[16] = test_input($_POST["leavedate"]);
			}
			if(empty($_POST["payrate"])) {
				$contentqueue[17] = "";
			}
			else {
				$contentqueue[17] = test_input($_POST["payrate"]);
			}
			if(!$isError) {
				if($this->register($contentqueue)){
					return $this->emptyqueue($this->size);
					}
				else{
					return $contentqueue;
					}
				}
			else{
				return $contentqueue;
				}
		}	
	}
class customer extends regist{
	 var $size = 14;
	 protected function creat_form($contentqueue){
		if($_SERVER["REQUEST_METHOD"] == "POST") {
		$contentqueue=$this->check_();
		}
		//definitions of the queue's index
		$fname = $contentqueue[0];
		$lname = $contentqueue[1];
		$email = $contentqueue[2];
		$pwd = $contentqueue[3];
		$pwd1 = $contentqueue[4];
		$street = $contentqueue[5];
		$city = $contentqueue[6];
		$state = $contentqueue[7];
		$zip = $contentqueue[8];
		$fnameErr= $contentqueue[9];
		$lnameErr = $contentqueue[10];
		$emailErr = $contentqueue[11];
		$pwdErr = $contentqueue[12];
		$pwd1Err = $contentqueue[13];
		$action= htmlspecialchars($_SERVER["PHP_SELF"]);

		echo "
		<h2>Customer Registration</h2>
		<p><span class='error'>*</span> Indicates a required field.</p>		
 			<form method='post' action= '$action'>
			<fieldset>
			<legend>Personal Information</legend>
			<label for='fname'>First Name</label><br/>
			<input type='text' name='fname' value= '$fname'>
			<span class='error'>*  $fnameErr </span><br/>
			<label for='lname'>Last Name</label><br/>
			<input type='text' name='lname' value='$lname'>
			<span class='error'>*$lnameErr</span>
		</fieldset><br/>
		<fieldset>
		  <legend>User Information</legend>
			<p>
			  <label for='email'>Email</label>
			  <br/>
			  <input type='text' name='email' value='$email'>
			  <span class='error'>* $emailErr</span><br/>
			  <label for='pwd'>Password</label>
			  <br/>
			  <input type='password' name='pwd' value='$pwd'>
			  <span class='error'>* $pwdErr</span><br/>
			  <label for='pwd1'>Confirm Password</label>
			  <br/>
			  <input type='password' name='pwd1' value='$pwd1'>
			  <span class='error'>* $pwd1Err</span><br/>
              <label for='subscID'>Subscription Plan</label>
              <br/> ";
			$fMenu="";     
  			$fValue="";  
			$i = 0;  
			$query =  $this->conn("subscription_plan");
 			while($row=mysqli_fetch_array($query)){     
  				$fMenu[$i]=$row[1];
				$frate[$i]=$row[2];     
  				$fValue[$i]=$row[0]; 
				$vb[$i]=$row[3];
				$i++;
				}
 			echo "<select name='subscID'>";
         	for ($i = 0; $i < count($fValue); $i++){
				if ($vb[$i] == 1)
					echo "<option value = '$fValue[$i]'>$fMenu[$i] for $$frate[$i]</option>";
				}
			echo "</select>
			</p>
    </fieldset>
		<fieldset>
			<legend>Address</legend>
			<label for='street'>Street Address</label><br/>
			<input type='text' name='street' value='$street'><br/>
			<label for='city'>City</label><br/>
			<input type='text' name='city' value='$city'><br/>
			<label for='state'>State</label><br/>
			<input type='text' name='state' value='$state'><br/>
			<label for='zip'>Zip</label><br/>
			<input type='text' name='zip' value='$zip'>
		</fieldset><br/>
	<input type='submit' name='submit' value='Submit'>
    <input type='reset' name='reset' value='Reset'>
	</form>";	
		}
	protected function check_(){
		    $isError = false;
			$contentqueue=$this->emptyqueue($this->size);//creat empty queue
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
			if(empty($_POST["fname"])) {
				$contentqueue[9] = "First name is required.";
				$isError = true;
			}
			else {
				$contentqueue[0] = test_input($_POST["fname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$contentqueue[0])) {
					$contentqueue[9] = "Only letters and white space allowed.";
					$isError = true;
				}
				if(strlen($contentqueue[0])>50) {
					$contentqueue[9] = "Your name must be less than 50 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["lname"])) {
				$contentqueue[10] = "Last name is required.";
				$isError = true;
			}
			else {
				$contentqueue[1] = test_input($_POST["lname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$contentqueue[1])) {
					$contentqueue[10] = "Only letters and white space allowed.";
					$isError = true;
				}
				if(strlen($contentqueue[1])>50) {
					$contentqueue[10] = "Your name must be less than 50 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["email"])) {
				$contentqueue[11] = "Email is required.";
				$isError = true;
			}
			else {
				$contentqueue[2] = test_input($_POST["email"]);
				// check if e-mail address syntax is valid
				if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$contentqueue[2])) {
					$contentqueue[11] = "Invalid email format";
					$isError = true;
				}
				if(strlen($contentqueue[1])>255) {
					$contentqueue[10] = "Your email must be less than 255 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["pwd"])) {
				$contentqueue[12] = "Password is required.";
				$isError = true;
			}
			else {
				$contentqueue[3] = test_input($_POST["pwd"]);
			}
			
			if(empty($_POST["pwd1"])) {
				$contentqueue[13] = "Please Re-Enter Your Password.";
				$isError = true;
			}
			else {
				$contentqueue[4] = test_input($_POST["pwd1"]);
				if($contentqueue[3] != $contentqueue[4]) {
					$contentqueue[12] = $contentqueue[13] = "Passwords do not match.";
					$isError = true;
				}
			}
			if(empty($_POST["street"])) {
				$contentqueue[5] = "";
			}
			else {
				$contentqueue[5] = test_input($_POST["street"]);
			}
			
			if(empty($_POST["street"])) {
				$contentqueue[5] = "";
			}
			else {
				$contentqueue[5] = test_input($_POST["street"]);
			}
			if(empty($_POST["city"])) {
				$contentqueue[6] = "";
			}
			else {
				$contentqueue[6] = test_input($_POST["city"]);
			}
			if(empty($_POST["state"])) {
				$contentqueue[7] = "";
			}
			else {
				$contentqueue[7] = test_input($_POST["state"]);
			}
			if(empty($_POST["zip"])) {
				$contentqueue[8] = "";
			}
			else {
				$contentqueue[8] = test_input($_POST["zip"]);
			}
			if(!$isError) {
				if($this->register($contentqueue)){return $this->emptyqueue($this->size);}
				else{return $contentqueue;}
				}
			else{
				return $contentqueue;
				}
	}
	protected function register($contentqueue){
		    $job_done = false;
			$subscID = $_POST["subscID"];
			$fname = $contentqueue[0];
			$lname = $contentqueue[1];
			$email = $contentqueue[2];
			$pwd = $contentqueue[3];
			$pwd1 = $contentqueue[4];
			$street = $contentqueue[5];
			$city = $contentqueue[6];
			$state = $contentqueue[7];
			$zip = $contentqueue[8];
			$enc_pwd = hash("sha512", $pwd);
			$address = 0;
			$query = $this->locate("customer_account","Email",$contentqueue[2]);		
			if(mysqli_num_rows($query) != 0) {
				echo "<p><span class='error'>This email address is already registered!</span></p>";
			}
			else {
				$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
			mysqli_select_db($conn,"8BDB") or die("Database not found.");
				$query = mysqli_query($conn,"INSERT INTO customer_account VALUES ('','$subscID','$email','$enc_pwd','$fname','$lname','$street','$city','$state','$zip','')");
			if ($query == FALSE){
			echo "<h1>Registration Failed</h1>";
			return $job_done;
			}
			else{
			echo "<h1>Registration Successful!</h1>";
			$job_done = true;
			return $job_done;
			}
			}
			}
	}

?>
</html>
