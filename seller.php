<?php
    //FOR LOCKING THE USER PROFILE
	if(!isset($_COOKIE["userName"]) || !isset($_COOKIE["userContact"]))
	{
	//	header("Location:listsellers.php?id=".$_SESSION["AUTH_ID"]."&pid=".$_SESSION["AUTH_PID"]);
	}
	
	
		
	if((isset($_COOKIE["userName"]) && isset($_COOKIE["userContact"]))){
		
	require_once("functions.php");	

	$uri = $_SERVER['REQUEST_URI'];
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://"; 
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	$activity = "Visited Page : ".$url;

	if(isset($_GET["id"])){
	$seller_id = $_GET["id"];
	}
	else{
	$seller_id = "";
	}
	
	if(isset($_GET["pid"])){
	$product_id = $_GET["pid"];
	}
	else{
	$product_id = "";
	}
	
	
	logAction($_COOKIE["userContact"], $_COOKIE["userName"], $activity, $seller_id, $product_id);
	}


	 include_once("header.php"); 	 
?>
<br><br><br><br><br><br>
<div class="container" width="100%">
  <div class="row">
    <div class="col-lg-12 mx-auto">
	   <!-- List group-->
      <ul class="list-group shadow">

   
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
	$search = "dGU56YX4fn";  
  }
	include("getsingledata.php"); 
	include("getalldata.php"); 
	
	$sql = "SELECT * FROM seller_general
			 INNER JOIN seller_location ON seller_general.uid = seller_location.uid			 
			 INNER JOIN seller_certification ON seller_general.uid = seller_certification.uid
			 INNER JOIN seller_business ON seller_general.uid = seller_business.uid			 
			 INNER JOIN seller_contact ON seller_general.uid = seller_contact.uid			 
			 WHERE seller_general.uid = '".$search."'
			 ";
			 
	$sellers = singletable_all( $sql );
	/*
	echo "<pre>";
	var_dump($sellers);
	echo "</pre>";
	*/
	
	if(!isset($sellers["error"]))
	{
	foreach($sellers as $seller)
	{
			
			//FOR LOGO 
			if(!$seller["logo"]){
				$seller["logo"] = "img/logo.png";
			}
			
			
			echo '
			   <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row">
            <div class="media-body order-2 order-lg-1">
              <h2 class="mt-0 font-weight-bold mb-2 mt-2">'.$seller["name"].'</h2>
              <p class="font-italic text-muted mb-0 medium">'.mb_strimwidth("<i class='fa fa-map-marker-alt'></i>  ".$seller["address"] , 0, 200, "...").'</p>
              <div class="d-flex align-items-center justify-content-between mt-1">			
                <ul class="list-inline small">
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star-o text-gray"></i></li>
                </ul>
              </div>
			   <h6 class="font-weight-bold my-2"><i class="fa fa-user"></i> '.$seller["ceo"].'&nbsp <i class="fa fa-industry"></i>  '.ucfirst($seller["nature_of_business"]).' </h6>
				';
				
				if(isset($_SESSION["uid"]))
				if($search == $_SESSION["uid"])
				{
					echo '
							<a href="editseller.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Edit Profile</button></a>	
							<a href="addproduct.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Add Products</button></a>					
							<a href="listproducts.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Edit Products</button></a>					
							<a href="managewebsite.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Manage Website</button></a>		
							<a href="listproducts.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Analytics</button></a>		
							
						';
				}
				if(isset($seller['logo']) && $seller['logo'] != null)
				{
				echo '
            </div><img src="'.$seller['logo'].'" alt="No Image" width="200" class="ml-lg-5 order-1 order-lg-2">
          </div>		  
          <!-- End -->
        </li>
        <!-- End -->

			';
				}
	}
	}
	else
	{
			echo "<div class='p-4'>No results found. Please try searching vendor name.</div>";exit;
	}
	
?>


      </ul>
      <!-- End -->
    </div>
  </div>
