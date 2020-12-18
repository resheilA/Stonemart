<?php 
include_once("checkauthentication.php");	

if($_SERVER["REQUEST_METHOD"] == "POST")
{

if(isset($_FILES)){	
$imagearraykey = array_keys($_FILES);	

	foreach($imagearraykey as $key)
	{		
	
		$keypiece = explode("|", $key);
		$save_type = $keypiece[2];
		$folder = $keypiece[3];
		$onlykey = $keypiece[0]."|".$keypiece[1];
		
		if (!file_exists("uploads/".$folder)) {
				mkdir("uploads/".$folder, 0777, true);
			}

		if($save_type  == 0)
		{
			if(!empty($_FILES[$key]['tmp_name']))
			{					
			$img = file_get_contents($_FILES[$key]['tmp_name']); 
						  
						$filename=$_FILES[$key]['name'];
						$file_explode = explode(".", $filename);
						$file_extn = $file_explode[1];
						$filetype=$_FILES[$key]['type'];
						$newfilename = md5(rand().time()).".".$file_extn;
						if($filetype=='image/jpeg' or $filetype=='image/png' or $filetype=='image/gif')
						{
						move_uploaded_file($_FILES[$key]['tmp_name'],"uploads/".$folder."/".$newfilename);
						$filepath= "uploads/".$folder."/".$newfilename;
						}
							
						$imagedata = $filepath;
						// Encode the image string data into base64 
						//$imagedata = base64_encode($img); 
						  
						// Display the output 
						$_POST[$onlykey] = $imagedata; 
			}
		}		
		else
		{
			if(!empty($_FILES[$key]['tmp_name']))
			{					
			$img = file_get_contents($_FILES[$key]['tmp_name']); 
						  
						// Encode the image string data into base64 
						$imagedata = base64_encode($img); 
						  
						// Display the output 
						$_POST[$onlykey] = $imagedata; 
			}
		}
	}	
}




$flag_auth = "false";		
$flag_auth = authenticate($_POST);
if($flag_auth == "true"){
checkexist($_POST);
$arraykey = array_keys($_POST);
//var_dump($_POST);

//////////////////FIRST CREATEING A 2d array of FORMAT 
////////////////// array[tablename][variablename]
///////////////////


$table_count = 0;
$variable_count = 0;
$array_select = [];
foreach($arraykey as $key)
{
$keypiece = explode("|", $key);
$table_name = $keypiece[0];
$variable_name = $keypiece[1];

///// ADDING THE TABLES and variables IN THE 2-D ARRAY 
 
		//$array_select[$table_count] = $table_name;
		$array_select[$table_name][$variable_count] = $variable_name; /////addded here
		$variable_count++;
		$table_count++;
}

//echo"<pre>";


	foreach(array_keys($array_select) as $tablename)
	{
		//////RUNNING A LOOP FOR TABLE NAME
		
		$variable_string = "";
		$value_string = "";
		$update_string ="";
		$firstcount = 0;
		$firstcount_value = 0;
		
		///// CREATING A VARIABLE STRING
		
		foreach($array_select[$tablename] as $variname)
		{
			/////RUNNING A LOOP FOR VARIABLE NAME AND PREPARING INSET STIRNG
			
			if($firstcount == 0)	
			{
				$variable_string .= "".$variname;		         
			}
			else 
			{
				$variable_string .= ", ".$variname;		         
			}
			
			$firstcount++;
		}
		
		
		
		
		/////////CREATING A VALUE STRING 
		
		foreach($array_select[$tablename] as $variname)
		{
			/////RUNNING A LOOP FOR VARIABLE NAME AND GETTING AND PREPARING VALUE STRING
			$joined_string = $tablename."|".$variname;
			
			
			if(is_array($_POST[$joined_string]) == true)
			{					
				//$_POST[$joined_string] = htmlentities(mysql_real_escape_string($_POST[$joined_string], ENT_QUOTES);
				$_POST[$joined_string] = implode(",", $_POST[$joined_string]);			
			}
			
			
			if($flag_auth != "true")
			{
				break;
			}

			
			if($firstcount_value == 0)	
			{
				$value_string .= "'".addslashes($_POST[$joined_string])."'";		         
			}
			else 
			{
				$value_string .= ", '".addslashes($_POST[$joined_string])."'";		         
			}
			
			$firstcount_value++;
		}
		
		//////////CREATING A VARIABLE-VALUE UPDATE STRING
		$numvariable = count($array_select);
		$updatevar_count  = 0;
		foreach($array_select[$tablename] as $variname)
		{
			/// GETTING THE POST NAME
			$joined_string = $tablename."|".$variname;
			
			$uvalue_string = "'".addslashes($_POST[$joined_string])."'";		         
			$uvariable_string = $variname;		         
						
			
			if ($variname === end($array_select[$tablename])) {
					$update_string .= $uvariable_string.'='.$uvalue_string.'';
			  }
			else{
				$update_string .= $uvariable_string.'='.$uvalue_string.',';
			}
		}
		
		if($flag_auth == "true"){
		include("connect.php");	

				$sql = "INSERT INTO ".$tablename." (".$variable_string.")
				VALUES (".$value_string.")  ON DUPLICATE KEY UPDATE " . $update_string;
	
				if ($conn->query($sql) === TRUE) {
					//echo "New record created successfully";
				} else {
					echo "Error: " . $sql . "<br>" . $conn->error;die();
					$error_mysql = '
								<div class="alert alert-danger">
							<strong>Error!</strong> Cannot Save. Please check the details you have entered.
							</div>
					';
				}

				$conn->close();				
		}
		else
		{
			$error_mysql = '<div class="alert alert-danger">
							<strong>Error!</strong> '.$flag_auth.'
							</div>';		
								break;
		}					
		}
						
				
			
	}
	else
		{
			$error_mysql = '<div class="alert alert-danger">
							<strong>Error!</strong> '.$flag_auth.'
							</div>';				
		}

	}
	
?>