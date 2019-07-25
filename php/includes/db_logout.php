<?php

if (isset($_POST['submit'])) {
	session_start();
	session_unset();
	session_destroy();
	header("Location: ../../main/home.php?successfully_logout");
	exit();
}

?>