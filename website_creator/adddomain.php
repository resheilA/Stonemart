<?php include_once("../functions.php");?>
<?php include_once("header.php"); 
if($_SERVER["REQUEST_METHOD"] == "POST")
{	var_dump($_SESSION);
	include_once("../saveupdate.php");
}
?>
<!-----Navbar End------->
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Add an existing domain name</h2>
  <hr>
  


  
  <?php if(isset($error_mysql)){echo $error_mysql;} $did = generateRandomString();?>
	
	<h4 style="display:inline;">Add A Domain</h4>	
	<hr>
	<div class='row'>
	<form method="post" enctype="multipart/form-data">					
				 <div class="form-group">
				 <input type="hidden" name="website_domain|uid" value="<?php echo $_SESSION["uid"]; ?>">	 
				 <input type="hidden" name="website_domain|did" value="<?php echo $did; ?>">	 
				  Enter your domain name<br>
				 <input type="text" name="website_domain|domain_name" placeholder="Text on the banner"><br>				  
							  
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