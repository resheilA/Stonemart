<?php

include_once("header.php");
include("../getalldata.php"); 
	if(isset($_SESSION["did"]))
	{
	$did = $_SESSION["did"];
	}
	else
	{
	echo "<script>window.location.replace('https://stonemarket.in/website_creator/searchdomain.php');</script>";
	}
	
	if($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$_POST["website_design|banner_element"]= rand(1,2); 
		$_POST["website_design|about_us_page"]= rand(1,2); 
		$_POST["website_design|products_page"]= rand(1,2); 
		$_POST["website_design|team_page"]= rand(1,3); 
		$_POST["website_design|gallery_page"]= 1;
		$_POST["website_design|clients_page"]= 1; 
		$_POST["website_design|contact_us_page"]= rand(1,5) ;
		$_POST["website_design|navbar_element"]= 1; 
		$_POST["website_design|footer_element"]= rand(1,4); 
		$_POST["website_design|services_element"]= rand(1,9); 
		$_POST["website_design|about_us_element"]= 1; 
		$_POST["website_design|products_element"]= rand(1,4); 
		include_once("../saveupdate.php");
		
	}

	
?> 
<br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Setting For Seller Website</h2>
  <hr>
  
	  
	<h4>Choose Colors For Your Website
	
	</h4><hr>	
	
	 <div class="form-group">
	 <form method="post">
	 <input type="hidden" name="website_design|did" value="<?php echo $did; ?>">
	 
	  <h4>Designs </h4>
	   Change the design of your website ?	   
	   <input type="submit" class="float-right" value="Change the design">
	  </form>

	
	<hr>
</div>
</div>
</div>

<?php include("footer.php"); ?>