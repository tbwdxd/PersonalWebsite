<?php 
	session_start();
	$class1 = new customer;
	//check	
	if(!$_SESSION['Email']) {
		header("Location: index.php");
		die();
	}
	if($_SESSION['is_employee'] == 1) {
		$class1 = new employee;
	}
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>8-bit crusader</title>
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
<div id="header">
  <h1>8-bit Crusader</h1>
	<h2>Game Rental Company</h2>
</div>
<center>
  <label for="123"></label>
</center>
<div id="content">
	<p>
    <?php 
	$class1->print_out($class1->dbTable,$email = $_SESSION['Email']);
    ?>
	</p>
</div>
<div id="footer">
<p>Copyright &copy; 2014 8-bit Crusader.</p>
</div>
</body>
<?php 
abstract class manage_ACCT{
	public function conn(){
		$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
		mysqli_select_db($conn,"8BDB") or die("Database not found.");
		return $conn;
		}
	public function locate($dbTable,$index,$input){
		$conn = $this->conn();
		$query=mysqli_query($conn, "select * from $dbTable  WHERE $index='$input'"); 
		return $query;
		}
	public function print_out($dbTable,$email){
		$query = $this->locate($dbTable,"email",$email); 
		$this->get_info($query);
	}
	public function update($row,$input){
		$conn = $this->conn();
		$email = $_SESSION['Email'];
		$query = mysqli_query($conn,"UPDATE customer_account SET $row='$input' WHERE email='$email'") or die("update not found.");
		}
	abstract protected function get_info($query);
	}
