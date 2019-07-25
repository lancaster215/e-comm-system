<?php
session_start();
include_once '../../php/includes/db_include.php';

if(isset($_POST['add'])){
	$total=0;
	$num = mysqli_real_escape_string($conn, $_POST['num']);
	$pid = mysqli_real_escape_string($conn, $_POST['pid']);
	$cat = mysqli_real_escape_string($conn, $_POST['cat']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$qty = mysqli_real_escape_string($conn, $_POST['quantity']);
	$uid = $_SESSION['u_id'];

	$sql = "SELECT product_id, user_id FROM order_details WHERE product_id = '$pid' AND user_id = '$uid' AND bought = '0'";
	$run = mysqli_query($conn, $sql);
	$chk = mysqli_num_rows($run);

	$sql1 = "SELECT product_price FROM products WHERE product_id ='$pid'";
	$run1 = mysqli_query($conn, $sql1);
	$chk1 = mysqli_num_rows($run1);

	$subtotal = ($qty * ($chk['product_price']));
	$total = ($total + $subtotal);

	$sql2 = "INSERT INTO order_details(product_id, product_number, product_price, qty, user_id) VALUES ($pid, '$num', '$price', '$qty', '$uid')";
	$sqlcart = "INSERT INTO cart(product_id, user_id, qty) VALUES ($pid, '$uid', '$qty')";
	$sqlorder = "INSERT INTO orders(qty, user_id, delivery_id ,product_id, product_price, product_cat, order_status) VALUES ('$qty', '$uid', '$uid','$pid','$price', '$cat', 'on-sale')";
	mysqli_query($conn, $sql2);
	mysqli_query($conn, $sqlcart);
	mysqli_query($conn, $sqlorder);
	mysqli_query($conn, $sql);
	echo '<script>
		window.location.href="../portfolio_m.php";
	</script>';
}
?>