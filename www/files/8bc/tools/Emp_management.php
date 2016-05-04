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
	<h3>Data Base Management</h3>
	<p>
    <?php 
	session_start();
	
	if(!$_SESSION['Email']) {
		header("Location: index.php");
		die();
	}
	if($_SESSION['is_employee'] != 1) {
		header("Location: account_management.php");
		die();
	}
	$class1 = new user_info;
	$class2 = new subscript_info;
	$class1->print_out($class1->dbTable);
	$class2->print_out($class2->dbTable);
    ?>
	</p>
</div>
<div id="footer">
<p>Copyright &copy; 2014 8-bit Crusader.</p>
<form id="form1" method="post" action="">
  <p>
    <label for="aaa"></label>
  </p>
</form>
</div>
</body>
<?php 
abstract class manage_DB{
	public function conn(){
		$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
		mysqli_select_db($conn,"8BDB") or die("Database not found.");
		return $conn;
		}
	public function print_out($dbTable){
		$conn = $this->conn();
		mysqli_select_db($conn,"8BDB") or die("Database not found.");
		$query=mysqli_query($conn, "select * from $dbTable"); 
		$this->get_info($query);
	}
	public function update($dbTable,$ID,$row,$input,$sid){
		$conn = $this->conn();
		$query = mysqli_query($conn,"UPDATE $dbTable SET $row='$input' WHERE $ID='$sid'") or die("Update Failed");
		}
	abstract protected function get_info($query);
	}
class user_info extends manage_DB{
	var $dbTable = "customer_account";
	var $ID = "Customer_ID";
	
	protected function get_info($query){
		$i=0;
		while($row=mysqli_fetch_array($query)){     
  				$cID[$i]=$row[0];
				$sID[$i]=$row[1];
				$cEM[$i]=$row[2];
				$cPwd[$i]=$row[3];
				$cFName[$i]=$row[4];
				$cLName[$i]=$row[5];
				$cStreet[$i]=$row[6];
				$cCity[$i]=$row[7];
				$cState[$i]=$row[8];
				$cZip[$i]=$row[9];
				$cbalance[$i]=$row[10];
				$i++;
				}
		echo "<h1 >Customer Accounts Management</h1>
            <br/>";
			for ($j = 0; $j < count($cID); $j++ ){
				$submitv = "submit$j";
				$CID = $cID[$j];
				if (isset($_POST[$submitv])){
					$sID[$j] = $_POST["sID$j"];
					$cEM[$j] = $_POST["cEM$j"];
					$cPwd[$j] =  hash("sha512", $_POST["cPwd$j"]);
					$cFName[$j] = $_POST["cFname$j"];
					$cLName[$j] = $_POST["cLname$j"];
					$cStreet[$j] = $_POST["cStreet$j"];
					$cState[$j] = $_POST["cState$j"];
					$cbalance[$j] = $_POST["ccbalance$j"];
					$cZip[$j] = $_POST["cZip$j"];
					$this->update($this->dbTable,$this->ID,'Subscription_ID',$sID[$j],$CID);
					$this->update($this->dbTable,$this->ID,'Email',$cEM[$j],$CID);
					$this->update($this->dbTable,$this->ID,'Password',$cPwd[$j],$CID);
				    $this->update($this->dbTable,$this->ID,'First_Name',$cFName[$j],$CID);
					$this->update($this->dbTable,$this->ID,'Last_Name',$cLName[$j],$CID);
					$this->update($this->dbTable,$this->ID,'Street',$cStreet[$j],$CID);
					$this->update($this->dbTable,$this->ID,'City',$cCity[$j],$CID);
					$this->update($this->dbTable,$this->ID,'State',$cState[$j],$CID);
					$this->update($this->dbTable,$this->ID,'Zip',$cZip[$j],$CID);
					$this->update($this->dbTable,$this->ID,'Total_Balance',$cbalance[$j],$CID);				
					}
				}
			
			$action= htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "<form method='post' action= '$action'>";
			echo "<fieldset>";
			echo "<input disabled='disabled' value = 'ID'  size = '2px'/>";
			echo "<input disabled='disabled'  value = 'Sub ID' size = '4px'/>";
			echo "<input disabled='disabled'  value = 'Email Address'/>";
			echo "<input disabled='disabled'  value = 'Password'/>";
			echo "<input disabled='disabled'  value = 'First Name' size = '6px'/>";
			echo "<input disabled='disabled'  value = 'Last Name' size = '6px'/>";
			echo "<input disabled='disabled'  value = 'Street'/>";
			echo "<input disabled='disabled'  value = 'City' size = '8 px'/>";
			echo "<input disabled='disabled'  value = 'State'  size = '2px'/><input disabled='disabled'  value = 'Zip Code' size = '6px'/>
			<input disabled='disabled'  value = 'Balance' size = '4px'/>";
			echo "<br/>";		
			echo "<br/>";
		    
		for ($i = 0; $i < count($cID); $i++){
				echo "<input disabled='disabled' value = '$cID[$i]' size = '2px'/>";
				echo "<input name = 'sID$i'  value = '$sID[$i]' size = '4px'/>";
				echo "<input name = 'cEM$i'  value = '$cEM[$i]'/>";
				echo "<input name = 'cPwd$i'  value = '$cPwd[$i]' type='password'/>";
				echo "<input name = 'cFname$i'  value = '$cFName[$i]' size = '6px'/>";
				echo "<input name = 'cLname$i'  value = '$cLName[$i]' size = '6px'/>";
				echo "<input name = 'cStreet$i'  value = '$cStreet[$i]'/>";
				echo "<input name = 'cCity$i'  value = '$cCity[$i]' size = '8 px'/>";
				echo "<input name = 'cState$i'  value = '$cState[$i]'  size = '2px'/>";
				echo "<input name = 'cZip$i'  value = '$cZip[$i]'size = '6px'/> ";
				echo "<input name = 'ccbalance$i' value = '$cbalance[$i]' size = '4px'/>";
				echo "<input type='submit' name='submit$i' value='Submit'><br/>";
				}
		} 
	}
