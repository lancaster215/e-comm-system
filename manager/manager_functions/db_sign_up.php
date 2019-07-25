<?php

if(isset($_POST['submit'])){
	include_once 'db_include.php';


	$email = mysqli_real_escape_string($conn, $_POST['e-mail']);
	$user = mysqli_real_escape_string($conn, $_POST['name']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	//$profpic = mysqli_real_escape_string($conn, $_POST['pic']);

	#Error handlers, check for empty fields

	if (empty($email) || empty($user) || empty($pass)){
		header("Location: ../index.php?signup=empty");
		exit();	
		#intl_get_error_message();
	}else{
			#if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../index.php?signup=invalid_email");
				exit();
			}else{
				$sql = "SELECT * FROM trans_mngr WHERE trans_mngr_username='$user'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0){
					header("Location: ../index.php?signup=user_taken");
					exit();
				}else{
					#hashing password
					$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
					#insert the user inside the database
					$sql = "INSERT INTO trans_mngr(trans_mngr_username, trans_mngr_pass) VALUES ('$user', '$hash_pass');";
					$sql1 = "INSERT INTO user_account(user_acc_id, user_acc_name, user_acc_pass) VALUES ('', '$user', '$hash_pass');";
					mysqli_query($conn, $sql);
					mysqli_query($conn, $sql1);
					header("Location: ../index.php?signup=success");
					echo '<script>
						aler("Successfully Sign-up!");
						window.location.href="../index.php"
						</script>';
					exit();
				}
			}
		}
	}
else{
	header("Location: ../index.php?singup=error");
	echo '<script>
		alert("Error Singing-up!");
		window.location.href="../index.php
		<script>';
	exit();
}
?>