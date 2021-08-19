
  <?php
      include("connection.php");
      $ono=0;
	  $q=mysql_query("select billno from orders order by billno desc limit 0,1");
	  while($r=mysql_fetch_array($q))
	  {
		  $ono=$r['billno'];
      }
      $ono++;
      $billno=$ono;

        $date=date("Y-m-d");
	    date_default_timezone_set('Asia/Calcutta');
        $time=date("H:i:s");
        

        if (isset($_POST['submit_form'])) {

            $cl_name = $_POST['cl_name'];
            $cl_no = $_POST['cl_no'];
            $p_mt = $_POST['p_mt'];
            $place = $_POST['place'];

    
	  
          foreach ($_POST['p_id'] as $i => $value) {
            $p_id = $_POST['p_id'][$i];
            $email = $_POST['email'][$i];
            $qty = $_POST['qty'][$i];
            
          
    
	$query1 = mysql_query("select * from product where p_id='$p_id'");
	while($row=mysql_fetch_array($query1))
	  	{
		  	$price=$row['price'];
			$pqty=$row['qty'];
            $p_profit=$row['profit'];
            $c_price=$price*$qty;
            $s_price=((100+$p_profit)*$price/100)*$qty;
            $profit = $s_price-$c_price;

            $nqty=$pqty-$qty;

          }
            if (($nqty >= 0)  && !empty($cl_name) && !empty($cl_no) && !empty($p_mt) && !empty($place))
            {
                $qry2=mysql_query("update product set qty='$nqty' where p_id='$p_id'");
                    if($qry2)
                    {
                        $qry=mysql_query("insert into orders values('','$billno','$email','$cl_name','$cl_no','$p_mt','$place','$s_price','$c_price','$profit','$p_id','$qty','$date','$time')");
                            if($qry)
                            {
                                $qry4 = mysql_query("delete from cart where p_id='$p_id'");
                                    if($qry4) 
                                    {
                                        if ($nqty < 1)
                                        {
                                            $qry3=mysql_query("update product set status='Unavailable' where p_id='$p_id'");
                                            if($qry3)
                                                {
                                                    header("Location:order.php");
                                                }
                                            else
                                                {
                                                    print mysql_error();
                                                }
                                        }
                                    else{
                                        header("Location:order.php");
                                        }
                                    }
                                    else
                                    {
                                        print mysql_error();
                                    }
                            }
                            else
                            {
                                print mysql_error();
                            }
                    }
                    else
                    {
                        print mysql_error();
                    }
            }
            else
            {
                $error = "Order quantity is higher than the existing stock!";
                
                header("location:place_order.php");
                echo "<script type='text/javascript'>alert('$error');</script>";

            }
                          
    }
}
				
  ?>

<?php
  	include("connection.php");
	  if (isset($_POST['update'])) {
		

        foreach ($_POST['p_id'] as $i => $value) {
            $p_id = $_POST['p_id'][$i];
            $email = $_POST['email'][$i];
            $qty = $_POST['qty'][$i];


		$query10 = mysql_query("select * from product where p_id='$p_id'");
		while($row1=mysql_fetch_array($query10))
	  	{
              $pqty=$row1['qty'];
              $nqty=$pqty-$qty;
	  	
		

	
	        $date=date("Y/m/d");
	        date_default_timezone_set('Asia/Calcutta');
	        $time=date("H:i:s");


		if ($nqty >= 0)
		{
			$qry11=mysql_query("update cart set qty='$qty',date='$date',time='$time' where email='$email' and p_id='$p_id' ");
				if($qry11)
				{
             		header("Location:place_order.php");
            	}
				else
				{
					print mysql_error();
				}
					
		}
		else
		{
			$error = "Order quantity is higher than the existing stock!";
			echo "<script type='text/javascript'>alert('$error');</script>";
            header("location:place_order.php");
        }
    }
	
}
}
      
  ?>





