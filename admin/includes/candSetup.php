<?php 
	
	include_once 'database.inc.php';

	if(!isset($_POST['submitProfile'])){
		header("Location: ../vote.cand.setup.php");
		exit();
	}else{
			$candname = $_POST['candName'];
			$canid = $_POST['candId'];

			$filename = $_FILES['userfile']['name'];
			$filetype = $_FILES['userfile']['type'];
			$filesize = $_FILES['userfile']['size'];
			$filerror = $_FILES['userfile']['error'];
			$filetmp = $_FILES['userfile']['tmp_name'];

			$notAllowed = array("ico","png");
			$profilepicext = explode(".", $filename);
			$actualprofilepicext = strtolower(end($profilepicext));

			if($filerror == 1){
				echo "<p>There was an error with the file!</p>";
				echo "<p><a href='../vote.cand.setup.php'>Try again</a></p>";
			}else{
				if(in_array($actualprofilepicext, $notAllowed)) {
					echo "<p>Your file type is not allowd!</p>";
					echo "<p><a href='http://localhost/voting/vote.cand.setup.php'>Try again</a></p>";
				}else{
					$profilePicNewName = $candname .".". $actualprofilepicext;
					$dstn = "../../media/".$profilePicNewName;
					$move = move_uploaded_file($filetmp, $dstn);
					$sql = "UPDATE candidates SET status = 'media/".$dstn."' WHERE id='$canid'";
					$query = mysqli_query($conn, $sql);
					header("Location: ../vote.cand.setup.php?change=success");
					exit();
				}
			}
		
			
		}

 ?>