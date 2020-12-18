<?php 
include("header.php");
$uid = $_SESSION["uid"];
//$uid = "1WtCRRB25n";
include_once("savedata.php"); include_once("functions.php");$pid = generateRandomString();?>

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
	  <input type="file" class="form-control mt-2" name="seller_product|image|0|product/<?php echo $pid; ?>" placeholder="Choose a product image">
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
	  <div id="finishing_type_list"></div>
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
		$('#'+div).val(value);
	}
	</script>
</body>
</html>
