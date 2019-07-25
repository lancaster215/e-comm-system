<?php 
session_start();

if (isset($_GET['error_user'])) {
	echo '<script>
	alert("Please login to enter!");
	window.location.href="home.php";
	</script>';
}
require_once '../php/includes/db_include.php';
?>
<!DOCTYPE html>
<html>
<head>
	<title>Greyscaled</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
	<?php include_once "../php/navigation_1.php";?>
	<div class="w3-row-padding" style="padding-top:55px;">
	<?php
		$sql = "SELECT * FROM products LIMIT 8";
		$result = mysqli_query($conn, $sql);
		$chk = mysqli_num_rows($result);
		if ($chk > 0) {
			while($row = mysqli_fetch_array($result)){ //in the img1, closebtn must be incremented to set the closebtn value to its own container only
				$image = $row['product_image'];
				$price = $row['product_price'];
			
				echo "<div class='w3-quarter'>";
				echo "<div class='w3-card-2' style='display:block'>";
				echo "<img width='325' height='350px' src='../warehouse/product_images/".$row['product_image']."'>";
				echo '<div class="w3-container">
					<h1 class="w3-green"><b>&#8369;'.$row['product_price'].'</b></h1>
				</div>';
				echo "</div><br>";
				echo "</div>";
			}
		}
	?>
	</div>
</body>
</html>