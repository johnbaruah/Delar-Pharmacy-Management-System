<?php require_once 'connection.php'; ?>
<?php require_once 'header.php'; ?>
<?php
  	include("connection.php");
      $email = $_SESSION['adminid'];
      

	  if (isset($_POST['update'])) {
		$c_pass = $_POST['c_pass'];
		$n_pass = $_POST['n_pass'];



        $flag=0;
$qry=mysql_query("select * from admin");
while($row=mysql_fetch_array($qry))
	{
		if($c_pass==$row['password'])
		{
			$flag=1;
			break;
		}
	}
if($flag==1)
	{
		$qry1=mysql_query("update admin set password='$n_pass' where email='$email'");
		                if($qry1)
		                    {
		                    echo "<script type='text/javascript'>alert('Password update successful')</script>";
		                  }
		                 else
		                 {
			                    print mysql_error(); 
		                     }
	}
	else
	{
		$error = "Invalid credentials";
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



<div class="row pt-5">
<div class="col-md-4"></div>

<div class="col-md-4 font-italic">

<form action="" method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Current password</label>
    <input type="password" class="form-control" name="c_pass" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Current password">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control" name="n_pass" id="exampleInputPassword1" placeholder="New Password">
  </div>
  <button type="submit" name="update" class="btn btn-primary">Submit</button>
</form>
</div>
</div>
</body>


<script src="datetimepicker_css.js"></script>
<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>
