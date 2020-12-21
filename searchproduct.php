<?php include_once("header.php");

include("functions.php");

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
	
	$pincode = $_COOKIE["user_city"];
		 
	   if(isset($_GET["search"]) && $_GET["search"] != null){ 
	   $search = RemoveSpecialChar(urldecode($_GET["search"]." in ".$pincode));
	   }
	   else{$search = "";}
?>

	
<?php 
$no_of_records = 12;

//PAGINATION
if(!isset($_GET["page"]))
{
	$_GET["page"] = 1;
}


if($_GET["page"] == 1){
	$record_min = 0;	
}
else{
$record_min = ($_GET["page"] * $no_of_records ) - $no_of_records;
$record_max = ($_GET["page"] * $no_of_records );
}

$sql_count = "SELECT COUNT(*) as total_records FROM seller_product";
if(isset($_GET["search"]) && $_GET["search"] != null)
{
$sql_count = "SELECT COUNT(*) as total_records,
						MATCH(product_color.color) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_COLOR,						
						MATCH(product_type.type) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_TYPE,
						MATCH(product_name.product_name) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_NAME,
						MATCH(product_application.application_area) AGAINST ('".$search."*' IN BOOLEAN MODE)	AS SCORE_APPLICATION,		 
						MATCH(product_finishing.finishing) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_FINISH,
						MATCH(product_form.form) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_FORM,
						MATCH(seller_general.name) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_GNAME,			 
						MATCH(seller_location.address) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_LOCATION,
						MATCH(seller_location.city) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_PINCODE
					 FROM seller_product
					 INNER JOIN product_color ON seller_product.color = product_color.no 
					 INNER JOIN product_application ON seller_product.application_area = product_application.no 
					 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
					 INNER JOIN product_form ON seller_product.form = product_form.no 
					 INNER JOIN product_type ON seller_product.type_id = product_type.no
					 INNER JOIN product_name ON seller_product.product_name = product_name.no
					 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
					 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 
					 WHERE 
					 MATCH (product_color.color) AGAINST ('".$search."*' IN BOOLEAN MODE) 
					 OR MATCH(product_type.type) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(product_name.product_name) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(product_application.application_area) AGAINST ('".$search."*' IN BOOLEAN MODE)			 
					 OR MATCH(product_finishing.finishing) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(product_form.form) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(seller_general.name) AGAINST ('".$search."*' IN BOOLEAN MODE)			 
					 OR MATCH(seller_location.address) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(seller_location.city) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 ORDER BY SCORE_PINCODE ASC					 
					 ";			
}		

 
  if(isset($_GET["color_sort"]) && $_GET["color_sort"] != null){$color_sort = $_GET["color_sort"];}else{$color_sort = "";}
  if(isset($_GET["type_sort"]) && $_GET["type_sort"] != null){$type_sort = $_GET["type_sort"];}else{$type_sort = "";}
  if(isset($_GET["form_sort"]) && $_GET["form_sort"] != null){$form_sort = $_GET["form_sort"];}else{$form_sort = "";}
  if(isset($_GET["color_finish"]) && $_GET["color_finish"] != null){$color_finish = $_GET["color_finish"];}else{$color_finish = "";}
  if(isset($_GET["location_sort"]) && $_GET["location_sort"] != null){$location_sort = $_GET["location_sort"];}else{$location_sort = "";}
  if(isset($_GET["min_price"]) && $_GET["min_price"] != null){$min_price = $_GET["min_price"];}else{$min_price = "> 0";}
  if(isset($_GET["max_price"]) && $_GET["max_price"] != null){$max_price = $_GET["max_price"];}else{$max_price = "> 0";}

