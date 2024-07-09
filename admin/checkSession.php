<?php

	if (!isset($_POST['startSession'])) {
					echo "";
				}else{
					if ($_POST['startElection'] == 'default') {
						echo "<p id='hider'>Please choose an election</p>";
					}else{
						$election = $_POST['startElection'];
						$checkForSessionSQL = "SELECT * FROM elections WHERE session = 1";
						$checkForSessionQuery = mysqli_query($conn, $checkForSessionSQL);

						if (mysqli_num_rows($checkForSessionQuery) < 1) {
							# code...
							$selectSQL = "SELECT * FROM elections WHERE name = '$election'";
						$selectQuery = mysqli_query($conn, $selectSQL);

						while ($select = mysqli_fetch_assoc($selectQuery)) {
							# code...

							if ($select['session'] == 1) {
								echo "<p id='hider'>The session has already been started</p>";
							} else {

								$updateSQL = "UPDATE elections SET session = 1 WHERE name = '$election'";
								$updateQuery = mysqli_query($conn, $updateSQL);
								if (!$updateQuery) {
									# code...
									echo "<p id='hider'>There was an error starting the voting session</p>";
								}else{
									echo "<p id='hider'>Voting session started for <b>".$election."</b></p>";
								}

							}

						}

						}else{
							echo "<p id='hider'>You cannot start two sessions. Please stop one</p>";
						}
						
						}
					}

					if (!isset($_POST['stopSession'])) {
						# code...
						echo "";
					}else{
						if ($_POST['stopElection'] == 'default') {
							# code...
							echo "<p id='hider'>Please choose an election</p>";
						}else{
							$toStopElection = $_POST['stopElection'];
							$stopSQL = "UPDATE elections SET session = 0 WHERE name = '$toStopElection'";
							$stopQuery = mysqli_query($conn, $stopSQL);
							if (!$stopQuery) {
								# code...
								echo "<p id='hider'>There was an error stopping the session</p>";
							}else{
								echo "<p id='hider'>Voting session stopped for <b>".$toStopElection."</b></p>";
							}
						}
					}

?>