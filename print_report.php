<?php require_once 'connection.php'; ?>
<?php require_once 'header.php'; ?>



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
<div class="container">

    <br>

    

<br>
<table style="width:100%">
  <tr>
    <td class="bg-clr"><center><h6><b>Order Details:</b></h6></center></td>
  </tr>
  <tr>
    <table style="width:100%">
					<thead>
						<tr>
							<!-- <th style="width:10%;">Photo</th>							 -->
							<th>Product Name</th>						
							<th>Quantity</th>
              <th>Amount</th>
              <th>Sell person</th>
              <th>Date & Time</th>
						</tr>
						<?php
      include("connection.php");
      $sl_price = Null;
if (isset($_POST['submit'])) {
  $s_date = $_POST['s_date'];
  $e_date = $_POST['e_date'];

 

}
      
$query1 = mysql_query("select * from orders wHERE DATE between '$s_date' and LAST_DAY('$e_date')");
		while($row=mysql_fetch_array($query1))
	  	{
              $p_id=$row['p_id'];
              $qty=$row['qty'];
              $bill=$row['billno'];
              $s_email=$row['email'];
              $sl_date=$row['date'];
              $sl_time=$row['time'];
          
              $result1=mysql_query("select sum(s_price) as s_price from orders WHERE billno = '$bill'");
            $data1=mysql_fetch_assoc($result1);
            $sl_price=$data1['s_price'];
		
		  print "<tr>";
		 
		  
		
		
		$p_id=$row['p_id'];
		$q=mysql_query("select * from product where p_id='$p_id'");
		   while($r=mysql_fetch_array($q))
		   {
            $p_name=$r['p_name'];
           }
           
           print "<td>";
           print $p_name;
		print "</td>";
		print "<td>";
		print $row['qty'];
		print "</td>";
		print "<td>";
		print $row['s_price'];
		print "</td>";
    print "<td>";
    $q1=mysql_query("select * from admin where email='$s_email'");
		   while($r1=mysql_fetch_array($q1))
		   {
            $s_name=$r1['name'];
           }
		print $s_name;
		print "</td>";
    print "<td>";
		print $sl_date; print "&nbsp; &nbsp; &nbsp;"; print $sl_time;
		print "</td>";
		  print "</tr>";
      }

      print "<td colspan='2'>";
		print "<b>Total amount</b>";
    print "</td>";
    print "<td colspan='3'>";
    print "<b>";
    print $sl_price;
    print "</b >";
    print "</td>";
    print "</tr>";
    print "<tr>";
    print "</tr>";
      
	  ?>
					</thead>
				</table>
  </tr>
  
 			 
  
</table>

      



<div class="text-center mt-2">
  <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
</div>
</div>
</body>
<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>