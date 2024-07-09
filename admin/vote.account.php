<?php include_once 'includes/database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>E-Voting Site</title>
	<meta charset="utf-8">
	<meta name="author" content="Ashraf Abdul-Muumin">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<link rel="icon" href="uploads/favicon.ico">
	<script src="scripts/jquery.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#temporary").fadeOut(3000);
			$("#showBody").show(1100);

			$("#new-password").on("input", function() {
				$("#show-hide").show();
			});


		});
	</script>
</head>
<body>
<div class="jumbotron">
	<div class="container">
			<?php 
				session_start();
				if (!isset($_SESSION['id'])) {
					echo "";
				}else{
					echo "<h1 align='center'>".$_SESSION['id']."</p>";
					if(!isset($_SESSION['id'])) {
					header("Location: index.php");
					exit();
						} else {
								echo "<div align='center'>";
								echo "<form action='includes/signout.inc.php' method='POST'>";
								echo "<button type='submit' class='btn btn-warning btn-lg' name='really'>Signout</button>";
								echo "</form>";
								echo "</div><br>";
							}
				}

				echo '<script src="scripts/getTime.js"></script>';
				echo "<div class='row'>
						<div class='col-md-12'>
							<p id='theClock'></p><br>
						</div>
						</div>";

			?>
		</div>
	</div>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<ul class="nav nav-pills">
		<li role="presentation">
			<a href="main.php">Main</a>
		</li>
		<li role="presentation">
			<a href="vote.elect.php">Add Elections</a>
		</li>
		<li role="presentation">
			<a href="vote.pose.php">Manage Positions & Elections</a>
		</li>
		<li role="presentation">
			<a href="vote.cand.php">Add Candidates</a>
		</li>
		<li role="presentation">
			<a href="vote.cand.setup.php">Manage Candidates</a>
		</li>
		<li role="presentation">
			<a href="vote.settings.php">Voters</a>
		</li>
		<li role="presentation" class="active">
			<a href="vote.account.php">Change Password</a>
		</li>
		<li role="presentation">
			<a href="vote.contact.php">Contact</a>
		</li>
	</ul>
</div>
</div>
<div id="showBody" style="display: none;">
<div class="row">
	<div class="col-md-12">
		<div id='confirm-Div' style="margin-top:30px;display: none;">
		</div>
	</div>
</div>
	<div class="row">
	<div class="col-md-12">
		<h3>Change Admin password</h3><hr>
		<form action='confirm.php' method="POST">
			<input type="text" name="old-password" value placeholder="Old Password">
			<br>
			<input type="password" id="new-password" name="new-password" value placeholder="New Password">
			<br>
			<input type="password" id="cnew-password" name="cnew-password" value placeholder="Re-type New Password">
			<br><br>
			<button type="submit" name='submit-passwords' class="btn btn-info btn-lg pull-right">Change password</button>
			<br><br><br>
		</form>
	</div>
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
