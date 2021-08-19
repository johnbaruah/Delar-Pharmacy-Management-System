<?php
include("connection.php");
if (isset($_POST['submit'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

$flag=0;
$qry=mysql_query("select * from admin");
while($row=mysql_fetch_array($qry))
	{
		if($username==$row['email'] && $password==$row['password'])
		{
			$flag=1;
			break;
		}
	}
if($flag==1)
	{
		session_start();
		$_SESSION['adminid']=$username;
		header("Location:dashboard.php");
	}
	else
	{
		$error = "Invalid credentials";
        echo "<script type='text/javascript'>alert('$error');</script>";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Pharmacy Management System</title>
	<link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
	<!-- font awesome -->
	<link rel="stylesheet" href="css/css/all.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/style.css">	
  <style type="text/css">
  	.trans_new{
  	  top: 42%; left: 80%;
	  transform: translate(-50%, -50%);
	  width: 25rem;
	  padding: 2.5rem;
	  box-sizing: border-box;
	  background: rgba(0, 0, 0, 0.2);
	  border-radius: 0.625rem;
  	}
  </style>
</head>
<body>
	<div class="container-fluid ims-bg-img">
		<div class="row vertical login-bg-img">
			<div class="col-md-12 m-0 p-0" style="height: 390px;">
				<div class="card m-0 p-0 trans_new">
					<div class="ml-4 mt-2">
						<h3 class="card-title text-white font-italic">Please Sign in</h3>
					</div>
					<div class="card-body">

						<div class="messages">
							
						</div>

						<form class="form-horizontal" action="" method="post" id="loginForm">
							<fieldset>
							  <div class="form-group text-white font-italic">
									<label for="username" class="col-sm-12 control-label">Email ID</label>
									<div class="col-sm-10">
									  <input type="email" class="form-control" id="username" name="username" placeholder="Email ID" autocomplete="off" />
									</div>
								</div>
								<div class="form-group text-white font-italic">
									<label for="password" class="col-sm-12 control-label">Password</label>
									<div class="col-sm-10">
									  <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" />
									</div>
								</div>								
								<div class="form-group">
									<div class="col-sm-10">
									  <button type="submit" name="submit" class="btn btn-primary text-white font-italic"> <i class="fas fa-sign-in-alt"></i> Sign in</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
					<!-- panel-body -->
				</div>
				<!-- /panel -->
			</div>
			<!-- /col-md-4 -->
		</div>
		<!-- /row -->
	</div>
	<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>
</body>
</html>