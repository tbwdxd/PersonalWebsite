<html>
<head>
<title>8-bit Crusaders Control Panel</title>
<link rel="stylesheet" type="text/css" href="../css/style.css" />
<link rel="icon" type="image/ico" href="/images/favicon.ico" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
</head>
<body>
<?php
require_once('lib/DataAccess.php');
require_once('lib/Model.php');
require_once('lib/View.php');
require_once('lib/Controller.php');
session_start();
?>
<div id="navtop">
		<div id="navtop"  class="laybox_12">
			<img src="images/logo2.png" height="40" style="display:inline-block; float: left; margin-right: -10px; padding-top: 5px;" />
            <div id="loginlogout" class="laycol_4">
				<div id="object36" class="menuitem">
					<form action=?action=sign_in method=post>
   					Username:
   					<input type='text' name=Email>
   					Password:
   					<input type='password' name=Password>
    				<input type='submit' value='Login'>
					</form>
				</div>
				<div id="object37" class="menuitem2" style="margin-left: 150px;">
					<strong style="text-decoration: underline;">Current Items</strong>
					<ul style="margin-top: 5px;">
					</ul>
				</div>
                <?php
				echo $_SESSION['Name']." <p><a href='../?action=logout'>Log out </a></p>";
				?>
                <p ><a href="?action=addemp">ADD NEW EMP</a></p>
			</div>
		</div>
	</div>
<div id="backdrop0"></div>
	<div class="laybox_12 clearfix" style="margin-top: 50px">
		<div id="header" class="laycol_12">
			<div id="slogan">
				<p>Control Panel</p>
			</div>
			<div id="headerlogo" class="laycol_12">
				<img src="images/logo.png" width="400" height="202" style="float: left;" />
				<ul id="advantages">
					<li>Rent Over 3,000 Console Games</li>
					<li>Trade in Games for Store Credit</li>
					<li>No Late Fees &mdash; Cancel Anytime</li>
					<li>Rent Games Using Your Store Credit</li>
				</ul>
			</div>
			<div id="nav" class="laycol_12" style="margin: 0;">
				<ul>
					<li class='home'>
						<a href='?action='><img src='images/home.png' style='margin-right: 10px; width: 16px; height: 16px; color: white;'/>Control Panel</a>
					</li>
				</ul>
			</div>
		</div>
		<div class="laycol_12 content">
			<div class="maincontent">
				<h2><img src="images/mascot.png" width="32" style="display:inline-block; padding-right: 10px;" />			
<?php
if(!@$_SESSION['Email']) {
	$error['HeadErr']="Please Login to continue";
	header("Location: ../index.php");
	die();
}
if(@$_SESSION['is_employee'] != 1) {
	header("Location: ../index.php?action=account_detail");
	die();
}
//$data=& new DataAccess ('localhost','root','CS362','8BDB');
$data=DataAccess::getInstance('localhost','root','CS362','8BDB');
$action=@$_GET["action"];
switch ($action)
{
   	case "add":
      	$controller=& new addController($data); break;
   	case "print":
      	$controller=& new printController($data); break;
	case "printdetail":
		$controller=& new printdetailController($data); break;
	case "update":
		$controller=& new updateController($data); break;
	case "updatedetail":
		$controller=& new updatedetailController($data); break;
   	case "delete":
      	$controller=& new deleteController($data); break;
	case "table1":
		$controller=& new table1Controller($data); break;
	case "add_detail":
		$controller=& new add_detailController($data); break;
	case "table2":
		$controller=& new table2Controller($data); break;
	case "submanagement":
		$controller=& new submanagementController($data); break;
	case "updatesub":
		$controller=& new updatesubController($data); break;
	case "addsub":
		$controller=& new addsubController($data);break;
	case "addemp":
		$controller=& new addempController($data);break;
	case "registemp":
		$controller=& new registempController($data);break;
	case "modifyacct":
		$controller=& new modifyacctController($data);break;
	case "rentalcontrol":
		$controller=& new rentalcontrolController($data);break;
	case "tradeinmanagement":
		$controller=& new tradeinmanagementController($data);break;
	case "default":
		$controller=& new empinfoController($data);break;
	case "updatetrade":
		$controller=& new updatetradeController($data);break;
	case "denytrade":
		$controller=& new denytradeController($data);break;
	case "tradelist":
		$controller=& new tradelistController($data);break;
	case "controlpanel":
		$controller=& new panelController($data);break;
   	default:
      	$controller=& new panelController($data); break; 
   
}
$view=$controller->getView(); 
$view->display();             
?>
			</div>
        </div>

		<div id="footermain" class="laycol_12">
			<div class="laycol_12">
				<div id="storecredit">
					<p>Trade in your old games for store credit</p>
				</div>			
				<p>After your FREE trial, you can continue renting all the video games you want at our regular low price of only $22.95 per month for our 2-game plan. Cancel anytime. 
					No due dates or late fees...ever!</p>
				</div>
				<div class="laycol_6 column">
					<p><strong style="border-bottom: 2px solid white">Special Offers</strong></p>
					<div id="specialoffer">
						<p><strong>Sign up for special offers:</strong></p>
						<img src="images/specialoffer.png" width="50" style="display: inline; float: left; padding-left: 15px;"/>
						<form name="specialoffersform" style="padding-top: 10px;">
							<input class="emailbox" value="Enter email address" name="email" onFocus="if (this.value == 'Enter email address') {this.value = '';}" onBlur="if (this.value == '') {this.value = 'Enter email address';}">
						</form>
					</div>
				</div>
				<div class="laycol_3 column">
					<p><strong style="border-bottom: 2px solid white">About Us</strong></p>
					<ul>
						<li><a href="#">
							About Us</a>
						</li>
						<li><a href="#">
							Support</a>
						</li>
						<li><a href="#">
							Affiliate Program</a>
						</li>
						<li><a href="#">
							Privacy Policy</a>
						</li>
						<li><a href="#">
							Terms of Use</a>
						</li>
						<li><a href="#">
							Careers</a>
						</li>
						<li><a href="#">
							Contact Us</a>
						</li>
					</ul>
				</div>
				<div class="laycol_3 column noborder">
					<p><strong style="border-bottom: 2px solid white">Your Account</strong></p>
					<ul>
						<li><a href="#">
							Rental Queue</a>
						</li>
						<li><a href="#">
							Login Page</a>
						</li>
						<li><a href="#">
							Trade-in</a>
						</li>
						<li><a href="#">
							Account Management</a>
						</li>
						<li><a href="#">
							Subscription Management</a>
						</li>
					</ul>
				</div>
				<div id="footer" class="laycol_12">
					<p>&copy; Copyright 2014 8-Bit Crusaders - All Rights Reserved <span style="float: right; display: inline; font-weight: bold;">Design by Mahdi Hosseini</span></p>

				</div>
				<div class="laycol_12">
					<img src="images\mascot.png" width="60" style="float: left; padding: 10px; padding-right: 20px;" />
					<p>8-bit Crusaders is the #1 online video game rental service. Rent or buy PS4, PS3, PS2, PS Vita, PSP, Xbox One, Xbox 360, Xbox, GameCube, DS, 3DS, Wii U, Wii, GBA used video games. So what are you waiting for? Start with a full 1-month free trial, or get our special introductory rate of $20.00 for 2 months with 2 games out. Continue renting all the videogames you want at our regular low monthly prices after that, and cancel any time you want. There are no due dates or late fees ever.</p>
				</div>
			</div>
		</div>
		<div id="backdrop2"></div>
		<div id="backdrop3"></div>
