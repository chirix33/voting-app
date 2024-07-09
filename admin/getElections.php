<?php

	if (!isset($_POST['theNumber'])) {
		# code...
		echo "";
	}else{
		$myNumber = 0;
		$theNumber = $_POST['theNumber'];

		echo "<form action='includes/addElections.inc.php' method='POST'>";
		for (; $myNumber <= $theNumber - 1; $myNumber++) { 
			# code...
			echo "<p align='center'><input type='text' name='election".$myNumber."' value placeholder='Enter election name' required></p>";
			echo "<br><br>";
		}
		echo "<input type='hidden' name='trueNumberOfElections' value='".$theNumber."'>";
		echo "<button type='submit' name='submit-elections' class='btn btn-success btn-lg pull-right'>Submit</button>";
		echo "</form>";
	}

?>