<?php
	include 'database.inc.php';

	//Get the election which the session for it has started
	$sql = "SELECT * FROM elections WHERE session = 1";
	$query = mysqli_query($conn, $sql);

	//Get the total number of voters to display on front of the candidates' statistics
	$votersSQL = "SELECT * FROM students";
	$votersQuery = mysqli_query($conn, $votersSQL);
	$numberOfVoters = mysqli_num_rows($votersQuery);

	if (mysqli_num_rows($query) < 1) {
		# code...
		echo "";
	}else{
		echo "<br><br><h3 align='center'>Votes for each position</h3><hr>";
		while ($theElection = mysqli_fetch_assoc($query)) {
			# code...
			$election = $theElection['name'];
			$getPositionsSQL = "SELECT * FROM positions WHERE election = '$election'";
			$getPositionsQuery = mysqli_query($conn, $getPositionsSQL);

			if (mysqli_num_rows($getPositionsQuery) < 1) {
				# code...
				echo "<p class='p-sized'>There are no positions under <u>".$election."</u></p>";
			}else{
				while ($eachPosition = mysqli_fetch_assoc($getPositionsQuery)) {
					# code...
					$pose = $eachPosition['name'];
					echo "<p class='lead' align='center'><b>".$pose."</b></p>";
					$getCandidatesSQL = "SELECT * FROM votecounts WHERE election = '$election' AND position = '$pose'";
					$getCandidatesQuery = mysqli_query($conn, $getCandidatesSQL);
					while ($eachCandidate = mysqli_fetch_assoc($getCandidatesQuery)) {
						# code...
						$name = $eachCandidate['name'];
						$counts = "<b>".$eachCandidate['result']."</b>";
						echo "<p class='p-sized'>Candidate <u>".$name ."</u>: ".$counts." out of ". $numberOfVoters ."</p>";
					}
				}
			}
		}
	}
	
?>


