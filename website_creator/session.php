<?php 
session_start();
if( basename($_SERVER['PHP_SELF']) == 'login.php') {
  //Hide
	if(isset($_SESSION['uid']))
	{
		//echo "here";
		header("Location:seller.php");
	}
} elseif(basename($_SERVER['PHP_SELF']) == 'listsellers.php' || basename($_SERVER['PHP_SELF']) == 'seller.php'|| basename($_SERVER['PHP_SELF']) == 'clientsignup.php'|| basename($_SERVER['PHP_SELF']) == 'signup.php'|| basename($_SERVER['PHP_SELF']) == 'index.php' || basename($_SERVER['PHP_SELF']) == 'support.php' || basename($_SERVER['PHP_SELF']) == 'contact.php' || basename($_SERVER['PHP_SELF']) == 'about.php')
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

?>