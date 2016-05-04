<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>8-bit crusader</title>
<link href="default.css" rel="stylesheet" type="text/css" />

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
<center><img src="images/building.jpg"></center>
<div id="content">
	<h3>Account Registration</h3>
	<p>
	<!-- FORM BEGIN -->
	<?php
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
	?>
	
	<p><span class="error">*</span> Indicates a required field.</p>
  <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<legend>Personal Information</legend>
			<label for="fname">First Name</label><br/>
			<input type="text" name="fname" value="<?php echo $fname;?>">
			<span class="error">* <?php echo $fnameErr;?></span><br/>
			<label for="lname">Last Name</label><br/>
			<input type="text" name="lname" value="<?php echo $lname;?>">
			<span class="error">* <?php echo $lnameErr;?></span>
		</fieldset><br/>
		<fieldset>
		  <legend>User Information</legend>
			<p>
			  <label for="email">Email</label>
			  <br/>
			  <input type="text" name="email" value="<?php echo $email;?>">
			  <span class="error">* <?php echo $emailErr;?></span><br/>
			  <label for="pwd">Password</label>
			  <br/>
			  <input type="password" name="pwd" value="<?php echo $pwd;?>">
			  <span class="error">* <?php echo $pwdErr;?></span><br/>
			  <label for="pwd1">Confirm Password</label>
			  <br/>
			  <input type="password" name="pwd1" value="<?php echo $pwd1;?>">
			  <span class="error">* <?php echo $pwd1Err;?></span><br/>
              <label for="subscID">Subscription Plan</label>
              <br/>
              <?php     
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
 			?> 
            <select name="subscID">
            <?php
			for ($i = 0; $i < count($fValue); $i++){
				echo "<option value = '$fValue[$i]'>$fMenu[$i]</option>";
				}
			?>
            </select>
          <!-- <div id = "a"></div>		for javascript,good to learn though-->
			</p>
    </fieldset>
       <!-- <script language="javascript" defer="defer"> 
			<!--?php    
  			$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
			mysqli_select_db($conn,"8BDB") or die("Database not found.");
			$query1=mysqli_query($conn, "select * from subscription_plan");          
  			$fMenu="";     
  			$fValue="";     
 			while($row=mysqli_fetch_array($query1)){     
  				$fMenu.="\"".$row[1]."\",";     
  				$fValue.="\"".$row[0]."\","; 
				}
			$fMenu=substr($fMenu,0,(strlen($fMenu)-1));     
  			$fMenu="[".$fMenu."]";//*****************************GET var   fMenu     
  			$fValue=substr($fValue,0,(strlen($fValue)-1));     
  			$fValue="[".$fValue."]";     
 			?> 
 		var   fMenu   =   <!--?php   echo   $fMenu;   ?>;     
  		var   fValue   =   <!--?php   echo   $fValue;   ?>;      
   		var board = document.getElementById("a");
        var ofMenu = document.createElement("SELECT");
        ofMenu.type = "SELECT";
		ofMenu.name = "subscID";
        var object = board.appendChild(ofMenu);
 		createMainOptions();      
		function   createMainOptions()   {     
  			for(var   i=0;i<fMenu.length;i++)ofMenu.options[i]   =   new   Option(fMenu[i],fValue[i]);     
  		} 
		</script> -->
		<fieldset>
			<legend>Address</legend>
			<label for="street">Street Address</label><br/>
			<input type="text" name="street" value="<?php echo $street;?>"><br/>
			<label for="city">City</label><br/>
			<input type="text" name="city" value="<?php echo $city;?>"><br/>
			<label for="state">State</label><br/>
			<input type="text" name="state" value="<?php echo $state;?>"><br/>
			<label for="zip">Zip</label><br/>
			<input type="text" name="zip" value="<?php echo $zip;?>">
		</fieldset><br/>
	<input type="submit" name="submit" value="Submit">
    <input type="reset" name="reset" value="Reset">
	</form>
	</p>
</div>
<div id="footer">
<p>Copyright &copy; 2014 8-bit Crusader.</p>
</div>
</body>
</html>
