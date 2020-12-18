<?php 
function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function aasort (&$array, $key) {
    $sorter=array();
    $ret=array();
    reset($array);
    foreach ($array as $ii => $va) {
        $sorter[$ii]=$va[$key];
    }
    arsort($sorter);
    foreach ($sorter as $ii => $va) {
        $ret[$ii]=$array[$ii];
    }
    $array=$ret;
}

function RemoveSpecialChar($str) { 
      
    // Using str_replace() function  
    // to replace the word  
    $res = str_replace( array( '\'', '"', 
    ',' , ';', '<', '>' ), ' ', $str); 
      
    // Returning the result  
    return $res; 
    } 
	
function logAction($contact_no, $name, $activity, $seller_id, $product_id)
{
		include_once("connect.php");
		
		$sql = "INSERT INTO client_logs (name, contact_no, activity,seller_id, product_id)
		VALUES ('".$name."', '".$contact_no."', '".$activity."', '".$seller_id."', '".$product_id."')";

		if (mysqli_query($conn, $sql)) {
		  //echo "New record created successfully";
		} else {
		  //echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
		mysqli_close($conn);
}
	
?>