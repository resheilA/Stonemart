<?php
include_once("header.php");  
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
	$_POST["website_team|did"] = $did;
	include_once("../saveupdate.php"); 
}


if(isset($_GET["q"]) && $_GET["q"] == "d" && isset($_GET["id"]))
{
	include("../getsingledata.php"); 
	$sql = "SELECT * FROM website_team where did = '".$did."' AND no= '".$_GET["id"]."'";
	$member_data = singletable( $sql );		
	unlink($member_data["member_image"]);	
	include_once("../deletedata.php");
	$sql = "DELETE FROM website_team where did = '".$did."' AND no= '".$_GET["id"]."'";
	deleterow($sql, 1);	
	header("location:get_team.php");
}	



include_once("../functions.php");

include("../getalldata.php"); 
	$sql = "SELECT * FROM website_team WHERE  did = '".$did."'";
			 
	$website_team = singletable_all( $sql );	


?>
<br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Edit A Seller Website</h2>
  <hr>
  
<h4>Add Details About The Team
		
	<!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#addmember">
	  Add
	</button>
	</h4>
<br>
<table class="table">
	<tbody>		
			<?php 
			if(!isset($website_team["error"])){
				foreach($website_team as $member)
				{
					echo "<tr>
								<td><img src='".$member["member_image"]."' style='max-height:2.5em;' /></td>
								<td>".$member["member_name"]."</td>
								<td data-toggle='modal' data-target='#editmember".$member["no"]."'><button>Edit</button></td>		
								<td><a href='?q=d&id=".$member["no"]."'><button>Delete</button></a></td>										
						 </tr>";
				}
				
			}	
			else
			{
				echo "<td>Add a team member from top right corner</td>";
			}
			?>		
	</tbody>
</table>	
</table>
	
			<?php 
			if(!isset($website_team["error"])){
				foreach($website_team as $member)
				{ 
				echo '
				<!-- The Modal -->
					<div class="modal" id="editmember'.$member["no"].'">
					  <div class="modal-dialog">
						<div class="modal-content">

						  <!-- Modal Header -->
						  <div class="modal-header">
							<h4 class="modal-title">Add Members To Your Team</h4>
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						  </div>

						  <!-- Modal body -->
						  <div class="modal-body">		
							<form method="post" enctype="multipart/form-data">				
							  <img src="'.$member["member_image"].'" style="max-height:2.5em;"/> Current Member Image 
							  <input type="hidden" name="website_team|no" value="'.$member["no"].'">
							  <input type="hidden" value="'.$member["member_image"].'" class="form-control mt-2" name="website_team|member_image" placeholder="Upload Image">
							  <br><br>Choose to change
							  <input type="file" class="form-control mt-2" name="website_team|member_image|0|website/team/'.$did.'" placeholder="Upload Image">
							  
							  <br>
							  <label class="form-check-label">Member Name</label><br>
										<input type="text" name="website_team|member_name" value="'.$member["member_name"].'"><br><br>
							  </label>
							  <label class="form-check-label">Member Position</label><br>
										<input type="text" name="website_team|member_pos" value="'.$member["member_pos"].'"><br><br>
							  </label>
							  <label class="form-check-label">Member Description</label><br>
										<textarea name="website_team|member_desc">'.$member["member_desc"].'</textarea><br><br>
							  </label>
							  <input type="submit" value="Save Changes">
							</form>
									
						  </div>

						  <!-- Modal footer -->
						  <div class="modal-footer">
							
						  </div>

						</div>
					</div>
					</div>';
				}
			}
?>
<!-- The Modal -->
	<div class="modal" id="addmember">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Add Members To Your Team</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">		
			<form method="post" enctype="multipart/form-data">				
			  Upload Member Image 
			  <input type="file" class="form-control mt-2" name="website_team|member_image|0|website/team/<?php echo$did; ?>" placeholder="Upload Image">	
			  <br>
			  <label class="form-check-label">Member Name</label><br>
						<input type="text" name="website_team|member_name"><br><br>
			  
			  <label class="form-check-label">Member Position</label><br>
						<input type="text" name="website_team|member_pos"><br><br>
			  
			  <label class="form-check-label">Member Description</label><br>
						<textarea name="website_team|member_desc"></textarea><br><br>
			  
			  <input type="submit" value="Add Member">
			</form>
					
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			
		  </div>

		</div>
	</div>
	</div>
	
</div></div>	
<?php include("footer.php"); ?>	