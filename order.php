<?php
  	include("connection.php");
	  if (isset($_POST['submit'])) {
		$cl_name = $_POST['cl_name'];
		$cl_no = $_POST['cl_no'];
		$p_id = $_POST['p_id'];
		$price = $_POST['price'];
		$qty= $_POST['qty'];
		$p_mt = $_POST['p_mt'];
		$place = $_POST['place'];


	$date=date("Y-m-d");
	date_default_timezone_set('Asia/Calcutta');
	$time=date("H:i:s");
	$query1 = mysql_query("select * from product where p_id='$p_id'");
	while($row=mysql_fetch_array($query1))
	  	{
		  	$price=$row['price'];
			  $pqty=$row['qty'];
			  $profit=$row['profit'];
	  	}
	$cost_price=$price*$qty;
	$nqty=$pqty-$qty;

	$sell_price=((100+$profit)*$price/100)*$qty;
	$profit=$sell_price-$cost_price;

	if ($nqty >= 0) {
			$qry2=mysql_query("update product set qty='$nqty' where p_id='$p_id'");
				if($qry2) {
					$qry=mysql_query("insert into orders values('','$cl_name','$cl_no','$p_id','$qty','$p_mt','$profit','$place','$sell_price','$date','$time')");
						if($qry) {
							if ($nqty < 1){
								$qry3=mysql_query("update product set status='Unavailable' where p_id='$p_id'");
									if($qry3) {
										header("Location:order.php");
									}
									else{
										print mysql_error();
									}
							}
							else{
								header("Location:order.php");
							}
						}
						else {
							print mysql_error();
							}
						}
  				else {
	  				print mysql_error();
				  }
				}
				  else {
					$error = "Order quantity is higher than the existing stock!";
					echo "<script type='text/javascript'>alert('$error');</script>";
				}
			}			
  ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css"> 
.bg-img{
  background-image: url("custom/medicine2.jpg");
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}
</style>
</head>
<body class="bg-img">
<?php require_once 'connection.php'; ?>
<?php require_once 'header.php'; ?>

<div class="row pt-3">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Dashboard </a></li>
          <li class="active">&nbsp;/ Orders</li>
		</ol>

		<div type="button" class="btn btn-primary" onclick="location.href='place_order.php';" ><i class="fas fa-plus"></i> Place Order</div>





		<div class="card mt-3">
			<div class="card-header">
				<div class="page-heading"> <i class="fas fa-pen"></i> Manage Product</div>
			</div> <!-- /panel-heading -->
			<div class="card-body">

				<div class="remove-messages"></div>
			
				
				<table class="table table-striped text-center" id="manageProductTable">
					<thead>
						<tr class="table-primary bg-dark text-dark text-center">
							<!-- <th style="width:10%;">Photo</th>							 -->
							<th>Bill No.</th>
							<th>Customer Name</th>
							<th>Product Name</th>						
							<th>Quantity</th>
							<th>Amount</th>
							<th>Date</th>
							<th>Payment Method</th>
							<th>Place</th>
							<th>Action</th>
						</tr>
						<?php
	  include("connection.php");
	  $qry=mysql_query("select * from orders");
	  $num=mysql_num_rows($qry);
	  if($num==0)
	  {
		  print "<h1><center>NO ORDER FOUND</center></h1>";
	  }
	  while($row=mysql_fetch_array($qry))
	  {
		$bill=$row['billno'];
		  print "<tr>";
		  print "<form name='f1' method='POST' action='invoice.php'>";
		  
		print "<td>";
		print $bill;
		print "</td>";
		print "<td>";
		print $row['cl_name'];
		print "</td>";
		print "<td>";
		$p_id=$row['p_id'];
		$q=mysql_query("select * from product where p_id='$p_id'");
		   while($r=mysql_fetch_array($q))
		   {
			print $r['p_name'];
		   }
		print "</td>";
		print "<td>";
		print $row['qty'];
		print "</td>";
		print "<td>";
		print $row['s_price'];
		print "</td>";
		print "<td>";
		print $row['date'];
		print "</td>";
		print "<td>";
		print $row['p_mt'];
		print "</td>";
		print "<td>";
		print $row['place'];
		print "</td>";
		   
		  
		  
		  print "<td>";
		  echo "<a href='invoice.php?bill=$bill'><i class='fas fa-file-pdf text-danger'></i></a>";
		  print "</td>";
		  print "</form>";
		  print "</tr>";
	  }
	  ?>
					</thead>
				</table>
				<!-- /table -->

			</div> <!-- /panel-body -->
		</div> <!-- /panel -->		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
</body>
<!-- add product -->


<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>


<?php require_once 'footer.php'; ?>