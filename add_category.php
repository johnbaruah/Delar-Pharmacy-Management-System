<?php
  	include("connection.php");
	extract($_POST);
	$qry=mysql_query("insert into category values('','$c_name','$status')");
	if($qry)
	{
        header("Location:categories.php");
	}
	else
	{
		print mysql_error();
	}
  ?>