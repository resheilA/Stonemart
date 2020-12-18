<?php ob_start(); 
include("header.php"); ?>
<?php 

if(isset($_GET['id']) && $_GET['id'] != null)
  {
	$_SESSION["AUTH_ID"] = $_GET['id'];
  }
if(isset($_GET['pid']) && $_GET['pid'] != null)
  {
	$_SESSION["AUTH_PID"] = $_GET['pid'];
  }

if(isset($_COOKIE["userName"]) && isset($_COOKIE["userContact"]))
{
	header("Location:seller.php?id=".$_SESSION["AUTH_ID"]."&pid=".$_SESSION["AUTH_PID"]);
}

    
if($_SERVER["REQUEST_METHOD"] == "POST")
{
	if(isset($_GET["verify"]) && !isset($_GET["otp"]))
	{		
		if(!isset($_COOKIE["otp_up"]))
		{
			$_POST["client_details|otp_code"] = rand(100000,999999);		
			$_SESSION["AUTH_NAME"] = $_POST["client_details|clientname"];
			$_SESSION["AUTH_NUMBER"] = $_POST["client_details|clientnumber"];			
			include_once("saveupdate.php");
			setcookie("otp_up", true, time() + (60)); 	
		}		
	}
	
	if(isset($_GET["verify"]) && isset($_GET["otp"]))
	{			
			$sql_client = "SELECT * FROM client_details where clientnumber = '".$_SESSION["AUTH_NUMBER"]."'";
			include("getsingledata.php");
			$client_data = singletable($sql_client);	
			$otp_post = $_POST["otp"];
			
			
			if($client_data["otp_code"] == $otp_post)
			{
				setcookie("userName", $_SESSION["AUTH_NAME"], time() + (86400 * 30), "/"); // 86400 = 1 day
				setcookie("userContact", $_SESSION["AUTH_NUMBER"], time() + (86400 * 30), "/"); // 86400 = 1 day
				
				header("Location:seller.php?id=".$_SESSION["AUTH_ID"]."&pid=".$_SESSION["AUTH_PID"]);
			}
			else
			{
				$_GET["error"] = "Please enter correct OTP";				
			}		
	}
}
?>

<style>
.login-clean {
  background:#f1f7fc;
  padding:80px 0;
}

.login-clean form {
  max-width:320px;
  width:90%;
  margin:0 auto;
  background-color:#ffffff;
  padding:40px;
  border-radius:4px;
  color:#505e6c;
  box-shadow:1px 1px 5px rgba(0,0,0,0.1);
}

.login-clean .illustration {
  text-align:center;
  padding:0 0 20px;
  font-size:100px;
  color:rgb(244,71,107);
}

.login-clean form .form-control {
  background:#f7f9fc;
  border:none;
  border-bottom:1px solid #dfe7f1;
  border-radius:0;
  box-shadow:none;
  outline:none;
  color:inherit;
  text-indent:8px;
  height:42px;
}

.login-clean form .btn-primary {
  border:none;
  border-radius:4px;
  padding:11px;
  box-shadow:none;
  margin-top:26px;
  text-shadow:none;
  outline:none !important;
}

.login-clean form .btn-primary:hover, .login-clean form .btn-primary:active {
  background:#eb3b60;
}

.login-clean form .btn-primary:active {
  transform:translateY(1px);
}

.login-clean form .forgot {
  display:block;
  text-align:center;
  font-size:12px;
  color:#6f7a85;
  opacity:0.9;
  text-decoration:none;
}

.login-clean form .forgot:hover, .login-clean form .forgot:active {
  opacity:1;
  text-decoration:none;
}


</style>
<br><br><br><br><br>

<?php 
if(!isset($_GET["verify"]))
{	
	echo '
   <div class="login-clean">        
		<form method="post" action="?verify=yes">
            <h2>Signup to get access</h2>			
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="text" name="client_details|clientname" placeholder="Name" value="';  if(isset($_SESSION["AUTH_NAME"])){echo $_SESSION["AUTH_NAME"];} echo '"></div>
            <div class="form-group"><input class="form-control" type="number" name="client_details|clientnumber" placeholder="Contact Number" value="'; if(isset($_SESSION["AUTH_NUMBER"])){echo $_SESSION["AUTH_NUMBER"];} echo '"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Get Verified</button></div><a class="forgot">*By signing up you agree to our terms and conditions</a>
		</form>
    </div>';
}
elseif((isset($_GET["verify"])))
{
	if(!isset($_SESSION["AUTH_NAME"])){echo '<script>window.location = "clientsignup.php"</script>';}	
		
	echo '	
   <div class="login-clean">        
		<form method="post" action="?verify=yes&otp=yes">
            <h2>Verify by putting the OTP you have received on your phone</h2>	
            <div>'; 
			if(isset($_GET["error"]))
	{
		echo "<h6 class='text-danger'><br>".$_GET["error"]."</h6>";
	}	
	
	echo '</div>
            <div class="form-group"><input class="form-control" type="text" name="otp" placeholder="One Time Password"></div>            
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Get Details</button></div>
			';
		if(isset($_COOKIE["otp_up"])){
			echo "You can resend an OTP only after 60 seconds";
		}	
		else{
			echo "<a href='clientsignup.php'>Resend OTP</a>";
		}
	echo '		
		</form>
    </div>';
}
	
?>

<?php include("footer.php"); ?>