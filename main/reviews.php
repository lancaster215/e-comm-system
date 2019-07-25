<?php
session_start();
include_once '../php/includes/db_include.php';

if (isset($_GET['prod'])) {
		$prod_id = (int)mysqli_real_escape_string($conn,$_GET['prod']);
		$sql = "SELECT * FROM comments WHERE product_id=$prod_id ORDER BY comment_time DESC";
		$res = mysqli_query($conn, $sql);
		$checks = mysqli_num_rows($res);
} else {
	header("Location: portfolio_m.php");
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
								echo' <h5><i class="fa fa-shopping-cart"></i> Cart: '.$row['num'].' piece</h5>';
							}else{
								echo' <h5><i class="fa fa-shopping-cart"></i> Cart: '.$row['num'].' pieces</h5>';
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
					$prod_id = (int)mysqli_real_escape_string($conn,$_GET['prod']);
					$sql = "SELECT * FROM products WHERE product_id='$prod_id'";
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
							
							echo "<div class='w3-quarter'>";
							echo "<div class='w3-card-2' style='display:block'>";
							echo "<img width='325' height='350px' src='../warehouse/product_images/$image'>";
							echo "<form style='margin:10px;' method='POST' action='main_functions/add_to_cart.php'>
									<input type='hidden' name='pid' value='$id'>
									<input type='number' name='quantity' value='1' min='1' max='5'/>
									<input type='submit' name='add' class='w3-btn w3-green' value='Add to Cart'> <br><br>
								</form>";
							echo "</div>
							</div>";
						}
					}
				?>
	<div class="comment-box">
		<div class="w3-card-4 reviews">
			<h4>Write a comment</h4>
			<form method="POST" action="main_functions/comment.php">
			<?php echo "<input type='hidden' name='p_id' value='$prod_id'  >
				<textarea class='upload-text' placeholder=' Say something about this product...' name='des' cols='105' rows='4' maxlength='250' required></textarea>
				<br>
				<input type='submit' name='comment' value='Comment' class='w3-btn w3-green'>";
			?>
			</form>
			<?php
				if ($checks > 0) {
					while ($row = mysqli_fetch_array($res)) {
						$sql1 = "SELECT user_id, user_first, user_last FROM users WHERE user_id = $row[user_id]";
						$result = mysqli_query($conn, $sql1);
						$check = mysqli_fetch_array($result);
						if ($check > 0) {
							echo "<div id='commented'>
								<div class='w3-content' id='right-bar'>
									<hr>
									<a href='portfolio_m.php?id=$check[user_id]'><p class='namess'>$check[user_first] $check[user_last] :</p></a>
									<p>$row[product_comm]</p>
								</div>
							</div>";
						}
					}
					echo"<hr>";
				}else{
					echo "<h3 style='color:grey;margin-left:36%;'>Start the conversation.</h3>";
				}
			?>
		</div>
	</div>
</div>
<?php 
	include_once "../php/footer_1.php";
?>
</body>
</html>