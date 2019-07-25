<?php

$dbserver_name = "localhost";
$dbuser_name = "root";
$dbpassword = "";
$dbname = "ecom";

$conn = mysqli_connect($dbserver_name, $dbuser_name, $dbpassword, $dbname) or die ('Cannot connect ot the server!');

if($conn->connect_error) {
	$_SESSION['error_msg'] = "Database connection failed";
	header("Location: ../index.php");
	exit();
}

?>