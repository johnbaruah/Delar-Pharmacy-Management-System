<?php
include("connection.php");
$result1=mysql_query("select sum(qty) as p_qty from product WHERE status = 'Available'");
$data1=mysql_fetch_assoc($result1);
$p_qty=$data1['p_qty'];

$result2=mysql_query("select count(*) as low_qty from product where status = 'Available' and qty < 5");
$data2=mysql_fetch_assoc($result2);
$low_qty=$data2['low_qty'];

$result3=mysql_query("select count(*) as o_qty from orders");
$data3=mysql_fetch_assoc($result3);
$o_qty=$data3['o_qty'];

$result4=mysql_query("select sum(s_price) as revenue from orders");
$data4=mysql_fetch_assoc($result4);
$revenue=$data4['revenue'];

$result5=mysql_query("select sum(profit) as profit from orders  WHERE date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");
$data5=mysql_fetch_assoc($result5);
$profit=$data5['profit'];

$result6=mysql_query("select sum(qty) as t_qty from orders  WHERE date BETWEEN NOW() - INTERVAL 30 DAY AND NOW()");
$data6=mysql_fetch_assoc($result6);
$t_qty=$data6['t_qty'];
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" href="js/calender/calendar.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<style type="text/css"> 
.bg-img{
  background-image: url("custom/medicine.jpg");
  background-size: cover;
  background-position: center;
  background-attachment: fixed;
}
</style>
</head>

<body class="bg-img">
    <?php require_once 'header.php'; ?>
<div class="container-fluid">
<div class="row icn">
<div class="col-md-3 mt-5 mb-5 mr-5 ml-0">
<a href="product.php">
<i class="fas fa-cubes"></i>
<div class="t-ast text-center">
	
	
			<p><?php echo $p_qty; ?></p>	
			<b>Total Assets</b>
</div>
</a>
</div>

<div class="col-md-3 m-5">
<a href="product.php">
<i class="fab fa-stack-overflow"></i>
<div class="l-ast text-center">
		<p><?php echo $low_qty; ?></p>	
		<b>Low Stock</b>
</div>
</a>
</div>

<div class="col-md-3 m-5">
<a href="product.php">
<i class="fas fa-shopping-bag"></i>
<div class="t-o text-center">
		<p><?php echo $o_qty; ?></p>	
		<b>Total Orders</b>
</div>
</a>
</div>
</div>

<div class="row pt-4 icn">
<div class="col-md-3 m-5">
<a href="product.php">
<i class="fas fa-hand-holding-usd"></i>
<div class="t-r text-center">
		<p><?php echo $revenue; ?> ₹</p>
		<b>Total Revenue</b>	
</div>
</a>
</div>

<div class="col-md-3 m-5">
<a href="product.php">
<i class="fas fa-calendar-alt"></i>
<div class="t-30-r text-center">
		<p><?php echo $profit; ?> ₹</p>
		<b>Last 30 days profit</b>	
</div>
</a>
</div>

<div class="col-md-3 ml-5 mt-5 mb-5 mr-0">
<a href="product.php">
<i class="fas fa-layer-group"></i>
<div class="t-30-s text-center">
		<p><?php echo $t_qty; ?></p>
		<b>Last 30 days sell assets</b>	
</div>
</a>
</div>

</div>

</div>
</div>
</div>
<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>
<script src="js/calender/calendar.js"></script>
<script type="text/javascript">
	$('.counter').counterUp({
  delay: 10,
  time: 500
});
$('.counter').addClass('animated fadeInDownBig');
$('h3').addClass('animated fadeIn');
</script>
</body>
<?php require_once 'footer.php'; ?>

