<?php include_once("header.php"); ?>
<?php include_once("functions.php");?>
<?php 
	if(isset($_SESSION["did"]))
	{	
	echo "<script>window.location.replace('https://stonemarket.in/managewebsite.php');</script>";
	}
?>
<!-----Navbar End------->
 <br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Search For Domain Name</h2>
  <hr>
  <?php if(isset($error_mysql)){echo $error_mysql;}?>
  <form method="get">
      <div class="form-group">
		<label>Enter the domain name you want to buy :</label>
		<input type="text" class="form-control" name="searchdomain" value="<?php if(isset($_GET["searchdomain"])){echo $_GET["searchdomain"];} ?>" placeholder="Enter you Domain name">
		<input type="submit" value="Search">
	  </div>
  </form>
  
 <?php 
 if(isset($_GET["searchdomain"])){
  $domain_status = get_tld_availablity($_GET["searchdomain"]);
     foreach($domain_status as $statusstring){
     echo "<div class='row' style='border:1px solid black;'>";     
     $status = explode("|",$statusstring);
     if($status[1] == "available"){$status[1] = "available";}else{$status[1] = "not available";}
     echo "<div class='col-8 p-3'>".$status[0].".".$status[2]." is ".$status[1]."</div>";
     if($status[1] == "available")
     {
         echo "<div class='col-4'><br> <a href='confirmregistration.php?bookdomain=".$status[0].".".$status[2]."' onclick=\"return confirm('Are you sure you want to purchase ".$status[0].".".$status[2]." ? This action cannot be reverted');\"><button>Book this domain</button></a></div>";
     }
     echo "</div>";
     }
 }
 
  function get_tld_availablity($domain_name){

    $domain_split = preg_split('/(?=\.[^.]+$)/', $domain_name);
    $tld = array("com", "in", "net", "org", "co.in");
    
    $count =0;
    include("keys.php");
    
    for($count=0;$count<count($tld);$count++)
    {
    $url ='https://test.httpapi.com/api/domains/available.json?auth-userid='.$authid.'&api-key='.$apikey.'&domain-name='.$domain_split[0].'&tlds='.$tld[$count];
    
    $jsona = file_get_contents($url); 
    $myArray = json_decode($jsona, true);
    
    $value[$count] = $domain_split[0]."|".$myArray[$domain_split[0].".".$tld[$count]]['status']."|".$tld[$count];
    }
    
    return $value;
    }

 
 ?>
    </div>
</div>
<?php include_once("footer.php"); ?>