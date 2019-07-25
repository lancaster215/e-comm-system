<?php
include_once '../../php/includes/db_include.php';
session_start();
if (isset($_GET['repro'])) {
	$can = $_GET['repro'];
	$uid = $_SESSION['u_id'];

	$sql = "UPDATE orders SET order_status='delivering' WHERE order_id='$can'";
	$result = mysqli_query($conn, $sql);

	echo'<script>
			alert("The Process of this item has been Resumed!");
			window.location.href="../orders.php";
		</script>';
}
?>