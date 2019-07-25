<?php
include_once('admin_functions/db_include.php');
	if (isset($_SESSION['u_type']) == "user") {
		header("Location: ../main/index.php");
	}
	if (isset($_SESSION['admin_id'])) {
	header("Location: index.php?error_user");
	}else{
	header("Location:");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<div class="w3-row-padding" id="navbar">
	<ul class="w3-navbar" id="whole_cog">
		<li id="setting">
			<a href="admin_functions/db_logout.php?logout"></a>
		</li>
	</ul>
	<h1 id="admin" style="margin-top:-45px;">ADMIN</h1>
</div>
<div class="w3-margin-top w3-padding">
	<div class="w3-row-padding">
		<div class="w3-quarter">
			<div class="w3-card-4" id="left-bar">
				<div id="top-left-log">
					<a class="w3-btn w3-red" href="admin_functions/db_logout.php?logout">Log out</a>
				</div>
				<div>
					<ul class="card-out">
						<li class="top-bottom" style="text-align: center; color: #212a34;">MAIN</li>
						<li class="card-content"><a href="manage.php" class="w3-hover-opacity">Manage Accounts of Users</a></li>
						<li class="card-content"><a href="sales.php" class="w3-hover-opacity">Sale Reports</a></li>
						<li class="card-content"><a href="arrivals.php" class="w3-hover-opacity">View New Arrivals</a></li>
						<li class="card-content"><a href="orders.php" class="w3-hover-opacity">View Orders</a></li>
						<li class="card-content"><a href="comments.php" class="w3-hover-opacity">View Comments</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="w3-half">
			<div class="w3-card-4" id="right-bar" style="margin-left:10%;width:150%;">
				<h3 style="margin-left:35%;"><b>--Choose a Function--</b></h3>
			</div>
		</div>
	</div>	
</div>
</body>
</html>