if(!empty($color_sort) || !empty($type_sort)  || !empty($form_sort)  || !empty($color_finish)){
	$sql_count = "SELECT COUNT(*) as total_records FROM seller_product			 
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_name ON seller_product.product_name = product_name.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN product_minprice ON seller_product.min_price = product_minprice.no
			 INNER JOIN product_maxprice ON seller_product.max_price = product_maxprice.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 			 
			 WHERE 
			 product_color.color LIKE '%".$color_sort."%'			 
			 AND product_type.type LIKE '%".$type_sort."%'
			 AND seller_location.city LIKE '%".$location_sort."%'
			 AND product_finishing.finishing LIKE '%".$color_finish."%'
			 AND product_form.form LIKE '%".$form_sort."%'	
			 AND product_minprice.min_price ".$min_price."
			 AND product_maxprice.max_price ".$max_price."
			 AND seller_location.city LIKE '%".$pincode."%'"	
			 ;
}
	
$records = singletable( $sql_count );
//var_dump($records);
$page = ceil($records["total_records"] / $no_of_records);
?>	

<?php 

// SEARCH SQL 
if((isset($_GET["search"]) && $_GET["search"] != null))
{
	$sql = "SELECT *,
						MATCH(product_color.color) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_COLOR,						
						MATCH(product_type.type) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_TYPE,
						MATCH(product_name.product_name) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_NAME,
						MATCH(product_application.application_area) AGAINST ('".$search."*' IN BOOLEAN MODE)	AS SCORE_APPLICATION,		 
						MATCH(product_finishing.finishing) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_FINISH,
						MATCH(product_form.form) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_FORM,
						MATCH(seller_general.name) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_GNAME,			 
						MATCH(seller_location.address) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_LOCATION,
						MATCH(seller_location.city) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_PINCODE
					 FROM seller_product
					 INNER JOIN product_color ON seller_product.color = product_color.no 
					 INNER JOIN product_application ON seller_product.application_area = product_application.no 
					 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
					 INNER JOIN product_form ON seller_product.form = product_form.no 
					 INNER JOIN product_type ON seller_product.type_id = product_type.no
					 INNER JOIN product_name ON seller_product.product_name = product_name.no
					 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
					 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 
					 WHERE 
					 MATCH (product_color.color) AGAINST ('".$search."*' IN BOOLEAN MODE) 
					 OR MATCH(product_type.type) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(product_name.product_name) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(product_application.application_area) AGAINST ('".$search."*' IN BOOLEAN MODE)			 
					 OR MATCH(product_finishing.finishing) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(product_form.form) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(seller_general.name) AGAINST ('".$search."*' IN BOOLEAN MODE)			 
					 OR MATCH(seller_location.address) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 OR MATCH(seller_location.city) AGAINST ('".$search."*' IN BOOLEAN MODE)
					 ORDER BY (SCORE_APPLICATION*0.05)+(SCORE_COLOR*0.1)+(SCORE_FINISH*0.05)+(SCORE_FORM*0.06)+(SCORE_GNAME*0.12)+(SCORE_LOCATION*0.12)+(SCORE_NAME*0.12)+(SCORE_PINCODE*0.18)+(SCORE_TYPE*0.15) DESC
					 LIMIT ".$no_of_records." OFFSET ".$record_min."
					 ";
}

if(!empty($color_sort) || !empty($type_sort)  || !empty($form_sort)  || !empty($color_finish)|| !empty($location_sort) || (isset($_GET['color_sort']) || isset($_GET['type_sort'])  || isset($_GET['form_sort'])  || isset($_GET['color_finish'])|| isset($_GET['location_sort'])) && isset($_GET["search"])){
	  $sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_name ON seller_product.product_name = product_name.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN product_minprice ON seller_product.min_price = product_minprice.no
			 INNER JOIN product_maxprice ON seller_product.max_price = product_maxprice.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 			 
			 WHERE 
			 product_color.color LIKE '%".$color_sort."%'			 
			 AND product_type.type LIKE '%".$type_sort."%'
			 AND seller_location.city LIKE '%".$location_sort."%'
			 AND product_finishing.finishing LIKE '%".$color_finish."%'
			 AND product_form.form LIKE '%".$form_sort."%'	
			 AND product_minprice.min_price ".$min_price."
			 AND product_maxprice.max_price ".$max_price."
			 AND seller_location.city LIKE '%".$pincode."%'			 
			 LIMIT ".$no_of_records." OFFSET ".$record_min."
			 ";
}
if(empty($sql)){
 $sql = "SELECT * FROM seller_product 
							 INNER JOIN product_color ON seller_product.color = product_color.no 
							 INNER JOIN product_application ON seller_product.application_area = product_application.no 
							 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
							 INNER JOIN product_form ON seller_product.form = product_form.no 
							 INNER JOIN product_name ON seller_product.product_name = product_name.no 
							 INNER JOIN product_type ON seller_product.type_id = product_type.no
							 LIMIT ".$no_of_records." OFFSET ".$record_min."
							 ";
}
?>
<!--Products-->
<section class="product" style="padding-top: 7em;">
    <div class="container mt-4">        
