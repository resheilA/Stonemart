<?php include_once("header.php"); ?>
<?php 
	
	include_once("../savedata.php"); include_once("../functions.php");
	if(isset($_SESSION["did"]))
	{
	$did = $_SESSION["did"];
	}
	else
	{
	header("location:https://stonemarket.in/website_creator/searchdomain.php");	
	}
	
	if(isset($_GET['remove']) && $_GET['remove'] != null)
	{
		
	include_once("../deletedata.php");
		if($_GET['remove'] == 1)
		{
			$sql = "DELETE FROM website_clients WHERE no = '".$_GET['no']."' AND did = '".$did."'";
			
			/////////////// DELETING A FILE FROM THE SERVER
			include("../getsingledata.php"); 
			$sqldelete = "SELECT * FROM website_clients
				 WHERE no = '".$_GET['no']."' 
				 ";
				 
			$gallery = singletable( $sqldelete );		
			//var_dump($gallery);
			if(!isset($gallery["error"]))
			{
			$file_pointer = $gallery['client_logo'];  
		   
			// Use unlink() function to delete a file  
			if (!unlink($file_pointer)) {  
			//	echo ("$file_pointer cannot be deleted due to an error");  
			}  
			else {  
			//	echo ("$file_pointer has been deleted");  
			}
			}
		}
		if($_GET['remove'] == 2)
		{
			$sql = "DELETE FROM website_gallery WHERE no = '".$_GET['no']."' AND did = '".$did."' ";
			
			/////////////// DELETING A FILE FROM THE SERVER
				include("../getsingledata.php"); 
				$sqldelete = "SELECT * FROM website_gallery
					 WHERE no = '".$_GET['no']."' 
					 ";
					 
				$gallery = singletable( $sqldelete );		
				
				if(!isset($gallery["error"]))
				{
					$file_pointer = $gallery['images'];  
				   
					// Use unlink() function to delete a file  
					if (!unlink($file_pointer)) {  
					//	echo ("$file_pointer cannot be deleted due to an error");  
					}  
					else {  
					//	echo ("$file_pointer has been deleted");  
					}  
				}
		}		
			
		deleterow($sql, 1);
	}
	
	if(isset($_GET['id']) && $_GET['id'] != null)
	  {
		$search = $_GET['id'];
	  }
	  else
	  {
		$search = "dGU56YX4fn";  
	  }	 
	include("../getalldata.php"); 
	
	$sql = "SELECT * FROM website_clients
			 WHERE website_clients.did = '41DWF242D'			 
			 ";
			 
	$client_logos = singletable_all( $sql );	

	$sql = "SELECT * FROM website_gallery
			 WHERE website_gallery.did = '41DWF242D'			 
			 ";
			 
	$client_gallery = singletable_all( $sql );

	$sql = "SELECT * FROM website_service_content";
			 
	$website_services = singletable_all( $sql );	
	
	
	$sql = "SELECT * FROM website_services INNER JOIN website_service_content ON website_services.service_id = website_service_content.no";
			 
	$web_service = singletable_all( $sql );	
?>

<!-----Navbar End------->
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Edit A Seller Website</h2>
  <hr>
  


  
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
	
	<h4 style="display:inline;">Add Your Clients to the Website</h4>
		
	<!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#myModal">
	  Add new
	</button>

	<!-- The Modal -->
	<div class="modal" id="myModal">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Upload A Logo Of Your Client</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			
			<form method="post" enctype="multipart/form-data">					
				 <div class="form-group">
				 <input type="hidden" name="website_clients|did" value="41DWF242D">	 
				  Upload Your Clients to the Website : 	  
				  <input type="file" class="form-control mt-2" name="website_clients|client_logo|0|website/client/242CDKMC" placeholder="Enter your client logo">		  
				<hr>
 				  </div>	  	  	  			
				  <input type="submit" class="btn btn-danger" value="Submit">
			</form>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			
		  </div>

		</div>
	  </div>
	</div>
	<hr>
	<div class='row'>
	<?php 
	
	foreach($client_logos as $logo)
	{		
		if(isset($logo["client_logo"]))
		{
		echo "
		<div class='col'><center>
		<img src='".$logo["client_logo"]."' style='max-width:100px;margin:10px;' /><br><a href='?remove=1&no=".$logo["no"]."'>Remove</a></center>
		</div>
		";
		}
	}
	?>
	</div>
	<hr>

	
	<h4 style="display:inline;">Add Image Gallery to Your Website</h4>
		
	<!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#gallery">
	  Add new
	</button>

	<!-- The Modal -->
	<div class="modal" id="gallery">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Upload An Image</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">
			
			<form method="post" enctype="multipart/form-data">					
				 <div class="form-group">
				 <input type="hidden" name="website_gallery|did" value="41DWF242D">	 
				  Upload Your Gallery to the Website : 	  
				  <input type="file" class="form-control mt-2" name="website_gallery|images|0|website/gallery/242CDKMC" placeholder="Upload Image">		  
				<hr>
 				  </div>	  	  	  			
				  <input type="submit" class="btn btn-danger" value="Submit">
			</form>
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			
		  </div>

		</div>
	  </div>
	</div>
	<hr>
	<div class='row'>
	<?php 
	foreach($client_gallery as $image)
	{
		if(isset($image["images"]))
		{
		echo "		
		<div class='col'><center>
		<img src='".$image["images"]."' style='max-width:100px;margin:10px;' /><br><a href='?remove=2&no=".$image["no"]."'>Remove</a></center>
				</div>		
		";
		}
	}
	?>
	</div>
	
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
	
	  	
  </div>
</div>
</center>
   <!-- Footer -->
<br>
   <?php include_once("footer.php");?>