class subscript_info extends manage_DB{
	var $dbTable = "subscription_plan";
	var $ID = "Subscription_ID";
	protected function get_info($query){
		if (isset($_POST["adds"])){
				$conn = $this->conn();
				$query = mysqli_query($conn,"INSERT INTO subscription_plan VALUES ('','new subscription','1.1')") or die("New Failed");
				}
		$i=0;
		while($row=mysqli_fetch_array($query)){     
  				$fMenu[$i]=$row[1];     
  				$fValue[$i]=$row[0]; 
				$fRate[$i]=$row[2];
				$vb[$i]=$row[3];
				$i++;
				}
		for ($j = 0; $j < count($fMenu); $j++ ){
				$submitv = "submitsub$j";
				$SID = $fValue[$j];
				if (isset($_POST[$submitv])){
					$fMenu[$j] = $_POST["fMenu$j"];
					$fRate[$j] = $_POST["fRate$j"];
					//$vb[$j] = $_POST["vb$j"];
					$ab = $_POST["vb"];
					if (count($ab)>$j and $ab[$j] == $j)
						$ab[$j] = 1;
					else
						$ab[$j] =0;
					$vb[$j]=$ab[$j];
					$this->update($this->dbTable,$this->ID,'Description',$fMenu[$j],$SID);
					$this->update($this->dbTable,$this->ID,'Rate',$fRate[$j],$SID);	
					$this->update($this->dbTable,$this->ID,'Visibility',$vb[$j],$SID);			
					}
				}
		echo "<h1 >Subscription Plans</h1><br/>";
		$action= htmlspecialchars($_SERVER["PHP_SELF"]);
		echo "<form method='post' action= '$action'><fieldset>";
		echo "<input disabled='disabled' value = 'SubID' size = '3px' /><input disabled='disabled' value = 'Description' size = '25px' /><input disabled='disabled' value = 'Rate' size = '6px' /><input disabled='disabled' value = 'Visibility' size = '6px' /><br/>";
		for ($i = 0; $i < count($fValue); $i++){
				echo "<input disabled='disabled' value = '$fValue[$i]' size = '3px' />";
				echo "<input name = 'fMenu$i' value = '$fMenu[$i]' size='25px' />";
				echo "<input name = 'fRate$i' value = '$fRate[$i]'size='6px' />";
				/*echo "<select name='vb$i'>";
						if ($vb[$i] == 1){
							echo "<option value = 1 selected = 'true'>Visible</option>
									<option value = 0>Invisible</option>";
							}
						else{
							echo "<option value = 1>Visible</option>
									<option value = 0 selected = 'true'>Invisible</option>";
							}*/
				if ($vb[$i] == 1)
					echo "<input name = 'vb[]' id = 'vb' type='checkbox' value='$i' checked='checked'/>True ";
				else
					echo "<input name = 'vb[]' id = 'vb' type='checkbox' value='$i'/>False";
				echo "<input type='submit' name='submitsub$i' value='Submit'><br/>";
				}
		echo "<input type='submit' name='adds' value='Add New'><br/>";																																									
		echo "</fieldset><br/>";
		echo "Click <a href='register.php'>Here</a> to create new employee";
		}
	}
?>
</html>
