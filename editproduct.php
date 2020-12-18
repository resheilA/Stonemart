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
	 Choose a product image
	 <input type="hidden" name="seller_product|image" value="<?php echo $result_row['0']['image']; ?>" />
	  <input type="file" class="form-control mt-2" name="seller_product|image|0|product/<?php echo $pid; ?>" placeholder="Choose a product image">
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
   <footer class="bg-white">
    <div class="container py-5">
        <div class="row py-3">
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold mb-4">About</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-muted">Contact Us</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">About Us</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Stories</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Press</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold mb-4">Help</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-muted">Payments</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Shipping</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Cancellation</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Returns</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold mb-4">Policy</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-muted">Return Policy</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Terms Of Use</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Security</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Privacy</a></li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold mb-4">Company</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-muted">Login</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Register</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Sitemap</a></li>
                    <li class="mb-2"><a href="#" class="text-muted">Our Products</a></li>
                </ul>
            </div>
            <div class="col-lg-4 col-md-6 mb-lg-0">
                <h6 class="text-uppercase font-weight-bold mb-4">Registered Office Address</h6>
                <p class="text-muted mb-4">Here , write the complete address of the Registered office address along with telephone number.</p>
                <ul class="list-inline mt-4">
                    <li class="list-inline-item"><a href="#" target="_blank" title="twitter"><i class="fab fa-2x fa-twitter"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" title="facebook"><i class="fab fa-2x fa-facebook-f"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" title="instagram"><i class="fab fa-2x fa-instagram"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" title="pinterest"><i class="fab fa-2x fa-youtube"></i></a></li>
                    <li class="list-inline-item"><a href="#" target="_blank" title="vimeo"><i class="fab fa-2x fa-google"></i></a></li>
                </ul>
            </div>
        </div>
    </div>
    <hr class="p-0 m-0 b-0">
    <div class=" py-2">
        <div class="container text-center">
            <p class="text-muted mb-0 py-2">© 2020 Webportal All rights reserved</p>
        </div>
    </div>
</footer>
<!--Footer end-->

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
</body>
</html>
