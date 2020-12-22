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
	header("location:https://stonemarket.in/website_creator/searchdomain.php");	
	}

 
	$sql = "SELECT * FROM website_general WHERE did = '".$did."'";
			 
	$website_colors = singletable_all( $sql );	
	$website_color = $website_colors[0];

	
?> 
<br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Edit A Seller Website</h2>
  <hr>
  
	  
	<h4>Choose Colors For Your Website
	
	<!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#choosecolor">
	  Choose
	</button>
	</h4><hr>	
	
	 <div class="form-group">
	 <form method="post">
	 <input type="hidden" name="website_general|did" value="<?php echo $did; ?>">
	 <div class="form-group">
	 <label>Choose a color</label>		
		<input type="color" class="form-control" name="website_general|primary_color_code" placeholder="Enter your mobile number" value="<?php echo $website_color["primary_color_code"]; ?>" >
	  </div>
	 <div class="form-group">
		<label>Choose another color for combination</label>
		<input type="color" class="form-control" name="website_general|secondary_color_code" placeholder="Contact Person Name" value="<?php echo $website_color["secondary_color_code"]; ?>">
	  </div>
	  <div class="form-group">
		<label>Choose font color</label>
		<input type="color" class="form-control" name="website_general|font_color_code" placeholder="Contact Person Name" value="<?php echo $website_color["font_color_code"]; ?>">
	  </div>
	  <input type="submit" class="btn float-right" value="Save">
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
