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

			$("#selectElectionBtn").click(function() {
				if ($("#selectElection").val() == 'default') {
					var election = 'false';
				}else
					var election = $("#selectElection").val();
					$("#managePositions").load("managePositions.php", 
					{
						Election : election
					});
				
			});

			$("#deletePositionBtn").click(function() {
				var theElection = $("#deletePosition").val();
				$("#delPose").load("delPose.php",
					{
						electionDelete: theElection
					});
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

				if (!isset($_GET['position'])) {
					# code...
					echo "";
				}elseif ($_GET['position'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error while adding the positions</p>";
				}else {
					# code...
					echo "<p id='temporary'>Success adding the positions</p>";
				}

				if (!isset($_GET['deleteEl'])) {
					# code...
					echo "";
				}elseif ($_GET['deleteEl'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error deleting the election</p>";
				}else{
					echo "<p id='temporary'>Election deleted successfully</p>";
				}

				if (!isset($_GET['delpose'])) {
					# code...
					echo "";
				}elseif ($_GET['delpose'] == 'error') {
					# code...
					echo "<p id='temporary'>There was an error deleting the position</p>";
				}else{
					echo "<p id='temporary'>Position deleted</p>";
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
		<li role="presentation" class="active">
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
		<div class="col-md-12">
			<div id="showBody" style="display: none;">
				<h3>Choose an election</h3><hr>
				<?php
					$elections = "SELECT * FROM elections";
					$electionsQuery = mysqli_query($conn, $elections);

					if (mysqli_num_rows($electionsQuery) < 1) {
						# code...
						echo "<p>There are no elections currently. You can add elections <a href='vote.elect.php'>here</a></p>";
					}else{
						echo "<p>Select an election to add positions</p>";
						echo '<select id="selectElection" class="selectStyled">';
					echo '<option value="default">Choose an election</option>';
							while ($election = mysqli_fetch_assoc($electionsQuery)) {
								# code...
								echo "<option value='".$election['name']."'>".$election['name']."</option>";
							}
					echo '</select><br><br>';
					echo '<button id="selectElectionBtn" class="btn btn-default btn-lg pull-right">Select</button>';

					} 
					?>	

					<div id="managePositions"></div>
				<h3>Delete an Election</h3><hr>
				<?php
					$deleteElections = "SELECT * FROM elections";
					$deleteElectionsQuery = mysqli_query($conn, $deleteElections);

					if (mysqli_num_rows($deleteElectionsQuery) < 1) {
						# code...
			echo "<p>There are no elections currently. You can add elections <a href='vote.elect.php'>here</a></p>";
					}else{
						echo "<h5>Please choose an election to delete a position</h5>";
						echo "<form action='includes/deleteElection.inc.php' method='POST'>";
						echo '<select name="delElection" class="selectStyled">';
						echo '<option value="default">Choose an election</option>';
								while ($eachelection = mysqli_fetch_assoc($deleteElectionsQuery)) {
									# code...
									echo "<option value='".$eachelection['name']."'>".$eachelection['name']."</option>";
								}
						echo '</select><br><br>';
						echo '<button type="submit" name="delElectionBtn" class="btn btn-danger btn-lg pull-right">Delete</button>'; 
						echo "</form>";

					}
					?>
				<h3>Delete a Position</h3><hr>
				<?php
					$elections = "SELECT * FROM elections";
					$electionsQuery = mysqli_query($conn, $elections);

					if (mysqli_num_rows($electionsQuery) < 1) {
						# code...
						echo "<p>There are no elections currently. You can add elections <a href='vote.elect.php'>here</a></p>";
					}else {
						echo '<h5>Please choose an election to delete a position</h5>';
						echo '<select id="deletePosition" class="selectStyled">';
						echo '<option value="default">Choose an election</option>';
								while ($election = mysqli_fetch_assoc($electionsQuery)) {
									# code...
									echo "<option value='".$election['name']."'>".$election['name']."</option>";
								}
						echo '</select><br><br>';
						echo '<button id="deletePositionBtn" class="btn btn-warning btn-lg pull-right">Select</button>'; 

					}
				echo "<br><br>";
				?>
				<div id="delPose"></div>
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
</div>
</body>
</html>
