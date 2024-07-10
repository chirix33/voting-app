<?php
include_once 'includes/database.inc.php';
session_start();

if (!isset($_SESSION['studentId'])) {
	header("Location: index.php");
	exit();
} else {
	 $studentId = $_SESSION['studentId'];

	 $getNameSQL = "SELECT * FROM students WHERE users = '$studentId'";
	 $getNameQuery = mysqli_query($conn, $getNameSQL);

	 if (mysqli_num_rows($getNameQuery) < 1) {
	 	header("Location: index.php");
	 	exit();
	 }else{
	 	while ($theStudent = mysqli_fetch_assoc($getNameQuery)) {
	 		$student_name = $theStudent['name'];
	 	}
	 }
}
?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>User <?php echo $studentId; ?></title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="author" content="3A4">
		<meta name="description" content="SRC voting">
		<link rel="stylesheet" type="text/css" href="styles/styles.css">
		<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
		<link rel="icon" href="uploads/favicon.ico">
		<script src="scripts/jquery.min.js"></script>
		<style type="text/css">
			input {
				width: 65% !important;
			}
		</style>
		<script>
			$(document).ready(function() {
				$("#temporary").fadeOut(3000);
				$("#showBody").show(1100);

				$("#startVotingForm").submit(function(event) {
					event.preventDefault();
					var theElection = $("#theElection").val();
					$("#showBody").hide().load("voting.php",
						{
							election : theElection
						}).hide(1000).show(1000);
				});

			});
		</script>
	</head>
	<body>
		<div class="jumbotron">
			<div class="container">
				<h1>Welcome | <span style="font-size: 30px !important;"><?php echo $student_name; ?></span></h1>
				<br>
					<?php include 'includes/signout-form.inc.php'; ?>
				<script src="scripts/getTime.js"></script>
				<p id="theClock"></p>
			</div>
		</div>
		<div class="container">

				<div class="row">
					<div class="col-md-12">
						<div id="showBody" style="display: none;">
							<?php

							if (!isset($_GET['voted'])) {
								# code...
								$electionSQL = "SELECT * FROM elections WHERE session = 1";
								$electionQuery = mysqli_query($conn, $electionSQL);

								if (mysqli_num_rows($electionQuery) < 1) {
									# code...
									echo "<p class='lead' align='center'>The admin has not started the session of any election</p>";
								}elseif (mysqli_num_rows($electionQuery) > 1) {
									# code...
									echo "<h3>Choose the election with which you want to start voting for</h3>";
									echo "<div id='setupCandidates'>";
									echo "<table class='table'>";
									echo "<tr>";
										while ($theElections = mysqli_fetch_assoc($electionQuery)) {
											# code...
											echo "<td><button id='theElection' class='btn btn-default btn-lg'>".$theElections['name']."</button></td>";
										}
									echo "</tr>";
									echo "</table>";
									echo "</div>";
								}else{
									while ($theElection = mysqli_fetch_assoc($electionQuery)) {
										# code...
										echo "<h3 align='center'>You are voting for the election <b>".$theElection['name']."</b></h3><hr>";
										echo "<p class='lead' align='center'>Ready to start voting?</p>";
										echo "<form id='startVotingForm' action='voting.php' method='POST'>";
										echo "<input type='hidden' id='theElection' value='".$theElection['name']."'>";
										echo "<p align='center'>";
										echo "<button type='submit' id='startVoting' class='btn btn-primary btn-lg'>Start voting</button>";
										echo "</p>";
										echo "</form>";
										echo "<br><br>";
									}
								}

							}elseif ($_GET['voted'] == 'done') {
								# code...
								echo "<div align='center'>";
								echo "<h3>Done</h3><hr>";
								echo "<p class='lead'>You have finished voting. Please sign out</p>";
								echo "</div>";
							}else{
								header("Location: vote.php");
								exit();

							}
							?>
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
