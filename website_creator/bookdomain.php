<?php 
include("header.php");
function get_contact_details($customer_id){
    include("keys.php");
$url ='https://test.httpapi.com/api/contacts/default.json?auth-userid='.$authid.'&api-key='.$apikey.'&customer-id='.$customer_id.'&type=Contact';
$jsona = file_get_contents($url); 
$myArray = json_decode($jsona, true);
//var_dump($myArray);
return $myArray['Contact']['registrant'];
}


function sign_up($username, $password, $name, $company, $addressline, $city, $state, $country, $zip, $callcode, $number)
{
include("keys.php");
$addressline = str_replace(' ', '', $addressline);
$signup_url = 'https://test.httpapi.com/api/customers/signup.json?auth-userid='.$authid.'&api-key='.$apikey.'&username='.$username.'&passwd='.$password.'&name='.urlencode($name).'&company='.urlencode($company).'&address-line-1='.urlencode($addressline).'&city='.$city.'&state='.$state.'&country=IN&zipcode='.$zip.'&phone-cc='.$callcode.'&phone='.$number.'&lang-pref=en';

$details = file_get_contents($signup_url); 
//var_dump($details);
return $details;
}


function get_customer_details($username){
    include("keys.php");
echo $url ='https://test.httpapi.com/api/customers/details.json?auth-userid='.$authid.'&api-key='.$apikey.'&username='.$username;

$jsona = file_get_contents($url); 
$myArray = json_decode($jsona, true);
return $myArray['customerid'];
}



function add_funds($cus_id, $amt, $desc, $key){
    include("keys.php");
$url ='https://test.httpapi.com/api/billing/add-customer-fund.json?auth-userid='.$authid.'&api-key='.$apikey.'&customer-id='.$cus_id.'&amount='.$amt.'&description='.$desc.'&transaction-type=credit&transaction-key='.$key.'&update-total-receipt=true'; 
    $details = file_get_contents($url); 
$myArray = json_decode($details, true);

return $details;
}

function register_domain($customer_id, $domain_name)
{
include("keys.php");
$contact_id = get_contact_details($customer_id);
$url ='https://test.httpapi.com/api/domains/register.json?auth-userid='.$authid.'&api-key='.$apikey.'&domain-name='.$domain_name.'&years=1&ns=dns3.parkpage.foundationapi.com&ns=dns4.parkpage.foundationapi.com&customer-id='.$customer_id.'&reg-contact-id='.$contact_id.'&admin-contact-id='.$contact_id.'&tech-contact-id='.$contact_id.'&billing-contact-id='.$contact_id.'&invoice-option=KeepInvoice';
$jsona = file_get_contents($url); 
$myArray = json_decode($jsona, true);
//var_dump($myArray);
return $myArray;
}

function pay_customer_invoice($invoice_id)
{
    
include("keys.php");
$url ='https://test.httpapi.com/api/billing/customer-pay.json?auth-userid='.$authid.'&api-key='.$apikey.'&invoice-ids='.$invoice_id;
    
$details = file_get_contents($url); 
$myArray = json_decode($details, true);

return $myArray;
}

//var_dump($_SESSION);
if(isset($_SESSION["uid"]) && isset($_SESSION["bookdomain"])) 
{

include("getalldata.php"); 
	
	$sql = "SELECT * FROM seller_general
			  JOIN seller_location ON seller_general.uid = seller_location.uid			 
			  JOIN seller_business ON seller_general.uid = seller_business.uid			 
			  JOIN seller_contact ON seller_general.uid = seller_contact.uid			 
			 WHERE seller_general.uid = '".$_SESSION["uid"]."'
			 ";
			 
	$sellers = singletable_all( $sql );    
	$seller = $sellers[0];    
    //var_dump($seller);
    
$sign_up = sign_up($seller["email"], "Raj!@982q",  $seller["ceo"],  $seller["name"],  $seller["address"],  $seller["city"],  $seller["state"], "India",  $seller["pincode"], "91", $seller["contact_no"]);                            

$cus_id = get_customer_details($seller["email"]);
 // $cus_id = $sign_up;

if($cus_id != NULL) {
    
$desc  = "Payment_automatic";
//add_funds($cus_id, '1600', $desc, rand(1000000,9999999));


//$cus_id = 22210402;
$register_domain = register_domain(strip_tags($cus_id), $_SESSION["bookdomain"]);
$invid = $register_domain["invoiceid"];
$domain_status = $register_domain["actionstatusdesc"];

//var_dump($register_domain);

$inv_id =  $register_domain["invoiceid"];

$invoice_id = $inv_id;
//$cus_id  = 22210566;
include_once("functions.php");
$did = generateRandomString();
$sql = "INSERT INTO website_domain (uid, did)
VALUES ('".$uid."', '".$did."', '".$_SESSION["bookdomain"]."')";

if ($conn->query($sql) === TRUE) {
	$_SESSION["did"] = $did;
//  echo "New record created successfully";
} else {
 // echo "Error: " . $sql . "<br>" . $conn->error;
}





//pay_customer_invoice($invoice_id);
}
}
else
{
    echo "Hello";
}

?>
<center>
<div class="row"><center>
    <div class="col-12 m-5" style="border:1px solid black;">
        <i class="fa fa-check-circle" style="color:green;font-size:20px;" aria-hidden="true"></i><br>
        <?php echo $domain_status.".Registered domain name is ".$_SESSION["bookdomain"].". <br>Your invoice id : ".$inv_id; ?>
		<a href="managewebsite.php">Back To DashBoard </a>
    </div>
    </center>
</div>
</center>