<h3 class="pl-3">List Of Product 
        <!-- Button to Open the Modal -->
		<button type="button" class="btn btn-primary ml-3 mb-0 btn d-sm-block d-md-none float-right"  data-toggle="modal" data-target="#myModal">
		  SORT
		</button>
		</h3>  
		

<div class="container" width="100%">
  <div class="row">
	<div class="col-lg-3 mx-auto">
			<form class="form-inline d-none d-md-block d-lg-block" style="display:inline;" method="get">
	<font>Color</font>
	<select name="color_sort" class="form-control m-1">		
		<option value="<?php if(isset($_GET['color_sort'])){echo $_GET['color_sort'];}?>"><?php if(isset($_GET['color_sort'])){echo $_GET['color_sort'];}?></option>	
		<option value=""></option>
		<?php 
		
		$sql_color = "SELECT color FROM product_color";
		$colors = singletable_all( $sql_color );
		
		foreach($colors as $color){
			echo '<option value="'.$color['color'].'">'.$color['color'].'</option>';
		}
		
		?>
	</select>
	
		<font color="black">Minimum</font>		
					<select name="min_price" class="form-control m-1">
					<option value="<?php if(isset($_GET['min_price'])){echo $_GET['min_price'];}?>"><?php if(isset($_GET['min_price'])){echo "Rs.".preg_replace('/[^0-9]/', '', $_GET['min_price']);}?></option>	
		<option value=""></option>		
						<?php 
						
						$sql_form = "SELECT min_price from product_minprice";
						$types = singletable_all( $sql_form );
						
						foreach($types as $type){
							echo '<option value=">='.$type['min_price'].'">Rs. '.$type['min_price'].'</option>';
						}
						
						?>
					</select>	
	<br>
	<font color="black">Maximum</font>
					<select name="max_price" class="form-control  m-1">
					<option value="<?php if(isset($_GET['max_price'])){echo $_GET['max_price'];}?>"><?php if(isset($_GET['max_price'])){echo "Rs.".preg_replace('/[^0-9]/', '', $_GET['max_price']);}?></option>	
		<option value=""></option>
						
						<?php 
						
						$sql_form = "SELECT max_price from product_maxprice";
						$types = singletable_all( $sql_form );
						
						foreach($types as $type){
							echo '<option value="<='.$type['max_price'].'">Rs. '.$type['max_price'].'</option>';
						}
						
						?>
					</select>					

