<?php
  	include("connection.php");
	  if (isset($_POST['update'])) {
		$p_name = $_POST['p_name'];
		$brand_id = $_POST['brand_id'];
		$h = $_POST['h'];
		$price = $_POST['price'];
		$profit = $_POST['profit'];
		$qty= $_POST['qty'];
		$status = $_POST['status'];

		$qry1=mysql_query("update product set p_name='$p_name',brand_id='$brand_id',price='$price',qty='$qty',profit='$profit',status='$status' where p_id='$h'");
		if($qry1)
		{
			echo '<script>alert("Update item successful")</script>';
		}
		else
		{
			print mysql_error(); 
		}
	
	}
	if (isset($_POST['delete'])) {
		$h = $_POST['h'];

		$qry2=mysql_query("delete from product where p_id='$h'");
		if($qry2)
		{
			echo '<script>alert("Delete item successful")</script>';
		}
		else
		{
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
.image {
  background-image: url("custom/medicine3.jpg");
  background-size: cover;
  background-position: center;
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
          <li class="active">&nbsp;/ Product</li>
		</ol>



		<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-plus"></i> Add Product 
  </button>
  
  <!-- Modal -->
  <div class="modal fade bg-img text-white font-italic" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content image">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  
		<form action="add_product.php" method="POST" enctype="multipart/form-data">
  <div class="form-group row">
    <label for="p-name" class="col-sm-4 col-form-label">Product Name:</label>
    <div class="col-sm-8">
	<input type="text" name="p_name" class="form-control" id="formGroupExampleInput" placeholder="Insert Product Name Here">
    </div>
  </div>

  <div class="form-group row">
  <label for="category" class="col-sm-4 col-form-label">Brand:</label>
    <div class="col-sm-8">
  <select class="form-control" name="brand_id" id="exampleFormControlSelect1">
  <?php
			include("connection.php");
			$qry=mysql_query("select * from brand");
			$num=mysql_num_rows($qry);
			if($num==0)
			header("Location:no_category.php");
			while($row=mysql_fetch_array($qry))
			{
				print "<option value='".$row['brand_id']."'>";
				print $row['b_name'];
				print "</option>";
			}
			?>
    </select>
    </div>
  </div>

  <div class="form-group row">
    <label for="product-qty" class="col-sm-4 col-form-label">Price:</label>
    <div class="col-sm-8">
	<input type="text" name="price" class="form-control" id="formGroupExampleInput" placeholder="Insert Product Price">
    </div>
  </div>

  <div class="form-group row">
    <label for="product-qty" class="col-sm-4 col-form-label">Profit:</label>
    <div class="col-sm-8">
	<input type="text" name="profit" class="form-control" id="formGroupExampleInput" placeholder="Insert Profit in %">
    </div>
  </div>
  
  <div class="form-group row">
    <label for="product-qty" class="col-sm-4 col-form-label">Quantity:</label>
    <div class="col-sm-8">
	<input type="text" name="qty" class="form-control" id="formGroupExampleInput" placeholder="Insert Product Quantity">
    </div>
  </div>

  <div class="form-group row">
    <label for="category" class="col-sm-4 col-form-label">Status:</label>
    <div class="col-sm-8">
  <select class="form-control" name="status" id="exampleFormControlSelect1">
      <option value="Available">Available</option>
      <option value="Unavailale">Unavailale</option>
    </select>
    </div>
  </div>

  <div class="form-group row">
  <label for="category" class="col-sm-4 col-form-label">Image:</label>
  <div class="col-sm-8">
    <input type="file"  name="image" id="image" required>
  
  </div>
  </div>
  
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" class="btn float-right btn-primary font-italic">Add Product</button>
    </div>
  </div>
</form>


		
		</div>
	  </div>
	</div>
  </div>





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
							<th>Product Name</th>
							<th>Brand</th>
							<th>Cost Price</th>
							<th>Profit</th>
							<th>selling price</th>						
							<th>Quantity</th>
							<th>Status</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
					</thead>
						<?php
	  include("connection.php");
	  $qry=mysql_query("select * from product");
	  $num=mysql_num_rows($qry);
	  if($num==0)
	  {
		  print "<h1>NO PRODUCT FOUND</h1>";
	  }
	  while($row=mysql_fetch_array($qry))
	  {
		  $price=$row['price'];
		  $profit=$row['profit'];
		  $sell_price=(100+$profit)*$price/100;
		  
		  print "<tr>";
		  print "<form name='f1' method='POST' action=''>";
		  
		  print "<td>";
		   print "<input class='form-control' type='text' name='p_name' value='".$row['p_name']."'>";
		   print "<input type='hidden' name='h' value='".$row['p_id']."'>";
		  print "</td>";
		  print "<td >";
		   $brand_id=$row['brand_id'];
		   print "<select name='brand_id' class='form-control'>";
		   $q=mysql_query("select b_name from brand where brand_id='$brand_id'");
		   while($r=mysql_fetch_array($q))
		   {
			   print "<option value='".$brand_id."'>";
			   print $r['b_name'];
			   print "</option>";
		   }
		   $q=mysql_query("select * from brand where brand_id!='$brand_id'");
		   while($r=mysql_fetch_array($q))
		   {
			   print "<option value='".$r['brand_id']."'>";
			   print $r['b_name'];
			   print "</option>";
		   }
		   print "</select>";
		  print "</td>";
		  print "<td>";
		   print "<input type='text' class='form-control' name='price' value='".$row['price']."'>";
		  print "</td>";
		  print "<td>";
		   print "<input type='text' class='form-control' name='profit' value='".$row['profit']."'>";
		  print "</td>";
		  print "<td>";
		   print "$sell_price";
		  print "</td>";
		   print "<td>";
		   print "<input type='text' class='form-control' name='qty' value='".$row['qty']."'>";
		  print "</td>";
		  print "<td>";
		//    $status=$row['status'];
           print "<select name='status' class='form-control'>";
           
			   print "<option value='".$row['status']."'>";
			   print $row['status'];
               print "</option>";
               
               print "<option value='Unavailable'>";
			   print "Unavailable";
               print "</option>";
               
               print "<option value='Available'>";
			   print "Available";
			   print "</option>";
		   
           print "</select>";
           print "</td>";
		  
		  
		  print "<td>";
		  print "<input type='submit' class='btn btn-success' name='update' value='Update'>";
		  print "</td>";
		  print "<td>";
		  print "<input type='submit' class='btn btn-danger' name='delete' value='Delete'>";
		  print "</td>";
		  print "</form>";
		  print "</tr>";
	  }
	  ?>
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