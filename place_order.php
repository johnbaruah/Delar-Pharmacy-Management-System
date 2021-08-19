<?php require_once 'connection.php'; ?>
<?php require_once 'header.php'; ?>


<?php
$c_p_id = null;
$email = $_SESSION['adminid'];
  	include("connection.php");
	  if (isset($_POST['submit'])) {
		$p_id = $_POST['p_id'];
		$qty= $_POST['qty'];

		$query10 = mysql_query("select * from product where p_id='$p_id'");
		while($row=mysql_fetch_array($query10))
	  	{
			  $pqty=$row['qty'];
	  	}
		$nqty=$pqty-$qty;

	
	$date=date("Y/m/d");
	date_default_timezone_set('Asia/Calcutta');
	$time=date("H:i:s");


	$qry22= mysql_query("select * from cart where p_id='$p_id'");
	while($row11=mysql_fetch_array($qry22))
	  	{
			  $c_p_id=$row11['p_id'];
	  	
		  }
	if ($p_id != $c_p_id)
	{
		if ($nqty >= 0)
		{
			$qry11=mysql_query("insert into cart values('','$email','$p_id','$qty','$date','$time')");
				if($qry11)
				{
             		header("Location:place_order.php");
            	}
				else
				{
					print mysql_error();
				}
					
		}
		else
		{
			$error = "Order quantity is higher than the existing stock!";
			echo "<script type='text/javascript'>alert('$error');</script>";
		}
	}
	else
	{
		$error = "Product is already in cart!";
        echo "<script type='text/javascript'>alert('$error');</script>";
	}
}
	  
      
  ?>
