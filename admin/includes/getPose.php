<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Get Positions</title>
	<meta charset="utf-8">
	<meta name="author" content="Ashraf Abdul-Muumin">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../styles/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../styles/styles.css">
	<script src="../scripts/jquery.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="jumbotron">
			<?php
				include 'database.inc.php';
				if(!isset($_POST['submit-pose'])){
					header("Location: ../vote.pose.php");
					exit();
				}else {

					$hiddenNum = $_POST['hiddenNum'];

					$num = 0;
					while($num < $hiddenNum) { 
						$pose[$num] = $_POST['pose'.$num];
						$stat = "SELECT * FROM positions WHERE name = '$pose[$num]'";
						$query = mysqli_query($conn,$stat);
						if(mysqli_num_rows($query) >= 1){
							echo "<p>".$pose[$num]." already exists</p>";
							exit();
						}else{

							$statement = "INSERT INTO positions(name) VALUES('$pose[$num]')";
						$result = mysqli_query($conn,$statement);
						if (!$result) {
							echo "<h4>Error! Please try again</h4>";
						}else{
							echo "<h5>Success adding the position <b>" . $pose[$num] . "</b></h5><br>"; 
						}


						$num++;

						}
						
					}

					echo "<p algin='center'>Go to the <a href='http://localhost/voting/main.php'>Main</a> page</p>";
				}
				?>
			</div>
		</div>
	</body>
	</html>