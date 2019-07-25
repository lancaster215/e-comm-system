<?php

if(isset($_POST['submit'])){
	include_once 'db_include.php';

	$first = mysqli_real_escape_string($conn, $_POST['first']);
	$last = mysqli_real_escape_string($conn, $_POST['last']);
	$address = mysqli_real_escape_string($conn, $_POST['address']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);
	//$profpic = mysqli_real_escape_string($conn, $_POST['pic']);
	$type = "user";

	#Error handlers, check for empty fields

	if (empty($first) || empty($last) || empty($address) || empty($email) || empty($uid) || empty($pass)){
		header("Location: ../../main/index.php?signup=empty");
		exit();	
		#intl_get_error_message();
	}else{
		#check if valid
		if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){
			header("Location: ../../main/index.php?signup=invalid");
			exit();			
		}else{
			#if email is valid
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../../main/index.php?signup=invalid_email");
				exit();
			}else{
				$sql = "SELECT * FROM users WHERE user_uid='$uid'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);

				if ($resultCheck > 0){
					header("Location: ../../main/index.php?signup=user_taken");
					exit();
				}else{
					#hashing password
					$hash_pass = password_hash($pass, PASSWORD_DEFAULT);
					#insert the user inside the database
					$sql = "INSERT INTO users(user_first, user_last, user_address, user_email, user_uid, user_pass, user_type) VALUES ('$first', '$last', '$address', '$email', '$uid', '$hash_pass', '$type');";
					$sql1 = "INSERT INTO user_account(user_acc_id, user_acc_name, user_acc_pass) VALUES ('', '$uid', '$hash_pass');";
					mysqli_query($conn, $sql);
					mysqli_query($conn, $sql1);
					header("Location: ../../main/home.php?signup=success");
					echo '<script>
						aler("Successfully Sign-up!");
						window.location.href="../../main/home.php"
						</script>';
					exit();
				}
			}
		}
	}

}else{
	header("Location: ../../main/index.php?singup=error");
	echo '<script>
		alert("Error Singing-up!");
		window.location.href="../../main/home.php
		<script>';
	exit();
}
?>