<?php
include_once '../../php/includes/db_include.php';
session_start();
if (isset($_GET['cancelled'])) {
	$can = $_GET['cancelled'];
	$uid = $_SESSION['u_id'];

	$sql = "UPDATE orders SET order_status='cancelled' WHERE order_id='$can'";
	$result = mysqli_query($conn, $sql);

	echo'<script>
			alert("This Item has been Cancelled!");
			window.location.href="../orders.php";
		</script>';
}
?>