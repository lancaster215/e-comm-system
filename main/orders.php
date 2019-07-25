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
	<title>Your Orders</title>
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
        <?php
            $uid = (int)$_SESSION['u_id'];
            $ufirst = $_SESSION['u_first'];
            $sql = "SELECT * FROM  orders WHERE user_id=$uid";
            $result = mysqli_query($conn, $sql);
            $chk = mysqli_num_rows($result);
            $subtotal = 0;
            $output ="";
            $output1 ="";
            $output2 ="";
            $output3 ="";
            $output4 ="";
            $output5 ="";
                        if ($chk > 0) {
                            while ($row = mysqli_fetch_array($result)) {
                                $qty = $row['qty'];
                                $price= $row['product_price'];
                                $ord = $row['order_date'];
                                $status = $row['order_status'];
                                $cor_stat = $row['courier_status'];
                                
                                if ($status == 'delivered'){
                                    $output .='';
                                }elseif ($cor_stat == 'received') {
                                    $subqty = ($price * $qty);
                                    $subtotal = ($subtotal + ($price * $qty));
                                    $output1 .='
                                        <tr>
                                            <td><center>'.$qty.'</center></td>
                                            <td><center>'.$row['product_cat'].'</td>
                                            <td><center>'.$ord.'</center></td>
                                            <td><center>'.$row['order_status'].'</center></td>
                                            <td><center>&#8369; '.$row['product_price'].'</center></td>
                                            <td>x '.$qty.' = &#8369; '.$subqty.'</td>
                                            <td><button class="w3-btn w3-red w3-disabled">CANCEL</button></td>
                                        </tr>';
                                }elseif ($status == 'delivering') {
                                    $subqty = ($price * $qty);
                                    $subtotal = ($subtotal + ($price * $qty));
                                    $output2 .='
                                        <tr>
                                            <td><center>'.$qty.'</center></td>
                                            <td><center>'.$row['product_cat'].'</td>
                                            <td><center>'.$ord.'</center></td>
                                            <td><center>'.$row['order_status'].'</center></td>
                                            <td><center>&#8369; '.$row['product_price'].'</center></td>
                                            <td>x '.$qty.' = &#8369; '.$subqty.'</td>
                                            <td><a href="main_functions/cancel_1.php?cancelled='.$row['order_id'].'"><button class="w3-btn w3-red" type="submit" name="cancel">CANCEL</button></a></td>
                                        </tr>';
                                }elseif ($status == 'ongoing') {
                                    $subqty = ($price * $qty);
                                    $subtotal = ($subtotal + ($price * $qty));
                                    $output3 .='
                                        <tr>
                                            <td><center>'.$qty.'</center></td>
                                            <td><center>'.$row['product_cat'].'</td>
                                            <td><center>'.$ord.'</center></td>
                                            <td><center>'.$row['order_status'].'</center></td>
                                            <td><center>&#8369; '.$row['product_price'].'</center></td>
                                            <td>x '.$qty.' = &#8369; '.$subqty.'</td>
                                            <td></td>
                                        </tr>';
                                }elseif ($status == 'on-sale'){
                                    $subqty = ($price * $qty);
                                    $subtotal = ($subtotal + ($price * $qty));
                                    $output4 .='
                                        <tr>
                                            <td><center>'.$qty.'</center></td>
                                            <td><center>'.$row['product_cat'].'</td>
                                            <td><center>'.$ord.'</center></td>
                                            <td><center>'.$row['order_status'].'</center></td>
                                            <td><center>&#8369; '.$row['product_price'].'<center></td>
                                            <td>x '.$qty.' = &#8369; '.$subqty.'</td>
                                            <td></td>
                                        </tr>';
                                }elseif ($status == 'cancelled'){
                                    $subqty = ($price * $qty);
                                    $subtotal = ($subtotal + ($price * $qty));
                                    $output5 .='
                                        <tr>
                                            <td><center>'.$qty.'</center></td>
                                            <td><center>'.$row['product_cat'].'</td>
                                            <td><center>'.$ord.'</center></td>
                                            <td><center>'.$row['order_status'].'</center></td>
                                            <td><center>&#8369; '.$row['product_price'].'<center></td>
                                            <td>x '.$qty.' = &#8369; '.$subqty.'</td>
                                            <td><a href="main_functions/reprocess.php?repro='.$row['order_id'].'"><button class="w3-btn w3-green" type="submit" name="cancel">RESUME</button></a></td>
                                        </tr>';
                                }
                            }
            }else{
                echo "<h4>No Orders yet.</h4>";
            }
        ?>
         <table class="w3-table-all" style="margin-top:30px;">
            <tbody>
                <tr>
                    <th><center>Quantity</center></th>
                    <th><center>Product Category</center></th>
                    <th><center>Order Date</center></th>
                    <th><center>Order Status</center></th>
                    <th><center>Product Price</center></th>
                    <th></th>
                    <th></th>
                </tr>
                </tr>
                    <?php
                        echo ''.$output.'';
                        echo ''.$output1.'';
                        echo ''.$output2.'';
                        echo ''.$output3.'';
                        echo ''.$output4.'';
                        echo ''.$output5.'';                   
                    ?>
                </tr>
            </tbody>
        </table>
        <?php 
        echo'<table style="margin-left:81%;width:200px;">
            <tr><br>
                <td><b>Total: </b>&#8369; '.$subtotal.'</td>
            </tr>
        </table>
        <br>';
        ?>
	</div>
</div>
<?php include_once"../php/footer_1.php";?>
</body>
</html>