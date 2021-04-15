<?php include_once("../functions.php");?>
<?php include_once("header.php");
	if(isset($_SESSION["did"]))
	{
	$did = $_SESSION["did"];
	}
	else
	{
	echo "<script>window.location.replace('https://stonemarket.in/website_creator/searchdomain.php');</script>";
	}

include("../getsingledata.php"); 
	$sql = "SELECT * FROM website_banner where did = '".$did."'";
	$banner_data = singletable( $sql );		
	
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	include_once("../saveupdate.php");
}
?>
<!-----Navbar End------->
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Edit A Seller Website</h2>
  <hr>
  


  
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
	
	<h4 style="display:inline;">Add A Banner</h4>
		<p> Adding more than one image will lead to a slideshow automatically </p>
	<hr>
	<div class='row'>
	<form method="post" enctype="multipart/form-data">					
				 <div class="form-group">
				 <input type="hidden" name="website_banner|did" value="41DWF242D">	 
				  Add a banner to your website<br>
				  <input type="text" name="website_banner|banner_text_1" value="<?php if(isset($banner_data)){echo$banner_data["banner_text_1"];}?>" placeholder="Text on the banner"><br>
				  Current Image<br>
				  <?php if(isset($banner_data)){echo "<img height='100' src='".$banner_data["banner_image_1"]."'";}?>>
				  <input type="file" class="form-control mt-2" name="website_banner|banner_image_1|0|website/banner/242CDKMC" value="<?php if(isset($banner_data)){echo$banner_data["banner_image_1"];}?>" placeholder="Add a banner image">
				  <br><hr>
				  Add a banner to your website<br>
				  <input type="text" name="website_banner|banner_text_2" value="<?php if(isset($banner_data)){echo$banner_data["banner_text_2"];}?>" placeholder="Text on the banner"><br>	  
				  Current Image<br>
				  <?php if(isset($banner_data)){echo "<img height='100' src='".$banner_data["banner_image_2"]."'";}?>>
				  <input type="file" class="form-control mt-2" name="website_banner|banner_image_2|0|website/banner/242CDKMC" placeholder="Add a banner image">
				  <br><hr>
				  Add a banner to your website<br>
				  <input type="text" name="website_banner|banner_text_3" value="<?php if(isset($banner_data)){echo$banner_data["banner_text_3"];}?>" placeholder="Text on the banner"><br>	
				  Current Image<br>
				  <?php if(isset($banner_data)){echo "<img height='100' src='".$banner_data["banner_image_3"]."'";}?>>
				  <input type="file" class="form-control mt-2" name="website_banner|banner_image_3|0|website/banner/242CDKMC" placeholder="Add a banner image">				  
				<hr>
 				  </div>	  	  	  			
				  <input type="submit" class="btn btn-danger" value="Submit">
			</form>
	</div>
	<hr>

	

	
	  	
  </div>
</div>
</center>
   <!-- Footer -->
<br>
   <?php include_once("footer.php");?>