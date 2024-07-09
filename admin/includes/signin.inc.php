<?php
	session_start();

	include 'database.inc.php';

	if (!isset($_POST['adminsginin-button'])) {
		header("Location: ../index.php");
		exit();
	} else {
		$admin_pwd = $_POST['admin_pwd'];

		if ($admin_pwd == "") {
			# code...
			header("Location: ../index.php?signin=empty");
			exit();
		} else {
			$sql = "SELECT * FROM admin";

			$query = mysqli_query($conn, $sql);

			if (mysqli_num_rows($query) !== 1) {
				header("Location: ../index.php");
				exit();
			}

			while ($theAdmin = mysqli_fetch_assoc($query)) {
			 	# code...
			 	if ($admin_pwd == $theAdmin['password']) {
			 		# code...
			 		$_SESSION['id'] = "Admin";
					header("Location: ../main.php");
					exit();
			 	} else {
			 		header("Location: ../index.php?signin=password");
					exit();
			 	}
			}
		}

	}