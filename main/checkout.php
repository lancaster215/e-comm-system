<?php
session_start();
if (isset($_GET['error_user'])) {
	echo '<script>
	alert("Please login to enter!");
	window.location.href="home.php";
	</script>';
}
require_once '../php/includes/db_include.php';
?>
<!DOCTYPE html>

<html>
<head>
	<title>Checkout</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<?php include_once "../php/navigation_1.php";?>
<div class="w3-row-padding" style="padding-top:55px;margin-left:10%;margin-right:10%;">
	<div class="w3-container w3-card-2">
        <h2><center>Please Confirm Your Order/s</center></h2>
        <?php
            $uid = (int)$_SESSION['u_id'];
            $ufirst = $_SESSION['u_first'];
            $sql = "SELECT * FROM  orders WHERE user_id=$uid";
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
                                $price= $row['product_price'];
                                $ord = $row['order_date'];  
                                $status = $row['order_status'];
                                $pid = $row['product_id'];
                                $odid = $row['order_id'];

                                if ($status == 'delivered') {
                                    $output1 .='';
                                }elseif($status == 'delivering'){
                                    $output2 .='';
                                }elseif($status == 'ongoing'){
                                    $output3 .='';
                                }else{
                                    $subqty = ($price * $qty);
                                    $subtotal = ($subtotal + ($price * $qty));
                                    $output4 .='
                                        <tr>
                                            <td><center>'.$qty.'</center></td>
                                            <td><center>'.$row['product_cat'].'</td>
                                            <td><center>'.$ord.'</center></td>
                                            <td><center>&#8369; '.$subqty.'</center></td>
                                            <br>
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
                    <th><center>Product Category<center></th>
                    <th><center>Order Date</center></th>
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
        echo'<table style="margin-left:73%;width:200px;">
            <tr><br>
                <td><b>Total: </b><u>&#8369; '.$subtotal.'</u></td>
            </tr>
        </table>
        <br>';
        ?>
        <table align="right" style="margin-top: -40px;">
            <tr>
                <td style="padding: 30px;">
                    <div class="title">
                        <br>
                        <?php
                        $uid = $_SESSION['u_id'];
                        $sql1 = "SELECT * FROM users WHERE user_id='$uid'";
                        $result1 = mysqli_query($conn, $sql1);
                        if($chk1 = mysqli_num_rows($result1) > 0){
                            if($rows = mysqli_fetch_array($result1)){
                                echo'<form action="main_functions/save_details.php" method="post" align="center">
                                        <br><br><br>
                                        <h1>Checkout</h1>
                                        <h5>***Note: We only offer Cash on Delivery***</h5>
                                        <h5><b>Fullname:</b></h5>
                                        <input style="width:400px;" type="text" name="name" id="name" value="'.$rows['user_first'].' '.$rows['user_last'].'"><br>
                                        <h5><b>Email:</b></h5>
                                        <input style="width:400px;" type="email" name="email" id="email" value='.$rows['user_email'].'><br>
                                        <h5><b>Delivery Address:</b></h5>
                                        <input style="width:400px;" type="text" name="address" id="address" value='.$rows['user_address'].'><br>
                                        <h5><b>Contact Number:</b></h5>
                                        <input style="width:400px;" type="text" name="num" id="number">';
                            }
                        }
                        $sql = "SELECT * FROM users, orders WHERE orders.user_id=users.user_id AND orders.order_id AND orders.product_id AND users.user_id='$uid'";
                        $result = mysqli_query($conn, $sql);
                        if($chk = mysqli_num_rows($result) > 0){
                            while($row = mysqli_fetch_array($result)){
                                echo'<input type="hidden" name="pid" id="pid" value='.$row['product_id'].'>
                                    <input type="hidden" name="odid" id="odid" value='.$row['order_id'].'><br><br>';
                            }echo'<button class="w3-btn w3-green" type="submit" name="submit_cus">Submit</button>
                                    <br><br><br>
                                    </form>';
                        }
                        ?>
                        
                    </div>
                </td>
            </tr>
        </table>
	</div>
</div>
<?php include_once"../php/footer_1.php";?>
</body>
</html>