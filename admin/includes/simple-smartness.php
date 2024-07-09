<?php 
	if (!isset($_GET['signup'])) {
		echo '<p align="center" class="lead">Notice: There is only one "Admin" user who can manage candidate and votes</p>';
	}else{
		$signupCheck = $_GET['signup'];
		switch ($signupCheck) {
			case "empty":
				echo '<p align="center" class="danger">You did not fill fields!</p>';
				break;
			case "match":
				echo '<p align="center" class="danger">The passwords do not match</p>';
				break;
			case "admintaken":
				echo '<p align="center" class="danger">The "Admin" account already exists. Only one can be created</p>';
				break;
			case "error":
				echo '<p align="center" class="danger">There was an error signing up. Please try again</p>';
				break;
			case "success":
				echo '<p align="center" class="success">Success creating the account!</p>';
				break;
			default:
				echo '<p align="center">Notice: There is only one main "Admin" user who can create other admins</p>';
				break;
		}
		
	}

	if (!isset($_GET['signin'])) {
		echo '';
	}else{
		$signinCheck = $_GET['signin'];

		if ($signinCheck == 'passerror') {
			echo '<p align="center" class="danger">The password is incorrect</p>';
		}
	}
	
?>	