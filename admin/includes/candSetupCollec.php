<?php include_once 'database.inc.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Setup Candidates</title>
		<meta charset="utf-8">
		<meta name="author" content="Ashraf Abdul-Muumin">
		<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="../styles/styles.css">
		<script src="../scripts/jquery.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="jumbotron">
				<?php 
				session_start();
				if (!isset($_SESSION['u_id'])) {
					header("Location: ../index.php");
				}else{
					echo "<h1 align='center'>".$_SESSION['u_id']."</p>";
					if(!isset($_SESSION['u_id'])) {
					header("Location: ../index.php");
					exit();
						} else {
								echo "<div align='center'>";
								echo "<form action='includes/signout.php' method='POST'>";
								echo "<button type='submit' class='btn btn-warning' name='really'>Signout</button>";
								echo "</form>";
								echo "</div><br>";
							}
						}
				?>
			</div>
		<div class="row">
			<div class="col-md-12">
			<?php
				if (!isset($_POST['submitAll'])) {
					header("Location: ../vote.cand.setup.php");
					exit();
				}else{
					$nameofposition = $_POST['nameofposition'];
					$numofcandcollec = $_POST['verNumProfile'];

					$num = 0;
					$sql = "SELECT * FROM candidates WHERE status = 0 AND gender = 9";
					$update = "UPDATE candidates SET status = 1 WHERE position = '$nameofposition' AND status = 0";
					$result = mysqli_query($conn, $sql);
					if(mysqli_num_rows($result) < 1){
						header("Location: ../vote.cand.setup.php");
						exit();
					}else{
							for (; $num < $numofcandcollec; $num++) { 
								$thefileName[$num] = $_FILES['file'.$num]['name'];
								$thefileTmpname[$num] = $_FILES['file'.$num]['tmp_name'];
								$thenames[$num] = $_POST['thenames'.$num];
								$ext[$num] = explode(".", $thefileName[$num]);
								$actext[$num] = strtolower(end($ext[$num]));
								$newname[$num] = $thenames[$num].".".$actext[$num];
								$dstn = "../../media/".$newname[$num];
								move_uploaded_file($thefileTmpname[$num], $dstn);
								$theCandGender[$num] = $_POST['theCandGender'.$num];

								if($theCandGender[$num] == 'male'){
										$statementMale = "UPDATE candidates SET gender = 1 WHERE position = '$nameofposition' AND name = '$thenames[$num]'"; 
										mysqli_query($conn, $statementMale);
								}else{
										$statementFemale = "UPDATE candidates SET gender = 0 WHERE position = '$nameofposition' AND name = '$thenames[$num]'";
										mysqli_query($conn, $statementFemale);
								}

								mysqli_query($conn, $update);
						}
									
								}
						
								header("Location: ../vote.cand.setup.php?changes=success");
					}
			?>
			</div>
		</div>
		</div>
	</body>
	</html>