<?php include 'includes/database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>E-Voting Site | Student</title>
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
				// body...
				$("#temporary").fadeOut(3000);
			});
		</script>
		<style type="text/css">
			input {
				width: 65% !important;
			}
		</style>
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>E-Voting | <span style="font-size: 30px !important;">Student</span></h1>
				<?php

				session_start();

				if (!isset($_SESSION['studentId'])) {
					# code...
					echo "";
				}else {
					echo "<p class='lead'>Currently logged in as user <b>".$_SESSION['studentId']."</b></p>";
					echo "<p class='lead'>Go to your <a href='vote.php'>voting page</a></p>";
					include 'includes/signout-form.inc.php';
					echo "<br>";
				}

				if (!isset($_GET['student'])) {
					# code...
					echo "";
				}else{
					echo "<p id='temporary'>The student does not exist</p>";
				}
					
				?>
				<script src="scripts/getTime.js"></script>
				<p id="theClock"></p>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="formWrapper">
						<h2>Student Login</h2>
						<hr>
						<div id="formWrapper">
						<?php

							if (!isset($_SESSION['id'])) {
								# code...
								if (!isset($_SESSION['studentId'])) {
									# code...
									echo '<form action="includes/votersignin.inc.php" method="POST">';
									echo '<input type="password" name="studentId" value placeholder="Student ID">';
									echo '<br><br>';
									echo '<button type="submit" name="signin-student" class="btn btn-primary btn-lg pull-right">Login</button>';
									echo '</form>';

								} elseif(isset($_SESSION['studentId'])) {
									echo "<p class='lead well'>Currently logged in</p>";
								} else {
									session_unset();
									session_destroy();
								}
							}else{
								echo "<p class='well center-block lead'>You cannot log in while you are the admin. Please signout</p>";
							}	
						?>
						</div>
					</div>
				</div>
			</div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<div class="row">
				<div class="col-md-12">
					<p class="center-block" align="center">
					<?php
						if (!isset($_SESSION['id'])) {
							# code...
							echo '<a href="admin/index.php" class="btn btn-default btn-lg">Admin login</a>';
						}else{
							include 'includes/signout-form.inc.php';
						}
					?>
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