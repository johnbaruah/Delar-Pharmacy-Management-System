<?php include('include/header.php'); ?>



<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style type="text/css"> 
.bg-img{
  background-image: url("book_img/book3.jpg");
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
              <!-- <th style="width:10%;">Photo</th>               -->
              <th>Product Name</th>           
              <th>Quantity</th>
              <th>Amount</th>
              <th>Email Id</th>
              <th>Date & Time</th>
            </tr>
            <?php
      
$query1 = mysql_query("select * from placeorder");
    while($row=mysql_fetch_array($query1))
      {
              $p_name=$row['p_name'];
              $p_quantity=$row['p_quantity'];
              $p_price=$row['p_price'];
              $mail=$row['mail'];
              $date_time=$row['date_time'];
              
    
      print "<tr>";
     
      
    
           
           print "<td>";
           print $p_name;
    print "</td>";
    print "<td>";
    print $p_quantity;
    print "</td>";
    print "<td>";
    print $p_price;
    print "</td>";
    print "<td>";
    print $mail;
    print "</td>";
    print "<td>";
    print $date_time;
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

<?php include('include/footer.php'); ?>