<?php include_once("header.php"); ?>
<br><br><br><br><br><br>
<div class="container" width="100%">
  <div class="row">
    <div class="col-lg-12 mx-auto">
	   <!-- List group-->
      <ul class="list-group shadow">
	
			   <!-- list group item-->
        <li class="list-group-item">
          <!-- Custom content-->
          <div class="media align-items-lg-center flex-column flex-lg-row">
            <div class="media-body order-2 order-lg-1">
              <h2 class="mt-0 font-weight-bold mb-2 mt-2">'.$seller["name"].'</h2>
              <p class="font-italic text-muted mb-0 medium">'.mb_strimwidth("<i class='fa fa-map-marker-alt'></i>  ".$seller["address"] , 0, 200, "...").'</p>
              <div class="d-flex align-items-center justify-content-between mt-1">			
                <ul class="list-inline small">
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star text-success"></i></li>
                  <li class="list-inline-item m-0"><i class="fa fa-star-o text-gray"></i></li>
                </ul>
              </div>
			   <h6 class="font-weight-bold my-2"><i class="fa fa-user"></i> '.$seller["ceo"].'&nbsp <i class="fa fa-industry"></i>  '.ucfirst($seller["nature_of_business"]).' </h6>
				
							<a href="editseller.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Edit Profile</button></a>	
							<a href="addproduct.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Add Products</button></a>					
							<a href="listproducts.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Edit Products</button></a>					
							<a href="managewebsite.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Manage Website</button></a>		
							<a href="listproducts.php"><button class="btn btn-lg m-1" style="display:inline;color:white;">Analytics</button></a>		
							
				
            </div><img src="'.$seller['logo'].'" alt="Product Image" width="200" class="ml-lg-5 order-1 order-lg-2">
          </div>		  
          <!-- End -->
        </li>
        <!-- End -->

	

      </ul>
      <!-- End -->
    </div>
  </div>
</div>


<div class="container mb-5">
              <div class="row">
                <div class="col-lg-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Home</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">About us</a>
                      <a class="nav-item nav-link active" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Products</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">Contact us</a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="p-3 tab-pane fade show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
					<?php echo "".$seller['about_us'].""; ?>
                    </div>
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					  <h3>&nbsp Business Details</h3>
					  <table border='1' class="table" style="">
						<tbody>
						<tr>
							<td>Nature Of Business</td><td><?php echo "".$seller['nature_of_business'].""; ?></td>
						</tr>
						<tr>
							<td>GST Number</td><td><?php echo "".$seller['gstnumber'].""; ?></td>
						</tr>
						<tr>	
							<td>CEO</td><td><?php echo "".$seller['ceo'].""; ?></td>
						</tr>
						<tr>	
							<td>Number Of Employee</td><td><?php echo "".$seller['employee'].""; ?></td>
						</tr>
						<tr>	
							<td>Establisment Year</td><td><?php echo "".$seller['establishment_year'].""; ?></td>
						</tr>						
						<tr>	
							<td>Firm Status</td><td><?php echo "".$seller['firm_status'].""; ?></td>
						</tr>
						</tbody>
					  </table>		
                      <h3>&nbsp Certification</h3>
					 
                    </div>
                    <div class="tab-pane active" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
					<div class="container">
						<form class="form-inline"  style="display:inline;"  method="get">
						<input type="hidden" name="id" value="<?php echo $search; ?>">
							<select name="type_sort" class="form-control " style="display:inline;max-width:60%;">
								<option></option>
							
							</select>
					   <input type="submit"  style="display:inline;" class="btn text-light m-1" value="Sort"></form>     
					</div><br><br>
					
                    </div>
                    <div class="tab-pane fade" id="nav-about" role="tabpanel" aria-labelledby="nav-about-tab">
						<h3>&nbsp Contact Details</h3>
					  <table border='1' class="table" style="">
						<tbody>
						<tr>
							<td>Contact Name</td><td><?php echo "".$seller['contact_name'].""; ?></td>
						</tr>
						<tr>
							<td>Instagram</td><td><?php echo "".$seller['instagram'].""; ?></td>
						</tr>
						<tr>	
							<td>Facebook</td><td><?php echo "".$seller['facebook'].""; ?></td>
						</tr>
						<tr>	
							<td>Twitter</td><td><?php echo "".$seller['twitter'].""; ?></td>
						</tr>
						<tr>	
							<td>Contact no</td><td>+91 <?php echo "".$seller['contact_no'].""; ?></td>
						</tr>
						<tr>	
							<td>Other Number</td><td>+91 <?php echo "".$seller['other_number'].""; ?></td>
						</tr>						
						</tbody>
					  </table>		
                    </div>
                  </div>
                
                </div>
              </div>
        </div>
      </div>
</div>


<!-- The Modal -->
<div class="modal mt-5" id="imageModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal body -->
      <div class="modal-body">
        <img src="" id="modalimage" class="img-fluid"/>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script>
function zoomimage(imgsrc){
	$("#modalimage").attr("src",imgsrc);
}
</script>
<?php include_once("footer.php"); ?>