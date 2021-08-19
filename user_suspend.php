<!DOCTYPE html>
<html lang="en"></html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<title>Inventory Management System</title>
  <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
  
	<!-- font awesome -->
	<link rel="stylesheet" href="css/css/all.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/style.css">
  <link rel="stylesheet" href="custom/print.css" type="text/css" media="print">

</head>
<body>

<?php 

session_start();
if(!$_SESSION['adminid'])
{
	header("Location:index.php");
}
require_once 'connection.php'; 
$email = $_SESSION['adminid'];
?>


<div class="row pt-5">
	<div class="col-md-4"></div>
    <div class="col-md-4 text-center">
    <h1><a href="logout.php">Logout<i class="fas fa-off"></i></a></h1>
    <br>
    <?php echo $email; ?> Your account has been suspended
		
		
	</div> <!-- /col-md-12 -->
</div> <!-- /row -->


<!-- add product -->

</body>
<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>
</html>