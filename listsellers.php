<?php 
include("header.php"); 
include("getalldata.php");
include("functions.php");

?>
	

<!--Products-->
<section class="product" style="padding-top: 8em;">
    <div class="container mt-4">        
<h3 class="pl-3">List Of Product 
        <!-- Button to Open the Modal -->
		<button type="button" class="btn btn-primary ml-3 mb-0 btn d-sm-block d-md-none float-right"  data-toggle="modal" data-target="#myModal">
		  SORT
		</button>
		</h3>  
<nav class="navbar navbar-expand-sm bg-light d-md-block d-none">   
	<form class="form-inline" style="display:inline;" method="get">
	&nbsp&nbsp <font>Color</font>&nbsp&nbsp
	<select name="color_sort" class="form-control">		
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
	&nbsp&nbsp <font>Type</font>&nbsp&nbsp
	<select name="type_sort" class="form-control">
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
	&nbsp&nbsp <font>Form</font>&nbsp&nbsp
	<select name="form_sort" class="form-control">		
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
	&nbsp&nbsp <font>Finishing</font>&nbsp&nbsp
	<select name="color_finish" class="form-control">		
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
</nav>		

<br>  
<div class="container" width="100%">
  <div class="row">
    <div class="col-lg-12 mx-auto">
	   <!-- List group-->
      <ul class="list-group shadow">

   
