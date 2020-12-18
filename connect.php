<?php
$servername = "localhost";
//$username = "portalw_stoneown";
//$password = "6w@eW6s&@g~m";
//$dbname = "portalw_stonemart";
$username = "root";
$password = "";
$dbname = "granimart";


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


?>