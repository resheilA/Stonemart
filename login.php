<?php include("header.php"); ?>
<?php 
if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	include("getsingledata.php"); 
	$sql = "SELECT * FROM seller_general WHERE email = '".$_POST["email"]."' AND password = '".$_POST["password"]."'";
	$result = singletable( $sql); 
	if(!isset($result["error"]))
	{		
		$_SESSION["uid"] = $result["uid"];
		$_SESSION["email"] = $result["email"];		

		
		$sql_get_did = "SELECT * FROM website_domain WHERE uid = '".$result["uid"]."'";
		$result_did = singletable( $sql_get_did); 
		if(!isset($result_did["error"]))
		{
			 $_SESSION["did"] = $result_did["did"];
		}		
		echo "<script>window.location.replace('seller.php');</script>";
	}
	else{
		$result["error"] = "User Not Found ! Try Again.";
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
<div class="login-clean">
        <form method="post">
            <h2>Login Seller</h2>
			
			<?php if(isset($result["error"])){echo '<div class="alert alert-danger"
							<strong>'.$result["error"].'</strong> 
							</div>';}?>
            <div class="illustration"><i class="icon ion-ios-navigate"></i></div>
            <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email"></div>
            <div class="form-group"><input class="form-control" type="password" name="password" placeholder="Password"></div>
            <div class="form-group"><button class="btn btn-primary btn-block" type="submit">Log In</button></div><a href="#" class="forgot">Forgot your email or password?</a></form>
    </div>
<?php include("footer.php"); ?>