<?php
session_start();

include_once 'admin_functions/db_include.php';
	/*if (isset($_SESSION['u_type']) == "user") {
		header("Location: ../main/index.php");
	}
	if (isset($_SESSION['admin_id'])) {
	header("Location: index.php?error_user");
	}else{
	header("Location:");
	}*/

if (isset($_GET['pro'])) {
	$pro = mysqli_real_escape_string($conn, $_GET['pro']);
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
			<a href="admin_functions/db_logout.php?logout">Log out</a>
		</li>
	</ul>
	<h1 id="admin">ADMIN</h1>
</div>
<div class="w3-margin-top w3-padding">
	<div class="w3-row-padding">
		<div>
			<a href="sales.php"><button class="w3-btn w3-green">BACK</button></a>
		</div>
		<div style="width:100%;">
				<?php
					$sql = "SELECT * FROM orders, order_details, users, products WHERE order_details.product_id=products.product_id AND orders.order_id=order_details.order_details_id AND order_details.user_id=users.user_id";
					$res = mysqli_query($conn, $sql);
					$output1="";
					$output2="";
					$output3="";
					$output4="";
					if ($chk = mysqli_num_rows($res) > 0) {
						while ($row = mysqli_fetch_array($res)) {
							$status = $row['order_status'];
							$odid = $row['order_id'];
							$pid = $row['product_id'];
							$price = $row['product_price'];
							$uid = $row['user_id'];

							if ($status == 'ongoing') {
								$output1 .=
								'<form method="POST" action="admin_functions/process.php" enctype="multipart/form-data">
									<tr><td>'.$row['user_first'].' '.$row['user_last'].'</td>
									<td>'.$row['user_email'].'</td>
									<td>'.$row['product_id'].'</td>
									<input type="hidden" name="pid" value='.$row['product_id'].'>
									<td>&#8369; '.$row['product_price'].'</td>
									<input type="hidden" name="price" value='.$row['product_price'].'>
									<td>'.$row['product_cat'].'</td>
									<input type="hidden" name="cat" value='.$row['product_cat'].'>
									<td>'.$row['product_number'].'</td>
									<input type="hidden" name="uid" value='.$row['user_id'].'>
									<td>'.$row['order_date'].'</td>
									<input type="hidden" name="qty" value='.$row['qty'].'>
									<input type="hidden" name="odid" value='.$row['order_id'].'>
									<td><input class="w3-btn w3-green" type="submit" name="pros" value="Process">
									</td><br></tr>
								</form>';	
							}elseif ($status == 'cancelled'){
								$output2 .='
									<tr><td>'.$row['user_first'].' '.$row['user_last'].'</td>
									<td>'.$row['user_email'].'</td>
									<td>'.$row['product_id'].'</td>
									<td>&#8369; '.$row['product_price'].'</td>
									<td>'.$row['product_cat'].'</td>
									<input type="hidden" name="cat" value='.$row['product_cat'].'>
									<td>'.$row['product_number'].'</td>
									<td>'.$row['order_date'].'</td>
									<td class="w3-btn w3-red">CANCELLED</td><br></tr>';
							}elseif ($status == 'delivering'){
								$output3 .='
									<tr><td>'.$row['user_first'].' '.$row['user_last'].'</td>
									<td>'.$row['user_email'].'</td>
									<td>'.$row['product_id'].'</td>
									<td>&#8369; '.$row['product_price'].'</td>
									<td>'.$row['product_cat'].'</td>
									<input type="hidden" name="cat" value='.$row['product_cat'].'>
									<td>'.$row['product_number'].'</td>
									<td>'.$row['order_date'].'</td>
									<td class="w3-btn w3-green">PROCESSING</td><br></tr>';
							}elseif ($status == 'delivered'){
								$output4 .='
									<tr><td>'.$row['user_first'].' '.$row['user_last'].'</td>
									<td>'.$row['user_email'].'</td>
									<td>'.$row['product_id'].'</td>
									<td>&#8369; '.$row['product_price'].'</td>
									<td>'.$row['product_cat'].'</td>
									<input type="hidden" name="cat" value='.$row['product_cat'].'>
									<td>'.$row['product_number'].'</td>
									<td>'.$row['order_date'].'</td>
									<td class="w3-btn w3-green">DELIVERED</td><br></tr>';
							}
						}
					}
				?>
				<table class="w3-table-all" style="margin-top:10px;">
		            <tbody>
		                <tr>
							<th>Name</th>
							<th>Email</th>
							<th>Product ID</th>
							<th>Product Price</th>
							<th>Product Category</th>
							<th>Product Number</th>
							<th>Order Date</th>
							<th>Action</th>
		                </tr>
		                </tr>
		                    <?php
		                        echo ''.$output1.'';
		                        echo ''.$output2.'';                   
		                        echo ''.$output3.'';                    
		                        echo ''.$output4.'';
		                     ?>
		                </tr>
		            </tbody>
		        </table>
		</div>
	</div>
</div>
</body>
</html>