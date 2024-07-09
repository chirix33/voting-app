<?php
	include 'database.inc.php';

	if (!isset($_POST['submitCands'])) {
		# code...
		header("Location: vote.cand.php");
		exit();
	}else{
		$hiddenNum = $_POST['trueNumberOfCandidates'];
		$hiddenPose = $_POST['hiddenPose'];
		$theElection = $_POST['hiddenElection'];
		$picturePath = 'media/profiledefault.jpg';
		for ($i=0; $i < $hiddenNum ; $i++) { 
			# code...
			$cand[$i] = $_POST['cand'.$i];
			$sql = "INSERT INTO candidates(name, picture, position, election) VALUES('$cand[$i]', '$picturePath', '$hiddenPose', '$theElection')";
			$query = mysqli_query($conn, $sql);
		}

		for ($a=0; $a < $hiddenNum; $a++) { 
			# code...
			$voteCand[$a] = $_POST['cand'.$a];
			$sqlVote = "INSERT INTO votecounts(name, position, election, result) VALUES('$voteCand[$a]', '$hiddenPose', '$theElection', 0)";
			$queryVote = mysqli_query($conn, $sqlVote);
		}

		if (!$query || !$queryVote) {
				# code...
				header("Location: ../vote.cand.php?candidates=error");
				exit();
			}else{
					header("Location: ../vote.cand.php?candidates=success");
					exit();
				}
			}

?>