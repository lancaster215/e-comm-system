<?php
include_once('manager_functions/db_include.php');
	if (isset($_SESSION['u_type']) == "user") {
		header("Location: ../main/index.php");
	}
	if (isset($_SESSION['u_id'])) {
	header("Location: index.php?error_user");
	}else{
	header("Location:");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manager</title>
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
			<a class="w3-btn w3-red" href="manager_functions/db_logout.php?logout">Log out</a>
		</li>
	</ul>
	<h1 id="admin">TRANSACTION MANAGER</h1>
</div>
<div class="w3-margin-top w3-padding">
	<div class="w3-row-padding">
		<div class="w3-half" style="margin-left:10%;margin-top:5%;">
			<div style="margin-left:5%;width:150%;">
				<?php
					$msg = 'Product has been Received!';
					$msg1 = 'Product Successfully Sent to Courier!';
					$msg2 = 'Product has been Cancelled!';
					$sql = "SELECT * FROM orders, order_details, products, users WHERE orders.user_id=users.user_id AND orders.product_id=products.product_id AND order_details.order_details_id=orders.order_id AND bought = 1 AND orders.order_status='delivering'";
					$res = mysqli_query($conn, $sql);
					$output1 = "";
					$output2 = "";
					$output3 = "";
					$output4 = "";
					if ($chk = mysqli_num_rows($res) > 0) {
							while ($row = mysqli_fetch_array($res)) {
							$status = $row['order_status'];
							$num = $row['product_number'];
							$img = $row['product_image'];
							$trans_status = $row['trans_mngr_status'];
							$cor_status = $row['courier_status'];
							
							if ($status == 'cancelled'){
								$output1 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center>'.$msg2.'</center></td>
										</tr>';
							}elseif($trans_status == 'sent'){
								$output2 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center>'.$msg1.'</center></td>
										</tr>';
							}elseif ($trans_status == 'received') {
								$output3 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center>'.$msg.'<br><a href="manager_functions/send.php?send='.$row['user_id'].'"><button class="w3-btn w3-green">Send to Courier</button></a></center></td>
										</tr>';
							}elseif ($status == 'delivering') {
								$output4 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center><a href="manager_functions/receive.php?receive='.$row['user_id'].'"><button class="w3-btn w3-green">Receive Product</button></a></center></td>
										</tr>';
							}
						}
				}elseif ($chk == 1){
						if($row = mysqli_fetch_array($res)) {
							$status = $row['order_status'];
							$num = $row['product_number'];
							$img = $row['product_image'];
							$trans_status = $row['trans_mngr_status'];
							$cor_status = $row['courier_status'];
							
							if ($status == 'cancelled'){
								$output1 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center>'.$msg2.'</center></td>
										</tr>';
							}elseif($trans_status == 'sent'){
								$output2 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center>'.$msg1.'</center></td>
										</tr>';
							}elseif ($trans_status == 'received') {
								$output3 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center>'.$msg.'<br><a href="manager_functions/send.php?send='.$row['user_id'].'"><button class="w3-btn w3-green">Send to Courier</button></a></center></td>
										</tr>';
							}elseif ($status == 'delivering') {
								$output4 .= '
										<tr>
											<td><center><img width="150px" height="150px" src="../warehouse/product_images/'.$img.'"></center></td>
											<td><center>'.$num.'</center></td>
											<td><center><a href="manager_functions/receive.php?receive='.$row['user_id'].'"><button class="w3-btn w3-green">Receive Product</button></a></center></td>
										</tr>';
							}
						}
					}else{echo"<h4 style='text-align:center;margin-top:-50px;'>There are no Products Available yet.</h4>";}
				?>
				<table class="w3-table-all">
		            <tbody>
		                <tr>
							<th><center>Product Image</center></th>
							<th><center>Product Number</center></th>
							<th><center>Action</center></th>
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
</div>
</body>
</html>