<?php
	include_once 'database.inc.php';

	if (!isset($_POST['settingsVote'])) {
		header("Location: ../vote.settings.php");
		exit();
	}else{
		if ($_POST['stoptime'] == "") {
			header("Location: ../vote.settings.php");
			exit();
		}else{
			$stopTime = mysqli_real_escape_string($conn, $_POST['stoptime']);
			$stoptimeArray = explode(":",$stopTime);
			if (count($stoptimeArray) < 3) {
				header("Location: ../vote.settings.php?set=syntax");
				exit();
			}elseif (count($stoptimeArray) > 3) {
				header("Location: ../vote.settings.php?set=syntax");
				exit();
			}else{
				$ampm = $_POST['ampm'];
				if($ampm == "am"){
					$ampm = "am";
				}else{
					$ampm = "pm";
				}
				$sql = "UPDATE votesettings SET end_time = '$stopTime', ampm = '$ampm'";
				$result = mysqli_query($conn, $sql);
				if (!$result) {
					header("Location: ../vote.settings.php?set=error");
					exit();
				}else{
					header("Location: ../vote.settings.php?set=succes");
					exit();
				}
			}
		}
	}
?>