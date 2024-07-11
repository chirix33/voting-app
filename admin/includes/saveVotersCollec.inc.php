<?php
	require 'database.inc.php';

	if (!isset($_POST['submitVotersFile'])) {
			# code...
			header("Location: ../vote.settings.php");
			exit();
		} else {
			$fileName = $_FILES['votersFile']['name'];
			$fileTmpName = $_FILES['votersFile']['tmp_name'];

			$ext = explode('.', $fileName);

			if (end($ext) != 'txt') {
				header("Location: ../vote.settings.php?upload=notsupported");
				exit();
			} else {

				$dstn = $_SERVER['DOCUMENT_ROOT']."/voters.txt";

				$move = move_uploaded_file($fileTmpName, $dstn);

				//the SQL Statement for the import file
				$importSQL= "LOAD DATA INFILE '$dstn' INTO TABLE students FIELDS TERMINATED BY ',' LINES TERMINATED BY '\r\n' (users, name)";

				$importFile = mysqli_query($conn, $importSQL);

				if (!$importFile) {
					header("Location: ../vote.settings.php?upload=error");
					exit();
				} else {
					header("Location: ../vote.settings.php?upload=success");
				}
			}

		}


?>
