<?php include_once 'database.inc.php'; ?>
<?php
	session_start();
	if (!isset($_SESSION['studentId'])) {
		# code...
		header("Location: ../index.php");
		exit();
	}else{
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
<!DOCTYPE html>
<html>
<head>
	<title>User | <?php echo $_SESSION['studentId']; ?></title>
	<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<meta name="author" content="3A4">
		<meta name="description" content="SRC voting">
		<link rel="stylesheet" type="text/css" href="../styles/styles.css">
		<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
		<link rel="icon" href="../uploads/favicon.ico">
		<script src="../scripts/jquery.min.js"></script>
		<style type="text/css">
			input {
				width: 65% !important;
			}
		</style>
		<script>
			$(document).ready(function() {
				$("#temporary").fadeOut(3000);
				$("#showBody").show(1100);
			});
		</script>
</head>
<body>
<div class="jumbotron">
	<div class="container">
		<div class="jumbotron">
			<div class="container">
				<h1>Confirm Vote | <span style="font-size: 30px !important;"><?php echo $student_name; ?></span></h1>
				<br>
					<div align='center'>
					<form action='signout.inc.php' method='POST'>
					<button type='submit' class='btn btn-warning' name='really'>Signout</button>
					</form>
					</div>
				<script src="../scripts/getTime.js"></script>
				<p id="theClock"></p>
			</div>
		</div>
	</div>
</div>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div id="showBody">
				<?php


					if (!isset($_POST['submit-votes'])) {
						# code...
						header("Location: ../vote.php");
						exit();
					}else{
					$election = $_POST['name-of-election'];

					//First.. Check if this user voted already

					$check = "SELECT * FROM userhasdone WHERE user = '$studentId' AND election  = '$election'";
					$checkQuery = mysqli_query($conn, $check);
					if (mysqli_num_rows($checkQuery) > 0) {
						# code...
						echo "<p class='lead well' align='center'>You cannot vote twice</p>";
					}else{

					$cycleNum = 0;
					$numberOfPositions = $_POST['number-of-positions'];

					for (; $cycleNum < $numberOfPositions; $cycleNum++) {
						# code...
						$nameOfPositions[$cycleNum] = $_POST['name-of-positions'.$cycleNum];
						$votedCand[$cycleNum] = $_POST['candidate'.$cycleNum];

						$theSQL = "SELECT * FROM votecounts WHERE name = '$votedCand[$cycleNum]' AND position = '$nameOfPositions[$cycleNum]' AND election = '$election'";
						$theQuery = mysqli_query($conn, $theSQL);

						while ($theCandidate = mysqli_fetch_assoc($theQuery)) {
							# code...
							$newVote = $theCandidate['result'] + 1;
							$newVoteSQL = "UPDATE votecounts SET result = $newVote WHERE name = '$votedCand[$cycleNum]' AND position = '$nameOfPositions[$cycleNum]' AND election = '$election'";
							$newVoteQuery = mysqli_query($conn, $newVoteSQL);


							if (!$newVoteQuery) {
									# code...
								echo "<p class='lead'>There was an error</p>";
							}else{
								echo "<p class='lead'>Voted for the position <b>".$nameOfPositions[$cycleNum]."</b></p>";
							}



					}


					}

					$userHasDoneSQL = "INSERT INTO userhasdone(user, election) VALUES('$studentId', '$election')";

					 mysqli_query($conn, $userHasDoneSQL);

			}
		}
					//End of the check
					echo "<p class='lead'>Please sign out</p>";
				?>
			</div>
		</div>
	</div>
</div>
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<?php include 'footer.inc.php'; ?>
		</div>
	</div>
</div>
</body>
</html>
