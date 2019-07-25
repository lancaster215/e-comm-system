<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Greyscaled</title>
</head>
<style>
	body{background-color:#212a34;background-image:url(../img/bg/people1.jpg);background-repeat:no-repeat;background-size:cover;}
	.w3-card-8{max-width:500px;background-color:#fff;border-radius:5px;}
	.form{margin-left:30%;margin-top:10%;}
	#right-caption{color:white;float:right;margin-right:100px;margin-top:100px;}
	#right-caption h1{font-size:125px; font-family: "green piloww";}
	#right-caption a{text-shadow: 0px 9px 10px rgba(0,0,0,0.5);}
	a:hover{color:#82b541;;transition:.5s;}
	#footer{background-color:black;margin-top:620px;width:100%;color:white;opacity:.7;}
	#footer h5{text-align: center;font-size:12px;}
	#footer a{font-size: 20px;}
	@media (max-width: 768px){
		.w3-card-8{margin-top: 300px;margin-left:20px;}
		#right-caption h3{margin-top:-350px;padding-left:50px;margin-right:-80px;}
		#right-caption h1{padding-left:125px;}
	}
</style>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<div class="form">
	<?php 
	if (!isset($_SESSION['trans_mngr_id'])) {
		echo '
			<form action="manager_functions/db_sign_up.php" method="POST">
				<div class="w3-card-8">
					<div class="w3-container">
						<div class="w3-section">
							<label><input class="w3-input w3-margin-bottom" type="text" name="e-mail" placeholder="Your E-mail" required></label>
							<label><input class="w3-input w3-margin-bottom" type="text" name="name" placeholder="Your Username" required></label>
							<label><input class="w3-input w3-margin-bottom" type="password" name="pass" placeholder="Your Password" required></label>
							<button class="w3-btn w3-green w3-section" type="submit" name="submit">Sign-Up</button>
							<a href="index.php" class="w3-btn w3-red" style="width:130px;margin-top:20px;float:right;">Cancel</a>
						</div>
					</div>
				</div>
			</form>
		';
	}else{
		echo '<br><br><br><br><h1 style="color:white;background-color:#212a34;width:400px;">You are already Signed Up. Thank You!</h1><br><br><br><br><br><br><br><br><br><br>
		';
	}
	?>
</div>
</body>
</html>