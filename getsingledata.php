<?php 


function singletable( $sql){

include("connect.php");

$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {	
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
	 
	 $temp = $row;
  }
  
  foreach(array_keys($temp) as $key)
	{
		$new_key = $key;
		$post[$new_key] = $temp[$key];
	}
			
} else {
	$post["error"] = "Not Found";
}


mysqli_close($conn);
	  return  $post;
}
?>
