<html>
<head>
<title>8-bit Crusaders - your sole outlet for video game rentals</title>
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="icon" type="image/ico" href="EMP/images/favicon.ico" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<meta http-equiv="content-type" content="text/html; charset=gb2312">
</head>
<body>
<?php
session_start();
require_once('lib/DataAccess.php');
require_once('lib/Model.php');
require_once('lib/View.php');
require_once('lib/Controller.php');

//$data=& new DataAccess ('localhost','root','password','8BDB');
$data=DataAccess::getInstance('localhost','testdd','test15821961_gg','8bdb');
if(@$_SESSION['EID'] != ""){
	$_SESSION['is_employee'] =1;
	}
?>
<div id="navtop">
		<div id="navtop" style="margin-left: 15%; margin-right: 5%;">
			<img src="EMP/images/logo2.png" height="40" style="display:inline-block; float: left; margin-right: -10px; padding-top: 5px;" />
			<div id="searchbox" class="laycol_5">
				<form class="searchform" action=?action=searchproduct method=post>
					<input name= "search" id="searchfield" type="text" value="Search 8-Bit Crusaders" style="width: 170px;" />
					<input class="searchbutton" id="searchbutton" type="submit" value="Go" />
				</form>
			</div>
        	<div id="loginlogout" class="laycol_4">
				<div id="object36" class="menuitem">
					<form action=?action=sign_in method=post>
   					Email:
   					<input type='text' name=Email>
   					Password:
   					<input type='password' name=Password>
    				<input type='submit' value='Login'>
					</form>
				</div>
				<div id="object37" class="menuitem2">
					<strong style="text-decoration: underline;">Current Items</strong>
					<ul style="margin-top: 5px;">
						<?php 
						$controller=& new basketController($data); 
						$view=$controller->getView(); 
						$view->display();
						?>
					</ul>
				</div>
                <?php
				if (@$_SESSION['Name'])
					echo "Welcome, ".$_SESSION['Name']." <p><a href='?action=logout'>Log out </a></p>";
				else
					echo "<p><a href='#' id='loginlink' class='menuitem'>Login</a></p>".
					" <p style='padding-right: 40px;'><a href='?action=register'> Signup</a></p>";
					
				?>
				<div id="basketbox" class="menuitem2">
					<div id="basketicon"></div>
					<p><a href="#" id="basketlink">Basket</a></p>
					<div id="shoppingcart">
						<p><?php 
						$num = 0;
						if (!empty($_SESSION['num']))
							$num = $_SESSION['num'];
						echo $num; ?></p>
					</div>
				</div>
			</div>
		</div>
	</div>
