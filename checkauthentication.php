<?php 

function authenticate($post)
{
	$arraykey = array_keys($post);
	
	foreach($arraykey as $key)
	{		
		$joined_string = $key;
	//var_dump($post);
			if(strpos($joined_string, "email") !== false){							
				if (!filter_var($post[$joined_string], FILTER_VALIDATE_EMAIL)){
					return "Please check the email address entered.";break;
				}			
				if(empty($post[$joined_string])){return "Enter the values marked with star.";break;}
			}
			if (strpos($joined_string, 'contact_no') !== false) 
			{				
				if (!preg_match('/^[0-9]{10}+$/', $post[$joined_string])) {									
				 return "Please check the contact number you have entered.";
				}
				if(empty($post[$joined_string])){return "Enter the values marked with star.";}
			}				
			if(strpos($joined_string, 'name') !== false) 
			{				
				if($joined_string !== 'seller_product|product_name')
				{					
				if(empty($post[$joined_string])){return "Enter the values name marked with star.";}
				}
			}	
			if(strpos($joined_string, 'product_finishing|finishing') !== false) 
			{										
				if(empty($post[$joined_string])){return "Enter the values name marked with star.";}
			}
			
			if($joined_string == 'product_form|form')
			{					
				if(empty($post[$joined_string])){return "Enter the values name marked with star.";}				
			}
			
			if(strpos($joined_string, 'password') !== false) 
			{
				if (strlen($post[$joined_string]) < 5) {
						return "Your Password Must Contain At Least 5 Characters!";
					}
				if(empty($post[$joined_string])){return "Enter the values marked with star.";}
							
			///////////////////////////////////////////////////////////////////////////////////	
				if(isset($post["vpassword"]))
				{
					if($post["vpassword"] != $post[$joined_string])
					{
						return "Password don't match";
					}
					if(empty($post["vpassword"])){return "Enter the values marked with star.";}
				}
				
			}
				

			
			/*
			if(strpos($joined_string, 'uid') !== false) 
			{
				if($post[$joined_string] == $_SESSION['uid']){return "INVALID";}
			}
			*/
	}		
			return "true";
}			


function checkexist($POST){
	$arraykey = array_keys($POST);
	$table_count = 0;
	$variable_count = 0;
	$array_select = [];
	foreach($arraykey as $key)
	{
	$keypiece = explode("|", $key);
//		echo $key."<br>";
			if(isset($keypiece[1])){
			$table_name = $keypiece[0];
			$variable_name = $keypiece[1];	
			$value = $POST[$key];
			
			
			if((strpos($variable_name, 'color') !== false )||( strpos($variable_name, 'min_price') !== false )||( strpos($variable_name, 'application_area') !== false )||( strpos($variable_name, 'max_price') !== false )|| (strpos($variable_name, 'finishing') !== false )||( strpos($variable_name, 'form') !== false)|| (strpos($variable_name, 'product_name') !== false )){			
			if((strpos($variable_name, 'color_code') == false)){
			include_once("connect.php");
			echo $variable_name;
			 $sql = "SELECT * FROM ".$table_name." WHERE ".$variable_name."='".$value."'";
				
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
				  // output data of each row
				  while($row = mysqli_fetch_assoc($result)) {
					  unset($_POST[$key]); 
					$_POST['seller_product|'.$variable_name] = $row['no'];					
				  }
				} else {
						
						$sql = "INSERT INTO ".$table_name." (".$variable_name.")
						VALUES ('".$value."')";
			
						if ($conn->query($sql) === TRUE) {	
							 $last_id = $conn->insert_id;
							 unset($_POST[$key]); 
							 $_POST['seller_product|'.$variable_name] = $last_id;					
						}
												
				}		
			}	
			}
			}
		
	}	
}

?>