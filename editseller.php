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
		<label>City*</label>
		<input type="text" id="city" class="form-control" name="seller_location|city" placeholder="City" required value="<?php echo $seller["city"]; ?>">
	  </div>	  
	   <div class="form-group">
		<label>State*</label>
		<input type="text" id="state" class="form-control" name="seller_location|state" placeholder="State"  value="<?php echo $seller["state"]; ?>"required>
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
	  	<input type="submit" value="Submit">
	</form>
  </div>
</div>
</center><br>

<script>
function getcityfrompin(){	
var pincode = document.getElementById("pincode").value;

if(pincode.length > 5){
 $.ajax({
        url: "getcity.php",
        type: "post",
        data:  {pin:pincode},
        success: function (response) {
			var names = response.split(",");
				if(names[0]){
				document.getElementById("city").value = names[0];
				}
				if(names[1]){
				document.getElementById("state").value = names[1];
				}
		},
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}
}


</script>
   <?php include("footer.php");?>