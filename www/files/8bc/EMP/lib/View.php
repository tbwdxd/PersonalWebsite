<?php
class View {
   
    var $output; 

	function display() {  
     	echo($this->output);
	}
}
class Table1View extends View {
	function __construct($details){
		$newPDID=$newUnitCost=$newProductStatus=$newTradeID="";
		$i=1;
		foreach ($details as $value){
			$det[$i] = $value['Product_Title']." on ".$value['Platform'];
			$i++;
		}
		$this->output.= "
		Add New Inventory</h2><br/>
		<form method='post' action= '?action=add'>
		<fieldset>
		<table width= border=>
		<tr><td><p><strong>Product: </strong></td><td><select name = 'newPDID'>";
		for ($fValue =1; $fValue <= count($det);$fValue++){
							$fMenu = $det[$fValue];
							if ($fMenu != "")
								$this->output.="<option value = '$fValue'>[$fMenu]</option>";
						}
		$this->output.= "
		< value = '$newPDID'/></select></td></tr>
		<tr><td><p><strong>Unit Cost ($): </strong></td><td><input name = 'newUnitCost'  value = '$newUnitCost' size = '6px'/></td></tr>
		<tr><td><p><strong>Product_Status: </td><td><select name = 'newProductStatus'><option value = '0' size='14px'/> Instock </option><option value = '1' size='14px'> Rented </option><option value = '2' size='14px'> Sold </option></select></td></tr>
		<tr><td><p><strong>Trade ID: </strong></td><td><input name = 'newTradeID'  value = '$newTradeID' size = '6px'/></td></tr>
		 </table>
		 <input type='submit' name='submitnew' value='Create'><br/>
		 </fieldset>
		 </form>
		";
		}
	}

class Table2View extends View {
	function __construct(){
		$newPDT=$newPDD=$newPDP=$newRD=$newESRB=$newCD=$newPM="";
		$this->output.= "
		Add New Product</h2><br/>
		<form method='post' action= '?action=add_detail'>
		<fieldset>
		<table width= border=>
		<tr><td><p><strong>Product Title: </strong></td><td><input name = 'newPDT'  value = '$newPDT' size = '6px'/></td></tr>
		<tr><td><p><strong>Product Developer: </strong></td><td><input name = 'newPDD'  value = '$newPDD' size = '6px'/></td></tr>
		<tr><td><p><strong>Produc Publisher: </td><td><input name = 'newPDP'  value = '$newPDP' size = '6px'/></td></tr>
		<tr><td><p><strong>Release Date: </strong></td><td><input name = 'newRD'  value = '$newRD' size = '6px'/> Format: yyyy-mm-dd</td></tr>
		<tr><td><p><strong>ESRB Rating: </strong></td><td><input name = 'newESRB'  value = '$newESRB' size = '6px'/></td></tr>
		<tr><td><p><strong>Platform: </strong></td><td><input name = 'newPM'  value = '$newPM' size = '6px'/></td></tr>
		<tr><td><p><strong>Cover Directory: </strong></td><td><input type = 'file' name = 'newCD'  value = '$newCD' size = '6px'/></td></tr>
		 </table>
		 <input type='submit' name='submitnew' value='Create'><br/>
		 </fieldset>
		 </form>
		";
		}
	}	
	
