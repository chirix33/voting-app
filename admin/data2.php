<?php
	if(!isset($_POST['numCand'])){
		header("Location: http://localhost/voting/vote.cand.php");
		exit();
	}else{
		$numCand = 0;
		$theNumCand = $_POST['numCand'];
		$thePos = $_POST['Pos'];
		echo '<form id="theForm" action="includes/getCand.php" method="POST">';
			while ($numCand < $theNumCand) {
				echo '<input type="text" name="cand'.$numCand.'" value placeholder="Candidate name for '.$thePos.'"><br>';
				$numCand++;
			}
		echo '<input type="hidden" name="hiddenNumCand" value="'.$theNumCand.'">';
		echo '<input type="hidden" name="hiddenNumPose" value="'.$thePos.'">';
		echo '<button type="submit" name="submit-cand" class="btn btn-primary pull-right">Submit</button>';
		echo '</form><br><br>';
	}
	
					
?>
