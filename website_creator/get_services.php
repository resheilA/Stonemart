<?php include_once("header.php"); ?>
<?php 
if(isset($_SESSION["did"]))
	{
	$did = $_SESSION["did"];
	}
	else
	{
	echo "<script>window.location.replace('https://stonemarket.in/website_creator/searchdomain.php');</script>";
	}

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET["q"]) && ($_GET["q"] == "content"))
{
	if(!empty($_POST["website_service_content|service_content"]) || !empty($_POST["website_service_content|service_name"])){	
	$_POST["website_service_content|Locked"] = $did;	
	include_once("../savedata.php"); 
	header("location:get_services.php");
	}		
}
else if($_SERVER["REQUEST_METHOD"] == "POST")
{	
	include_once("../savedata.php"); 
}

if(isset($_GET["q"]) && $_GET["q"] == "d" && isset($_GET["id"]))
{
	include_once("../deletedata.php");
	$sql = "DELETE FROM website_services where did = '".$did."' AND service_id = '".$_GET["id"]."'";
	deleterow($sql, 1);	
	header("location:get_services.php");
}


include_once("../functions.php");

include("../getalldata.php"); 
	$sql = "SELECT * FROM website_service_content WHERE  Locked = '".$did."' OR Locked = 0 ORDER BY no DESC";
			 
	$website_services = singletable_all( $sql );	
	
	
	$sql = "SELECT * FROM website_services INNER JOIN website_service_content ON website_services.service_id = website_service_content.no";
			 
	$web_service = singletable_all( $sql );	
?>	


<br><br><br><br><br>
 <center>
<div class="card col-lg-9">
  <div class="card-body text-left">
  <h2>Edit A Seller Website</h2>
  <hr>
  