class printView extends View {
	function printlist($default,$ID,$size){
		$this->output .="<select name = 'ProductStatus$ID'>";
		$option[0]="Instock";
		$option[1]="Rented";
		$option[2]="Sold";		
		for ($a = 0; $a<$size; $a++){
			$slt[$a] = "";
			if ($a == $default)
				$slt[$a] = "selected = selected";
			$this->output .="<option value = '$a' size='14px' $slt[$a]> $option[$a] </option>";
			}
		$this->output .="</select>";
		}
    function __construct($products,$details){
		$i = 1;
		$this->output.="Manage Inventory</h2><br/>";
		foreach ($details as $value){
			$det[$i] = $value['Product_Title']." by ".$value['Product_Publisher'];
			$i++;
			}
   		foreach ($products as $value){
			$this->output.="<form method='post' action= '".$_SERVER['PHP_SELF']."?action=update&id=".$value['P_ID']."'>";			
			$this->output.="<p><strong>Product ID: </strong>".$value['P_ID']."</p>".
						"<p><strong>Product: </strong><select name='PDID".$value['P_ID']."'>";
						for ($fValue =1; $fValue <= count($det);$fValue++){
							$fMenu = $det[$fValue];
							if ($fMenu != ""){
			 					if ($fValue == $value['P_D_ID']){
									$this->output.="<option selected value = '$fValue'>[$fMenu]</option>";
								}
								else{
									$this->output.="<option value = '$fValue'>[$fMenu]</option>";
								}
							}
						}
		$this->output.="</select><br/>".
                     "<p><strong>Unit Cost: </strong><input name = 'UC".$value['P_ID']."' value = ".$value['Unit_Cost']." size = '3px'/></p>".
                     "<p><strong>Product_Status: ";
			$this->printlist($value['Product_Status'],$value['P_ID'],3);
			$this->output.= "</p>".
					 "<p><strong>Trade ID:  </strong><input name = 'TID".$value['P_ID']."' value = ".$value['Trade_ID']." size = '3px'/></p>".
					 "<p align=\"right\"><input type='submit' name='submitnew' value= 'Update Product'>".
					 "</form>".
      				"<p align=\"right\"><a href=\"".$_SERVER['PHP_SELF']."?action=delete&id=".$value['P_ID']."\">Delete Product</a>".
                        "<hr />";
		 
		}
	}
}
class printdetailView extends View {
    function __construct($details){
		$this->output.= "Manage All Products</h2><br/>";
   		foreach ($details as $value){
			$this->output.= "<img src='http://localhost/8bc/EMP/images/".$value['Cover_dir']."' >"."<form method='post' action= '".$_SERVER['PHP_SELF']."?action=updatedetail&id=".$value['P_D_ID']."'>";			
			$this->output.="<p><strong>Product Detail ID: </strong>".$value['P_D_ID']."</p>".
                     "<p><strong>Product Title </strong><input name = 'PT".$value['P_D_ID']."' value = '".$value['Product_Title']."' /></p>".
					 "<p><strong>Product Developer </strong><input name = 'PD".$value['P_D_ID']."' value = '".$value['Product_Developer']."' /></p>".
					 "<p><strong>Product Publisher </strong><input name = 'PP".$value['P_D_ID']."' value = '".$value['Product_Publisher']."' /></p>".
					 "<p><strong>Release Date </strong><input name = 'RD".$value['P_D_ID']."' value = ".$value['Release_Date']." /></p>".
					 "<p><strong>ESRB Rating </strong><input name = 'RT".$value['P_D_ID']."' value = ".$value['ESRB_Rating']." /></p>".
					 "<p><strong>Platform </strong><input name = 'PM".$value['P_D_ID']."' value = ".$value['Platform']." /></p>".
					 "<p><strong>Cover Directory: </strong><input type= 'file' name = 'CD".$value['P_D_ID']."' value = '' /></p>".
					 "<p align=\"right\"><input type='submit' name='submitnew' value= 'Update Product'>".
					 "</form>".
      				"<p align=\"right\"><a href=\"".$_SERVER['PHP_SELF']."?action=delete&id=".$value['P_D_ID']."\">Delete Product</a>".
                        "<hr />";
		 
		}
	}
}

