<?php include_once("header.php"); ?>
<?php
	if(isset($_SESSION['uid']) && $_SESSION['uid'] != null)
  {
	$uid = $_SESSION['uid'];
  }
  else
  {	  
	$uid = "dGU56YX4fn";  
  }
 include_once("saveupdate.php");
 include_once("functions.php");
 $pid = $_GET['pid'];
include_once("getalldata.php");

 $sql = "SELECT * FROM seller_product
 INNER JOIN product_color ON seller_product.color = product_color.no 
 INNER JOIN product_application ON seller_product.application_area = product_application.no 
 INNER JOIN product_finishing ON seller_product.finishing = product_finishing.no 
 INNER JOIN product_form ON seller_product.form = product_form.no 
 INNER JOIN product_name ON seller_product.product_name = product_name.no 
 INNER JOIN product_minprice ON seller_product.min_price = product_minprice.no 
 INNER JOIN product_maxprice ON seller_product.max_price = product_maxprice.no 
 INNER JOIN product_type ON seller_product.type_id = product_type.no  
 WHERE seller_product.pid = '".$_GET['pid']."' AND seller_product.uid = '".$uid."'";
$result_row = singletable_all( $sql );	

?>

<?php 
if(isset($result_row["error"]))
{
	echo '<!-----Navbar End------->
 <br><br><br><br><br><br><br><br><br><br>
 <center><h1>Sorry Page Doesn\'t Exist </h1><br><br><br><br><br>';
	include_once("footer.php");die();
}

?>
<!-----Navbar End------->
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Edit a product</h2>
  <hr>
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
	
	
	<h4>Product Details</h4><hr>	
	<form method="post" enctype="multipart/form-data">
	 <div class="form-group">Current Image<br>
	 <img class="img-fluid" src="<?php echo $result_row['0']['image']; ?>" style="max-height:10em;" ><br><br>
	 
	 <input type="hidden" name="seller_product|image" value="<?php echo $result_row['0']['image']; ?>" />
	 <div class="form-group">
	 Choose a product image
	 <!-- Button to Open the Modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
  Select Image
</button>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Product Image</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
			<!-- Nav tabs -->
				<ul class="nav nav-tabs">				  
				  <li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu1">Choose From Images</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu2">Upload</a>
				  </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane container active" id="menu1">
				  <?php 
				  $sql_image = "SELECT DISTINCT image FROM seller_product";
					$images = singletable_all( $sql_image );
					
					echo "<input type='hidden' class='form-control mt-2' name='seller_product|image' id='selectedimage' value='' placeholder='Choose a product image'>";
					
					$count_cid = 0;
					
					foreach($images as $image){
					echo "
					<img src='".$image["image"]."' id='".$count_cid."' style='max-height:100px;max-width:100px;margin:10px;' onclick='selectimg(\"".$image["image"]."\",\"".$count_cid."\")' ></img>";
						
					$count_cid++;
					}
					
				  ?>
				  </div>
				  <script>
					var previous_selected = "";
					function selectimg(imgsrc, id){						
						document.getElementById("selectedimage").value = imgsrc;						
						document.getElementById(id).style = "border:2px solid black;max-height:100px;max-width:100px;margin:10px;";
						if(previous_selected){
						document.getElementById(previous_selected).style = "border:0px solid red;max-height:100px;max-width:100px;margin:10px;";
						}
						previous_selected = id;												
					}
				  </script>
				  <div class="tab-pane container fade" id="menu2">
				  <input type="file" class="form-control mt-2" name="seller_product|image|0|product/<?php echo $pid; ?>" placeholder="Choose a product image"></div>				  
				</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Done</button>
      </div>

    </div>
  </div>
