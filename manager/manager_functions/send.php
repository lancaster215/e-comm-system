<?php
session_start();
include_once 'db_include.php';

if (isset($_GET['send'])) {
	$rec = $_GET['send'];

	$sql = "UPDATE orders SET courier_status='delivering' WHERE user_id='$rec' AND trans_mngr_status='received'";
	$res = mysqli_query($conn, $sql);

	$sql1 = "UPDATE orders SET trans_mngr_status='sent' WHERE user_id='$rec' AND order_status='delivering'";
	$res1 = mysqli_query($conn, $sql1);

	echo '<script>
			alert("Product is Delivering to Courier!");
			window.location.href="../manager.php";
		</script>';

}
?>