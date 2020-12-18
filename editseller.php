<?php include_once("header.php"); ?>
<?php include_once("saveupdate.php"); include_once("functions.php");

	 if(isset($_SESSION['uid']) && $_SESSION['uid'] != null)
	  {
		$search = $_SESSION['uid'];
	  }
	  else
	  {	  
		$search = "dGU56YX4fn";  
	  } 
	  
	include("getsingledata.php"); 
	
	$sql = "SELECT * FROM seller_general
			 INNER JOIN seller_location ON seller_general.uid = seller_location.uid			 
			 INNER JOIN seller_certification ON seller_general.uid = seller_certification.uid
			 INNER JOIN seller_business ON seller_general.uid = seller_business.uid			 
			 INNER JOIN seller_contact ON seller_general.uid = seller_contact.uid			 
			 WHERE seller_general.uid = '".$search."'			 
			 ";
			 
	$seller = singletable( $sql );	
	$uid = $seller["uid"];
	
	
?>
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2><i class="fa fa-store"></i> Edit A Seller</h2>
  <hr>
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
	
	
	<h4>Company Details</h4><hr>	
	<form method="post" enctype="multipart/form-data">
	 <div class="form-group">
	 <input type="hidden" name="seller_business|uid" value="<?php echo $uid; ?>">	 
		<label>Nature of Business</label>
		<select class="form-control" name="seller_business|nature_of_business">
		<option value="<?php echo $seller['nature_of_business']; ?>"><?php echo $seller['nature_of_business']; ?></option>		
		<option value="Manufacturer">Manufacturer</option>
		<option value="Wholesaler">Wholesaler</option>
		<option value="Retailer">Retailer</option>
		</select>
	  </div>	  
	  <div class="form-group">
		<label>Company Name</label>
		<input type="text" class="form-control" name="seller_general|name" placeholder="Enter your company name" value="<?php echo $seller["name"]; ?>" >
	  </div>
	  <div class="form-group">
		<label>About the Company</label>
		<textarea class="form-control" name="seller_business|about_us" placeholder="About the company"><?php echo $seller["about_us"]; ?></textarea>
	  </div>	 	  
	  <div class="form-group">
		<label>Name of the CEO</label>
		<input type="text" class="form-control" value="<?php echo $seller["ceo"]; ?>" name="seller_business|ceo" placeholder="Enter CEO's name">
	  </div>	 
	  <div class="form-group">
		<label>Enter your GST number</label>
		<input type="text" class="form-control" value="<?php echo $seller["gstnumber"]; ?>" name="seller_business|gstnumber" placeholder="Enter your GST number">
	  </div>	 
	  <div class="form-group">
		<label>Establishment Year</label>
		<input type="number" class="form-control" value="<?php echo $seller["establishment_year"]; ?>" name="seller_business|establishment_year" placeholder="Enter establishment year">
	  </div>	
	   <div class="form-group">
		<label>Number Of Employee</label>
		<input type="number" class="form-control" value="<?php echo $seller["employee"]; ?>" name="seller_business|employee" placeholder="Enter number of Employee">
	  </div>	
	  <div class="form-group">
		<label>Firm Status</label>
		<select class="form-control" name="seller_business|firm_status">
		<option value="<?php echo $seller["firm_status"]; ?>"><?php echo $seller["firm_status"]; ?></option>
		<option value="proprietor">Proprietor</option>
		<option value="privatelimited">Pvt Limited</option>
		<option value="publiclimited">Public Limited</option>
		<option value="llp">LLP</option>
		</select>
	  </div>
	  <div class="form-group">
		<label>Address</label>
		<textarea class="form-control" name="seller_location|address" placeholder="Enter your firm's address"><?php echo $seller["address"]; ?></textarea>
	  </div>
	  <div class="form-group">
		<label>Pincode</label>
		<input type="text" class="form-control" name="seller_location|pincode" value="<?php echo $seller["pincode"]; ?>" placeholder="Pincode">		
	  </div>
	  <div class="form-group">
		<label>City</label>
		<input type="text" class="form-control" name="seller_location|city" placeholder="City" value="<?php echo $seller["city"]; ?>">
	  </div>	  
	  <input type="hidden" name="seller_certification|uid" value="<?php echo $uid; ?>">
	  <input type="hidden" name="seller_certification|gstin" placeholder="Enter your gst certificate" value="<?php echo $seller["gstin"]; ?>">
	  <input type="hidden" name="seller_certification|other" placeholder="Enter any other certificate or document" value="<?php echo $seller["other"]; ?>">
	  <img src="<?php echo $seller["gstin"]; ?>" class="img-fluid" style="max-width:10em;"/><br>
	  <img src="<?php echo $seller["other"]; ?>" class="img-fluid" style="max-width:10em;"/><br><br>
	  
	  Upload Your GST Certificate : 	  
	  <input type="file" class="form-control mt-2" name="seller_certification|gstin|0|<?php echo $uid; ?>" placeholder="Enter your gst certificate">
	  <br>
	  Upload Your TIN Certificate : 	  
	  <input type="file" class="form-control mb-4" name="seller_certification|other|0|<?php echo $uid; ?>" placeholder="Enter any other certificate or document">
	<hr>

	<h4>Contact Details</h4><hr>	
	<input type="hidden" name="seller_contact|uid" value="<?php echo $uid; ?>">	 
	<input type="hidden" name="seller_location|uid" value="<?php echo $uid; ?>">	 	
	  <div class="form-group">
		<label>Contact Number</label>
		<input type="text" class="form-control" name="seller_contact|contact_no" placeholder="Enter your mobile number" value="<?php echo $seller["contact_no"]; ?>">
	  </div>
	  
	  <div class="form-group">
		<label>Other Contact Number</label>
		<input type="text" class="form-control" name="seller_contact|other_number" placeholder="Enter your mobile number" value="<?php echo $seller["other_number"]; ?>">
	  </div>
	 <div class="form-group">
		<label>Contact Name</label>
		<input type="text" class="form-control" name="seller_contact|contact_name" placeholder="Contact Person Name" value="<?php echo	 $seller["contact_name"]; ?>">
	  </div>
	  <!----
	  <div class="form-group">
		<label>Facebook Page URL</label>
		<input type="text" class="form-control" name="seller_contact|facebook" placeholder="Enter your facebok">
	  </div>
	  <div class="form-group">
		<label>Twitter Profile URL</label>
		<input type="text" class="form-control" name="seller_contact|twitter" placeholder="Enter your twitter">
	  </div>
	  <div class="form-group">
		<label>Instagram Page URL</label>
		<input type="text" class="form-control" name="seller_contact|instagram" placeholder="Enter your instagram">
	  </div>
	  ---->
	<hr>
	
	  <h4>Login Details</h4><hr>
  <input type="hidden" name="seller_general|uid" value="<?php echo $uid; ?>">
		<div class="form-group">
		<input type="hidden" class="form-control mt-2" name="seller_general|logo" placeholder="Choose a logo or shop image" value="<?php echo $seller["logo"]; ?>">
		
		<img src="<?php echo $seller["logo"]; ?>" class="img-fluid" style="max-width:10em;"/><br><br>
		Upload Your Logo OR Shop Image : 	  
	  <input type="file" class="form-control mt-2" name="seller_general|logo|0|<?php echo $uid; ?>" placeholder="Choose a logo or shop image">
	  </div>
	  
	  <div class="form-group">
		<label>Email</label>
		<input type="text" class="form-control" value="<?php echo $seller["email"]; ?>" name="seller_general|email" placeholder="Enter your email address">
	  </div>
	  	<input type="submit" value="Sign Up As Seller">
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
</body>
</html>