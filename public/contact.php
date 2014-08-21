<?php

if (isset($_POST['email'])) {
	// Edit the 2 lines below as required
	$email_to = "jonbrobinson@gmail.com";
	$email_subject = "Danielle Contact Form";


	if(!isset($_POST['name']) ||
		!isset($_POST['email']) ||
		!isset($_POST['subject']) ||
		!isset($_POST['content'])){
		died ('We are sorry, but there appears to be a problem with the form you submitted.');
	}

	$full_name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$content = $_POST['content'];

	$error_message = "";
	$email_exp = "/^[A-za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/";

	if(!preg_match($email_exp, $email)) {
		$error_message .= 'The Email Address you entered does not appear to be valid.<br>';
	}

	$string_exp = "/^[A-Za-z .'-]+$/";

	if (!preg_match($string_exp,$full_name)) {
		$error_message .= 'The Name you entered does not appear to be valid.<br>';
	}

	if (strlen($subject) < 1) {
		$error_message .= 'The Message you entered does not appear to be valid. <br>';
	}

	if (strlen($content) < 2) {
		$error_message .= 'The Message you entered does not appear to be valid. <br>';
	}

	if (strlen($error_message) > 0) {
		died($error_message);
	}

	$email_message = "Form details below. \n\n";

	function clean_string ($string) {
		$bad = array("content-type", "bcc", "to", "cc", "href");
		return str_replace ($bad,"",$string);
	}

	$email_message .= "First Name: ".clean_string($full_name)."\n";
	$email_message .= "Email: ".clean_string($email)."\n";
	$email_message .= "Subject: ".clean_string($subject)."\n";
	$email_message .= "Message: ".clean_string($content)."\n";

	// Create Email Headers

	$headers = 'From: '.$email."\r\n".
	'Reply-To: '.$email."\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($email_to, $email_subject, $email_message, $headers);
}
?>