<script type="text/javascript">
			$('#loginlink').click(function()
			{
				var loginbox = $('#object36');
				loginbox.css({ display: block });
			});
			
			$('#basketlink').click(function()
			{
				var basketbox = $('#object37');
				basketbox.css({ display: block });
			});
			
			$('#searchfield').focus(function()
			{
				/*to make this flexible, I'm storing the current width in an attribute*/
				/*$(this).attr('data-default', $(this).width());*/
				var submit = $('#searchbutton');
				var input = $('#searchfield');
				$(this).animate({ width: 250 }, '300');
				if(input.val() === 'Search 8-Bit Crusaders') {
					$('#searchfield').val('');
				}
			}).blur(function()
			{
				/* lookup the original width */
				/*var w = $(this).attr('data-default');*/
				
				$(this).animate({ width: 170 }, '300');
				var submit = $('#searchbutton');
				var input = $('#searchfield');
				if(!(input.val() == '' || input.val() == 'Search 8-Bit Crusaders')) {
					
				}

				else {
					$('#searchfield').val('Search 8-Bit Crusaders');
					submit.css({display: 'none'});
					submit.fadeOut(500);
				}
			}).keyup(function()
			{
				
				var submit = $('#searchbutton');
				var input = $('#searchfield');

				if(input.val() != 'Search 8-Bit Crusaders') {
					
					submit.fadeIn(500);
					submit.css({display: 'inline-block'});
				}
			}).click(function()
			{
				var submit = $('#searchbutton');
				var input = $('#searchfield');
				if(!(input.val() === 'Search 8-Bit Crusaders')) {
					$('#searchfield').select();
				}
			});
	</script>
	<script type="text/javascript">
	$(document).on("click", "#loginlink", function()
	{
		$('#object36').fadeToggle(100);
	});
	
	$(document).mouseup(function (e)
	{
	    var container = $("#object36");
		var button = $('#loginlink');

	    if (!container.is(e.target)
	        && container.has(e.target).length === 0
			&& !button.is(e.target))
	    {
	        container.fadeOut(100);
	    }
	});
	</script>
	
	<script type="text/javascript">
	$(document).on("click", "#basketbox", function()
	{
		$('#object37').fadeToggle(100);
	});


	$(document).mouseup(function (e)
	{
		var menuitem = $('.menuitem');
	    var container = $("#object37");
		var button = $('#basketlink');

	    if (!container.is(e.target)
	        && container.has(e.target).length === 0
			&& !button.is(e.target))
	    {
	        container.fadeOut(100);
	    }
	});
	</script>
</body>
</html>