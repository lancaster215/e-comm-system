<?php
session_start();
include_once '../../php/includes/db_include.php';

if (isset($_POST['update'])) {
	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$username = mysqli_real_escape_string($conn, $_POST['uname']);
	$add = mysqli_real_escape_string($conn, $_POST['add']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	//$pic = mysqli_real_escape_string($conn, $_POST['avatar']);
	//$uid = mysqli_real_escape_string($conn, $_POST['u_id']);

	$fnd = "SELECT user_acc_id FROM user_account WHERE user_acc_name = '$first' AND user_acc_id != $_SESSION[u_id]";
	$ran = mysqli_query($conn, $fnd);
	$lck = mysqli_num_rows($ran);
	if($lck > 0) {
		echo '<script>
			alert("Username is already taken!");
			window.location.href="settings.php";
		</script>';
		exit();
	}

	$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
	$sql = "UPDATE users SET user_first='$first', user_last='$last', user_address='$add', user_email='$email', user_pass='$hash_pass', user_uid='$username' WHERE user_id = $_SESSION[u_id]";
	$sql1 = "UPDATE user_account SET user_acc_name='$first', user_acc_pass='$hash_pass' WHERE user_id = $_SESSION[u_id]";	
	mysqli_query($conn, $sql);
	mysqli_query($conn, $sql1);
	echo '<script>
		alert("Successfully Updated!");
		window.location.href="../settings.php";
	</script>';
	exit();	
}
?>