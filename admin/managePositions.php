<?php
	
	include 'includes/database.inc.php';

	if ($_POST['Election'] == 'false') {
		# code...
		echo "<p class='lead' align='center'>Please choose an election</p>";
	}else{
		$theElection = $_POST['Election'];
		$getPositionsFromElectionSQL = "SELECT * FROM positions WHERE election = '$theElection'";
		$getPositionsFromElectionQuery = mysqli_query($conn, $getPositionsFromElectionSQL);

		echo "<h3>Setup the positions for <b>".$theElection."</b></h3><hr>";

		echo "<p>Please type the number of positions to add. Eg, 5</p><br><br>";
		echo "<div id='formWrapper'>";
		echo '<form id="theForm">';
		echo "<p align='center'><input id='numberOfPositions' type='number' name='numOfPose' value='' placeholder='0'></p>";
		echo "<input type='hidden' id='hiddenElection' name='hiddenElection' value='".$theElection."'>";
		echo "<br>";
		echo "<button id='submit-numofpose' type='button' name='submit-numofpose' class='btn btn-primary pull-right'>Next</button><br><br>";
		echo "</form>";
		echo "</div>";

		echo "<h3>Current positions under the ".$theElection."</h3><hr>";

		if (mysqli_num_rows($getPositionsFromElectionQuery) < 1) {
			# code...
			echo "<p align='center'>There are currently no positions under the ".$theElection."</p>";
		}elseif (mysqli_num_rows($getPositionsFromElectionQuery) == 1) {
			# code...
			echo "<p align='center'>There is currently 1 position under the <u>".$theElection."</u></p>";
		}else{
			echo "<p align='center'>There are currently <u>".mysqli_num_rows($getPositionsFromElectionQuery)."</u> positions under the <u>".$theElection."</u></p>";
		}

		$thenumber = mysqli_num_rows($getPositionsFromElectionQuery);

		if ($thenumber < 1) {
			# code...
			echo "<p>There are no positions</p>";
		}else{
			echo "<blockquote>";
			while ($eachPosition = mysqli_fetch_assoc($getPositionsFromElectionQuery)) {
				# code...
				echo "<p>".$eachPosition['name']."</p>";
			}
			echo "</blockquote>";
		}
		



	}
	
?>

<script>
	$(document).ready(function() {
		$("#submit-numofpose").click(function() {
			var theNum = $("#numberOfPositions").val();
			var election = $("#hiddenElection").val();
			$("#formWrapper").load("getInputs.php", 
			{
				Num: theNum,
				Election: election
			});
		});
	});
</script>