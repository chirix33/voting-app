<?php
	if (!isset($_POST['submit-form'])) {
		# code...
		header("Location: ../vote.contact.php");
		exit();
	}else{
		$mailFrom = $_POST['contact-email'];
		$subject = $_POST['subject-email'];
		$message = $_POST['message'];

		$mailTo_1 = "chiriashraf@gmail.com";
		$mailTo_2 = "tjhackx111@gmail.com";

		$text = "You have received an E-mail from <b>" . $mailFrom . "</b>" . "\n\n" . $message;

		$headers = "From: " . $mailFrom;

		$firstMail = mail($mailTo_1, $subject, $message, $headers); 

		if (!$firstMail) {
			# code...
			header("Location: ../vote.contact.php?send=error");
			exit();
		}

		$secondMail = mail($mailTo_2, $subject, $message, $headers);

		if (!$secondMail) {
			# code...
			header("Location: ../vote.contact.php?send=error");
			exit();
		}
	}

?>