class customer extends manage_ACCT{
	var $dbTable = "customer_account";
	protected function get_info($query){
		$fnameErr="";
	    $lnameErr="";
		$pwd = "";
		$pwdErr="";
		$pwd1 = "";
		$pwd1Err="";
		$pwd2 = "";
		$pwd2Err="";
		$is_Error = false;
		function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
		$numrows = mysqli_num_rows($query);
		$action= htmlspecialchars($_SERVER["PHP_SELF"]);
		if($numrows != 0) {
			while($row=mysqli_fetch_array($query)){     
  				$cID=$row[0];
				$sID=$row[1];
				$cEM=$row[2];
				$cPwd=$row[3];
				$cFName=$row[4];
				$cLName=$row[5];
				$cStreet=$row[6];
				$cCity=$row[7];
				$cState=$row[8];
				$cZip=$row[9];
				$cbalance=$row[10];
			}
		}
		if(isset($_POST['submit'])) {
			if(empty($_POST["cFname"])) {
				$fnameErr = "First name is required.";
				$is_Error = true;
			}
			else {
				$cFName = test_input($_POST["cFname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$fnameErr)) {
					$fnameErr = "Only letters and white space allowed.";
					$is_Error = true;
				}
				if(strlen($cFName)>50) {
					$fnameErr = "Your name must be less than 50 characters.";
					$is_Error = true;
				}
			}
			if(empty($_POST["cLname"])) {
				$lnameErr = "First name is required.";
				$is_Error = true;
			}
			else {
				$cLName = test_input($_POST["cLname"]);
				// check if name only contains letters and whitespace
				if(!preg_match("/^[a-zA-Z ]*$/",$cLName)) {
					$lnameErr = "Only letters and white space allowed.";
					$is_Error = true;
				}
				if(strlen($cLName)>50) {
					$lnameErr = "Your name must be less than 50 characters.";
					$is_Error = true;
				}
			}
						
			if(!$is_Error) {
				$this->update('First_Name',$cFName);
				$this->update('Last_Name',$cLName);
				$cStreet = $_POST["cStreet"];
				$this->update('Street',$cStreet);
				$cCity = $_POST["cCity"];
				$this->update('City',$cCity);
				$cState = $_POST["cState"];
				$this->update('State',$cState);
				$cZip = $_POST["cZip"];
				$this->update('Zip',$cZip);
				$sID = $_POST["subscID"];
				$this->update('Subscription_ID',$sID);
				echo "<h3>Account INFO Update Successfully!!!</h3><br/>";
			}
			else{
				echo "<h3>Account INFO Update Failed!!!</h3><br/>";
				}			
		}
		if (isset($_POST['submit1'])){
				$pwd = hash("sha512", test_input($_POST["pwd"]));
				if($pwd == $cPwd){
					if(!(empty ($_POST["pwd1"]))){
						if(!(empty ($_POST["pwd2"]))){
							$pwd1 = test_input($_POST["pwd1"]);
							$pwd2 = test_input($_POST["pwd2"]);
							if($pwd1 == $pwd2){
								$pwdec =  hash("sha512", $pwd1);
								$this->update("password",$pwdec);
								echo "<h3>Password Update Sucessfully!!!</h3><br/>";
								}
							else
								$pwd1Err = $pwd2Err = "Passwords do not match.";
								$pwdcg = false;
							}
						else
							$pwd2Err = "Confirm new password is required.";
							$pwdcg = false;
						}
					else 
						$pwd1Err = "New password is required.";
						$pwdcg = false;
					}
				else{
					$pwdErr = "Please type in correct current password";
					$pwdcg = false;
					}
			}
		echo "<form method='post' action= '$action'>
			<fieldset>";
		echo "<legend>Update User Information</legend>
            <br/><p><span class='error'>*</span> Indicates a required field.</p>";
		echo "Email:  $cEM<br/>";
		echo "Customer ID: $cID &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp Current Subscription Plan";
		$fMenu="";     
  		$fValue="";  
		$i = 0;  
		$conn = $this->conn();
		$query=mysqli_query($conn, "select * from subscription_plan"); 
 		while($row=mysqli_fetch_array($query)){     
  			$fMenu[$i]=$row[1];     
  			$fValue[$i]=$row[0]; 
			$i++;
			}
 		echo "<select name='subscID'>";
         for ($i = 0; $i < count($fValue); $i++){ 
			 	if ($fValue[$i] == $sID){
					echo "<option selected value = '$fValue[$i]'>[$fMenu[$i]]</option>";
					}
				else{
					echo "<option value = '$fValue[$i]'>[$fMenu[$i]]</option>";
					}
				}
		echo "</select><br/>";
		echo "First Name";
		echo "<input name = 'cFname'  value = '$cFName' size = '6px'/><span class='error'>*  $fnameErr </span><br/>";
		echo "Last Name";
		echo "<input name = 'cLname'  value = '$cLName' size = '6px'/><span class='error'>*  $lnameErr </span><br/>";
		echo "Street<br/>";
		echo "<input name = 'cStreet'  value = '$cStreet'/><br/>";
		echo "City<br/>";
		echo "<input name = 'cCity'  value = '$cCity' size = '8 px'/><br/>";
		echo "State<br/>";
		echo "<input name = 'cState'  value = '$cState'  size = '2px'/><br/>";
		echo "Zip<br/>";
		echo "<input name = 'cZip'  value = '$cZip'size = '6px'/> <br/>";
		echo "Account Balance: $ $cbalance";
		echo "<br/><input type='submit' name='submit' value='Submit'>
    		<input type='reset' name='reset' value='Reset'></fieldset>";
		echo "
			<fieldset>
			<legend>Password Change</legend>
			<label for='pwd'>Current Password</label><br/>
			<input type='password' name='pwd' value=''><span class='error'>*  $pwdErr </span><br/>
			<label for='pwd1'>New Password</label><br/>
			<input type='password' name='pwd1' value=''><span class='error'>* $pwd1Err</span><br/>
			<label for='pwd2'>Confirm New Password</label><br/>
			<input type='password' name='pwd2' value=''><span class='error'>* $pwd2Err</span><br/>
			<input type='submit' name='submit1' value='Submit'><br/>
			</fieldset><br/></form>";
			} 
	}
?>
</html>
