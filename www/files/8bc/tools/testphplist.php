<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>8-bit crusader</title>
<link href="default.css" rel="stylesheet" type="text/css" />

</head>
<body>
<center><img src="images/building.jpg"></center>
<div id="content">
	<h3>Account Registration</h3>
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
            <select name="subsc_ID">
            <?php
			for ($i = 0; $i < count($fValue); $i++){
				echo "<option value = '$fValue[$i]'>$fMenu[$i]</option>";
				}
			?>
            </select>
 		
</div>
<div id="footer">
<p>Copyright &copy; 2014 8-bit Crusader.</p>
</div>
</body>
</html>
