<?php 
	
	include 'database.inc.php';

	//Get the election which the session for it has started
	$checkForSession = "SELECT * FROM elections WHERE session = 1";
	$checkForSessionQuery = mysqli_query($conn, $checkForSession);
	$election = "";

	while ($theElection = mysqli_fetch_assoc($checkForSessionQuery)) {
		# code...
		$election = $theElection['name'];
	}

	$numberOfPositions = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM positions WHERE election = '$election'"));


	//Get the total number of voters who have voted
	$reallyVotedSQL = "SELECT * FROM userhasdone WHERE election = '$election'";
	$reallyVotedQuery = mysqli_query($conn, $reallyVotedSQL);
	$numberOfVoted = mysqli_num_rows($reallyVotedQuery);

	if (mysqli_num_rows($checkForSessionQuery) < 1) {
		# code...
		echo "";
	}else{
		$electionStarted = true;

		echo "<h3 align='center'>Overall Votes for the election</h3><hr>";
		echo "<p class='p-sized'>Overall number of votes: <b>".$numberOfVoted."</b></p>";
			
		
	}
	
?>