<?php include_once 'includes/database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>E-Voting System</title>
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

			$("#proceedElection").click(function() {
				var theElection = $("#selectElection").val();
				$("#showPositions").load("showPositions.cand.setup.php",
					{
						ChosenElection: theElection
					}).hide().fadeIn(1500);
				$("#proceedElection").hide(1500);
			});

			$("#proceedDelElection").click(function() {
				var theElection = $("#selectdelElection").val();
				$("#showPositionsDel").load("showPositionsdel.cand.setup.php",
					{
						ChosenElection: theElection
					}).hide().fadeIn(1500);
				$("#proceedDelElection").hide(1500);
			});

			$("#proceedRenElection").click(function() {
				var theElection = $("#selectrenElection").val();
				$("#showPositionsRen").load("showPositionsren.cand.setup.php",
					{
						ChosenElection: theElection
					}).hide().fadeIn(1500);
				$("#proceedRenElection").hide(1500);
			});
		});
	</script>
	<style>
		.left {
			margin-left: 10px;
		}
	</style>
	<script>
		
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

				if (!isset($_GET['delete'])) {
					# code...
					echo "";
				}elseif ($_GET['delete'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error deleting the candidate</p>";
				}else{
					echo "<p id='temporary'>Candidate deleted</p>";
				}

				if (!isset($_GET['rename'])) {
					# code...
					echo "";
				}elseif ($_GET['rename'] == 'same') {
					# code...
					echo "<p id='temporary'>The names are the same</p>";
				}elseif ($_GET['rename'] == 'empty') {
					# code...
					echo "<p id='temporary'>Please enter the new name</p>";
				}elseif ($_GET['rename'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error. Please try again</p>";
				}else {
					# code...
					echo "<p id='temporary'>Name changed successfully</p>";
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
		<div id="outerWrapper">
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
		<li role="presentation" class="active">
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
	</div>
	<div id="showBody" style="display: none;">
	<h2 align="center">Add & View Profiles</h2>
		<h3>(1) <span class="lead">Choose Election</span></h3><hr>
		<?php
			$sql = "SELECT * FROM elections";
			$query = mysqli_query($conn, $sql);
			if (mysqli_num_rows($query) <= 0) {
				# code...
				echo "<p style='font-size: 16px;'>There are no elections availabe. You can start <a href='vote.elect.php'>adding elections</a></p>";
			}else{
				echo "<select id='selectElection' class='selectStyled'>";
				echo "<option value='default'>Choose an election</option>";
				while ($eachElection = mysqli_fetch_assoc($query)) {
					# code...
					echo "<option value='".$eachElection['name']."'>".$eachElection['name']."</option>";
				}
				echo "</select>";
				echo "<br><br>";
				echo "<button id='proceedElection' class='btn btn-default btn-lg pull-right'>Next</button>";
				echo "<br><br>";
			}
		?>
		<div class="col-md-12">
			<div id="showPositions">
			</div>
		</div>
		<h2 align="center">Delete Candidates</h2>
		<h3>(1) <span class="lead">Choose Election</span></h3><hr>
		<?php
			$delSQL = "SELECT * FROM elections";
			$delQuery = mysqli_query($conn, $delSQL);
			if (mysqli_num_rows($delQuery) <= 0) {
				# code...
				echo "<p style='font-size: 16px;'>There are no elections availabe. You can start <a href='vote.elect.php'>adding elections</a></p>";
			}else{
				echo "<select id='selectdelElection' class='selectStyled'>";
				echo "<option value='default'>Choose an election</option>";
				while ($eachdelElection = mysqli_fetch_assoc($delQuery)) {
					# code...
					echo "<option value='".$eachdelElection['name']."'>".$eachdelElection['name']."</option>";
				}
				echo "</select>";
				echo "<br><br>";
				echo "<button id='proceedDelElection' class='btn btn-default btn-lg pull-right'>Next</button>";
				echo "<br><br>";
			}
		?>
		<div class="col-md-12">
			<div id="showPositionsDel"></div>
		</div>
		<h2 align="center">Rename Candidates</h2>
		<h3>(1) <span class="lead">Choose Election</span></h3><hr>
		<?php
			$renSQL = "SELECT * FROM elections";
			$renQuery = mysqli_query($conn, $renSQL);
			if (mysqli_num_rows($renQuery) <= 0) {
				# code...
				echo "<p style='font-size: 16px;'>There are no elections availabe. You can start <a href='vote.elect.php'>adding elections</a></p>";
			}else{
				echo "<select id='selectrenElection' class='selectStyled'>";
				echo "<option value='default'>Choose an election</option>";
				while ($eachrenElection = mysqli_fetch_assoc($renQuery)) {
					# code...
					echo "<option value='".$eachrenElection['name']."'>".$eachrenElection['name']."</option>";
				}
				echo "</select>";
				echo "<br><br>";
				echo "<button id='proceedRenElection' class='btn btn-default btn-lg pull-right'>Next</button>";
				echo "<br><br>";
			}
		?>
		<div class="col-md-12">
			<div id="showPositionsRen"></div>
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