<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<title>LoginCheck</title>
</head>
<body>
<center>
<?php
	session_start();
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
		$action= htmlspecialchars($_SERVER["PHP_SELF"]);
		if($numrows != 0) {
			while($row = mysqli_fetch_assoc($query)) {
				$dbemail = $row['Email'];
				$dbpwd = $row['Password'];
				$name = $row['First_Name']." ".$row['Last_Name'];
			}
			if(($email == $dbemail) && ($pwd == $dbpwd)) {
				$_SESSION['Email']=$dbemail;
				$_SESSION['Name']=$name;
				$_SESSION['is_employee']=0;
				echo "Dear $name, Login successful: Redirecting to <a href='account_management.php'>Customer Account Management</a>";
				header("Location: account_management.php");
				die();
			}
		}	
		$query = mysqli_query($conn,"SELECT * FROM employee WHERE Emp_Email='$email'");
		$numrows = mysqli_num_rows($query);
		if($numrows != 0) {
			while($row = mysqli_fetch_assoc($query)) {
				$dbemail = $row['Emp_Email'];
				$dbpwd = $row['Emp_Password'];
				$name = $row['Employee_Fname']." ".$row['Employee_Lname'];
			}
			if(($email == $dbemail) && ($pwd == $dbpwd)) {
				$_SESSION['Email']=$dbemail;
				$_SESSION['Name']=$name;
				$_SESSION['is_employee']=1;
				echo "Dear $name, Login successful: Redirecting to <a href='Emp_management.php'>Employee Management Page</a>";
				header("Location: Emp_management.php");
				die();
			}
		}
	}
	header("Location: index.php?error=Invalid Email/Password. Please try again.");
?>

</center>
</body>
</html>
