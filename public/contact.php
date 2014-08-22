<?php

require_once 'init.php';

function died ($error) {
	// your error code can go here
	echo "We are very sorry, but there were error(s) found with the form you submitted. ";
	echo "These errors appear below.<br><br>";
	echo $error."<br><br>";
	echo "Please go back and fix these errors.<br><br>";
	exit();
}

function clean_string ($string) {
	$bad = array("content-type", "bcc", "to", "cc", "href");
	return str_replace ($bad,"",$string);
}

$full_name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$email_to = "jonbrobinson@gmail.com";
$email_subject = "Danielle Contact Form";

if(!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['subject']) || !isset($_POST['content'])) {

	$email_message = "Form details below. \n\n";
	$email_message .= "First Name: ".clean_string($full_name)."\n";
	$email_message .= "Email: ".clean_string($email)."\n";
	$email_message .= "Subject: ".clean_string($subject)."\n";
	$email_message .= "Message: ".clean_string($content)."\n";

	// Create Email Headers

	$headers = 'From: '.$email."\r\n".
	'Reply-To: '.$email."\r\n" .
	'X-Mailer: PHP/' . phpversion();

	mail($email_to, $email_subject, $email_message, $headers);

} else {

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
		$error_message .= 'The Subject you entered does not appear to be valid. <br>';
	}

	if (strlen($content) < 2) {
		$error_message .= 'The Message you entered does not appear to be valid. <br>';
	}

	if (strlen($error_message) > 0) {
		died($error_message);
	}

}
?>