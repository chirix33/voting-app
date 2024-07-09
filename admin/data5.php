<?php


	if (!isset($_POST['NumOfVoters'])) {
		header("Location: vote.settings.php");
		exit();
	}else{

		if (($_POST['NumOfVoters'] < 1) || ($_POST['NumOfVoters'] == 0)) {
			echo "<div id='warning'>";
			echo "<p class='lead' align='center'>Please put a valid number of students!</p>";
			echo "<p align='center'><a href='vote.settings.php' class='btn btn-default'>Okay</a></p><br><br>";
			echo "</div>";
		} else {
		$num = 0;
		$NumOfVoters = $_POST['NumOfVoters'];

		echo "<form action='includes/getVoters.inc.php' method='POST'>";
		echo "<table class='table table-condensed'>";
		while ($num < $NumOfVoters) {
			echo "<tr>";
			echo "<td>";
			echo "<input type='text' name='voter".$num."' value placeholder='Enter Student Name'>";
			echo "<input type='text' name='voterId".$num."' value placeholder='Enter Student ID'>";
			echo "</td>";
			echo "</tr>";
			$num++;
		}
		echo "</table>";
		echo "<input type='hidden' name='numOfVoters' value='".$NumOfVoters."'>";
		echo "<button type='submit' name='submit-voters' class='btn btn-success pull-right'>Submit</button><br><br>";
		echo "</form>";
	}
}

