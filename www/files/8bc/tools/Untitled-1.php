<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>无标题文档</title>
</head>

<body>
<div id="menu">
	<ul>
		<li><a href="index.php">Home</a></li>
		<li><a href="products.php">Products</a></li>
		<li class="active"><a href="register.php">Register</a></li>
		<li><a href="signin.php">Sign In</a></li>
	</ul>
</div>
<div id="header">
	<h1>8-bit Crusader</h1>
	<h2>Game Rental Company</h2>
</div>
<div id="content">
	<h3>Account Registration</h3>
	<p>
	<!-- FORM BEGIN -->
	<?php
	abstract class print_element{
	public function putout($for,$content,$type,$name,$value,$error){
		echo "<label for=$for>$content</label><br/>
			<input type=$type name=$name value= $value>
			<span class='error'>*  $error </span><br/>";
		}
	abstract protected function print_();
		}
class feild1 extends print_element{
	public function print_(){
		echo "<p><span class='error'>*</span> Indicates a required field.</p>		
 			<form method='post' action= '$action'>
			<fieldset>
			<legend>Personal Information</legend>";
		$this->putout("fname","First Name","text","fname",$fname,$fnameError);
		}
	} 
		// define variables and set to empty values
		$fnameErr = $lnameErr = $emailErr = $pwdErr = $pwd1Err = "";
		$fname = $lname = $email = $street = $city = $state = $zip = $subscID = $pwd = $pwd1 = "";
		$isError = true;
		
		if($_SERVER["REQUEST_METHOD"] == "POST") {
			$subscID = $_POST["subscID"];
			$isError = false;
			if(empty($_POST["fname"])) {
				$fnameErr = "First name is required.";
				$isError = true;
			}
			else {
				$fname = test_input($_POST["fname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$fname)) {
					$fnameErr = "Only letters and white space allowed.";
					$isError = true;
				}
				if(strlen($fname)>50) {
					$fnameErr = "Your name must be less than 50 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["lname"])) {
				$lnameErr = "Last name is required.";
				$isError = true;
			}
			else {
				$lname = test_input($_POST["lname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$lname)) {
					$lnameErr = "Only letters and white space allowed.";
					$isError = true;
				}
				if(strlen($lname)>50) {
					$lnameErr = "Your name must be less than 50 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["email"])) {
				$emailErr = "Email is required.";
				$isError = true;
			}
			else {
				$email = test_input($_POST["email"]);
				// check if e-mail address syntax is valid
				if(!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
					$emailErr = "Invalid email format";
					$isError = true;
				}
				if(strlen($lname)>255) {
					$lnameErr = "Your email must be less than 255 characters.";
					$isError = true;
				}
			}
			
			if(empty($_POST["pwd"])) {
				$pwdErr = "Password is required.";
				$isError = true;
			}
			else {
				$pwd = test_input($_POST["pwd"]);
			}
			
			if(empty($_POST["pwd1"])) {
				$pwd1Err = "Please Re-Enter Your Password.";
				$isError = true;
			}
			else {
				$pwd1 = test_input($_POST["pwd1"]);
				if($pwd != $pwd1) {
					$pwdErr = $pwd1Err = "Passwords do not match.";
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
		}
		
		
		function test_input($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);
			return $data;
		}
		
		if(!$isError) {
			$enc_pwd = hash("sha512", $pwd);
			$address = 0;
			
			$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
			mysqli_select_db($conn,"8BDB") or die("Database not found.");
			
			$query = mysqli_query($conn,"SELECT * FROM customer_account WHERE Email='$email'");
			if(mysqli_num_rows($query) != 0) {
				echo "<p><span class='error'>This email address is already registered!</span></p>";
			}
			else {
				$query = mysqli_query($conn,"INSERT INTO customer_account VALUES ('','$subscID','$email','$enc_pwd','$fname','$lname','$street','$city','$state','$zip','')");
			if ($query == FALSE){
			echo "<h1>Fucking Failed</h1>";
			echo "'$subscID','$email','$enc_pwd','$fname','$lname','$street','$city','$state','$zip',''";
			}
			else{
			echo "<h1>Registration Successful!</h1>";
			}
			}
			$fnameErr = $lnameErr = $emailErr = $pwdErr = $pwd1Err = "";
			$subscID = $fname = $lname = $email = $street = $city = $state = $zip = $pwd = $pwd1 = "";
		}
		$action = htmlspecialchars($_SERVER["PHP_SELF"]);
	    echo "<p><span class='error'>*</span> Indicates a required field.</p>		
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
  			$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
			mysqli_select_db($conn,"8BDB") or die("Database not found.");
			$query1=mysqli_query($conn, "select * from subscription_plan");          
  			$fMenu="";     
  			$fValue="";  
			$i = 0;   
 			while($row=mysqli_fetch_array($query1)){     
  				$fMenu[$i]=$row[1];     
  				$fValue[$i]=$row[0]; 
				$i++;
				}
 			echo "<select name='subscID'>";
         	for ($i = 0; $i < count($fValue); $i++){
				echo "<option value = '$fValue[$i]'>$fMenu[$i]</option>";
				}
			echo "	
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
	<input type='submit' name='submit' value='Submit'>
    <input type='reset' name='reset' value='Reset'>
	</form>"
    ?>
	</p>
</div>
</body>
</html>