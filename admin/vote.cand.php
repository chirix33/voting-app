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

			$("#proceedCandidate").click(function() {
				var chosenElection = $("#currentElections").val();
 
					$("#showPositions").load("showPositions.php",
						{
							ChosenElection: chosenElection
						}).hide().fadeIn(1500);

					$("#proceedCandidate").hide(1000);
				
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

				if (!isset($_GET['candidates'])) {
					echo "";
				}elseif($_GET['candidates'] == 'error'){
					echo "<p id='temporary'>There was an error adding the candidates</p>";
				}else{
					echo "<p id='temporary'>Success adding the candidates</p>";
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
		<li role="presentation" class="active">
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
		<h3>(1)<span class="lead"> Which Election?</span></h3><hr>
		<?php
			$sql = "SELECT * FROM elections";
			$query = mysqli_query($conn, $sql);

			if (mysqli_num_rows($query) < 1) {
				# code...
				echo "<p style='font-size: 16px;'>There are no elections available. You can <a href='vote.elect.php'>add one</a></p>";
			}else{
				echo "<select id='currentElections' class='selectStyled'>";
				echo "<option value='default'>Choose an election</option>";
				while ($eachElection = mysqli_fetch_assoc($query)) {
					echo "<option value='".$eachElection['name']."'>".$eachElection['name']."</option>";
				}
				echo "</select>";
				echo "<br><br>";
				echo "<button id='proceedCandidate' class='btn btn-default btn-lg pull-right'>Next</button>";
			}
		?>
		<div class="col-md-12">
			<div id="showPositions"></div>
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
