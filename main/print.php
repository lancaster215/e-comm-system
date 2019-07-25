<?php
require_once '../php/includes/db_include.php';
session_start();
if (!isset($_SESSION['u_id'])) {
    header("Location: home.php?error_user");
}else{
    header("Location:");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Print Invoice</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body onload="window.print();">
<div class="w3-row-padding" style="padding-top:55px;margin-left:10%;margin-right:10%;">
    	<?php
        $date = date('m/d/Y');
        echo'<br><div class="mid-content">
            <h1>greyscaled</h1><h2 style="margin-top:-13%;margin-left:38%;">,Inc.</h2>
            <h5 style="float:right;margin-top:-50px;color:grey;">Date: '.$date.'</h5>
        </div><hr><br>';
        ?>
        	<div class="w3-half">
        		 <table>
		            <tr><td>From:<b> Admin, Warehouse    Inc,</b></td></tr>
		            <tr><td>Banadero, Old Albay</td></tr>
		            <tr><td>Phone: (+63)286617104</td></tr>
		            <tr><td>admin@sample.com</td></tr>
		        </table>
        	</div>
        <?php
            $uid = (int)$_SESSION['u_id'];
            $sql1 = "SELECT * FROM users, delivery WHERE delivery.user_id=users.user_id AND delivery.user_id=$uid";
            $res = mysqli_query($conn, $sql1);
            if ($check = mysqli_num_rows($res) > 0) {
                if($rows = mysqli_fetch_array($res)){
                    echo'<div class="w3-half">
	                    <table>
                            <tr><td>To: <b>'.$rows['user_first'].' '.$rows['user_last'].'</b></td></tr>
                            <tr><td>'.$rows['user_address'].'</td></tr>
                            <tr><td>Phone: '.$rows['phone_number'].'</td><tr>
                            <tr><td>'.$rows['email'].'</td></tr>
                    	</table></div>';
                }
            }
        ?>
        <?php
            $uid = (int)$_SESSION['u_id'];
            $ufirst = $_SESSION['u_first'];
            $sql = "SELECT * FROM orders WHERE user_id=$uid";
            $result = mysqli_query($conn, $sql);
            $chk = mysqli_num_rows($result);
            $subtotal = 0;
            $output1 ="";
            $output2 ="";
            $output3 ="";
            $output4 ="";
            if ($chk > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $qty = $row['qty'];
                    $price = $row['product_price'];
                    $cat = $row['product_cat'];
                    $ord = $row['order_date'];   
                    $status = $row['order_status'];

                    if ($status == 'on-sale') {
                        $output1 .='';
                    }elseif ($status == 'ongoing') {
                        $subqty = ($price * $qty);
                        $subtotal = ($subtotal + ($price * $qty));
                        $output2 .='
                            <tr>
                                <td><center>'.$qty.'</center></td>
                                <td><center>'.$row['order_date'].'</center></td>
                                <td><center>'.$row['order_status'].'</center></td>
                                <td><center>'.$row['product_cat'].'</center></td>
                                <td><center>&#8369; '.$row['product_price'].'</center></td>
                            </tr>';
                    }else if ($status == 'delivering') {
                        $subqty = ($price * $qty);
                        $subtotal = ($subtotal + ($price * $qty));
                        $output3 .='
                            <tr>
                                <td><center>'.$qty.'</center></td>
                                <td><center>'.$row['order_date'].'</center></td>
                                <td><center>'.$row['order_status'].'</center></td>
                               <td><center>'.$row['product_cat'].'</center></td>
                                <td><center>&#8369; '.$row['product_price'].'</center></td>
                            </tr>';
                    }else if ($status == 'delivered') {
                        $subqty = ($price * $qty);
                        $subtotal = ($subtotal + ($price * $qty));
                        $output4 .='
                            <tr>
                                <td><center>'.$qty.'</center></td>
                                <td><center>'.$row['order_date'].'</center></td>
                                <td><center>'.$row['order_status'].'</center></td>
                                <td><center>'.$row['product_cat'].'</center></td>
                                <td><center>&#8369; '.$row['product_price'].'</center></td>
                            </tr>';
                    }
                }
            }else{
                echo "<h4>No Orders yet.</h4>";
            }
        ?>
        <table class="w3-table-all">
            <tbody>
                <tr>
                    <th><center>Quantity</center></th>
                    <th><center>Order Date</center></th>
                    <th><center>Order Status</center></th>
                    <th><center>Product Category</center></th>
                    <th><center>Product Price</center></th>
                </tr>
                </tr>
                    <?php
                        echo ''.$output1.'';
                        echo ''.$output2.'';                   
                        echo ''.$output3.'';                    
                        echo ''.$output4.'';
                     ?>
                </tr>
            </tbody>
        </table>
        <?php
            echo'<table style="margin-left:70%;width:200px;">
                <tr><br>
                    <td><b>Subtotal: </b>&#8369;'.$subtotal.'</td>
                </tr>
            </table><br>';
        ?>

        <?php
            $sql1 = "SELECT shipping_fee FROM payments";
            $res = mysqli_query($conn, $sql1);
            $total = 0;
            if($check = mysqli_num_rows($res) > 0){
                if($row = mysqli_fetch_array($res)){
                    $sf = $row['shipping_fee'];
                    $total = ($subtotal + $sf);
                    echo'<hr>
                        <div style="float:right;margin-right:5.5%;"><b>Shipping Fee: </b>&nbsp;&nbsp;&nbsp;&nbsp;&#8369;'.$row['shipping_fee'].'</div><br>
                        <div style="float:right;margin-right:5%;"><br><b>TOTAL: </b><u><i>&#8369;'.$total.'</i></u>
                        <br><br><br></div>';
                }
            }
        ?>
</div>
</body>
</html>