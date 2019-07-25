<?php
session_start();
include_once 'db_include.php';

if (isset($_GET['receive'])) {
	$rec = $_GET['receive'];

	$sql = "UPDATE orders SET trans_mngr_status='received' WHERE user_id='$rec' AND order_status='delivering'";
	$res = mysqli_query($conn, $sql);

	echo '<script>
			alert("Product Successfully Received!");
			window.location.href="../manager.php";
		</script>';

}
?>