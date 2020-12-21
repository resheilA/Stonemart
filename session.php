<?php 
session_start();
if( basename($_SERVER['PHP_SELF']) == 'login.php') {
  //Hide
	if(isset($_SESSION['uid']))
	{
		//echo "here";
		header("Location:seller.php");
	}
} elseif(basename($_SERVER['PHP_SELF']) == 'searchproduct.php' || basename($_SERVER['PHP_SELF']) == 'listsellers.php' || basename($_SERVER['PHP_SELF']) == 'seller.php'|| basename($_SERVER['PHP_SELF']) == 'clientsignup.php'|| basename($_SERVER['PHP_SELF']) == 'signup.php'|| basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'support.php' || basename($_SERVER['PHP_SELF']) == 'contact.php' || basename($_SERVER['PHP_SELF']) == 'about.php' || basename($_SERVER['PHP_SELF']) == 'pricing.php')
{
	if(isset($_SESSION['uid']))
	{		
	//	header("Location:seller.php");
	}
}
else {
	if(!isset($_SESSION['uid']))
	{
		//echo "here";
		header("Location:login.php");		
	}
  //show
}

if(isset($_GET["pincode"])){	
	$cookie_name = "user_pincode";
	$cookie_value = $_GET["pincode"];
	setcookie($cookie_name, $cookie_value, time() + (86400 * 60), "/"); // 86400 = 1 day	
	}
	 

?>