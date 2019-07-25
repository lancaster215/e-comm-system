<?php
if (isset($_GET['error_user'])) {
	echo '<script>
	alert("Please login to enter!");
	window.location.href="home.php";
	</script>';
}
require_once '../php/includes/db_include.php';
session_start();
?>
<?php
    $user = $_SESSION['u_id'];
    $sql = "SELECT * FROM users WHERE user_id ='$user'";
    $run = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($run);
    //$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>

<html>
<head>
	<title>Approval</title>
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
    <form method="POST" action="checkout.php">
        <?php
            $uid = (int)$_SESSION['u_id'];
            $ufirst = $_SESSION['u_first'];
            $sql = "SELECT * FROM users, products, cart, orders, order_details WHERE cart.cart_id=orders.order_id AND cart.product_id=products.product_id AND cart.user_id=users.user_id AND order_details.order_details_id=orders.order_id AND cart.user_id='".$uid."'";
            $result = mysqli_query($conn, $sql);
            $run = mysqli_num_rows($result);
            $subtotal = 0;
            $output1 ="";
            $output2 ="";

            if ($run > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $qty = $row['qty'];
                    $cat = $row['product_cat'];
                    $num = $row['product_number'];
                    $type = $row['product_type'];
                    $price = $row['product_price'];

                    if ($qty == 2 || 3) {
                        $subqty = ($price * $qty);
                        $subtotal = ($subtotal + ($price * $qty));
                        $output1 .= '
                                <tr>
                                    <td>'.$row['qty'].'</td>
                                    <td>'.$row['product_cat'].'</td>
                                    <td>'.$row['product_number'].'</td>
                                    <td>'.$row['product_type'].'</td>
                                    <td>&#8369; '.$subqty.'</td>
                                    <td><a href="main_functions/cancel.php?cancel='.$row['order_id'].'" <button class="w3-btn btn-danger w3-red" type="submit" name="cancel"><i class="fa fa-trash-o fa-lg"></i></button></td>
                                    <br> 
                                </tr>';
                    }else{
                        $output2 .= '
                                <tr>
                                    <td>'.$row['qty'].'</td>
                                    <td>'.$row['product_cat'].'</td>
                                    <td>'.$row['product_number'].'</td>
                                    <td>'.$row['product_type'].'</td>
                                    <td>&#8369; '.$row['product_price'].'</td>
                                    <td><a href="main_functions/cancel.php?cancel='.$row['order_id'].'" <button class="w3-btn btn-danger w3-red" type="submit" name="cancel"><i class="fa fa-trash-o fa-lg"></i></button></td>
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
                    <th><b>Quantity</b></th>
                    <th><b>Product Category</b></th>
                    <th><b>Product Number</b></th>
                    <th><b>Product Type</b></th>
                    <th><b>Prices</b></th>
                    <th></th>
                </tr>
                </tr>
                    <?php
                        echo ''.$output1.'';
                        echo ''.$output2.'';                   
                    ?>
                </tr>
            </tbody>
        </table>
        <?php echo'<table style="margin-left:73%;width:200px;">
            <tr>
                <td><b>Subtotal: </b>&#8369; '.$subtotal.'</td>
            </tr>
        </table>';
        ?>
        <div style="margin:30px;">
            <?php
            $query = "SELECT * FROM cart";
            $res = mysqli_query($conn, $query);
            if ($check = mysqli_num_rows($res) > 0) {
                echo'<a href="checkout.php"><button class="w3-btn w3-green" style="float:right;">NEXT</button></a>
                <br>';
            }else{
                echo'<button class="w3-btn w3-green w3-disabled" style="float:right;">NEXT</button>
            <br>';
            }
            ?>
            <div style="margin-top:-25px;">
                <a href="portfolio_m.php" class="w3-btn w3-green">Continue Shopping</a>
            </div>
        </div>
    </form>
	</div>
</div>
<?php include_once"../php/footer_1.php";?>
</body>
</html>