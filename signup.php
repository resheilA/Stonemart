<?php 
if($_SERVER["REQUEST_METHOD"] == "POST"){
	include_once("savedata.php"); 
	if(!isset($error_mysql)){
			header("location:login.php");
	}
}
include_once("functions.php");$uid = generateRandomString();
include_once("header.php");
?>
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Register As A Seller</h2>
  <hr>
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
	
	
	<h4>Company Details</h4><hr>	
	<form method="post" enctype="multipart/form-data">
	 <div class="form-group">
	 <input type="hidden" name="seller_business|uid" value="<?php echo $uid; ?>">	 
		<label>*Nature of Business</label>
		<select class="form-control" name="seller_business|nature_of_business">
		<option></option>
		<option value="Manufacturer">Manufacturer</option>
		<option value="Wholesaler">Wholesaler</option>
		<option value="Retailer">Retailer</option>
		</select>
	  </div>	  
	  <div class="form-group">
		<label>*Company Name</label>
		<input type="text" class="form-control" name="seller_general|name" placeholder="Enter your company name">
	  </div>
	  <div class="form-group">
		<label>*About the Company</label>
		<textarea class="form-control" name="seller_business|about_us" placeholder="About the company" required></textarea>
	  </div>	 	  
	  <div class="form-group">
		<label>Name of the CEO</label>
		<input type="text" class="form-control" name="seller_business|ceo" placeholder="Enter CEO's name">
	  </div>	 
	  <div class="form-group">
		<label>Enter your GST number</label>
		<input type="text" class="form-control" name="seller_business|gstnumber" placeholder="Enter your GST number">
	  </div>	 
	  <div class="form-group">
		<label>Establishment Year</label>
		<input type="number" class="form-control" name="seller_business|establishment_year" placeholder="Enter establishment year">
	  </div>	
	   <div class="form-group">
		<label>Number Of Employee</label>
		<input type="number" class="form-control" name="seller_business|employee" placeholder="Enter number of Employee">
	  </div>	
	  <div class="form-group">
		<label>Firm Status</label>
		<select class="form-control" name="seller_business|firm_status">
		<option></option>
		<option value="proprietor">Proprietor</option>
		<option value="privatelimited">Pvt Limited</option>
		<option value="publiclimited">Public Limited</option>
		<option value="llp">LLP</option>
		</select>
	  </div>
	  <div class="form-group">
		<label>Address</label>
		<textarea class="form-control" name="seller_location|address" placeholder="Enter your firm's address"></textarea>
	  </div>
	  <div class="form-group">
		<label>Pincode*</label>
		<input type="text" class="form-control" id="pincode" onkeyup="getcityfrompin()" name="seller_location|pincode" placeholder="Pincode" required>		
	  </div>
	  <div class="form-group">
		<label>City*</label>
		<input type="text" id="city" class="form-control" name="seller_location|city" placeholder="City" required>
	  </div>	  
	   <div class="form-group">
		<label>State*</label>
		<input type="text" id="state" class="form-control" name="seller_location|state" placeholder="State" required>
	  </div>	  
	  <input type="hidden" name="seller_certification|uid" value="<?php echo $uid; ?>">
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
		<label>Contact Number*</label>
		<input type="text" class="form-control" name="seller_contact|contact_no" placeholder="Enter your mobile number" required>
	  </div>
	  
	  <div class="form-group">
		<label>Other Contact Number</label>
		<input type="text" class="form-control" name="seller_contact|other_number" placeholder="Enter your mobile number">
	  </div>
	 <div class="form-group">
		<label>Contact Name</label>
		<input type="text" class="form-control" name="seller_contact|contact_name" placeholder="Contact Person Name" required>
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
		Upload Your Logo OR Shop Image : 	  
	  <input type="file" class="form-control mt-2" name="seller_general|logo|0|<?php echo $uid; ?>" placeholder="Choose a logo or shop image">
	  </div>
	  
	  <div class="form-group">
		<label>Email*</label>
		<input type="text" class="form-control" name="seller_general|email" placeholder="Enter your email address" required>
	  </div>
	  <div class="form-group">
		<label>Password*</label>
		<input type="password" class="form-control" name="seller_general|password" placeholder="Enter your password" requried>
	  </div>
	  <div class="form-group">
		<label>Verified Password*</label>
		<input type="password" class="form-control" name="vpassword" placeholder="Enter your password again" required>
	  </div>
	  	<input type="submit" value="Sign Up As Seller">
	</form>
  </div>
</div>
</center>

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
<?php include_once("footer.php"); ?>