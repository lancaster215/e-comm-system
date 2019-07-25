<?php
session_start(); 

if (isset($_GET['error_user'])) {
	echo '<script>
	alert("Please login to enter!");
	window.location.href="index.php";
	</script>';
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager Login</title>
</head>
<style type="text/css">
	body{background-color:#212a34;background-image:url(../img/bg/people1.jpg);background-repeat:no-repeat;background-size:cover;}
</style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<form id="login" action="manager_functions/db_login.php" method="POST">
	<div class="w3-modal-content w3-card-8" style="max-width:400px;margin-top:150px;">
		<div class="w3-container w3-border-top w3-padding-16">
			<h1 style="margin-left:15%;">Manager LOGIN</h1>
		</div>
		<div class="w3-container w3-light-grey">
			<div class="w3-section">
				<label><b>Username</b></label>
					<i class="fa fa-user"></i>
					<input class="w3-input w3-border w3-margin-bottom" type="text" name="uid" placeholder="Enter Username" required>
				<label><b>Password</b></label>
					<i class="fa fa-key"></i>
					<input class="w3-input w3-border w3-margin-bottm" type="password" name="pass" placeholder="Enter Password" required>
					<br>
				<button class="w3-btn w3-btn-block w3-green w3-section" type="submit" name="login">Log-in</button>
				<a href="sign-up.php" class="w3-btn w3-blue" style="width:130px;float:right;">Sign-up First</a>
				<p style="float:right;margin-top:8px;margin-right:10px;margin-bottom:20px;">No Account?</p>
			</div>
		</div>
	</div>
</form>
</body>
</html>