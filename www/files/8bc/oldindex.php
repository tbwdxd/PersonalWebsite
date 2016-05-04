<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
<title>8-bit Crusaders</title></head>
<body>
<div id="header">
  <h1>8-bit Crusader</h1>
	<h2>Game Rental Company</h2>
</div>
<div id="searchbox" class="laycol_5">
				<form class="searchform" action=?action=searchproduct method=post>
					<input name= "search" id="searchfield" type="text" value="Search 8-Bit Crusaders" style="width: 170px;" />
					<input class="searchbutton" id="searchbutton" type="submit" value="Search" />
				</form>
			</div>
<?php 
session_start();
require_once('lib/DataAccess.php');
require_once('lib/Model.php');
require_once('lib/View.php');
require_once('lib/Controller.php');

$data=& new DataAccess ('localhost','root','CS362','8BDB');
echo "<div id='content'>
	<h3><a href='?action='>Home Page</a></h3>";
if (@$_SESSION["is_employee"] == 1){
	echo "<h3><a href='EMP\'>Control Panel</a></h3>";	
	}
if (@$_SESSION["is_employee"] == 0 && @$_SESSION['Name']){
	echo "Welcome, ".$_SESSION['Name'].",
	<a href='?action=logout'>Log out</a>
	<a href='?action=rentalqueue'>My Rental Queue</a><br/><hr />
	Not you?";	
	}
echo "
	<a href='?action=register'>Need an Account?</a>
    <a href='?action=login'>Log In</a><br>
    ";
$action=@$_GET["action"];
switch ($action)
{
	case "login":
		$controller=& new indexController($data); break;
   	case "sign_in":
      	$controller=& new signinController($data); break;
	case "logout":
		$controller=& new logoutController($data); break;
	case "account_detail":
		$controller=& new accountController($data);break;
	case "account_management":
		$controller=& new accmanagementController($data);break;
	case "updateacct":
		$controller=& new updateacctController($data);break;
	case "passwordmanagement":
		$controller=& new passwordController($data);break;
	case "updatepass":
		$controller=& new updatepassController($data);break;
	case "register":
		$controller=& new registerController($data);break;
	case "regist":
		$controller=& new registController($data);break;
	case "list":
		$controller=& new listController($data);break;
	case "searchuser":
		$controller=& new searchuserController($data);break;
	case "searchemp":
		$controller=& new searchempController($data);break;
	case "detail":
		$controller=& new showdetailController($data);break;
	case "rent":
		$controller=& new rentController($data);break;
	case "rentalqueue":
		$controller=& new rentalqueueController($data);break;
	case "return":
		$controller=& new returnController($data);break;
	case "tradein":
		$controller=& new tradeinController($data);break;
	case "tradeinstatus":
		$controller=& new tradeinstatusController($data);break;
	case "searchproduct":
		$controller=& new searchproductController($data);break;
   	default:
      	$controller=& new listController($data); break; 
   
}
$view=$controller->getView(); 
$view->display(); 
?>
</body>
</html>