<div id="backdrop0"></div>
	<div class="laybox_12 clearfix" style="margin-top: 50px">
		<div id="header" class="laycol_12">
			<div id="slogan">
				<p>Your Sole Outlet for Video Game Rentals</p>
			</div>
			<div id="headerlogo" class="laycol_12">
				<img src="EMP/images/logo.png" width="400" height="202" style="float: left;" />
				<ul id="advantages">
					<li>Rent Over 3,000 Console Games</li>
					<li>Trade in Games for Store Credit</li>
					<li>No Late Fees &mdash; Cancel Anytime</li>
					<li>Rent Games Using Your Store Credit</li>
				</ul>
			</div>
			<div id="nav" class="laycol_12" style="margin: 0;">
				<ul>
                <?php
				$highlight =  "style='background-color: #f2da4e; color: black; font-weight: bold;'";
				$home=$register=$pp=$rq=$ad=$ti="";
				if (@$_GET['action'] == ''){
					$home = $highlight;
					$image='01';
					$text = "BioShock Infinite now available for rent";
				}
				else if (@$_GET['action'] == 'register'){
					$register = $highlight;
					$image='02';
					$text = "Battlefield 4 is now available for rent";
				}
				else if (@$_GET['action'] == 'product_pool'){
					$pp = $highlight;
					$image='03';
					$text = "Rent World of Warcraft: Mists of Pandaria now";
				}
				else if (@$_GET['action'] == 'rentalqueue'){
					$rq = $highlight;
					$image='04';
					$text = "Grand Theft Auto 5 is now available";
				}
				else if (@$_GET['action'] == 'account_detail'){
					$ad = $highlight;
					$image='05';
					$text = "Unleash yourself with Need for Speed Rivals";
				}
				else if (@$_GET['action'] == 'tradeinstatus'){
					$ti = $highlight;
					$image='01';
					$text = "BioShock Infinite now available for rent";
				}
				else {
					$image='01';
					$text = "BioShock Infinite now available for rent";
				}

				if(@$_SESSION['is_employee'] ==1){
				echo"	<li class='home'>
						<a href='EMP/?action='><img src='EMP/images/home.png' style='margin-right: 10px; width: 16px; height: 16px; color: white;'/>Control Panel</a>
					</li>";
				}
				else{
				
				echo"	<li class='home'>
						<a href='?action='$home><img src='EMP/images/home.png' style='margin-right: 10px; width: 16px; height: 16px; color: white;'/>Home</a>
					</li>
					<li class='registration'>
						<a href='?action=register' $register>Registration</a>
					</li>
					<li class='products'>
						<a href='?action=product_pool' $pp>Products</a>
					</li>
					<li class='rentalqueue'>
						<a href='?action=rentalqueue' $rq>Rental Queue</a>
					</li>
					<li class='accountmanagment'>
						<a href='?action=account_detail' $ad>Account Management</a>
					</li>
					<li class='tradeins'>
						<a href='?action=tradeinstatus'$ti>Trade-ins</a>
					</li>";
				}
				echo"</ul>
			</div>
		</div>
		<div id='feature' class='laycol_12'>
			<img src='EMP/images/feature$image.jpg' width='960' height='362' />
			<h4><span> $text</span></h4> ";	?>	
            
		
		</div>
		<div id="process" class="laycol_12">
			<img src="EMP/images/process.png" width="960" />
		</div>
		<div class="laycol_12 content">
			<div class="maincontent">
				<h2><img src="EMP/images/mascot.png" width="32" style="display:inline-block; padding-right: 10px;"	/>

<?php 
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
		if (!empty($_SESSION['Name'])){
			$controller=& new accountController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "account_management":
		if (!empty($_SESSION['Name'])){
			$controller=& new accmanagementController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "updateacct":
		if (!empty($_SESSION['Name'])){
			$controller=& new updateacctController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "passwordmanagement":
		if (!empty($_SESSION['Name'])){
			$controller=& new passwordController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "updatepass":
		if (!empty($_SESSION['Name'])){
			$controller=& new updatepassController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "register":
		$controller=& new registerController($data);break;
	case "regist":
		$controller=& new registController($data);break;
	case "list":
		$controller=& new listController($data);break;
	case "product_pool":
		$controller=& new poolController($data);break;
	case "searchuser":
		if (!empty($_SESSION['Name'])){
			$controller=& new searchuserController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "searchemp":
		if (!empty($_SESSION['Name'])){
			$controller=& new searchempController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "detail":
		$controller=& new showdetailController($data);break;
	case "rent":
		if (!empty($_SESSION['Name'])){
			$controller=& new rentController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "rentalqueue":
		if (!empty($_SESSION['Name'])){
			$controller=& new rentalqueueController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "return":
		if (!empty($_SESSION['Name'])){
			$controller=& new returnController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "tradein":
		if (!empty($_SESSION['Name'])){
			$controller=& new tradeinController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "tradeinstatus":
		if (!empty($_SESSION['Name'])){
			$controller=& new tradeinstatusController($data);break;
		}
		else{
			header("Location:?action=login");
			break;
		}
	case "searchproduct":
		$controller=& new searchproductController($data);break;
	case "searchrent":
		$controller=& new searchrentController($data);break;
	case "dropitem":
		$controller=& new dropitemController($data);break;
	case "confirmrent":
		$controller=& new confirmrentController($data);break;
   	default:
		if (@$_SESSION['is_employee'] !=0){
			header("Location:EMP/?action=");break;
		}
		else{
			$controller=& new listController($data); 
			break;
		}   
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
						<img src="EMP/images/specialoffer.png" width="50" style="display: inline; float: left; padding-left: 15px;"/>
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
					<img src="EMP\images\mascot.png" width="60" style="float: left; padding: 10px; padding-right: 20px;" />
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