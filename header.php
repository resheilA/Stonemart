<?php include_once("session.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/stonemarts/templates/" />
    <title>StoneMarts</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.14.0/css/all.min.css">
  <link rel="stylesheet" href="http://webportal.in/stonemarts/templates/style.css">
  <link rel="stylesheet" href="http://webportal.in/stonemarts/templates/vendordetails.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  
</head>
<body>
<!-----Navbar------->

<header class="section-header sticky-top" style="position:fixed; width:100%;" >
    <section class="header-main border-bottom">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-lg-3 col-sm-4 col-md-4 col-5"> <a href="#" class="brand-wrap" data-abc="true">
                        <!-- <img class="logo" src="http://ampexamples.com/data/upload/2017/08/bootstrap2_logo.png"> --> <span class="logo">Stonemarts</span> </a> </div>
                <div class="col-lg-4 col-xl-5 col-sm-8 col-md-4 d-none d-md-block">
                    <form action="listsellers.php" method="get" class="search-wrap">
                        <div class="input-group w-100"> <input name="search" type="text" class="form-control search-form" style="width:55%;" placeholder="Search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                            <div class="input-group-append"> <button class="btn btn-primary search-button" type="submit"> <i class="fa fa-search"></i> </button> </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-5 col-xl-4 col-sm-8 col-md-4 col-7">
                    <div class="d-flex justify-content-end"> 
                        <div class="dropdown btn-group">
                            
							<?php 
							if(!isset($_SESSION['uid']))
							{
								echo '
							<span class="vl"></span> <a class="nav-link nav-user-img" href="login.php"><span class="login">LOGIN</span></a>
							';
							}
							else
							{
								echo '
							<span class="vl"></span> <a class="nav-link nav-user-img" href="logout.php"><span class="login">LOGOUT</span></a>
							';
							}
							?>
							
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <nav class="navbar navbar-expand-md navbar-main border-bottom">
        <div class="container-fluid">
            <form class="d-md-none my-2" method="get" action="listsellers.php">
                <div class="input-group">
				<input type="text" name="search" class="form-control" placeholder="Search" required="" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
                    <div class="input-group-append"> <button type="submit" class="btn btn-secondary"> <i class="fa fa-search"></i> </button> </div>
                </div>
            </form> <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#dropdown6" aria-expanded="false"> <span class="navbar-toggler-icon"></span> </button>
            <div class="navbar-collapse collapse" id="dropdown6" style="">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"> <a class="nav-link" href="index.php" data-abc="true">Home</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="listsellers.php" data-abc="true">Products</a> </li>

                    <li class="nav-item"> <a class="nav-link" href="about.php" data-abc="true">About</a> </li>
                    <li class="nav-item"> <a class="nav-link" href="contact.php" data-abc="true">Contact</a> </li>
              
                    <li class="nav-item"> <a class="nav-link" href="support.php" data-abc="true">Support</a> </li>
                    <?php 
					if(!isset($_SESSION['uid']))
					{
						echo '
					<li class="nav-item"> <a class="nav-link" href="signup.php" data-abc="true">Signup as seller</a> </li>
					';
					}
					else
					{
						echo '
					<li class="nav-item"> <a class="nav-link" href="seller.php" data-abc="true">Your Profile</a> </li>
					';
					}
					?>
                </ul>
            </div>
        </div>
    </nav>
</header>
<!-----Navbar End------->