<?php 
  if(isset($_GET["search"]) && $_GET["search"] != null){ $search = RemoveSpecialChar(urldecode($_GET["search"]));}else{$search = "";}
  
  if(isset($_GET["color_sort"]) && $_GET["color_sort"] != null){$color_sort = $_GET["color_sort"];}else{$color_sort = "";}
  if(isset($_GET["type_sort"]) && $_GET["type_sort"] != null){$type_sort = $_GET["type_sort"];}else{$type_sort = "";}
  if(isset($_GET["form_sort"]) && $_GET["form_sort"] != null){$form_sort = $_GET["form_sort"];}else{$form_sort = "";}
  if(isset($_GET["color_finish"]) && $_GET["color_finish"] != null){$color_finish = $_GET["color_finish"];}else{$color_finish = "";}
  
	if(!empty($color_sort) || !empty($type_sort)  || !empty($form_sort)  || !empty($color_finish)){
	$sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_name ON seller_product.product_name = product_name.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 
			 WHERE 
			 product_color.color LIKE '%".$color_sort."%'			 
			 AND product_type.type LIKE '%".$type_sort."%'
			 AND seller_location.city LIKE '%".$type_sort."%'
			 AND product_finishing.finishing LIKE '%".$color_finish."%'
			 AND product_form.form LIKE '%".$form_sort."%'" 
			 ;
			 $sellers = singletable_all( $sql );	
	}
	else{
		//echo $type_sort;
	/*	
	 $sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 
			 WHERE 				
		      product_color.color LIKE '%".$search."%'	 	
			 OR product_type.type LIKE '%".$search."%'
			 OR product_application.application_area LIKE '%".$search."%'			 
			 OR product_finishing.finishing LIKE '%".$search."%'
			 OR product_form.form LIKE '%".$search."%'
			 OR seller_general.name LIKE '%".$search."%'			 
			 OR seller_location.address LIKE '%".$search."%'
			 ORDER BY product_color.color
			 ";
	
	$sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 			 
			 WHERE MATCH(product_color.color,product_type.type,product_application.application_area,product_finishing.finishing,product_form.form,seller_general.name,seller_location.address)
			 AGAINST(".$search." IN BOOLEAN MODE)
			 ";
	*/		 
		 $sql = "SELECT *,
						MATCH(product_color.color) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_COLOR,
						MATCH(product_type.type) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_TYPE,
						MATCH(product_name.product_name) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_NAME,
						MATCH(product_application.application_area) AGAINST ('".$search."*' IN BOOLEAN MODE)	AS SCORE_APPLICATION,		 
						MATCH(product_finishing.finishing) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_FINISH,
						MATCH(product_form.form) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_FORM,
						MATCH(seller_general.name) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_GNAME,			 
						MATCH(seller_location.address) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_LOCATION
						MATCH(seller_location.pincode) AGAINST ('".$search."*' IN BOOLEAN MODE) AS SCORE_PINCODE
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
					 OR MATCH(seller_location.pincode) AGAINST ('".$search."*' IN BOOLEAN MODE)";
						 
					/*	 
				 MATCH(product_finishing.finishing,product_application.application_area, product_color.color, product_form.form, product_name.product_name,product_type.type,seller_general.name, seller_location.address) AGAINST ('".$search."' IN BOOLEAN MODE)";		 
				*/
		
			
			include("connect.php");

			$result = mysqli_query($conn, $sql);
				
			if (mysqli_num_rows($result) > 0) {		
			  // output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
				if(isset($row["SCORE_APPLICATION"])){
				  $row["total_score"] = $row["SCORE_APPLICATION"]+$row["SCORE_COLOR"]+$row["SCORE_FINISH"]+$row["SCORE_FORM"]+$row["SCORE_GNAME"]+$row["SCORE_LOCATION"]+$row["SCORE_NAME"]+$row["SCORE_TYPE"]+$row["SCORE_PINCODE"];		 
				  $sellers[] = $row;
				  }
			  }	
			aasort($sellers,"total_score");		  		
			}
			else
			{
		 $sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid
			 INNER JOIN product_name ON seller_product.product_name = product_name.no
			 WHERE 				
		      SOUNDEX(product_color.color) LIKE SOUNDEX('%".$search."%')	 	
			 OR SOUNDEX(product_type.type) LIKE SOUNDEX('%".$search."%')
			 OR SOUNDEX(product_application.application_area) LIKE SOUNDEX('%".$search."%')			 
			 OR SOUNDEX(product_finishing.finishing) LIKE SOUNDEX('%".$search."%')
			 OR SOUNDEX(product_form.form) LIKE SOUNDEX('%".$search."%')
			 OR SOUNDEX(product_name.product_name) LIKE SOUNDEX('%".$search."%')
			 OR SOUNDEX(seller_general.name) LIKE SOUNDEX('%".$search."%')			 
			 OR SOUNDEX(seller_location.address) LIKE SOUNDEX('%".$search."%')
			 OR SOUNDEX(seller_location.pincode) LIKE SOUNDEX('%".$search."%')
			 OR SOUNDEX(seller_location.city) LIKE SOUNDEX('%".$search."%')
			 ORDER BY product_color.color
			 ";
	
			include("connect.php");

			$result = mysqli_query($conn, $sql);
		
			if (mysqli_num_rows($result) > 0) {		
			  // output data of each row
			  while($row = mysqli_fetch_assoc($result)) {
				  $sellers[] = $row;
			  }	
			}
			else
			{
		echo	 $sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid				 
			 WHERE 				
		      product_color.color LIKE '%".$search."%'	 	
			 OR product_type.type LIKE '%".$search."%'
			 OR product_application.application_area LIKE '%".$search."%'			 
			 OR product_finishing.finishing LIKE '%".$search."%'
			 OR product_form.form LIKE '%".$search."%'
			 OR seller_general.name LIKE '%".$search."%'			 
			 OR seller_location.address LIKE '%".$search."%'
			 OR seller_location.pincode LIKE '%".$search."%'
			 ORDER BY product_color.color
			 ";
			 
				 if (mysqli_num_rows($result) > 0) {		
				  // output data of each row
				  while($row = mysqli_fetch_assoc($result)) {
					  $sellers[] = $row;
				  }	
				}
			}
		
			}
		}
		
	/*
	echo "<pre>";
	var_dump($sellers);
	echo "</pre>";
	*/
		if(!isset($sellers["error"]) && isset($sellers))
		{
			
		foreach($sellers as $seller)
		{
			
				echo '
				   <!-- list group item-->
			<li class="list-group-item">
			  <!-- Custom content-->
			  <div class="media align-items-lg-center flex-column flex-lg-row p-3">
				<div class="media-body order-2 order-lg-1">
				  <h5 class="mt-0 font-weight-bold mb-2 mt-2">'. ucfirst($seller["name"]) .' - '.$seller["product_name"].'</h5>
				  <p class="font-italic text-muted mb-0 small">'.mb_strimwidth("<i class='fa fa-map-marker-alt'></i>  ".$seller["address"] , 0, 200, "...").'</p>
				  <div class="d-flex align-items-center justify-content-between mt-1">								
				  </div>
				   <h6 class="font-weight-bold my-2"><i class="fa fa-th-large"></i> '.$seller["type"].'&nbsp <i class="fa fa-paint-brush"></i>  '.$seller["color"].' </h6>
				   <h6 class="font-weight-bold my-2"><i class="fa fa-square"></i> '.$seller["form"].'&nbsp <i class="fa fa-shield-alt"></i>  '.$seller["finishing"].' </h6>
					<a href="clientsignup.php?id='.$seller['uid'].'&pid='.$seller['pid'].'"><button class="btn mt-2">View Details</button></a>	
				</div><img src="'.$seller['image'].'" alt="Generic placeholder image" class="ml-lg-5 order-1 order-lg-2 border border-secondary" style="max-width:15em;" data-toggle="modal" data-target="#imageModal" onclick="zoomimage(\''.$seller["image"].'\')">
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
		
			$sql = "SELECT * FROM seller_product
			 INNER JOIN product_color ON seller_product.color = product_color.no 
			 INNER JOIN product_name ON seller_product.product_name = product_name.no 
			 INNER JOIN product_application ON seller_product.application_area = product_application.no 
			 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
			 INNER JOIN product_form ON seller_product.form = product_form.no 
			 INNER JOIN product_type ON seller_product.type_id = product_type.no
			 INNER JOIN seller_location ON seller_product.uid = seller_location.uid			 
			 INNER JOIN seller_general ON seller_product.uid = seller_general.uid	
			 ";

			 $sellers = singletable_all( $sql );
			 
			 foreach($sellers as $seller)
			{
				echo '
					   <!-- list group item-->
				<li class="list-group-item">
				  <!-- Custom content-->
				  <div class="media align-items-lg-center flex-column flex-lg-row p-3">
					<div class="media-body order-2 order-lg-1">
					  <h5 class="mt-0 font-weight-bold mb-2 mt-2">'. ucfirst($seller["name"]) .' - '.$seller["product_name"].'</h5>
					  <p class="font-italic text-muted mb-0 small">'.mb_strimwidth("<i class='fa fa-map-marker-alt'></i>  ".$seller["address"] , 0, 200, "...").'</p>
					  <div class="d-flex align-items-center justify-content-between mt-1">								
					  </div>
					   <h6 class="font-weight-bold my-2"><i class="fa fa-th-large"></i> '.$seller["type"].'&nbsp <i class="fa fa-paint-brush"></i>  '.$seller["color"].' </h6>
					   <h6 class="font-weight-bold my-2"><i class="fa fa-square"></i> '.$seller["form"].'&nbsp <i class="fa fa-shield-alt"></i>  '.$seller["finishing"].' </h6>
						<a href="seller.php?id='.$seller['uid'].'&pid='.$seller['pid'].'"><button class="btn mt-2">View Details</button></a>	
						<a href="clientsignup.php?id='.$seller['uid'].'&pid='.$seller['pid'].'"><button class="btn mt-2">View Details</button></a>									
					</div><img src="'.$seller['image'].'" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2 border border-secondary">
				  </div>
				  <!-- End -->
				</li>
				<!-- End -->
				';
			}	
		
	}
?>


      </ul>
      <!-- End -->
    </div>
  </div>
</div>
</section>

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
				  

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="hidden" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
		<input type="submit" class="btn text-light m-1" value="Search">  </form>      
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



<!------------------------------------------->


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


<!------------------------------------------------------------------->
<script>
function zoomimage(imgsrc){
	$("#modalimage").attr("src",imgsrc);
}
</script>

<?php include("footer.php"); ?>