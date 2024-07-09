<!DOCTYPE html>
<html>
<head>
	<title>E-Voting Site</title>
	<meta charset="utf-8">
	<meta name="author" content="3A4">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="styles/styles.css">
	<link rel="stylesheet" href="styles/bootstrap.css">
	<link rel="icon" href="uploads/favicon.ico">
	<script src="scripts/jquery.min.js"></script>
	<script>
		$(document).ready(function() {

			$("#temporary").fadeOut(3000);

			$("#showBody").show(1100);

			$("#submit-numofelections").on("click", function() {
				var numOfElections = $("#numOfElections").val();

				if (numOfElections < 1) {
					$(".nothing").text("Please select a valid number");
				}else{
					$("#addElections").load("getElections.php",
						{
							theNumber : numOfElections
						});
				}
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
					header("Location: index.php");
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
								echo "</div>";
							}
				}

				if (!isset($_GET['election'])) {
					# code...
					echo "";
				}else{
					if ($_GET['election'] == 'error') {
						# code...
						echo "<p id='temporary'>There was an error adding the elections</p>";
					}else{
						echo "<p id='temporary'>Added the elections</p>";
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
		<li role="presentation" class="active">
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
		<li role="presentation">
			<a href="vote.account.php">Change Password</a>
		</li>
		<li role="presentation">
			<a href="vote.contact.php">Contact</a>
		</li>
	</ul>
	</div>
	</div>
		<div class="row">
			<div id='showBody' style="display: none;">
			<h3>Add Elections</h3><hr>
			<p>Enter the number of elections you wish to add</p>
			<p align="center">
				<input id="numOfElections" type="number" value placeholder="0">
				<br><br>
			</p>
				<button id="submit-numofelections" class="btn btn-info btn-lg pull-right">Next</button>
				<br><br>
				<p id="temporary" class="nothing"></p>
				<div class="row">
					<div class="col-md-12">
						<div id="addElections"></div>	
					</div>
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