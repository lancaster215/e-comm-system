<?php

session_start();

if (isset($_POST['submit'])) {
	include_once 'db_include.php';

	$uid = mysqli_real_escape_string($conn, $_POST['uid']);
	$pass = mysqli_real_escape_string($conn, $_POST['pass']);

	#error handlers
	#check if inputs are empty
	if(empty($uid) || empty($pass)){
		echo '<script>
				alert("Empty Fields!");
				window.location.href="../../main/home.php?login=empty";
			</script>';
		exit();
	} else{
		$sql = "SELECT * FROM users WHERE user_uid='$uid'";
		$result = mysqli_query($conn, $sql);

		if ($resultCheck = mysqli_num_rows($result) < 1) {
			if ($uid == "admin" || "warehouse") {
				echo'<script>
					alert("You are not an Admin! You cannot login here.");
					window.location.href="../../main/home.php?login=error_user&test='.$uid.'";
				</script>';
				exit();
			}else{
				echo '<script>
					alert("Username Error!");
					window.location.href="../../main/home.php?login=error_user&test='.$uid.'";
				</script>';
				exit();
			}	
		}else{
			if ($row = mysqli_fetch_assoc($result)){
				$blk = $row['user_type'];
				//dehashing pass
				$hashpasscheck = password_verify($pass, $row['user_pass']);
				if ($hashpasscheck == false) {
					echo '<script>
							alert("Password Error!");
							window.location.href="../../main/home.php?login=error_pass&test='.$uid.'";
						</script>';
					exit();
				}elseif ($blk == "blocked") {
					echo'<script>
							alert("Your account have been blocked by the Admin! You cant access your account.");
							window.location.href="../../main/home.php?login=error_user&test='.$uid.'";
						</script>';
					exit();
				}elseif ($hashpasscheck == true){
					#login the user here
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_first'];
					$_SESSION['u_last'] = $row['user_last'];
					$_SESSION['u_pass'] = $row['user_pass'];
					$_SESSION['u_address'] = $row['user_address'];
					$_SESSION['u_email'] = $row['user_email'];
					$_SESSION['u_uid'] = $row['user_uid'];
					$_SESSION['u_type'] = $row['user_type'];
					$_SESSION['u_pic'] = $row['user_pic'];
					$_SESSION['u_del'] = $row['user_delete'];
					header("Location: ../../main/home.php?login=success");
					exit();
				}
			}
		}
	}
}else{
	header("Location: ../../main/home.php?login=error");
	exit();
	}
?>