<?php 

function deleterow($sql, $flag)
{
	
	include("connect.php");	
	
if ($conn->query($sql) === TRUE) {
	
	//  echo "Record deleted successfully";
} else {
 // echo "Error deleting record: " . $conn->error;
}

$conn->close();


}
?>