<h4>Services Your Provide To Your Customer
	
	<!-- Button to Open the Modal -->
	<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#chooseservice">
	  Choose
	</button>
	</h4><hr>	<br>
	<?php 
	
	if(!isset($web_service["error"])){
	 foreach($web_service as $service)
	 {
								echo "		<div class='row'>
											<div class='col-sm-3'><b><i class='fa fa-".$service["icon"]."'></i> ".$service["service_name"]."</b></div>
											<div class='col-sm-6'>".$service["service_content"]."</div>
											<div class='col-sm-3'>
											<a href='?q=d&id=".$service["no"]."'><button>Delete</button></a></div>						
											</div>										
											<hr>
											";							 							 
							 }
	}
	else	
	{
		echo "Please add new service by clicking on Add button";
	}
	?>						 
		</div>
	<!-- The Modal -->
	<div class="modal" id="chooseservice">
	  <div class="modal-dialog">
		<div class="modal-content">

		  <!-- Modal Header -->
		  <div class="modal-header">
			<h4 class="modal-title">Choose Services You Provide</h4>
			<button type="button" class="close" data-dismiss="modal">&times;</button>
		  </div>

		  <!-- Modal body -->
		  <div class="modal-body">			
				<!-- Nav tabs -->
				<ul class="nav nav-tabs">
				  <li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#home">Choose</a>
				  </li>
				  <li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#menu1">Add New</a>
				  </li>
				</ul>

				<!-- Tab panes -->
				<div class="tab-content">
				  <div class="tab-pane container active" id="home">
					<table>
						<tbody>
							<?php 
							 foreach($website_services as $services)
							 {
								echo '<tr>
								
											<td><div class="form-check-inline">
											<form method="post">
							<input name="website_services|did" type="hidden" value="'. $did .'">
							
  <label class="form-check-label">
    <input name="website_services|service_id" type="hidden" value="'.$services["no"].'"><b><i class="fa fa-'.$services["icon"].'"></i> '.$services["service_name"].'</b>	
  </label>
</div><input type="submit" value="Choose" class="float-right">
					</form>
</td>			
									  </tr>';
							 }
							?>
								
						</tbody>
					</table>
					
				  </div>				  
				  <div class="tab-pane container fade" id="menu1">					
				  <div class="form-check-inline">
					<form method="post" class="text-left" action="?q=content"><br>
						<select  class="form-check-label" name="website_service_content|icon" style="font-family: 'Lato', 'Font Awesome 5 Free'; width:100%;">
							<option value="address-card">&#xf2bb; address-card</option>
							<option value="angry">&#xf556; angry</option>
							<option value="arrow-alt-circle-down">&#xf358; arrow-alt-circle-down</option>
							<option value="arrow-alt-circle-left">&#xf359; arrow-alt-circle-left</option>
							<option value="arrow-alt-circle-right">&#xf35a; arrow-alt-circle-right</option>
							<option value="arrow-alt-circle-up">&#xf35b; arrow-alt-circle-up</option>
							<option value="bell">&#xf0f3; bell</option>
							<option value="bell-slash">&#xf1f6; bell-slash</option>
							<option value="bookmark">&#xf02e; bookmark</option>
							<option value="building">&#xf1ad; building</option>
							<option value="calendar">&#xf133; calendar</option>
							<option value="calendar-alt">&#xf073; calendar-alt</option>
							<option value="calendar-check">&#xf274; calendar-check</option>
							<option value="calendar-minus">&#xf272; calendar-minus</option>
							<option value="calendar-plus">&#xf271; calendar-plus</option>
							<option value="calendar-times">&#xf273; calendar-times</option>
							<option value="caret-square-down">&#xf150; caret-square-down</option>
							<option value="caret-square-left">&#xf191; caret-square-left</option>
							<option value="caret-square-right">&#xf152; caret-square-right</option>
							<option value="caret-square-up">&#xf151; caret-square-up</option>
							<option value="chart-bar">&#xf080; chart-bar</option>
							<option value="check-circle">&#xf058; check-circle</option>
							<option value="check-square">&#xf14a; check-square</option>
							<option value="circle">&#xf111; circle</option>
							<option value="clipboard">&#xf328; clipboard</option>
							<option value="clock">&#xf017; clock</option>
							<option value="clone">&#xf24d; clone</option>
							<option value="closed-captioning">&#xf20a; closed-captioning</option>
							<option value="comment">&#xf075; comment</option>
							<option value="comment-alt">&#xf27a; comment-alt</option>
							<option value="comment-dots">&#xf4ad; comment-dots</option>
							<option value="comments">&#xf086; comments</option>
							<option value="compass">&#xf14e; compass</option>
							<option value="copy">&#xf0c5; copy</option>
							<option value="copyright">&#xf1f9; copyright</option>
							<option value="credit-card">&#xf09d; credit-card</option>
							<option value="dizzy">&#xf567; dizzy</option>
							<option value="dot-circle">&#xf192; dot-circle</option>
							<option value="edit">&#xf044; edit</option>
							<option value="envelope">&#xf40e0 envelope </option>
							<option value="envelope-open">&#xf2b6; envelope-open</option>
							<option value="eye">&#xf06e; eye</option>
							<option value="eye-slash">&#xf070; eye-slash</option>
							<option value="file">&#xf15b; file</option>
							<option value="file-alt">&#xf15c; file-alt</option>
							<option value="file-archive">&#xf1c6; file-archive</option>
							<option value="file-audio">&#xf1c7; file-audio</option>
							<option value="file-code">&#xf1c9; file-code</option>
							<option value="file-excel">&#xf1c3; file-excel </option>
							<option value="file-image">&#xf1c5; file-image</option>
							<option value="file-pdf">&#xf1c1; file-pdf</option>
							<option value="file-powerpoint">&#xf1c4; file-powerpoint</option>
							<option value="file-video">&#xf1c8; file-video</option>
							<option value="file-word">&#xf1c2; file-word</option>
							<option value="flag">&#xf024; flag</option>
							<option value="flushed">&#xf579; flushed</option>
							<option value="folder">&#xf07b; folder</option>
							<option value="folder-open">&#xf07c; folder-open </option>
							<option value="frown">&#xf119; frown</option>
							<option value="frown-open">&#xf57a; frown-open</option>
							<option value="futbol">&#xf1e3; futbol</option>
							<option value="gem">&#xf3a5; gem</option>
							<option value="grimace">&#xf57f; grimace</option>
							<option value="grin">&#xf580; grin</option>
							<option value="grin-alt">&#xf581; grin-alt</option>
							<option value="grin-beam">&#xf582; grin-beam</option>
							<option value="grin-beam-sweet">&#xf583; grin-beam-sweet </option>
							<option value="grin-hearts">&#xf584; grin-hearts</option>
							<option value="grin-squint">&#xf585; grin-squint</option>
							<option value="grin-squint-tears">&#xf586; grin-squint-tears</option>
							<option value="grin-stars">&#xf587; grin-stars</option>
							<option value="grin-tears">&#xf588; grin-tears</option>
							<option value="grin-tongue">&#xf589; grin-tongue</option>
							<option value="grin-tongue-squint">&#xf58a; grin-tongue-squint</option>
							<option value="grin-tongue-wink">&#xf58b; grin-tongue-wink</option>
							<option value="grin-wink">&#xf58c; grin-wink </option>
							<option value="hand-lizard">&#xf258; hand-lizard</option>
							<option value="hand-paper">&#xf256; hand-paper</option>
							<option value="hand-peace">&#xf25b; hand-peace</option>
							<option value="hand-point-down">&#xf0a7; hand-point-down</option>
							<option value="hand-point-left">&#xf0a5; hand-point-left</option>
							<option value="hand-point-right">&#xf0a4; hand-point-right</option>
							<option value="hand-point-up">&#xf0a6; hand-point-up</option>
							<option value="hand-pointer">&#xf25a; hand-pointer</option>
							<option value="hand-rock">&#xf255; hand-rock </option>
							<option value="hand-scissors">&#xf257; hand-scissors</option>
							<option value="hand-spock">&#xf259; hand-spock</option>
							<option value="handshake">&#xf2b5; handshake</option>
							<option value="hdd">&#xf0a0; hdd</option>
							<option value="heart">&#xf004; heart</option>
							<option value="home">&#xf015; home</option>
							<option value="hospital">&#xf0f8; hospital</option>
							<option value="hourglass">&#xf254; hourglass</option>
							<option value="id-badge">&#xf2c1; id-badge</option>
							<option value="id-card">&#xf2c2; id-card </option>
							<option value="image">&#xf03e; image</option>
							<option value="images">&#xf302; images</option>
							<option value="keyboard">&#xf11c; keyboard</option>
							<option value="kiss">&#xf596; kiss</option>
							<option value="kiss-beam">&#xf597; kiss-beam</option>
							<option value="kiss-wink-heart">&#xf598; kiss-wink-heart</option>
							<option value="laugh">&#xf599; laugh</option>
							<option value="laugh-beam">&#xf59a; laugh-beam</option>
							<option value="laugh-squint">&#xf59b; laugh-squint </option>
							<option value="laugh-wink">&#xf59c; laugh-wink</option>
							<option value="lemon">&#xf094; lemon</option>
							<option value="life-ring">&#xf1cd; life-ring</option>
							<option value="lightbulb">&#xf0eb; lightbulb</option>
							<option value="list-alt">&#xf022; list-alt</option>
							<option value="map">&#xf279; map</option>
							<option value="meh">&#xf11a; meh</option>
							<option value="meh-blank">&#xf5a4; meh-blank</option>
							<option value="meh-rolling-eyes">&#xf5a5; meh-rolling-eyes </option>
							<option value="minus-square">&#xf146; minus-square</option>
							<option value="money-bill-alt">&#xf3d1; money-bill-alt</option>
							<option value="moon">&#xf186; moon</option>
							<option value="newspaper">&#xf1ea; newspaper</option>
							<option value="object-group">&#xf247; object-group</option>
							<option value="object-upgroup">&#xf248; object-upgroup</option>
							<option value="paper-plane">&#xf1d8; paper-plane</option>
							<option value="pause-circle">&#xf28b; pause-circle</option>
							<option value="play-circle">&#xf144; play-circle </option>
							<option value="plus-square">&#xf0fe; plus-square</option>
							<option value="question-circle">&#xf059; question-circle</option>
							<option value="registered">&#xf25d; registered</option>
							<option value="sad-cry">&#xf5b3; sad-cry</option>
							<option value="sad-tear">&#xf5b4; sad-tear</option>
							<option value="save">&#xf0c7; save</option>
							<option value="share-square">&#xf14d; share-square</option>
							<option value="smile">&#xf118; smile</option>
							<option value="smile-beam">&#xf5b8; smile-beam </option>
							<option value="smile-wink">&#xf4da; smile-wink</option>
							<option value="snowflake">&#xf2dc; snowflake</option>
							<option value="square">&#xf0c8; square</option>
							<option value="star">&#xf005; star</option>
							<option value="star-half">&#xf089; star-half</option>
							<option value="sticky-note">&#xf249; sticky-note</option>
							<option value="stop-circle">&#xf28d; stop-circle</option>
							<option value="sun">&#xf185; sun</option>
							<option value="surprise">&#xf5c2; surprise </option>
							<option value="thumbs-down">&#xf165; thumbs-down</option>
							<option value="thumbs-up">&#xf1164; thumbs-up</option>
							<option value="times-circle">&#xf057; times-circle</option>
							<option value="tired">&#xf5c8; tired</option>
							<option value="trash-alt">&#xf2ed; trash-alt</option>
							<option value="user">&#xf007; user</option>
							<option value="user-circle">&#xf2bd; user-circle</option>
							<option value="window-close">&#xf410; window-close</option>
							<option value="window-maximize">&#xf2d0; window-maximize </option>
							<option value="window-minimize">&#xf2d1; window-minimize</option>
							<option value="window-restore">&#xf2d2; window-restore</option>
						</select>
						<br><br>
						<label class="form-check-label">Service Name</label><br>						
						<input type="hidden" name="website_service_content|Locked" value="<?php echo $did; ?>">
						<input type="text" name="website_service_content|service_name"><br><br>
						<label class="form-check-label">Service Description</label><br>
						<textarea name="website_service_content|service_content"></textarea><br>
						<input type="submit">
					</form>
				</div>	
				  </div>				  
				</div>
					
		  </div>

		  <!-- Modal footer -->
		  <div class="modal-footer">
			
		  </div>

		</div>
	  </div>
	</div>
</div>
<?php include_once("footer.php"); ?>