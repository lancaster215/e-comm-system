<?php
include_once 'admin_functions/db_include.php';
	if (isset($_SESSION['u_type']) == "user") {
		header("Location: ../main/index.php");
	}
	if (isset($_SESSION['admin_id'])) {
	header("Location: index.php?error_user");
	}else{
	header("Location:");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style_admin.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<div class="w3-row-padding" id="navbar">
	<ul class="w3-navbar" id="whole_cog">
		<li id="setting">
			<a href="admin_functions/db_logout.php?logout"></a>
		</li>
	</ul>
	<h1 id="admin" style="margin-top:-45px;">ADMIN</h1>
</div>
<div class="w3-margin-top w3-padding">
	<div class="w3-row-padding">
		<div class="w3-quarter">
			<div class="w3-card-4" id="left-bar">
				<div id="top-left-log">
					<a class="w3-btn w3-red" href="admin_functions/db_logout.php?logout">Log out</a>
				</div>
				<div>
					<ul class="card-out">
						<li class="top-bottom" style="text-align: center; color: #212a34;">MAIN</li>
						<li class="card-content"><a href="manage.php" class="w3-hover-opacity">Manage Accounts of Users</a></li>
						<li class="card-content"><a href="sales.php" class="w3-hover-opacity">Sale Reports</a></li>
						<li class="card-content"><a href="arrivals.php" class="w3-hover-opacity">View New Arrivals</a></li>
						<li class="card-content"><a href="orders.php" class="w3-hover-opacity">View Orders</a></li>
						<li class="card-content"><a href="comments.php" class="w3-hover-opacity">View Comments</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div class="w3-half">
			<div style="width:150%;margin-left:10%;">
					<?php
						$sql = "SELECT * FROM orders LIMIT 10";
						$result = mysqli_query($conn, $sql);
						$chk = mysqli_num_rows($result);
						$total = 0;
						$output = "";
						if ($chk > 0) {
							while ($row = mysqli_fetch_array($result)) {

								$oid = $row['order_id'];
								$price= $row['product_price'];
								$ord = $row['order_date'];
								$qty = $row['qty'];

								$total = ($price * $qty); 
								$output .='
									<tr>
										<td>'.$row['order_id'].'</td>
										<td>&#8369; '.$total.'</td>
										<td>'.$qty.'</td>
										<td>'.$row['order_date'].'</td>
										<td>'.$row['order_status'].'</td>
									</tr>
								';
							}
						}else{echo"<h4 style='text-align:center;'>There are no Products Available yet.</h4>";}
					?>
					<table class="w3-table-all">
						<tbody>
							<tr>
								<th>Order ID</th>
								<th>Total Price</th>
								<th>Quantity</th>
								<th>Order Date</th>
								<th>Order Status</th>
							</tr>
							<tr>
								<?php echo ''.$output.''; ?>
							</tr>
						</tbody>
					</table>
			</div>
		</div>
	</div>
</div>
</body>
</html>