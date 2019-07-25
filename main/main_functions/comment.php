<?php
session_start();
include_once '../../php/includes/db_include.php';

if (isset($_SESSION['u_id'])!="") {
			if ($_SESSION['u_type'] != "admin") {
				header("Location:");
			} else {
				header("Location: ../../admin/admin.php");
			}
}
if (!isset($_SESSION['u_id'])) {
 header("Location: ../index.php?error2");
}
if (isset($_POST['comment'])) {
	$user = $_SESSION['u_id'];
	$prod_id = mysqli_real_escape_string($conn, $_POST['p_id']);
	$comm = mysqli_real_escape_string($conn, $_POST['des']);
	$sql = "INSERT INTO comments(comment_id, product_comm, product_id, user_id) VALUES ('', '$comm', '$prod_id', '$user')";
	mysqli_query($conn, $sql);
	header("Location: ../reviews.php?prod=$prod_id");
	exit();
	}
?>