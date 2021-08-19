<?php
session_start();
if(!$_SESSION['adminid'])
{
	header("Location:index.php");
}
$email = $_SESSION['adminid'];
$query100 = mysql_query("select * from admin where email='$email'");
		while($row100=mysql_fetch_array($query100))
	  	{
        $role=$row100['role'];
        $status=$row100['status'];
      }
      
?>

<!DOCTYPE html>
<html lang="en"></html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Pharmacy Management System</title>
  <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
  
	<!-- font awesome -->
	<link rel="stylesheet" href="css/css/all.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/style.css">
  <link rel="stylesheet" href="custom/print.css" type="text/css" media="print">

</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark text-white">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="dashboard.php"  style="padding:0px;">
                    <img height="55px" width="55px" src="logo.png" class="rounded-circle" alt="logo">
                </a>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
  

  <?php
 if ($role == "Admin") { ?>
    
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    <li class="nav-item">
    <a class="nav-link text-white" href="categories.php">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="brand.php">Brand</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="Product.php">product</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="order.php">Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="report.php">Report</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="adduser.php">Add-user</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="account.php">Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="about_us.php">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="logout.php">Logout</a>
      </li>
    </ul>
  <?php } elseif ($role == "User" && $status == "Active"){ ?>

    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
    
      <li class="nav-item">
        <a class="nav-link text-white" href="order.php">Order</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="account.php">Account</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="about_us.php">About us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link text-white" href="logout.php">Logout</a>
      </li>
    </ul>
    <?php  } else{ 
     header("Location:user_suspend.php");
    }?>

  </div>
</nav>
	<div class="container">