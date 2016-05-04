<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<title>ChangePassword</title>
</head>
<body>
<center>
<?php
	session_start();
	// define variables and set to empty values
	$email = $pwd = $pwd1= $pwd2 = $pwd1Err= $pwd2Err="";
	$isError = false;
	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = $_SESSION['Email'];
		if (empty($_POST["pwd"])) {
			header("Location: account_management.php?error=Please type in correct password.");
		}
		else {
			$pwd = hash("sha512", test_input($_POST["pwd"]));
		}
		if (!empty($_POST["pwd1"])){
			if (!empty($_POST["pwd2"])){
				$pwd1 = test_input($_POST["pwd1"]);
				$pwd2 = test_input($_POST["pwd2"]);
				if($pwd1 == $pwd2){
					$pwdec =  hash("sha512", $pwd1);
					$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
					mysqli_select_db($conn,"8BDB") or die("Database not found.");
					$email = $_SESSION['Email'];
					$query = mysqli_query($conn,"UPDATE customer_account SET Password='$pwdec' WHERE Email='$email'");
					echo "<h2>Password has arleady been changed.</h2>";
				}
				else 
					$pwd1Err=$pwd2Err="Passwords do not match."	;
			}
			else
				$pwd2Err = "Password is required.";
		}
	}

	function test_input($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}
	if(!$isError) {
		$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
		mysqli_select_db($conn,"8BDB") or die("Database not found.");
		
		$query = mysqli_query($conn,"SELECT * FROM customer_account WHERE Email='$email'");
		$numrows = mysqli_num_rows($query);
		
		if($numrows != 0) {
			while($row = mysqli_fetch_assoc($query)) {
				$dbpwd = $row['Password'];
			}
			if(($pwd == $dbpwd)) {
				$action= htmlspecialchars($_SERVER["PHP_SELF"]);
				echo "<form method='post' action= '$action'>
						<fieldset><legend>Change Password</legend>
           					 <br/><p><span class='error'>*</span> Indicates a required field.</p>
							  <label for='pwd1'>Password</label>
							 <input type='password' name='pwd1' value=''>
			  				<span class='error'>* $pwd1Err</span><br/>
			  				<label for='pwd2'>Confirm Password</label>
			  			<br/>
			 			 <input type='password' name='pwd2' value=''>
			 			 <span class='error'>* $pwd2Err</span><br/>";
				echo "<input type='submit' name='submit' value='Submit'></fieldset>";
             			
			}
			else{
				header("Location: account_management.php?error=Please type in correct password.");
			}
		}
	}
	
?>

</center>
</body>
</html>
