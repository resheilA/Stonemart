<?php 
if(isset($_GET['type']) && $_GET['type'] == "color")
{
	$sql = "SELECT * FROM product_color WHERE color LIKE '%".$_POST['value']."%' LIMIT 10";
	include_once("getalldata.php");
	$result = singletable_all( $sql);
	
	
	echo '<div id="colors" style="margin-bottom:10px;">';
	foreach($result as $row){		
		if(isset($row['color'])){
		  echo '<p class="list_box" style="border:1px solid black;padding:3px;margin:0px;" onclick="clean(\'color\',\''.$row['color'].'\' )" >'.$row['color'].'</p>';		
		}		
	}
	echo '</div>';
}


if(isset($_GET['type']) && $_GET['type'] == "application_area")
{
	$sql = "SELECT * FROM product_application WHERE application_area LIKE '%".$_POST['value']."%' LIMIT 10";
	include_once("getalldata.php");
	$result = singletable_all( $sql);
	
	echo '<div id="application_areas" style="margin-bottom:10px;">';
	foreach($result as $row){
		if(isset($row['application_area'])){
		  echo '<p class="list_box" style="border:1px solid black;padding:3px;margin:0px;" onclick="clean(\'application_area\',\''.$row['application_area'].'\' )" >'.$row['application_area'].'</p>';				 
		}	
	}
	echo '</div>';
}


if(isset($_GET['type']) && $_GET['type'] == "finishing_type")
{
	$sql = "SELECT * FROM product_finishing WHERE finishing LIKE '%".$_POST['value']."%' LIMIT 10";
	include_once("getalldata.php");
	$result = singletable_all( $sql);
	
	echo '<div id="finishing_types" style="margin-bottom:10px;">';
	foreach($result as $row){
		if(isset($row['finishing'])){
		  echo '<p class="list_box" style="border:1px solid black;padding:3px;margin:0px;" onclick="clean(\'finishing_type\',\''.$row['finishing'].'\' )" >'.$row['finishing'].'</p>';				 
		}	
	}
	echo '</div>';
}



if(isset($_GET['type']) && $_GET['type'] == "form_type")
{
	$sql = "SELECT * FROM product_form WHERE form LIKE '%".$_POST['value']."%' LIMIT 10";
	include_once("getalldata.php");
	$result = singletable_all( $sql);
	
	echo '<div id="form_types" style="margin-bottom:10px;">';
	foreach($result as $row){
		if(isset($row['form'])){
		  echo '<p class="list_box" style="border:1px solid black;padding:3px;margin:0px;" onclick="clean(\'form_type\',\''.$row['form'].'\' )" >'.$row['form'].'</p>';				 
		}	
	}
	echo '</div>';
}


if(isset($_GET['type']) && $_GET['type'] == "name")
{
	$sql = "SELECT * FROM product_name WHERE product_name LIKE '%".$_POST['value']."%' LIMIT 10";
	include_once("getalldata.php");
	$result = singletable_all( $sql);
	
	echo '<div id="form_types" style="margin-bottom:10px;">';
	foreach($result as $row){
		if(isset($row['product_name'])){
		  echo '<p class="list_box" style="border:1px solid black;padding:3px;margin:0px;" onclick="clean(\'name\',\''.$row['product_name'].'\' )" >'.$row['product_name'].'</p>';				 
		}	
	}
	echo '</div>';
}

?>