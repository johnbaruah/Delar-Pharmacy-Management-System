<?php
include("connection.php");
$id=$_GET['id'];
 $qry112=mysql_query("delete from cart where id='$id'");
				if($qry112)
				{
             		header("Location:place_order.php");
            	}
				else
				{
					print mysql_error();
				}
?>