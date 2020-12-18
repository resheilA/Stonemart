<?php include("header.php"); ?>
<?php 
if(isset($_GET['id']) && $_GET['id'] != null)
  {
	$search = $_GET['id'];
  }
  elseif(isset($_SESSION['uid']) && $_SESSION['uid'] != null)
  {
	$search = $_SESSION['uid'];
  }
  else
  {	  
	header("location:seller.php");
  }
 ?>

<br><br><br><br><br>

<h1 class="pl-3 mt-4"> Manage Your Website </h1>
<div class="pl-3 pr-3">
<?php 
if(isset($_SESSION["uid"]))
				if($search == $_SESSION["uid"])
				{
					echo '  <a href="website_creator/searchdomain.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Domain Name</button></a>	
							<a href="website_creator/get_info.php"><button class="btn btn-lg m-1"
							style="display:inline;color:white;">Client And Gallery</button></a>	
							<a href="editseller.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">About Us</button></a>					
							<a href="listproducts.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Edit Products</button></a>					
							<a href="addproduct.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Add Products</button></a>									
							<a href="website_creator/get_colors.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Colors</button></a>		
							<a href="website_creator/get_services.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Services</button></a>		
							<a href="website_creator/get_team.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Team</button></a>
							<a href="website_creator/get_team.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Website Design</button></a>	
							<a href="website_creator/get_team.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Settings</button></a>		
						';
				}
				
?>
</div>
<hr>