</div>
	 	 
	 </div>
	 
	 </div>
	 
	 <div class="form-group">
	 <input type="hidden" name="seller_product|pid" value="<?php echo $pid; ?>">	 
		<label>Type of Product</label>
		<select class="form-control" name="seller_product|type_id">
		<option value="<?php echo $result_row['0']['type_id']; ?>"><?php echo $result_row['0']['type']; ?></option>		
		<option value="0">Granite</option>
		<option value="1">Marble</option>		
		</select>
	  </div>
	   <div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="product_name|product_name" id="name" onkeyup="getdata('name', 'namelist' )" placeholder="Enter the product name" value="<?php echo $result_row['0']['product_name']; ?>">
	  </div>	 
	  <div id="namelist"></div>
	  
	  <div class="form-group">
		<label>Color</label>
		<input type="text" class="form-control" name="product_color|color" id="color" onkeyup="getdata('color', 'colorlist' )" placeholder="Enter the product color" value="<?php echo $result_row['0']['color']; ?>">
	  </div>	 
	  <div id="colorlist"></div>	 
	  <div class="form-group">
		<label>Application Area</label>
		<input type="text" class="form-control" name="product_application|application_area" id="application_area" onkeyup="getdata('application_area', 'application_area_list')" placeholder="Enter application area" value="<?php echo $result_row['0']['application_area']; ?>">
	  </div>	
	  <div id="application_area_list"></div>
	  <div class="form-group">
		<label>Finishing type</label>
		<input type="text" class="form-control" name="product_finishing|finishing" id="finishing_type" onkeyup="getdata('finishing_type', 'finishing_type_list')" value="<?php echo $result_row['0']['finishing']; ?>" placeholder="Enter finishing type">
	  </div>
	  <div class="form-group">
	  <label>Minimum Price</label>
	  <input type="number" class="form-control" name="product_minprice|min_price" id="pricing" onkeyup="getdata('pricing', 'minpricing_list')" value="<?php echo $result_row['0']['min_price']; ?>" placeholder="Enter Minimum Price">
	  </div>
	  <div id="minpricing_list"></div>
	  <div class="form-group">
	  <label>Maximum Price</label>
	  <input type="number" class="form-control" name="product_maxprice|max_price" id="pricing" onkeyup="getdata('pricing', 'maxpricing_list')" value="<?php echo $result_row['0']['max_price']; ?>" placeholder="Enter Maximum Price">
	  </div>
	  <div id="maxpricing_list"></div>
	  <div id="finishing_type_list"></div>
	  <div class="form-group">
		<label>Form</label>
		<input type="text" class="form-control" name="product_form|form" id="form_type" onkeyup="getdata('form_type', 'form_type_list')" placeholder="Enter form type" value="<?php echo $result_row['0']['form']; ?>">
	  </div>
	  <div id="form_type_list"></div>
	  <div class="form-group">
		<label>Size</label>
		<input type="text" class="form-control" value="<?php echo $result_row['0']['size']; ?>" name="seller_product|size" placeholder="Enter size">
	  </div>	  
	  <div class="form-group">
		<label>Thickness</label>
		<input type="text" class="form-control" value="<?php echo $result_row['0']['thickness']; ?>" name="seller_product|thickness" placeholder="Enter thickness">
	  </div>	  
	  <div class="form-group">
		<label>Minimum Order Quantity</label>
		<input type="text" class="form-control" name="seller_product|moq" value="<?php echo $result_row['0']['moq']; ?>" placeholder="Minimum Order Quantity">
	  </div>
	  <div class="form-group">
		<label>Other Details</label>
		<textarea class="form-control" name="seller_product|details" placeholder="Description or other details"><?php echo $result_row['0']['details']; ?></textarea>
	  </div>
	  	  	
	  	<input type="submit" value="Add the Product">
	</form>
  </div>
</div>
</center>
   <!-- Footer -->
<br>

	<script>
	function getdata(type, output){
		
		var typevalue = $("#"+type).val();		
		
		if($('#'+type).val().length > 2 && $('#'+type).val().length < 9){ 
		$.ajax({
		  url: "ajaxrouter.php?type="+type,
		  data: {value : typevalue},
		  cache: false,
		  type: "POST",
		  success: function(html){
			console.log(html);		
			$('#'+output).html(html);
		  }
		});
		}
	}
	
	//pural form in router file 
	function clean(div, value){
		$('#colors').html("");
		$('#application_areas').html("");
		$('#finishing_types').html("");
		$('#form_types').html("");
		$('#name').html("");
		$('#'+div).val(value);
	}
	</script>
<?php include_once("footer.php"); ?>