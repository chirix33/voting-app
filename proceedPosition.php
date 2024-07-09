<?php
	
	include 'includes/database.inc.php';

	if (!isset($_POST['position'])) {
		# code...
		header("Location: voting.php");
		exit();
	}else{
		$chosenPosition = $_POST['position'];
		$theElection = $_POST['election'];

		$getCandidatesSQL = "SELECT * FROM candidates WHERE election = '$theElection' AND position = '$chosenPosition'";
		$getCandidatesQuery = mysqli_query($conn, $getCandidatesSQL);

		if (mysqli_num_rows($getCandidatesQuery) < 1) {
			# code...
			echo "<p class='lead'>There are no candidates for <b>".$chosenPosition."</b></p>";
		}else{
			echo "<form>";
			echo "<table class='table'>";
			echo "<tr>";
			while ($candidate = mysqli_fetch_assoc($getCandidatesQuery)) {
				# code...


			}
			echo "</tr>";
		}
	}

?>