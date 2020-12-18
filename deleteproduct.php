<?php 
	include("session.php");
if(isset($_GET["pid"]) || isset($_SESSION["uid"]))
{
	$sql = "DELETE FROM seller_product WHERE pid = '".$_GET["pid"]."' AND uid = '".$_SESSION["uid"]."'";

	include("connect.php");	
		
	if ($conn->query($sql) === TRUE) {
		
		//echo "Record deleted successfully";
		header("Location:seller.php");
	} else {
		echo "Error deleting record: " . $conn->error;
	}

}
?>