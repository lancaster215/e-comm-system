<?php 
session_start(); 

if (isset($_GET['error_user'])) {
	echo '<script>
	alert("Please login to enter!");
	window.location.href="home.php";
	</script>';
}
?>
<?php
require_once '../php/includes/db_include.php';
if (isset($_SESSION['u_id']) != "") {
	if ($_SESSION['u_type'] == "user") {
		#pakyupo!
	} else if ($_SESSION['u_type'] == "admin") {
		header("Location: ../admin/admin.php");
	} else if ($_SESSION['u_type'] == "warehouse"){
		header("Location: ../warehouse/warehouse.php");
	}else{
		header("Location:");
	}
}
if (isset($_GET['error1'])) {
	echo '<script>
		alert("You must be admin to access this page");
		window.location.href="index.php";
		</script>';
}
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
	<?php include_once "../php/navigation.php";?>
	<?php include_once "../php/banner.php";?>
	<br>
	<div class="w3-margin-top w3-padding" id="gents">
		<div class="w3-row-padding">
			<div class="w3-quarter">
				<div class="w3-card-4 w3-hover-opacity">
					<img src="../img/fashion/1.png">
				</div>
				<br>
			</div>
			<div class="w3-quarter">
				<div class="w3-card-4 w3-hover-opacity">
					<img src="../img/fashion/2.png">
				</div>
				<br>
			</div>
			<div class="w3-half">
				<div class="w3-card-4 w3-hover-opacity">
					<img src="../img/fashion/10.png">
					<div class="w3-section">
						<h5>New Tees for the new fashion of Men</h5>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="w3-half w3-padding gents">
		<hr style="width: 70%;border-color:black;">
		<em><h1>Getlemen Wears</h1></em>
		<hr style="width: 70%;border-color:black;">
	</div>
	<div id="price">
		<div class="pricing" >
			<h1 style="margin-top:-120px;color:grey;font-size:80px;margin-left:15%"><i>For As Low As:</i></h1>
			<div class="w3-quarter" id="table-1">
				<table>
					<tr>
					<a href="trends.php" id="trends"><h1>Trends</h1></a>
					<hr>
						<td>
							<?php
								$sql = "SELECT AVG(product_price) AS price FROM products WHERE product_type='Trends'";
								$result = mysqli_query($conn, $sql);
								$chk = mysqli_num_rows($result);
								if ($chk>0) {
									while($row = mysqli_fetch_array($result)){
										$sum = $row['price'];
										$round = round($sum,0);
										if ($round == 0) {
											echo"<a hrefr='trends.php'><h4 style='text-align:center;'>There are no Products Available yet.</h4></a>";
										}else{
											echo"<a href='trends.php'><h3>&#8369;$round</h3></a>";	
										};
									}
								}
							?>
						</td>
					</tr>
				</table>
			</div>
			<div class="w3-quarter" id="table-2">
				<table>
					<tr>
					<a href="new_arrivals.php" id="new"><h1>New Arrivals</h1></a>
					<hr>
						<td>
							<?php
								$sql = "SELECT AVG(product_price) AS price FROM products LIMIT 5";
								$result = mysqli_query($conn, $sql);
								$chk = mysqli_num_rows($result);
								if ($chk>0) {
									while($row = mysqli_fetch_array($result)){
										$sum = $row['price'];
										$round = round($sum,0);
										if ($round == 0) {
											echo"<a href='new_arrivals.php'><h4 style='text-align:center;'>There are no Products Available yet.</h4></a>";
										}else{
											echo"<a href='new_arrivals.php'><h1>&#8369;$round</h1></a>";	
										}
									}
								}
							?>
						</td>
					</tr>
				</table>
			</div>
			<div class="w3-quarter" id="table-3">
				<table>
					<tr>
					<a href="limited.php" id="limited"><h1>Limited</h1></a>
					<hr>
						<td>
							<?php
								$sql = "SELECT AVG(product_price) AS price FROM products WHERE product_type='Limited'";
								$result = mysqli_query($conn, $sql);
								$chk = mysqli_num_rows($result);
								if ($chk>0) {
									while($row = mysqli_fetch_array($result)){
										$sum = $row['price'];
										$round = round($sum,0);
										if ($round == 0) {
											echo"<a href='limited.php'><h4 style='text-align:center;'>There are no Products Available yet.</h4></a>";
										}else{
											echo"<a href='limited.php'><h3>&#8369;$round</h3></a>";	
										}
									}
								}
							?>
						</td>
					</tr>
				</table>
			</div>
		</div>
	</div>
	
	<div class="w3-padding" id="lads">
		<div class="w3-row-padding">
			<div class="w3-half">
				<div class="w3-card-4 w3-hover-opacity">
					<img src="../img/fashion/Capture+_2018-01-13-10-31-33-1.png" style="height:600px;">
					<div class="w3-section">
						<h5>Vast choices of Women's like</h5>
					</div>
				</div>
			</div>
			<div class="w3-half lads">
				<hr style="width: 70%;border-color:black;">
				<em><h1>Women Wears</h1></em>
				<hr style="width: 70%;border-color:black;">
			</div>
			<div class="w3-quarter">
				<div class="w3-card-4 w3-hover-opacity">
					<img src="../img/fashion/Capture+_2018-01-13-10-31-13-1.png">
				</div>
				<br>
			</div>
			<div class="w3-quarter">
				<div class="w3-card-4 w3-hover-opacity">
					<img src="../img/fashion/Capture+_2018-01-13-10-31-38-1.png">
				</div>
				<br>
			</div>
		</div>
	</div>
	<?php include_once "../php/footer.php";?>
</body>
</html>