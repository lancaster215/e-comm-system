<?php
include_once('../php/includes/db_include.php');
session_start();

if (!isset($_SESSION['u_id'])) {
	header("Location: home.php?error_user");
}else{
	header("Location:");
}
?>
<?php
	$user = $_SESSION['u_id'];
	$sql = "SELECT * FROM users WHERE user_id ='$user'";
	$run = mysqli_query($conn, $sql);
	$result = mysqli_fetch_array($run);
	//$user_id = mysqli_real_escape_string($conn, $_SESSION['user_id']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Settings</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
	<?php include_once "../php/navigation_1.php";?>
	<div class="w3-row-padding" style="padding-top:65px;margin-left:35%;">
		<div class="w3-container w3-card-2" style="width:50%;padding:5%;">
			<form method="POST" action="main_functions/update_user.php" enctype="multipart/form-data">
				<h1 style="text-align:center;">Edit Your Profile</h1><br><br>
				<table>
					<tr>
						<td><h5><b>Edit First Name: </b></h5></td>
						<td><input type="text" name="first" placeholder="New First Name"></td>
					</tr>
					<tr>
						<td><br><h5><b>Edit Last Name: </b></h5></td>
						<td><br><input type="text" name="last" placeholder="New Last Name"></td>
					</tr>
					<tr>
						<td><br><h5><b>Edit Username: </b></h5></td>
						<td><br><input type="text" name="uname" placeholder="New Username"></td>
					</tr>
					<tr>
						<td><br><h5><b>Edit Address: </b></h5></td>
						<td><br><input type="text" name="add" placeholder="New Address"></td>
					</tr>
					<tr>
						<td><br><h5><b>Edit Email: </b></h5></td> 
						<td><br><input type="text" name="email" placeholder="New Email"></td>
					</tr>
					<tr>
						<td><br><h5><b>Edit Password: </b></h5></td>
						<td><br><input type="password" name="pass" placeholder="New Password"></td>
					</tr>
				</table>
				<br>
				<div style="text-align:center;"><input type="submit" name="update" class="w3-btn w3-green" value="Save Changes"><br><br></div>
			</form>
		</div>
	</div>
	<?php include_once "../php/footer_1.php";?>
</body>
</html>