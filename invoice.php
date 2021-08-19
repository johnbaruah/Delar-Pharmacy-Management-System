<?php
include("connection.php");
$bill=$_GET['bill'];
$query1 = mysql_query("select * from orders where billno='$bill'");
		while($row=mysql_fetch_array($query1))
	  	{
              $cl_name=$row['cl_name'];
              $cl_no=$row['cl_no'];
              $p_mt=$row['p_mt'];
              $place=$row['place'];
              $s_price=$row['s_price'];
              $p_id=$row['p_id'];
              $qty=$row['qty'];
              $date=$row['date'];
              $time=$row['time'];
          }
         
?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>

<?php require_once 'connection.php'; ?>
<?php require_once 'header.php'; ?>

<body>
<div class="container">



    <table style="width:100%">
  
  <tr>
    <th colspan="2">
        <center>
            <h1><u><b>Pharmacy Management System</b></u></h1>
            <h3>Cotton University</h3>
            MCA 6th Semester
        </center>
        
    </th>
  </tr>
    </table>
    <br>

    <table style="width:100%">
  <tr>
    <td colspan="4">
        Bill Number: &nbsp; <?php echo $bill; ?><?php echo $p_id; ?>
    </td>
  </tr>
  <tr>
    <td colspan="4" class="bg-clr"><center><h6><b>Customer Details:</b></h6></center></td>
  </tr>
  <tr>
    <td >Customer Name:</td>
    <td colspan="3"><?php echo $cl_name; ?></td>
  </tr>
  <tr>
    <td>Customer Phone Number:</td>
    <td colspan="2"><?php echo $cl_no; ?></td>
    <td>Date: <?php echo $date; ?>&nbsp; <?php echo $time; ?></td>
  </tr>
</table>

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
						</tr>
						<?php
      include("connection.php");
      $bill=$_GET['bill'];
$query1 = mysql_query("select * from orders where billno='$bill'");
		while($row=mysql_fetch_array($query1))
	  	{
              $p_id=$row['p_id'];
              $qty=$row['qty'];
          
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
		  print "</tr>";
      }

      print "<td colspan='2'>";
		print "<b>Total amount</b>";
    print "</td>";
    print "<td>";
    print "<b>";
    print $sl_price;
    print "</b >";
    print "</td>";
    print "</tr>";
    print "<tr>";
    print "<td colspan='2'>";
    print "</td>";
    print "<td style='height:70px;opacity:0.3;'>";
		print "<center>Signature</center>";
    print "</td>";
    print "</tr>";
      
	  ?>
					</thead>
				</table>
  </tr>
  
 			 
  
</table>

      



<div class="text-center">
  <button onclick="window.print();" class="btn btn-primary" id="print-btn">Print</button>
</div>

</div>


</body>

<script src="jquery/jquery.min.js"></script>
<script src="css/bootstrap/bootstrap.min.js"></script>


<?php require_once 'footer.php'; ?>