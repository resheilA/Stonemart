<?php
include_once("../saveupdate.php");
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

	
?> 

include_once("../saveupdate.php");
include_once("header.php");
include("../getalldata.php"); 
	if(isset($_SESSION["did"]))
	{
	$did = $_SESSION["did"];
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
	  <!-- The Modal -->
	<div class="modal" id="choosecolor">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Upload A Logo Of Your Client</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			
			
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			
		  </div>

		</div>
	  </div>
	</div>
	
	<hr>
</div>
</div>
</div>

<?php include("footer.php"); ?>