class addView extends View  {
    function __construct($success){
		$this->output.= "Add New Inventory</h2><br/>";
   		if ($success)
    		$this->output.="Add New Inventory Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=table1\">Add More Prodcuts</a><meta http-equiv='Refresh' content='1;url=index.php?action=table1'>";
    	else
    		$this->output.="Add New Inventory Failed!";
	}
}
class add_detailView extends View  {
    function __construct($success){
		$this->output.= "Add New Product</h2><br/>";
   		if ($success)
    		$this->output.="Add New Product Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=print\">View All Prodcuts</a>";
    	else
    		$this->output.="Add New Product Failed!";
	}
}

class updateView extends View {
	function __construct($success){
		$this->output.="Manage Inventory</h2><br/>";
		if ($success)
    		$this->output.="Update Product Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=print\">View All Prodcuts</a>";
    	else
    		$this->output.="Update Product Failed!";
		}
	}
class updateDetailView extends View {
	function __construct($success){
		$this->output.="Manage Product</h2><br/>";
		if ($success)
    		$this->output.="Update Product Detail Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=printdetail\">View All Prodcut Details</a>";
    	else
    		$this->output.="Update Product Detail Failed!";
		}
	}
class deleteView extends View{
    function __construct($success){
		$this->output.="Manage Inventory</h2><br/>";
    	if ($success)
    		$this->output.="Delete Product Successfully !<br><a href=\"".$_SERVER['PHP_SELF']."?action=print\">View All Prodcuts</a>";
	}
}
class submanagementView extends View{
	 function __construct($sub){
		$this->output.="Subscription Plans</h2><br/><fieldset>".
		 "<input disabled='disabled' value = 'SubID' size = '3px' /><input disabled='disabled' value = 'Description' size = '25px' /><input disabled='disabled' value = 'Rate' size = '6px' /><input disabled='disabled' value = 'Visibility' size = '6px' /><br/>";
    	foreach ($sub as $value){
			$this->output.= "<form method='post' action= '?action=updatesub'>".
				"<input name = fid readonly='readonly' value = ".$value['Subscription_ID']." size = '3px' />".
				"<input name = fMenu value = '".$value['Description']."' size='25px' />".
				"<input name =fRate value = ".$value['Rate']." size='6px' />".
				"<select name= vb >";
				if ($value['Visibility'] == 1){
							$this->output.="<option value = 1 selected = 'true'>Visible</option>
									<option value = 0>Invisible</option>";
							}
						else{
							$this->output.="<option value = 1>Visible</option>
									<option value = 0 selected = 'true'>Invisible</option>";
							}
			$this->output.="<input type='submit' name='".$value['Subscription_ID']."' value='Update'><br/>".
			"</form>";
			}
			$this->output.="<a href=\"".$_SERVER['PHP_SELF']."?action=addsub\">Add New</a>".																																									
			"</fieldset><br/>";
	}
}
class updatesubView extends View{
		function __construct($success){
			$this->output.="Manage Inventory</h2><br/>";
			if ($success)
    		$this->output.="Update Subscription Plan Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=submanagement\">View Subscription Plans</a>";
			else
    		$this->output.="Update Subscription Plan Failed!";
		}
	}
