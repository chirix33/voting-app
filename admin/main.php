<?php 
include_once 'includes/database.inc.php'; 
session_start(); 
$electionStarted = false; 
?>
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
			$("#showBody").show(1100);

			$("#startSession").click(function() {
				$("#chooseElection").fadeToggle(2000);

			});

			$("#stopSession").click(function() {
				$("#stopElection").fadeToggle(1000);
			});

			$("#hider").fadeOut(4000);
		});
	</script>
</head>
<body>
	<div class="jumbotron">
		<div class="container">
			<?php
				if (!isset($_SESSION['id'])) {
					header("Location: index.php");
					exit();
				}else{
					echo "<h1>Logged in | <span style='font-size: 35px !important;'>".$_SESSION['id']."</span></h1>";
					echo "<div align='center'>";
					echo "<form action='includes/signout.inc.php' method='POST'>";
					echo "<button type='submit' class='btn btn-warning btn-lg' name='really'>Signout</button>";
					echo "</form>";
					echo "</div>";
				}

				include_once 'checkSession.php';
	
			?>
			<script src="scripts/getTime.js"></script>
			<p id="theClock"></p><br>
		</div>
	</div>
	<div class="container">
	<div class="row">
	<div class="col-md-12">
	<ul class="nav nav-pills">
		<li role="presentation" class="active">
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
		<div id="showBody" style="display: none;">
			<div class="col-md-12">
				<br><br>
				<?php
					$checkForSession = "SELECT * FROM elections WHERE session = 1";
					$queryIt = mysqli_query($conn, $checkForSession);

					if (mysqli_num_rows($queryIt) < 1) {
						echo '<p align="center"><button id="startSession" class="btn btn-default btn-lg center-block">Start Voting Session</button></p>';
					} else {
						echo "<table class='table'>";
						echo "<tr>";
						echo "<td class='pull-left'><button id='startSession' class='btn btn-lg center-block'>Start Voting Session</button></td>";
						echo "<td class='pull-right'><button id='stopSession' class='btn btn-lg center-block'>Stop Voting Session</button></td>";
						echo '</tr>';
						echo "</table>";
					}
				?>
				<br>

				<div id="chooseElection" style="display: none;">
					<?php
						$electionSQL = "SELECT * FROM elections";
						$electionQuery = mysqli_query($conn, $electionSQL);
						$electionNum = mysqli_num_rows($electionQuery);

						if ($electionNum < 1) {
							# code...
							echo "<p class='lead'>There aren't any elections. You can <a href='vote.elect.php'>add one</a></p>";
						}else{
							echo "<p align='center'>";
							echo "<form action='' method='POST'>";
							echo "<select name='startElection' class='selectStyled'>";
							echo "<option value='default'>Choose an Election</option>";
							while ($eachElection = mysqli_fetch_assoc($electionQuery)) {
								echo "<option value='".$eachElection['name']."'>".$eachElection['name']."</option>";
								echo "</option>";
							}
							echo "</select></p>";
							echo "<button type='submit' name='startSession' class='btn btn-success btn-lg pull-right'>Start session</button>";
							echo "</form>";
							echo "<br><br>";
						}

					?>
				</div>

				<div id="stopElection" style="display: none;">
					<?php
						$stopSQL = "SELECT * FROM elections WHERE session = 1";
						$stopQuery = mysqli_query($conn, $stopSQL);
						$stopelectionNum = mysqli_num_rows($stopQuery);

						if ($stopelectionNum < 1) {
							# code...
							echo "<p>There are no elections avalailable</p>";
						}else{
							echo "<p align='center'>";
							echo "<form action='' method='POST'>";
							echo "<select name='stopElection' class='selectStyled'>";
							echo "<option value='default'>Choose an Election</option>";
							while ($stopeachElection = mysqli_fetch_assoc($stopQuery)) {
								echo "<option value='".$stopeachElection['name']."'>".$stopeachElection['name']."</option>";
								echo "</option>";
							}
							echo "</select></p>";
							echo "<button type='submit' name='stopSession' class='btn btn-default btn-lg pull-right'>Stop session</button>";
							echo "</form>";
							echo "<br><br>";
						}

					?>
				</div>
				
				<?php include 'includes/statistics.inc.php'; ?>

				<?php include 'includes/overallVotes.inc.php'; ?>

				<br>

				<hr>
				<p align="center">
				<?php
					if ($electionStarted) {
						echo '<a target="_tab" href="genReport.php" class="btn btn-lg" style="background-color: #2f4f4f;color: #fff;">Generate report</a>';
					}

				?>
				</p>
					<h3>General Overview</h3><hr>
					<blockquote>
							<p style="font-size: 18px;">
						To start a fresh new election, go to the <a href="vote.elect.php">Add Elections</a> tab.
					</p>
					<p style='font-size: 18px;'>
						To setup the <u>positions</u> under their respective elections, go to the <a href="vote.pose.php">Manage positions & Elections</a> tab.
					</p>
					<p  style='font-size: 18px;'>
						For the adding up of the <u>candidates</u>, head to the <a href="vote.cand.php">Add Candidates</a> tab.  
					</p>
					<p  style='font-size: 18px;'>
						Go to <a href="vote.cand.setup.php">Manage Candidates</a> tab to setup the candidates.
					</p>
					<p style='font-size: 18px;'>
						Students you wish to add to allow them to vote can be managed at the <a href="vote.settings.php">Voters</a> tab.
					</p>
					<p style='font-size: 18px;'>
						It is highly recommended to change <b>admin</b>'s  password at the <a href="vote.account.php">Change Password</a> tab before conducting an election.
					</p>
					</blockquote>
				<br><br>

				<h3>Current Elections</h3><hr>
			<?php
				$electSQL = "SELECT * FROM elections";
				$electQuery = mysqli_query($conn, $electSQL);

				if (mysqli_num_rows($electQuery) < 1) {
					# code...
					echo "<p class='lead'>There are no elections currently</p>";
				}else{

					echo "<blockquote>";
					while ($election = mysqli_fetch_assoc($electQuery)) {
							echo "<p><b>".$election['name']."</b></p>";
						}
					echo "</blockquote><br><br>";

				}	
			?>
				<br><br>
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
