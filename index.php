<?php 
include("getalldata.php");
include("functions.php");

$sql = "SELECT * FROM seller_general
			 INNER JOIN seller_location ON seller_general.uid = seller_location.uid			 			 
			 INNER JOIN seller_business ON seller_general.uid = seller_business.uid	
			 INNER JOIN seller_product ON seller_general.uid = seller_product.uid	
			 ORDER BY seller_general.added_on DESC
			 LIMIT 3
			" ;
			 $sellers = singletable_all( $sql );	
?>
<?php include("header.php"); ?>

<!--Banner-->
<div class="hero-image" style="height:60%;">
    <div class="hero-text">
      <h1 style="font-size:50px"><b>Buy And Sell Stones</b></h1>
      <p>India's first and only place for exclusive listing of marbles, Granites and etc</p>
      <a href="searchproduct.php?search="><button>View list</button></a>
    </div>
  </div>
<!--Banner End-->
 <!-- About -->
  
  <section class="about">
  <div class="container" >
  <div class="row">

    <div class="col-md-6">
      <img class="img-fluid" src="img/granitethreee.png" alt="">
    </div>

    <div class="col-md-6">
      <h3 class="my-3">What are we doing?</h3>
      <p>We are India's only website to list different stones, granites, marble slabs with proper information of the product and of the sellers with their valid contact information. If you are an architect, interior or builder or looking to buy stone for your home you are at correct website. </p>
      <p>If you own a shop or showroom or manufacture stones. This is the hub of stones. Grow your business by bringing it online.  </p>
</div>
  </div>
</section>

    <!-- About End -->

<!--Products-->
<section class="product">
<div class="container mb-5 mt-5">
    <h2>Registered Vendors With Us</h2>
    <div class="row">
	<?php 
	/*
	foreach($sellers as $seller){
		echo '
        <div class="col-md-4">
            <div class="card mt-3">
                <div class="product-1 align-items-center text-center" style="max-width:100%;">
                    <div class="image-container" style="height:13em"> <img class="xyz rounded p-3" src="'.$seller["logo"].'" style="max-width:100%;"> </div>
                    <div class="mt-1"><b> <span>'.substr_replace(ucfirst($seller["name"]), "...", 25).'</span></b></div>
					<div class=""><span>'.$seller["nature_of_business"].'</span>
								-<span>'.$seller["city"].'</span>
                    </div>
                </div>
                <a href="seller.php?id='.$seller["uid"].'"><div class="p-3  text-center text-white mt-3 cursor cart"> <span class="text-uppercase cart-text">View Details</span> </div></a>
            </div>
        </div>';
	}
	*/
	?>
        
    </div>
</div>
<center><a href="searchproduct.php?search="><button>View list of Products by Vendors</button></a></center>
</section> 
<!--Products end-->

<!--services-->
<section class="services">
<div class="container text-center">
    <div class="card">
        <h3 class="mb-5">Your simple, beautiful digital storefront</h3>
        <div class="row">
            <div class="col-md-4">
                <div class="text-center">
                    <div class="mt-2"> <img src="https://i.imgur.com/2tx0muB.png" width="50" height="50" /> </div>
                    <h5 class="mt-3">Start Selling Online</h5> <small>Start selling marbles, granites, tiles, sandstones or just about any stone slab.</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <div class="mt-2"> <img src="https://i.imgur.com/6NHM9Xy.png" width="50" height="50" /> </div>
                    <h5 class="mt-3">Get a website for your business</h5> <small>Start selling with a website that will match your brand and start selling across India.</small>
                </div>
            </div>
            <div class="col-md-4">
                <div class="text-center">
                    <div class="mt-2"> <img src="https://i.imgur.com/9qaHVGj.png" width="50" height="50" /> </div>
                    <h5 class="mt-3">24x7 Support</h5> <small>Our seemless support will make sure that everybrand reaches it right crowd.</small>
                </div>
            </div>
        </div>
        <div class="button mt-5"> <button class="btn btn-primary pro-button">Add a product <i class="fa fa-long-arrow-right ml-2 mt-1"></i></button> </div>
    </div>
</div>
</section>
<!--services end-->
   <!-- Footer -->

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