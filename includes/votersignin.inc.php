<?php

		include 'database.inc.php';

		session_start();
	
		if (!isset($_POST['signin-student'])) {
			header("Location: ../index.php");
			exit();
		}else{
			$student_id = strtoupper($_POST['studentId']);

			//connect to the table and search for users. SQL and Query
			$sql = "SELECT * FROM students WHERE users = '$student_id'";
			$query = mysqli_query($conn, $sql);

			if (!$query) {
				echo "Error!";
			}else{
				echo "No Error!";
			}

			if (mysqli_num_rows($query) < 1) {
				header("Location: ../index.php?student=notexist");
				exit();
			}else{
				$_SESSION['studentId'] = $student_id;
				header("Location: ../vote.php");
			}
			

		}