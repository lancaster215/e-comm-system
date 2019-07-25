<?php
session_start();
include_once 'db_include.php';

if (isset($_GET['res'])) {
	$alter = $_GET['res'];
	$sql = "UPDATE users SET user_delete = 0 WHERE user_id = '$alter'";
	$sql1 = "UPDATE users SET user_type = 'user' WHERE user_id = '$alter'";
	$result = mysqli_query($conn, $sql);
	$result1 = mysqli_query($conn, $sql1);
	echo '<script>
			alert("This User has been restored!");
			window.location.href="../manage.php";
		</script>';
}
?>