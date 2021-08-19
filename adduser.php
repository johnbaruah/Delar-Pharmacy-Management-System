<?php
  	include("connection.php");
	  if (isset($_POST['add'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
        $password = $_POST['password'];
        $role = $_POST['role'];
		$status = $_POST['status'];

		$qry1=mysql_query("insert into admin values('$name','$email','$password','$role','$status')");
		if($qry1)
		{
			echo '<script>alert("Add user successful")</script>';
		}
		else
		{
			print mysql_error();
		}
	
	}
	if (isset($_POST['delete'])) {
		$h = $_POST['h'];

		$qry2=mysql_query("delete from admin where email='$h'");
		if($qry2)
		{
			echo '<script>alert("Delete user successful")</script>';
		}
		else
		{
			print mysql_error();
		}
	
	}	
	if (isset($_POST['update'])) {
		$email = $_POST['email'];
		$name = $_POST['name'];
		$h = $_POST['h'];
		$status = $_POST['status'];

		$qry3=mysql_query("update admin set email='$email',name='$name',status='$status' where email='$email'");
		if($qry3)
		{
			echo '<script>alert("Update user successful")</script>';
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
          <li class="active">&nbsp;/ User</li>
		</ol>



		<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
<i class="fas fa-plus"></i> Add User 
  </button>
  
  <!-- Modal -->
  <div class="modal fade bg-img font-italic text-white" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
	  <div class="modal-content image">
		<div class="modal-header">
		  <h5 class="modal-title" id="exampleModalLabel">Add User</h5>
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		  </button>
		</div>
		<div class="modal-body">
		  
		<form action="" method="POST">
        <div class="form-group row">
    <label for="product-name" class="col-sm-4 col-form-label">User Email:</label>
    <div class="col-sm-8">
	<input type="email" name="email" class="form-control"  placeholder="User Email">
    </div>
  </div>
  <div class="form-group row">
    <label for="product-name" class="col-sm-4 col-form-label">User Name:</label>
    <div class="col-sm-8">
	<input type="text" name="name" class="form-control"  placeholder="User Nmae">
    </div>
  </div>
  <div class="form-group row">
    <label for="product-name" class="col-sm-4 col-form-label">User Password:</label>
    <div class="col-sm-8">
	<input type="password" name="password" class="form-control"  placeholder="User Password">
    </div>
  </div>
  <div class="form-group row">
    <label for="category" class="col-sm-4 col-form-label">Role:</label>
    <div class="col-sm-8">
    <select class="form-control" name="role" id="exampleFormControlSelect1">
      <option value="User">User</option>
    </select>
    </div>
  </div>
  <div class="form-group row">
    <label for="category" class="col-sm-4 col-form-label">Status:</label>
    <div class="col-sm-8">
  <select class="form-control" name="status" id="exampleFormControlSelect1">
      <option value="Active">Active</option>
      <option value="Suspend">Suspend</option>
    </select>
    </div>
  </div>
  
  
  <div class="form-group row">
    <div class="col-sm-12">
      <button type="submit" name="add" class="btn float-right btn-primary font-italic">Add user</button>
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
                            <th>Email</th>
							<th>Name</th>							
							<th>Status</th>
							<th>Update</th>
							<th>Delete</th>
						</tr>
                    </thead>
                    <tbody>
                    <?php
	  include("connection.php");
	  $qry=mysql_query("select * from admin where role='User'");
	  $num=mysql_num_rows($qry);
	  if($num==0)
	  {
		  print "<h1>NO Category FOUND</h1>";
	  }
	  while($row=mysql_fetch_array($qry))
	  {
		
        print "<tr>";
		  print "<form name='f1' method='POST' action=''>";
		  
		 
           print "<input type='hidden' class='form-control' name='h' value='".$row['email']."'>";
		  print "<td>";
		   print "<input type='email' class='form-control' name='email' value='".$row['email']."'>";
          print "</td>";
          print "<td>";
		   print "<input type='text' class='form-control' name='name' value='".$row['name']."'>";
          print "</td>";
		  print "<td>";
		//    $status=$row['status'];
           print "<select name='status' class='form-control'>";
           
			   print "<option value='".$row['status']."'>";
			   print $row['status'];
               print "</option>";
               
               print "<option value='Suspend'>";
			   print "Suspend";
               print "</option>";
               
               print "<option value='Active'>";
			   print "Active";
			   print "</option>";
		   
           print "</select>";
           print "</td>";
           
			  print "<td>";
			  print "<center>";
			  print "<button type='submit' style='border:none;background:none;color:#0ad00a;' name='update' ><i class='fas fa-edit'></i></button>";
			  print "</center>";
			  print "</td>";
			  print "<td>";
			  print "<center>";
			  echo "<button type='submit' style='border:none;background:none;color:#0ad00a;' name='delete'><i class='fas fa-trash-alt'></i></button>";
			  print "</center>";
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