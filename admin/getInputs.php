<?php

	$theNum = $_POST['Num'];

	if ($theNum <= 0) {
		# code...
		echo "<p class='lead'>Please put a valid number</p>";
		echo "<a class='btn btn-default' href='vote.pose.php'>Okay</a>";
	}else{
		$valuePlaceholder = "Enter position name";

		echo "<form action='includes/savePositions.inc.php' method='POST'>";
		for ($x=0; $x <= $theNum - 1  ; $x++) { 
			# code...
			echo "<input type='text' name='pose".$x."' value placeholder='".$valuePlaceholder."' required>";
			echo "<br><br>";
		}
		echo "<input type='hidden' name='trueNumberOfPositions' value='".$theNum."'>";
		echo "<input type='hidden' name='hiddenPose' value='".$_POST['Election']."'>";
		echo "<button type='submit' name='submitPoses' class='btn btn-primary pull-right'>Submit positions</button>";
		echo "</form>";
		echo "<br><br>";
	}

?>	