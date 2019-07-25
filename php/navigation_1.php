<nav>
	<div class="nav">
		<ul class="w3-navbar">
			<li id="left-content">
				<li class="w3-dropdown-hover">
					<a href="" id="settings"><i class="fa fa-cogs"></i></a>
					<div class="w3-dropdown-content w3-white w3-card-4" style="margin-top:38px;">
						<a href="settings.php"> Settings</a>
						<a href="contacts.php">Contacts</a>
						<?php 
							if (isset($_SESSION['u_id'])) {
								echo '<form action="../php/includes/db_logout.php" method="POST">
										<button type="submit" name="submit" class="logout"><i class="fa fa-power-off fa-la"></i> Logout</button>
									</form>';
							}else{
								echo '<button onclick="document.getElementById('.'\'login\''.').style.display='.'\'block\''.'" class="login">Log-in</button>
										<form id="login" class="w3-modal" action=../php/includes/db_login.php" method="POST">
											<div class="w3-modal-content w3-card-8 w3-animate-top" style="max-width:600px">
												<div class="w3-container">
													<div class="w3-section">
														<label><b>Username</b></label>
															<input class="w3-input w3-border w3-margin-bottom" type="text" name="uid" placeholder="Enter Username">
														<label><b>Password</b></label>
															<input class="w3-input w3-border w3-margin-bottm" type="password" name="pass" placeholder="Enter Password">
															<br>
														<button class="w3-btn w3-btn-block w3-green w3-section" type="submit" name="submit">Log-in</button>
													</div>
												</div>
												<div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
													<button onclick="document.getElementById('.'\'login\''.').style.display='.'\'none\''.'" type="button" class="w3-btn w3-red" style="float:left;">Cancel</button>
												</div>
											</div>
										</form>';	
							}
						?>
					</div>
				</li>
				<li>
					<?php
						if (isset($_SESSION['u_id'])){
							$first = $_SESSION['u_first'];
							$last = $_SESSION['u_last'];
							echo "<p class='name'>$first $last |</p";
						}
					?>					
				</li>
			</li>
			<li class="mid-content">
				<h1>greyscaled</h1>
			</li>
			<li class="right-content" style="float: right;">
				<ul>
					<!--<li id="toggle" onclick="w3_open()">&#9776;</li>-->
					<li><a href="home.php" style="border-bottom:none;"><i class="fa fa-home fa-fw"></i>Home</a></li>
					<li class="w3-dropdown-hover">
						<a href="../main/portfolio_m.php"><i class="fa fa-folder"></i> Portfolio&dtrif;</a>
						<div class="w3-dropdown-content w3-white w3-card-4">
							<a href="../main/portfolio_m.php" class="scroll">Gentlemen Wear</a>
							<a href="../main/portfolio_w.php" class="scroll">Ladies Wear</a>
							<a href="../main/orders.php">View Orders</a>
							<a href="../main/invoice.php">Invoice</a>
						</div>
					</li>
					<li class="w3-dropdown-hover">
						<a href="../main/new_arrivals.php">&#8369;Prices&dtrif;</a>
						<div class="w3-dropdown-content w3-white w3-card-4">
							<a href="../main/new_arrivals.php" class="scroll">New Arrivals</a>
							<a href="../main/trends.php" class="scroll">Trends</a>
							<a href="../main/limited.php" class="scroll">Limited</a>
						</div>
					</li>
					<li>
						<a href="about.php" class="scroll" id="questions"><i class="fa fa-question-circle-o"></i></a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</nav>