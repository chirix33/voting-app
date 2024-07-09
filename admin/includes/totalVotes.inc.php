<?php
	
	include 'database.inc.php';

	$sql = "SELECT * FROM elections WHERE session = 1";
	$query = mysqli_query($conn, $sql);

	if (mysqli_num_rows($query) < 1) {
		# code...
		echo "";
	}else{
		echo "<h3 align='center'>Total votes for the Positions</h3><hr>";
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
					$getCandidatesSQL = "SELECT SUM(result) FROM votecounts WHERE election = '$election' AND position = '$pose'";
					$getCandidatesQuery = mysqli_query($conn, $getCandidatesSQL);
					while ($eachCandidate = mysqli_fetch_assoc($getCandidatesQuery)) {
						# code...
						$totalResults = $eachCandidate['SUM(result)'];
						echo "<p class='p-sized'>Total votes: <b>".$totalResults."</b></p>";
					}
				}
			}
		}
	}
	
?>