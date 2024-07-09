<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>E-Voting System</title>
	<meta charset="utf-8">
	<meta name="author" content="Ashraf Abdul-Muumin">
	<meta name="viewport" content="width=device-width,initialscale=1.0">
	<link rel="stylesheet" type="text/css" href="styles/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="styles/styles.css">
</head>
<body>
	<div class="jumbotron" >
			<div class="container">
				<h1 algin="center">Signup</h1>
				<?php
					include_once 'database.inc.php';

					if(isset($_POST['submit'])){
						if(empty($_POST['adminpwd']) || empty($_POST['cadminpwd'])){
							header("Location: ../index.php?signup=empty");
							exit();
						}else{
							if(!($_POST['adminpwd'] == $_POST['cadminpwd'])){
							header("Location: ../index.php?signup=match");
							exit();	
							}else{
								$statement = "SELECT * FROM admins WHERE uid='Admin'";
								$statementQuery = mysqli_query($conn, $statement);

								if (mysqli_num_rows($statementQuery) >= 1) {
									header("Location: ../index.php?signup=admintaken");
									exit();
								}else{
								$admin_uid = 'Admin';
								$admin_pwd = $_POST['adminpwd'];
								$hashedAdmin_Pwd = password_hash($admin_pwd, PASSWORD_DEFAULT);
								$sql = "INSERT INTO admins (uid, upwd) VALUES('$admin_uid', '$hashedAdmin_Pwd')";
								$result = mysqli_query($conn, $sql);
								if(!$result) {
									header("Location: ../index.php?signup=error");
									exit();
								} else {
									header("Location: ../index.php?signup=success");
									exit();
								}
							}
							}
						}
					}else{
						header("Location: ../index.php");
						exit();
					}
				?>
			</div>
	</div>
</body>
</html>
