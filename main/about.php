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
	<title>About</title>
</head>
<link rel="stylesheet" type="text/css" href="../css/style.css">
<link rel="stylesheet" type="text/css" href="../css/w3.css">
<link rel="stylesheet" type="text/css" href="../fonts/font-awesome-4.7.0/css/font-awesome.css">
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<body>
<?php include_once "../php/navigation_1.php";?>
<div class="w3-row-padding" style="padding-top:55px;margin-left:10%;margin-right:10%;">
	<table>
		<tr>
			<td style="width:110px;"><h1>About</h1></td>
		</tr>
		<tr>
			<td><h4><p>Greyscaled&copy; is a E-commerce website where you can search your most worn OOTD(Outfit Of The Day) for Men and Women. This website lets you choose your best desired outfit for any celebration, occasion, or just a regular day. You can buy item/s here with no hassle. Just sign-up <a href="index.php" style="text-decoration:underline;color:green;">here</a> and every product that are to be posted will be available to you.</p><h4></td>
		</tr>
		<tr>
			<td><h4><p>For product Integrity, here are the <a href="" style="text-decoration:underline;color:green;">reviews of the products</a>. This products available on our webseite are 100% checked by the Administrator of this website and ensures that the product are new and has the highest quality among other products.</p></h4></td>
		</tr>
		<tr>
			<td><h1>FAQ</h1></td>
		</tr>
		<tr>
			<td><b><h3><u>When can I cancel my orders?</u></h3></b></td>
		</tr>
		<tr>
			<td><h4>ANSWER: Products can still be cancelled until the order status is 'delivering'. But in the process of the product/s, once the courier received your product/s, the product/s can no longer be cancelled.</h4></td>
		</tr>
		<tr>
			<td><b><h3><u>I have nothing in the cart but still I can checkout.</u></h3></b></td>
		</tr>
		<tr>
			<td><h4>ANSWER: Bug fixed! If your cart is empty, you cannot clicked the next button bucause it becomes disabled.</h4></td>
		</tr>
		<tr>
			<td><b><h3><u>What is Invoice?</u></h3></b></td>
		</tr>
		<tr>
			<td><h4>ANSWER: Invoice can be considered as official receipt except that if you view your invoice, we still consider to view the on-sale item/s. It means that the item/s is added to cart but your still not checked out hence the item/s is still available. But see the subtotal amount where it only computes all considered status except 'on-sale'. It means that if the product/s is/are still 'on-sale', it will be viewed in the invoice but is/are not computed in the subtotal.</h4></td>
		</tr>
	</table>
</div>
<?php include_once"../php/footer_1.php";?>
</body>
</html>