<br><font>Type</font>
	<select name="type_sort" class="form-control m-1">
		<option value="<?php if(isset($_GET['type_sort'])){echo $_GET['type_sort'];}?>"><?php if(isset($_GET['type_sort'])){echo $_GET['type_sort'];}?></option>	
		<option value=""></option>
		<?php 
		
		$sql_color = "SELECT type FROM product_type";
		$types = singletable_all( $sql_color );
		
		foreach($types as $type){
			echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
		}
		
		?>
	</select>
	<br><font>Form</font>
	<select name="form_sort" class="form-control m-1">		
		<option value="<?php if(isset($_GET['form_sort'])){echo $_GET['form_sort'];}?>"><?php if(isset($_GET['form_sort'])){echo $_GET['form_sort'];}?></option>
		<option value=""></option>
		<?php 
		
		$sql_form = "SELECT form FROM product_form";
		$types = singletable_all( $sql_form );
		
		foreach($types as $type){
			echo '<option value="'.$type['form'].'">'.$type['form'].'</option>';
		}
		
		?>
	</select>
	<br><font>Finishing</font>
	<select name="color_finish" class="form-control m-1">		
		<option value="<?php if(isset($_GET['color_finish'])){echo $_GET['color_finish'];}?>"><?php if(isset($_GET['color_finish'])){echo $_GET['color_finish'];}?></option>
		<option value=""></option>
		
		<?php 
		
		$sql_form = "SELECT finishing FROM product_finishing";
		$types = singletable_all( $sql_form );
		
		foreach($types as $type){
			echo '<option value="'.$type['finishing'].'">'.$type['finishing'].'</option>';
		}
		
		?>
	</select>
	<input type="hidden" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
	<input type="submit" class="btn text-light m-1" value="SEARCH">
  </form>
	</div>
    <div class="col-lg-9 mx-auto">
	   <!-- List group-->
<p><?php  if(isset($search) && $search != null){echo 'Search results for "'.$search.'"';} ?></p>

<?php 
					
					if(isset($_GET['type_sort']) && ($_GET['type_sort'] != null))
					{
					$type_sort = $_GET['type_sort'];	
					}
					else
					{
					$type_sort = "";
					}
					
					
					
				$sellers = singletable_all( $sql );
				
				
				
				if(!isset($sellers["error"]) && isset($sellers) && isset($sellers[0]["SCORE_APPLICATION"]))
				{
				 for($seller_count =0;$seller_count < sizeof($sellers);$seller_count++)
				 {
							$sellers[$seller_count]["total_score"] = 
							$sellers[$seller_count]["SCORE_APPLICATION"]+
							$sellers[$seller_count]["SCORE_COLOR"]+
							$sellers[$seller_count]["SCORE_FINISH"]+
							$sellers[$seller_count]["SCORE_FORM"]+
							$sellers[$seller_count]["SCORE_GNAME"]+
							$sellers[$seller_count]["SCORE_LOCATION"]+
							$sellers[$seller_count]["SCORE_NAME"]+
							$sellers[$seller_count]["SCORE_TYPE"]+
							$sellers[$seller_count]["SCORE_PINCODE"];	
							
							$sellers[$seller_count]["ntotal_score"] = 
							$sellers[$seller_count]["SCORE_APPLICATION"]*0.05+
							$sellers[$seller_count]["SCORE_COLOR"]*0.1+
							$sellers[$seller_count]["SCORE_FINISH"]*0.05+
							$sellers[$seller_count]["SCORE_FORM"]*0.06+
							$sellers[$seller_count]["SCORE_GNAME"]*0.12+
							$sellers[$seller_count]["SCORE_LOCATION"]*0.12+
							$sellers[$seller_count]["SCORE_NAME"]*0.12+
							$sellers[$seller_count]["SCORE_TYPE"]*0.15+
							$sellers[$seller_count]["SCORE_PINCODE"]*0.18;	
				}
				}
				
				function cmp($a, $b) {
						return $a['total_score'] < $b['total_score'];
				}
				
				if(!isset($sellers["error"]) && isset($sellers))
				{
						if(isset($sellers[0]["total_score"])){
						usort($sellers, "cmp");	
						}
						
                     	foreach($sellers as $product)							
						{
							//echo $product["total_score"]."<br>";
							//echo $product["ntotal_score"];
							
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
<p><a href="clientsignup.php?id='.$product['uid'].'&pid='.$product['pid'].'"><button class="btn text-light mt-2">Details</button></a></p>
								  </div>
								</div>
								<img src="'.$product["image"].'" alt="Generic placeholder image" width="200"  class="ml-lg-5 order-1 order-lg-2" data-toggle="modal" data-target="#imageModal" onclick="zoomimage(\''.$product["image"].'\')">
							  </div>
							  <!-- End -->
							</li>
							<!-- End -->													
								';
						}
						
				}	
				else
				{
						echo "<div class='p-4'>No results found near you in your pincode.</div>";	
							if(isset($sellers["error"]))
				{
					
					// SEARCH ONLY IF THERE ARE NO RESULTS FOUND
					 $sql = "SELECT * FROM seller_product
					 INNER JOIN product_color ON seller_product.color = product_color.no 
					 INNER JOIN product_name ON seller_product.product_name = product_name.no 
					 INNER JOIN product_application ON seller_product.application_area = product_application.no 
					 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
					 INNER JOIN product_form ON seller_product.form = product_form.no 
					 INNER JOIN product_type ON seller_product.type_id = product_type.no
					 INNER JOIN product_minprice ON seller_product.min_price = product_minprice.no
					 INNER JOIN product_maxprice ON seller_product.max_price = product_maxprice.no
					 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
					 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 			 
					 WHERE 
					 product_color.color LIKE '%".$color_sort."%'			 
					 AND product_type.type LIKE '%".$type_sort."%'
					 AND seller_location.city LIKE '%".$location_sort."%'
					 AND product_finishing.finishing LIKE '%".$color_finish."%'
					 AND product_form.form LIKE '%".$form_sort."%'	
					 AND product_minprice.min_price ".$min_price."
					 AND product_maxprice.max_price ".$max_price."
					 LIMIT 20
					 ";
				     $sellers = singletable_all( $sql );
					 echo '<h3><hr>Other Results</h3><hr>';
					 
					 foreach($sellers as $product)							
						{
							//echo $product["total_score"]."<br>";
							//echo $product["ntotal_score"];
							
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
							
								if(isset($product["product_name"])){
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
<p><a href="clientsignup.php?id='.$product['uid'].'&pid='.$product['pid'].'"><button class="btn text-light mt-2">Details</button></a></p>
								  </div>
								</div>
								<img src="'.$product["image"].'" alt="Generic placeholder image" width="200"  class="ml-lg-5 order-1 order-lg-2" data-toggle="modal" data-target="#imageModal" onclick="zoomimage(\''.$product["image"].'\')">
							  </div>
							  <!-- End -->
							</li>
							<!-- End -->													
								';
								}
						}
					 
				}
				}					
					?>	   


    </div>
  </div>
