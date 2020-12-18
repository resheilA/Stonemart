<?php 


function singletable_all( $sql ){

include("connect.php");

//$sql = "SELECT ".$param." FROM ".$table."  ". $where;
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {	
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	 $temp[] = $row;	 
  }
  
  $post = $temp;			
} else {
	$post["error"] = "Not Found";
}


mysqli_close($conn);
	  return  $post;
}
?>
