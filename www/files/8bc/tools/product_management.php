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
	<h3>Product Management</h3>
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
	$class1 = new product_info;
	$class1->print_out($class1->dbTable);
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
abstract class manage_Product{
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
class product_info extends manage_Product{
	var $dbTable = "products";
	var $ID = "P_ID";
	
	protected function get_info($query){
		$i=0;
		while($row=mysqli_fetch_array($query)){     
  				$PID[$i]=$row[0];
				$PDID[$i]=$row[1];
				$UnitCost[$i]=$row[2];
				$ProductStatus[$i]=$row[3];
				$TradeID[$i]=$row[4];
				$i++;
				}
		echo "<h1 >Product Management</h1>
            <br/>";
			if (isset($_POST["submitnew"])){
				$newPDID = $_POST["newPDID"];
				$newUnitCost = $_POST["newUnitCost"];
				$newTradeID = $_POST["newTradeID"];
				$newProductStatus = $_POST["newProductStatus"];
				$conn = mysqli_connect("localhost","root","CS362") or die("Could not connect to MySQL.");
				mysqli_select_db($conn,"8BDB") or die("Database not found.");
				$query = mysqli_query($conn,"INSERT INTO products VALUES ('','$newPDID','$newUnitCost','$newProductStatus','$newTradeID')");
				if ($query == FALSE){
					echo "<h1>Add New Prodcut Failed</h1>";
				}
				else{
					echo "<h1>Add New Prodcut Successful!</h1>";
				}
			}
			for ($j = 0; $j < count($PID); $j++ ){
				$submitv = "submit$j";
				$pID = $PID[$j];
				if (isset($_POST[$submitv])){
					$PDID[$j] = $_POST["PDID$j"];
					$UnitCost[$j] = $_POST["UnitCost$j"];
					$ProductStatus[$j] = $_POST["ProductStatus$j"];
					$TradeID[$j] = $_POST["TradeID$j"];
					$this->update($this->dbTable,$this->ID,'P_D_ID',$PDID[$j],$pID);
					$this->update($this->dbTable,$this->ID,'Unit_Cost',$UnitCost[$j],$pID);
					$this->update($this->dbTable,$this->ID,'Product_Status',$ProductStatus[$j],$pID);
					$this->update($this->dbTable,$this->ID,'Trade_ID',$TradeID[$j],$pID);			
					}
				}
			
			$action= htmlspecialchars($_SERVER["PHP_SELF"]);
			echo "<form method='post' action= '$action'>";
			echo "<fieldset>";
			echo "<input disabled='disabled'  value = 'PID'  size = '2px'/>";
			echo "<input disabled='disabled'  value = 'DID' size = '4px'/>";
			echo "<input disabled='disabled'  value = 'Unit Cost'/>";
			echo "<input disabled='disabled'  value = 'Product Status' size = '10px'/>";
			echo "<input disabled='disabled'  value = 'Trade ID' size = '6px'/>";
			echo "<br/>";		
			echo "<br/>";
		    
		for ($i = 0; $i < count($PID); $i++){
				echo "<input disabled='disabled' value = '$PID[$i]' size = '2px'/>";
				echo "<input name = 'PDID$i'  value = '$PDID[$i]' size = '4px'/>";
				echo "<input name = 'UnitCost$i'  value = '$UnitCost[$i]'/>";
				$PSvalue = $ProductStatus[$i];
				
				for ($a = 0; $a<count($ProductStatus);$a++){
					if ($PSvalue == $a)
						$slt[$a]= "selected = selected";
					else
						$slt[$a]="";
				}
				echo "<select name = 'ProductStatus$i'>";
				echo "<option value = '0' size='14px' $slt[0]> Instock </option>
				<option value = '1' size='14px' $slt[1]> Rented </option>
				<option value = '2' size='14px' $slt[2]> Sold </option>
				</select>";
				echo "<input name = 'TradeID$i'  value = '$TradeID[$i]' size = '6px'/>";
				echo "<input type='submit' name='submit$i' value='Submit'><br/>";
				}
		$newPDID=$newUnitCost=$newProductStatus=$newTradeID="";
		echo "<input disabled='disabled' value = 'New' size = '2px'/>";
		echo "<input name = 'newPDID'  value = '$newPDID' size = '4px'/>";
		echo "<input name = 'newUnitCost'  value = '$newUnitCost'/>";
		echo "<select name = 'newProductStatus'>
		<option value = '0' size='14px'> Instock </option><option value = '1' size='14px'> Rented </option><option value = '2' size='14px'> Sold </option></select>";
		echo "<input name = 'newTradeID'  value = '$newTradeID' size = '6px'/>";
		echo "<input type='submit' name='submitnew' value='Create'><br/>";
		} 
	}
?>
</html>
