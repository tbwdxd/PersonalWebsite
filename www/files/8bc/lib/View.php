<?php
class View {
   
    var $output; 

	function display() {  
     	echo($this->output);
	}
}
class emptyView extends View{
	function __construct(){
		$this->output.= "";
		}
	}
class indexView extends View {
	function __construct($error){
		$_SESSION['is_employee'] = 0;
		if(!empty($error['HeadErr'])){
			$error="<p><span class='error'>*</span> ".$error['HeadErr']."</p>";
			}
		$this->output.= "
		Log in</h2><br/>
		<p>Login to get more access. <span class='error'>*</span> Indicates a required field.
		$error
		<center>
		<table width=50% border=1>
 		<form action=?action=sign_in method=post>
  		<tr>
   		<td>
   		<hr>
   		<p align=center>Please Enter Your Email:</p>
   		<p align=center><input type=text name=Email><span class='error'>*</span><br/></p>
   		<p align=center>Please Enter Your Password:</p>
   		<p align=center><input type=password name=Password><span class='error'>*</span></p>
   		<div align=center>
    	<input type=submit value='Sign In'>
    	<input type=reset value=clear>
   		</div>
    	</td>
  		</tr>
 		<p>Don't have an account? <a href='register.php'>Register</a> to start your 8BC Life!</p>
 		</form>
 		</table>
		</center>
		";
		}
	}