</div>
<center>
<br>
<?php 
$display_pages = 10;

if($page > $display_pages){
	if($_GET['page'] > $display_pages)
	{
		$setpagecount = $_GET['page'];
	}
	else
	{
		$setpagecount = 1;
	}
}
else
{
		$setpagecount = 1;
}

if($_GET['page'] > 1){echo "&nbsp<a href= '?color_finish=".$color_finish."&form_sort=".$form_sort."&max_price=".$max_price."&min_price=".$min_price."&type_sort=".$type_sort."&color_sort=".$color_sort."&search=".$search."&page=".($_GET["page"]-1)."'>Prev</a>";}

$display_pages_count = 1;

for($pagecount = $setpagecount; $pagecount <= $page; $pagecount++)
{
	echo "&nbsp<a href= '?search=".$search."&page=".$pagecount."'>".$pagecount."</a>";
	
	if($pagecount == $display_pages || $display_pages_count >= $display_pages )
	{
//	echo "<a href='?color_finish=".$color_finish."&form_sort=".$form_sort."&max_price=".$max_price."&min_price=".$min_price."&type_sort=".$type_sort."&color_sort=".$color_sort."&search=".$search."&page=".($setpagecount+1)."'>..more</a>";
	break;
	}
	$display_pages_count++;
}


if($_GET['page'] < $page){echo "&nbsp<a href= '?color_finish=".$color_finish."&form_sort=".$form_sort."&max_price=".$max_price."&min_price=".$min_price."&type_sort=".$type_sort."&color_sort=".$color_sort."&search=".$search."&page=".($_GET["page"]+1)."'>Next</a>";}
?>
</center>
</section>


