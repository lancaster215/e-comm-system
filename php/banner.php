<nav>
	<div id="banner">
		<div id="caption">
			<em><h1 style="color: #212a34;">Fashion speaks for yourself</h1></em>
			<?php
			if (isset($_SESSION['u_id'])) {
				
			}else{
				echo '<button class="w3-btn w3-green"><a href="index.php">Sign-Up</a></button>';
			}
			?>
		</div>
	</div>
</nav>
<script src="../js/script.js"></script>
<script src="../js/jquery-3.2.1.min.js"></script>