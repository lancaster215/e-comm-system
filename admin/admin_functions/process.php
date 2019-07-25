<?php
session_start();
include_once 'db_include.php';

if (isset($_POST['pros'])) {
	$odid = mysqli_real_escape_string($conn, $_POST['odid']);
	$price = mysqli_real_escape_string($conn, $_POST['price']);
	$cat = mysqli_real_escape_string($conn, $_POST['cat']);
	$qty = mysqli_real_escape_string($conn, $_POST['qty']);
	$pid = mysqli_real_escape_string($conn, $_POST['pid']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$shipping = 100;


	$sql = "INSERT INTO payments(payment_id, order_id, qty, product_price, product_cat, product_id, user_id, shipping_fee, total_amount) VALUES ('', '$odid', '$qty','$price', '$cat', '$pid', '$uid', '$shipping', '$price')";
	$res = mysqli_query($conn, $sql);

	$sql2 = "UPDATE order_details SET bought = 1 WHERE order_details_id='$odid'";
	$res2 = mysqli_query($conn, $sql2);

	$sql3 = "UPDATE orders SET order_status='delivering' WHERE order_id='$odid' AND order_status='ongoing'";
	$res2 = mysqli_query($conn, $sql3);

	echo'<script>
		alert("Product has been processed!");
		window.location.href="../preprocess.php";
	</script>';
}

?>