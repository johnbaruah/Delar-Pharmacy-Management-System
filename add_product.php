<?php
  	include("connection.php");
	extract($_POST);
	$img=$_FILES['image']['name'];
	$k=move_uploaded_file($_FILES['image']['tmp_name'],"product_image/".$_FILES['image']['name']);
	$qry=mysql_query("insert into product values('','$brand_id','$p_name','$price','$profit','$qty','$img','$status')");
	if($qry)
	{
		header("Location:Product.php");
	}
	else
	{
		print mysql_error();
	}
  ?>