<!------------------------------------------->



<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Sort By</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
				<form class="form-inline" style="display:inline;" method="get">
					<font color="">Color</font>&nbsp&nbsp
					<select name="color_sort" class="form-control">
						<option></option>
						<?php 
						
						$sql_color = "SELECT color FROM product_color";
						$colors = singletable_all( $sql_color );
						
						foreach($colors as $color){
							echo '<option value="'.$color['color'].'">'.$color['color'].'</option>';
						}
						
						?>
					</select>
					<br>
					<font color="black">Type</font>&nbsp&nbsp
					<select name="type_sort" class="form-control">
						<option></option>
						<?php 
						
						$sql_color = "SELECT type FROM product_type";
						$types = singletable_all( $sql_color );
						
						foreach($types as $type){
							echo '<option value="'.$type['type'].'">'.$type['type'].'</option>';
						}
						
						?>
					</select>
					<br>
					<font color="black">Form</font>&nbsp&nbsp
					<select name="form_sort" class="form-control">
						<option></option>
						<?php 
						
						$sql_form = "SELECT form FROM product_form";
						$types = singletable_all( $sql_form );
						
						foreach($types as $type){
							echo '<option value="'.$type['form'].'">'.$type['form'].'</option>';
						}
						
						?>
					</select>
					<br>
					<font color="black">Finishing</font>&nbsp&nbsp
					<select name="color_finish" class="form-control">
						<option></option>
						<?php 
						
						$sql_form = "SELECT finishing FROM product_finishing";
						$types = singletable_all( $sql_form );
						
						foreach($types as $type){
							echo '<option value="'.$type['finishing'].'">'.$type['finishing'].'</option>';
						}
						
						?>
					</select>					
					<font color="black">Minprice</font>		
					<select name="min_price" class="form-control m-1">
					<option value="<?php if(isset($_GET['min_price'])){echo $_GET['min_price'];}?>"><?php if(isset($_GET['min_price'])){echo preg_replace('/[^0-9]/', '', $_GET['min_price']);}?></option>	
		<option value=""></option>		
						<?php 
						
						$sql_form = "SELECT min_price from product_minprice";
						$types = singletable_all( $sql_form );
						
						foreach($types as $type){
							echo '<option value=">='.$type['min_price'].'">'.$type['min_price'].'</option>';
						}
						
						?>
					</select>	
	<br>
	<font color="black">Maxprice</font>
					<select name="max_price" class="form-control  m-1">
					<option value="<?php if(isset($_GET['max_price'])){echo $_GET['max_price'];}?>"><?php if(isset($_GET['max_price'])){echo preg_replace('/[^0-9]/', '', $_GET['max_price']);}?></option>	
		<option value=""></option>
						
						<?php 
						
						$sql_form = "SELECT max_price from product_maxprice";
						$types = singletable_all( $sql_form );
						
						foreach($types as $type){
							echo '<option value="<='.$type['max_price'].'">'.$type['max_price'].'</option>';
						}
						
						?>
					</select>					
				
				
					

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="hidden" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
		<input type="submit" class="btn text-light m-1" value="Search">  </form>      
      </div>

    </div>
  </div>
</div>


<!------------------------------------------------------------------------------------------->
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

<!-- The Modal -->
<div class="modal mt-5" id="pincodeModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">	  
        Enter your Pincode
		<form method="get">
			<input type="number" name="pincode">
				<input type="submit" value="Submit">
		</form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!------------------------------------------------------------------->
<script>
function zoomimage(imgsrc){
	$("#modalimage").attr("src",imgsrc);
}
</script>
<?php 

if(!(isset($_COOKIE["user_city"])))
{
echo '
<script type="text/javascript">
    $(window).on(\'load\',function(){
        $(\'#pincodeModal\').modal(\'show\');
    });
</script>
';
}
?>
<?php include_once("footer.php"); ?>