</div>


<div class="container mb-5">
              <div class="row">
                <div class="col-lg-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">About us</a>
                      <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Products</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Contact us</a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="p-3 tab-pane fade show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<?php echo "".$seller['about_us'].""; ?>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					  <h3>&nbsp Business Details</h3>
					  <table border='1' class="table" style="">
						<tbody>
						<tr>
							<td>Nature Of Business</td><td><?php echo "".$seller['nature_of_business'].""; ?></td>
						</tr>
						<tr>
							<td>GST Number</td><td><?php echo "".$seller['gstnumber'].""; ?></td>
						</tr>
						<tr>	
							<td>CEO</td><td><?php echo "".$seller['ceo'].""; ?></td>
						</tr>
						<tr>	
							<td>Number Of Employee</td><td><?php echo "".$seller['employee'].""; ?></td>
						</tr>
						<tr>	
							<td>Establisment Year</td><td><?php echo "".$seller['establishment_year'].""; ?></td>
						</tr>						
						<tr>	
							<td>Firm Status</td><td><?php echo "".$seller['firm_status'].""; ?></td>
						</tr>
						</tbody>
					  </table>		
                      <h3>&nbsp Certification</h3>
					  <?php echo '<img src="'.$seller['gstin'].'" style="display:inline; max-width:300px;"class=" pr-5 img-fluid" style="display:inline;"></img>'; 
					  echo '<img src="'.$seller['other'].'" style="display:inline; max-width:300px;" class="pl-5 img-fluid"></img>'; 
					  ?>
                    </div>
                    <div class="tab-pane active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<div class="container">
						<form class="form-inline"  style="display:inline;"  method="get">
						<input type="hidden" name="id" value="<?php echo $search; ?>">
							<select name="type_sort" class="form-control " style="display:inline;max-width:60%;">
								<option></option>
								<?php 
								
								$sql_color = "SELECT type FROM product_type";
								$types = singletable_all( $sql_color );
								
								foreach($types as $type){
									echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
								}
								
								?>
							</select>
					   <input type="submit"  style="display:inline;" class="btn text-light m-1" value="Sort"></form>     
					</div><br><br>
					<?php 
					
					if(isset($_GET['type_sort']) && ($_GET['type_sort'] != null))
					{
					$type_sort = $_GET['type_sort'];	
					}
					else
					{
					$type_sort = "";
					}
					
					if(isset($_GET['pid']) && ($_GET['pid'] != null))
					{
					$addsql = "(
							 SELECT * FROM seller_product 
							 INNER JOIN product_color ON seller_product.color = product_color.no 
							 INNER JOIN product_application ON seller_product.application_area = product_application.no 
							 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
							 INNER JOIN product_form ON seller_product.form = product_form.no 
							 INNER JOIN product_minprice ON seller_product.min_price = product_minprice.no 
							 INNER JOIN product_maxprice ON seller_product.max_price = product_maxprice.no 
							 INNER JOIN product_name ON seller_product.product_name = product_name.no 
							 INNER JOIN product_type ON seller_product.type_id = product_type.no			 							 
							 WHERE seller_product.uid =  '".$search."' 
							 AND seller_product.pid = '".$_GET['pid']."'
							 )
							 union all
							 ";
					}
					else
					{
					$addsql = "";	
					}
				
					 $sql = $addsql."
							 (
							 SELECT * FROM seller_product
						     INNER JOIN product_color ON seller_product.color = product_color.no 
							 INNER JOIN product_application ON seller_product.application_area = product_application.no 							 
							 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
							 INNER JOIN product_form ON seller_product.form = product_form.no
							 INNER JOIN product_minprice ON seller_product.min_price = product_minprice.no 
							 INNER JOIN product_maxprice ON seller_product.max_price = product_maxprice.no 							 
							 INNER JOIN product_name ON seller_product.product_name = product_name.no 
							 INNER JOIN product_type ON seller_product.type_id = product_type.no			 												
							 WHERE seller_product.uid = '".$search."'	
							 AND product_type.type LIKE '%".$type_sort."%'
							 LIMIT 12
							 )
							 ";
							 
				$sellers = singletable_all( $sql );
				
				if(!isset($sellers["error"])){
                     	foreach($sellers as $product)
						{
							if(isset($_GET["pid"])){
							if($product["pid"] != $_GET['pid'])
							{
								$selected = "";								
							}
							else
							{
								$selected = "border:2px solid black;";
							}
							}else
							{
								$selected = "";
							}
								
								echo '
								   <!-- list group item-->
							<li class="list-group-item" style="'.$selected.'">
							  <!-- Custom content-->
							  <div class="media align-items-lg-center flex-column flex-lg-row p-3" >
								<div class="media-body order-2 order-lg-1">
								  <h4 class="mt-0 font-weight-bold mb-2">'.$product["product_name"].' - '.$product["color"].'</h4>
								  <p class="mt-0 font-weight-bold mb-0"><i class="fa fa-th-large"></i> '.$product["type"].' &nbsp <i class="fa fa-square"></i> '.$product["form"].'
								  </p>
								  <p class="text-muted mb-0">'.mb_strimwidth($product["details"], 0, 200, "...").'</p>
								  
								  <p class="mt-0  mb-0">Application Area - '.$product["application_area"].'</p>								  
								  <p class="mt-0  mb-0">Finishing - '.$product["finishing"].'</p>
								  <p class="mt-0  mb-0">Size - '.$product["size"].' &nbsp Thickness - '.$product["thickness"].'</p>
								  <p class="mt-0  mb-0">Price Range - Rs '.$product["min_price"].' - Rs '.$product["max_price"].' &nbsp</p>
								  
								  <div class="d-flex align-items-center justify-content-between mt-1">
									<p><i class="fa fa-cart-arrow-down"></i> MOQ - '.$product["moq"].'</p>																		
								  </div>
								</div><img src="'.$product["image"].'" alt="Generic placeholder image" width="200"  class="ml-lg-5 order-1 order-lg-2" data-toggle="modal" data-target="#imageModal" onclick="zoomimage(\''.$product["image"].'\')">
							  </div>
							  <!-- End -->
							</li>
							<!-- End -->

								';
						}
						echo "<center><a href='listsellerproducts.php?page=1&id=".$search."'><button class='btn-lg'>View all products</button></a></center>";
				}
				else
				{
					echo "<div class='p-4'>No Products Listed By The Company.</div>";
				}
					?>
					
                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
						<h3>&nbsp Contact Details</h3>						
					  <table border='1' class="table" style="">
						<tbody>
						<tr>
							<td>Contact Name</td><td><?php echo "".$seller['contact_name'].""; ?></td>
						</tr>
						<tr>
							<td>Instagram</td><td><?php echo "".$seller['instagram'].""; ?></td>
						</tr>
						<tr>	
							<td>Facebook</td><td><?php echo "".$seller['facebook'].""; ?></td>
						</tr>
						<tr>	
							<td>Twitter</td><td><?php echo "".$seller['twitter'].""; ?></td>
						</tr>
						<tr>	
							<td>Contact no</td><td>+91 <?php echo "".$seller['contact_no'].""; ?></td>
						</tr>
						<tr>	
							<td>Other Number</td><td>+91 <?php echo "".$seller['other_number'].""; ?></td>
						</tr>						
						</tbody>
					  </table>		
                    </div>
                  </div>
                
                </div>
              </div>
        </div>
      </div>
</div>


<!-- The Modal -->
<div class="modal mt-5" id="imageModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <img src="" id="modalimage" class="img-fluid"/>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
function zoomimage(imgsrc){
	$("#modalimage").attr("src",imgsrc);
}
</script>
<?php include_once("footer.php"); ?>