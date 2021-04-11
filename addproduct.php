<?php 
include("header.php");
$uid = $_SESSION["uid"];
//$uid = "1WtCRRB25n";
include_once("savedata.php"); include_once("functions.php");$pid = generateRandomString();
  	include("getsingledata.php"); 
	include("getalldata.php"); 

?>

<!-----Navbar End------->
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Add a product</h2>
  <hr>
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
	
	
	<h4>Product Details</h4><hr>	
	<form method="post" enctype="multipart/form-data">
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
					
					echo "<input type='hidden' class='form-control mt-2' name='seller_product|image' id='selectedimage' value='img/granite.jpg' placeholder='Choose a product image'>";
					
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
	 
	 <div class="form-group">
	 <input type="hidden" name="seller_product|pid" value="<?php echo $pid; ?>">	 
	 <input type="hidden" name="seller_product|uid" value="<?php echo $uid; ?>">	 
		<label>Type of Product</label>
		<select class="form-control" name="seller_product|type_id">
		<option></option>
		<option value="1">Granite</option>
		<option value="2">Marble</option>		
		</select>
	  </div> 
	  <div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="product_name|product_name" id="name" onkeyup="getdata('name', 'namelist' )" placeholder="Enter the product name">
	  </div>	 
	  <div id="namelist"></div>
	  <div class="form-group">
		<label>Color</label>
		<input type="text" class="form-control" name="product_color|color" id="color" onkeyup="getdata('color', 'colorlist' )" placeholder="Enter the product color">
	  </div>	 
	  <div id="colorlist"></div>
	  <div class="form-group">
		<label>Application Area</label>
		<input type="text" class="form-control" name="product_application|application_area" id="application_area" onkeyup="getdata('application_area', 'application_area_list')" placeholder="Enter application area">
	  </div>	
	  <div id="application_area_list"></div>
	  <div class="form-group">
		<label>Finishing type</label>
		<input type="text" class="form-control" name="product_finishing|finishing" id="finishing_type" onkeyup="getdata('finishing_type', 'finishing_type_list')" placeholder="Enter finishing type">
	  </div>
	  <div class="form-group">
		<label>Minimum Price</label>
		<input type="number" class="form-control" name="product_minprice|min_price" id="pricing" onkeyup="getdata('pricing', 'minpricing_list')" placeholder="Enter Price">
	  </div>
	  <div id="minpricing_list"></div>
	  <div class="form-group">
		<label>Maximum Price</label>
		<input type="number" class="form-control" name="product_maxprice|max_price" id="pricing" onkeyup="getdata('pricing', 'maxpricing_list')" placeholder="Enter Price">
	  </div>
	  <div id="maxpricing_list"></div>
	  <div class="form-group">
		<label>Form</label>
		<input type="text" class="form-control" name="product_form|form" id="form_type" onkeyup="getdata('form_type', 'form_type_list')" placeholder="Enter form type">
	  </div>
	  <div id="form_type_list"></div>
	  <div class="form-group">
		<label>Size</label>
		<input type="text" class="form-control" name="seller_product|size" placeholder="Enter size">
	  </div>	  
	  <div class="form-group">
		<label>Thickness</label>
		<input type="text" class="form-control" name="seller_product|thickness" placeholder="Enter thickness">
	  </div>	  
	  <div class="form-group">
		<label>Minimum Order Quantity</label>
		<input type="text" class="form-control" name="seller_product|moq" placeholder="Minimum Order Quantity">
	  </div>
	  <div class="form-group">
		<label>Other Details</label>
		<textarea class="form-control" name="seller_product|details" placeholder="Description or other details"></textarea>
	  </div>
	  	  	
	  	<input type="submit" value="Add the Product">
	</form>
  </div>
</div>
</center>
<?php include("footer.php"); ?>

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
		$('#'+div).val(value);
	}
	</script>