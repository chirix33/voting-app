<?php

	$theNum = $_POST['thenumOfCandidates'];

	if ($theNum <= 0) {
		# code...
		echo "<p class='lead'>Please put a valid number</p>";
		echo "<a class='btn btn-default' href='vote.cand.php'>Okay</a>";
	}else{

		$valuePlaceholder = "Name of the candidate";

		echo "<form action='includes/saveCandidates.inc.php' method='POST'>";
		for ($x=0; $x <= $theNum - 1  ; $x++) { 
			# code...
			echo "<input type='text' name='cand".$x."' value placeholder='".$valuePlaceholder."' required>";
			echo "<br><br>";
		}
		echo "<input type='hidden' name='trueNumberOfCandidates' value='".$theNum."'>";
		echo "<input type='hidden' name='hiddenPose' value='".$_POST['thehiddenPosition']."'>";
		echo "<input type='hidden' name='hiddenElection' value='".$_POST['thehiddenElection']."'>";
		echo "<button type='submit' name='submitCands' class='btn btn-primary btn-lg pull-right'>Submit candidates</button>";
		echo "</form>";
		echo "<br><br>";

	}

?>	