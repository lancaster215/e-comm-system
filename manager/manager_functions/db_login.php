<?php

session_start();

if (isset($_POST['login'])) {
	include 'db_include.php';

	$user= mysqli_real_escape_string($conn, $_POST['uid']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	#error handlers
	#check if inputs are empty
	if(empty($user) || empty($pass)){
		echo '<script>
				alert("Empty Fields!");
				window.location.href="../index.php?login=empty";
			</script>';
		exit();
	} else{
		$sql = "SELECT * FROM trans_mngr WHERE trans_mngr_username='$user'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		
		/*$sql1 = "SELECT * FROM users WHERE user_type='$utype'";
		$result1 = mysqli_query($conn, $sql1);
		$resultCheck1 = mysqli_num_rows($result1);*/
		if ($resultCheck < 1) {
			echo '<script>
					alert("Username Error!");
					window.location.href="../index.php?login=error_user";
				</script>';
			exit();
		/*}elseif($resultCheck1 != 'admin'){
			echo '<script>
					alert("You must be an admin to access this page!");
					window.location.href="../../main/home.php?error_admin";
				<script>';*/
		}else{
			if ($row = mysqli_fetch_assoc($result)){
				//dehashing pass
				$hashpasscheck = password_verify($pass, $row['trans_mngr_pass']);
				if ($hashpasscheck == false) {
					echo '<script>
							alert("Password Error!");
							window.location.href="../index.php?login=error_pass";
						</script>';
					exit();
				}elseif($hashpasscheck == true){
					#login the user here
					$_SESSION['trans_mngr_id'] = $row['trans_mngr_id'];
					$_SESSION['trans_mngr_pass'] = $row['trans_mngr_pass'];
					$_SESSION['trans_mngr_uid'] = $row['trans_mngr_username'];
					header("Location: ../manager.php?login=success");
					exit();
				}
			}
		}
	}
}else{
	header("Location: ../index.php?login=error");
	exit();
	}
?>