<?php
include_once('../php/includes/db_include.php');
session_start();

if (!isset($_SESSION['u_id'])) {
	header("Location: home.php?error_user");
}else{
	header("Location:");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Greyscaled</title>
</head>
<body>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<?php 
include_once "../php/navigation_1.php";
?>
<div class="w3-row-padding" style="padding-top:55px;">
	<table style="padding:10px;">
		<tr>
			<td>
				<?php
					$uid = $_SESSION['u_id'];
					$sql = "SELECT COUNT(cart_id) AS num FROM cart WHERE user_id = $uid";
					$sql1 = "SELECT * FROM cart WHERE user_id = $uid";
					$run = mysqli_query($conn, $sql);
					$run1 = mysqli_query($conn, $sql1);
					$chk = mysqli_num_rows($run);
					if ($chk>0) {
						while ($row = mysqli_fetch_array($run)) {
							$num = $row['num'];
							if ($num == 1 || 0) {
								echo'<h5 class="w3-container w3-green w3-card-8" style="margin-left:1%;width:15%;border-radius:10px;"><i class="fa fa-shopping-cart"></i> Cart: '.$row['num'].' piece</h5>';
							}else{
								echo'<h5 class="w3-container w3-green w3-card-8" style="margin-left:1%;width:15%;border-radius:10px;"><i class="fa fa-shopping-cart"></i> Cart: '.$row['num'].' pieces</h5>';
							}
						}
					}
				?>
			</td>
			<td style="width:50px;">
				<button class="w3-btn w3-grey"><a href="approve.php"><i class="fa fa-share-square-o"></i> Checkout</a></button>
			</td>
		</tr>
	</table>
				<?php
					$sql = "SELECT * FROM products ORDER BY product_id DESC";
					$result = mysqli_query($conn, $sql);
					$chk = mysqli_num_rows($result);
					if ($chk > 0) {
						while($row = mysqli_fetch_array($result)){ //in the img1, closebtn must be incremented to set the closebtn value to its own container only
							$image = $row['product_image'];
							$text = $row['product_def'];
							$price = $row['product_price'];
							$cat = $row['product_cat'];
							$id = (int)$row['product_id'];
							$mw = $row['product_mw'];
							$num = $row['product_number'];
							if ($mw == 1) {
								echo "<div class='w3-quarter'>";
								echo "<div class='w3-card-2' style='display:block'>";
								echo "<img width='325' height='350px' src='../warehouse/product_images/$image'>";
								echo '<div class="w3-container">
									<button onclick="document.getElementById('.$row['product_id'].').style.display='.'\'block\''.'" class="w3-btn w3-green w3-large" style="margin:10px;margin-left:25%;">View Item</button>
								</div>';
								if ($id > 0) {
									echo '
									<div id="'.$row['product_id'].'" class="w3-modal">
										<div class="w3-modal-content w3-card-8 w3-animate-zoom" style="max-width:1000px;margin-top:-40px;margin-bottom: 20px;">
											<div class="w3-half">
												<span onclick="document.getElementById('.$row['product_id'].').style.display='.'\'none\''.'" class="w3-hover-red w3-closebtn w3-display-topright w3-xxlarge" style="margin-right:20px;color:black;">&times;</span>
										  		<img width="500" height="451px" src="../warehouse/product_images/'.$row['product_image'].'">
											</div>
											<div class="w3-half w3-container" style="background-color:white;height:451px;">
												<div>
													<h5>Number: <b>'.$row['product_number'].'</b></h5>
													<h5>Price: <b>P'.$row['product_price'].'</b></h5>
													<h5>Category: <b>'.$row['product_cat'].'</b></h5>
													<h5>Item Difinition: <b>'.$row['product_def'].'</b></h5>';
								echo "				<form method='POST' action='main_functions/add_to_cart.php'>
														<input type='hidden' name='num' value='$num'>
														<input type='hidden' name='price' value='$price'>
														<input type='hidden' name='pid' value='$id'>
														<input type='hidden' name='cat' value='$cat'>
														<input type='number' name='quantity' value='1' min='1' max='5'/>
														<input type='submit' name='add' class='w3-btn w3-green' value='Add to Cart'> <i class='fa fa-shopping-cart'></i><br><br>
													</form>
													<form method='POST' action='reviews.php?prod=$id'>
														<input name='submit' class='w3-btn w3-green' value='View Comments' type='submit'>
													</form>";
								echo "			</div>
											</div>
										</div>
									</div>";
								echo "</div><br>";
								echo "</div>";
								}
							}
						}
					}
				?>
</div>
<?php 
	include_once "../php/footer_1.php";
?>
</body>
</html>
