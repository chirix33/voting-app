<!DOCTYPE html>
<html>
<head>
	<title>Change Password</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
</head>
<body>
<div class="container">
	<div class="jumbotron">
		<?php
				include 'includes/database.inc.php';
				if (!isset($_POST['submit-passwords'])) {
					# code...
					header("Location: vote.account.php");
					exit();
				}else{
					$oldPass = mysqli_real_escape_string($conn, $_POST['old-password']);
					$newPass = mysqli_real_escape_string($conn, $_POST['new-password']);
					$cnewPass = mysqli_real_escape_string($conn, $_POST['cnew-password']);

					if ($oldPass == "" || $newPass == "") {
						# code...
						echo '<p align="center" class="lead">Please fill the fields to change the password</p>';
					}else{
						if ($newPass != $cnewPass) {
							# code...
							echo "<p align='center' class='lead'>The passwords do not match</p>";
						}else{

							$SQL = "SELECT * FROM admin WHERE admin = 'admin'";
							$query = mysqli_query($conn, $SQL);

							while ($theAdmin = mysqli_fetch_assoc($query)) {
								# code...
								if ($oldPass != $theAdmin['password']) {
									# code...
									echo '<p align="center" class="lead">The old password is wrong</p>';
								}else{
									$newSQL = "UPDATE admin SET password = '$newPass'";
									$newQuery = mysqli_query($conn, $newSQL);
									echo '<p align="center" class="lead">Admin password updated successfully</p>';

								}

						}
				
						}	
						
					}
					echo "<p align='center'>Please <a href='vote.account.php'>go back</a> <span class='lead'>OR</span> go to the <a href='main.php'>main page</a> </p>";
				}


?>
	</div>
</div>
</body>
</html>
