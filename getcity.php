<?php 

if($_SERVER["REQUEST_METHOD"] == "POST")
{
	//var_dump($_POST);
	if(isset($_POST["pin"]))
	{
		$fullcodes = json_decode(file_get_contents("https://api.postalpincode.in/pincode/".$_POST['pin']), true);
		//var_dump($fullcodes);
		if($fullcodes[0]["Status"] == "Success")
		{
			if($fullcodes[0]["Status"] == "Success")
			{
				echo $fullcodes[0]["PostOffice"][0]["Region"].",".$fullcodes[0]["PostOffice"][0]["State"];
			}
		}
	}
}

?>