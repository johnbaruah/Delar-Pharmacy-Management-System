<?php
  	include("connection.php");
	extract($_POST);
	$qry=mysql_query("insert into brand values('','$cat_id','$b_name','$status')");
	if($qry)
	{
        header("Location:brand.php");
	}
	else
	{
		print mysql_error();
	}
  ?>