<?php
  	include("connection.php");
	  if (isset($_POST['submit_form'])) {
		$cl_name = $_POST['cl_name'];
		$cl_no = $_POST['cl_no'];

		$p_mt = $_POST['p_mt'];
		$place = $_POST['place'];

		$o_id=0;
		$q=mysql_query("select o_id from orders order by o_id desc limit 0,1");
		while($r=mysql_fetch_array($q))
		{
			$o_id=$r['o_id'];
		}
		$o_id++;
		$billno="Bill".$o_id;


		$qry00=mysql_query("select * from cart where email='$email'");
	  while($row00=mysql_fetch_array($qry00))
	  {
		  $email=$row00['email'];
		  $p_id=$row00['p_id']; 
		  $qty=$row00['qty'];
	  }

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

		  $qry=mysql_query("insert into orders values('$o_id','$billno','$email','$p_id','$qty','$price','$date','$time')");
		  if($qry) {
			  echo "success";
		  }
		  else{
			print mysql_error();
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
<div class="row pt-3">
	<div class="col-md-12">

		<ol class="breadcrumb">
		  <li><a href="dashboard.php">Dashboard </a></li>
		  <li><a href="order.php">&nbsp;/ Order </a></li>
          <li class="active">&nbsp;/ Place orders</li>
		</ol>

    <div class="card bg-light">
					<div class="card-header bg-secondary text-white text-center">
						<h3 class="card-title">Add to cart</h3>
					</div>
					<div class="card-body pb-0 pt-1">

		<form action="" method="POST">
    <div class="form-row">
		<div class="form-group col-md-10">
  <label for="category">Available Product & Quantity:</label>
    
  <select class="form-control" name="p_id" id="exampleFormControlSelect1">
  			<?php
			include("connection.php");
			$qry=mysql_query("select * from product where status = 'Available'");
			$num=mysql_num_rows($qry);
			if($num==0)
			header("Location:dashboard.php");
			while($row=mysql_fetch_array($qry))
			{
				$price=$row['price'];
				$profit=$row['profit'];
				$sell_price=(100+$profit)*$price/100;

				print "<option value='".$row['p_id']."'>";
                print $row['p_name'];
				print "<b> [Quantity: ".$row['qty']."], </b>";
				print "<b>[Price: ₹ $sell_price], </b>";
				print "<b>[Status: ".$row['status']."]</b>";
				print "</option>";
			}
			 
			print "</select>";
			
			print "<input name='price' type='hidden' value='".$row['price']."'>";
			print "</div>";
  ?>

  <div class="form-group col-md-2">

    <label for="product-qty">Quantity:</label>
    
	<input type="number" name="qty" class="form-control" id="formGroupExampleInput" placeholder="Product Quantity">
    
  </div>
  </div>
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" name="submit" value="submit" class="btn btn-block btn-success">Select Product & Quantity</button>
    </div>
  </div>
    </form>
          </div>
    </div>
		<hr>
    

    <div class="card bg-light">
					<div class="card-header text-white text-center bg-secondary">
						<h3 class="card-title">Place order</h3>
					</div>
					<div class="card-body pb-0 pt-1">
		<form action="action.php" method="POST">
    <div class="form-row">
  <div class="form-group col-md-4">
    <label for="p-name">Client Name:</label>
    
	<input type="text" name="cl_name" class="form-control" id="formGroupExampleInput" placeholder="Client Name" >
    
  
    <label for="p-name" >Client Contact No.:</label>
    
	<input type="number" name="cl_no" class="form-control" id="formGroupExampleInput" placeholder="Client Contact No." >
    
 
  

 
    <label for="method">Payment Method:</label>
    
  <select class="form-control" name="p_mt"  id="exampleFormControlSelect1">
  <option value="">--select--</option>    
  <option value="cash">Cash</option>
      <option value="online">Online</option>
    </select>
    
  
    <label for="category">Place:</label>
    
  <select class="form-control" name="place"  id="exampleFormControlSelect1">
  <option value="">--select--</option>
      <option value="guwahati">Guwahati</option>
      <option value="out_of_guwahati">Out of Guwahati</option>
    </select>
    </div>
  <!-- form row close-->
  
  <div class="form-group col-md-8 pt-4">


  <table class="table text-center border" id="manageProductTable">
					<thead class="table-secondary bg-secondary">
						<tr class="text-white">
							<!-- <th style="width:10%;">Photo</th>							 -->
							<th>Product Name</th>
							<th>price</th>
              				<th>Quantity</th>
              				<th>Total Price</th>
              				<th>Update</th>
							<th>Delete</th>
						</tr>
					</thead>
  <?php
	  include("connection.php");
	  $qry3=mysql_query("select * from cart where email= '$email'");
	  $num=mysql_num_rows($qry3);
	  if($num==0)
	  {
		  print "<h1><center>NO PRODUCT FOUND</center></h1>";
	  }
	  while($row=mysql_fetch_array($qry3))
	  {
		  $p_id=$row['p_id'];
		  $qty=$row['qty'];
		  $id=$row['id'];
		 
		  
		  print "<tr>";
		 
		  
		 
		  
		  print "<td>";
      $q=mysql_query("select * from product where p_id='$p_id'");
      while($r=mysql_fetch_array($q))
      {
		$price=$r['price'];
		$profit=$r['profit'];
		$c_price=$price*$qty;
		$s_price=((100+$profit)*$price/100);
		$total_price =((100+$profit)*$price/100)*$qty;

     print $r['p_name'];
      
		  print "</td>";

		  
		  print "<input name='p_id[]' type='hidden' value='".$r['p_id']."'>";

		  print "<input name='h' type='hidden' value='".$id."'>";
		  

		  
		  print "<input name='email[]' type='hidden' value='".$email."'>";

		  print "<input name='k' type='hidden' value='".$email."'>";
		  


		  print "<td>";
       print $s_price;
      print "</td>";
      print "<td>";
       print "<input name='qty[]' type='text' class='form-control' value='".$qty."'>"; 
		  print "</td>";
      print "<td>";
       print $total_price;
		  print "</td>";
      
		  
    }
		  print "<td>";
		  print "<button type='submit' style='border:none;background:none;color:#0ad00a;' name='update' ><i class='fas fa-edit'></button>";
		  print "</td>";
		  print "<td>";
		  echo "<a href='delete.php?id=$id'><i class='fas fa-trash-alt'></i></a>";
      print "</td>";
		 
		  print "</tr>";
    }
    
    ?>
   
				</table>



  
   
  
    <br>
      <button type="submit" name="submit_form" value="submit" class="btn btn-block btn-success">Place order</button>
    
  </div>

  
  <!-- form row close-->
    </div>
</form>
          </div>
        </div>

		

	
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->
</body>

<!-- add product -->


<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>


<?php require_once 'footer.php'; ?>