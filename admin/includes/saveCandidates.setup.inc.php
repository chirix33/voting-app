<!DOCTYPE html>
<html>
<head>
	<title>Setup Candidates</title>
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
	<link rel="icon" href='../uploads/favicon.ico'>
</head>
<body>
<div class="jumbotron">
	<div class="container">
		<?php

		include 'database.inc.php';

		if (!isset($_POST['setup-candidates'])) {
			# code...
			echo "<p>You did not click the button, please click <a href='../vote.cand.setup.php'>here</a></p>";
			//header("Location: ../vote.cand.setup.php");
			//exit();
		}else{
			$num = 0;
			//also... Get the election and position to specify the candidate(s)
			$election = $_POST['electionOfCandidates'];
			$position = $_POST['positionOfCandidates'];

			//Get the number of candidates that the user had to cycle through their information
			$numberOfCandidates = $_POST['numberOfCandidates'];

			for (; $num < $numberOfCandidates; $num++) {

				$namesOfCandidates[$num] = $_POST['candidateName'.$num];
				$candidateFileName[$num] = $_FILES['file'.$num]['name'];
				$candidateFileTmpName[$num] = $_FILES['file'.$num]['tmp_name'];
				$dstn = "../../media/".$candidateFileName[$num];
				$move = move_uploaded_file($candidateFileTmpName[$num], $dstn);

				if (!$move) {
					# code...
					echo "<p>Error moving the profile for <b>".$namesOfCandidates[$num]."</b>. Please try another profile picture</p>";
				}else{

					$db_dstn = "media/".$candidateFileName[$num];

					$updateSQL = "UPDATE candidates SET picture = '$db_dstn' WHERE name = '$namesOfCandidates[$num]' AND position = '$position' AND election = '$election'";
					$updateQuery = mysqli_query($conn, $updateSQL);

					if (!$updateQuery) {
						# code...
						echo "<p>Error uploading the profile of <b>".$namesOfCandidates[$num]."</b></p>";
					}else{
						echo "<p>Candidate <b>".$namesOfCandidates[$num]."</b> profile uploaded</p>";
					}


				}

				}

				echo "<p>Please <a href='../vote.cand.setup.php'>go back</a></p>";

		}

	?>
</div>
</div>
</body>
</html>