class logoutView extends View{
    function __construct(){
		$this->output.="Log out</h2><br/>";
		$this->output.="Log out successfully, Will Move To <a href= \"?action=account_detail\">Home Page</a> in 3 seconds".
		"<meta http-equiv='Refresh' content='1;url=index.php'>";
	}
}
class accountView extends View{
    function __construct($user,$subscription){
		$this->output.="Account Detail</h2><br/>";
		$i = 1;
		foreach ($subscription as $value){
			if($value['Visibility'] == 1)
				$sub[$i] = $value['Description']." for $".$value['Rate'];
			else
				$sub[$i] = "";
			$i++;
			}
		foreach ($user as $value) {
      	$this->output.="<p><strong>Customer ID: </strong>".$value['Customer_ID']."</p>".
                     	"<p><strong>Email: </strong>".$value['Email']."</p>".
                    	"<p><strong>Name: </strong>".$value['First_Name']." ".$value['Last_Name']."</p>".
						"<p><strong>Subscription Plan: </strong>".$sub[$value['Subscription_ID']].
						"<p><strong>Address: </strong>".
						"<p>".$value['Street'].
						"<p>".$value['City'].
						"<p>".$value['State'].
						"<p>".$value['Zip'].
						"<p><strong>Account Balance: </strong>".$value['Total_Balance'].
						"<p align=\"right\"><a href= \"?action=account_management\">Update Account Info</a>".
						"<p align=\"right\"><a href= \"?action=passwordmanagement\">Change Password</a>".
						"<hr />";    
   		}   
	}
}
class accmanagementView extends View{
	function __construct($user,$subscription,$error){
		$this->output.="Manage Account</h2><br/>";
		if($user == "")
			$this->output.="There is no result. <meta http-equiv='Refresh' content='3;url=EMP\index.php?action=modifyacct'>";
		else{
		$i = 1;
		foreach ($subscription as $value){
			if($value['Visibility'] == 1)
				$sub[$i] = $value['Description']." for $".$value['Rate'];
			else
				$sub[$i] = "";
			$i++;
			}
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$pwdErr=@$error['pwdErr'];
		$pwd1Err=@$error['pwd1Err'];
		$pwd2Err=@$error['pwd2Err'];	
		foreach ($user as $value) {
				$cID=$value['Customer_ID'];
				$sID=$value['Subscription_ID'];
				$cEM=$value['Email'];
				$cPwd=$value['Password'];
				$cFName=$value['First_Name'];
				$cLName=$value['Last_Name'];
				$cStreet=$value['Street'];
				$cCity=$value['City'];
				$cState=$value['State'];
				$cZip=$value['Zip'];
				$cbalance=$value['Total_Balance'];
      	$this->output.="<form method='post' action= '?action=updateacct'><fieldset>".
                     	"<legend>Update User Information</legend><br/><p><span class='error'>*</span> Indicates a required field.</p>".
                    	"Email <input name = 'cEM'  readonly= 'readonly' value = '$cEM' /><br/>"."Customer ID".
						"<input name = 'cID'  readonly= 'readonly' value = '$cID'  size = '2px'/>"."Current Subscription Plan".
						"<select name='subscID'>";
						for ($fValue =1; $fValue <= count($sub);$fValue++){
							$fMenu = $sub[$fValue];
							if ($fMenu != ""){
			 					if ($fValue == $sID){
									$this->output.="<option selected value = '$fValue'>[$fMenu]</option>";
								}
								else{
									$this->output.="<option value = '$fValue'>[$fMenu]</option>";
								}
							}
						}
		$this->output.="</select><br/>".
						"First Name".
						"<input name = 'cFname'  value = '$cFName' size = '6px'/><span class='error'>*  $fnameErr </span><br/>".
						"Last Name".
						"<input name = 'cLname'  value = '$cLName' size = '6px'/><span class='error'>*  $lnameErr </span><br/>".
						"Street<br/>".
						"<input name = 'cStreet'  value = '$cStreet'/><br/>".
						"City<br/>".
						"<input name = 'cCity'  value = '$cCity' size = '8 px'/><br/>".
						"State<br/>".
						"<input name = 'cState'  value = '$cState'  size = '2px'/><br/>".
						"Zip<br/>".
						"<input name = 'cZip'  value = '$cZip'size = '6px'/> <br/>".
						"Account Balance<br/>".
						"$ <input name = 'cBL'  readonly= 'readonly' value = '$cbalance' size = '6px'/><br/>".
						"<br/><input type='submit' name='submit' value='Update'></fieldset></form>";
		if($_SESSION['is_employee']==0){
			$this->output.=	"<p align=\"right\"><a href= \"?action=account_detail\">View Personal Information</a>".
						"<p align=\"right\"><a href= \"?action=passwordmanagement\">Change Password</a>";  
				}
			}
   		}  
	}
}
class EMPaccmanagementView extends View{
	function __construct($user,$error){
		$this->output.="Update Info</h2><br/>";
		if($user == "")
			$this->output.="Thege is no result. <meta http-equiv='Refresh' content='3;url=EMP\index.php?action=modifyacct'>";
		else{
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$pwdErr=@$error['pwdErr'];
		$pwd1Err=@$error['pwd1Err'];
		$pwd2Err=@$error['pwd2Err'];	
		foreach ($user as $value) {
				$cID=$value['Employee_ID'];
				$cFName=$value['Employee_Fname'];
				$cLName=$value['Employee_Lname'];
				$cStreet=$value['Emp_Street'];
				$cCity=$value['Emp_City'];
				$cState=$value['Emp_State'];
				$cZip=$value['Emp_Zip'];
				$cEM=$value['Emp_Email'];
				$cStatus=$value['Emp_Status'];
				$cHdate=$value['Hire_Date'];
				$cLdate=$value['Leave_Date'];
				$cRate=$value['Pay_Rate'];
      	$this->output.="<form method='post' action= '?action=updateacct&isEmp=1'><fieldset>".
                     	"<legend>Update Employee Information</legend><br/><p><span class='error'>*</span> Indicates a required field.</p>".
                    	"Email <input name = 'cEM'  readonly= 'readonly' value = '$cEM' /><br/>".
						"Employee ID".
						"<input name = 'cID'  readonly= 'readonly' value = '$cID'  size = '2px'/><br/>".
						"First Name".
						"<input name = 'cFname'  value = '$cFName' size = '6px'/><span class='error'>*  $fnameErr </span><br/>".
						"Last Name".
						"<input name = 'cLname'  value = '$cLName' size = '6px'/><span class='error'>*  $lnameErr </span><br/>".
						"Street<br/>".
						"<input name = 'cStreet'  value = '$cStreet'/><br/>".
						"City<br/>".
						"<input name = 'cCity'  value = '$cCity' size = '8 px'/><br/>".
						"State<br/>".
						"<input name = 'cState'  value = '$cState'  size = '2px'/><br/>".
						"Zip<br/>".
						"<input name = 'cZip'  value = '$cZip'size = '6px'/> <br/>".
						"<legend>Emplyee Information</legend>
						<label for='status'>Status</label><br/>
						<input type='text' name='cStatus' value='$cStatus'><br/>
						<label for='hiredate'>Hire Date</label><br/>
						<input type='text' name='cHdate' value='$cHdate'><span class='error'>* Format: yyyy-mm-dd</span><br/>
						<label for='leavedate'>Leave Date</label><br/>
						<input type='text' name='cLdate' value='$cLdate'><span class='error'>* Format: yyyy-mm-dd</span><br/>".
						"<label for='Pay Rate'>Pay Rate</label><br/>".
						"$ <input name = 'cRT'  readonly= 'readonly' value = '$cRate' size = '6px'/><br/>".
						"<br/><input type='submit' name='submit' value='Update'></fieldset></form>".
						"<p align=\"right\"><a href= \"?action=account_detail\">View Personal Information</a>".
						"<p align=\"right\"><a href= \"?action=passwordmanagement\">Change Password</a>";
		}
   		}  
	}
}
class updateView extends View{
	function __construct(){
		$this->output.="Update Info</h2><br/>";
		$this->output.="Update User Information Successfully!<br>
		<meta http-equiv='Refresh' content='1;url=index.php?action=account_detail'>";
	}
}
class passwordView extends View{
	function __construct($error){
		if(@$_SESSION['EID']){
			$cID = $_SESSION['EID'];$label="Employee ID: ";}
		else{
			$cID = $_SESSION['CID'];$label="Customer ID: ";}
		$this->output.="Change Password</h2><br/>";
		$pwd = "";
		$pwdErr= @$error['pwdErr'];
		$pwd1 = "";
		$pwd1Err= @$error['pwd1Err'];
		$pwd2 = "";
		$pwd2Err= @$error['pwd2Err'];
		$this->output.="<form method='post' action= '?action=updatepass'><fieldset>
			<legend>Password Change</legend>
			$label<input name = 'cID'  readonly= 'readonly' value = '$cID'  size = '2px'/><br/>
			<label for='pwd'>Current Password</label><br/>
			<input type='password' name='pwd' value=''><span class='error'>*  $pwdErr </span><br/>
			<label for='pwd1'>New Password</label><br/>
			<input type='password' name='pwd1' value=''><span class='error'>* $pwd1Err</span><br/>
			<label for='pwd2'>Confirm New Password</label><br/>
			<input type='password' name='pwd2' value=''><span class='error'>* $pwd2Err</span><br/>
			<input type='submit' name='submit1' value='Submit'><br/>
			</fieldset><br/></form>".
			"<p align=\"right\"><a href= \"?action=account_detail\">View Personal Information</a>".
			"<p align=\"right\"><a href= \"?action=account_management\">Update Account Information</a>";
	}
}
class updatepassView extends View{
	function __construct(){
		$this->output.="Change Password</h2><br/>";
		$this->output.="Change Password Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=account_detail\">View Personal Information</a><meta http-equiv='Refresh' content='1;url=index.php?action=account_detail'>";
	}
}
class registerView extends View{
	function __construct($error,$subscription){
		$i = 1;
		foreach ($subscription as $value){
			if($value['Visibility'] == 1)
				$sub[$i] = $value['Description']." for $".$value['Rate'];
			else
				$sub[$i] = "";
			$i++;
			}
		$fname =@$_POST['fname'];
		$lname = @$_POST['lname'];
		$email = @$_POST['email'];
		$pwd ="";
		$pwd1 ="";
		$street = @$_POST['street'];
		$city = @$_POST['city'];
		$state = @$_POST['state'];
		$zip = @$_POST['zip'];
		$fnameErr=@$error['fnameErr'];
	   	$lnameErr=@$error['lnameErr'];
		$emailErr=@$error['emailErr'];
		$pwdErr=@$error['pwdErr'];
		$pwd1Err=@$error['pwd1Err'];
		$headErr="";
		if(!empty($error['HeadErr'])){
			$headErr="<p><span class='error'>".$error['HeadErr']."</span></p>";
			}
		$this->output.=
		"Customer Registration</h2><br/>
		<p><span class='error'>*</span> Indicates a required field.</p>".$headErr."		
 			<form method='post' action= '?action=regist'>
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
              <br/><select name='subscID'>";
			for ($fValue =1; $fValue <= count($sub);$fValue++){
							$fMenu = $sub[$fValue];
							if ($fMenu != ""){
								$this->output.="<option value = '$fValue'>[$fMenu]</option>";
							}
						}
			$this->output.=
			"</select>
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
}
class registedView extends View{
	function __construct(){
		$this->output.="Customer Registration</h2><br/>";
		$this->output.="Registed Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=account_detail\">View Personal Information</a><meta http-equiv='Refresh' content='1;url=index.php?action=account_detail'>";
	}
}
class noitemView extends View{
	function __construct(){
		$this->output.="Confirm Rent</h2><br/>";
		$this->output.="No avaliable item!<br/>";
	}
}
class confirmrentView extends View{
	function __construct($success){
		$this->output.="Confirm Rent</h2><br/>";
		if ($success)
			$this->output.="Confirm Rent Successfully!<br><a href= '\EMP\?action=rentalcontrol'>Rental Control </a><meta http-equiv='Refresh' content='1;url=EMP\index.php?action=rentalcontrol'>";
		else
			$this->output.="Confirm Rent Failed!<br/>";
	}
}
class ListView extends View {
	function printplat ($plat){
		switch ($plat){
			case "PC":
				$platform = "<div class='boxinfo pc'>".$plat."</div>";break;
			case "XBOX":
				$platform = "<div class='boxinfo xbox'>".$plat."</div>";break;
			case "WII":
				$platform = "<div class='boxinfo wii'>".$plat."</div>";break;
			case "PS":
				$platform = "<div class='boxinfo ps'>".$plat."</div>";break;
			}
		return $platform;
		}
    function __construct($details1,$details2){
		$this->output.="New Releases</h2><br/><div class='gamelist'>";
		foreach ($details1 as $value){
			$platform = $this->printplat($value['Platform']);
			$this->output.="<div class='boxwrapper'>
			<a href= \"?action=detail&id=".$value['P_D_ID']."\" class='tooltip'>";
			$date1 = strtotime (date("Y-m-d"));
			$date2 = strtotime ($value['Release_Date']);
			$days=ceil(($date1-$date2)/86400);
			if ($days < 60 )
				$this->output.="<div class='wrapper'>
								<div class='ribbon-wrapper-red'>
									<div class='ribbon-red'>&#9733; New</div>
								</div>
							</div>";
			$this->output.="<img src='EMP/images/".$value['Cover_dir']."' width='141' height='200' >
			$platform".
			"<span>
			<img class='callout' src='EMP/images/callout_black.gif' />
			<h4>".$value['Product_Title']."</h4><br />
			<strong>Publisher:</strong>  ".$value['Product_Publisher']."<br />
			<strong>Platform:</strong> ".$value['Platform']."<br />
			<strong>Releasse Date:</strong> ".$value['Release_Date']."<br />
			<strong>ESRB Rating:</strong> ".$value['ESRB_Rating']."<br />
			</span>".
			"</a></div>";
		}
		$this->output.="</div>
			</div>
		</div><div class='laycol_12 content'>
			<div class='maincontent'>
				<h2><img src='EMP/images/mascot.png' width='32' style='display:inline-block; padding-right: 10px;' />Most Rented</h2><br/>
				<div class='gamelist'>";
		foreach ($details2 as $value){
			$platform = $this->printplat($value['Platform']);
			$this->output.="<div class='boxwrapper'>
			<a href= \"?action=detail&id=".$value['P_D_ID']."\" class='tooltip'>";
			$date1 = strtotime (date("Y-m-d"));
			$date2 = strtotime ($value['Release_Date']);
			$days=ceil(($date1-$date2)/86400);
			if ($days < 60 )
				$this->output.="<div class='wrapper'>
								<div class='ribbon-wrapper-red'>
									<div class='ribbon-red'>&#9733; New</div>
								</div>
							</div>";
			$this->output.="<img src='EMP/images/".$value['Cover_dir']."' width='141' height='200' >
			$platform".
			"<span>
			<img class='callout' src='EMP/images/callout_black.gif' />
			<h4>".$value['Product_Title']."</h4><br />
			<strong>Publisher:</strong>  ".$value['Product_Publisher']."<br />
			<strong>Platform:</strong> ".$value['Platform']."<br />
			<strong>Releasse Date:</strong> ".$value['Release_Date']."<br />
			<strong>ESRB Rating:</strong> ".$value['ESRB_Rating']."<br />
			</span>".
			"</a></div>";
		}
		$this->output.="</div>";
	}
}
class poolView extends View {
	function printplat ($plat){
		switch ($plat){
			case "PC":
				$platform = "<div class='boxinfo pc'>".$plat."</div>";break;
			case "XBOX":
				$platform = "<div class='boxinfo xbox'>".$plat."</div>";break;
			case "WII":
				$platform = "<div class='boxinfo wii'>".$plat."</div>";break;
			case "PS":
				$platform = "<div class='boxinfo ps'>".$plat."</div>";break;
			}
		return $platform;
		}
    function __construct($details){
		$this->output.="All Products</h2><br/><div class='gamelist'>";
		foreach ($details as $value){
			$platform = $this->printplat($value['Platform']);
			$this->output.="<div class='boxwrapper'>
			<a href= \"?action=detail&id=".$value['P_D_ID']."\" class='tooltip'>";
			$date1 = strtotime (date("Y-m-d"));
			$date2 = strtotime ($value['Release_Date']);
			$days=ceil(($date1-$date2)/86400);
			if ($days < 60 )
				$this->output.="<div class='wrapper'>
								<div class='ribbon-wrapper-red'>
									<div class='ribbon-red'>&#9733; New</div>
								</div>
							</div>";
			$this->output.="<img src='EMP/images/".$value['Cover_dir']."' width='141' height='200' >
			$platform".
			"<span>
			<img class='callout' src='EMP/images/callout_black.gif' />
			<h4>".$value['Product_Title']."</h4><br />
			<strong>Publisher:</strong>  ".$value['Product_Publisher']."<br />
			<strong>Platform:</strong> ".$value['Platform']."<br />
			<strong>Releasse Date:</strong> ".$value['Release_Date']."<br />
			<strong>ESRB Rating:</strong> ".$value['ESRB_Rating']."<br />
			</span>".
			"</a></div>";
		}
		$this->output.="</div>";
	}
}
class showdetailView extends View{
	function __construct($product,$detail){
		foreach($detail as $value){
			$pdid = $value['P_D_ID'];
			$title = $value['Product_Title'];
			$developer = $value['Product_Developer'];
			$publisher = $value['Product_Publisher'];
			$release = $value['Release_Date'];
			$platform = $value['Platform'];
			$rating = $value['ESRB_Rating'];
			$cover = $value['Cover_dir'];
			$times = $value['Rented_Times'];
			$this->output.="Product Detail</h2><br/><div class='gamelist'>
			<div class='boxwrapper'><img src='EMP/images/".$cover."' width='141' height='200' ></div><br/>".
		"<strong>Product Title: </strong>$title<br/>".
		"<strong>Product Developer: </strong>$developer<br/>".
		"<strong>Product Publisher: </strong>$publisher<br/>".
		"<strong>Release Date: </strong>$release<br/>".
		"<strong>Platform: </strong>$platform<br/>".
		"<strong>ESRB Rating: </strong>$rating<br/>";
		}
		$i=0;
		foreach($product as $value){
			$i++;
		}
		$this->output.="<h3><a href= \"?action=tradein&id=".$value['P_D_ID']."\">I have one can Trade-In!</a></h3><br/>";
		$this->output.="Total Avaliable: ".$i." items.<br/>";
		$this->output.= "<strong><a href= \"?action=rent&id=".$pdid."\">Add this game to my rental queue !</strong><br/></a>";
		$this->output.="</div>";
	}
}
class rentingView extends View{
	function __construct($success){
		$this->output.="Rent Game</h2><br/>";
		if($success == true)
			header("Location:index.php?action=rentalqueue");
		else
			$this->output.="Item is no longer Avaliable!<br><a href=\"".$_SERVER['PHP_SELF']."?action=\">Check Another Item</a>";
	}
}
class rentalqueueView extends View{
	function printplat ($plat){
		switch ($plat){
			case "PC":
				$platform = "<div class='boxinfo pc'>".$plat."</div>";break;
			case "XBOX":
				$platform = "<div class='boxinfo xbox'>".$plat."</div>";break;
			case "WII":
				$platform = "<div class='boxinfo wii'>".$plat."</div>";break;
			case "PS":
				$platform = "<div class='boxinfo ps'>".$plat."</div>";break;
			}
		return $platform;
		}
	function __construct($productT,$detailT,$history,$detail,$queue){
		$renting = false;
		$this->output.="Rental Queue</h2><br/><div class='gamelist'>";
		if($history =="" && $queue == ""){
			$this->output.="There is no result. <meta http-equiv='Refresh' content='3;url=EMP\index.php?action=rentalcontrol'>";
		}
		else{
		if(empty($history) && empty($queue)){
			$this->output.="There is no item in your rental queue. ";
		}
		$i=0;
		foreach ($history as $value){
			$RentDate[$i] = $value['Date_Rented'];
			$RentID[$i] = $value['RH_ID'];
			$ReturnDate[$i] = $value['Date_Returned'];
			$i++;
		}
		$i=0;
		while (@$productT[$i]){
			$this->output.="<div class='queue'><strong>Current Renting</strong> <br/>".
			"<strong>Control Number: </strong> $RentID[$i]<br/>";
			foreach ($detailT[$i] as $value){
				$platform = $this->printplat($value['Platform']);
				$title = $value['Product_Title'];
				$developer = $value['Product_Developer'];
				$publisher = $value['Product_Publisher'];
				$release = $value['Release_Date'];
				$rating = $value['ESRB_Rating'];
				$cover = $value['Cover_dir'];
				$this->output.=
				"<div class='boxwrapper'>
			<a class='tooltip'><img src='EMP/images/".$cover."' width='141' height='200'>$platform".
				"<span><img class='callout' src='EMP/images/callout_black.gif' />
			<h4>".$value['Product_Title']."</h4><br />".
				"<strong>Product Developer: </strong>$developer<br/>".
				"<strong>Product Publisher: </strong>$publisher<br/>".
				"<strong>Release Date: </strong>$release<br/>".
				"<strong>ESRB Rating: </strong>$rating<br/>";	
			}
			foreach ($productT[$i] as $value){
				$pid = $value['P_ID'];
				$cost = $value['Unit_Cost'];
			}
			$this->output.="<strong>Date Rented: </strong>$RentDate[$i]<br/></span></a><br/></div>";
			if ($_SESSION['is_employee']==0)
				$this->output.="<br/><strong>Currently Rented";
			if($_SESSION['is_employee'] == 1 && $i==0){
				if ($RentDate[$i] == "0000-00-00")
					$this->output.="<br/><strong><a href= \"?action=confirmrent&id=".$RentID[$i]."\">Confirm Rented</a>";
				else if ($ReturnDate[$i] == "0000-00-00")
					$this->output.="<br/><strong><a href= \"?action=return&id=".$RentID[$i]."\">Confirm Returned</a>";
			}
			else if ($_SESSION['is_employee'] == 1)
				$this->output.="<br/><strong>In Queue";
			$this->output.="<br/><br/></strong></div>";
			$i++;
			$renting = true;
		}
		$i=0;
		foreach ($queue as $value){
			$queueID[$i] = $value['Queue_ID'];
			$i++;
		}
		$i=0;
		while (@$detail[$i]){
			$this->output.="<div class='queue'><strong>Queue Slot ".($i+1)." </strong> <br/>".
			"<strong>Pendding...</strong><br/>";
			foreach ($detail[$i] as $value){
				$platform = $this->printplat($value['Platform']);
				$title = $value['Product_Title'];
				$developer = $value['Product_Developer'];
				$publisher = $value['Product_Publisher'];
				$release = $value['Release_Date'];
				$rating = $value['ESRB_Rating'];
				$cover = $value['Cover_dir'];
				$this->output.=
				"<div class='boxwrapper'>
			<a class='tooltip'><img src='EMP/images/".$cover."' width='141' height='200'>$platform".
				"<span><img class='callout' src='EMP/images/callout_black.gif' />
			<h4>".$value['Product_Title']."</h4><br />".
				"<strong>Product Developer: </strong>$developer<br/>".
				"<strong>Product Publisher: </strong>$publisher<br/>".
				"<strong>Release Date: </strong>$release<br/>".
				"<strong>ESRB Rating: </strong>$rating<br/>";	
				}
			$this->output.="<strong>Pendding to be shiped</strong><br/></span></a><br/></div>";
			if ($_SESSION['is_employee'] == 0)
			$this->output.="<br/><strong><a href= \"?action=dropitem&id=".$queueID[$i]."\">Drop from queue</a>";
			else if($_SESSION['is_employee'] == 1 && $renting == false && $i == 0){
				$this->output.="<br/><strong><a href= \"?action=confirmrent&id=".$queueID[$i]."\">Confirm Rented</a>";
			}
			else if ($_SESSION['is_employee'] == 1)
				$this->output.="<br/><strong>In Queue";
			$this->output.="<br/><br/></strong></div>";
			$i++;
		}
		}
		$this->output.="</div>";
	}
}
class basketView extends View{
	function __construct($productT,$detailT){
		$i=0;
		while (@$productT[$i]){
			foreach ($detailT[$i] as $value){
				$title = $value['Product_Title'];
				$platform = $value['Platform'];
				$this->output.=
				"<li>$title ($platform)</li>";
			}
		$i++;
		}
		$_SESSION['num'] = $i;
	}
}
class returnitemView extends View{
	function __construct($success){
		$this->output.="Return Control</h2><br/>";
		if($success == true)
			$this->output.="Confirmed Returned Successfully!<br><a href=\"".$_SERVER['PHP_SELF']."?action=rentalqueue\">Back to Search User</a><meta http-equiv='Refresh' content='1;url=EMP\index.php?action=rentalcontrol'>";
		else
			$this->output.="Confirmed Returned Failed!<br><a href=\"".$_SERVER['PHP_SELF']."?action=\">Back to Search User</a><meta http-equiv='Refresh' content='1;url=EMP\index.php?action=rentalcontrol'>";
	}
}
class placetradeinView extends View{
	function __construct($success){
		$this->output.="Trade-in Game</h2><br/>";
		if($success == true)
			$this->output.="Place Trade-in Request Successfully! Please wait for our response. Meanwhile, you can go to <br><a href=\"".$_SERVER['PHP_SELF']."?action=tradeinstatus\">View My Trade-in Status</a><meta http-equiv='Refresh' content='1;url=index.php?action=tradeinstatus'>";
		else
			$this->output.="Place Trade-in Request Failed!<br><a href=\"".$_SERVER['PHP_SELF']."?action=\">Back to Home Page</a><meta http-equiv='Refresh' content='1;url=index.php?action='>";
	}
}
class tradeinstatusView extends View{
	function __construct($trade,$details){
		$this->output.="Trade-in Status</h2><br/>";
		foreach ($details as $value){
			$pdid = $value['P_D_ID'];
			$title[$pdid] = $value['Product_Title'];
			}
		foreach ($trade as $value){
			$this->output.= 
			"Request #: ".$value['Trade_ID']."<br/>".
			"Game Title: ".$title[$value['P_D_ID']]."<br/>".
			"Trade Date: ".$value['Trade_Date']."<br/>".
			"Trade Price: ";
			if ($value['Trade_Price'] == 0)
			$this->output.= "Not Applicable";
			else
			$this->output.= $value['Trade_Price'];
			$this->output.="<br/>".
			"Trade Status: ";
			if ($value['Trade_Status'] == 0)
			$this->output.= "Approving";
			else if ($value['Trade_Status'] == 1)
			$this->output.="Approved";
			else if ($value['Trade_Status'] == 2)
			$this->output.="Denied";
			$this->output.="<br/><br/>";
			}
		
	}
}

class searchplistView extends View{
	function printplat ($plat){
		switch ($plat){
			case "PC":
				$platform = "<div class='boxinfo pc'>".$plat."</div>";break;
			case "XBOX":
				$platform = "<div class='boxinfo xbox'>".$plat."</div>";break;
			case "WII":
				$platform = "<div class='boxinfo wii'>".$plat."</div>";break;
			case "PS":
				$platform = "<div class='boxinfo ps'>".$plat."</div>";break;
			}
		return $platform;
		}
	function __construct($product){
		
		$this->output.="Result List</h2><br/><div class='gamelist'>";
		if(empty($product))
			$this->output.="No Result. Please Search a different product.</div>";
		else{
			foreach ($product as $value){
				$platform = $this->printplat($value['Platform']);
			$this->output.="<div class='boxwrapper'>
			<a href= \"?action=detail&id=".$value['P_D_ID']."\" class='tooltip'>";
			$date1 = strtotime (date("Y-m-d"));
			$date2 = strtotime ($value['Release_Date']);
			$days=ceil(($date1-$date2)/86400);
			if ($days < 60 )
				$this->output.="<div class='wrapper'>
								<div class='ribbon-wrapper-red'>
									<div class='ribbon-red'>&#9733; New</div>
								</div>
							</div>";
			$this->output.="<img src='EMP/images/".$value['Cover_dir']."' width='141' height='200' >
			$platform".
			"<span>
			<img class='callout' src='EMP/images/callout_black.gif' />
			<h4>".$value['Product_Title']."</h4><br />
			<strong>Publisher:</strong>  ".$value['Product_Publisher']."<br />
			<strong>Platform:</strong> ".$value['Platform']."<br />
			<strong>Releasse Date:</strong> ".$value['Release_Date']."<br />
			<strong>ESRB Rating:</strong> ".$value['ESRB_Rating']."<br />
			</span>".
			"</a></div>";
			}
		$this->output.="</div>";
		}
	}
}
?>
