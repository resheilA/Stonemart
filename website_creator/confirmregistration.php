<?php 
session_start();
$_SESSION["bookdomain"] = $_GET["bookdomain"];
header("location:bookdomain.php");
?>