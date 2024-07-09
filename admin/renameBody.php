<?php
	if (!isset($_POST['renameCand'])) {
		# code...
		header("Location vote.cand.setup.php");
		exit();
	}else{
		$renamingCand = $_POST['renameCand'];
		$election = $_POST['election'];
		$position = $_POST['position'];

		echo "<form action='includes/renameCandidates.setup.inc.php' method='POST'>";
		echo "<input type='text' name='oldName' value='".$renamingCand."' readonly>";
		echo "<br><br>";
		echo "<input type='text' name='newName' placeholder='New name'>";
		echo "<br>";
		echo "<input type='hidden' name='election' value='".$election."'>";
		echo "<input type='hidden' name='position' value='".$position."'>";
		echo "<button type='submit' name='submit-candidate-rename' class='btn btn-primary btn-lg pull-right'>Rename</button>";
		echo "<br><br><br>";
		echo "</form>";
	}
?>