class addempView extends View{
		function __construct($error){
		$fname = @$_POST['fname'];
		$lname = @$_POST['lname'];
		$email = @$_POST['email'];
		$pwd = "";
		$pwd1 = "";
		$street = @$_POST['street'];
		$city =@$_POST['city'];
		$state = @$_POST['state'];
		$zip = @$_POST['zip'];
		$status = @$_POST['status'];
		$date=date("Y-m-d");
		if (@$_POST['hiredate'])
			$hiredate = @$_POST['hiredate'];
		else 
			$hiredate = $date;
		$leavedate = @$_POST['leavedate'];
		$payrate = @$_POST['payrate'];
		$fnameErr=@$error['fnameErr'];
		$lnameErr = @$error['lnameErr'];
		$emailErr = @$error['emailErr'];
		$pwdErr = @$error['pwdErr'];
		$pwd1Err = @$error['pwd1Err'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		$this->output.=
		"Regist New Employee </h2><br/>
		<p><span class='error'>*</span> Indicates a required field.</p>	".$headErr.	"
 			<form method='post' action= '?action=registemp'>
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
	}
class registedempView extends View{
		function __construct(){
			$this->output.=
		"Regist New Employee </h2><br/>";
			$this->output.="Registed Employee Successfully!<br><a href=\"..\?action=account_detail\">View Employee Information</a>";
		}
}
class searchacctView extends View{
	function __construct($error){
		$this->output.=	"Search Accounts</h2><br/>";
		if(!empty($error['HeadErr'])){
			$error="<p><span class='error'>*</span> ".$error['HeadErr']."</p>";
			}
				$uEmail=@$_POST['uEmail'];
		$eEmail=@$_POST['eEmail'];
		$this->output.="$error<br/>".
		"<form method='post' action= '../?action=searchuser'>
		<label for='uEmail'>Search User Account by Email</label><br/>
			<input type='text' name='uEmail' value= '$uEmail'>
			<input type='submit' name='submit' value='Search'>
		</form><br/>
		<form method='post' action= '../?action=searchemp'>
		<label for='eEmail'>Search Employee Account by Email</label><br/>
			<input type='text' name='eEmail' value= '$eEmail'>
			<input type='submit' name='submit' value='Search'>
		</form>"
		;
		}
	}
class searchrentView extends View{
	function __construct($error){
		$this->output.=	"Search Rental Queue</h2><br/>";
		if(!empty($error['HeadErr'])){
			$error="<p><span class='error'>*</span> ".$error['HeadErr']."</p>";
			}
		$uEmail=@$_POST['uEmail'];
		$eEmail=@$_POST['eEmail'];
		$this->output.="$error<br/>".
		"<form method='post' action= '../?action=searchrent'>
		<label for='uEmail'>Search User Rental Queue by Email</label><br/>
			<input type='text' name='uEmail' value= '$uEmail'>
			<input type='submit' name='submit' value='Search'>
		</form><br/>"
		;
		}
	}
class EMPView extends View{
    function __construct($user){
		foreach ($user as $value){
			$this->output.=	"Personal Info</h2><br/>";
			$name =$value['Employee_Fname']." ". $value['Employee_Lname'] ;
      		$this->output.="<p><strong>Welcome back, </strong>".$name."</p>".
					"<p><strong>Employee #: </strong>".$value['Employee_ID'].
                   	 "<p><strong>Email:</strong>".$value['Emp_Email']."</p>".
                    	"<hr />".   
						"<p align=\"right\"><a href= \"..\?action=passwordmanagement\">Change Password</a>".
						"<p align=\"right\"><a href= \"..\?action=account_management\">Update Employee Information</a>";
                    	"<hr />"; 
		}
	}
}
class tradelistView extends View{
    function __construct($trades){
		$this->output.=	"Trade in Management</h2><br/>";
		if (empty ($trades)){
			$this->output .="There is no open trades need approve.";
			}
		foreach ($trades as $value){
			$TP = @$_POST['TP'];
			$eid = $_SESSION['EID'];
			if ($value['Trade_Status']==0){
				$status = "Approving";
			}
			else if ($value['Trade_Status']==1){
				$status = "Approved";
			}
			else {
				$status = "Declined";
			}
      		$this->output.="<form method='post' action= '?action=updatetrade&id=".$value['Trade_ID']."'>
			<strong># </strong>".$value['Trade_ID']."</br>".
			"<strong>Customer ID: </strong>".$value['Customer_ID']."</br>". 
			"<strong>Trade Date: </strong>".$value['Trade_Date']."</br>". 
			"<strong>Trade Price: </strong><input type='text' name='TP' value= '$TP' size =3px></br>".
			"<strong>Product Detail ID: </strong><input type='text' name='PDID' readonly=readonly value= '".$value['P_D_ID']."' size =3px></br>".
			"<strong>Employee ID: </strong>$eid</br>".
			"<strong>Trade Status: </strong>$status</br>";	
			$this->output .="</select><p align=\"right\"><input type='submit' name='submit' value='Approve'>".
			"<p align=\"right\"><a href=\"".$_SERVER['PHP_SELF']."?action=denytrade&id=".$value['Trade_ID']."\">Deny</a><hr/>";
			
		}
	}
}
class updatetradeView extends View{
    function __construct($success){
		$this->output.=	"Trade in Management</h2><br/>";
		if ($success)
    		$this->output.="Update Trade Info Successfuly!<br><a href=\"".$_SERVER['PHP_SELF']."?action=tradelist\">View Trade List</a><meta http-equiv='Refresh' content='3;url=index.php?action=tradelist'>";
			else
    		$this->output.="Update Trade Info Failed!";
	}
}
class denytradeView extends View{
    function __construct($success){
		$this->output.=	"Trade in Management</h2><br/>";
    	$this->output.="Trade Request Denied!<br><a href=\"".$_SERVER['PHP_SELF']."?action=tradelist\">View Trade List</a><meta http-equiv='Refresh' content='3;url=index.php?action=tradelist'>";
	}
}
class tradeView extends View{
    function __construct($trades){
		$this->output.=	"Trade in List</h2><br/>";
		if (empty ($trades)){
			$this->output .="There is no open trades need approve.";
			}
		foreach ($trades as $value){
			$TP = $value['Trade_Price'];
			$eid = $value['Employee_ID'];
			if ($value['Trade_Status']==0){
				$status = "Approving";
			}
			else if ($value['Trade_Status']==1){
				$status = "Approved";
			}
			else {
				$status = "Declined";
			}
      		$this->output.="
			<strong># </strong>".$value['Trade_ID']."</br>".
			"<strong>Customer ID: </strong>".$value['Customer_ID']."</br>". 
			"<strong>Trade Date: </strong>".$value['Trade_Date']."</br>". 
			"<strong>Trade Price: </strong>".$TP."</br>".
			"<strong>Product Detail ID: </strong>".$value['P_D_ID']."</br>".
			"<strong>Employee ID: </strong>$eid</br>".
			"<strong>Trade Status: </strong>$status</br><hr/>";		
		}
	}
}
class panelView extends View{
    function __construct(){
    	$this->output.="
	Inventory Management</h2><br/>
    <li><a href='?action=table1'>Add New Inventory</a><br></li>
    <li><a href='?action=table2'>Add New Product </a><br></li>
    <li><a href='?action=print'>Manage Inventory</a><br></li>
    <li><a href='?action=printdetail'>Manage Product</a></li><br><hr />
    <h2>
	<img src='images/mascot.png' width='32' style='display:inline-block; padding-right: 10px;' />
	Account Management</h2><br/>
    <li><a href='?action=submanagement'>Manage Subcription Plans</a><br></li>
    <li><a href='?action=modifyacct'>Modify Accounts</a></li><br><hr />
    <h2><img src='images/mascot.png' width='32' style='display:inline-block; padding-right: 10px;' />
	Management Tools</h2><br/>
    <li><a href='?action=addemp'>Add New Employee</a><br></li>
	<li><a href='?action=rentalcontrol'>Rental & Return Control</a></li>
    <li><a href='?action=tradelist'>View Trade-ins</a><br></li>
    <li><a href='?action=tradeinmanagement'>Approve Trade-ins</a></li><br>
    <hr /> 
	<h2>
	<img src='images/mascot.png' width='32' style='display:inline-block; padding-right: 10px;' />
	Personal Tools</h2><br/>
	<li><a href='?action=default'>Account Info</a><br></li>
    <li><a href='../?action=passwordmanagement'>Change Passsword</a><br></li>
    <li><a href='../?action=account_management'>Update Account Info</a></li><br>
    <hr />";
	}
}
?>