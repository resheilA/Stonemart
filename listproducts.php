<?php include_once("header.php");


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
	
?>
	

<!--Products-->
<section class="product" style="padding-top: 8em;">
    <div class="container mt-4">        
<h3 class="pl-3">List Of Product </h3>        

<div class="container" width="100%">
  <div class="row">
    <div class="col-lg-12 mx-auto">
	   <!-- List group-->


<div class="container">
						<form class="form-inline"  style="display:inline;"  method="get">
						<input type="hidden" name="id" value="<?php echo $search; ?>">
							<select name="type_sort" class="form-control " style="display:inline;">
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
					</div>
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
							 INNER JOIN product_name ON seller_product.product_name = product_name.no 
							 INNER JOIN product_type ON seller_product.type_id = product_type.no			 							 
							 WHERE seller_product.uid = '".$search."'	
							 AND product_type.type LIKE '%".$type_sort."%'
							 )
							 ";
							 
				$sellers = singletable_all( $sql );
				
				
				if(!isset($sellers["error"]) && isset($sellers))
				{
		
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
								  
								  
								  <div class="d-flex align-items-center justify-content-between mt-1">
									<p><i class="fa fa-cart-arrow-down"></i> MOQ - '.$product["moq"].'</p>
<p><a href="editproduct.php?pid='.$product["pid"].'"><button class="btn">Edit</button></a>
<a href="deleteproduct.php?pid='.$product["pid"].'" onclick="javascript:return confirm(\'Are you sure you want to delete?\');"><button class="btn">Delete</button></a></p>
								  </div>
								</div><img src="'.$product["image"].'" alt="Generic placeholder image" width="200"  class="ml-lg-5 order-1 order-lg-2" data-toggle="modal" data-target="#imageModal" onclick="zoomimage(\''.$product["image"].'\')">
							  </div>
							  <!-- End -->
							</li>
							<!-- End -->

								';
						}
						
				}	
				else
				{
						echo "<div class='p-4'>No results found. Please try searching something else.</div>";	
				}					
					?>	   


    </div>
  </div>
</div>


</section>

<?php include_once("footer.php"); ?>