 <?php include("header.php"); ?>
	<!--Products-->
<section class="product" style="padding-top: 8em;">
    <div class="container mt-4">        
<h3 class="pl-3">List Of Trainers
        <!-- Button to Open the Modal -->
		<button type="button" class="btn btn-primary ml-3 mb-0 btn d-sm-block d-md-none float-right"  data-toggle="modal" data-target="#myModal">
		  SORT
		</button>
		</h3>  
<nav class="navbar navbar-expand-sm bg-light d-md-block d-none">   
	<form class="form-inline" style="display:inline;" method="get">
	&nbsp&nbsp <font>Color</font>&nbsp&nbsp
	<select name="color_sort" class="form-control">		
		<option value="<?php if(isset($_GET['color_sort'])){echo $_GET['color_sort'];}?>"><?php if(isset($_GET['color_sort'])){echo $_GET['color_sort'];}?></option>	
		<option value=""></option>
		
	</select>
	&nbsp&nbsp <font>Type</font>&nbsp&nbsp
	<select name="type_sort" class="form-control">
		<option value="<?php if(isset($_GET['type_sort'])){echo $_GET['type_sort'];}?>"><?php if(isset($_GET['type_sort'])){echo $_GET['type_sort'];}?></option>	
		<option value=""></option>
		
	</select>
	&nbsp&nbsp <font>Form</font>&nbsp&nbsp
	<select name="form_sort" class="form-control">		
		<option value="<?php if(isset($_GET['form_sort'])){echo $_GET['form_sort'];}?>"><?php if(isset($_GET['form_sort'])){echo $_GET['form_sort'];}?></option>
		<option value=""></option>
		
	</select>
	&nbsp&nbsp <font>Finishing</font>&nbsp&nbsp
	<select name="color_finish" class="form-control">				
		<option value=""></option>
		
	</select>
	<input type="hidden" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
	<input type="submit" class="btn text-light m-1" value="SEARCH">
  </form>
</nav>		

<br>  
<div class="container" width="100%">
  <div class="row">
    <div class="col-lg-12 mx-auto">
	   <!-- List group-->
      <ul class="list-group shadow">

			   <!-- list group item-->
			<li class="list-group-item">
			  <!-- Custom content-->
			  <div class="media align-items-lg-center flex-column flex-lg-row p-3">
				<div class="media-body order-2 order-lg-1">
				  <h5 class="mt-0 font-weight-bold mb-2 mt-2">'. ucfirst($seller["name"]) .' - '.$seller["product_name"].'</h5>
				  <p class="font-italic text-muted mb-0 small">'.mb_strimwidth("<i class='fa fa-map-marker-alt'></i>  ".$seller["address"] , 0, 200, "...").'</p>
				  <div class="d-flex align-items-center justify-content-between mt-1">								
				  </div>
				   <h6 class="font-weight-bold my-2"><i class="fa fa-th-large"></i> '.$seller["type"].'&nbsp <i class="fa fa-paint-brush"></i>  '.$seller["color"].' </h6>
				   <h6 class="font-weight-bold my-2"><i class="fa fa-square"></i> '.$seller["form"].'&nbsp <i class="fa fa-shield-alt"></i>  '.$seller["finishing"].' </h6>
					<a href="seller.php?id='.$seller['uid'].'&pid='.$seller['pid'].'"><button class="btn mt-2">View Details</button></a>
				</div><img src="'.$seller['image'].'" alt="Generic placeholder image" width="200" class="ml-lg-5 order-1 order-lg-2 border border-secondary" data-toggle="modal" data-target="#imageModal" onclick="zoomimage(\''.$seller["image"].'\')">
			  </div>
			  <!-- End -->
			</li>
			<!-- End -->


      </ul>
      <!-- End -->
    </div>
  </div>
</div>
</div>
</div>
</section>

<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Sort By</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
				<form class="form-inline" style="display:inline;" method="get">
					<font color="">Color</font>&nbsp&nbsp
					<select name="color_sort" class="form-control">
						
					</select>
					<br>
					<font color="black">Type</font>&nbsp&nbsp
					<select name="type_sort" class="form-control">
						
					</select>
					<br>
					<font color="black">Form</font>&nbsp&nbsp
					<select name="form_sort" class="form-control">
						<option></option>
						
					</select>
					<br>
					<font color="black">Finishing</font>&nbsp&nbsp
					<select name="color_finish" class="form-control">
						<option></option>
						
					</select>					
				  

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
	  <input type="hidden" name="search" value="<?php if(isset($_GET['search'])){echo $_GET['search'];}?>">
		<input type="submit" class="btn text-light m-1" value="Search">  </form>      
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

<?php include("footer.php"); ?>