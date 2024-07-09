<?php
	include 'database.inc.php';
	if(!isset($_POST['submitCandAlready'])){
		header("Location: ../vote.cand.setup.php?changes=error");
		exit();
	}else{
		$theCandName = $_POST['theCandAlready'];
		if(empty($_POST['theCandGender'])){
			header("Location: ../vote.cand.setup.php");
			exit();
		}else{
			$theCandGender = $_POST['theCandGender'];
			$theCandId = $_POST['candId'];

			if($theCandGender == 'male' || $theCandGender == 'Male'){
				$statement = "UPDATE candidates SET gender = 1, name ='$theCandName' WHERE id='$theCandId'";
				mysqli_query($conn, $statement);
				header("Location: ../vote.cand.setup.php?change=success");

			}elseif($theCandGender == 'Female' || $theCandGender == 'female'){
				$sql = "UPDATE candidates SET gender = 0, name ='$theCandName' WHERE id='$theCandId'";
				mysqli_query($conn, $sql);
				header("Location: ../vote.cand.setup.php?change=success");
			}else{
				header("Location: ../vote.cand.setup.php");
				exit();
			}
			
		} 
	}