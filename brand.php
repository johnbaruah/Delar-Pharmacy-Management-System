<?php
  	include("connection.php");
	  if (isset($_POST['update'])) {
		$b_name = $_POST['b_name'];
		$cat_id = $_POST['cat_id'];
		$h = $_POST['h'];
		$status = $_POST['status'];

		$qry1=mysql_query("update brand set b_name='$b_name',cat_id='$cat_id',status='$status' where brand_id='$h'");
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

		$qry2=mysql_query("delete from brand where brand_id='$h'");
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
          <li class="active">&nbsp;/ Brand</li>
		</ol>



		<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-plus"></i> Add Brand 
  </button>
  
  <!-- Modal -->
  <div class="modal fade bg-img text-white font-italic" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content image">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  
		<form action="add_brand.php" method="POST">
  <div class="form-group row">
    <label for="product-name" class="col-sm-4 col-form-label">Brand Nmae:</label>
    <div class="col-sm-8">
	<input type="text" name="b_name" class="form-control"  placeholder="Insert Brand Name Here">
    </div>
  </div>
  <div class="form-group row">
    <label for="category" class="col-sm-4 col-form-label">Category:</label>
    <div class="col-sm-8">
  <select class="form-control" name="cat_id" id="exampleFormControlSelect1">
      <<?php
			include("connection.php");
			$qry=mysql_query("select * from category");
			$num=mysql_num_rows($qry);
			if($num==0)
			header("Location:no_category.php");
			while($row=mysql_fetch_array($qry))
			{
				print "<option value='".$row['cat_id']."'>";
				print $row['cat_name'];
				print "</option>";
			}
			?>
    </select>
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
    <div class="col-sm-12">
      <button type="submit" class="btn float-right btn-primary font-italic">Add Brand</button>
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
			
				
				<table class="table table-striped text-center">
					<thead>
						<tr class="table-primary bg-dark text-dark text-center">							
                            <th>Brand Name</th>
                            <th>Category</th>
							<th>Status</th>							
							<th>Update</th>
							<th>Delete</th>
						</tr>
                    </thead>
                    <tbody>
                    <?php
	  include("connection.php");
	  $qry=mysql_query("select * from brand");
	  $num=mysql_num_rows($qry);
	  if($num==0)
	  {
		  print "<h1>NO Category FOUND</h1>";
	  }
	  while($row=mysql_fetch_array($qry))
	  {
		
        print "<tr>";
		  print "<form name='f1' method='POST' action=''>";
		  
		  
		   print "<input type='hidden' name='h' value='".$row['brand_id']."'>";
		  print "<td>";
		   print "<input type='text' class='form-control' name='b_name' value='".$row['b_name']."'>";
          print "</td>";
          print "<td>";
          $catid=$row['cat_id'];
		   print "<select name='cat_id' class='form-control'>";
		   $q=mysql_query("select cat_name from category where cat_id='$catid'");
		   while($r=mysql_fetch_array($q))
		   {
			   print "<option value='".$catid."'>";
			   print $r['cat_name'];
			   print "</option>";
		   }
		   $q=mysql_query("select * from category where cat_id!='$catid'");
		   while($r=mysql_fetch_array($q))
		   {
			   print "<option value='".$r['cat_id']."'>";
			   print $r['cat_name'];
			   print "</option>";
		   }
		   print "</select>";
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
		  print "<td class='text-center'>";
		  print "<input type='submit' class='btn btn-success' name='update' value='Update'>";
		  print "</td>";
		  print "<td class='text-center'>";
		  print "<input type='submit' class='btn btn-danger' name='delete' value='Delete'>";
		  print "</td>";
		  print "</form>";
		  print "</tr>";
                    }
                    ?>
                    </tbody>
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