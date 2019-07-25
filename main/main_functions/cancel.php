<?php
include_once '../../php/includes/db_include.php';
session_start();
if (isset($_GET['cancel'])) {
	$cancel = $_GET['cancel'];
	$uid = $_SESSION['u_id'];

	$sql = "DELETE FROM orders WHERE order_id='$cancel' AND user_id='$uid'";
	$result = mysqli_query($conn, $sql);
	$sql1 = "DELETE FROM order_details WHERE order_details_id='$cancel' AND user_id='$uid'";
	$result1 = mysqli_query($conn, $sql1);
	$sql2 = "DELETE FROM cart WHERE cart_id ='$cancel' AND user_id='$uid'";
	$result2 = mysqli_query($conn, $sql2);

	echo'<script>
			window.location.href="../approve.php";
		</script>';
}
?>