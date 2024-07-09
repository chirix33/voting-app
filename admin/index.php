<?php include 'includes/database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>E-Voting Site | Admin</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="author" content="3A4">
		<meta name="description" content="SRC voting">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.css"> 
		<link rel="icon" href="uploads/favicon.ico">
		<script src="scripts/myScript.js"></script>
		<script src="scripts/jquery.min.js"></script>
		<script>
			$(document).ready(function() {
				$("#temporary").fadeOut(3000);
			});
		</script>
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>E-Voting | <span style="font-size: 30px !important;">Admin</span></h1>
				<?php 
				session_start();
				if (!isset($_SESSION['id'])) {
					echo "";
				}else{
					echo "<p class='lead success'>You are currently logged in as the <u>".$_SESSION['id']."</u></p>";
					echo "<p>Go to the <a href='main.php'>Dashboard</a></p>";
				}

				if (!isset($_GET['signin'])) {
					# code...
					echo "";
				}elseif ($_GET['signin'] == "password") {
					# code...
					echo "<p id='temporary'>The password is wrong</p>";
				}elseif($_GET['signin'] == "empty") {
					echo "<p id='temporary'>Please fill in the password!</p>";
				}else{
					echo "<p id='temporary'>There was an error. Please try again</p>";
				}
			?>
				<script src="scripts/getTime.js"></script>
				<p id="theClock"></p><br>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="formWrapper">
						<?php
							if (!isset($_SESSION['id'])) {
								echo '<h2>Admin Signin</h2>
								<hr>
								<form action="includes/signin.inc.php" method="POST">
								<fieldset>
									<input type="text" name="admin_userid" value="Admin" disabled="">
									<input type="password" name="admin_pwd" placeholder="Password">
								</fieldset>
								<br>
								<button type="submit" name="adminsginin-button" class="btn btn-primary btn-lg pull-right">
									Signin
								</button>
								</form>';
							} else {
								echo "<br><br>";
								echo "<p align='center'><a href='main.php' class='btn btn-default btn-lg'>Go to your Dashboard</a></p>";
							}
						?>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
			<hr>
				<div class="col-md-12">
					<p class="center-block" align="center">
						<a href="../index.php" class="btn btn-default btn-lg">Student login</a>
					</p>
				</div>
			</div>
		</div>
		<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php include 'includes/footer.inc.php'; ?>
		</div>
	</div>
</div>
	</body>
</html>